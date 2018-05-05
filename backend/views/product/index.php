<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รหัสสินค้า');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
   <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
     <div class="row">
      <div class="col-lg-12">
            <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างรหัสสินค้าใหม่'), ['create'], ['class' => 'btn btn-success']) ?>
            <div class="btn-group pull-right">
              <div class="btn btn-default"><i class="fa fa-upload"></i> นำเข้า</div>
              <div class="btn btn-default"><i class="fa fa-download"></i> นำออก</div>
              <div class="btn btn-default"><i class="fa fa-trash"></i> ลบ</div>
              <div class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</div>
              <div class="btn btn-default"><i class="fa fa-barcode"></i> พิมพ์บาร์โค้ด</div>
              <div class="btn btn-default"><i class="fa fa-list"></i></div>
              <div class="btn btn-default"><i class="fa fa-th"></i></div>
            </div>
      </div>
     </div>
   
    <div class="x_panel">
                  <div class="x_title">
                    <h4><i class="fa fa-cubes"></i> <?=$this->title?> <small></small></h4>
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
                            <form id="form-perpage" class="form-inline" action="<?=Url::to(['product/index'],true)?>" method="post">
                              <div class="form-group">
                               <label>Show</label>
                                <select class="form-control" name="perpage" id="perpage">
                                   <option value="20" <?=$perpage=='20'?'selected':''?>>20</option>
                                   <option value="50" <?=$perpage=='50'?'selected':''?> >50</option>
                                   <option value="100" <?=$perpage=='100'?'selected':''?>>100</option>
                                </select>
                                <label>Per page</label>
                            </div>
                            </form>
                          </div>
                          <div class="col-lg-2">
                            <div class="form-inline pull-right">
                            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
                            </div>
                          </div>
                        </div>
                        <div class="table-responsive">

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'layout'=>'{items}{summary}{pager}',
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'vertical-align: middle']],

                         //   'id',
                             [
                                  'attribute'=>'product_code',
                                  'contentOptions' => ['style' => 'vertical-align: middle'],  
                             ],
                             [
                                  'attribute'=>'name',
                                  'contentOptions' => ['style' => 'vertical-align: middle'],  
                             ],
                             [
                                  'attribute'=>'unit_id',
                                  'contentOptions' => ['style' => 'vertical-align: middle'],  
                             ],
                             [
                                  'attribute'=>'category_id',
                                  'contentOptions' => ['style' => 'vertical-align: middle'],  
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
