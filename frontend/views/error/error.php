<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div class="product-list">
    <div class="container">
        <div class="row">
            <h3 class="b"><?= strtoupper('Page not found.') ?></h3>
            <div class="col-xs-12 text-center">
                <div class="row">
                    <div class="wf-container">
                        <!--Body-->
                        <div class="page-404">
                            <div class="content">
                                <div class="inner">
                                    <div class="block">
                                        <span>404</span>
                                        <p>Sorry... Page not found.</p>
                                        <a class="btn btn-primary" href="<?php echo Yii::$app->homeUrl; ?>">Back home</a>
                                        <br><br>
                                    </div>
                                </div>
                            </div>
                        </div><!--Body Close-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>