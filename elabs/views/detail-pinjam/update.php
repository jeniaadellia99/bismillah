<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetailPinjam */

$this->title = 'Update Barang: ' . $model->peminjaman->tgl_pinjam;
$this->params['breadcrumbs'][] = ['label' => 'Detail Pinjam', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_detail_pinjam, 'url' => ['view', 'id' => $model->id_detail_pinjam]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="detail-pinjam-update">

  <!--   <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
