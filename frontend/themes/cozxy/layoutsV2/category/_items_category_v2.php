<div class="col-md-4 col-sm-6 col-xs-6 box-product">
    <div class="product-box">
        <div class="product-img text-center">
            <a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($model->title) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $model->categoryId]) ?>" class="fc-black">
                <img class="media-object fullwidth img-responsive" src="<?= $model->image ?>" width="410" height="256">
                <!--<img class="media-object fullwidth img-responsive" src="<?= Yii::$app->homeUrl ?>images/Category/<?= $index ?>.jpg" width="410" height="256">-->
            </a>
        </div>
    </div>
    <div class="text-center">
        <p class="category">
            <span class="size18">
                <a href="<?= Yii::$app->homeUrl . 'search/' . common\models\ModelMaster::createTitleArray($model->title) . '/' . common\models\ModelMaster::encodeParams(['categoryId' => $model->categoryId]) ?>">
                    <?= strtoupper($model->title) ?></a>
            </span>
        </p>
    </div>
</div>
