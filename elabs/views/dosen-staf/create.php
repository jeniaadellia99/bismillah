<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DosenStaf */

$this->title = 'Tambah Dosen Staf';
$this->params['breadcrumbs'][] = ['label' => 'Dosen Stafs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-staf-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
