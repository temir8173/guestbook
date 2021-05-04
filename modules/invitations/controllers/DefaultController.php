<?php

namespace app\modules\invitations\controllers;

use Yii;
use yii\web\Controller;
use app\models\Invitations;
use app\models\Messages;
use yii\helpers\Json;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Default controller for the `Invitations` module
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?', 'user'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['preview'],
                        'roles' => ['user'],
                    ],
                ]
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($view = '')
    {
        if (\Yii::$app->language != 'kk') {
            return $this->redirect(['/'.\Yii::$app->controller->route, 'language' => 'kk', 'view' => $view]);
        }
    	if ( $view !== '' ) {
    		$invitation = Invitations::find()
            ->with('sections', 'sections.sectionTemplate', 'sections.sectionTemplate.fields')
            ->where(['url' => $view])
            ->andWhere(['status' => 1])
            ->one();



        	if ($invitation !== null) {

                $newMessage = new Messages();
                $messages = Messages::find()->where(['invitation_id' => $invitation->id])->orderBy(['date' => SORT_ASC])->all();

                Yii::$app->formatter->locale = 'en-US';
                $this->layout = $invitation->template;
        		return $this->render( "@app/modules/invitations/views/default/$invitation->template/index", compact('invitation', 'messages', 'newMessage'));
        	}

            

        }

        throw new \yii\web\HttpException(404,'Страница не найдена');
    }
    /**
     * Renders the preview
     * @return string
     */
    public function actionPreview($view = '')
    {
        if (\Yii::$app->language != 'kk') {
            return $this->redirect(['/preview/'.\Yii::$app->controller->route, 'language' => 'kk', 'view' => $view]);
        }
    	if ( $view !== '' ) {
    		$invitation = Invitations::find()
            ->with('sections', 'sections.sectionTemplate', 'sections.sectionTemplate.fields')
            ->where(['url' => $view])
            ->one();



        	if ($invitation !== null) {

                $newMessage = new Messages();
                $messages = Messages::find()->where(['invitation_id' => $invitation->id])->orderBy(['date' => SORT_ASC])->all();

                Yii::$app->formatter->locale = 'en-US';
                $this->layout = $invitation->template;
        		return $this->render( "@app/modules/invitations/views/default/$invitation->template/index", compact('invitation', 'messages', 'newMessage'));
        	}

            

        }

        throw new \yii\web\HttpException(404,'Страница не найдена');
    }


    public function actionGetMessages($invitation_id = 0)
    {
        $messages = Messages::find()->where(['invitation_id' => $invitation_id])->orderBy(['date' => SORT_ASC])->all();
        $invitation = Invitations::findOne($invitation_id);

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax("@app/modules/invitations/views/default/$invitation->template/_messages", [
                'messages' => $messages
            ]);

        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
    }

    public function actionAddMessage()
    {
        if (Yii::$app->request->isAjax) {

            $newMessage = new Messages();
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

        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
    }
}
