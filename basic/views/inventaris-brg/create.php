<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrg */

$this->title = 'Tambah Inventaris Barang';
$this->params['breadcrumbs'][] = ['label' => 'Inventaris Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventaris-brg-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
