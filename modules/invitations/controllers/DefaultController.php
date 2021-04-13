<?php

namespace app\modules\invitations\controllers;

use yii\web\Controller;
use app\models\Invitations;
use app\models\Messages;

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
                $messages = Messages::find()->orderBy(['date' => SORT_DESC])->all();

                $this->layout = 'template1';
        		return $this->render( 'index', compact('messages', 'newMessage'));
        	}

            

        }

        throw new \yii\web\HttpException(404,'Страница не найдена');
    }
}
