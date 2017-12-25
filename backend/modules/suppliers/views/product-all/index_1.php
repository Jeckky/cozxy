<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
?>
<h1>product ของ Suppliers/index</h1>

<div class="panel-body">
    <?=
    GridView::widget([
        'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover'],
        'pager' => [
            'options' => ['class' => 'pagination pagination-xs']
        ],
        'options' => [
            'class' => 'table-light '
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'productId',
            //'userId',
            [
                'attribute' => 'user',
                'value' => function($model) {
                    //return $model->user['username'] . '(' . $model->productId . '::' . $model->parentId . ')';
                    if (isset($model->userIdSupp)) {

                        $userIdSupp = common\models\costfit\User::find()->where('userId=' . $model->userIdSupp)->one();
                        $userIdSupps = $userIdSupp['username'];
                    } else {
                        $userIdSupps = '-';
                    }
                    return $userIdSupps;
                }
            ],
            //'productGroupId ',
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
            //'code',
            'title',
            [
                'attribute' => 'mkt price',
                'value' => function($model) {
                    return number_format($model->price);
                }
            ],
            [
                'attribute' => 'selling price',
                'value' => function($model) {
                    return number_format($model->sellingPrice);
                }
            ],
            [
                'attribute' => 'stock',
                'value' => function($model) {
                    return $model->resultSupp;
                }
            ],
            [
                'attribute' => 'option detail',
                'value' => function($model) {
                    $productGroupOptionValue = common\models\costfit\ProductGroupOptionValue::find()->where('productGroupId=' . $model->parentId . ' and productId = ' . $model->productId)->all();
                    foreach ($productGroupOptionValue as $key => $value) {
                        //$productGroupOption = common\models\costfit\ProductGroupOption::find()->where('productGroupOptionId=' . $value->productGroupOptionId)->all();
                        //foreach ($productGroupOption as $key => $item) {
                        //return $item->name;
                        //}
                        return $value->value;
                    }
                }
            ],
            // 'optionName',
            // 'shortDescription:ntext',
            // 'description:ntext',
            // 'specification:ntext',
            // 'width',
            // 'height',
            // 'depth',
            // 'weight',
            /* 'quantity',
              [
              'attribute' => 'ราคาล่าสุด',
              'format' => 'html',
              'value' => function($model) {
              return $model->priceSuppliers;
              }
              ], */
            //'approve',
            // 'unit',
            // 'smallUnit',
            // 'tags',
            // 'status',
            // 'createDateTime',
            // 'updateDateTime',
            //'image',
            /* [
              'attribute' => 'view',
              'format' => 'html',
              'value' => function($model) {
              $views = common\models\costfit\ProductPageViews::find()->where('productSuppId=' . $model->productSuppId)->count();
              if (isset($views)) {
              return $views . ' ครั้ง';
              } else {
              return 0 . ' ครั้ง';
              }
              }
              ], */
            /*
              [
              'attribute' => 'Smart',
              'format' => 'html',
              'value' => function($model) {
              return Html::a('<i class = "fa fa-btc"></i> เพิ่มราคาขายและราคาค่าจัดส่ง', Yii::$app->homeUrl . "suppliers/product-price-suppliers?productSuppId=" . $model->productSuppId,[
              'title' => Yii::t('app', 'image'), 'class' => 'text-center']);
              }
              ], */
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}  ',
                'buttons' => [
                    'view' => function($url, $model) {
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