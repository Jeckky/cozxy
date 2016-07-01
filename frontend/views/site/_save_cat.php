<!--Categories-->

<!--Category-->
<div class="category col-lg-2 col-md-2 col-sm-4 col-xs-6">
    <a href="<?php echo Yii::$app->homeUrl; ?>products??category=<?= $model->categoryId; ?>">
        <img src="<?php echo Yii::$app->homeUrl . $model->image; ?>" alt="1"/>
        <p><?= $model->title; ?></p>
        <a href="<?php echo Yii::$app->homeUrl; ?>products?category=<?= $model->categoryId; ?>"><button class="btn btn-primary btn-sm">View</button></a>
    </a>
</div>
<!--Categories Close-->