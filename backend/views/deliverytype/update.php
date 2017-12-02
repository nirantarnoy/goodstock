<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Deliverytype */

$this->title = Yii::t('app', 'Update Deliverytype: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deliverytypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="deliverytype-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
