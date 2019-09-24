<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\DosenStaf */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Dosen Stafs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dosen-staf-view box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (User::isAdmin()) { ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'nidn',
            'nip',
            'nik',
            'nama',
            'jabatan',
             [
              'attribute' => 'foto',
              'format' =>'raw',
              'value' => function ($model){
                if ($model->foto != '') {
                    return Html::img('@web/upload/dosen'. $model->foto,['class'=>'img-responsive','style' => 'height:200px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],
        ],
    ]) ?>

</div>
