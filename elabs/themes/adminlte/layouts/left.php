<?php
use app\models\User;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
              <?php if (User::isAdmin()): ?>
                            <?= User::getFotoAdmin(['class' => 'user-image']); ?>
                            <?php endif ?>
                            <?php if (User::isMhs()): ?>
                                <?= User::getFotoMhs(['class' => 'user-image']); ?>
                            <?php endif ?>
            </div>
            <div class="pull-left info">
            <?php if (User::isMhs()): ?>
               <p><?= Yii::$app->user->identity->mhs->nama; ?></p>
               <?php endif ?>
                <?php if (User::isAdmin()): ?>
                    <p><?= Yii::$app->user->identity->username; ?></p>
                     <?php endif ?>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <!--   <input type="text" name="q" class="form-control" placeholder="Search..."/> -->
             <!--  <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span> -->
            </div>
        </form>
        <!-- /.search form -->

        <?php if (User::isAdmin()) { ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['site/dashboard'],],
                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Mahasiswa', 'icon' => 'user', 'url' => ['mhs/index'],], 
                    //['label' => 'Dosen dan Staff', 'icon' => 'user', 'url' => ['dosen-staf/index'],],
                    [
                        'label' => 'Pemakaian Laboratorium',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Laboratorium ', 'icon' => 'circle-o', 'url' => ['pemakaian-lab/index'],],
                    ],

                    ],
                    [
                        'label' => 'Data Barang',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Kategori Barang', 'icon' => 'circle-o', 'url' => ['kategori-brg/index'],],
                            ['label' => 'Invetaris Barang', 'icon' => 'circle-o', 'url' => ['inventaris-brg/index'],],
                        ],
                    ],

                     ['label' => 'Peminjaman', 'icon' => 'pencil-square-o', 'url' => ['peminjaman/index'],],

                      [
                        'label' => 'Pengguna',
                        'icon' => 'circle-o',
                        'url' => '#',
                        'items' => [
                            ['label' => 'user', 'icon' => 'circle-o', 'url' => ['user/index'],],
                            ['label' => 'Mahasiswa', 'icon' => 'circle-o', 'url' => ['mhs/index'],],
                        ],
                    ],
           
                ],
            ]
        ) ?>

    <?php ?>
     <?php } elseif (User::isMhs()) { ?>
         <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [

                    ['label' => '', 'options' => ['class' => 'header']],
                    // ['label' => 'home', 'icon' => 'home', 'url' => ['site/dashboard'],],
                    // ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Form Peminjaman', 'icon' => 'circle-o', 'url' => ['peminjaman/create'],],
                    //   [
                    //     'label' => 'Peminjaman',
                    //     'icon' => 'circle-o',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Form Peminjaman', 'icon' => 'circle-o', 'url' => ['peminjaman/create'],],
                    //         ['label' => 'Peminjaman', 'icon' => 'circle-o', 'url' => ['peminjaman/index'],],
                    //     ],
                    // ],

                    // ['label' => 'form peminjaman', 'icon' => 'pencil-square-o', 'url' => ['peminjaman/create'],],
                     ['label' => 'Peminjaman', 'icon' => 'circle-o', 'url' => ['peminjaman/index'],],
                     ['label' => 'Pengembalian', 'icon' => 'circle-o', 'url' => ['peminjaman/index'],],
                    // ['label' => 'Pengembalian', 'icon' => 'pencil-square-o', 'url' => ['pengembalian/index'],],
           
                ],
            ]
        ) ?>

    <?php } ?>


    </section>

</aside>
