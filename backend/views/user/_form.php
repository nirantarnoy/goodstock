<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

     <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-users"></i> <?=$this->title?> <small></small></h3>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                               <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left']]); ?>
                               <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อผู้ใช้ <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'username')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">กลุ่มผู้ใช้ <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?= $form->field($model, 'group_id')->widget(Select2::className(),[
                                        'data'=>ArrayHelper::map(\backend\models\Usergroup::find()->all(),'id','name'),
                                    ])->label(false) ?>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">สถานะ 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label(false) ?>
                                </div>
                              </div>

                               <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">สิทธิ์ใช้งาน 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'roles')->checkboxList($model->getAllRoles())->label(false) ?>
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
