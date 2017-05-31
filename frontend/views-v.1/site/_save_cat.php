<!--Categories-->
<?php
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<div id="products-save-cat" class="category col-lg-2 col-md-2 col-sm-4 col-xs-6">
    <input type="hidden" id="seeMoreId" value="<?php echo $model->categoryId; ?>">
    <a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $model->createTitle() ?>/<?= $model->encodeParams(['categoryId' => $model->categoryId]) ?>">
        <img src="<?php echo (isset($model->image) && !empty($model->image)) ? $baseUrl . $model->image : $baseUrl . "/images/ContentGroup/DUHWYsdXVc.png"; ?>" alt="1"/>
        <p ><?= $model->title; ?></p>
    </a>
</div>
<!--Categories Close-->
