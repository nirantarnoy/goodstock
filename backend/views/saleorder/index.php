<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaleorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Saleorders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorder-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Saleorder'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="x_panel">
                  <div class="x_title">
                    <h4><i class="fa fa-money"></i> <?=$this->title?> <small></small></h4>
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
                            <form id="form-perpage" class="form-inline" action="<?=Url::to(['saleorder/index'],true)?>" method="post">
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
                                    ['class' => 'yii\grid\SerialColumn'],

                                   // 'id',
                                    'sale_no',
                                    'revise',
                                    'require_date',
                                    'customer_id',
                                    //'customer_ref',
                                    //'delvery_to',
                                    //'currency',
                                    //'sale_id',
                                    //'disc_amount',
                                    //'disc_percent',
                                    //'total_amount',
                                    //'quotation_id',
                                    //'note',
                                    //'status',
                                    //'created_at',
                                    //'updated_at',
                                    //'created_by',
                                    //'updated_by',

                                    ['class' => 'yii\grid\ActionColumn'],
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