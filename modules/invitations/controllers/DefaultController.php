<?php

namespace app\modules\invitations\controllers;

use Yii;
use yii\web\Controller;
use app\models\Invitations;
use app\models\Messages;
use yii\helpers\Json;

/**
 * Default controller for the `Invitations` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($view = '')
    {
    	if ( $view !== '' ) {
    		$invitation = Invitations::find()
            ->with('sections', 'sections.sectionTemplate', 'sections.sectionTemplate.fields')
            ->where(['url' => $view])
            ->one();



        	if ($invitation !== null) {

                $newMessage = new Messages();
                $messages = Messages::find()->where(['invitation_id' => $invitation->id])->orderBy(['date' => SORT_ASC])->all();

                $this->layout = $invitation->template;
        		return $this->render( "@app/modules/invitations/views/default/$invitation->template/index", compact('invitation', 'messages', 'newMessage'));
        	}

            

        }

        throw new \yii\web\HttpException(404,'Страница не найдена');
    }


    public function actionGetMessages($invitation_id = 0)
    {
        $messages = Messages::find()->where(['invitation_id' => $invitation_id])->orderBy(['date' => SORT_ASC])->all();

        if (Yii::$app->request->isAjax) {

            return $this->renderAjax('_messages', [
                'messages' => $messages
            ]);

        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
    }

    public function actionAddMessage()
    {
        if (1||Yii::$app->request->isAjax) {

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
