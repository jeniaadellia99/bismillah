<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PemakaianLab */

$this->title = "Nama Pengguna: "$model->nama_pengguna;
$this->params['breadcrumbs'][] = ['label' => 'Pemakaian Labs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pemakaian-lab-view box box-primary">
      <div class="box-body">

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
            
            'nama_pengguna',
            'nama_lab',
            'mata_kuliah',
            'date',
        ],
    ]) ?>

</div>
