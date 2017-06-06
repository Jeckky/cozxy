<?php

use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use kartik\editable\Editable;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo GridView::widget([
    'dataProvider' => new ActiveDataProvider([
        'query' => common\models\costfit\ProductImageSuppliers::find()
        ->where("productSuppId=" . $id)->orderBy("ordering ASC"),
    ]),
//                                                'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'image',
            'format' => 'raw',
            'value' => function($model) {
                return \yii\helpers\Html::a(\yii\helpers\Html::img(Yii::$app->homeUrl . $model->imageThumbnail1, ['style' => (Yii::$app->controller->action->id == "create") ? 'width:100px' : 'width:200px']) . "<== Click To View", Yii::$app->homeUrl . $model->image, ['target' => "_blank", 'data-pjax' => 0]);
            }
        ],
        'ordering',
//                    [
//                        'class' => 'kartik\grid\BooleanColumn',
//                        'attribute' => 'status',
//                        'vAlign' => 'middle',
//                    ],
        [
            'class' => 'kartik\grid\ActionColumn',
//            'dropdown' => true,
            'visible' => (Yii::$app->controller->action->id != "view") ? TRUE : FALSE,
            'vAlign' => 'middle',
            'template' => '{ordering} {delete}',
            'urlCreator' => function($action, $model, $key, $index) {
                return \yii\helpers\Url::toRoute(['delete-product-supp-image', 'id' => $model->productImageId]);
            },
            'buttons' => [
                "ordering" => function ($url, $model, $index) {
                    return \yii\helpers\Html::a("<span class='glyphicon glyphicon-sort-by-alphabet'></span> Ordering ", ['change-image-order', 'id' => $model->productImageId], [
                        'title' => Yii::t('app', 'Toogle Active'),
                        'class' => 'btn btn-info',
                        'data-pjax' => '0',
//                                                                    'data-toggle-active' => $model->productId
                    ]);
                },
            ],
//                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
//                        'updateOptions' => ['title' => $updateMsg, 'data-toggle' => 'tooltip'],
            'deleteOptions' => ['title' => "คุณต้องการลบสินค้านี้หรือไม่ ?", 'data-toggle' => 'tooltip'],
        ],
//        ['class' => 'kartik\grid\CheckboxColumn']
    ],
    'pjax' => true,
    'pjaxSettings' => [
        'neverTimeout' => true,
//        'beforeGrid' => 'My fancy content before.',
//        'afterGrid' => 'My fancy content after.',
    ],
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar' => [
//                                                    ['content' =>
//                                                        Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
//                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
//                                                    ],
//                                                    '{export}',
//        '{toggleData}',
    ],
    // set export properties
//    'export' => [
//        'fontAwesome' => true
//    ],
    'panel' => [
        'type' => GridView::TYPE_SUCCESS,
        'heading' => (Yii::$app->controller->action->id == "create" && $_GET["step"] != 2) ? "<span style='color:black;font-weight:bold'>Product Image Editor</span> " . \yii\helpers\Html::a("<span class='glyphicon glyphicon-plus'></span>", ['update-product', 'id' => $id, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], ['class' => 'btn btn-primary']) : "<span style='color:black;font-weight:bold'>Product Image Editor</span> ",
    ],
]);
