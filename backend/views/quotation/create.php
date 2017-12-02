<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Quotation */

$this->title = Yii::t('app', 'Create Quotation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quotations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quotation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
