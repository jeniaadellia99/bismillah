<?php
use yii\helpers\Html;
use app\models\User;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">Elabs</span><span class="logo-lg">' . "Elabs" . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
               
             
                <!-- Tasks: style can be found in dropdown.less -->
              
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if (User::isAdmin()): ?>
                            <?= User::getFotoAdmin(['class' => 'user-image']); ?>
                            <?php endif ?>
                        <?php if (User::isDosenStaf()): ?>
                            <?= User::getFotoDosenStaf(['class' => 'user-image']); ?>
                            <?php endif ?>
                        <?php if (User::isMhs()): ?>
                                <?= User::getFotoMhs(['class' => 'user-image']); ?>
                            <?php endif ?>
                          <span class="hidden-xs"><?= Yii::$app->user->identity->username  ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if (User::isAdmin()): ?>
                                <?= User::getFotoAdmin(['class' => 'img-circle']); ?>
                            <?php endif ?>
                             <?php if (User::isDosenStaf()): ?>
                                <?= User::getFotoDosenStaf(['class' => 'img-circle']); ?>
                            <?php endif ?>
                            <?php if (User::isMhs()): ?>
                                <?= User::getFotoMhs(['class' => 'img-circle']); ?>
                            <?php endif ?>
                         

                            <p>
                             
                                <small>Tanggal Masuk : <?= date('d F Y') ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                      
                        <!-- Menu Footer-->
                        <li class="user-footer">
                             <div class="pull-left">
                                <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                <?= Html::a("Lihat Profil",["user/view","id" => Yii::$app->user->identity->id],['class' => 'btn btn-default btn-flat']) ?>
                            </div>
                           
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
            
            </ul>
        </div>
    </nav>
</header>
