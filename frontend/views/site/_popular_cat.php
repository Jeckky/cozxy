<!--Catalog Grid-->

<!--Tile-->
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="tile">
        <!--        <div class="badges">
                    <span class="sale">Sale</span>
                </div>
                <div class="price-label">715,00 $</div>-->
        <a href="<?php echo Yii::$app->homeUrl; ?>products?category=<?= $model->categoryId; ?>">
            <img src="<?php echo Yii::$app->homeUrl . $model->image; ?>" alt="1"/>
            <span class="tile-overlay"></span>
        </a>
        <div class="footer">
            <a href="<?php echo Yii::$app->homeUrl; ?>products?category=<?= $model->categoryId; ?>"><?= $model->title; ?></a>
            <!--<span>by David Banks</span>-->
            <!--<button class="btn btn-primary">Add to Cart</button>-->
        </div>
    </div>
</div>

