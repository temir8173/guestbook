<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\rbac\Rbac as AdminRbac;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
	
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //var_dump(Yii::$app->user->can('admin'));die;
        return $this->render('index');
    }
}
