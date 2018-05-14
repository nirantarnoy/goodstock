<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

use common\models\Province;
use common\models\Amphur;
use common\models\District;
use common\models\Bank;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */
/* @var $form yii\widgets\ActiveForm */

$prov = Province::find()->all();
$amp = Amphur::find()->all();
$dist = District::find()->all();
$bank = Bank::find()->all();

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
                           <input type="hidden" class="has_edit" name="has_edit" value="">
                           <input type="hidden" class="has_remove" name="has_remove[]" value="">
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
                                <div class="row">
                                   <div class="col-lg-12">
                                      <div class="form-group" style="margin-top: -10px">
                                        
                                        <div class="control-label col-md-3 col-sm-3 col-xs-12 btn-addbank" style="cursor: pointer;"><i class="fa fa-plus"></i> เพิ่มบัญชี</div>
                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                        </div>
                                      </div>
                                   </div>
                                </div>
                            


                      <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                          <table class="table table-bank">
                            <tbody class="banklist">
                              <?php if(!$model->isNewRecord):?>
                                  <?php foreach($model_bankdata as $value):?>
                                    <tr id="shop-bank-id">
                                      <td style="vertical-align: middle;">
                                        <?= Html::img('@web/uploads/logo/'.\backend\models\Bank::getLogo($value->bank_id),['style'=>'width: 15%;']);?>
                                        <input type="hidden" class="bank_id" name="bank_id[]" value="<?= $value->bank_id;?>"/>
                                        <input type="hidden" class="rec_id" name="rec_id[]" value="<?= $value->id;?>"/>
                                      </td>
                                      <td style="vertical-align: middle;"><?= \backend\models\Bank::getBankName($value->bank_id);?></td>
                                      
                                     <td style="vertical-align: middle;">
                                      <?= $value->account_no;?>
                                      <input type="hidden" class="account_no" id="account_no" name="account_no[]" value="<?= $value->account_no;?>"/>
                                    </td>
                                    <td style="vertical-align: middle;">
                                      <?= $value->account_name;?>
                                      <input type="hidden" class="account_name" id="account_name" name="account_name[]" value="<?= $value->account_name;?>"/>
                                    </td>
                                     <td style="vertical-align: middle;">
                                      <?= \backend\helpers\AccountType::getTypeById($value->account_type_id);?>
                                      <input type="hidden" class="account_type" name="account_type[]" value="<?= $value->account_type_id;?>"/>
                                    </td>
                                      
                                    <td class="action" style="vertical-align: middle;">
                                        <a class="btn btn-white edit-line" onClick="bankEdit($(this));" href="javascript:void(0);"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-white remove-line" onClick="bankRemove($(this));" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
                                      </td>
                                  </tr>
                                  <?php endforeach;?>
                               <?php endif;?>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-lg-2"></div>
                      </div>
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
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-shopping-cart"></i> เพิ่มบัญชีธนาคาร <small id="items"> </small></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <table style="text-align: center;">
              <tr >
               <td style="width: 10%;"></td>
                <td style="padding: 15px 0px 0px 25px; "><b>ธนาคาร</b></td>
                <td style="padding: 15px 0px 0px 15px;">
                  <!-- <input type="text" class="form-control" name="account_no" value=""> -->
                  <?= Select2::widget([
                     'name'=>'bank',
                     'data'=> ArrayHelper::map($bank,'id',function($data){
                        return $data->short_name.' '.$data->name;
                     }),
                     'options'=>['placeholder'=>'เลือกธนาคาร','id'=>'select-bank']

                  ]); 
                  ?>
                </td>
              </tr>
              <tr >
                <td style="width: 10%;"></td>
                <td style="padding: 15px 0px 0px 25px;"><b>ชื่อบัญชี</b></td>
                <td style="padding: 15px 0px 0px 15px;">
                  <input type="text" class="form-control" id="select-account-name" name="name" value="">
                </td>
              </tr>
              <tr >
                 <td style="width: 10%;"></td>
                <td style="padding: 15px 0px 0px 25px;"><b>เลขที่บัญชี</b></td>
                <td style="padding: 15px 0px 0px 15px;">
                  <input type="text" class="form-control" id="select-account-no" name="account_no" value="">
                </td>
              </tr>
              <tr >
                <td style="width: 10%;"></td>
                <td style="padding: 15px 0px 0px 25px;"><b>ประเภทบัญชี</b></td>
                <td style="padding: 15px 0px 0px 15px;">
                   <?= Select2::widget([
                     'name'=>'account_type',
                     'data'=> ArrayHelper::map(\backend\helpers\AccountType::asArrayObject(),'id','name'),
                     'options'=>['placeholder'=>'เลือกประเภทบัญชี','id'=>'select-account-type']

                  ]); 
                  ?>
                </td>
              </tr>
              <tr >
                 <td style="width: 10%;"></td>
                <td style="padding: 15px 0px 0px 15px;"><b>รายละเอียด</b></td>
                <td style="padding: 15px 0px 0px 15px;">
                  <textarea class="form-control" id="select-description" value=""></textarea>
                </td>
              </tr>
            </table>
             
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-add-bank">บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>

  </div>
</div>

<?php
  $this->registerJs('
        $(function(){
            var rem_id = [];

            $(".btn-addbank").click(function(){
              $("#bankModal").modal("show");
            });
            $(".btn-add-bank").click(function(){
               var type = $("#select-bank").val();
                  var account_no = $("#select-account-no").val();
                  var account_name = $("#select-account-name").val();
                  var brances = $("#brance").val();
                  var act_type = $("#select-account-type option:selected").val();
                  var bank_text = $("#select-bank option:selected").text();
                  var bank_desc = $("#select-description").val();
                 //alert(account_name);return;
                    $.ajax({
                           type: "POST",
                           dataType: "html",
                          url: "'.Url::toRoute(['/plant/addbank'], true).'",
                          data: { txt: bank_text,id: type,account: account_no,brance: brances,account_type: act_type,desc: bank_desc,account_name: account_name},
                          success: function(data){
                            //alert(data);
                                  $(".banklist").append(data);
                                }
                      });
                  $("#bankModal").modal("hide");
            });
        });
        function bankRemove(e){
              if(confirm("ต้องการลบรายการนี้ใช่หรือไม่")){
                  var bid = e.closest("tr").find(".bank_id").val();
                  e.parents("tr").remove();
                  $(".has_edit").val(1);
              }
        }
        function bankEdit(e){
            $("#bankModal").modal("show");

            var bankid = e.closest("tr").find(".bank_id").val();
            var acttype = e.closest("tr").find(".account_type_id").val();
            var actno = e.closest("tr").find(".account_no").val();
            var actname = e.closest("tr").find(".account_name").val();
            
            $("#select-account-name").val(actname);
            $("#select-account-no").val(actno);
            $("#select-bank").val(bankid).change();
            $("#select-account-type").val(acttype).change();

            $(".has_edit").val(1);
        }
    ',static::POS_END);
 ?>
