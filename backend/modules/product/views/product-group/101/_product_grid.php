<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use common\models\areawow;
use yii\jui\DatePicker;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\helpers\Url;
use yii\widgets\Pjax;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!isset($isProductSupp)) {
    $isProductSupp = FALSE;
}
$type = !isset($type) ? 1 : $type;

echo "Grid Type=" . $type . "<br>";
if (isset($dataProvider)) {
    $gridId = (!isset($type) || $type == 1) ? "product-grid1" : "product-grid2";
    Pjax::begin(['id' => 'pjax' . $gridId]);
    echo GridView::widget([
        'id' => $gridId,
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
                'detail' => function ($model, $key, $index, $column) use($isProductSupp) {
                    if (!isset($isProductSupp) || !$isProductSupp) {
                        return Yii::$app->controller->renderpartial('101/_image_grid', ['id' => $key
                        ]);
                    } else {
                        return Yii::$app->controller->renderpartial('101/supplier/_image_supp_grid', ['id' => $key
                        ]);
                    }
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
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model) use($type) {
                    return $model->title . " " . Html::button("Edit", ['onclick' => (isset($type) && $type == 2) ? "productModal$type($model->productSuppId)" : "productModal$type($model->productId)", 'class' => 'btn btn-primary btn-xs']);
                }
            ],
            [
                'attribute' => 'option',
                'format' => 'html',
                'options' => ['style' => 'width:10%;text-align:left'],
                'value' => function($model) {
                    $options = \common\models\costfit\ProductGroupOptionValue::find()->where("productId =" . $model->productId . " AND productSuppId is NULL")->all();
                    $optionStr = "";
                    foreach ($options as $option) {
                        $optionStr.= $option->productGroupOption->name . "-" . $option->value . "<br>";
                    }
                    return $optionStr;
                }
            ],
            [
                'attribute' => 'Product Supplier',
                'visible' => (!isset($type) || $type == 1) ? FALSE : TRUE,
                'format' => 'html',
                'options' => ['style' => 'width:10%;text-align:left'],
                'value' => function($model) {
                    $ps = \common\models\costfit\ProductSuppliers::find()->where("productSuppId = $model->productSuppId")->one();
                    if (isset($ps)) {
                        $pps = \common\models\costfit\ProductPriceSuppliers::find()->where("productSuppId = $ps->productSuppId AND status = 1")->one();
                        return isset($pps) ? "Stock : $ps->result" . "<br> Selling Price : " . number_format($pps->price) : "Stock : $ps->result";
                    } else {
                        return NULL;
                    }
                }
            ],
            ['attribute' => 'status',
//                'visible' => (!isset($type) || $type == 1) ? FALSE : TRUE,
                'options' => [
                    'style' => 'width:7%'
                ],
                'value' => function ($model) {
                    return ($model->status == 1) ? "Approve" : ($model->status == 99 ? "Wait Approve" : "Draft");
                }
            ],
//                    [
//                        'class' => 'kartik\grid\BooleanColumn',
//                        'attribute' => 'status',
//                        'vAlign' => 'middle',
//                    ],
            ['class' => '\kartik\grid\CheckboxColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'visible' => function($model) {
                    if (Yii::$app->controller->action->id != "view") {
                        if ($model->status == 1) {
                            return FALSE;
                        } else {
                            return TRUE;
                        }
                    } else {
                        if ($isProductSupp) {
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                    }
                },
                'vAlign' => 'middle',
                'template' => '{update} {updateSupplier} {delete}',
                'urlCreator' => function($action, $model, $key, $index, $isProductSupp) use ($isProductSupp) {
//                                                            return '#';
                    if ($action === 'delete') {
                        if ($isProductSupp) {
                            if (Yii::$app->controller->action->id == "create") {
                                $params = ['delete-product-supp', 'id' => $model->productSuppId, 'step' => 4, 'productGroupTemplateId' => $model->product->productGroupTemplateId, 'productGroupId' => $model->product->parentId];
                            } else {
                                $params = ['delete-product-supp', 'id' => $model->productSuppId];
                            }
                            return \yii\helpers\Url::toRoute($params);
                        } else {
                            return \yii\helpers\Url::toRoute(['delete-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId]);
                        }
                    }
                },
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return true; //($model->status === 1 || $model->status === 99) ? FALSE : true;
                    },
                    'delete' => function ($model, $key, $index) {
                        return ($model->status === 1 || $model->status === 99) ? false : true;
                    }
                ],
                'buttons' => [
                    "update" => function ($url, $model, $key) use ($isProductSupp) {
                        if (!$isProductSupp) {
                            return Html::a("<span class = 'glyphicon glyphicon-pencil'></span>", ['update-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $model->productGroupTemplateId, 'productGroupId' => $model->parentId], [
                                'title' => Yii::t('app', 'Toogle Active'),
                                'data-pjax' => '0',
//                                                                    'data-toggle-active' => $model->productId
                            ]);
                        } else {
                            if (Yii::$app->controller->action->id == "create") {
                                $params = ['update-product-supp', 'id' => $model->productSuppId, 'step' => 4, 'productGroupTemplateId' => $model->product->productGroupTemplateId, 'productGroupId' => $model->product->parentId];
                            } else {
                                $params = ['update-product-supp', 'id' => $model->productSuppId, 'step' => 'view', 'userId' => isset($_GET["userId"]) ? $_GET["userId"] : NULL, 'productGroupTemplateId' => $model->product->productGroupTemplateId, 'productGroupId' => $model->product->parentId];
                            }

                            return Html::a("<span class = 'glyphicon glyphicon-pencil'></span>", $params, [
                                'title' => Yii::t('app', 'Toogle Active'),
                                'data-pjax' => '0',
//                                                                    'data-toggle-active' => $model->productId
                            ]);
                        }
                    },
//                    "delete" => function ($url, $model) {
//                        return Html::a("<span class = 'glyphicon glyphicon-trash'></span>", ['delete-product', 'id' => $model->productId, 'step' => 4, 'productGroupTemplateId' => $_GET["productGroupTemplateId"], 'productGroupId' => $_GET["productGroupId"]], [
////                                                                    'title' => Yii::t('app', 'Toogle Active'),
//                            'title' => "คุณต้องการลบสินค้านี้หรือไม่ ?", 'data-toggle' => 'tooltip',
//                            'data-toggle-active' => $model->productId
//                        ]);
//                    },
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
//            '{toggleData}',
        ],
        // set export properties
//                                                'export' => [
//                                                    'fontAwesome' => true
//                                                ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => !isset($gridTitle) ? "<span style='color:white;font-weight:bold'>Product Editor</span>" : $gridTitle,
            'footer' => "<input type='button' class='btn btn-info pull-right' value='Multiple Delete' id='MyButton$gridId' >",
        ],
//        'showFooter' => true,
    ]);
    Pjax::end();
}
?>
<?php

$this->registerJs("
    $(document).ready(function(){
    $('#MyButton$gridId').click(function(){

        if(confirm('คุณต้องการลบสินค้าหรือไม่ ?'))
        {
        var HotId = $('#$gridId').yiiGridView('getSelectedRows');
//        alert(HotId);
          $.ajax({
            type: 'POST',
            url : '" . Url::home() . "product/product-group/multiple-delete-product?type=$type',
            data : {row_id: HotId,productGroupId:" . $_GET["productGroupId"] . ",productGroupTemplateId:" . $_GET["productGroupTemplateId"] . "},
            success : function() {
              $(this).closest('tr').remove(); //or whatever html you use for displaying rows
            }
        });
        }

    });

    });


", \yii\web\View::POS_READY);

$this->registerJs("

    function productModal$type(productId)
    {
    //alert(productId+ ' type='+$type);
        $.ajax({
            type: 'POST',
            url : '" . Url::home() . "product/product-group/update-grid-edit?step=" . $_GET['step'] . "&productGroupTemplateId=" . $_GET['productGroupTemplateId'] . "&productGroupId=" . $_GET['productGroupId'] . "',
            data : {productId: productId,gridId:'$gridId',type:$type},
            success : function(data) {
                $('#productModalBody').html(data);
                $('#productModal').modal('show');
            }
        });
    }

    function refreshGrid$type()
    {
        //$.pjax.reload({container: '#pjax$gridId'});
            $.pjax({container: '#$gridId-pjax'});
            //$('#$gridId').yiiGridView('applyFilter');
    }


", \yii\web\View::POS_HEAD);
?>

