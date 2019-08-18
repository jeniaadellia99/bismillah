<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pengembalian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengembalian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pinjam')->textInput() ?>

    <?= $form->field($model, 'tgl_kembali')->textInput() ?>

    <?= $form->field($model, 'kondisi')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
