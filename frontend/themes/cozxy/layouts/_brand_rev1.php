
<a class="" href="<?php echo Yii::$app->homeUrl . 'search/brand/' . $model->encodeParams(['brandId' => $model->brandId]); ?>">
    <img src="<?php echo Yii::$app->homeUrl . substr($model->image, 1); ?>" alt="" title="<?php echo $model->title; ?>" class="img-responsive" style="width:112px; height: 64px;"/>
</a>