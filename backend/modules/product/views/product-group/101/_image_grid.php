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
        'query' => common\models\costfit\ProductImage::find()
        ->where("productId=" . $id),
    ]),
//                                                'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'title',
            'pageSummary' => 'Page Total',
            'vAlign' => 'middle',
            'headerOptions' => ['class' => 'kv-sticky-column'],
            'contentOptions' => ['class' => 'kv-sticky-column'],
            'editableOptions' => ['header' => 'Title', 'size' => 'md',
                'formOptions' => ['action' => ['update-product']],
            ],
        ],
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'description',
            'format' => 'html',
            'pageSummary' => 'Page Total',
            'vAlign' => 'middle',
            'headerOptions' => ['class' => 'kv-sticky-column'],
            'contentOptions' => ['class' => 'kv-sticky-column'],
            'editableOptions' => function ($model, $key, $index) {
                return ['header' => 'Description', 'size' => 'lg',
                    'formOptions' => ['action' => ['update-product']],
                    'beforeInput' => function ($form, $widget) use ($model, $index) {
//                                echo $form->field($model, "description")->widget(\kartik\widgets\DatePicker::classname(), [
//                                    'options' => ['id' => "description_{$index}"]
//                                ]);
                        echo $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6', 'id' => 'product-description-' . $index]);
                        $this->registerJs("
                                                                            init.push(function () {
//                                                                             if (!$('html').hasClass('ie8')) {
                                                                                 $('#product-description-'$index).summernote({
                                                                                     height: 200,
                                                                                     tabsize: 2,
                                                                                     codemirror: {
                                                                                         theme: 'monokai'
                                                                                     }
                                                                                 });
//                                                                             }

                                                                         });

                                                                 ", \yii\web\View::POS_END);
                    }
                ];
            }
        ],
//                    [
//                        'class' => 'kartik\grid\BooleanColumn',
//                        'attribute' => 'status',
//                        'vAlign' => 'middle',
//                    ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => true,
            'vAlign' => 'middle',
            'urlCreator' => function($action, $model, $key, $index) {
                return '#';
            },
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
//                                                'toolbar' => [
//                                                    ['content' =>
//                                                        Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => Yii::t('kvgrid', 'Add Book'), 'class' => 'btn btn-success', 'onclick' => 'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' ' .
//                                                        Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('kvgrid', 'Reset Grid')])
//                                                    ],
//                                                    '{export}',
//                                                    '{toggleData}',
//                                                ],
    // set export properties
//    'export' => [
//        'fontAwesome' => true
//    ],
    'panel' => [
        'type' => GridView::TYPE_SUCCESS,
        'heading' => "Product Image Editor",
    ],
]);
