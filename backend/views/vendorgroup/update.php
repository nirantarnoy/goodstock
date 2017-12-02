<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Vendorgroup */

$this->title = Yii::t('app', 'Update Vendorgroup: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vendorgroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="vendorgroup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
