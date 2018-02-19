<div class="sub-<?= $model->brandId ?>-brands menu-item-brands-inbrand">
    <a class="fc-black" href="<?php echo Yii::$app->homeUrl . 'search/brand/' . $model->encodeParams(['brandId' => $model->brandId]); ?>"><?php echo $model->title; ?></a>
</div>