<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Quotation */

$this->title = Yii::t('app', 'Update Quotation: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quotations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="quotation-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
