<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Jurusan;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Mhs */

$this->title = "nama mahasiswa: ".$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mhs-view box box-primary">

    <p>
        <?php if (User::isAdmin()): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            [
            'attribute' => 'id_jurusan',
            'value' => @$model->jurusan->nama,
            ],
            'nim',
             [
              'attribute' => 'foto',
              'format' =>'raw',
              'value' => function ($model){
                if ($model->foto != '') {
                    return Html::img('@web/upload/mhs/'. $model->foto,['class'=>'img-responsive','style' => 'height:200px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],
           
        ],
    ]) ?>

</div>

<div>&nbsp;</div>

<div class="box box-primary">

    <div class="box-header">
        <h3 class="box-title">Daftar Barang yang terkait.</h3>
    </div>
    
    <div class="box-body">

        <?= Html::a('<i class="fa fa-plus"> Tambah Peminjaman</i>', ['peminjaman/create', 'id_mhs' => $model->id], ['class' => 'btn btn-success']) ?>
        <div>&nbsp;</div>

        <table class="table">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>&nbsp;</th>
            </tr>
            <?php $no=1; ?>
            <?php $semuaPeminjaman = $model->findAllPeminjaman(); ?>
            <?php foreach ($semuaPeminjaman as $peminjaman): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= Html::a($peminjaman->inventarisBrg->nama_brg, ['peminjaman/view', 'id' => $peminjaman->id]); ?></td>
                <td>
                    <?= Html::a("<i class='fa fa-pencil'> Edit</i>",["buku/update","id"=>$peminjaman->id],['class' => 'btn btn-primary']) ?>&nbsp;
                    <?= Html::a("<i class='fa fa-trash'> Hapus</i>",["buku/delete","id"=>$peminjaman->id],['class' => 'btn btn-danger', 'data-method' => 'post', 'data-confirm' => 'Yakin hapus data ini?']) ?>&nbsp;
                </td>
            </tr>
            <?php $no++; endforeach ?>
        </table>

    </div>

</div>