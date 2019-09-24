<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Labs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Lab', ['create'], ['class' => 'btn btn-success']) ?>
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
            'nama',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
