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
            </div>
            
      </div>
     </div><br/>
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
               </div>
               <div class="col-lg-6">
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
                                    return \backend\models\User::getUserinfo($data->created_by)->username;
                                }
                            ],
                            [
                                'attribute'=>'updated_by',
                                'value'=>function($data){
                                     return \backend\models\User::getUserinfo($data->updated_by)->username;
                                }
                            ],
                        ],
                    ]) ?>
               </div>
           </div>

       </div>
 </div>

</div>
