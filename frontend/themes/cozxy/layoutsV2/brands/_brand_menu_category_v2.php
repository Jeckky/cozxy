<div class="menu-item-brands sub-<?= $model->brandId ?>-brands">
    <a class="fc-black" href="<?php echo Yii::$app->homeUrl . 'search/brand/' . $model->encodeParams(['brandId' => $model->brandId]); ?>"><?php echo $model->title; ?></a>
</div>