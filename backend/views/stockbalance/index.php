<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use lavrentiev\widgets\toastr\Notification;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StockbalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'สินค้าคงคลัง');
$this->params['breadcrumbs'][] = $this->title;

$groupall = \backend\models\Productcat::find()->where(['!=','name',''])->orderby(['name'=>SORT_ASC])->all();
$warehouseall = \backend\models\Warehouse::find()->where(['!=','name',''])->orderby(['name'=>SORT_ASC])->all();
?>
<div class="stockbalance-index">
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
<div class="x_panel">
                  <div class="x_title">
                   
                    <h4 class="pull"><i class="fa fa-database"></i> <?=$this->title?> <small></small></h4>
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
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                        <div class="row">
                          <div class="col-lg-10">
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
                                              'value' => null, // if preselected
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
                                              'id'=>"warehouse",
                                              'name'=>'warehouse[]',
                                              //'model'=>null,
                                              "options" => ['multiple'=>"multiple",
                                                              'onchange'=>''], // for the actual multiselect
                                              'data' => count($warehouseall)==0?['ไม่มีข้อมูล']:ArrayHelper::map($warehouseall,'id','name'), // data as array
                                              'value' => null, // if preselected
                                              "clientOptions" => 
                                                  [
                                                      "includeSelectAllOption" => true,
                                                      'numberDisplayed' => 5,
                                                      'nonSelectedText'=>'คลังสินค้า',
                                                      'enableFiltering' => true,
                                                      'enableCaseInsensitiveFiltering'=>true,
                                                  ], 
                                  ]); ?>
                                 
                                   <div class="btn-group">
                                         <div class="btn btn-info btn-search"> ค้นหา</div>
                                  <div class="btn btn-default btn-reset"> รีเซ็ต</div>
                                   </div>
                              
                              
                            </div>
                          </div>
                          <div class="col-lg-2">
                            <form id="form-perpage" class="form-inline" action="<?=Url::to(['customergroup/index'],true)?>" method="post">
                              <div class="form-group">
                               <label>แสดง </label>
                                <select class="form-control" name="perpage" id="perpage">
                                   <option value="20" <?=$perpage=='20'?'selected':''?>>20</option>
                                   <option value="50" <?=$perpage=='50'?'selected':''?> >50</option>
                                   <option value="100" <?=$perpage=='100'?'selected':''?>>100</option>
                                </select>
                                <label>รายการ</label>
                            </div>
                            </form>
                          </div>
                        </div><br />
                        <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'emptyCell'=>'-',
        'layout'=>'{items}{summary}{pager}',
        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
       // 'showOnEmpty'=>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'emptyText' => '<div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'vertical-align: middle']],

            //'id',
            //'plant_id',
            [
                'attribute'=>'product_id',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
                // 'value'=>function($data){
                //    return \backend\helpers\RunnoTitle::getTypeById($data->module_id);
                // } 
            ],

            //'id',
           // 'party_id',
            [
                'attribute'=>'warehouse_id',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],

            [
                'attribute'=>'location_id',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],
            [
                'attribute'=>'lot_id',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],
            [
                'attribute'=>'quantity',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],
             [
                'attribute'=>'price',
                'label' => 'ต้นทุน',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],
             [
                'attribute'=>'amount',
                'label' => 'มูลค่ารวม',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],
            ]
                    ]); ?>
                </div>
            </div>
        </div>
    <?php Pjax::end(); ?>
</div>
