<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use lavrentiev\widgets\toastr\Notification;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;
use kartik\cmenu\ContextMenu;
use backend\assets\ICheckAsset;

ICheckAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StockbalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ภาพรวมสินค้าคงคลัง');
$this->params['breadcrumbs'][] = $this->title;

$groupall = \backend\models\Productcat::find()->where(['!=','name',''])->orderby(['name'=>SORT_ASC])->all();
$warehouseall = \backend\models\Warehouse::find()->where(['!=','name',''])->orderby(['name'=>SORT_ASC])->all();

$items = [
    ['label'=>'Action', 'url'=>'#'],
    ['label'=>'Another action', 'url'=>'#'],
    ['label'=>'Something else here', 'url'=>'#'],
    '<li class="divider"></li>',
    ['label'=>'Separated link', 'url'=>'#'],
];

$this->registerJsFile(
    '@web/js/stockbalancejs.js?V=001',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);
?>
<?php
$scripts = <<<'JS'
   function (e, element, target) {
    e.preventDefault();
    if (e.target.tagName == 'SPAN') {
        e.preventDefault();
        this.closemenu();
        return false;
    }
    return true;
}
JS;
?>
<div class="stockbalance-index">

    <?php //ContextMenu::begin([
//        'items'=>$items,
//        'options'=>['tag'=>'div'],
//        'pluginOptions'=>['before'=>$scripts]
    //]);?>
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
                    <h4 class="pull-left"><i class="fa fa-database"></i> <?=$this->title?> <small></small></h4>
                    <div class="pull-right">
                        <div class="btn-group">
                          <div class="btn btn-default"><i class="fa fa-upload"></i> นำเข้า</div>
                          <div class="btn btn-default"><i class="fa fa-download"></i> นำออก</div>
                          <div class="btn btn-default"><i class="fa fa-random"></i> ย้ายที่เก็บ</div>
                          <div class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</div>
                      </div>
                    </div>
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
        //'tableOptions' => ['class' => 'table table-hover','style'=>'border: 0px 0px 0px 0px;'],
        'bordered'=>false,
        'striped' => false,
        'hover' => true,
        'emptyText' => '<div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
        'rowOptions' => function($model, $key, $index, $gird){
            $contextMenuId = $gird->columns[0]->contextMenuId;
            return ['data'=>[ 'toggle' => 'context','target'=> "#".$contextMenuId ]];
        },
        'columns' => [
            [
                'class' => \liyunfang\contextmenu\SerialColumn::className(),
                'contextMenu' => true,
                //'contextMenuAttribute' => 'id',
                'template' => '<li class="divider"></li> {view} {update} <li class="divider"></li> {story}',
                'buttons' => [
                    'story' => function ($url, $model) {
                        $title = Yii::t('app', 'Story');
                        $label = '<span class="glyphicon glyphicon-film"></span> ' . $title;
                        $url = \Yii::$app->getUrlManager()->createUrl(['/user/story','id' => $model->id]);
                        $options = ['tabindex' => '-1','title' => $title, 'data' => ['pjax' => '0' ,  'toggle' => 'tooltip']];
                        return '<li>' . Html::a($label, $url, $options) . '</li>' . PHP_EOL;
                    }
                ],
            ],
            [
                'class' => 'kartik\grid\CheckboxColumn',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;']],
            //'id',
            //'plant_id',

            [
                'attribute'=>'product_id',
                'format'=>'html',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
                 'value'=>function($data){
                     return '<a href="'.Url::to(['product/view/'.$data->product_id],true).'">'.\backend\models\Product::findProductinfo($data->product_id)->product_code.'</a>';
                 }
            ],

            //'id',
           // 'party_id',
            [
                'attribute'=>'warehouse_id',
                'format'=>'html',
                'contentOptions' => ['style' => 'vertical-align: middle'],
                'value'=>function($data){
                    return '<a href="'.Url::to(['warehouse/view/'.$data->warehouse_id],true).'">'.\backend\models\Warehouse::findWarehouseinfo($data->warehouse_id)->name.'</a>';
                }
               
            ],

            [
                'attribute'=>'location_id',
                'contentOptions' => ['style' => 'vertical-align: middle'],
                'value'=>function($data){
                    return \backend\models\Location::findLocationinfo($data->warehouse_id)->name;
                }
               
            ],
            [
                'attribute'=>'lot_id',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],
            [
                'attribute'=>'quantity',
                'contentOptions' => ['style' => 'vertical-align: middle'], 
               
            ],


            ],

                    ]); ?>
                </div>
            </div>
        </div>
    <?php Pjax::end(); ?>
</div>
