<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Promotions';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-promotion-index">

    
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?=$this->title?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Promotion', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
                            <?= GridView::widget([
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

                                            					'productPromotionId',
                                                        					'productId',
                                                        					'statusDate',
                                                        					'endDate',
                                                        					'discount',
                            					// 'discountType',
					// 'status',
					// 'createDateTime',
					// 'updateDateTime',
                ['class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                                'template' => '{view} {update} {delete} {product}',
                'buttons'=> [
'product' => function($url, $model) {
                            return Html::a('<br><u>Product</u>', 
['/product/manage', 'productPromotionId' => $model->productPromotionId], 
[
                                'title' => Yii::t('app', 'Change today\'s lists'),]);},]
                ],
                ],
                ]); ?>
                    </div>
    </div>
    <?php Pjax::end(); ?>
</div>
