<div class="col-md-1 col-sm-3 col-xs-3" style="height: 120px;">
    <div class="row">
        <a class="" href="<?php echo Yii::$app->homeUrl . 'search/brand/' . $model->encodeParams(['brandId' => $model->brandId]); ?>">
            <img src="<?php echo Yii::$app->homeUrl . substr($model->image, 1); ?>" alt="" title="<?php echo $model->title; ?>" class="img-responsive img-thumbnail" style="width:112px; height: 64px;"/>
        </a>
    </div>
    <div class="row text-center" style="width: 95%;">
        <p class="brand size14" style=" margin-top:10px;">
            &nbsp;<?= $model->title ?>
        </p>
    </div>
</div>
