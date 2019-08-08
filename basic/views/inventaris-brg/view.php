<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\KategoriBrg;


/* @var $this yii\web\View */
/* @var $model app\models\InventarisBrg */

$this->title = $model->nama_brg;
$this->params['breadcrumbs'][] = ['label' => 'Inventaris Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);?>
<div class="inventaris-brg-view box box-primary">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger','data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post',],]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kode_brg',
            'nama_brg',
             [
            'attribute' => 'id_kategori_brg',
            'value' => $model->kategoriBrg->nama,
            ],
            'jumlah_brg',
           [
            'attribute'=>'foto',
            'format'=>'raw',
            'value'=>function($model)
            {
                if ($model->foto != '') {
                    return Html::img('@web/upload/barang/'. $model->foto, ['class'=>'img-responsive', 'style'=>'height:500px']);
                }else{
                    return Html::img('@web/upload/no-images.png', ['class'=>'img-responsive', 'style'=>'height:500px']);
                }
            },
        ],
        ],
    ]) ?>

</div>
