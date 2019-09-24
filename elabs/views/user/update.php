<?php

use yii\helpers\Html;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update User: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?php if (User::isAdmin()): ?>


<div class="user-update box box-primary">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
</div>

   <?php endif ?>

<?php if (User::isMhs()): ?>

<div class="user-update box box-primary">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
</div>
<?php endif ?>

<?php if (User::isDosenStaf()): ?>

<div class="user-update box box-primary">

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
</div>
<?php endif ?>
