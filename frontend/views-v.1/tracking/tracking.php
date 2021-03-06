<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>">Home</a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "Delivery" ?></a></li>
</ol><!--Breadcrumbs Close-->

<!--Support-->
<section class="tracking">
    <div class="container">
        <div class="row">
            <h2 class="title">Track Your Package</h2>
            <div class="row space-top">
                <div class="clo-lg-8 col-md-8 col-sm-8 space-bottom">
                    <h4 class="light-weight uppercase">Shipment Tracking</h4>

                    <div class="ship-scale">
                        <span class="round <!--done-->">
                            <i class="fa fa-check"></i>

                            <span class="textik">Shipping soon</span>
                            <span class="textik2">10%</span>

                        </span>

                        <span class="flat <!--done-->">
                            <span class="round">
                                <i class="fa fa-check"></i>

                                <span class="textik">Shipped</span>
                                <span class="textik2">25%</span>

                            </span>
                        </span>

                        <span class="flat">
                            <span class="round">
                                <i class="fa fa-check"></i>

                                <span class="textik">In transit</span>
                                <span class="textik2">50%</span>

                            </span>
                        </span>

                        <span class="flat">
                            <span class="round">
                                <i class="fa fa-check"></i>

                                <span class="textik">Out for delivery</span>
                                <span class="textik2">75%</span>

                            </span>
                        </span>

                        <span class="flat">
                            <span class="round">
                                <i class="fa fa-check"></i>

                                <span class="textik">Delivered</span>
                                <span class="textik2">100%</span>

                            </span>
                        </span>
                    </div>

                    <div class="accordion panel-group">
                        <div class="panel">
                            <div class="panel-heading">
                                <a data-toggle="collapse" href="#collapseOne" class="collapsed"><i></i>FAQ Collapsible section 01</a>
                            </div>
                            <div id="collapseOne" class="collapse">
                                <div class="panel-body">
                                    <!--<table>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Delivered</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Out for delivery</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Package arrived at a carrier facility</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Package arrived at a carrier facility</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Package arrived at a carrier facility</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Package arrived at a carrier facility</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Package arrived at a carrier facility</td>
                                        </tr>
                                        <tr>
                                            <td>jabuary 23.2014 11.03am Alexandria VA US</td>
                                            <td>Package arrived at a carrier facility</td>
                                        </tr>
                                    </table>-->
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="clo-lg-4 col-md-4 col-sm-4 space-bottom">
                    <h4 class="light-weight uppercase">Shipment information</h4>

                    <div class="shipment">
                        <div class="shipment-title">Delivering to</div>

                        <div>
                            <!-- Ivan Petrov <br />
                             Chestnut st. 2515 <br />
                             San Francisco, 94123 <br />
                             415 000 00 00 <br />
                            -->
                        </div>
                    </div>

                    <div class="shipment">
                        <div class="shipment-title">Carrier</div>

                        <div>
                            <!-- UPS -->
                        </div>
                    </div>

                    <div class="shipment">
                        <div class="shipment-title">Tracking #</div>

                        <div>
                            <!-- AZX3355FD53 -->
                        </div>
                    </div>

                    <div class="shipment">
                        <div class="shipment-title">Order #</div>
                        <div>
                            <!-- 65468986 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Support Close-->

<!--Delivery Info-->
<!--
<section class="gray-bg tech-specs">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 dark-color">
                <h3>Track Your Package</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>

                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>

                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>

                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
<div class="item">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-umbrella"></i><span>Customizable</span></div>
        <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Amet cras posuere pede placerat, velit neque ut mollis elit mattis integer.</p></div>
    </div>
</div>

<div class="item">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4"><i class="fa fa-archive"></i><span>Package</span></div>
        <div class="col-lg-8 col-md-8 col-sm-8"><p class="p-style2">Individual packing</p></div>
    </div>
</div>
<div class="item">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-smile-o"></i><span>Mentions</span></div>
        <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Give a smile</p></div>
    </div>
</div>

<div class="item">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-3"><i class="fa fa-dollar"></i><span>Best Price</span></div>
        <div class="col-lg-8 col-md-8 col-sm-9"><p class="p-style2">Affordable prices</p></div>
    </div>
</div>
</div>
</div>
</div>
</section>-->
<!--Delivery Info Close-->
