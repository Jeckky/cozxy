<div class="col-md-2 col-sm-6 col-xs-6 text-center" style="height: 120px;">
    <div class="row-1">
        <a class="" href="<?php echo Yii::$app->homeUrl . 'search/brand/' . $model->encodeParams(['brandId' => $model->brandId]); ?>">
            <img src="<?php echo Yii::$app->homeUrl . substr($model->image, 1); ?>" alt="" title="<?php echo $model->title; ?>" class="img-responsive img-thumbnail" style="width:112px; height: 64px;"/>
        </a>
    </div>
    <div class="text-center" >
        <p class="brand size14" style=" margin-top:10px;">
            &nbsp;<?= $model->title ?>
        </p>
    </div>
</div>