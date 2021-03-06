<?php
/* @var $this yii\web\View */
//$this->title = 'My Cost Fit';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
//throw new \yii\base\Exception($baseUrl);
?>
<style type="text/css">
    .cat-tiles h2
    {
        font-size: 1.75em;
        color: #000000;
        font-weight: 100;
        margin-bottom: 44px;
    }
    .see-more
    {
        cursor: hand;
    }
    .catalog-grid h2 {
        color: #292c2e;
    }
</style>
<!--Hero Slider-->
<section class="hero-slider" style="background-color: #f1efef;margin-top: -10px ;">
    <div class="master-slider" id="hero-slider">
        <?php
        foreach ($bannerGroup->contents as $banner) {
            //throw new Exception($banner->linkTitle);
            ?>
            <!--Slide 1-->
            <div class="ms-slide" data-delay="7" style="background-image: url('<?= $baseUrl . $banner->image ?>');background-size: 100% 100%;">
                <div class="overlay"></div>
                <div class="ms-anim-layers">
                    <div class="ms-layer text-block" style="margin: 50px; padding: 108px 0px 0px 25px; font-size: 16px; line-height: 22px;">
                        <h2 style="width: 756px; left: 110px; top: 110px;text-align: left;" class="dark-color ms-layer" data-effect="top(50,true)" data-duration="700" data-delay="250" data-ease="easeOutQuad">
                            <?= $banner->headTitle ?><br>
                            <?= $banner->title ?>
                        </h2>
                        <?php
                        $desc = str_replace("<p>", " ", str_replace("</p>", " ", str_replace("</p><p>", "<br>", $banner->description)));
                        //throw new \yii\base\Exception($banner->description . "----" . $desc);
                        ?>
                        <p style="width: 756px; left: 110px; top: 250px; text-align: left;" class="dark-color ms-layer col-md-7 " data-effect="back(500)" data-duration="700" data-delay="500" data-ease="easeOutQuad"><?= $desc; ?></p>
                        <?php if (isset($banner->linkTitle) && !empty($banner->linkTitle)): ?>
                                                                                                                                                                                                                <!--<p style="width: 456px; left: 20px; top: 170px;" class="dark-color col-md-7">
                                                                                                                                                                                                                <a class="btn btn-primary" href="<?//= $banner->link; ?>"><?//= $banner->linkTitle ?></a>
                                                                                                                                                                                                                </p>-->
                        <?php endif; ?>
                        <!--<a class="btn btn-black" href="#">Browse all</a>-->
                    </div>
                    <!--<img style="right: 200px;" class="ms-layer img-block" src="<?= $baseUrl . $banner->image ?>" alt="1" data-effect="back(500)" data-duration="800" data-delay="350" data-ease="easeOutQuad"/>-->
                </div>
            </div>
            <?php
        }
        ?>
    </div>

</section><!--Hero Slider Close-->

<!--
<section class="catalog-grid">
    <div class="container">
        <h2>HOT PRODUCTS</h2>
        <div class="row">

<?php
/* echo \yii\widgets\ListView::widget([
  'dataProvider' => $hotProduct,
  'options' => [
  'tag' => 'div',
  'class' => 'list-wrapper',
  'id' => 'list-wrapper',
  ],
  'itemView' => function ($model, $key, $index, $widget) {
  return $this->render('_hot_product', ['model' => $model]);
  },
  'summaryOptions' => ['class' => 'sort-by-section clearfix'],
  //            'layout'=>"{summary}{pager}{items}"
  'layout' => "{items}"
  ]) */
?>
        </div>
    </div>
</section>-->

<section class="catalog-grid">
    <div class="container">
        <h2 class="dark-color"><!--EXPLORE--> RECOMMENDED </h2>
        <div class="row">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $productCanSell,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_productCanSell', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}"
            ])
            ?>
        </div>
    </div>
</section>

<section class="catalog-grid">
    <div class="container">
        <h2 class="dark-color">PRODUCTS</h2>
        <div class="row">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $productNotSell,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_productNotSell', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                //'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}"
            ])
            ?>
        </div>
    </div>
</section>
<style>
    .brand-carousel-reviews {
        padding: 24px 0 48px 0;
        border-top: 0px solid #e6e6e6;
        border-bottom: 0px solid #e6e6e6;
    }
    .post footer .meta {
        display: inline-flex;
        text-align: left;
    }
    .share > a{
        font-size: 12px;
    }
    .p-style3{
        font-size: 14px;
        text-align: left;
    }
    blockquote {
        font-size: 14px;
    }
    .reviews-rate > img {
        display: initial;
        max-width: 100%;
        height: auto;
    }

</style>

<section class="catalog-grid">
    <div class="container">
        <h2 class="dark-color">Products' Stories</h2>
        <section class="brand-carousel" id="brand-carousel-reviews" style=" border-top: 0px ;  border-bottom: 0px ;">
            <div class="container">
                <div class="inner" style="max-width: 100%;">

                    <?php
                    if (count($productPost) > 0) {
                        foreach ($productPost as $key => $value) {

                            $member = \common\models\costfit\User::find()->where('userId=' . $value->userId)->one();
                            $rating_score = \common\helpers\Reviews::RatingInProduct($value->productSuppId, $value->productPostId);
                            $rating_member = \common\helpers\Reviews::RatingInMember($value->productSuppId, $value->productPostId);
                            $rating_count = \common\models\costfit\ProductPost::find()->where('productSuppId=' . $value->productSuppId)->count('productSuppId');

                            if ($rating_score == 0 && $rating_member == 0) {
                                $results_rating = 0;
                            } else {
                                $results_rating = $rating_score / $rating_member;
                            }

                            $productPostList = \common\models\costfit\ProductSuppliers::find()->where('productSuppId =' . $value->productSuppId)->all();
                            foreach ($productPostList as $valuex) {
                                $productImages = \common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $value->productSuppId)->orderBy('ordering asc')->limit(1)->all();
                                $productViews = common\models\costfit\ProductPageViews::find()->where('productSuppId=' . $value->productSuppId)->count();
                                ?>
                                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-left: 0px; padding-left: 0px;">
                                    <div class="tile">
                                        <div style="height: 228px; width: 100%;">
                                            <?php
                                            foreach ($productImages as $valueImages) {
                                                if (isset($valueImages['imageThumbnail1']) && !empty($valueImages['imageThumbnail1'])) {
                                                    if (file_exists(Yii::$app->basePath . "/web/" . $valueImages['imageThumbnail1'])) {
                                                        //echo "<div class=\"col-sm-3\"><img id=\"myImg-" . $valueImages['productImageId'] . "\" onClick=\"reviews_click(" . $valueImages['productImageId'] . ',' . "xx" . ")\"   src=\"/" . $valueImages['imageThumbnail2'] . "\" alt=\"1\" class=\"img-responsive img-thumbnail myImg\"/></div>";
                                                        ?>
                                                        <div class="col-sm-12 col-lg-12 col-md-12" style="padding-left: 0px;  padding-right: 0px; height: 228px;">
                                                            <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                                                <img  src="<?php echo $valueImages['imageThumbnail1']; ?>" alt="1" class="img-responsive  myImg">
                                                            </a>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        echo "<div class=\"col-sm-12 col-lg-12 col-md-12\" style=\"padding-left: 0px; padding-right: 0px; height: 228px; \">"
                                                        . "<center><img  class=\"ms-thumb\"  src=\"" . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive  \"/></center>"
                                                        . "</div>";
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="col-sm-12 col-lg-12 col-md-12" style="padding-left: 0px;  padding-right: 0px; height: 228px;">
                                                        <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                                            <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <span class="tile-overlay"></span>
                                        <div class="footer" id="products-popular-footer" style="max-height: 320px;min-height: 80px;">
                                            <span>
                                                <small>
                                                    <?php
                                                    echo ($rating_count == 1) ? '<span style="font-size: 12px; color:#0066c0;">' . $rating_count . ' Story  </span>' : '<span style="font-size: 12px; color:#0066c0;">' . $rating_count . ' Stories  </span>';
                                                    ?>
                                                </small>
                                            </span>
                                            <div style="height: 60px;">
                                                <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                                    <?php
                                                    //echo strlen($valuex->title) . '<br>';
                                                    if (strlen($valuex->title) >= 35) {
                                                        echo substr($valuex->title, 0, 35);
                                                    } else if (strlen($valuex->title) < 35) {
                                                        echo substr(ltrim(rtrim($valuex->title)), 0, 35) . '<br>';
                                                    }
                                                    ?></a>
                                            </div>
                                            <a href="/products/V52KtMKZH6RkAOgLSXcBcRJLWqFq6zJxIV3-VL6W2j8-clhu-3zVCzQSUZ9UqxRY"><button class="btn btn-primary btn-sm">view</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center" style=" border: 0px #e6e6e6 solid;  padding-left: 0px; padding-left: 0px;">

                                    <div class="tile col-sm-12 col-lg-12 col-md-12 text-center" style="padding: 0px; border: 1px #e2dfdf solid; ">
                                        <br>
                                        <div style="height: 60px;">
                                            <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                                <?php
                                                //echo strlen($valuex->title) . '<br>';
                                                if (strlen($valuex->title) >= 35) {
                                                    echo substr($valuex->title, 0, 35);
                                                } else if (strlen($valuex->title) < 35) {
                                                    echo substr(ltrim(rtrim($valuex->title)), 0, 35) . '<br>';
                                                }
                                                ?></a>
                                        </div>

                                        <div class="col-sm-12 col-lg-12 col-md-12 text-center" style="margin-top: 10px; padding: 5px; border: 0px #e6e6e6 solid;">
                                            <?php
                                            foreach ($productImages as $valueImages) {
                                                if (isset($valueImages['imageThumbnail1']) && !empty($valueImages['imageThumbnail1'])) {
                                                    if (file_exists(Yii::$app->basePath . "/web/" . $valueImages['imageThumbnail1'])) {
                                                        //echo "<div class=\"col-sm-3\"><img id=\"myImg-" . $valueImages['productImageId'] . "\" onClick=\"reviews_click(" . $valueImages['productImageId'] . ',' . "xx" . ")\"   src=\"/" . $valueImages['imageThumbnail2'] . "\" alt=\"1\" class=\"img-responsive img-thumbnail myImg\"/></div>";
                                                        ?>
                                                        <div class="col-sm-12 col-lg-12 col-md-12" style="padding-left: 0px;  padding-right: 0px; height: 228px;">
                                                            <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                                                <img  src="<?php echo $valueImages['imageThumbnail1']; ?>" alt="1" class="img-responsive  myImg">
                                                            </a>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        echo "<div class=\"col-sm-12 col-lg-12 col-md-12\" style=\"padding-left: 0px; padding-right: 0px; height: 228px; \">"
                                                        . "<center><img  class=\"ms-thumb\"  src=\"" . "images/ContentGroup/DUHWYsdXVc.png\" alt=\"1\" width=\"137\" height=\"130\" class=\"img-responsive  \"/></center>"
                                                        . "</div>";
                                                    }
                                                } else {
                                                    ?>
                                                    <div class="col-sm-12 col-lg-12 col-md-12" style="padding-left: 0px;  padding-right: 0px; height: 228px;">
                                                        <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-review?productPostId=<?php echo $value->productPostId; ?>&productSupplierId=<?php echo $valuex->productSuppId; ?>&productId=<?php echo $valuex->productId; ?>" style="font-size: 14px; margin-top: 5px;">
                                                            <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <span class="tile-overlay"></span>
                                        <div class="footer" id="products-popular-footer" style="max-height: 320px;min-height: 80px;">
                                            <div class="col-md-12 text-center" style=" border-bottom: 0px #e6e6e6 dotted; border-top: 0px #bbb dotted;padding-left: 0px;  padding-right: 0px; ">
                                                <?php
                                                //echo '<span style="font-size: 12px; color:#0066c0;">' . number_format($results_rating, 3) . ' จาก 5 คะแนน | ' . $rating_count . ' post  </span>';
                                                echo ($rating_count == 1) ? '<span style="font-size: 12px; color:#0066c0;">' . $rating_count . ' Story  </span>' : '<span style="font-size: 12px; color:#0066c0;">' . $rating_count . ' Stories  </span>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            //echo '</div>';
                            //echo '</div>';
                        }
                        ?>
                        <div class="col-md-12 text-center" style=" /* margin-left: 2px; */border: 0px #e6e6e6 solid;/* padding: 5px; */ padding-left: 0px; padding-left: 0px;">
                            <div class="col-sm-12 col-lg-12 col-md-12 text-center" style="padding: 0px; border: 1px #e2dfdf solid; ">
                                <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-more" style="font-size: 14px; margin-top: 5px;">
                                    See more
                                </a>
                                <div class="col-sm-12 col-lg-12 col-md-12 text-center" style="margin-top: 10px; padding: 5px; border: 0px #e6e6e6 solid;height: 228px;">
                                    <img class="ms-thumb" src="<?php echo "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1" width="137" height="130" class="img-responsive img-thumbnail"/>
                                </div>
                                <div class="col-md-12 text-center" style=" border-bottom: 0px #e6e6e6 dotted; border-top: 1px #bbb dotted;padding-left: 0px;  padding-right: 0px; ">
                                    <a href="<?php echo Yii::$app->homeUrl; ?>reviews/see-more" style="font-size: 12px; margin-top: 5px;">
                                        See more
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                }
                //echo '<hr>';
                ?>
            </div>
    </div>
</section>
</div>
</section>

<!--Hero Slider Close
<section class="cat-tiles" style="background-color: #f1efef;">
    <div class="container">
        <h2>SAVE ON EVERYDAY ESSENTIALS</h2>
        <div class="row" id="save-main-limit">
<?php
/* echo \yii\widgets\ListView::widget([
  'dataProvider' => $saveCat,
  'itemView' => function ($model, $key, $index, $widget) {
  return $this->render('_save_cat', ['model' => $model]);
  },
  'summaryOptions' => ['class' => 'sort-by-section clearfix'],
  //   'layout' => "{items}\n{pager}",
  'layout' => "{items}"
  ]); */
?>
        </div>
        <div class="row" id="save-main-limit"></div>
<?php if ($saveCat->getTotalCount() > 6): ?>

<?php endif; ?>
    </div>
</section> Categories Close-->
<!--Saved Category-->
<!--Popular Category-->
<section class="catalog-grid">
    <div class="container">
        <h2 class="dark-color">SHOP POPULAR CATEGORIES</h2>
        <div class="row">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $popularCat,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('_popular_cat', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                'layout' => "{items}{pager}",
                'pager' => [
                    //            'firstPageLabel' => 'first',
                    //            'lastPageLabel' => 'last',
                    'prevPageLabel' => '<span class="icon-arrow-left"></span>',
                    'nextPageLabel' => '<span class="icon-arrow-right"></span>',
                    //            'maxButtonCount' => 3,
                    // Customzing options for pager container tag
                    //            'options' => [
                    //                'tag' => 'div',
                    //                'class' => 'pager-wrapper',
                    //                'id' => 'pager-container',
                    //            ],
                    // Customzing CSS class for pager link
                    //            'linkOptions' => ['class' => 'mylink'],
                    //            'activePageCssClass' => 'active',
                    //            'disabledPageCssClass' => 'mydisable',
                    // Customzing CSS class for navigating link
                    'prevPageCssClass' => 'prev-page',
                    'nextPageCssClass' => 'next-page',
                //            'firstPageCssClass' => 'myfirst',
                //            'lastPageCssClass' => 'mylast',
                ],
            ])
            ?>
        </div>
    </div>
    <!--Popular Category Close-->
    <!--Info Block with Image Background-->
    <style type="text/css">
        .info-block-image {
            position: relative;
            /* width: 100%;
             padding: 72px 0 60px 0; */
            overflow: hidden;
            color: #fff;
            background-position: 50% 0;
            background-repeat: no-repeat;
            background-size: 100% 100%, cover;
        }
    </style>
    <section style="background-image: url(<?php echo $baseUrl . $topOneContent->image; ?>);" class="info-block-image" data-stellar-background-ratio="0.5">
        <!--<div class="overlay"></div>-->
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                    <h2><?php echo $topOneContent->title; ?></h2>
                    <div class="row">
                        <div class="icon col-lg-4 col-md-4 col-sm-4">
                            &nbsp;
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <p class="p-style3"><?php echo $topOneContent->description; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--Info Block Close-->
    <!--
    <section style="background-position: 50% 145.5px; background-color: #f5f5f5; " data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row" style="background-image: url('<?php //echo $baseUrl . $topOneContent->image;
            ?>'); background-position: center center;
                 background-repeat:  no-repeat;
                 background-size:  cover;
                 background-color: #999;">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12">
                    <h2 class="dark-color"><?php //echo $topOneContent->title;                                                            ?></h2>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="color: #fff;">
                            <p class="p-style3" style="color: #fff;">
    <?php //echo $topOneContent->description; ?>
                            </p>
                        </div>
    <!--
    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom: 10px;">
        <button class="btn btn-black btn-xs">READ MORE</button>
    </div>
    -/->
</div>
</div>
</div>
</div>
</section>-->

    <!--Tabs Widget-->


    <!--Features Tabs-->
    <section class="feature-tabs " style="background-color: #e2dfdf;padding-top: 0px">
        <div class="container " >
            <div class="row" >
                <?php
                $i = 1;
                foreach ($bottomContent as $content) {
                    if ($i > 3) {
                        break;
                    }
                    ?>
                    <div class="col-lg-4 col-md-4">
                        <!--<div class="tabs-pane current" id="tab-1">-->
                        <img class="col-lg-12 img-responsive" src="<?= (Yii::$app->homeUrl != "/") ? Yii::$app->homeUrl . $content->image : $content->image; ?>" style="margin-top: 10px" />
                        <h2 style="color:black;text-align: center">
                            <?php echo $content->title; ?>
                        </h2>
                        <hr style="border-color: rgba(255, 212, 36, .9);border-width: 3px;width:70%" >
                        <span class="p-style3" style="text-align: center;font-size: 20px"><?php echo $content->description; ?></span>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
        </div>
    </section>
    <style>
        /* Style the Image Used to Trigger the Modal */
        .myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;

        }

        .myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            /*z-index: 1;  Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            float: right;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 100%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
            text-align: right;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close-reviews {
            position: absolute;
            top: 50px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            color: rgba(255,212,36,.9);
        }

        .close-reviews:hover,
        .close-reviews:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
        .scores-reviews{
            width: auto;
        }
        .scores-reviews >img{
            display: initial;
            max-width: 100%;
            height: auto;
        }
        .test{
            height: 350px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

    </style>
    <!-- Trigger the Modal -->

    <!-- The Modal -->
    <div id="myModalReviews" class="modal">

        <!-- The Close Button -->
        <span class="close-reviews" onclick="document.getElementById('myModalReviews').style.display = 'none'">&times;</span>

        <!-- Modal Content (The Image) -->
        <div class="col-md-6">
            <img class="modal-content" id="img01">
        </div>

        <div class="col-md-6">
            <div class="col-md-9 text-left" style="color: #ffffff;">
                <span class="titles-reviews" style="color: #e2dfdf;"></span>
                <hr>
            </div>
            <div class="col-md-9 text-left">
                <div class="test">
                    <div class="title-reviews"></div>
                    <div class="score-reviews"></div>
                    <div class="content-reviews"></div>
                    <div class="username-reviews"></div>
                </div>
            </div>
            <div class="col-md-12">&nbsp;</div>
        </div>
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>
    <script>
        // Get the modal

        function reviews_click(productSuppId, id, srcs, title) {
            //alert(productSuppId + '::' + id);
            //alert(title);
            //console.log(srcs);
            var modal = document.getElementById('myModalReviews');
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg-' + id);
            //var img = document.getElementById('myImgs');
            //console.log(img);
            var modalImg = document.getElementById("img01");
            //console.log(modalImg);
            var captionText = document.getElementById("caption");
            modal.style.display = "block";
            modalImg.src = srcs;
            $('.titles-reviews').html(title);

            $.ajax({
                type: "POST",
                dataType: "JSON",
                url: $baseUrl + "site/reviews",
                data: {productSuppId: productSuppId, productImageId: id},
                success: function (data, status)
                {
                    $('.test').html('');

                    if (status == "success") {
                        var json = data;
                        var rex = /(<([^>]+)>)/ig;
                        //alert(txt.replace(rex, ""));
                        var Num = 1;

                        for (var i = 0; i < json.length; i++) {
                            //$('.scores-reviews').html('');
                            var obj = json[i];
                            var description = obj.title;
                            var scores = obj.score;

                            if (scores == 1) {
                                $('.test').append('<div style=\"padding: 10px;font-size: 14px;\"><strong>Post #' + Num++ + '\n\ :</strong> ' + description.replace(rex, "") + ' \n\
                             <div class="scores-reviews">&nbsp;&nbsp;<img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-off.png"><img title="' + scores + '" src="images/star-off.png"><img title="' + scores + '" src="images/star-off.png"><img alt="5" src="images/star-off.png" title=""> (Recent Reviews)</div> \n\
                               <span style=\"font-size: 12px;color: #b2b2b2;\">&nbsp;&nbsp;&nbsp;By ' + obj.username + ' <span> </div>'
                                        );
                            }
                            if (scores == 2) {
                                $('.test').append('<div style=\"padding: 10px;font-size: 14px;\"><strong>Post #' + Num++ + '\n\ :</strong> ' + description.replace(rex, "") + ' \n\
                             <div class="scores-reviews">&nbsp;&nbsp;<img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-off.png"><img title="' + scores + '" src="images/star-off.png"><img alt="5" src="images/star-off.png" title=""> (Recent Reviews)</div> \n\
                             <span style=\"font-size: 12px;color: #b2b2b2;\">&nbsp;&nbsp;&nbsp;By ' + obj.username + '<span> </div>'
                                        );
                            }
                            if (scores == 3) {
                                $('.test').append('<div style=\"padding: 10px;font-size: 14px;\"><strong>Post #' + Num++ + '\n\ :</strong> ' + description.replace(rex, "") + '\n\
                             <div class="scores-reviews">&nbsp;&nbsp;<img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-off.png"><img alt="5" src="images/star-off.png" title=""> (Recent Reviews)</div> \n\
                              <span style=\"font-size: 12px;color: #b2b2b2;\">&nbsp;&nbsp;&nbsp;By ' + obj.username + '<span> </div>'
                                        );
                            }
                            if (scores == 4) {
                                $('.test').append('<div style=\"padding: 10px;font-size: 14px;\"><strong>Post #' + Num++ + '\n\ :</strong> ' + description.replace(rex, "") + '\n\
                             <div class="scores-reviews">&nbsp;&nbsp;<img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img alt="5" src="images/star-off.png" title=""> (Recent Reviews)</div> \n\
                              <span style=\"font-size: 12px;color: #b2b2b2;\">&nbsp;&nbsp;&nbsp;By ' + obj.username + '<span> </div>'
                                        );
                            }
                            if (scores == 5) {
                                $('.test').append('<div style=\"padding: 10px;font-size: 14px;\"><strong>Post #' + Num++ + '\n\ :</strong> ' + description.replace(rex, "") + ' \n\
                             <div class="scores-reviews">&nbsp;&nbsp;<img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img title="' + scores + '" src="images/star-on.png"><img alt="5" src="images/star-on.png" title=""> (Recent Reviews)</div> \n\
                             <span style=\"font-size: 12px;color: #b2b2b2;\">&nbsp&nbsp;nbsp;By ' + obj.username + '<span> </div>'
                                        );
                            }
                            //alert(scores);
                            if (scores == null) {
                                $('.test').append('<div style=\"padding: 10px;font-size: 14px;\"><strong>Post #' + Num++ + '\n\ :</strong> ' + description.replace(rex, "") + '\n\
                             <div class="scores-reviews"></div> \n\
                             <span style=\"font-size: 12px;color: #b2b2b2;\">&nbsp;&nbsp;&nbsp;By ' + obj.username + '<span> </div>'
                                        );
                            }



                        }
                    }
                }
            });
            //captionText.innerHTML = title;
            //captionText.innerHTML = this.alt;
            /*
             img.onload = function () {
             //alert(111);
             modal.style.display = "block";
             modalImg.src = srcs;
             captionText.innerHTML = this.alt;
             }*/
            //console.log(img);

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }
        }
    </script>
    <!--Subscription Widget-->
    <?php //echo $this->render('@app/themes/costfit/layouts/_subscription', compact('lastIndexContent'));  ?>
    <!--Brands Carousel Widget-->
    <?php
//echo Yii::$app->controller->id;
//if (Yii::$app->controller->id != "search") {
    echo $this->render('@app/themes/costfit/layouts/_brand_carousel');
//}
    ?>
