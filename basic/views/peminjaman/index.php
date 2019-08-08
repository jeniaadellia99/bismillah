<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\InventarisBrg;
use app\models\DosenStaf;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Peminjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.',
                'headerOptions' => ['style' => 'text-align:center'],
                'contentOptions' => ['style' => 'text-align:center']
            ],
             [
               'attribute' =>'id_dosen_staf',
               'filter' => DosenStaf::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->dosenStaf->nama;
               }
           ],
             [
               'attribute' =>'id_inventaris_brg',
               'filter' => InventarisBrg::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->inventarisBrg->nama_brg;
               }
           ],
            'id_mhs',
            'keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
