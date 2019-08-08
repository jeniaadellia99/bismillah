<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\KategoriBrg;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarisBrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventaris Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventaris-brg-index box box-primary">
    <div class="box-body table-responsive">

 <div class="box-header">
        <?= Html::a('Tambah Inventaris Barang', ['create'], ['class' => 'btn btn-success']) ?>
     
    </div>

  

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
              
                'attribute' => 'nama_brg',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
            [
               'attribute' =>'id_kategori_brg',
               'filter' => KategoriBrg::getList(),
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
               'value' => function($data){
                return @$data->kategoriBrg->nama;
               }
           ],
           [
              
                'attribute' => 'jumlah_brg',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
            [
                    'attribute' => 'foto',
                     'headerOptions' => ['style' => 'text-align:center'],
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->foto != '') {
                            return Html::img('@web/upload/barang/' . $model->foto, ['class' => 'img-responsive', 'style' => 'height:100px']);
                        } else { 
                            return '<div align="center"><h1>No Image</h1></div>';
                        }
                    },
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
</div>