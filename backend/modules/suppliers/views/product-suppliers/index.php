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
if (Yii::$app->user->identity->type != 4) {
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
                    'isbn:ntext',
                    'code',
                    'title',
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
                        'attribute' => 'ราคาล่าสุด',
                        'format' => 'html',
                        'value' => function($model) {
                            return $model->priceSuppliers;
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
                            return Html::a('<i class="fa fa-picture-o"></i> เพิ่มรูปภาพ', Yii::$app->homeUrl . "suppliers/product-suppliers/image-form?productSuppId=" . $model->productSuppId, [
                                'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
                        }
                    ],
                    [
                        'attribute' => 'ราคา',
                        'format' => 'html',
                        'value' => function($model) {
                            return Html::a('<i class="fa fa-btc"></i> เพิ่มราคาขาย', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId, [
                                'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
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
