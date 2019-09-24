<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lab */

$this->title = 'Update Lab: ' . $model->int;
$this->params['breadcrumbs'][] = ['label' => 'Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->int, 'url' => ['view', 'id' => $model->int]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lab-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
