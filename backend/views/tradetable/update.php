<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tradetable */

$this->title = Yii::t('app', 'แก้ไขข้อตกลงซื้อขาย: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อตกลงซื้อขาย'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tradetable-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
