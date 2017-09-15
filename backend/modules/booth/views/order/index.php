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
    <div class="panel">
        <div class="panel-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

<?php if(isset($dataProvider)): ?>
    <div class="panel">
        <div class="panel-body">
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                //        'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //            'orderId',
                    //            'pickingId',
                    //            'token:ntext',
                    [
                        'attribute' => 'password',
                        'header' => 'Received Code',
                        'value' => function ($model) {
                            return $model->password;
                        }
                    ],
                    'orderNo',
                    'invoiceNo',
                    [
                        'attribute' => 'userId',
                        'value' => function ($model) {
                            $user = $model->user;

                            return $user->firstname . ' ' . $user->lastname;
                        }
                    ],
                    //             'totalExVat',
                    //             'vat',
                    //             'total',
                    // 'discount',
                    // 'grandTotal',
                    // 'shippingRate',
                    'summary',
                    [
                        'attribute' => 'summary',
                        'value' => function ($model) {
                            return number_format($model->summary, 2);
                        },
                        'filter' => false
                    ],
                    // 'userCoin',
                    // 'cozxyCoin',
                    // 'sendDate',
                    // 'addressId',
                    // 'isPayNow',
                    // 'billingFirstname',
                    // 'billingLastname',
                    // 'billingCompany',
                    // 'billingTax',
                    // 'billingAddress:ntext',
                    // 'billingCountryId',
                    // 'billingProvinceId',
                    // 'billingAmphurId',
                    // 'billingDistrictId',
                    // 'billingZipcode',
                    // 'billingTel',
                    // 'shippingFirstname',
                    // 'shippingLastname',
                    // 'shippingCompany',
                    // 'shippingTax',
                    // 'shippingAddress:ntext',
                    // 'shippingCountryId',
                    // 'shippingProvinceId',
                    // 'shippingAmphurId',
                    // 'shippingDistrictId',
                    // 'shippingZipcode',
                    // 'shippingTel',
                    // 'paymentType',
                    // 'couponId',
                    // 'checkStep',
                    // 'note:ntext',
                    // 'paymentDateTime',
                    // 'isSlowest',
                    // 'color',
                    // 'pickerId',
                    // 'password',
                    // 'otp',
                    // 'refNo',
                    // 'status',
                    // 'error',
                    'createDateTime',
                    // 'updateDateTime',
                    // 'email:email',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}'
                    ],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    </div>
<?php endif; ?>