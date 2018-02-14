<?php

use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo GridView::widget([
    'id' => 'image-grid',
    'dataProvider' => new ActiveDataProvider([
        'query' => common\models\costfit\ProductImage::find()
            ->where("productId=" . $productId)->orderBy(['status'=>SORT_ASC, 'ordering'=>SORT_ASC]),
    ]),
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function ($model) {
                return \yii\helpers\Html::a(\yii\helpers\Html::img(Yii::$app->homeUrl . $model->imageThumbnail1, ['style' => (Yii::$app->controller->action->id == "create") ? 'width:100px' : 'width:200px']) . "<== Click To View", Yii::$app->homeUrl . $model->image, ['target' => "_blank", 'data-pjax' => 0]);
            }
        ],
        'ordering',
        [
            'class' => 'kartik\grid\ActionColumn',
//            'visible' => (Yii::$app->controller->action->id != "view") ? TRUE : FALSE,
            'vAlign' => 'middle',
            'template' => '{up} {down} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if($action === 'delete' && Yii::$app->controller->action->id != "view") {
                    return \yii\helpers\Url::toRoute(['delete-product-image', 'id' => $model->productImageId, 'action' => (Yii::$app->controller->action->id == "update-product") ? "update" : NULL]);
                }
            },
            'buttons' => [
                "up" => function ($url, $model, $index) {
                    return \yii\helpers\Html::a("up", ['move-image-up', 'id' => $model->productImageId, 'action' => (Yii::$app->controller->action->id == "update-product") ? "update" : NULL], [
                        'title' => Yii::t('app', 'Move up'),
                        'class' => 'btn btn-info btn-xs moveImageUp',
                        'data-pjax' => '0',
                        'data-id'=>$model->productImageId
                    ]);
                },
                "down" => function ($url, $model, $index) {
                    return \yii\helpers\Html::a("Down", ['move-image-down', 'id' => $model->productImageId, 'action' => (Yii::$app->controller->action->id == "update-product") ? "update" : NULL], [
                        'title' => Yii::t('app', 'Move down'),
                        'class' => 'btn btn-info btn-xs moveImageDown',
                        'data-pjax' => '0',
                        'data-id'=>$model->productImageId,
                    ]);
                },
            ],
            'deleteOptions' => ['title' => "คุณต้องการลบรูปนี้หรือไม่ ?", 'data-toggle' => 'tooltip'],
        ],
    ],
    'pjax' => true,
    'pjaxSettings' => [
        'neverTimeout' => true,
    ],
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    // set your toolbar
    'toolbar' => [
    ],
]);

$this->registerJs("
$('body').on('click', '.moveImageUp', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    
    $.ajax({
        url:'".Url::to(['move-image-up'])."?id='+id,
        dataType:'json',
        method:'GET',
    })
    .done(function(data){
        if(data.result == true)
            $.pjax({container:'#image-grid-pjax'});
    });
});

$('body').on('click', '.moveImageDown', function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    
    $.ajax({
        url:'".Url::to(['move-image-down'])."?id='+id,
        dataType:'json',
        method:'GET',
    })
    .done(function(data){
        if(data.result == true)
            $.pjax({container:'#image-grid-pjax'});
    });
});
");
