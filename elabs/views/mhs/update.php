<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mhs */

$this->title = 'Edit mahasiswa: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mhs-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
