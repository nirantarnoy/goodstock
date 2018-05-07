<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Purchtable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="purchtable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'purch_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'purch_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vendor_id')->textInput() ?>

    <?= $form->field($model, 'delivery_to')->textInput() ?>

    <?= $form->field($model, 'discount_amt')->textInput() ?>

    <?= $form->field($model, 'discount_per')->textInput() ?>

    <?= $form->field($model, 'confirm_status')->textInput() ?>

    <?= $form->field($model, 'require_date')->textInput() ?>

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
