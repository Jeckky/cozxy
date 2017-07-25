<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = isset($productPost->title) ? 'Content ' . $content['title'] : '';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="size32">&nbsp;</div>
    <div class="row">
        <!-- Content -->
        <div class="col-lg-9 col-md-8">
            <h1 class="page-header"><?php echo $content['title']; ?></h1>

            <div class="row">
                <div class="col-md-4">
                    <?= Html::img($content['image'], ['class' => 'img-responsive']) ?>
                </div>
                <div class="col-md-8">
                    <p class="size20">
                        <?php echo $content['shortDescription']; ?>
                    </p>
                    <div class="size20">&nbsp;</div>
                    <p class="size20">

                    </p>
                    <div class="size43">&nbsp;</div>
                </div>
            </div>

            <div><br><br></div>

            <div class="row">
                <div class="col-md-6">
                    <p class="size20">
                        <?php echo $content['description']; ?>
                    </p>
                    <div class="size20">&nbsp;</div>
                    <p class="size20">

                    </p>
                    <div class="size20">&nbsp;</div>
                    <p class="size20">

                    </p>
                </div>
                <div class="col-md-6">
                    <?//= Html::img(Url::home() . 'images/content/freitag1.jpg', ['class' => 'img-responsive']) ?>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4">
            <div class="size18">&nbsp;</div>

        </div>
    </div>
</div>
