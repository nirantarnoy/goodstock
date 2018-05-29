<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\assets\ICheckAsset;
use lavrentiev\widgets\toastr\Notification;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;
use kartik\cmenu\ContextMenu;
use yii\widgets\ActiveForm;

ICheckAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รหัสสินค้า');
$this->params['breadcrumbs'][] = $this->title;

$view_type = $viewtype;

$groupall = \backend\models\Productcat::find()->where(['!=','name',''])->orderby(['name'=>SORT_ASC])->all();
$stock_status = [['id'=>1,'name'=>'มีสินค้า'],['id'=>2,'name'=>'สินค่าต่ำกว่ากำหนด'],['id'=>3,'name'=>'ไม่มีสินค้า']];

$this->registerJsFile(
    '@web/js/stockbalancejs.js?V=001',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);

?>
<div class="product-index">

<?php $session = Yii::$app->session;
      if ($session->getFlash('msg')): ?>
       <!-- <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php //echo $session->getFlash('msg'); ?>
      </div> -->
        <?php echo Notification::widget([
            'type' => 'success',
            'title' => 'แจ้งผลการทำงาน',
            'message' => $session->getFlash('msg'),
          //  'message' => 'Hello',
            'options' => [
                "closeButton" => false,
                "debug" => false,
                "newestOnTop" => false,
                "progressBar" => false,
                "positionClass" => "toast-top-center",
                "preventDuplicates" => false,
                "onclick" => null,
                "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "6000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]
        ]); ?> 
        <?php endif; ?>
  
   <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
     <div class="row">
      <div class="col-lg-12">
           
           
      </div>
     </div>
    
   

    <div class="x_panel">
                  <div class="x_title">
                    
                      <div class="btn-group">
                         <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างรหัสสินค้า'), ['create'], ['class' => 'btn btn-success']) ?>
                       </div>
                       <div class="btn-group">
                          <div class="btn btn-default btn-import"><i class="fa fa-upload"></i> นำเข้า</div>
                          <div class="btn btn-default btn-export"><i class="fa fa-download"></i> นำออก</div>

                           <div class="btn btn-default btn-approve-vendor"><i class="fa fa-thumbs-up"></i> อนุมัติผู้ขาย</div>
                           <div class="btn btn-default btn-add-component"><i class="fa fa-object-group"></i> จัดชุดสินค้า</div>
                           <div class="btn btn-default btn-bulk-remove"><i class="fa fa-trash"></i><span class="remove_item"></span> ลบ</div>
                          <div class="btn btn-default btn-print-stock"><i class="fa fa-print"></i> พิมพ์สต๊อก</div>
                          <div class="btn btn-default btn-printbarcode"><i class="fa fa-barcode"></i> พิมพ์บาร์โค้ด</div>
<!--                          <div class="btn btn-default view-list"><i class="fa fa-list"></i></div>-->
<!--                          <div class="btn btn-default view-grid"><i class="fa fa-th"></i></div>-->
                      </div>

                    <h4 class="pull-right"><?=$this->title?> <i class="fa fa-cubes"></i><small></small></h4>
                    <!-- <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul> -->
                    
                  </div>
                  <div class="x_content">
                        <div class="row">
                          <div class="col-lg-9">
                            <form id="search-form" action="<?=Url::to(['product/index'],true)?>" method="post">
                            <div class="form-inline">
                              
                                <input type="text" class="form-control search_all" name="search_all" value="<?=$searchname;?>" placeholder="ค้นหารหัส,ชื่อ">
                                <?php      
                                      echo MultiSelect::widget([
                                              'id'=>"product_group",
                                              'name'=>'product_group[]',
                                              //'model'=>null,
                                              "options" => ['multiple'=>"multiple",
                                                              'onchange'=>''], // for the actual multiselect
                                              'data' => count($groupall)==0?['ไม่มีข้อมูล']:ArrayHelper::map($groupall,'id','name'), // data as array
                                              'value' => $group, // if preselected
                                              "clientOptions" => 
                                                  [
                                                      "includeSelectAllOption" => true,
                                                      'numberDisplayed' => 5,
                                                      'nonSelectedText'=>'กลุ่มสินค้า',
                                                      'enableFiltering' => true,
                                                      'enableCaseInsensitiveFiltering'=>true,
                                                  ], 
                                  ]); ?>
                                  <?php      
                                      echo MultiSelect::widget([
                                              'id'=>"stock_status",
                                              'name'=>'stock_status[]',
                                              //'model'=>null,
                                              "options" => ['multiple'=>"multiple",
                                                              'onchange'=>''], // for the actual multiselect
                                              'data' => count($stock_status)==0?['ไม่มีข้อมูล']:ArrayHelper::map($stock_status,'id','name'), // data as array
                                              'value' => $stockstatus, // if preselected
                                              "clientOptions" => 
                                                  [
                                                      "includeSelectAllOption" => true,
                                                      'numberDisplayed' => 5,
                                                      'nonSelectedText'=>'ประเภทสต๊อก',
                                                      'enableFiltering' => true,
                                                      'enableCaseInsensitiveFiltering'=>true,
                                                  ], 
                                  ]); ?>
                                <input type="hidden" name="perpage" value="<?=$perpage?>">
                                   <div class="btn-group">
                                         <input type="submit" class="btn btn-info btn-search" value="ค้นหา" />
                                  <div class="btn btn-default btn-reset"> รีเซ็ต</div>
                                   </div>
                              
                              
                            </div>
                            </form>
                          </div>
                          <div class="col-lg-3">
                           
                            <div class="pull-right"> 
                              <div class="form-inline">
                                <form id="form-perpage" class="form-inline" action="<?=Url::to(['product/index'],true)?>" method="post">
                                <div class="form-group">
                                    <?php for($i=0;$i<=count($group)-1;$i++):?>
                                        <input type="hidden" name="product_group[]" value="<?=$group[$i]?>">
                                    <?php endfor;?>
                                    <?php for($i=0;$i<=count($stockstatus)-1;$i++):?>
                                        <input type="hidden" name="stock_status[]" value="<?=$stockstatus[$i]?>">
                                    <?php endfor;?>
                                    <input type="hidden" name="search_all" value="<?=$searchname;?>">
                                    <label>แสดง </label>
                                  <select class="form-control" name="perpage" id="perpage">
                                     <option value="20" <?=$perpage=='20'?'selected':''?>>20</option>
                                     <option value="50" <?=$perpage=='50'?'selected':''?> >50</option>
                                     <option value="100" <?=$perpage=='100'?'selected':''?>>100</option>
                                  </select>
                                  <label> รายการ</label>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        </div><br />
                         <div class="row">
                          <div class="col-lg-12">
                        <div class="table-responsive">
                   <div class="table-grid">
                     
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'emptyCell'=>'-',
                        'layout'=>'{items}{summary}{pager}',
                        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
                        'showOnEmpty'=>false,
                        'bordered'=>false,
                        'striped' => false,
                        'hover' => true,
                        //'tableOptions' => ['class' => 'table table-hover'],
                        'emptyText' => '<div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
                        'rowOptions' => function($model, $key, $index, $gird){
                            $contextMenuId = $gird->columns[0]->contextMenuId;
                            return ['data'=>[ 'toggle' => 'context','target'=> "#".$contextMenuId ]];
                        },
                        'columns' => [
                            [
                                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                                'contextMenu' => true,
                                'headerOptions' => ['style' => 'text-align: left'],
                                'contentOptions' => ['style' => 'vertical-align: middle'],
                                //'contextMenuAttribute' => 'id',
                                'template' => '<br /> {view} {update} <li class="divider"></li> {delete}',
                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        $title = Yii::t('app', 'ดูรายละเอียด');
                                        $label = '<span class="fa fa-eye"></span> ' . $title;
                                        $url = \Yii::$app->getUrlManager()->createUrl(['/product/view','id' => $model->id]);
                                        $options = ['tabindex' => '1','title' => $title, 'data' => ['pjax' => '0' ,  'toggle' => 'tooltips']];
                                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                                    },
                                    'update' => function ($url, $model) {
                                        $title = Yii::t('app', 'แก้ไข');
                                        $label = '<span class="fa fa-pencil"></span> ' . $title;
                                        $url = \Yii::$app->getUrlManager()->createUrl(['/product/update','id' => $model->id]);
                                        $options = ['tabindex' => '-1','title' => $title, 'data' => ['pjax' => '0' ,  'toggle' => 'tooltip']];
                                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                                    },
                                    'delete' => function ($url, $model) {
                                        $title = Yii::t('app', 'ลบรายการ');
                                        $label = '<span class="fa fa-trash-o"></span> ' . $title;
                                        $url = \Yii::$app->getUrlManager()->createUrl(['/product/delete','id' => $model->id]);
                                        $options = ['class'=>'del-product','tabindex' => '-1','title' => $title, 'data' => ['pjax' => '0' ,  'toggle' => 'tooltip'],'data-url'=>$url,'onclick'=>'recDelete($(this));'];
                                        return '<li>' . Html::a($label, 'javascript:void(0)', $options) . '</li>' . PHP_EOL;
                                    },
                                ],
                            ],
                            ['class' => 'yii\grid\CheckboxColumn','headerOptions' => ['style' => 'text-align: center'],'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;']],
                             // ['class' => 'yii\grid\RadioButtonColumn','headerOptions' => ['style' => 'text-align: center'],'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;']],
                          //  ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'vertical-align: middle']],

                         //   'id',
                             [
                                  'attribute'=>'product_code',
                                  'format'=>'html',
                                  'headerOptions' => ['style' => 'text-align: left'],
                                  'contentOptions' => ['style' => 'vertical-align: middle'],  
                                  'value'=>function($data){
                                    return '<a href="'.Url::to(['product/view/'.$data->id],true).'">'.$data->product_code.'</a>';
                                  }
                             ],
                             [
                                  'attribute'=>'name',
                                  'headerOptions' => ['style' => 'text-align: left'],
                                  'contentOptions' => ['style' => 'vertical-align: middle'],  
                             ],
                             [
                                  'attribute'=>'unit_id',
                                  'headerOptions' => ['style' => 'text-align: left'],
                                  'contentOptions' => ['style' => 'vertical-align: middle'],
                                  'value'=> function($data){
                                    return \backend\models\Unit::findUnitname($data->unit_id);
                                  }  
                             ],
                             [
                                  'attribute'=>'category_id',
                                  'headerOptions' => ['style' => 'text-align: left'],
                                  'contentOptions' => ['style' => 'vertical-align: middle'], 
                                   'value'=> function($data){
                                    return \backend\models\Productcat::findGroupname($data->category_id);
                                  }   
                              ],
                            //'photo',
                            //'category_id',
                            //'product_type_id',
                            //'unit_id',
                            //'min_stock',
                            //'max_stock',
                            //'is_hold',
                            //'has_variant',
                            //'bom_type',
                            //'cost',
                            //'price',
                              [
                                'label'=>'สถานะสินค้า',
                                'format'=>'html',
                                'headerOptions' => ['style' => 'text-align: center'],
                                'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;'],  
                                'value'=>function($data){
                                    if($data->all_qty >0 && $data->all_qty > $data->min_stock){
                                      return '<div class="label label-success">มีสินค้า</div>';
                                    }else if($data->all_qty >0 && $data->all_qty < $data->min_stock){
                                      return '<div class="label label-warning">สินค่าต่ำกว่ากำหนด</div>';
                                    }else{
                                      return '<div class="label label-danger">ไม่มีสินค้า</div>';
                                    }
                                   
                                }
                              ],
                               [
                                  'attribute'=>'all_qty',
                                  'headerOptions' => ['style' => 'text-align: right'],
                                  'contentOptions' => ['style' => 'vertical-align: middle;text-align: right;font-weight: bold;'],  
                                  'value'=> function($data){
                                     return $data->all_qty > 0?number_format($data->all_qty,0):0;
                                  }
                              ],
                              [
                                  'attribute'=>'price',
                                  'headerOptions' => ['style' => 'text-align: right'],
                                  'contentOptions' => ['style' => 'vertical-align: middle;text-align: right;font-weight: bold;'],  
                                  'value'=> function($data){
                                     return $data->price > 0?number_format($data->price,0):0;
                                  }
                              ],
                           [
                                                       'attribute'=>'status',
                                                       'headerOptions' => ['style' => 'text-align: center'],
                                                       'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;'],
                                                       'format' => 'html',
                                                       'value'=>function($data){
                                                         return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                                                       }
                                                      ],

                        ],
                    ]); ?>
                    </div>

                   <!--  <div class="row">
                      <div class="col-lg-12">
                        <?php foreach($dataProvider->getModels() as $value):?>
                              <div class="col-md-3 col-xs-12 widget widget_tally_box">
                              <div class="x_panel fixed_height_300">
                                <div class="x_content">
                                  <h3 class="name"><?=$value->product_code?></h3>
                                  <p>
                                    <?=$value->name?>
                                  </p>
                                   <div class="flex">
                                    <ul class="list-inline count2">
                                      <li>
                                        <span>
                                          <?php if($value->all_qty >0): ?>
                                            <div class="label label-success"> มีสินค้า</div>
                                          <?php else:?>
                                            <div class="label label-danger"> ไม่มีสินค้า</div>
                                          <?php endif;?>
                                        </span>
                                      </li>
                                      <li>
                                        <span>
                                          <?=$value->all_qty?>
                                        </span>
                                      </li>
                                      
                                    </ul>
                                    
                                  </div>
                                  <div class="btn-group">
                                      <div class="btn btn-default"><i class="fa fa-eye"></i></div>
                                      <div class="btn btn-default"><i class="fa fa-pencil"></i></div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach;?>
                      </div>
                    </div> -->

                  </div>
                </div>
              </div>
            </div>
        </div>
    <?php Pjax::end(); ?>
</div>
<div id="importModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
                <h4 class="modal-title"><i class="fa fa-upload"></i> นำเข้ารายการสินค้า <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <?php $form_upload = ActiveForm::begin(['action'=>'importupdate','options'=>['enctype' => 'multipart/form-data']]); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <small class="text-info"> สามารถดาวน์โหลด template สำหรับการนำเข้าสินค้าโดยคลิก </small><a href="<?=Url::to(['product/exporttemplate'],true)?>" style="text-decoration-style: dashed;text-decoration: underline;">ที่นี่</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                       <br />

                           <?= $form_upload->field($modelupload,'file')->fileinput(['class'=>'form-control','accept'=>'.csv'])->label(false)?>


                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-12">

                        <i class="fa fa-warning text-danger"></i> <small class="text-danger"> ขนาดไฟล์ไม่เกิน 100 MB</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <input type="submit" class="btn btn-success" value="ตกลง">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?php ActiveForm::end();?>
        </div>

    </div>
</div>
<div id="exportModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close"></i> </button>
                <h4 class="modal-title"><i class="fa fa-download"></i> นำออกรายการสินค้า <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <?php $form_upload = ActiveForm::begin(['action'=>'exportproduct','options'=>['enctype' => 'multipart/form-data']]); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <small class="text-info"> เลือกรูปแบบข้อมูลที่ต้องการนำออก</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <br />
                        <a href="<?=Url::to(['product/export','type'=>'xls'],true)?>" target="_blank" class="btn btn-default" style="display: block;padding: 15px 15px 15px 15px;border: 1px solid gray;"><i class="fa fa-file-excel-o label-success"></i> XLS File</a>
                        <a href="<?=Url::to(['product/export','type'=>'csv'],true)?>" target="_blank" class="btn btn-default" style="display: block;padding: 15px 15px 15px 15px;border: 1px solid gray;"><i class="fa fa-file-photo-o label-success"></i> CSV File</a>
                        <div class="btn btn-default" style="display: block;padding: 15px 15px 15px 15px;border: 1px solid gray;"><i class="fa fa-file-pdf-o label-danger"></i> PDF File</div>
                        <div class="btn btn-default" style="display: block;padding: 15px 15px 15px 15px;border: 1px solid gray;"><i class="fa fa-file-o"></i> TEXT File</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?php ActiveForm::end();?>
        </div>

    </div>
</div>
<div id="barcodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
                <h4 class="modal-title"><i class="fa fa-barcode"></i> พิมพ์รหัสบาร์โค้ด <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <?php $form_upload = ActiveForm::begin(['action'=>'printbarcode','options'=>['enctype' => 'multipart/form-data','class'=>'form-horizontal form-label-left','target'=>'_blank']]); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <small class="text-info"> เลือกรูปแบบที่ต้องการ</small>
                    </div>
                </div><br />
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ขนาดกระดาษ
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" class="product_listid" name="product_listid" value="">
                        <select name="paper_type" id="paper-type" class="form-control">

                            <option value="1">A4</option>
                            <option value="2">Letter</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">รูปแบบกระดาษ
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="paper_format" id="paper-type" class="form-control">
                            <option value="0">แนวตั้ง</option>
                            <option value="1">แนวนอน</option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">จำนวนบาร์โค้ด
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" value="1" min="1" name="qty" class="form-control" style="width: 50%;">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">พิมพ์รหัสสินค้า
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="show_code" id="paper-type" class="form-control">
                            <option value="0">พิมพ์</option>
                            <option value="1">ไม่พิมพ์</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">พิมพ์ชื่อสินค้า
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="show_name" id="paper-type" class="form-control">
                            <option value="0">พิมพ์</option>
                            <option value="1">ไม่พิมพ์</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success btn-print-barcode" value="พิมพ์">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?php ActiveForm::end();?>
        </div>

    </div>
</div>
<div id="stockModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="fa fa-window-close"></i></button>
                <h4 class="modal-title"><i class="fa fa-print"></i> พิมพ์สต๊อกสินค้า <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <?php $form_upload = ActiveForm::begin(['action'=>'printstock','options'=>['enctype' => 'multipart/form-data','class'=>'form-horizontal form-label-left','target'=>'_blank']]); ?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">พิมพ์สำหรับ
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" class="product_listid" name="product_listid" value="">
                        <select name="paper_type" id="paper-type" class="form-control">

                            <option value="1">จำนวนสต๊อกสินค้าเท่านั้น</option>
                            <option value="2">จำนวนสต๊อกและนับยอด</option>
                        </select>
                    </div>
                </div>
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                </label>
                <div class="col-md-8 col-sm-12 col-xs-12">
                     <i class="fa fa-warning"></i> <span class="text-danger"> ถ้าต้องการสร้างใบนับสต๊อกให้เลือกหัวข้อ "จำนวนสต๊อกและนับยอด"</span>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success btn-print-barcode" value="พิมพ์">
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?php ActiveForm::end();?>
        </div>

    </div>
</div>

<?php 
  $this->registerJsFile( '@web/js/sweetalert.min.js',['depends' => [\yii\web\JqueryAsset::className()]],static::POS_END);
  $this->registerCssFile( '@web/css/sweetalert.css');
  //$url_to_delete =  Url::to(['product/bulkdelete'],true);
  $this->registerJs('

    $(function(){
    
        if($("#product_group").val()!=""){
            $("#product_group").multiselect({
               includeSelectAllOption: true,
               enableFiltering: true,
               nonSelectedText: "กลุ่มสินค้า"
            });
            $("select#product_group").parent().find(".btn-group").find(".multiselect").css({"background-color":"gray","color":"#FFF"}); 
          }
           if($("#stock_status").val()!=""){
            $("#stock_status").multiselect({
               includeSelectAllOption: true,
               enableFiltering: true,
               nonSelectedText: "ประเภทสต๊อก"
            });
            $("select#stock_status").parent().find(".btn-group").find(".multiselect").css({"background-color":"gray","color":"#FFF"}); 
          }
          
        $("select#prouduct_group").change(function(){
           if($(this).val()!=""){
                $(this).parent().find(".btn-group").find(".multiselect").css({"background-color":"gray","color":"#FFF"});
           }else{
                $(this).parent().find(".btn-group").find(".multiselect").css({"background-color":"#F5F5F5","color":"#000"});
            }
        }); 
        $("select#stock_status").change(function(){
           if($(this).val()!=""){
                $(this).parent().find(".btn-group").find(".multiselect").css({"background-color":"gray","color":"#FFF"});
           }else{
                $(this).parent().find(".btn-group").find(".multiselect").css({"background-color":"#F5F5F5","color":"#000"});
            }
        }); 
         
         $("div.btn-reset").click(function(){

                $(".search_all").val("");
                $("select#product_group option:selected").remove();
                $("select#product_group").multiselect("rebuild");
        
                $("select#stock_status option:selected").remove();
                $("select#stock_status").multiselect("rebuild");
      
                
                $(".btn-search").trigger("click");
         });
          
        $(".btn-import").click(function(){
            $("#importModal").modal("show");
        });
          $(".btn-export").click(function(){
            $("#exportModal").modal("show");
        });
           $(".btn-printbarcode").click(function(){
            if(orderList.length < 1){
                return false;
            }
            $(".product_listid").val(orderList);
            $("#barcodeModal").modal("show");
        });
         $(".btn-print-stock").click(function(){
            $("#stockModal").modal("show");
        });
        $(".btn-print-barcode").click(function(){
           $("#barcodeModal").modal("hide");
        });
        $(".btn-bulk-remove").attr("disabled",true);
        
       
        var viewtype = "'.$view_type.'";
        if(viewtype == "list"){
          $(".view-list").addClass("active");
          $(".view-grid").removeClass("active");
        }else{
          $(".view-grid").addClass("active");
          $(".view-list").removeClass("active");
        }
        $("#perpage").change(function(){
            $("#form-perpage").submit();
        });
//        $(".btn-save").click(function(){
//            $("#form-import").attr("href","'.Url::to(['product/importproduct'],true).'");
//            $("#form-import").submit();
//        });
    });

   function recDelete(e){
        //e.preventDefault();
        var url = e.attr("data-url");
        //var url ="'.Url::to(['product/delete','id'=>10],true).'" ;
        alert(url);
        swal({
              title: "ต้องการลบรายการนี้ใช่หรือไม่",
              text: "",
              type: "warning",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              e.attr("href",url); 
              e.trigger("click");        
        });
    }

    ',static::POS_END);
?>
