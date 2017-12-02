<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Deliverytype */

$this->title = Yii::t('app', 'Create Deliverytype');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deliverytypes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deliverytype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
