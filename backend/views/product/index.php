<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use backend\assets\ICheckAsset;
use lavrentiev\widgets\toastr\Notification;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;

ICheckAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รหัสสินค้า');
$this->params['breadcrumbs'][] = $this->title;

$view_type = $viewtype;
$group = '';
$stockstatus = '';

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
                          <div class="btn btn-default"><i class="fa fa-upload"></i> นำเข้า</div>
                          <div class="btn btn-default"><i class="fa fa-download"></i> นำออก</div>
                          <div class="btn btn-default btn-bulk-remove"><i class="fa fa-trash"></i><span class="remove_item"></span> ลบ</div>
                          <div class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</div>
                          <div class="btn btn-default"><i class="fa fa-barcode"></i> พิมพ์บาร์โค้ด</div>
                          <div class="btn btn-default view-list"><i class="fa fa-list"></i></div>
                          <div class="btn btn-default view-grid"><i class="fa fa-th"></i></div>
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
                              
                                <input type="text" class="form-control" name="search_all" value="" placeholder="ค้นหารหัส,ชื่อ">
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
                                   <div class="btn-group">
                                         <div class="btn btn-info btn-search"> ค้นหา</div>
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
                        'tableOptions' => ['class' => 'table table-hover'],
                        'emptyText' => '<div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
                        'columns' => [
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
                                                       [

                                                          'header' => '',
                                                          'headerOptions' => ['style' => 'width: 160px;text-align:center;','class' => 'activity-view-link',],


                                                          'class' => 'yii\grid\ActionColumn',
                                                          'contentOptions' => ['style' => 'text-align: center','class'=>'btn-group'],
                                                          'buttons' => [
                                                              'view' => function($url, $data, $index) {
                                                                  $options = [
                                                                      'title' => Yii::t('yii', 'View'),
                                                                      'aria-label' => Yii::t('yii', 'View'),
                                                                      'data-pjax' => '0',
                                                                  ];
                                                                  return Html::a(
                                                                                  '<span class="glyphicon glyphicon-eye-open btn btn-default"></span>', $url, $options);
                                                              },
                                                                  'update' => function($url, $data, $index) {
                                                                  $options = array_merge([
                                                                      'title' => Yii::t('yii', 'Update'),
                                                                      'aria-label' => Yii::t('yii', 'Update'),
                                                                      'data-pjax' => '0',
                                                                      'id'=>'modaledit',
                                                                  ]);
                                                                  return $data->status == 1? Html::a(
                                                                                          '<span class="glyphicon glyphicon-pencil btn btn-default"></span>', $url, [
                                                                                      'id' => 'activity-view-link',
                                                                                      //'data-toggle' => 'modal',
                                                                                      // 'data-target' => '#modal',
                                                                                      'data-id' => $index,
                                                                                      'data-pjax' => '0',
                                                                                     // 'style'=>['float'=>'rigth'],
                                                                          ]):'';
                                                              },
                                                                      'delete' => function($url, $data, $index) {
                                                                          $options = array_merge([
                                                                            'title' => Yii::t('yii', 'Delete'),
                                                                            'aria-label' => Yii::t('yii', 'Delete'),
                                                                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                                                            //'data-method' => 'post',
                                                                            //'data-pjax' => '0',
                                                                            'onclick'=>'recDelete($(this));'
                                                                          ]);
                                                                  return Html::a('<span class="glyphicon glyphicon-trash btn btn-default"></span>', 'javascript:void(0)', $options);
                                                              }
                                                                  ]
                                                          ],
                        ],
                    ]); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    <?php Pjax::end(); ?>
</div>
<?php 
  $this->registerJsFile( '@web/js/sweetalert.min.js',['depends' => [\yii\web\JqueryAsset::className()]],static::POS_END);
  $this->registerCssFile( '@web/css/sweetalert.css');
  //$url_to_delete =  Url::to(['product/bulkdelete'],true);
  $this->registerJs('

    $(function(){

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
    });

   function recDelete(e){
        //e.preventDefault();
        var url = e.attr("data-url");
        //alert(url);
        swal({
              title: "ต้องการลบรายการนี้ใช่หรือไม่",
              text: "",
              type: "warning",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              e.attr("href",url); 
              e.toggle("click");        
        });
    }

    ',static::POS_END);
?>
