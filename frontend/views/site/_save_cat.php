<!--Categories-->
<?php
?>
<div id="products-save-cat" class="category col-lg-2 col-md-2 col-sm-4 col-xs-6">
    <!--    <a href="--><?php //echo Yii::$app->homeUrl;  ?><!--search?category=--><?//= $model->categoryId; ?><!--">-->
    <a href="<?php echo Yii::$app->homeUrl; ?>search/<?= $model->createTitle() ?>/<?= $model->encodeParams(['categoryId' => $model->categoryId]) ?>">
        <img src="<?php echo (isset($model->image) && !empty($model->image)) ? Yii::$app->homeUrl . $model->image : Yii::$app->homeUrl . "/../themes/costfit/assets/img/categories/1.png"; ?>" alt="1"/>
        <p><?= $model->title; ?></p>
    </a>
</div>
<!--Categories Close-->
