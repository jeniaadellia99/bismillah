<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrg */

$this->title = 'Tambah Inventaris Barang';
$this->params['breadcrumbs'][] = ['label' => 'Inventaris Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventaris-brg-create">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
