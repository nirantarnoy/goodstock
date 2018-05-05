<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Tradetable */

$this->title = Yii::t('app', 'สร้างข้อตกลงซื้อขาย');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ข้อตกลงซื้อขาย'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tradetable-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
