<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PemakaianLabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemakaian-lab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_lab') ?>

    <?= $form->field($model, 'nama_lab') ?>

    <?= $form->field($model, 'mata_kuliah') ?>

    <?= $form->field($model, 'waktu_mulai') ?>

    <?php // echo $form->field($model, 'waktu_selesai') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
