<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Quotation */

$this->title = Yii::t('app', 'สร้างใบเสนอราคา');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ใบเสนอราคา'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
