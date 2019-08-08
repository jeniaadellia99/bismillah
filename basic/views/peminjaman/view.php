<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\date\DatePicker;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = "Nama Peminjam:".@$model->id_mhs->nama;
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="peminjaman-view box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
             [
            'attribute' => 'id_inventaris_brg',
            'value' => $model->inventarisBrg->nama_brg,
            ],
             [
            'attribute' => 'id_dosen_staf',
            'value' => $model->dosenStaf->nama,
            ],
            [
            'attribute' => 'id_mhs',
            'value' => @$model->mhs->nama,
            ],
            [
                'label'=> 'Status',
                'value' =>function ($model){
                    if ($model->status == 1) {
                      return Html::a('<class="label label-danger"> label => "menunggu verifikasi"');
                    };
                    if ($model->status == 2) {
                        return "Approved";
                    };
                    if ($model->status == 3) {
                        return "Denied";
                    };
                }
            ],

            [
                'attribute' => 'tgl_pinjam',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_pinjam);
                },
            ],
            [

                'attribute' => 'tgl_kembali',
                'format' => 'raw',
                'value' => function($data) {
                    return Helper::getTanggalSingkat($data->tgl_kembali);
                },
            ],
            'keterangan',
        ],
    ]) ?>

</div>
