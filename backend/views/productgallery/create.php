<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Productgallery */

$this->title = Yii::t('app', 'Create Productgallery');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productgalleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productgallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
