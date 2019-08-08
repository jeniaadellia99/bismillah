<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriBrg */

$this->title = 'Update Kategori Brg: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kategori Brgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kategori-brg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
