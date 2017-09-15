<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Groups';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-suppliers-index">

    <?php Pjax::begin(['id' => 'product-suppliers']); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Product Suppliers :: Wait for Approve</h3>
        </div>
        <div class="panel-body">
            <?=
            GridView::widget([
//                'id'=>'product-suppliers-grid',
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
                    //                    'productGroupId',
                    [
                        'attribute' => 'brandId',
                        'value' => function ($model) {
                            return $model->brand->title;
                        }
                    ],
                    [
                        'attribute' => 'categoryId',
                        'value' => function ($model) {
                            return $model->category->title;
                        }
                    ],
                    'productSuppId',
                    'title',
                    'status',
                    'approve',

                    // 'updateDateTime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Approve',
                        'template'=>'{Approve}',
                        'buttons'=>[
                            'Approve'=>function($url, $model) {
                                return Html::a('Approve', '#', ['id'=>'productSuppId_'.$model->productSuppId, 'class'=>'approveProductSupp', 'data-productSuppId'=>$model->productSuppId]);
                            }
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>

<?php
$this->registerJs('
$(".approveProductSupp").on("click", function(){

if(confirm("Approve?")) {
    var psid = $(this).attr("data-productSuppId");
    
    $.ajax({
        url:"'.Yii::$app->homeUrl.'product/product-supplier/approve-product-supp",
        method:"POST",
        dataType:"json",
        data:{productSuppId:psid},
        success:function(data) {
            $.pjax({container:"#product-suppliers"});
        }
    });
}

});
');
?>