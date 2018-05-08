<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

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
            <div class="btn-group pull-right">
              <div class="btn btn-default"><i class="fa fa-exclamation-triangle text-danger"></i> ปิดใช้งานชั่วคราว</div>
              <div class="btn btn-default"><i class="fa fa-play text-success"></i> เปิดใช้งาน</div>
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
               <div class="col-lg-6">
                   <?= DetailView::widget([
                        'model' => $model,
                       // 'options'=>['class'=>'table table-striped'],
                        'attributes' => [
                         //   'id',
                            'product_code',
                            'name',
                            'description',
                            'barcode',
                            'photo',
                            'product_type_id',
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
                            'has_variant',
                            'bom_type',
                            'cost',
                            'price',
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
                                    return date('d-m-Y',$data->created_at);
                                }
                            ],
                            [
                                'attribute'=>'updated_at',
                                'value'=>function($data){
                                    return date('d-m-Y',$data->created_at);
                                }
                            ],
                            'created_by',
                            'updated_by',
                        ],
                    ]) ?>
               </div>
                <div class="col-lg-6">
                    <table class="table table-striped">
                        <tr>
                            <td><?=$model->product_code;?></td>
                            <td></td>
                        </tr>
                    </table>
               </div>
           </div>

       </div>
 </div>

</div>
