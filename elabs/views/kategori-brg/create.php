<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KategoriBrg */

$this->title = 'Tambah Kategori Barang';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-brg-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
