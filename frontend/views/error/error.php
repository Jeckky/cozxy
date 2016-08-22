<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Body-->
<div class="page-404">
    <div class="content">
        <div class="inner">
            <div class="block">
                <span>404</span>
                <p>Sorry... Page not found.</p>
                <a class="btn btn-primary" href="<?php echo $baseUrl; ?>">Back home</a>
                <p><span>OR</span>Try to search site</p>
                <form class="search-404" method="post" autocomplete="off" action="<?php echo $baseUrl; ?>/search-cost-fit">
                    <input class="form-control" type="text" name="search_hd" id="search_hd" placeholder="Search">
                    <button type="submit"></button>
                </form>
            </div>
        </div>
    </div>
</div><!--Body Close-->