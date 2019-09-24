<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?php if (User::isAdmin()): ?>
<div class="user-view box box-primary">

    <div class="box-header">
        <h3 class="box-title">Detail User : <?= $model->username; ?></h3>
    </div>

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
            'username',
          
        ],
    ]) ?>

    </div>


<?php endif ?>

<?php if (User::isMhs()): ?>
    
<?php $this->title = $model->username; ?>

 <div class="box-header">
        <h3 class="box-title">Profile Mahasiswa <?= $model->username; ?>.</h3>
    </div>

    <div class="box-body box box-primary">
        <p>
            <?= Html::a('<i class="fa fa-pencil"> Edit</i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                [
                    'attribute' => 'nama',
                    'value' => function($data) {
                        return $data->mhs->nama;
                    }
                ],
                [
                    'attribute' => 'nim',
                    'value' => function($data) {
                        return $data->mhs->nim;
                    }
                ],
            ],
        ]) ?>
 
<?php endif ?>
<?php if (User::isDosenStaf()): ?>
    
<?php $this->title = $model->username; ?>

 <div class="box-header">
        <h3 class="box-title">Profile Dosen <?= $model->username; ?>.</h3>
    </div>

    <div class="box-body box box-primary">
        <p>
            <?= Html::a('<i class="fa fa-pencil"> Edit</i>', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'username',
                [
                    'attribute' => 'nama',
                    'value' => function($data) {
                        return $data->dosenStaf->nama;
                    }
                ],
                [
                    'attribute' => 'nik',
                    'value' => function($data) {
                        return $data->dosenStaf->nik;
                    }
                ],
                [
                    'attribute' => 'nidn',
                    'value' => function($data) {
                        return $data->dosenStaf->nidn;
                    }
                ],
                [
                    'attribute' => 'nip',
                    'value' => function($data) {
                        return $data->dosenStaf->nip;
                    }
                ],
                 [
                    'attribute' => 'jabatan',
                    'value' => function($data) {
                        return $data->dosenStaf->jabatan;
                    }
                ],
            ],
        ]) ?>
 
<?php endif ?>
 </div>