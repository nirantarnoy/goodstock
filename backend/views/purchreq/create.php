<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Purchreq */

$this->title = Yii::t('app', 'สร้างใบขอซื้อ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ใบขอซื้อ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchreq-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
