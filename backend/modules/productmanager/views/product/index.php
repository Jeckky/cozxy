<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\productmanager\models\search\Product */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'id'=>'products-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //            'productId',
            //            'userId',
            //            'parentId',
            [
//                'header'=>Html::checkbox('deleteAll', false, ['class'=>'deleteAll']),
                'header'=>Html::button('X', ['class'=>'btn btn-danger', 'disabled'=>true, 'id'=>'deleteMultipleProducts']),
                'value'=>function($model) {
                    return Html::checkbox('delete['.$model->productId.']', false, ['class'=>'delProduct', 'id'=>'del-'.$model->productId, 'data-id'=>$model->productId, 'value'=>$model->productId]);
                },
                'format'=>'raw',
            ],
            [
                'attribute' => 'title',
                'value' => function ($model) {
                    return mb_substr($model->title, 0, 40);
                },
                'format'=>'raw'
            ],
            [
                'attribute' => 'brandId',
                'headerOptions' => ['style' => 'width:250px;'],
                'value' => function ($model) {
                    return isset($model->brand) ? $model->brand->title : '';
                },
//                'filter' => $brandFilter
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'brandId',
                    'data' => $brandFilter,
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => [
                        'placeholder' => 'Brand',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ])
            ],
            [
                'attribute' => 'categoryId',
                'headerOptions' => ['style' => 'width:350px;'],
                'value' => function ($model) {
                    return isset($model->category) ? $model->category->title : '';
                },
//                'filter' => $categoryFilter
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'categoryId',
                    'data' => $categoryFilter,
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => [
                        'placeholder' => 'Category',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        ]
                ])
            ],
            'isbn:ntext',
//            'code',
            // 'suppCode',
            // 'merchantCode',
            // 'optionName',
            // 'shortDescription:ntext',
            // 'description:ntext',
            // 'specification:ntext',
            // 'width',
            // 'height',
            // 'depth',
            // 'weight',
            // 'price',
            // 'unit',
            // 'smallUnit',
            // 'tags',
//            'status',
//            'approve',
//            'createDateTime',
            [
                'attribute'=>'createDateTime',
                'value'=>function($model) {
                    return substr($model->createDateTime, 0, 10);
                }
            ],
//            'updateDateTime',
            // 'productSuppId',
            // 'approveCreateBy',
            // 'approvecreateDateTime',
            // 'receiveType',
            // 'productGroupTemplateId',
            // 'step',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

<?php $this->registerJs("
    $('.deleteAll').click(function(){
        if($(this).is(':checked')) {
            $('.delProduct').prop('checked', true);
        } else {
            $('.delProduct').attr('checked', false);
        }
    });
    
    $('.delProduct').click(function(){
        var numChecked = $('.delProduct:checked').length;
        if(numChecked > 0) {
            $('#deleteMultipleProducts').prop('disabled', false);
        } else {
            $('#deleteMultipleProducts').prop('disabled', true);
        }
    });
    
    $('#deleteMultipleProducts').click(function(){
        var delProduct = [];
        $('.delProduct:checked').each(function(i, e) {
            delProduct.push($(this).val());
        });
        
        if(confirm('Delete Selected Products')){
            $.ajax({
                url : '".Yii::$app->homeUrl."productmanager/product/multiple-delete',
                method:'POST',
                dataType:'json',
                data : {productIds:delProduct.join()},
                success : function(data) {
                    //do some thing
                    $.pjax({container:'#products-grid'});
                }
            });   
        }
    });
");?>
