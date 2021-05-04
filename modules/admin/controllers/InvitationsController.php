<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Invitations;
use app\models\InvitationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\SectionTemplates;
use app\models\FieldValues;
use app\models\Sections;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * InvitationsController implements the CRUD actions for Invitations model.
 */
class InvitationsController extends Controller
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
        ];
    }

    /**
     * Lists all Invitations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvitationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invitations model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Invitations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invitations();
        $sectionTemplates = SectionTemplates::find()->with('fields')->all();

        // создаем массив моделей секций
        $sections = [new Sections()];
        for($i = 1; $i < count($sectionTemplates); $i++) {
            $sections[] = new Sections();
        }
        // Считаем колво полей
        $fieldsTotal = 0;
        $fieldValues = [];
        foreach ($sectionTemplates as $sectionTemplate) {
            for($i = 0; $i < count($sectionTemplate->fields); $i++) {
                $fieldValues[$sectionTemplate->id][] = new FieldValues();
            }
        }
        // сохраняем в бд если пришел пост запрос
        if ( $model->load(Yii::$app->request->post()) && Model::loadMultiple($sections, Yii::$app->request->post()) ) {

            $instituteValidete = $model->save();

            foreach ($sections as $section) {
                $section->invitation_id = $model->id;
                if($instituteValidete) $section->save();
                if ( !empty($fieldValues[$section->section_template_id]) ) {

                    foreach ($fieldValues[$section->section_template_id] as $key => $fieldValue) {
                        if ( Yii::$app->request->post('FieldValues') !== null ) {
                            $queryParams = Yii::$app->request->post('FieldValues')[$section->section_template_id][$key];
                            $fieldValue->section_id = $section->id;
                            $fieldValue->field_id = $queryParams['field_id'];
                            $fieldValue->field_id = $queryParams['field_id'];
                            if ($fieldValue->field->type == 'image') {
                                $fieldValue->imageFiles = UploadedFile::getInstances($fieldValue, "[$section->section_template_id][$key]imageFiles");
                                $fieldValue->uploadImages();
                            } elseif ($fieldValue->field->type == 'youtube') {
                                $parts = parse_url($queryParams['value']); 
                                if (!empty($parts['query']))
                                    parse_str($parts['query'], $query);
                                $fieldValue->value = (isset($query['v'])) ? 'https://www.youtube.com/embed/'.$query['v'] : $queryParams['value'];
                            } else {
                                $fieldValue->value = (isset($queryParams['value'])) ? $queryParams['value'] : '';
                            }
                            if($instituteValidete) $fieldValue->save();
                        }
                    }
                }
                
                
            }

            if($instituteValidete) return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', compact('model', 'sectionTemplates', 'sections', 'fieldValues'));
    }

    /**
     * Updates an existing Invitations model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = Invitations::find()->with('sections', 'sections.fieldValues', 'sections.fieldValues.field', 'sections.sectionTemplate', 'sections.sectionTemplate.fields')->where(['id' => $id])->one(); 

        $sectionTemplates = SectionTemplates::find()
        ->with('fields')
        ->joinWith('sections')
        ->where(['sections.invitation_id' => $id])
        ->orderby(['sections.order' => SORT_ASC])
        ->all();

        // создаем массив моделей секций
        $sections = $model->sections;
        // создаем массив моделей полей
        $fieldValues = [];
        foreach ($sections as $section) {
            
            if ($section->sectionTemplate->fields !== null) {
                for($i = 0; $i < count($section->sectionTemplate->fields); $i++) {
                    if (isset($section->fieldValues[$i])) {
                        $fieldValues[$section->section_template_id][] = $section->fieldValues[$i];
                    } else {
                        $fieldValues[$section->section_template_id][] = new FieldValues();
                    }
                }
            }

        }

        // сохраняем в бд если пришел пост запрос
        if ( $model->load(Yii::$app->request->post()) && Model::loadMultiple($sections, Yii::$app->request->post()) ) {
            
            $model->save();

            foreach ($sections as $section) {
                $section->invitation_id = $model->id;
                $section->save();
                if ( !empty($fieldValues[$section->section_template_id]) ) {

                    foreach ($fieldValues[$section->section_template_id] as $key => $fieldValue) {
                        $queryParams = Yii::$app->request->post('FieldValues')[$section->section_template_id][$key];
                        $fieldValue->section_id = $section->id;
                        $fieldValue->field_id = $queryParams['field_id'];
                        if ($fieldValue->field->type == 'image') {
                            $fieldValue->imageFiles = UploadedFile::getInstances($fieldValue, "[$section->section_template_id][$key]imageFiles");
                            $fieldValue->uploadImages();
                        } elseif ($fieldValue->field->type == 'youtube') {
                            $parts = parse_url($queryParams['value']); 
                            if (!empty($parts['query']))
                                parse_str($parts['query'], $query);
                            $fieldValue->value = (isset($query['v'])) ? 'https://www.youtube.com/embed/'.$query['v'] : $queryParams['value'];
                        } else {
                            $fieldValue->value = (isset($queryParams['value'])) ? $queryParams['value'] : '';
                        }
                        $fieldValue->save();
                    }
                }
                
                
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model', 'sectionTemplates', 'sections', 'fieldValues'));
    }

    /**
     * Deletes an existing Invitations model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invitations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invitations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invitations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
