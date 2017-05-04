<?php

//foreach ($model as $value) {
//echo 'user : ' . $value->productSuppId . '<br>';
//}
?><?php

echo \yii\widgets\ListView::widget([
    'dataProvider' => $model,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_productCanSell', ['model' => $model]);
    },
    'summaryOptions' => ['class' => 'sort-by-section clearfix'],
    //'layout'=>"{summary}{pager}{items}"
    'layout' => "{items}"
])
?>