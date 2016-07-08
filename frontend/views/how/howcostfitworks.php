<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<!--Breadcrumbs-->
<ol class="breadcrumb">
    <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
    <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></a></li>
</ol><!--Breadcrumbs Close-->

<!--Support-->
<section class="support">
    <div class="container">
        <div class="row">

            <!--Left Column-->
            <div class="col-lg-8 col-md-8">
                <h2 class="title">How cost.fit Works</h2>
                <div class="row space-top">
                    <div class="clo-lg-6 col-md-6 col-sm-6 space-bottom">
                        <h4 class="light-weight uppercase">Privacy Policy</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat.</p>
                        <a class="btn btn-primary btn-sm" href="#">Read more</a>
                    </div>
                    <div class="clo-lg-6 col-md-6 col-sm-6 space-bottom">
                        <h4 class="light-weight uppercase">Shipping Agreement</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis.</p>
                    </div>
                </div>

                <!--Acccordion-->
                <div class="row">
                    <div class="accordion panel-group" id="accordion">
                        <div class="panel">
                            <div class="panel-heading active">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i></i>FAQ Collapsible section 01</a>
                            </div>
                            <div id="collapseOne" class="collapse in">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table.
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i></i>FAQ Collapsible section 02</a>
                            </div>
                            <div id="collapseTwo" class="collapse">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i></i>FAQ Collapsible section 03</a>
                            </div>
                            <div id="collapseThree" class="collapse">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--Acccordion Close-->
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-lg-offset-1 col-md-4">
                <!--Contact Info--> 
                <h3>Contact info</h3>
                <div class="cont-info-widget">
                    <ul>
                        <li><i class="fa fa-building"></i>บริษัท ไดอิ กรุ๊ป จำกัด (มหาชน)</li>
                        <li>Daii Group Public Company Limited</li>
                        <li><i class="fa fa-building"></i>เลขที่ 1 ชั้น 7 ซอยลาดพร้าว 19 ถนนลาดพร้าว
                            แขวงจอมพล เขตจตุจักร กรุงเทพมหานคร 10900</li>
                        <li><a href="#"><i class="fa fa-envelope"></i>mail@Limo.com</a></li>

                        <li><i class="fa fa-phone"></i>02-938-3464</li>
                        <li><i class="fa fa-mobile"></i>02-938-3463</li>
                        <li><a href="http://www.fenzer.biz"><i class="fa fa-support"></i>www.fenzer.biz</a></li>
                        <li><a href="http://www.qsaf.biz"><i class="fa fa-support"></i>www.qsaf.biz</a></li>
                        <li><a href="http://www.atechwindow.com"><i class="fa fa-support"></i>www.atechwindow.com</a></li>
                    </ul>
                </div>
                <!--Latest posts-->
                <h3>Latest posts</h3>
                <div class="latest-posts">
                    <div class="post">
                        <a href="#">New awesome theme out there...</a>
                        <div class="meta">
                            <a href="#">Comments <span>(34)</span></a>
                            <span class="date">12.02.2014</span>
                        </div>
                    </div>
                    <div class="post">
                        <a href="#">Lorem ipsum dolor sit amet...</a>
                        <div class="meta">
                            <a href="#">Comments <span>(22)</span></a>
                            <span class="date">12.02.2014</span>
                        </div>
                    </div>
                    <div class="post">
                        <a href="#">Anim pariatur cliche reprehenderit...</a>
                        <div class="meta">
                            <a href="#">Comments <span>(81)</span></a>
                            <span class="date">12.02.2014</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--Support Close-->
