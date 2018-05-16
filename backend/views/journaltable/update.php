<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Journaltable */

$this->title = Yii::t('app', 'แก้ไขสมุดบันทึก: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'สมุดบันทึกรายวัน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="journaltable-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
