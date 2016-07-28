<?php

/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php

//foreach ($model_list as $key => $value) {
//  echo $value->orderId . '<br>';
//}

echo GridView::widget([
    'dataProvider' => $model_list,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        // Simple columns defined by the data contained in $dataProvider.
        // Data from the model's column will be used.
        'orderId',
        'orderNo',
        // More complex one.
        [
            'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
        // 'value' => function ($data) {
        // return $data->orderNo; // $data['name'] for array data, e.g. using SqlDataProvider.
        //  },
        ],
    ],
]);
?>


