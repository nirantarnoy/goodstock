<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Deliverytype */

$this->title = Yii::t('app', 'สร้างช่องทางส่งสินค้า');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ช่องทางส่งสินค้า'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverytype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
