<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Jurusan;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Mhs */

$this->title = "nama mahasiswa: ".$model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Mhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mhs-view box box-primary">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (User::isAdmin()): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            [
            'attribute' => 'id_jurusan',
            'value' => @$model->jurusan->nama,
            ],
             [
              'attribute' => 'foto',
              'format' =>'raw',
              'value' => function ($model){
                if ($model->foto != '') {
                    return Html::img('@web/upload/mhs/'. $model->foto,['class'=>'img-responsive','style' => 'height:200px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],
            'nim',
        ],
    ]) ?>

</div>
