<?php

namespace backend\controllers;

use Yii;
use backend\models\DeliveryType;
use backend\models\DeliverytypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DeliverytypeController implements the CRUD actions for Deliverytype model.
 */
class DeliverytypeController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * @inheritdoc
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
     * Lists all Deliverytype models.
     * @return mixed
     */
    public function actionIndex()
    {
         $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new DeliverytypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Deliverytype model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Deliverytype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Deliverytype();

        if ($model->load(Yii::$app->request->post())) {
            $uploaded = UploadedFile::getInstance($model, 'logo');
            if(!empty($uploaded)){
                $upfiles = time() . "." . $uploaded->getExtension();
                 //if ($uploaded->saveAs('../uploads/products/' . $upfiles)) {
                if ($uploaded->saveAs('../web/uploads/logo/' . $upfiles)) {
                    $model->logo = $upfiles;
                }
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Deliverytype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             $oldlogo = Yii::$app->request->post('old_logo');
                        $uploaded = UploadedFile::getInstance($model, 'logo');
                        if(!empty($uploaded)){
                              $upfiles = time() . "." . $uploaded->getExtension();

                                //if ($uploaded->saveAs('../uploads/products/' . $upfiles)) {
                                if ($uploaded->saveAs('../web/uploads/logo/' . $upfiles)) {
                                   $model->logo = $upfiles;
                                }
                        }else{
                             $model->logo = $oldlogo;
                        }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Deliverytype model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Deliverytype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deliverytype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deliverytype::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
