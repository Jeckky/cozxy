<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\costfit\search\Order */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orderId',
            'userId',
            'token:ntext',
            'orderNo',
            'invoiceNo',
            // 'summary',
            // 'sendDate',
            // 'billingCompany',
            // 'billingTax',
            // 'billingAddress:ntext',
            // 'billingCountryId',
            // 'billingProvinceId',
            // 'billingAmphurId',
            // 'billingZipcode',
            // 'billingTel',
            // 'shippingCompany',
            // 'shippingTax',
            // 'shippingAddress:ntext',
            // 'shippingCountryId',
            // 'shippingProvinceId',
            // 'shippingAmphurId',
            // 'shippingZipcode',
            // 'shippingTel',
            // 'paymentType',
            // 'status',
            // 'createDateTime',
            // 'updateDateTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
