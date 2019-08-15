<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\InventarisBrg;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailPinjamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Pinjams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-pinjam-index">

    <h1><?= Html::encode($this->title) ?></h1>

   <?= Html::a('Tambah barang', ['create'], ['class' => 'btn btn-success']) ?>

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

            'id_pinjam',
             [
                'attribute' =>'id_inventaris_brg',
              'filter' => InventarisBrg::getList(),
              'headerOptions' => ['style' => 'text-align:center;'],
              'contentOptions' => ['style' => 'text-align:center'],
              'value' => function($data){
                return @$data->inventarisBrg->nama_brg;
               }
            ],
             [
                    'label' => 'tambah',
                   
                ],

           [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{update}',
                        'buttons' => [
                            'kembalikan' => function($url, $model, $key) {
                                return Html::a('<button class="btn btn-primary glyphicon glyphicon-download-alt"></button>', ['create', $model->id_pinjam], ['data' => ['confirm' => 'Apa anda yakin ingin memberi barang ini?'],]);
                            }
                        ]
                    ],
        ],
    ]); ?>
</div>
