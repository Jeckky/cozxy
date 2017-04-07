<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Wishlist-->
<section class="wishlist">
    <div class="container">
        <div class="row">

            <!--Items List-->
            <div class="col-lg-9 col-md-9">
                <h3>My Post</h3>
                <div class="Reviews" style="margin-left: 10px;">
                    <div class="post">
                        <p class="p-style3"> 1.Limo is the product which was born thanks to the involvement  </p>
                        <p class="p-style3"> 2.Limo is the product which was born thanks to the involvement  </p>
                        <p class="p-style3"> 3.Limo is the product which was born thanks to the involvement  </p>
                    </div>
                </div>
                <br><br>
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-md-3">

            </div>
        </div>

    </div>
</section><!--Wishlist Close-->

<!--Catalog Grid-->

