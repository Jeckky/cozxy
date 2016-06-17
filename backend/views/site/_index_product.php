<div class="row">
    <div class="span2"></div>
    <div class="span10">
        <?php
        echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render('_product', ['model' => $model]);
            },
            'summaryOptions' => ['class' => 'sort-by-section clearfix'],
//            'layout'=>"{summary}{pager}{items}"
            'layout' => "{items}"
        ]);
        ?>
    </div>
</div>


