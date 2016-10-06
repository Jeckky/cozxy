<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>

<div class="receive-index">

    <div class="col-md-12"> <h1 class="text-center"><strong><?= isset($ms) ? $ms : '' ?></strong></h1></div>
    <div class="row">
        <div class="col-md-4"> </div>
        <div class="col-md-4 text-center">
            <?= Html::a('กลับ', $baseUrl . '/receive', ['class' => 'btn btn-warning btn-lg col-md-12']) ?>
        </div>
        <div class="col-md-4"></div>

    </div>

</div><br><br><br><br><br><br>
