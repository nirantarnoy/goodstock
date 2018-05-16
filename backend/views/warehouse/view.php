<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Warehouse */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'คลังสินค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('
  .borderless td, .borderless th {
    border: none;
    padding: 5px;15px;5px;35px;
  }
');
?>
<div class="warehouse-view">
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
        <div class="btn btn-default"><i class="fa fa-print"></i> พิมพ์</div>
            </div>
            
      </div>
     </div>

     <div class="x_panel" style="margin-top: 5px;">
        <div class="x_title">
            <h3><i class="fa fa-institution"></i> รายละเอียดคลังสินค้า <small><?= $model->name?></small></h3>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-lg-4">
                      <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [
                           // 'id',
                            'name',
                            'description',
                             [
                                'attribute'=>'is_primary',
                                'format' => 'html',
                                'value'=>function($data){
                                    return $data->is_primary === 1 ?'<div class="label label-success">คลังสินค้าหลัก</div>':'<div class="label label-default">ไม่ใช่</div>';
                                }
                            ],
                            
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-4">
                      <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [
                           // 'id',
                           
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
                           
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-4">
                      <?= DetailView::widget([
                        'model' => $model,
                        'options'=>['class'=>'borderless'],
                        'attributes' => [
                          
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
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-12">
                      <div class="col-md-4 tile">
                          <span><b>จำนวนสินค้าทั้งหมด</b></span>
                          <h2>809 </i></h2>
                        
                          <div class="btn btn-default"> ดูรายการสินค้า</div>
                        </div>
                        <div class="col-md-4 tile">
                          <span><b>มูลค่าสินค้า</b></span>
                          <h2>231,809 บาท</i></h2>
                          <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
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
                  </div>
                  <div class="x_footer pull-right">
                     <div class="btn btn-default"> ดูเพิ่มเติม</div>
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

</div>
