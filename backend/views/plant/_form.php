<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use common\models\Province;
use common\models\Amphur;
use common\models\District;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */
/* @var $form yii\widgets\ActiveForm */

$prov = Province::find()->all();
$amp = Amphur::find()->all();
$dist = District::find()->all();

?>



<div class="plant-form">
    <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-institution"></i> <?=$this->title?> <small></small></h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                        <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left']]); ?>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ชื่อร้าน')?> <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                               <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ชื่อย่อ')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'short_name')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                               <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ชื่อภาษาอังกฤษ')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'eng_name')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                               <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','รายละเอียด')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'description')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                             <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','เลขประจำตัวผู้เสียภาษี')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'tax_id')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                                <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','อีเมล์')?>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'email')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                                <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','มือถือ')?>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'mobile')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                                <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','โทร')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'phone')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                               <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','เว็บไซต์')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'website')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
         
                                <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','Facebook')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'facebook')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                                <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','Line')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'line')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                                <div class="form-group" style="margin-top: -10px">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','โลโก้')?> 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'logo')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
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
                                          $.post("index.php?r=plant/showdistrict&id=' . '"+$(this).val(),function(data){
                                          $("select#district").html(data);
                                          $("select#district").prop("disabled","");

                                        });
                                           $.post("index.php?r=plant/showzipcode&id=' . '"+$(this).val(),function(data){
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
                                          $.post("index.php?r=plant/showcity&id=' . '"+$(this).val(),function(data){
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
                                <div class="row">
                                   <div class="col-lg-12">
                                      <div class="form-group" style="margin-top: -10px">
                                        
                                        <div class="control-label col-md-3 col-sm-3 col-xs-12 btn-addbank"><i class="fa fa-plus"></i> เพิ่มบัญชี</div>
                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                        </div>
                                      </div>
                                   </div>
                                </div>
                            <div class="ln_solid"></div>
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                                </div>
                        </div>
  
    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>

<div id="bankModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> เพิ่มบัญชีธนาคาร <small id="items"> </small></h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-lg-12">
             
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>

<?php
  $this->registerJs('
        $(function(){
            $(".btn-addbank").click(function(){
              $("#bankModal").modal("show");
            });
        });
    ',static::POS_END);
 ?>
