<?php


namespace app\controllers;


use app\models\InvitationSearch;
use app\models\Wish;
use app\services\invitations\InvitationService;
use app\models\Invitation;
use app\models\Section;
use app\models\Template;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class InvitationController extends Controller
{
    public function __construct(
        $id,
        $module,
        private InvitationService $invitationService,

        $config = []
    ) {

        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
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
     */
    public function actionCreate()
    {
        $invitation = new Invitation();
        $templates = Template::find()->select(['id', 'name'])->all();
        $sections = Section::find()->with('fields')->all();

        if (
            $invitation->load(Yii::$app->request->getBodyParams())
            && $invitation->validate()
        ) {
            $invitation->user_id = Yii::$app->user->id;
            $url = $this->invitationService->create($invitation);
            return $this->redirect(Url::to([
                '/invitation/preview',
                'url' => $url
            ]));
        }

        return $this->render('create', [
            'sections' => $sections,
            'invitation' => $invitation,
            'templateNames' => ArrayHelper::map($templates, 'id', 'name'),
        ]);
    }

    /**
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    public function actionUpdate($url = '')
    {
        /** @var Invitation $invitation */
        $invitation = Invitation::find()
            ->select('*')
            ->where(['url' => $url])
            ->one();

        if (!$invitation) {
            throw new NotFoundHttpException();
        }

        $templates = Template::find()->select(['id', 'name'])->all();
        $sections = Section::find()->with('fields')->all();

        if (
            $invitation->load(Yii::$app->request->getBodyParams())
            && $invitation->validate()
        ) {
            $url = $this->invitationService->update($invitation);
            return $this->redirect(Url::to([
                '/invitation/preview',
                'url' => $url
            ]));
        }

        return $this->render('update', [
            'sections' => $sections,
            'invitation' => $invitation,
            'templateNames' => ArrayHelper::map($templates, 'id', 'name'),
        ]);
    }

    public function actionView()
    {

    }

    /**
     * @throws HttpException
     */
    public function actionPreview($url = '')
    {
        if (Yii::$app->language != 'kk') {
            return $this->redirect(['/'. Yii::$app->controller->route, 'language' => 'kk', 'view' => $view]);
        }

        if ($url) {
            /** @var Invitation $invitation */
            $invitation = Invitation::find()
                ->with('template', 'wishes')
                ->where(['url' => $url])
                ->one();

            if ($invitation) {
                $newMessage = new Wish();

                Yii::$app->formatter->locale = 'en-US';
                $this->layout = "@app/views/layouts/template-layouts/{$invitation->template->slug}";
                return $this->render(
                    "@app/views/invitation/view/{$invitation->template->slug}/index",
                    compact('invitation', 'newMessage')
                );
            }
        }

        throw new HttpException(404,'Страница не найдена');
    }

    public function actionGetMessages($invitationId = 0)
    {
        $messages = Wish::find()->where(['invitation_id' => $invitationId])->orderBy(['date' => SORT_ASC])->all();
        $invitation = Invitation::findOne($invitationId);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax("@app/views/invitation/view/{$invitation->template->slug}/_wishes_box", [
                'messages' => $messages
            ]);
        }

        throw new HttpException(404,'Страница не найдена');
    }

    public function actionAddMessage(): string
    {
        if (Yii::$app->request->isAjax) {
            $newMessage = new Wish();
            $return = array(
                'error' => 1,
                'message' => 'Ошибка. Неверный формат данных!',
            );

            if ($newMessage->load(Yii::$app->request->post()) && $newMessage->save()) {
                $return = array(
                    'error' => 0,
                    'message' => Yii::t('common', 'Рахмет! Сіздің тілегіңіз жіберілді!'),
                );
            }

            return Json::encode($return);
        }

        throw new HttpException(404,'Страница не найдена');
    }
}