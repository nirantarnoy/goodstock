<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tradetable */

$this->title = Yii::t('app', 'Create Tradetable');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tradetables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tradetable-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
