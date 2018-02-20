<div class="item <?= $index == 0 ? 'active' : '' ?>">
    <img src="<?= Yii::$app->homeUrl.substr($model->image, 1) ?>" alt="Slide 1" style="width:100%;">
    <div class="carousel-caption">
        <h3><?= $model->headTitle ?></h3>
        <p><?= $model->description ?></p>
    </div>
</div>