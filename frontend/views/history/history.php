<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Shopping Cart Message-->
<section class="cart-message">
    <i class="fa fa-check-square"></i>
    <p class="p-style3">"Nikon" was successfully added to your cart.</p>
    <a class="btn-outlined-invert btn-success btn-sm" href="shopping-cart.html">View cart</a>
</section><!--Shopping Cart Message Close-->

<!--Catalog Single Item-->
<section class="delivery">
    <div class="container">
        <div class="row">

            <!--Product Gallery-->
            <div class="col-lg-5 col-md-5">
                <div class="delivery-img-container">

                    <div class="delivery-preview historyImgShow" id="historyImg_01">
                        <img src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/1.jpg" alt="Lorem ipsum"/>
                    </div>

                    <div class="delivery-preview" id="historyImg_02">
                        <img src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/1.jpg" alt="Lorem ipsum"/>
                    </div>

                    <div class="delivery-preview" id="historyImg_03">
                        <img src="<?php echo $directoryAsset; ?>/img/catalog/product-gallery/1.jpg" alt="Lorem ipsum"/>
                    </div>
                </div>
            </div>

            <!--Product Description-->
            <div class="col-lg-7 col-md-7">
                <div class="accordion panel-group" id="accordion">
                    <div class="panel">
                        <div class="panel-heading active" data-img="#historyImg_01">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <div class="badges">
                                    <span class="in-progress">Awaiting delivery</span>
                                </div>

                                <span class="gray-color date-time">june 16TH - 7:22PM</span>
                                <div class="history-title">Brown Leather Driving Gloves for Men</div>

                                <span class="history-cost">19 999 $</span>
                            </a>
                        </div>
                        <div id="collapseOne" class="collapse in">
                            <div class="panel-body">
                                <table class="delivery-details">
                                    <tr>
                                        <td colspan="5" class="orer-heading">Order details</td>
                                    </tr>
                                    <tr>
                                        <td class="details-heading">Product:</td>
                                        <td class="details-heading">Quantity:</td>
                                        <td class="details-heading">Shiping:</td>
                                        <td class="details-heading">Subtotal:</td>
                                        <td class="details-heading">Total:</td>
                                    </tr>
                                    <tr>
                                        <td>Brown Leather Driving Gloves</td>
                                        <td>1 x bagpack</td>
                                        <td>Free</td>
                                        <td>19 799 $</td>
                                        <td>19 999 $</td>
                                    </tr>
                                </table>

                                <table class="delivery-details">

                                    <tr>
                                        <td colspan="3" class="orer-heading">Customer derails</td>
                                    </tr>
                                    <tr>
                                        <td class="details-heading">Mail/Phone</td>
                                        <td class="details-heading">Billing address</td>
                                        <td class="details-heading">Shipping address</td>
                                    </tr>
                                    <tr>
                                        <td>ivanpetrov@gmail.com</td>
                                        <td>Chestnut St. 2125</td>
                                        <td>Chestnut St. 2125</td>
                                    </tr>
                                    <tr>
                                        <td>+380 (50) 701-11-25</td>
                                        <td>San Francisco, CA 94123</td>
                                        <td>San Francisco, CA 94123</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading" data-img="#historyImg_02">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <div class="badges">
                                    <span class="delivered">Delivered</span>
                                </div>

                                <span class="gray-color date-time">june 16TH - 7:22PM</span>
                                <div class="history-title">Brown Leather Driving Gloves for Men</div>

                                <span class="history-cost">19 999 $</span>
                            </a>
                        </div>
                        <div id="collapseTwo" class="collapse">
                            <div class="panel-body">
                                <table class="delivery-details">
                                    <tr>
                                        <td colspan="5" class="orer-heading">Order details</td>
                                    </tr>
                                    <tr>
                                        <td class="details-heading">Product:</td>
                                        <td class="details-heading">Quantity:</td>
                                        <td class="details-heading">Shiping:</td>
                                        <td class="details-heading">Subtotal:</td>
                                        <td class="details-heading">Total:</td>
                                    </tr>
                                    <tr>
                                        <td>Brown Leather Driving Gloves</td>
                                        <td>1 x bagpack</td>
                                        <td>Free</td>
                                        <td>19 799 $</td>
                                        <td>19 999 $</td>
                                    </tr>
                                </table>

                                <table class="delivery-details">

                                    <tr>
                                        <td colspan="3" class="orer-heading">Customer derails</td>
                                    </tr>
                                    <tr>
                                        <td class="details-heading">Mail/Phone</td>
                                        <td class="details-heading">Billing address</td>
                                        <td class="details-heading">Shipping address</td>
                                    </tr>
                                    <tr>
                                        <td>ivanpetrov@gmail.com</td>
                                        <td>Chestnut St. 2125</td>
                                        <td>Chestnut St. 2125</td>
                                    </tr>
                                    <tr>
                                        <td>+380 (50) 701-11-25</td>
                                        <td>San Francisco, CA 94123</td>
                                        <td>San Francisco, CA 94123</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-heading" data-img="#historyImg_03">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <div class="badges">
                                    <span class="delivered">Delivered</span>
                                </div>

                                <span class="gray-color date-time">june 16TH - 7:22PM</span>
                                <div class="history-title">Brown Leather Driving Gloves for Men</div>

                                <span class="history-cost">19 999 $</span>
                            </a>
                        </div>
                        <div id="collapseThree" class="collapse">
                            <div class="panel-body">
                                <table class="delivery-details">
                                    <tr>
                                        <td colspan="5" class="orer-heading">Order details</td>
                                    </tr>
                                    <tr>
                                        <td class="details-heading">Product:</td>
                                        <td class="details-heading">Quantity:</td>
                                        <td class="details-heading">Shiping:</td>
                                        <td class="details-heading">Subtotal:</td>
                                        <td class="details-heading">Total:</td>
                                    </tr>
                                    <tr>
                                        <td>Brown Leather Driving Gloves</td>
                                        <td>1 x bagpack</td>
                                        <td>Free</td>
                                        <td>19 799 $</td>
                                        <td>19 999 $</td>
                                    </tr>
                                </table>

                                <table class="delivery-details">

                                    <tr>
                                        <td colspan="3" class="orer-heading">Customer derails</td>
                                    </tr>
                                    <tr>
                                        <td class="details-heading">Mail/Phone</td>
                                        <td class="details-heading">Billing address</td>
                                        <td class="details-heading">Shipping address</td>
                                    </tr>
                                    <tr>
                                        <td>ivanpetrov@gmail.com</td>
                                        <td>Chestnut St. 2125</td>
                                        <td>Chestnut St. 2125</td>
                                    </tr>
                                    <tr>
                                        <td>+380 (50) 701-11-25</td>
                                        <td>San Francisco, CA 94123</td>
                                        <td>San Francisco, CA 94123</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="badges pull-right">
            <a href="<?php echo Yii::$app->homeUrl; ?>search"><span class="delivered">Re Order</span></a>
        </div>
    </div>
</section><!--Catalog Single Item Close-->

<!--Special Offer-->
<section class="special-offer">
    <?php echo $this->render('history_specialoffer'); ?>
</section><!--Special Offer Close-->