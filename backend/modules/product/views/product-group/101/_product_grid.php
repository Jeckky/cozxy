<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use kartik\grid\GridView;
use kartik\editable\Editable;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (isset($dataProvider)) {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//                                                'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'expandOneOnly' => true,
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderpartial('101/_image_grid', ['id' => $key
                    ]);
                }
            ],
//                    'productId',
//                                                    [
//                                                        'attribute' => 'title',
//                                                        'format' => 'raw',
//                                                        'value' => function($model) {
//                                                            return Html::a($model->title, ['update-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], ['data-pjax' => 0]);
//                                                        }
//                                                    ],
            'title',
            [
                'attribute' => 'description',
                'options' => ['style' => 'width:20%'],
                'format' => 'html',
            ],
//            [
//                'attribute' => 'specification',
//                'format' => 'raw',
//            ],
//            [
//                'class' => 'kartik\grid\EditableColumn',
//                'attribute' => 'title',
//                'pageSummary' => 'Page Total',
//                'vAlign' => 'middle',
//                'headerOptions' => ['class' => 'kv-sticky-column'],
//                'contentOptions' => ['class' => 'kv-sticky-column'],
//                'editableOptions' => ['header' => 'Title', 'size' => 'md',
//                    'formOptions' => ['action' => ['update-product']],
//                ],
//            ],
//                                                    [
//                                                        'class' => 'kartik\grid\EditableColumn',
//                                                        'attribute' => 'description',
//                                                        'format' => 'html',
//                                                        'pageSummary' => 'Page Total',
//                                                        'vAlign' => 'middle',
//                                                        'headerOptions' => ['class' => 'kv-sticky-column'],
//                                                        'contentOptions' => ['class' => 'kv-sticky-column'],
//                                                        'editableOptions' => function ($model, $key, $index) {
//                                                            return ['header' => 'Description', 'size' => "lg",
//                                                                'formOptions' => ['action' => ['update-product']],
//                                                                'inputType' => Editable::INPUT_TEXTAREA,
//                                                                'options' => [
//                                                                    'rows' => '6',
////                                                                    'id' => 'product-description-' . $index
//                                                                ],
//                                                                'afterInput' => function ($form, $widget) use ($model, $index) {
////                                echo $form->field($model, "description")->widget(\kartik\widgets\DatePicker::classname(), [
////                                    'options' => ['id' => "description_{$index}"]
////                                ]);
//                                                                    $this->registerJs("
//                                                                            init.push(function () {
////                                                                             if (!$('html').hasClass('ie8')) {
//                                                                                 $('#product-$index-description').summernote({
//                                                                                     name:'Product[$index][description]',
//                                                                                     height: 300,
////                                                                                     width:600,
//                                                                                     tabsize: 2,
//                                                                                     codemirror: {
//                                                                                         theme: 'monokai'
//                                                                                     }
//                                                                                 });
////                                                                             }
//
//                                                                         });
//
//                                                                 ", \yii\web\View::POS_END);
//                                                                }
//                                                            ];
//                                                        }
//                                                    ],
//                                                    [
//                                                        'class' => 'kartik\grid\EditableColumn',
//                                                        'attribute' => 'specification',
//                                                        'format' => 'html',
//                                                        'pageSummary' => 'Page Total',
//                                                        'vAlign' => 'middle',
//                                                        'headerOptions' => ['class' => 'kv-sticky-column'],
//                                                        'contentOptions' => ['class' => 'kv-sticky-column'],
//                                                        'editableOptions' => function ($model, $key, $index) {
//                                                            return ['header' => 'Specification', 'size' => 'lg',
//                                                                'formOptions' => ['action' => ['update-product']],
//                                                                'inputType' => Editable::INPUT_TEXTAREA,
//                                                                'options' => [
//                                                                    'rows' => '6',
//                                                                    'id' => 'product-specification-' . $index
//                                                                ],
//                                                                'afterInput' => function ($form, $widget) use ($model, $index) {
////                                echo $form->field($model, "description")->widget(\kartik\widgets\DatePicker::classname(), [
////                                    'options' => ['id' => "description_{$index}"]
////                                ]);
//                                                                    $this->registerJs("
//                                                                            init.push(function () {
////                                                                             if (!$('html').hasClass('ie8')) {
//                                                                                 $('#product-specification-$index').summernote({
//                                                                                     height: 300,
//                                                                                     tabsize: 2,
//                                                                                     codemirror: {
//                                                                                         theme: 'monokai'
//                                                                                     }
//                                                                                 });
////                                                                             }
//
//                                                                         });
//
//                                                                 ", \yii\web\View::POS_END);
//                                                                }
//                                                            ];
//                                                        }
//                                                    ],
            [
                'attribute' => 'option',
                'format' => 'html',
                'value' => function($model) {
                    $options = \common\models\costfit\ProductGroupOptionValue::find()->where("productId =" . $model->productId)->all();
                    $optionStr = "";
                    foreach ($options as $option) {
                        $optionStr.= $option->productGroupOption->name . "-" . $option->value . "<br>";
                    }
                    return $optionStr;
                }
            ],
//                    [
//                        'class' => 'kartik\grid\BooleanColumn',
//                        'attribute' => 'status',
//                        'vAlign' => 'middle',
//                    ],
            [
                'class' => 'kartik\grid\ActionColumn',
//                                                        'dropdown' => FALSE,
                'visible' => (Yii::$app->controller->action->id != "view") ? TRUE : FALSE,
                'vAlign' => 'middle',
                'template' => '{update} {delete}',
                'urlCreator' => function($action, $model, $key, $index) {
//                                                            return '#';
                    if ($action === 'delete') {
                        return \yii\helpers\Url::toRoute(['delete-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]);
                    }
                },
                'buttons' => [
                    "update" => function ($url, $model) {
                        return Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['update-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], [
                            'title' => Yii::t('app', 'Toogle Active'),
                            'data-pjax' => '0',
//                                                                    'data-toggle-active' => $model->productId
                        ]);
                    },
//                                                            "delete" => function ($url, $model) {
//                                                                return Html::a("<span class='glyphicon glyphicon-trash'></span>", ['delete-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], [
////                                                                    'title' => Yii::t('app', 'Toogle Active'),
//                                                                    'title' => "คุณต้องการลบสินค้านี้หรือไม่ ?", 'data-toggle' => 'tooltip'
////                                                                    'data-toggle-active' => $model->productId
//                                                                ]);
//                                                            },
                ],
//                        'viewOptions' => ['title' => $viewMsg, 'data-toggle' => 'tooltip'],
//                                                        'updateOptions' => ['title' => "แก้ไขข้อมูลสินค้า", 'data-toggle' => 'tooltip', 'url' => ['update-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]]],
                'deleteOptions' => ['title' => "คุณต้องการลบสินค้านี้หรือไม่ ?", 'data-toggle' => 'tooltip'],
            ],
//                                                    ['class' => 'kartik\grid\CheckboxColumn']
        ],
        'pjax' => true,
        'pjaxSettings' => [
            'neverTimeout' => true,
//                                                    'beforeGrid' => 'My fancy content before.',
//                                                    'afterGrid' => 'My fancy content after.',
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
            '{toggleData}',
        ],
        // set export properties
//                                                'export' => [
//                                                    'fontAwesome' => true
//                                                ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => "Product Editor",
        ],
    ]);
}
