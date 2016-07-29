<?php

/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<style>
    .table-light{
        font-size: 14px;
    }

</style>
<?php

//foreach ($model_list as $key => $value) {
//  echo $value->orderId . '<br>';
//}
?>

<?php

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
        'class' => 'table table-striped table-bordered table-light',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // Simple columns defined by the data contained in $dataProvider.
        // Data from the model's column will be used.
        'orderNo',
        'createDateTime:date',
        // More complex one.
        ['class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => ' {Order} ',
            'buttons' => [
                'Order' => function($url, $model, $baseUrl) {
                    return Html::a('<img src = "' . Yii::$app->homeUrl . 'images/payment-method/eye_vision_Bitcoin_card_currency_money_payment_finance-20.png" alt = "Cost Fit">', Yii::$app->homeUrl . "profile/purchase-order?orderId=" . $model->orderId, [
                                'title' => Yii::t('app', 'test '),]);
                },
                    ]
                ],
            ], 'layout' => "{pager}\n{items}\n",
        ]);
        ?>