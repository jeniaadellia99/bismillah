<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriBrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-brg-index box box-primary">
    <div class="box-body table-responsive">

    <p>
        <?= Html::a('Tambah Kategori Barang', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['attribute' => 'nama', 'headerOptions'=>['style'=>'text-align:center'],],
             [
                    'attribute' => 'Jumlah Barang',
                    'headerOptions' => ['style'=>'text-align:center'],
                    'value' => function($model) {
                        return $model->getJumlahBarang()." Barang";
                    }
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
