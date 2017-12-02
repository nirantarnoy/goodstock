<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customergroup */

$this->title = Yii::t('app', 'Update Customergroup: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customergroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customergroup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
