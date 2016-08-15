<?php
//$this->title = 'My Cost Fit';
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
$logo = common\models\costfit\ContentGroup::find()->where("lower(title)='logoimage'")->one();
?>
<header data-offset-top="500" data-stuck="600"><!--data-offset-top is when header converts to small variant and data-stuck when it becomes visible. Values in px represent position of scroll from top. Make sure there is at least 100px between those two values for smooth animation-->

    <!--Search Form-->
    <form class="search-form closed" method="get" role="form" autocomplete="off">
        <div class="container">
            <div class="close-search"><i class="icon-delete"></i></div>
            <div class="form-group">
                <label class="sr-only" for="search-hd">Search for product</label>
                <input type="text" class="form-control" name="search-hd" id="search-hd" placeholder="Search for product">
                <button type="submit"><i class="icon-magnifier"></i></button>
            </div>
        </div>
    </form>

    <!--Mobile Menu Toggle-->
    <div class="menu-toggle"><i class="fa fa-list"></i></div>

    <div class="container">
        <a class="logo" href="<?= Yii::$app->homeUrl ?>"><img src="<?php echo Yii::$app->homeUrl . $logo->image; ?>" alt="Cost Fit" class="img-responsive"/></a>
    </div>

    <!--Main Menu-->
    <?= $this->render('_nav') ?>

    <?= $this->render('_toolbar') ?>
</header><!--Header Close-->