<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Paymentterm */

$this->title = Yii::t('app', 'Create Paymentterm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paymentterms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymentterm-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
