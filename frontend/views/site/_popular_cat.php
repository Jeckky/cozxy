<!--Categories Close-->
<div class="col-lg-3 col-md-4 col-sm-6">
    <div class="tile">
        <!--<div class="badges">
            <span class="sale">Sale</span>
        </div>
        <div class="price-label">715,00 $</div>-->
        <a href="#">
            <img src="<?php
            echo (isset($model->image) && !empty($model->image)) ? Yii::$app->homeUrl . $model->image : Yii::$app->urlManagerFrontend->baseUrl . "/../themes/costfit/assets/img/catalog/1.png";
            ;
            ?>" alt="1"/>
            <span class="tile-overlay"></span>
        </a>
        <div class="footer">
            <a href="<?php echo Yii::$app->homeUrl; ?>search?category=<?= $model->categoryId; ?>"><?= $model->title; ?></a>
            <span>
                <small><?= $model->title; ?></small>
            </span>
            <a href="<?php echo Yii::$app->homeUrl; ?>search?category=<?= $model->categoryId; ?>"><button class="btn btn-primary btn-sm">view</button></a>
        </div>
    </div>
</div>

