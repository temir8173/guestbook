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
    		$invitation = Invitations::find()->where(['url' => $view])->one();
    		//var_dump($invitation);die;



        	if ($invitation !== null) {

                $newMessage = new Messages();
                $messages = Messages::find()->orderBy(['date' => SORT_ASC])->all();

                $this->layout = 'template1';
        		return $this->render( 'index', compact('messages', 'newMessage'));
        	}

            

        }

        throw new \yii\web\HttpException(404,'Страница не найдена');
    }


    public function actionGetMessages()
    {
        $messages = Messages::find()->orderBy(['date' => SORT_ASC])->all();

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
