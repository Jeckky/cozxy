<?php

if (isset($statusStockData)) {
    //echo 'status stock data :' . $statusStockData;
    if ($statusStockData == 'stock') {
        $dataProviderData = $dataProvider;
    } else {
        $dataProviderData = $dataProviderNotSalse;
    }
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProviderData,
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
} else {
    echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
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
}
?>

