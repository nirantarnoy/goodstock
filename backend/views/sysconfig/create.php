<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sysconfig */

$this->title = Yii::t('app', 'Initial System Configurations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sysconfigs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sysconfig-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
