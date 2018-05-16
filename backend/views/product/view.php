<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->registerCss('
  .borderless td, .borderless th {
    border: none;
    padding: 5px;15px;5px;35px;
  }
');

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'สินค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
<div class="row">
      <div class="col-lg-12">
            <div class="btn-group">
                 <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i> แก้ไข'), ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-trash"></i> ลบ'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-default',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <div class="btn btn-default"><i class="fa fa-barcode"></i> พิมพ์บาร์โค้ด</div>
            </div>
            
      </div>
     </div>
<div class="row" style="margin-top: 5px;">
  <div class="col-lg-12">
 <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-cube"></i> รายละเอียดสินค้า <small><?= $model->name?></small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
           
           <div class="row">
               <div class="col-lg-4">
                   <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [
                         //   'id',
                            'product_code',
                            'name',
                            'description',
                            'barcode',
                           
                           [
                                'attribute'=>'product_type_id',
                                'value'=>function($data){
                                    return \backend\helpers\ProductType::getTypeById($data->product_type_id);
                                }
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
                            'min_stock',
                            'max_stock',
                            [
                                'attribute'=>'is_hold',
                                'format' => 'html',
                                'value'=>function($data){
                                    return $data->is_hold === 1 ? '<div class="label label-warning">ระงับการใช้งานชั่วคราว</div>':'<div class="label label-success">ใช้งานอยู่</div>';
                                }
                            ],
                            
                        ],
                    ]) ?>
                     <!-- <div class="btn btn-default" style="margin-top: 5px;"> ดูตามที่จัดเก็บ</div> -->
               </div>
               <div class="col-lg-4">
                   <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [
                         
                            'has_variant',
                            [
                                'attribute'=>'bom_type',
                                'value'=>function($data){
                                    return \backend\helpers\Bomtype::getTypeById($data->bom_type);
                                }
                            ],
                            [
                                'attribute'=>'cost',
                                'value'=>function($data){
                                    return $data->cost!=''?number_format($data->cost,0):0;
                                }
                            ],
                            [
                                'attribute'=>'price',
                                'value'=>function($data){
                                    return $data->price!=''?number_format($data->price,0):0;
                                }
                            ],
                            [
                                'attribute'=>'status',
                                'format' => 'html',
                                'value'=>function($data){
                                    return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
                                }
                            ],
                            [
                                'attribute'=>'created_at',
                                'value'=>function($data){
                                    return date('d-m-Y H:i',$data->created_at);
                                }
                            ],
                            [
                                'attribute'=>'updated_at',
                                'value'=>function($data){
                                    return date('d-m-Y H:i',$data->created_at);
                                }
                            ],
                            [
                                'attribute'=>'created_by',
                                'value'=>function($data){
                                    $name = \backend\models\User::getUserinfo($data->created_by);
                                    return $name!=null?$name->username:'';
                                }
                            ],
                            [
                                'attribute'=>'updated_by',
                                'value'=>function($data){
                                     $name = \backend\models\User::getUserinfo($data->updated_by);
                                    return $name!=null?$name->username:'';
                                }
                            ],
                        ],
                    ]) ?>
               </div>
               <div class="col-lg-4">
                <div class="row">
                       <div class="col-md-6 tile">
                          <span><b>จำนวนสินค้าทั้งหมด</b></span>
                          <h2><?=$model->all_qty!=""?number_format($model->all_qty):0?> <i class="fa fa-cube text-primary"></i></h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        <div class="col-md-6 tile">
                          <span><b>จำนวนสินค้าจอง</b></span>
                          <h2><?=$model->reserved_qty!=""?number_format($model->reserved_qty):0?> <i class="fa fa-lock text-danger"></i></h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        <div class="col-md-6 tile">
                          <span><b>จำนวนสินค้าใช้ได้</b></span>
                          <h2><?=$model->available_qty!=""?number_format($model->available_qty):0?> <i class="fa fa-unlock text-success"></i></h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                </div>
                <hr>
                <div class="row">
                       <div class="col-md-12 tile">
                          <span><b>มูลค่ารวม</b></span>
                          <h2><?=$model->all_qty!=""?number_format($model->all_qty * $model->cost):0?> บาท</h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                        </div>
                        
                </div>
                      
                    <i class="fa fa-warning"></i> <small class="text-danger"> คลิกดูรายการจำนวนสินค้าที่ตัวเลขจำนวน</small> 
               </div>
           </div>

       </div>
 </div>
</div>
</div>

 <div class="row">
   <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-asterisk"></i> ประวัติการทำรายการ <small>ล่าสุด</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">05</p>
                        <p class="day">10</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">SO180009</a>
                        <p>คุณสมบัติ, บางเขน กรุงเทพมหานคร.</p>
                      </div>
                    </article>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">05</p>
                        <p class="day">09</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">AD180012</a>
                        <p>Administrator, ปรับยอดสินค้าเข้าคลัง.</p>
                      </div>
                    </article>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">05</p>
                        <p class="day">09</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">AD180009</a>
                        <p>Administrator, ปรับยอดสินค้าเข้าคลัง.</p>
                      </div>
                    </article>
                     <article class="media event">
                      <a class="pull-left date">
                        <p class="month">05</p>
                        <p class="day">09</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">AD180008</a>
                        <p>Administrator, ปรับยอดสินค้าเข้าคลัง.</p>
                      </div>
                    </article>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month">04</p>
                        <p class="day">31</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">SO180002</a>
                        <p>คุณอนันต์, นาทม นครพนม.</p>
                      </div>
                    </article> 
                    <div class="x_footer pull-right">
                     <div class="btn btn-default"> ดูเพิ่มเติม</div>
                  </div>
                  </div>
                 
                </div>
              </div>
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-line-chart"></i> กราฟความเคลื่นไหว <small>ล่าสุด</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                  </div>
                </div>
              </div>
 </div>

 <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-image"></i> รูปภาพสินค้า </small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

       </div>
 </div>

</div>
