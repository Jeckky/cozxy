<?php

$items = [];
$categorys = common\models\costfit\Category::find()->where("parentId is null")->all();
$i = 1;
foreach ($categorys as $main) {
    $items[$i]['label'] = $main->title;
    $j = 1;
    foreach ($main->childs as $child) {
        $items[$i]['items'][$j]['items'] = $child->title;
        $items[$i]['items'][$j]['url'] = Yii::$app->homeUrl . "site/product?id=" . $child->categoryId;
        $j++;
    }
    $i++;
}
//menu
echo Nav::widget([
    'options' => ['class' => 'nav nav-pills nav-stacked'],
    'items' => $items,
]);
?>