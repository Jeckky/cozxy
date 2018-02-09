<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

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
            </div>
        </div>

        <div class="mail-container">
            <div class="mail-container-header">
                <?= $this->title ?>

                <form  method="GET" class="pull-right" style="width: 200px;margin-top: 3px;">
                    <div class="form-group input-group-sm has-feedback no-margin">
                        <input type="text" placeholder="Search..." class="form-control" name="searchEmail" value="<?= isset($_GET['searchEmail']) ? $_GET['searchEmail'] : '' ?>">
                        <span class="fa fa-search form-control-feedback" style="top: -1px"></span>
                    </div>
                </form>
            </div>
            <?php
            //throw new \yii\base\Exception($orderId);
            $form = ActiveForm::begin([
                        'method' => 'POST',
                        'action' => ['prepare-action'],
            ]);
            ?>
            <div class="mail-controls clearfix">
                <div class="btn-toolbar wide-btns pull-left" role="toolbar">

                    <div class="btn-group">
                        <a href="<?= Yii::$app->homeUrl ?>mailstore/verify-email" class="btn"><i class="fa fa-repeat"></i></a>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn" value="file" name="submitType"><i class="fa fa fa-file-text-o"></i></button>
                        <button type="submit" class="btn" value="verify" name="submitType" title="Verify"><i class="fa fa-exclamation-circle"></i></button>
                        <button type="submit" class="btn" value="delete" name="submitType" title="Delete" id="deleteUser">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </div>

                </div>
            </div>
            <?php
            if ($NotVerify > 0) {
                ?>
                <ul class="mail-list">
                    <li class="mail-item" style="background-color: #ffffff;">
                        <div class="m-chck">
                            <label class="px-single">
                                <input type="checkbox" name=""  class="px" id="checkAllMail" value="0">
                                <span class="lbl"></span>
                            </label>
                        </div>
                        <div class="m-star">เลือกทั้งหมด<br></div>
                    </li>
                </ul>
            <?php } ?>
            <ul class="mail-list">

                <?php Pjax::begin(); ?>
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
                    'itemOptions' => [
                        'tag' => false,
                    ],
                ]);
                ?>
                <?php Pjax::end(); ?>
            </ul>
            <?php ActiveForm::end(); ?>
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