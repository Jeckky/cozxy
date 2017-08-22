<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = isset($content['title']) ? $content['title'] : '';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .btn-radio {
        width: 100%;
    }
    .img-radio {
        opacity: 0.5;
        margin-bottom: 5px;
    }

    .space-20 {
        margin-top: 20px;
    }
    .social-icon {
        padding: 14px 5px;
    }
    .social-icon a {
        display: inline-block;
        width: 42px;
        height: 42px;
        font-size: 24px;
        color: #fff;
        border-radius: 50%;
        border: 1px solid #fff;
        padding: 4px 6px;
        margin-left: 7px;
        margin-right: 7px;
        text-align: center;
        -webkit-transition: all .5s;
        transition: all .5s;
        background-color:rgb(255, 198, 0);
    }
</style>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Cart -->
        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-xs-12 bg-white">
                    <h1 class="page-header"><?= isset($content['title']) ? $content['title'] : '' ?></h1>
                    <div style="font-size: 12px;">
                        <a href="#"><i class="fa fa-user"></i> Cozxy</a>&nbsp;
                        <span><i class="fa fa-calendar"></i> <?= \Yii::$app->formatter->asDate($content['createDateTime'], 'long') ?></span>&nbsp;
                        <a href="#"><i class="fa fa-tags"></i> Content</a>
                    </div>
                    <br>
                    <?= Html::img($content['image'], ['class' => 'img-responsive']) ?>
                    <p class="size20">
                        <?php echo isset($content['shortDescription']) ? $content['shortDescription'] : ''; ?>
                    </p>
                    <div class="size12">&nbsp;</div>
                    <p class="size20">
                        <?php echo isset($content['description']) ? $content['description'] : ''; ?>
                    </p>
                </div>
            </div>

            <div class="size20">&nbsp;</div>

            <div class="panel panel-default row" id="1234" style="border-color:#fff;">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12  ">

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Total -->
        <div class="col-xs-3">
            <div class="panel panel-defailt  ">
                <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
                <div class="text-center">
                    <div class="panel panel-defailt text-center social-icon">
                        <a href="https://www.facebook.com/cozxydotcom/"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.instagram.com/cozxy_thailand"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
