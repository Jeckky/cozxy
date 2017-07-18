<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$this->title = isset($productPost->title) ? 'Content' . $content['title'] : '';
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
                        <div class="col-xs-12 compare-price-ajax">

                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Total -->
        <div class="col-xs-3">
            <div class="panel panel-defailt  ">
                <div class="size14" style="background-color:rgb(254, 230, 10);">&nbsp;</div>
                <h3 class="page-header" style="margin:10px 20px;">&nbsp;</h3>
                <div class="panel-body">

                    <div class="text-center">

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
