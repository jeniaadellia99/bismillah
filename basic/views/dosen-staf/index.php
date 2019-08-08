<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DosenStafSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dosen dan Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-staf-index box box-primary">
<div class="box-body table-responsive">

    <p>
        <?= Html::a('Tambah Dosen dan Staff', ['create'], ['class' => 'btn btn-success']) ?>
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

            // 'nidn',
            // 'nip',
            'nik',
            [
                'attribute' => 'nama'
            ],
            'jabatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
