<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Paymenttype */

$this->title = Yii::t('app', 'Create Paymenttype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Paymenttypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paymenttype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
