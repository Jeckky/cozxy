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
                <h2 class="title"><?php echo $top->description; ?></h2>
                <div class="row space-top">
                    <?php foreach ($topContent as $content) { ?>
                        <div class="clo-lg-6 col-md-6 col-sm-6 space-bottom">
                            <h4 class="light-weight uppercase"><?php echo $content->title; ?></h4>
                            <p><?php echo $content->description; ?></p>
                            <a class="btn btn-primary btn-sm" href="#">Read more</a>
                        </div>
                    <?php } ?>
                </div>

                <!--Acccordion-->
                <div class="row">
                    <div class="accordion panel-group" id="accordion">
                        <?php
                        $i = 1;
                        foreach ($bodyContent as $bContent) {
                            ?>
                            <div class="panel">
                                <div class="panel-heading <?= ($i == 1) ? 'active' : '' ?>">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $i ?>"><i></i><?php echo $bContent->title; ?></a>
                                </div>
                                <div id="collapse<?= $i ?>" class="collapse <?= ($i == 1) ? 'in' : '' ?>">
                                    <div class="panel-body">
                                        <?php echo $bContent->description; ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                </div><!--Acccordion Close-->
            </div>

            <!--Sidebar-->
            <div class="col-lg-3 col-lg-offset-1 col-md-4">
                <!--Contact Info-->
                <h3>Contact info</h3>
                <div class="cont-info-widget">
                    <ul>
                        <li><i class="fa fa-building"></i><?php echo $contactInfo[0]->description; ?></li>
                        <li><i class="fa fa-building"></i><?php echo $contactInfo[1]->description; ?></li>
                        <li><a href="#"><i class="fa fa-envelope"></i><?php echo $contactInfo[2]->description; ?></a></li>

                        <li><i class="fa fa-phone"></i><?php echo $contactInfo[3]->description; ?></li>
                        <li><i class="fa fa-mobile"></i><?php echo $contactInfo[4]->description; ?></li>
                        <?php
                        foreach ($webSite as $web) {
                            ?>
                            <li><a href="http://<?= $web->description ?>"><i class="fa fa-support"></i><?php echo $web->description; ?></a></li>
                                <?php } ?>
                    </ul>
                </div>
                <!--Latest posts-->
                <!--  <h3>Latest posts</h3>
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
                  </div>-->
            </div>
        </div>
    </div>
</section><!--Support Close-->
