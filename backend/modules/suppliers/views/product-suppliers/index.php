<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Suppliers';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
//echo Yii::$app->user->identity->type;
if (Yii::$app->user->identity->type != 4 && Yii::$app->user->identity->type != 5) {
    header("location: /auth");
    exit(0);
}
?>
<div class="product-suppliers-index">


    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Suppliers', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                    'class' => 'table-light'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'productId',
                    //'userId',
                    //'productGroupId',
                    [
                        'attribute' => 'brand',
                        'value' => function($model) {
                            return isset($model->brand) ? $model->brand->title : NULL;
                        }
                    ],
                    [
                        'attribute' => 'category',
                        'value' => function($model) {
                            return isset($model->category) ? $model->category->title : NULL;
                        }
                    ],
                    //'isbn',
                    ['attribute' => 'isbn',
                        'label' => 'title',
                        'contentOptions' => ['style' => 'width:120px;  min-width:120px;  '],
                    ],
                    'code',
                    //'title',
                    ['attribute' => 'title',
                        'label' => 'title',
                        'contentOptions' => ['style' => 'width:200px;  min-width:200px;  '],
                    ],
                    // 'optionName',
                    // 'shortDescription:ntext',
                    // 'description:ntext',
                    // 'specification:ntext',
                    // 'width',
                    // 'height',
                    // 'depth',
                    // 'weight',
                    'quantity',
                    [
                        'attribute' => 'คงเหลือ',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a($model->result . ' ชิ้น(เพิ่ม)', Yii::$app->homeUrl . "suppliers/product-total-suppliers/create?productSuppId=" . $model->productSuppId . '&total=addup', [
                                'title' => Yii::t('app', 'เพิ่มจำนวนสินค้า'), 'class' => 'text-center']);
                        }
                    ],
                    [
                        'attribute' => 'ราคาล่าสุด',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->priceSuppliers;
                        }
                    ],
                    [
                        'attribute' => 'ราคา',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a(' เพิ่มราคา', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                                'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                        }
                    ],
                    //'approve',
                    [
                        'attribute' => 'approve',
                        'format' => 'html',
                        'value' => function($model) {
                            if ($model->approve == 'old') {
                                $txt = '<span class="text-warning">รออนุมัติ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            } else if ($model->approve == 'approve') {
                                $txt = '<span class="text-success">อนุมัติแล้ว</span>';
                            } else if ($model->approve == 'new') {
                                $txt = '<span class="text-warning">รออนุมัติ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            } else {
                                $txt = '<span class="text-danger">แจ้งเจ้าหน้าที่ (' . common\helpers\CozxyUnity::TimeElapsedString($model->createDateTime) . ')</span>';
                            }
                            return $txt;
                        }
                    ],
                    // 'unit',
                    // 'smallUnit',
                    // 'tags',
                    // 'status',
                    // 'createDateTime',
                    // 'updateDateTime',
                    //'image',
                    [
                        'attribute' => 'image',
                        'format' => 'html',
                        'value' => function($model) {
                            $productImageSupplers = common\models\costfit\ProductImageSuppliers::find()->where('productSuppId=' . $model->productSuppId)->orderBy('productImageId')->limit(1)->one();
                            if (isset($productImageSupplers)) {
                                //echo $productImageSupplers->imageThumbnail2;
                                return Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรูปภาพใหม่ <i class="fa fa-picture-o"></i>', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                    'title' => Yii::t('app', 'image'), 'class' => 'text-center']) .
                                Html::img(Yii::$app->homeUrl . $productImageSupplers->imageThumbnail2, ['style' => 'width:137px;height:130px', 'class' => 'img-responsive']);
                            } else {
                                return Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรูปภาพใหม่ <i class="fa fa-picture-o"></i>', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                    'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                            }
                        }
                    ],
                    /*
                      [
                      'attribute' => 'Smart',
                      'format' => 'html',
                      'value' => function($model) {
                      return Html::a('<i class="fa fa-btc"></i> เพิ่มราคาขายและราคาค่าจัดส่ง', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                      'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                      }
                      ], */
                    ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<i class="fa fa-eye"></i>', $url, [
                                    'title' => Yii::t('yii', 'view'),
                                ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="fa fa-pencil"></i>', $url, [
                                    'title' => Yii::t('yii', 'update'),
                                ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="fa fa-trash-o"></i>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                            },
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
