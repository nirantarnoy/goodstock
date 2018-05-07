<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Purchtable */

$this->title = Yii::t('app', 'สร้างใบสั่งซื้อ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ใบสั่งซื้อ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchtable-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
