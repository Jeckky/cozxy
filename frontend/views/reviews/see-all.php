<?php
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<section class="catalog-grid">
    <div class="container">
        <h2>HOT PRODUCTS</h2>
        <div class="row">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $productPost,
                'options' => [
                    'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'itemView' => function ($model, $key, $index, $widget) {
                    return $this->render('product-see-more', ['model' => $model]);
                },
                'summaryOptions' => ['class' => 'sort-by-section clearfix'],
                // 'layout'=>"{summary}{pager}{items}"
                'layout' => "{items}"
            ])
            ?>
        </div>
    </div>
</section>
<!--Body-->
