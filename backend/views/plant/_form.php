<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="plant-form">
    <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-institution"></i> <?=$this->title?> <small></small></h3>
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
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                  <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                                </div>
                        </div>
  
    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
