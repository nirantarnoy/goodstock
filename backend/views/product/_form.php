<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

      <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left']]); ?>
    <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-institution"></i> <?=$this->title?> <small></small></h3>
                    <ul class="nav navbar-right panel_toolbox" style="margin-top: -40px;">
                      <li><?php echo $form->field($model, 'is_hold')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label() ?>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                         <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Product Infomation</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Product Variants</a>
                        </li>
                       <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Product Structure</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Movement Transaction</a>
                            </li>
                        </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-lg-7">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Code <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'product_code')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'description')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Barcode <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'barcode')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Gategory <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'category_id')->widget(Select2::className(),[
                                                      'data' => ArrayHelper::map(backend\models\Productcat::find()->all(),'id','name'),
                                                      'options' => ['placeholder'=>'เลือกกลุ่มสินค้า']
                                                   ])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Type <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'product_type_id')->widget(Select2::className(),[
                                                      'data' => ArrayHelper::map(backend\models\Productcat::find()->all(),'id','name'),
                                                      'options' => ['placeholder'=>'เลือกกลุ่มสินค้า']
                                                   ])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Unit <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'unit_id')->widget(Select2::className(),[
                                                      'data' => ArrayHelper::map(backend\models\Unit::find()->all(),'id','name'),
                                                      'options' => ['placeholder'=>'เลือกหน่วยนับ']
                                                   ])->label(false) ?>
                                            </div>
                                          </div>
                                          <hr />
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Minimum Stock <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'min_stock')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Maximum Stock <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'max_stock')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                     
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bom Type <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'bom_type')->widget(Select2::className(),[
                                                      'data' => ArrayHelper::map(backend\helpers\Bomtype::asArrayObject(),'id','name'),
                                                      'options' => ['placeholder'=>'เลือกประเภทโครงสร้างสินค้า']
                                                   ])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Cost <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'cost')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'price')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label(false) ?>
                                            </div>
                                          </div>

                                </div>
                                 <div class="col-lg-5">
                                     <div class="row">

                                      <p>Photo</p>

                                      <div class="col-lg-12">
                                        <div class="thumbnail">
                                          <div class="image view view-first">
                                           <!--  <img style="width: 100%; display: block;" src="../../web/uploads/img/civic.jpg" alt="image" /> -->
                                            <?=Html::img('@web/uploads/img/civic.jpg',['style'=>'width: 50% ;display: block;'])?>
                                          </div>
                                    
                                        </div>
                                      </div>
                                  </div>
                                     <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>
                                      <div class="row">

                                      <p>Additional photo</p>

                                      <div class="col-sm-4">
                                        <div class="thumbnail">
                                          <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                                            <div class="mask">
                                              <p>Your Text</p>
                                              <div class="tools tools-bottom">
                                                <a href="#"><i class="fa fa-eye"></i></a>
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <a href="#"><i class="fa fa-times"></i></a>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="caption">
                                            <p>Snow and Ice Incoming for the South</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="thumbnail">
                                          <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                                            <div class="mask">
                                              <p>Your Text</p>
                                              <div class="tools tools-bottom">
                                                <a href="#"><i class="fa fa-link"></i></a>
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <a href="#"><i class="fa fa-times"></i></a>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="caption">
                                            <p>Snow and Ice Incoming for the South</p>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                        <div class="thumbnail">
                                          <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="images/media.jpg" alt="image" />
                                            <div class="mask">
                                              <p>Your Text</p>
                                              <div class="tools tools-bottom">
                                                <a href="#"><i class="fa fa-link"></i></a>
                                                <a href="#"><i class="fa fa-pencil"></i></a>
                                                <a href="#"><i class="fa fa-times"></i></a>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="caption">
                                            <p>Snow and Ice Incoming for the South</p>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                            </div>
                            
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk aliquip</p>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
                            booth letterpress, commodo enim craft beer mlkshk </p>
                        </div>
                      </div>
                    </div>

                        

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>

    <?php ActiveForm::end(); ?>

</div>
