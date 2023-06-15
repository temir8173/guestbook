<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\Wish;
use app\models\WishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\Invitation;

/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class MessagesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Messages models.
     * @return mixed
     */
    public function actionIndex($invitation_id = -1)
    {
        if (!\Yii::$app->user->can('manageInvitation', ['invitationId' => $invitation_id])) {
            $invitation_id = -1;
            throw new ForbiddenHttpException('Access denied');
        }
        $invitation = Invitation::findOne($invitation_id);
        $searchModel = new WishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $invitation_id);
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'invitation' => $invitation,
        ]);
    }

    /**
     * Deletes an existing Messages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $invitation_id = $model->invitation->id;
        $model->delete();

        return $this->redirect(['index', 'invitation_id' => $invitation_id]);
    }

    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wish::find()->where(['id' => $id])->with('invitation')->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
