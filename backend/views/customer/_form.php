<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

use common\models\Province;
use common\models\Amphur;
use common\models\District;
use common\models\Bank;
use yii\helpers\Url;

$prov = Province::find()->all();
$amp = Amphur::find()->all();
$dist = District::find()->all();
$bank = Bank::find()->all();
/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-user"></i> <?=$this->title?> <small></small></h3>
                    <!-- <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
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
                    <br />
                               <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left']]); ?>
                               <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">รหัสลูกค้า <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'customer_code')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                                <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อลูกค้า <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">รายละเอียด 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'description')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">กลุ่มลูกค้า <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'customer_group_id')->widget(Select2::className(),[
                                      'data' => ArrayHelper::map(backend\models\Customergroup::find()->all(),'id','name'),
                                      'options' => ['placeholder'=>'เลือกกลุ่มลูกค้า']
                                   ])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">วิธีชำระเงิน 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'payment_type')->widget(Select2::className(),[
                                      'data' => ArrayHelper::map(backend\models\Paymenttype::find()->all(),'id','name'),
                                      'options' => ['placeholder'=>'เลือกประเภทชำระเงิน']
                                   ])->label(false) ?>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">พนักงานขาย 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'sale_id')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                          
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">สถานะ 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label(false) ?>
                                </div>
                              </div>


                              <div class="ln_solid"></div>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ที่อยู่')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'address')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ถนน')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'street')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ตำบล')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'district_id')->widget(Select2::className(),
                                    [
                                     'data'=> ArrayHelper::map($dist,'DISTRICT_ID','DISTRICT_NAME'),
                                    'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'district','disabled'=>'disabled'],
                                    ]

                                  )->label(false) ?> 
                                </div>
                              </div>
                              <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','อำเภอ')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                   <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'city_id')->widget(Select2::className(),
                                    [
                                     'data'=> ArrayHelper::map($amp,'AMPHUR_ID','AMPHUR_NAME'),
                                    'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'city','disabled'=>'disabled',
                                          'onchange'=>'
                                          $.post("'.Url::to(['plant/showdistrict/'],true).'"+"/"+$(this).val(),function(data){
                                          $("select#district").html(data);
                                          $("select#district").prop("disabled","");

                                        });
                                           $.post("'.Url::to(['plant/showzipcode/'],true).'"+"/"+$(this).val(),function(data){
                                                $("#zipcode").val(data);
                                              });
                                       '
                                    ],
                                    'pluginOptions'=>[
                                        'allowClear'=>true,
                                      ]
                                    ]

                                  )->label(false) ?>   
                                </div>
                              </div>
                              <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','จังหวัด')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  
                                   <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'province_id')->widget(Select2::className(),
                                    [
                                     'data'=> ArrayHelper::map($prov,'PROVINCE_ID','PROVINCE_NAME'),
                                     'options'=>['maxlength' => true,'class'=>'form-control form-inline','id'=>'province',
                                       'onchange'=>'
                                          $.post("'.Url::to(['plant/showcity/'],true).'"+"/"+$(this).val(),function(data){
                                          $("select#city").html(data);
                                          $("select#city").prop("disabled","");

                                        });
                                       '
                                    ],
                                    ]

                                  )->label(false) ?>
                                
                                </div>
                              </div>
                              <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','รหัสไปรษณีย์')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?php if($model_address_plant):?>
                                        <?= $form->field($model_address_plant, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','style'=>'width: 20%;','readonly'=>'readonly'])->label(false) ?>
                                   <?php else:?>
                                        <?= $form->field($model_address, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','style'=>'width: 20%;','readonly'=>'readonly'])->label(false) ?>
                                   <?php endif;?>
                                  
                                </div>
                              </div>
                          </div>
                        </div>
                          

                             <div class="ln_solid"></div>
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
                                </div>
                        </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

</div>
