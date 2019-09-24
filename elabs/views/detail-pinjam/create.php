<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPinjam */

$this->title = 'Tambah Barang';
$this->params['breadcrumbs'][] = ['label' => 'Detail Pinjams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pinjam-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
