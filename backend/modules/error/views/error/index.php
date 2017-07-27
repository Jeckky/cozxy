<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'error/index';
$this->params['breadcrumbs'][] = $this->title; // Profiel/index

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
?>
<div class="page-404" style="background: #dedddc!important;">

    <script>var init = [];</script>
    <div class="header text-center">

        <a href="<?php echo $baseUrl; ?>/dashboard" class="logo">
            <center><img src="<?php echo $directoryAsset; ?>/images/cozxy.png" alt="" class="img-responsive"></center>
        </a> <!-- / .logo -->
    </div> <!-- / .header -->
    <h1><?= Yii::$app->request->getAbsoluteUrl(); ?></h1>
    <br>
    <div class="error-code"><?= $exception->statusCode; ?></div>

    <div class="error-text" style="text-align: left">
        <center><span class="oops"><?= $exception->getName(); ?></span></center><br>
        <center><span class="hr"></span></center>
        <br>
        <center><?= $exception->getMessage(); ?></center>
        <br><?= Yii::$app->getBasePath() . " Line :" . $exception->getLine(); ?>
        <br><?//= $exception->getTraceAsString(); ?>
        <div class="alert alert-danger" style="font-size: 16px">
            <?= nl2br(Html::encode($exception->getTraceAsString())) ?>
        </div>
        <?php
//        $separator = ', ';
//        echo str_replace("\n", $separator, $exception->getTraceAsString());
        ?>
    </div> <!-- / .error-text -->

    <!--    <form action="" class="search-form">
            <input type="text" class="search-input" name="s">
            <input type="submit" value="SEARCH" class="search-btn">
        </form>  / .search-form -->
    <br>


    <!--<p>
        You may change the content of this page by modifying
        the file <code><?php //= __FILE__;                                                                       ?></code>.
    </p>-->

</div>