<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Usergroup */

$this->title = Yii::t('app', 'Update Usergroup: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usergroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="usergroup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
