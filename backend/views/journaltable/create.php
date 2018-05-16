<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Journaltable */

$this->title = Yii::t('app', 'สร้างสมุดบันทึก');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'สมุดบันทึกรายวัน'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journaltable-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
