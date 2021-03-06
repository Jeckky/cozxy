<?php

use common\models\costfit\ProductSuppliers;
use common\models\costfit\ProductPost;
?>
<div class="panel panel-defailt">
    <h3 class="page-header" style="margin:10px 20px;">POPULAR STORIES</h3>
    <div class="panel-body">
        <?php
        //throw new \yii\base\Exception(count($popularStories));
        //echo '<pre>';
        //print_r($popularStories);
        //print_r($popularStoriesNoneStar);
        //exit();
        if (isset($popularStories) && count($popularStories) > 0) {
            foreach ($popularStories as $post):
                $img = ProductSuppliers::ImagesFromPost($post->productPostId, $productSuppId);
                $star = frontend\models\DisplayMyStory::calculatePostRating($post->productPostId);
                $value = explode(",", $star);
                $posts = ProductPost::PostDetail($post->productPostId);
                //$productId = ProductSuppliers::productId(ProductPost::PostDetail($post->productPostId)->productId);
                $productId = ProductSuppliers::productId($productSuppId);
                $url = Yii::$app->homeUrl . 'story/' . $post->encodeParams(['productPostId' => $post->productPostId, 'productId' => $productId, 'productSupplierId' => $productSuppId]);
                ?>
                <div style="border-bottom:1px solid #999;margin-bottom: 18px;">
                    <img src="<?= $img ?>" alt="" class="fullwidth" style="margin-bottom:10px;">
                    <div class="size12 fc-g666"><?= ProductPost::userPost($post->productPostId) ?></div>
                    <div class="size16 b" style="margin-top:-5px;">
                        <a href="<?= $url ?>" class="fc-black"><?= $posts->title ?></a>
                    </div>
                    <div class="size6">&nbsp;</div>
                    <div class="row text-center size14">
                        <div class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-eye"></i> <?= ProductPost::getCountViews($post->productPostId) ?></div>
                        <div class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-star"></i> <?= $value[0] ?></div>
                    </div>
                </div>
                <?php
            endforeach;
        }

        //throw new \yii\base\Exception(count($popularStoriesNoneStar));//sak comment product none star 21/11/2560
        /* if (isset($popularStoriesNoneStar) && count($popularStoriesNoneStar) > 0) {
          foreach ($popularStoriesNoneStar as $post):
          $img = ProductSuppliers::ImagesFromPost($post->productPostId, $productSuppId);
          $star = frontend\models\DisplayMyStory::calculatePostRating($post->productPostId);
          $value = explode(",", $star);
          $posts = ProductPost::PostDetail($post->productPostId);
          // $productId = ProductSuppliers::productId(ProductPost::PostDetail($post->productPostId)->productId);
          $productId = ProductSuppliers::productId($productSuppId);
          $url = Yii::$app->homeUrl . 'story/' . $post->encodeParams(['productPostId' => $post->productPostId, 'productId' => $productId, 'productSupplierId' => $productSuppId]);
          ?>
          <div style="border-bottom:1px solid #999;margin-bottom: 18px;">
          <img src="<?= $img ?>" alt="" class="fullwidth" style="margin-bottom:10px;">
          <div class="size12 fc-g666"><?= ProductPost::userPost($post->productPostId) ?></div>
          <div class="size16 b" style="margin-top:-5px;">
          <a href="<?= $url ?>" class="fc-black"><?= $posts->title ?></a>
          </div>
          <div class="size6">&nbsp;</div>
          <div class="row text-center size14">
          <div class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-eye"></i> <?= ProductPost::getCountViews($post->productPostId) ?></div>
          <div class="col-md-6 col-sm-6 col-xs-6"><i class="fa fa-star"></i> <?= $value[0] ?></div>
          </div>
          </div>
          <?php
          endforeach;
          } */
        ?>

        <div class="text-center"><a href="<?= $urlSeeAll ?>" class="b btn-g999" style="margin:24px auto 12px">See All</a></div>
    </div>
</div>
