<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrgSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventaris-brg-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'action' => ['site/dashboard'],
    ]); ?>

    <?= $form->field($model, 'pencarian_barang')->label(''); ?>

    <?php ActiveForm::end(); ?>

</div>
