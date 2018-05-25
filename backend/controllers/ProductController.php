<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use backend\helpers\TransType;
use backend\models\TransCalculate;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        $modelupload = new \backend\models\Uploadfile();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'viewtype' => 'list',
            'modelupload'=> $modelupload,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = Yii::$app->session;
            $session->setFlash('msg','บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = Yii::$app->session;
            $session->setFlash('msg','บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionExporttemplate(){
        $strExcelFileName="form_product.xls";
        header('Content-Encoding: UTF-8');
        header("Content-Type: application/x-msexcel ; name=\"$strExcelFileName\" charset=utf-8");
        header("Content-Disposition: attachment; filename=\"$strExcelFileName\"");
        header("Content-Transfer-Encoding: binary");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "
           <table border='1'>
             <tr>
                <td>Product Code</td>
                <td>Name</td>
                <td>Category</td>
                <td>Unit</td>
                <td>Qty</td>
                <td>Price</td>
            </tr>
            </table>
        ";
    }
    public function actionImportproduct(){

        $model = new \backend\models\Uploadfile();
        if(Yii::$app->request->post()){
            $uploaded = UploadedFile::getInstance($model, 'file');
            if(!empty($uploaded)) {
                $upfiles = time() . "." . $uploaded->getExtension();
                if($uploaded->saveAs('../web/uploads/files/'.$upfiles)) {
                    //echo "okk";return;
                    $myfile = '../web/uploads/files/' . $upfiles;
                    $file = fopen($myfile, "r");
                    fwrite($file, "\xEF\xBB\xBF");
                    setlocale(LC_ALL, 'th_TH.TIS-620');
                    $i = -1;
                    $res = 0;
                    $data = [];
                    while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                        $i += 1;
                        if ($rowData[0] == '' || $i == 0) {
                            continue;
                        }
                        $modelprod = \backend\models\Product::find()->where(['product_code' => $rowData[0]])->one();
                        if (count($modelprod) > 0) {
                            // $data_all +=1;
                            // array_push($data_fail,['name'=>$rowData[0][1]]);
                            continue;
                        }
                        $modelx = new \backend\models\Product();
                        $modelx->product_code = $rowData[0];
                        $modelx->barcode = $rowData[0];
                        $modelx->name = $rowData[1];
                        $modelx->description = $rowData[1] ;
                        $modelx->category_id = $this->checkCat($rowData[2]);
                        $modelx->unit_id = $this->checkUnit($rowData[3]);
                        $modelx->price = $rowData[5];
                        $modelx->all_qty = str_replace(',','', $rowData[4]);;
                        $modelx->available_qty = str_replace(',','', $rowData[4]);;
                        $modelx->status = 1;

                        if ($modelx->save(false)) {
                            $res += 1;
                            // $data_all +=1;
                             array_push($data,['prod_id'=>$modelx->id,'qty'=>$modelx->all_qty,'warehouse_id'=>1,'trans_type'=>TransType::TRANS_ADJUST]);
                        }
                    }
                     $update_stock = TransCalculate::createJournal($data);
                    if($res > 0 && $update_stock){
                        $session = Yii::$app->session;
                        $session->setFlash('msg','นำเข้าข้อมูลสินค้าเรียบร้อย');
                        return $this->redirect(['index']);
                    }else{
                        $session = Yii::$app->session;
                        $session->setFlash('msg-error','พบข้อมผิดพลาด');
                        return $this->redirect(['index']);
                    }
                }
                fclose($file);
            }else{

            }
        }
    }
    public function checkCat($name){
        $model = \backend\models\Productcat::find()->where(['name'=>$name])->one();
        if(count($model)>0){
            return $model->id;
        }else{
            $model_new = new \backend\models\Productcat();
            $model_new->name = $name;
            $model_new->status = 1;
            if($model_new->save(false)){
                return $model_new->id;
            }
        }
    }
    public function checkUnit($name){
        $model = \backend\models\Unit::find()->where(['name'=>$name])->one();
        if(count($model)>0){
            return $model->id;
        }else{
            $model_new = new \backend\models\Unit();
            $model_new->name = $name;
            $model_new->status = 1;
            if($model_new->save(false)){
                return $model_new->id;
            }
        }
    }
    public function actionPrintbarcode(){
        if(Yii::$app->request->post()){
            $prod_id = Yii::$app->request->post('product_listid');
            $paper_type = Yii::$app->request->post('paper_type');
            $paper_format = Yii::$app->request->post('paper_format');
            $qty = Yii::$app->request->post('qty');

            $show_code = Yii::$app->request->post('show_code');
            $show_name = Yii::$app->request->post('show_name');

            $prodid = explode(',',$prod_id);
            $paper_size =  Pdf::FORMAT_LEGAL;
            $orient =  Pdf::ORIENT_PORTRAIT;

            if($paper_format == 1){
                $orient = Pdf::ORIENT_LANDSCAPE;
            }
            if($paper_type == 0){
                $paper_size = [100,50];
            }else if($paper_type == 1){
                $paper_size = Pdf::FORMAT_A4;
            }else if($paper_type == 2){
                $paper_size = Pdf::FORMAT_LETTER;
            }


            $modellist = Product::find()->where(['id'=>$prodid])->all();

            $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'format' => $paper_size,
               // 'format' => [60, 30],//กำหนดขนาด
                'orientation' => $orient,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_print',[
                    'list'=>$modellist,
                    'barcode_qty' => $qty,
                    'show_code' => $show_code,
                    'show_name' => $show_name,
                    // 'from_date'=> $from_date,
                    // 'to_date' => $to_date,
                ]),
                //'content' => "nira",
                'cssFile' => '@backend/web/css/pdf.css',
               // 'cssFile' => '@frontend/web/css/kv-mpdf-bootstrap.css',
//                'options' => [
//                    'title' => 'บาร์โต้ดรหัสสินค้า',
//                    'subject' => ''
//                ],
                'methods' => [
                  //  'SetHeader' => ['บาร์โค้ดรหัสสินค้า||Generated On: ' . date("r")],
                  //  'SetFooter' => ['|Page {PAGENO}|'],
                ]
            ]);
            return $pdf->render();

        }
    }
    public function actionExport($type){
        if($type !=''){

            $contenttype = "";
            $fileName = "";

            if($type == 'xsl'){
                $contenttype = "application/x-msexcel";
                $fileName="export_product.xls";
            }
            if($type == 'csv'){
                $contenttype = "application/csv";
                $fileName="export_product.csv";
            }

            header('Content-Encoding: UTF-8');
            header("Content-Type: ".$contenttype." ; name=\"$fileName\" ;charset=utf-8");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-Transfer-Encoding: binary");
            header("Pragma: no-cache");
            header("Expires: 0");

            print "\xEF\xBB\xBF";

            $model = Product::find()->where(['id'=>1])->all();
            if($model){
                echo "
                       <table border='1'>
                         <tr>
                            <td>Product Code</td>
                            <td>Name</td>
                            <td>Category</td>
                            <td>Unit</td>
                            <td>Qty</td>
                            <td>Price</td>
                        </tr>
                       
                    ";
                foreach($model as $data){
                    $cat = \backend\models\Productcat::findGroupname($data->category_id);
                    $unit = \backend\models\Unit::findUnitname($data->unit_id);
                    echo "
                        <tr>
                            <td>$data->product_code</td>
                            <td>$data->name</td>
                            <td>$cat</td>
                            <td>$unit</td>
                            <td>$data->all_qty</td>
                            <td>$data->price</td>
                        </tr>
                    ";
                }
                echo "</table>";
            }
        }

    }
}
