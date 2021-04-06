<?php

namespace app\modules\invitations\controllers;

use yii\web\Controller;
use app\models\Invitations;

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
        		return $this->render('index');
        	} else {
        		throw new \yii\web\HttpException(404,'Страница не найдена');
        	}

        } else {
            throw new \yii\web\HttpException(404,'Страница не найдена');
        }
    }
}
