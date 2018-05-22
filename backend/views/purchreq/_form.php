<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Purchreq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchreq-form">
     <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left']]); ?>

   <div class="row">
        <div class="col-lg-8">
           <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-cubes"></i> ข้อมูลขอซื้อ <small></small></h3>
                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />

                          <div class="row">
                              <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-12" for="first-name">เลขที่ใบขอซื้อ <span class="required">*</span>
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'purchreq_no')->textInput(['maxlength' => true,'class'=>'form-control','disabled'=>'disabled'])->label(false) ?>
                                        </div>
                                    </div>
                              </div>
                              <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-12" for="first-name">วันที่ต้องการ 
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'require_date')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                                    </div>
                              </div>
                          </div>
                      
                          <div class="row">
                              <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-12" for="first-name">
                                        ผู้ขอซื้อ 
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'request_by')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                                    </div>
                              </div>
                              
                          </div>
                           <div class="row">
                              <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-12" for="first-name">
                                        เหตุผลขอซื้อ 
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'reason')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                                    </div>
                              </div>
                              <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-12" for="first-name">
                                        บันทึก 
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'note')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                                    </div>
                              </div>
                              
                          </div>

                        


                            <?= $form->field($model, 'total_amount')->textInput() ?>


                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                            </div>
                                                   
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
           <div class="x_panel">
                  <div class="x_title">
                    <h3><i class="fa fa-cubes"></i> สถานะใบขอซื้อ <small></small></h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                           <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-12" for="first-name">
                                        อนุมัติ 
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'approve_status')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                            </div>

                            <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-12" for="first-name">
                                        อนุมัติโดย
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'approve_by')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                            </div>
                            <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-12" for="first-name">
                                        วันที่อนุมัติ
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'approve_date')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                            </div>
                            <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-12" for="first-name">
                                        สถานะ
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                           <?= $form->field($model, 'status')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                        </div>
                            </div>

                           
                                                   
                        </div>
                    </div>
       </div>
       </div>
       <div class="row">
           <div class="col-lg-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="btn btn-default btn_addline"><i class="fa fa-plus"></i> เลือกรหัส</div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    
                    <table class="table table_line">
                        <thead>
                            <tr>
                                <th></th>
                                <th>รหัสสินค้า</th>
                                <th>ชื่อ</th>
                                <th>จำนวน</th>
                                <th>ราคา</th>
                                <th>รวม</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                      <!--   <tfoot>
                            <p>รวมทั้งสิ้น</p>
                        </tfoot> -->
                    </table>
                           
                                                   
                        </div>
                    </div>
           </div>
       </div>
   
     

    <?php ActiveForm::end(); ?>

</div>
<?php 
   $url_to_addline = Url::to(['purchreq/addline'],true);
   $this->registerJs('
    $(function(){
       $(".btn_addline").click(function(){
          $.ajax({
          type:"post",
          dataType:"html",
          url: "'.$url_to_addline.'",
          data:{data: null},
          success: function(data){
             $(".table_line tbody").append(data);
          }
        });
       });
    });

    function removeline(e){
        if(confirm("Are you sure to delete")){
            e.parent().parent().remove();
        }
    }
',static::POS_END);?>