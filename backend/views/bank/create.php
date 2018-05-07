<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Bank */

$this->title = Yii::t('app', 'สร้างชื่อธนาคาร');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ธนาคาร'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
