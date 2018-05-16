<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use lavrentiev\widgets\toastr\Notification;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'จัดการสต๊อกสินค้า');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">
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
                    <div class="btn-group">
                        <div class="btn-group">
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-plus"></i> สร้างรายการ <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="<?=Url::to(['journal/createissue'],true)?>">เบิก</a></li>
                            <li><a href="#">คืน</a></li>
                            <li><a href="#">ปรับสต๊อก</a></li>
                            <li><a href="#">ย้าย</a></li>
                            <li><a href="#">นับสต๊อก</a></li>
                          
                            <!-- <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li> -->
                          </ul>
                        </div>
                    </div>
                    
                    <h4 class="pull-right"><?=$this->title?> <i class="fa fa-object-group"></i><small></small></h4>
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
                          <div class="col-lg-9">
                      
                            <div class="form-inline">
                               
                                <input type="text" class="form-control" name="search_all" value="" placeholder="ค้นหารหัส,ชื่อ">
                                <?php      
                                      echo MultiSelect::widget([
                                              'id'=>"product_group",
                                              'name'=>'product_group[]',
                                              //'model'=>null,
                                              "options" => ['multiple'=>"multiple",
                                                              'onchange'=>''], // for the actual multiselect
                                              'data' => ArrayHelper::map(\backend\helpers\TransType::asArrayObject(),'id','name'), // data as array
                                              'value' => null, // if preselected
                                              "clientOptions" => 
                                                  [
                                                      "includeSelectAllOption" => true,
                                                      'numberDisplayed' => 5,
                                                      'nonSelectedText'=>'ประเภทรายการ',
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
                          <div class="col-lg-3">

                            <div class="pull-right">
                            <form id="form-perpage" class="form-inline" action="<?=Url::to(['journal/index'],true)?>" method="post">
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
                        <div class="table-responsive">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
         'emptyCell'=>'-',
                    'layout'=>'{items}{summary}{pager}',
                    'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
                    'showOnEmpty'=>false,
                    'tableOptions' => ['class' => 'table table-hover'],
                    'emptyText' => '<div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'vertical-align: middle']],

                      //  'id',
                        [
                          'attribute'=>'name',
                          'contentOptions' => ['style' => 'vertical-align: middle'],  
                        ],
                        [
                          'attribute'=>'description',
                          'contentOptions' => ['style' => 'vertical-align: middle'],  
                        ],
            'reference',
            'reference_type_id',
            //'trans_type',
           [
                                   'attribute'=>'status',
                                   'contentOptions' => ['style' => 'vertical-align: middle'],
                                   'format' => 'html',
                                   'value'=>function($data){
                                     return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                                   }
                                  ],
                                   [

                                      'header' => '',
                                      'headerOptions' => ['style' => 'width: 160px;text-align:center;','class' => 'activity-view-link',],
                                      'class' => 'yii\grid\ActionColumn',
                                      'contentOptions' => ['style' => 'text-align: center'],
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
    <?php Pjax::end(); ?>
</div>