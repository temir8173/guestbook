<?php


namespace app\controllers;


use app\models\Audio;
use app\models\InvitationSearch;
use app\models\Wish;
use app\models\WishSearch;
use app\services\invitations\InvitationService;
use app\models\Invitation;
use app\models\Section;
use app\models\Template;
use Yii;
use yii\base\InvalidConfigException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class InvitationController extends BaseController
{
    public function __construct(
        $id,
        $module,
        private InvitationService $invitationService,

        $config = []
    ) {

        parent::__construct($id, $module, $config);
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'create', 'update', 'wishes', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'create', 'update', 'wishes', 'delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new InvitationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, Yii::$app->user->id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     */
    public function actionCreate($template = ''): Response|string
    {
        $invitation = new Invitation();
        $template = Template::findOne(['slug' => $template]);

        if (!$template) {
            throw new NotFoundHttpException();
        }

        $sections = Section::find()
            ->where(['in', 'slug', $template->sections])
            ->with('fields')->all();
        $audio = Audio::find()->select(['name', 'path'])->all();
        $audioItems = ArrayHelper::map($audio,'path','name');

        $invitation->user_id = Yii::$app->user->id;
        $invitation->template_id = $template->id;
        if (
            $invitation->load(Yii::$app->request->getBodyParams())
            && $invitation->validate()
        ) {
            $url = $this->invitationService->create($invitation);
            return $this->redirect(Url::to([
                '/invitation/view',
                'url' => $url
            ]));
        }

        return $this->render('create', [
            'sections' => $sections,
            'invitation' => $invitation,
            'audioItems' => $audioItems,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate($url = '')
    {
        /** @var Invitation $invitation */
        $invitationQuery = Invitation::find()
            ->select('*')
            ->where(['url' => $url]);

        if (Yii::$app->user->identity->role !== 'admin') {
            $invitationQuery
                ->andWhere(['user_id' => Yii::$app->user->id])
                ->andWhere(['is_deleted' => false]);
        }

        $invitation = $invitationQuery->one();

        if (!$invitation) {
            throw new NotFoundHttpException();
        }

        $sections = Section::find()
            ->where(['in', 'slug', $invitation->template->sections])
            ->with('fields')->all();
        $audio = Audio::find()->select(['name', 'path'])->all();
        $audioItems = ArrayHelper::map($audio,'path','name');

        if (
            $invitation->load(Yii::$app->request->getBodyParams())
            && $invitation->validate()
        ) {
            $url = $this->invitationService->update($invitation);
            return $this->redirect(Url::to([
                '/invitation/view',
                'url' => $url
            ]));
        }

        return $this->render('update', [
            'sections' => $sections,
            'invitation' => $invitation,
            'audioItems' => $audioItems,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionView($url = ''): Response|string
    {
        if (Yii::$app->language != 'kk') {
            Yii::$app->session->set('tempLocale', Yii::$app->language);
            return $this->redirect(['/'. Yii::$app->controller->route, 'language' => 'kk', 'url' => $url]);
        }
        Yii::$app->language = Yii::$app->session->get('tempLocale', 'kk');

        if ($url) {
            /** @var Invitation $invitation */
            $invitation = Invitation::find()
                ->with('template', 'wishes')
                ->where(['url' => $url])
                ->andWhere(['is_deleted' => false])
                ->one();

            if (!Yii::$app->user->id && !$invitation->is_demo) {
                throw new NotFoundHttpException();
            }

            if ($invitation) {
                if (!$invitation->is_demo) {
                    Yii::$app->language = $invitation->locale;
//                Yii::$app->formatter->locale = $invitation->locale;
                }
                $newMessage = new Wish();

                $this->layout = "@app/views/layouts/template-layouts/{$invitation->template->slug}";

                return $this->render(
                    "view",
                    [
                        'invitation' => $invitation,
                        'newMessage' => $newMessage,
                        'isPreview' => true,
                    ]
                );
            }
        }

        throw new NotFoundHttpException();
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $invitation = Invitation::findOne($id);

        if (!$invitation) {
            throw new NotFoundHttpException();
        }

        $invitation->is_deleted = true;
        $invitation->save(false);

        $this->redirect('/invitations');
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionGetWishes($invitationId = 0): string
    {
        $wishes = Wish::find()->where(['invitation_id' => $invitationId])->orderBy(['created_at' => SORT_ASC])->all();
        $invitation = Invitation::findOne($invitationId);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax("@app/views/invitation/view/{$invitation->template->slug}/_wishes_box", [
                'wishes' => $wishes
            ]);
        }

        throw new NotFoundHttpException();
    }

    /**
     * @throws HttpException
     */
    public function actionAddWish(): string
    {
        if (Yii::$app->request->isAjax) {
            $newMessage = new Wish();
            $response = array(
                'error' => 1,
                'message' => 'Ошибка. Неверный формат данных!',
            );

            if ($newMessage->load(Yii::$app->request->post()) && $newMessage->save()) {
                Yii::$app->language = Yii::$app->session->get('tempLocale');
                $response = array(
                    'error' => 0,
                    'message' => Yii::t('common', 'Рахмет! Сіздің тілегіңіз жіберілді!'),
                );
            } else {
                $response['message'] = $newMessage->getFirstError('reCaptcha');
            }

            return Json::encode($response);
        }

        throw new NotFoundHttpException();
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionWishes($invitation_id = -1): string
    {
        /** @var Invitation $invitation */
        $invitation = Invitation::find()
            ->where(['is_deleted' => false])
            ->andWhere(['id' => $invitation_id])
            ->one();

        if (Yii::$app->user->id !== (int)$invitation->user_id) {
            throw new NotFoundHttpException();
        }

        $searchModel = new WishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $invitation_id);
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('wishes', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'invitation' => $invitation,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws NotFoundHttpException
     */
    public function actionDeleteWish($id): Response
    {
        /** @var Wish $model */
        $model = Wish::find()->where(['id' => $id])->with('invitation')->one();
        if (!$model) {
            throw new NotFoundHttpException();
        }

        $invitation_id = $model->invitation->id;
        $model->delete();

        return $this->redirect(['wishes', 'invitation_id' => $invitation_id]);
    }
}