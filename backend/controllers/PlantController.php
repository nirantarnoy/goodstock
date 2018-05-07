<?php

namespace backend\controllers;

use Yii;
use backend\models\Plant;
use backend\models\PlantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\AddressBook;
/**
 * PlantController implements the CRUD actions for Plant model.
 */
class PlantController extends Controller
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
            'access'=>[
                'class'=> AccessControl::className(),
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index','create','view','update','delete','showcity','showdistrict','showzipcode'],
                        'roles'=>['SystemAdmin']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['index'],
                        'roles'=>['ManageInventory']
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Plant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $modelx = Plant::find()->one();
        $model_address = new AddressBook();
        if(count($modelx)>0){
            return $this->redirect(['update','id'=>$modelx->id]);
        }
        $model = new Plant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model_address'=> $model_address,
                //'model_bankaccount' => $model_bankaccount,
            ]);
        }
        // $searchModel = new PlantSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

    }

    /**
     * Displays a single Plant model.
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
     * Creates a new Plant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Plant();

        if ($model->load(Yii::$app->request->post())&& $model_address->load(Yii::$app->request->post())) {
            if($model->save()){
                $model_address->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Plant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_address = new AddressBook();
        $model_address_plant = AddressBook::find()->where(['party_id'=>$id,'party_type_id'=>1])->one();

        if ($model->load(Yii::$app->request->post()) && $model_address->load(Yii::$app->request->post())) {

              
            //print_r($model_address);return;
            if($model->save()){
               if(count($model_address_plant) > 0){
                    $model_address_plant->load(Yii::$app->request->post());
                    $model_address_plant->save();
               }else{
                    $model_address->party_type_id = 1; // 1 = plant
                    $model_address->party_id = $id;
                    $model_address->save(false);
               }
               return $this->redirect(['view', 'id' => $model->id]); 
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'model_address' => $model_address,
            'model_address_plant' => $model_address_plant,
        ]);
    }

    /**
     * Deletes an existing Plant model.
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
     * Finds the Plant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Plant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Plant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionShowcity($id){
      $model = \common\models\Amphur::find()->where(['PROVINCE_ID' => $id])->all();

      if (count($model) > 0) {
          foreach ($model as $value) {

              echo "<option value='" . $value->AMPHUR_ID . "'>$value->AMPHUR_NAME</option>";

          }
      } else {
          echo "<option>-</option>";
      }
    }
    public function actionShowdistrict($id){
      $model = \common\models\District::find()->where(['AMPHUR_ID' => $id])->all();

      if (count($model) > 0) {
          foreach ($model as $value) {

              echo "<option value='" . $value->DISTRICT_ID . "'>$value->DISTRICT_NAME</option>";

          }
      } else {
          echo "<option>-</option>";
      }
    }
    public function actionShowzipcode($id){
      $model = \common\models\Amphur::find()->where(['AMPHUR_ID' => $id])->one();

      if (count($model) > 0) {
          echo $model->POSTCODE;
      } else {
          echo "";
      }
    }
}
