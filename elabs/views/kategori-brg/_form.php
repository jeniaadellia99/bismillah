<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriBrg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-brg-form box box-primary">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
