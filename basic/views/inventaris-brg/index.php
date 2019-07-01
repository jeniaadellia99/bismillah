<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventarisBrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventaris Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventaris-brg-index box box-primary">

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
              
                'attribute' => 'kategori_brg',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
           [
              
                'attribute' => 'jumlah_brg',
                'headerOptions' => ['style' => 'text-align:center'],
            ],
            [
                    'attribute' => 'foto',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->foto != '') {
                            return Html::img('@web/upload/' . $model->foto, ['class' => 'img-responsive', 'style' => 'height:100px']);
                        } else { 
                            return '<div align="center"><h1>No Image</h1></div>';
                        }
                    },
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
