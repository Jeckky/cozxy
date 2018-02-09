<div class="menu-item sub-<?= $model->brandId ?>-brands" style="padding: 0px; margin-top: 10px;">
    <a class="fc-black" href="<?php echo Yii::$app->homeUrl . 'search/brand/' . $model->encodeParams(['brandId' => $model->brandId]); ?>" style="padding: 5px; "><?php echo $model->title; ?></a>
</div>