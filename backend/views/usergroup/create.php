<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Usergroup */

$this->title = Yii::t('app', 'Create Usergroup');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usergroups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usergroup-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
