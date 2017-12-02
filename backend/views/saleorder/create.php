<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = Yii::t('app', 'Create Saleorder');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Saleorders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
