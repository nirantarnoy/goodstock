<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Journal */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Journals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
