<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header') ?>
<style type="text/css">
    .list-wrapper{
        /* font-size: .875em;
        font-weight: 400;
        line-height: 1.7;
        margin-bottom: 4px;
        color: #575c5f; */
        overflow-y: auto;
        min-height: 400px;
        max-height: 500px;
    }
    .list-wrapper p{
        margin-bottom: 10px;
    }
</style>
<div class="page-content">
    <!--Breadcrumbs-->
    <ol class="breadcrumb">
        <li><a href="<?php echo Yii::$app->homeUrl; ?>"><?= isset($this->context->subTitle) ? $this->context->subTitle : "sub Title" ?></a></li>
        <li><a href="<?php echo Yii::$app->homeUrl . Yii::$app->controller->id; ?>"><?= isset($this->context->subSubTitle) ? $this->context->subSubTitle : "sub sub Title" ?></a></li>
    </ol><!--Breadcrumbs Close-->

    <!--Profile Left-->
    <section class="blog">
        <div class="container">
            <div class="row">
                <!--Left Column-->
                <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                    <h2 class="title">Hello ,
                        <?php echo Yii::$app->user->identity->firstname . '&nbsp;' . Yii::$app->user->identity->lastname ?>
                        <?php
                        if (isset($this->params['listDevice']['device'])) {
                            if ($this->params['listDevice']['device']->device == 'computer') {
                                echo ", <i class=\"fa fa-desktop \" aria-hidden=\"true\"  style=\"color: #3cc;\"></i>";
                            } else {
                                echo ", <i class=\"fa fa-mobile  \" aria-hidden=\"true\"  style=\"color: #3cc;\"></i>";
                            }
                        } else {

                        }
                        ?>
                    </h2>
                </div>

                <div class="col-lg-8 col-md-8">
                    <?php echo $content; ?>
                </div>
                <!--Default Add New-->
                <div class="col-lg-4 col-md-4 post">
                    <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px; margin-top: 20px;  padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                        <span style="float: left; width: 70%; text-align: left;">Point</span>
                    </div>
                    <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0 ;text-align: center;color: #000;">
                        You have &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?= $this->params['currentPoint'] ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Point.<!-- $this->params['currentPoint'] is in frontend/controllers/MasterController-->
                        <div style="margin-top: 20px;">
                            <a href="<?php echo Yii::$app->homeUrl ?>top-up"class = "btn" style = "background-color: #3cc; color: #fff;font-size: 12pt;">
                                Top Up
                            </a>
                        </div>

                    </div>
                    <?php
                    if (Yii::$app->controller->action->id == 'purchase-order') {
                        ?>
                        <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px; margin-top: 20px;  padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                            <span style="float: left; width: 70%; text-align: left;">Default ...</span>
                            <span style="float: left; width: 30%; text-align: right;">

                            </span>
                        </div>
                        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0 ">

                        </div>
                    <?php } else { ?>
                        <!--
                            <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px; margin-top: 20px;  padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                                <span style="float: left; width: 70%; text-align: left;">Picking Point</span>
                                <span style="float: left; width: 30%; text-align: right;">
                                    <a href="<?php echo Yii::$app->homeUrl; ?>profile/picking-point/add" style="color: #fff;"> + Add New </a>
                                </span>
                            </div>
                            <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0 ">

                        <?php
                        /* if (isset($this->params['listDataProvider']['shipping'])):
                          echo \yii\widgets\ListView::widget([
                          'dataProvider' => $this->params['listDataProvider']['shipping'],
                          'options' => [
                          'tag' => 'div',
                          'class' => 'list-wrapper',
                          'id' => 'list-wrapper',
                          ],
                          'layout' => "{pager}\n{items}\n", //{summary}
                          'itemView' => function ($model, $key, $index, $widget) {
                          return $this->render('@frontend/views/profile/list_picking_point', ['model' => $model, 'index' => $index]);
                          },
                          ]);
                          endif; */
                        ?>

                            </div>-->
                        <!--Default Add New-->
                        <div class="bs-example" data-example-id="btn-tags" style="background-color:#3cc; height:45px; margin-top: 20px;  padding: 10px 12px; color: #fff; border-width: 1px;  border-radius: 4px 4px 0 0; -webkit-box-shadow: none; box-shadow: none;">
                            <span style="float: left; width: 70%; text-align: left;">Billings address</span>
                            <span style="float: left; width: 30%; text-align: right;">
                                <a href="<?php echo Yii::$app->homeUrl; ?>profile/billings-address/add" style="color: #fff;"> + Add New </a>
                            </span>
                        </div>
                        <div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup" style="margin: 0 0 ">
                            <?php
                            if (isset($this->params['listDataProvider']['billing'])):
                                echo \yii\widgets\ListView::widget([
                                    'dataProvider' => $this->params['listDataProvider']['billing'],
                                    'options' => [
                                        'tag' => 'div',
                                        'class' => 'list-wrapper',
                                        'id' => 'list-wrapper',
                                    ],
                                    'layout' => "{pager}\n{items}\n", //{summary}
                                    'itemView' => function ($model, $key, $index, $widget) {
                                        return $this->render('@frontend/views/profile/add_billings_address', ['model' => $model, 'index' => $index]);
                                    },
                                ]);
                            endif;
                            ?>
                        </div>
                    <?php } ?>

                </div><!-- col-lg-4 col-md-4 post -->

            </div>
        </div>

    </section><!--Blog Sidebar Left Close-->

</div>
<?php
$logoImage = common\models\costfit\ContentGroup::find()->where("lower(title)='logoImage'")->one();
$news = common\models\costfit\ContentGroup::find()->where("lower(title)='NEWS'")->one();
$footerContact = common\models\costfit\ContentGroup::find()->where("lower(title)='contactFooter'")->one();
echo $this->render('_footer', compact('logoImage', 'news', 'footerContact'));
?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
