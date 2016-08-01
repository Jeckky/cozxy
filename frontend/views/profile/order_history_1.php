
<?php

/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\grid\GridView;
use kartik\grid\GridView;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<?php

use kartik\export\ExportMenu;

echo ExportMenu::widget([
    'dataProvider' => $dataProvider
]);


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
//........
    'panel' => [
        'before' => ' '
    ],
//.........
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'orderNo',
        'total',
        'createDateTime',
//['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>