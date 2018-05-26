<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;

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
          <div class="pull-right">
              <a href="<?=Url::to(['product/index'],true)?>"><div class="btn btn-default">กลับ <i class="fa fa-arrow-right"></i> </div></a>
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
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-image"></i> รูปภาพสินค้า </small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-lg-2">
                    <?php  $form = \yii\widgets\ActiveForm::begin(['action' => Url::to(['product/uploadphoto'],true)],['options' =>['enctype'=>'multipart/form-data']]);?>
                    <?=$form->field($uploadfile,'file[]')->fileInput(['class'=>'form-control','multiple'=>'multiple','accept'=>'image/*'])->label(false);?>
                    <input type="hidden" name="product_id" value="<?=$model->id;?>">
                    <input type="submit" class="btn btn-primary" value="Upload">
                    <?php \yii\widgets\ActiveForm::end();?>
                </div>
                <div class="col-lg-10" style="float: left;">
                    <?php foreach($photoes as $value):?>
                        <div class="card">
                            <img src="<?= Yii::$app->request->baseUrl ?>/uploads/gallery/<?=$value->photo?>" alt="Avatar" style="width:100%">
                            <div class="card-container">
                                <p><?=$value->photo?></p>
                                <a href="<?=Url::to(['product/deletephoto','id'=>$value->id,'prodid'=>$model->id],true)?>" class="btn btn-danger"><i class="fa fa-trash"></i> </a>
                            </div>
                        </div>
                    <?php endforeach;?>
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
                      <div class="row">
                          <div class="col-lg-6">
                            <?php

                              echo '<div class="drp-container">';
                                  echo DateRangePicker::widget([
                                  'name'=>'date_range_2',
                                  'presetDropdown'=>true,
                                  'hideInput'=>true
                                  ]);
                                  echo '</div>';
                                  ?>
                          </div>
                      </div>
                      <?php foreach($modeljournalline as $data):?>
                    <article class="media event">
                      <a class="pull-left date">
                        <p class="month"><?=date('m',$data->created_at)?></p>
                        <p class="day"><?=date('d',$data->created_at)?></p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#"><?=$data->journal_id?></a>
                          <p>ประเภทรายการ : <label class="label-info" style="padding: 0px 5px 0px 5px;color: #fff;">Adjustment</label> ประเภทสต๊อก : <label class="label-success" style="padding: 0px 5px 0px 5px;color: #fff;"> เข้า </label>        จำนวน : <b><?=number_format($data->qty,0)?></b></p>
                          <p>ดำเนินการโดย : </p>
                      </div>
                    </article>
                          <hr>
                    <?php endforeach;?>
                    <div class="x_footer pull-right">
                        <?php if(count($modeljournalline)>0):?>
                     <div class="btn btn-default"> ดูเพิ่มเติม</div>
                        <?php endif;?>
                  </div>
                  </div>
                 
                </div>
              </div>
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-line-chart"></i> ภาพรวมยอดขาย</h2>
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



</div>

<?php $this->registerCss('
   .card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    width: 20%;
    float: left;
    margin: 5px;
    }
    
    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .card-container {
        padding: 2px 16px;
    }
');?>
