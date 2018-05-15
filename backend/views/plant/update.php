<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = Yii::t('app', 'ร้านค้า/หน่วยงาน: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ร้านค้า/หน่วยงาน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="plant-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_address' => $model_address,
        'model_address_plant' => $model_address_plant,
        'model_bankdata' => $model_bankdata,
    ]) ?>

</div>
