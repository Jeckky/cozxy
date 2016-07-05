<!--Categories-->
<div id="products-save-cat" class="category col-lg-4 col-md-4 col-sm-4 col-xs-6">
    <a href="<?php echo Yii::$app->homeUrl; ?>product/coupon?couponOwnerId=<?= $model->couponOwnerId; ?>">
        <img class="col-lg-12" src="<?php echo (isset($model->image) && !empty($model->image)) ? Yii::$app->homeUrl . $model->image : NULL; ?>" alt="1"/>
        <h2 class="text-center"><?= $model->name; ?></h2>
        <p class="text-center"> Code : <?= $model->code; ?> </p>
    </a>
    <p class="text-center">
        <a href="<?= Yii::$app->homeUrl ?>product/coupon-owner/update?id=<?= $model->couponOwnerId ?>" class="btn btn-xs btn-primary">Update</a>
        <a href="<?= Yii::$app->homeUrl ?>product/coupon-owner/delete?id=<?= $model->couponOwnerId ?>" class="btn btn-xs btn-danger">Delete</a>
    </p>
</div>
<!--Categories Close-->
