<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'group_id')->textInput() ?>
    <?= $form->field($model, 'status')->textInput() ?>
    <div class="row">
    	<div class="col-lg-2">
    		 <?= $form->field($model, 'roles')->checkboxList($model->getAllRoles()) ?>
    	</div>
    </div>
   

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
