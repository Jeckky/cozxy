<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Tile-->
<?php
foreach ($model as $value) {
    echo 'test : ' . $value->userId;
}
?>