<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use lavrentiev\widgets\toastr\Notification;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UsergroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usergroups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usergroup-index">
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
                "positionClass" => "toast-top-right",
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

    <p>
        <?= Html::a(Yii::t('app', 'Create Usergroup'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="x_panel">
                  <div class="x_title">
                    <h4><i class="fa fa-users"></i> <?=$this->title?> <small></small></h4>
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
                            <form id="form-perpage" class="form-inline" action="<?=Url::to(['usergroup/index'],true)?>" method="post">
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
                            'layout'=>"{items}{summary}{pager}",
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                              //  'id',
                                'name',
                                'description',
                               
                                [
                                   'attribute'=>'created_at',
                                   'format' => 'html',
                                   'value'=>function($data){
                                     return "<i class='fa fa-clock-o'></i>"." ". date('d-m-Y',$data->created_at);
                                   }
                                 ],
                                //'updated_at',
                                //'created_by',
                                //'updated_by',
                              [
                                   'attribute'=>'status',
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
