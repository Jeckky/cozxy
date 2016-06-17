
<div class="col-lg-4">
    <a href="<?= Yii::$app->homeUrl . "site/product-view?id=" . $model->productId ?>">
        <h2><img src="<?= isset($model->productImages[0]) ? Yii::$app->homeUrl . $model->productImages[0]->image : "-" ?>" style="width:100%"></h2>
        <?php if (count($model->productGroup->products) > 1): ?>
            <p class='text-center'><a  class="btn btn-default btn-xs">See More Options</a><p>
            <?php endif; ?>
        <p><?= isset($model->brand) ? $model->brand->title : ""; ?></p>
        <h4 class="" style=""><?= $model->title; ?></h4>
        <h4 class="" style=""><?= $model->code; ?></h4>
        <h3 class="text-danger"><?= isset($model->productOnePrice) ? $model->productOnePrice->price : "Not Set"; ?></h3>
    </a>
                                                                                                                                        <!--<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
</div>