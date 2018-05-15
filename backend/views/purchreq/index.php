<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PurchreqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ใบขอซื้อ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchreq-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
      <div class="col-lg-12">
           
      </div>
     </div>
    <div class="x_panel">
                  <div class="x_title">
                    <div class="btn-group">
                     <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างใบขอซื้อ'), ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                    <div class="btn-group">
                      <div class="btn btn-default"><i class="fa fa-thumbs-up"></i> อนุมัติใบขอซื้อ</div>
                      <div class="btn btn-default"><i class="fa fa-ban"></i> ยกเลิก</div>
                      
                      <div class="btn btn-default btn-bulk-remove"><i class="fa fa-trash"></i><span class="remove_item"></span> ลบ</div>
                      <div class="btn btn-default"><i class="fa fa-download"></i> นำออก</div>
                      <div class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</div>
                    </div>
                    <h4 class="pull-right"><?=$this->title?> <i class="fa fa-file-o"></i><small></small></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                         <div class="row">
                          <div class="col-lg-9">
                            <div class="form-inline">
                            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="pull-right">
                            <form id="form-perpage" class="form-inline" action="<?=Url::to(['location/index'],true)?>" method="post">
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
                               // 'filterModel' => $searchModel,
                                'emptyCell'=>'-',
                                'layout'=>'{items}{summary}{pager}',
                                'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
                                'showOnEmpty'=>false,
                                'tableOptions' => ['class' => 'table table-hover'],
                                'emptyText' => '<div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'vertical-align: middle','text-align:center'],],

                                   // 'id',
                                    [
                                      'attribute'=>'purchreq_no',
                                      'contentOptions' => ['style' => 'vertical-align: middle'],  
                                    ],
                                     [
                                      'attribute'=>'require_date',
                                      'contentOptions' => ['style' => 'vertical-align: middle'],  
                                    ],
                                     [
                                      'attribute'=>'request_by',
                                      'contentOptions' => ['style' => 'vertical-align: middle'],  
                                    ],
                                     [
                                      'attribute'=>'reason',
                                      'contentOptions' => ['style' => 'vertical-align: middle'],  
                                    ],
                                     [
                                      'attribute'=>'total_amount',
                                      'contentOptions' => ['style' => 'vertical-align: middle'],  
                                    ],
                                     [
                                      'attribute'=>'approve_status',
                                      'contentOptions' => ['style' => 'vertical-align: middle'],  
                                    ],
                                    //'approve_status',
                                    //'approve_by',
                                    //'approve_date',
                                    //'total_amount',
                                    //'note',
                                    [
                                               'attribute'=>'status',
                                               'contentOptions' => ['style' => 'vertical-align: middle','text-align:center'],
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
<?php 
  //$url_to_delete =  Url::to(['product/bulkdelete'],true);
  $this->registerJs('
    $(function(){
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
