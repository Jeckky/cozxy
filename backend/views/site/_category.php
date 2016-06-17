
<?php
if (isset($model->image) && !empty($model->image)):
    ?>
    <div class="col-lg-4">
        <a href="<?= Yii::$app->homeUrl . "site/product?id=" . $model->categoryId ?>">
            <h2><img src="<?= Yii::$app->homeUrl . $model->image ?>" style="width:100%"></h2>
            <h2 class="text-center" style="margin-top: -40px"><?= $model->title; ?></h2>
        </a>
                                                                                                                                            <!--<p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
    </div>
    <?php
endif;
?>