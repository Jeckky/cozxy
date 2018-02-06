<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

$this->title = 'Verify Email';
$this->params['breadcrumbs'][] = $this->title; // inbox/index

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
?>
<style>
    .page-header .pull-right {
        padding-top: 5px;
    }
    .page-header .pull-right > * {
        display: inline-block;
        vertical-align:middle;
    }
</style>
<script>
    var init = [];
    init.push(function () {
        $('body').addClass('mmc');
    });
</script>
<div class="theme-default main-menu-animated page-mail">
    <div id="content-wrapper">
        <div class="mail-nav">
            <div class="compose-btn">
                <a href="<?= Yii::$app->homeUrl ?>mailstore/verify-email/new-verify" class="btn btn-primary btn-labeled btn-block"><i class="btn-label fa fa-pencil-square-o"></i>New Email</a>
            </div>
            <div class="navigation">
                <ul class="sections">
                    <li class="active"><a href="#"><i class="m-nav-icon fa fa-inbox"></i>Inbox <span class="label pull-right"><?= $NotVerify ?></span></a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-star"></i>Starred <span class="label pull-right">0</span></a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-envelope"></i>Sent mail</a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-exclamation"></i>Important</a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-file-text-o"></i>Drafts <span class="label pull-right">0</span></a></li>
                    <li><a href="#"><i class="m-nav-icon fa fa-trash-o"></i>Trash</a></li>
                    <li class="divider"></li>
                    <li class="add-more"><a href="#">+ Add More</a></li>
                </ul>

                <!--<div class="mail-nav-header">LABELS</div>
                <ul class="sections">
                    <li><a href="#"><div class="mail-nav-lbl bg-success"></div>Client</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-danger"></div>Social</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-info"></div>Family</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-warning"></div>Friends</a></li>
                    <li><a href="#"><div class="mail-nav-lbl bg-pa-purple"></div>Work</a></li>
                    <li class="divider"></li>
                    <li class="add-more"><a href="#">+ Add More</a></li>
                </ul>-->
            </div>
        </div>

        <div class="mail-container">
            <div class="mail-container-header">
                <?= $this->title ?>

                <form action="" class="pull-right" style="width: 200px;margin-top: 3px;">
                    <div class="form-group input-group-sm has-feedback no-margin">
                        <input type="text" placeholder="Search..." class="form-control">
                        <span class="fa fa-search form-control-feedback" style="top: -1px"></span>
                    </div>
                </form>
            </div>

            <div class="mail-controls clearfix">
                <div class="btn-toolbar wide-btns pull-left" role="toolbar">

                    <div class="btn-group">
                        <div class="btn-group">
                            <!--<button type="button" class="btn dropdown-toggle" data-toggle="dropdown"><i class="fa fa-check-square-o"></i>&nbsp;<i class="fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Check all</a></li>
                                <li><a href="#">Check read</a></li>
                                <li><a href="#">Check unread</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Uncheck all</a></li>
                                <li><a href="#">Uncheck read</a></li>
                                <li><a href="#">Uncheck unread</a></li>
                            </ul>-->
                        </div>
                        <button type="button" class="btn"><i class="fa fa-repeat"></i></button>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="btn"><i class="fa fa fa-file-text-o"></i></button>
                        <button type="button" class="btn"><i class="fa fa-exclamation-circle"></i></button>
                        <button type="button" class="btn"><i class="fa fa-trash-o"></i></button>
                    </div>

                </div>

                <!--<div class="btn-toolbar pull-right" role="toolbar">
                    <div class="btn-group">
                        <button type="button" class="btn"><i class="fa fa-chevron-left"></i></button>
                        <button type="button" class="btn"><i class="fa fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="pages pull-right">
                    1-50 of 825
                </div>-->
            </div>


            <ul class="mail-list">
                <?=
                \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'summary' => "",
                    'options' => [
                        'tag' => false,
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return $this->render('@app/themes/costfit/layouts/mailstore/_item_email', ['model' => $model, 'index' => $index]);
                    },
                    // 'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                    //'layout'=>"{summary}{pager}{items}"
                    //'layout' => "{items}",
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>
            </ul>

        </div>
    </div>
</div>
<script type="text/javascript">
    init.push(function () {
        // Open nav on mobile
        $('.mail-nav .navigation li.active a').click(function () {
            $('.mail-nav .navigation').toggleClass('open');
            return false;
        });

        // Make message starred/unstarred
        $('body').on('click', '.m-star', function () {
            $(this).parents('.mail-item').toggleClass('starred');
            return false;
        });

        // Fix navigation if main menu is fixed
        if ($('body').hasClass('main-menu-fixed')) {
            $('.mail-nav').addClass('fixed');
        }
    })
    window.PixelAdmin.start(init);
</script>