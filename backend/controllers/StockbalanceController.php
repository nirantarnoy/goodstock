<?php

namespace backend\controllers;

use Yii;
use backend\models\Stockbalance;
use backend\models\StockbalanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StockbalanceController implements the CRUD actions for Stockbalance model.
 */
class StockbalanceController extends Controller
{
    public $enableCsrfValidation = false;
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
     * Lists all Stockbalance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $group = [];
        $warehouse = [];
        $searchall = '';

        if(Yii::$app->request->isPost){
            $group = Yii::$app->request->post('product_group');
            $warehouse = Yii::$app->request->post('warehouse');
            $searchall = Yii::$app->request->post('search_all');
        }

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new StockbalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $modelfind_product = \backend\models\Product::find()->andFilterWhere(['category_id'=>$group])->andFilterWhere(['OR',['LIKE','product_code',$searchall],['LIKE','name',$searchall]])->all();

        //echo count($modelfind_product);return;
        if(count($modelfind_product)>0){
            $idlist = [];
            foreach($modelfind_product as $value){
                array_push($idlist,$value->id);
            }
            $dataProvider->query->where(['product_id'=>$idlist]);
            if($warehouse !=null){
                $dataProvider->query->andFilterWhere(['warehouse_id'=>$warehouse]);
            }
        }



        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'searchall'=>$searchall,
            'group'=> $group,
            'warehouse'=>$warehouse,
        ]);
    }

    /**
     * Displays a single Stockbalance model.
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
     * Creates a new Stockbalance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stockbalance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stockbalance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stockbalance model.
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
     * Finds the Stockbalance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stockbalance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stockbalance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
