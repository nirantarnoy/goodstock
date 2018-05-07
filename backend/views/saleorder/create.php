<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = Yii::t('app', 'สร้างใบขาย');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ใบขาย'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorder-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
