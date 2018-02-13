<?php

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProviderNotSalse,
    'options' => [
        'tag' => false,
    ],
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('@app/themes/cozxy/layouts/elastic/_product_item_rev1_json', ['model' => $model, 'hotDeal' => 0]);
    },
    'layout' => "{summary}\n{items}\n<div class=' text-center'>{pager}</div>\n",
    'itemOptions' => [
        'tag' => false,
    ],
]);
?>