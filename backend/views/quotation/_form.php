<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Quotation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quotation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quotation_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'require_date')->textInput() ?>

    <?= $form->field($model, 'customer_id')->textInput() ?>

    <?= $form->field($model, 'customer_ref')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'approve_status')->textInput() ?>

    <?= $form->field($model, 'approve_by')->textInput() ?>

    <?= $form->field($model, 'approve_date')->textInput() ?>

    <?= $form->field($model, 'total_amount')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
