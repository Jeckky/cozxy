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
                ?>
                <ul class="nav">
                    <li class=" active">
                        <a href="#"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text mmc-dropdown-delay animated fadeIn">Dashboard</span></a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-10">
                <?= $content ?>
            </div>
        </div>

    </div>
</section>

<?php //echo $this->render('_section_footer');      ?>

<?php $this->endContent(); ?>
