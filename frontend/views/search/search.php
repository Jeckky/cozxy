<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="row">
    <?php for ($index = 0; $index <= 8; $index++) {
        ?>
        <!--Tile-->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="tile">
                <div class="badges">
                    <span class="sale">Sale</span>
                </div>
                <div class="price-label">715,00 $</div>
                <a href="<?php echo Yii::$app->homeUrl; ?>products?productId=8888888">
                    <img src="<?php echo $baseUrl; ?>/images/ProductImage/15.jpg" alt="1"/>
                    <span class="tile-overlay"></span>
                </a>
                <div class="footer">
                    <a href="#">The Buccaneer</a>
                    <span>by Pirate3d</span>
                    <a href="<?php echo Yii::$app->homeUrl; ?>cart"><button class="btn btn-primary">Add to Cart</button></a>
                </div>
            </div>
        </div>
        <?php
        $index = $index++;
    }
    ?>

</div>
<!--Pagination-->
<ul class="pagination">
    <li class="prev-page"><a class="icon-arrow-left" href="#"></a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li class="next-page"><a class="icon-arrow-right" href="#"></a></li>
</ul>

