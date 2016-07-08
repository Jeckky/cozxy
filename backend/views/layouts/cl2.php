<?php

//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>

<?php // echo $this->render('_section_slider'); ?>

<?php // echo $this->render('_section_title'); ?>

<section id="content">
    <div class="container">

        <div class="row">
            <div class="col-lg-2">
                <?php
                //menu
                /* echo \yii\bootstrap\Nav::widget([
                  'options' => ['class' => 'nav nav-pills nav-stacked'],
                  'items' => [
                  [
                  'label' => 'Atech',
                  'items' => [
                  ['label' => 'brand', 'url' => ['/atechwindow/brand']],
                  ],
                  ],
                  [
                  'label' => 'Ginza Town',
                  'items' => [
                  ['label' => 'brand', 'url' => ['/ginzatown/brand']],
                  ],
                  ],
                  [
                  'label' => 'Ginza Home',
                  'items' => [
                  ['label' => 'brand', 'url' => ['/ginzahome/brand']],
                  ],
                  ],
                  [
                  'label' => 'Fenzer',
                  'items' => [
                  ['label' => 'brand', 'url' => ['/fenzer/brand']],
                  ],
                  ],
                  [
                  'label' => 'Taninut',
                  'items' => [
                  ['label' => 'taninut', 'url' => ['/taninut']],
                  ['label' => 'brand', 'url' => ['/taninut/brand']],
                  ],
                  ],
                  [
                  'label' => 'Brand',
                  'items' => [
                  ['label' => 'brand', 'url' => ['/atechwindow/brand']],
                  //                    '<li class="divider"></li>',
                  //                    '<li class="dropdown-header">Dropdown Header</li>',
                  //                ['label' => 'Assets', 'url' => ['/project/project-asset']],
                  ],
                  ],
                  ],
                  ]); */
                ?>
                <ul class="nav">
                    <li class=" active">
                        <a href="#"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Dashboard</span></a>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Atech window</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/atechwindow/brand"><span class="mm-text">Brand</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/product/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Product</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/pricegroup/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Price Group</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Fenzer</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand"><span class="mm-text">Brand</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/product/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Product</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/pricegroup/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Price Group</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Ginza Home</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand"><span class="mm-text">Brand</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/product/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Product</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/pricegroup/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Price Group</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Ginza Town</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/brand"><span class="mm-text">Brand</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/product/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Product</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/pricegroup/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Price Group</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Order</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">My File</span></a>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Spacial Project</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/"><span class="mm-text">User Request</span></a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/"><i class="menu-icon fa fa-tasks"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Spacial Code</span></a>
                            </li>

                        </ul>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">User</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/"><span class="mm-text">Supplier</span></a>
                            </li>

                        </ul>
                    </li>
                    <li class="mm-dropdown mm-dropdown-root">
                        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Report</span></a>
                        <ul class="mmc-dropdown-delay animated fadeInLeft">
                            <li>
                                <a tabindex="-1" href="<?php echo $baseUrl; ?>/"><span class="mm-text">รายงานสรุปยอดขาย</span></a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-lg-10">
                <?= $content ?>
            </div>
        </div>

    </div>
</section>

<?php //echo $this->render('_section_footer');     ?>

<?php $this->endContent(); ?>
