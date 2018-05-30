<?php

namespace backend\controllers;

use Yii;
use backend\models\Vendor;
use backend\models\VendorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use \backend\models\Addressbook;

/**
 * VendorController implements the CRUD actions for Vendor model.
 */
class VendorController extends Controller
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
     * Lists all Vendor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
             'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Vendor model.
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
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vendor();
        $model_address_plant = AddressBook::find()->where(['party_type_id'=>2])->one();
        $model_address = new AddressBook();
        if ($model->load(Yii::$app->request->post())&& $model_address->load(Yii::$app->request->post())) {
            if($model->save()){
                $model_address->party_type_id = 2; // vendor
                $model_address->party_id = $model->id;
                $model_address->save(false);
                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'model_address' => $model_address,
            'model_address_plant' => $model_address_plant,
        ]);
    }

    /**
     * Updates an existing Vendor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_address_plant = AddressBook::find()->where(['party_type_id'=>2,'party_id'=>$id])->one();
        $model_address = new AddressBook();
        if ($model->load(Yii::$app->request->post())&& $model_address->load(Yii::$app->request->post())) {
            if($model->save(false)){
                $model_address->party_type_id = 2; // vendor
                $model_address->party_id = $id;

                $model_address->save(false);


                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'model_address' => $model_address,
            'model_address_plant' => $model_address_plant,
        ]);
    }

    /**
     * Deletes an existing Vendor model.
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
     * Finds the Vendor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
