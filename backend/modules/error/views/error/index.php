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
            <center><img src="<?php echo $directoryAsset; ?>/demo/logo-big.png" alt="" class="img-responsive"></center>
        </a> <!-- / .logo -->
    </div> <!-- / .header -->

    <div class="error-code">404</div>

    <div class="error-text">
        <span class="oops">OOPS!</span><br>
        <span class="hr"></span>
        <br>
        SOMETHING WENT WRONG, OR THAT PAGE DOESN'T EXIST... YET
    </div> <!-- / .error-text -->

    <form action="" class="search-form">
        <input type="text" class="search-input" name="s">
        <input type="submit" value="SEARCH" class="search-btn">
    </form> <!-- / .search-form -->

    <h1>error/index</h1>

    <!--<p>
        You may change the content of this page by modifying
        the file <code><?php //= __FILE__;                  ?></code>.
    </p>-->

</div>