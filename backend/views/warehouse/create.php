<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Warehouse */

$this->title = Yii::t('app', 'Create Warehouse');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Warehouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
