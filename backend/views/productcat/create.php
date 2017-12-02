<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Productcat */

$this->title = Yii::t('app', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productcat-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
