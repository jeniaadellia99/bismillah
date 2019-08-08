<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DosenStaf */

$this->title = 'Update Dosen Staf: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dosen Stafs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dosen-staf-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
