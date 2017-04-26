<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use common\models\costfit\TopUp;
use common\models\costfit\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Top Up';
$this->params['breadcrumbs'][] = $this->title;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<br><br>
<div class="order-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">Payment History</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" style="color: #000;text-align: center;">
            <?=
            GridView::widget([
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
                    'topUpNo',
                    'point',
                        [
                        'attribute' => 'money',
                        'value' => function($model) {

                            return number_format($model->money, 2);
                        }
                    ],
                        [
                        'attribute' => 'updateDateTime',
                        'value' => function($model) {
                            return frontend\controllers\MasterController::dateThai($model->updateDateTime, 4);
                        }
                    ],
                        [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function($model) {
                            if ($model->status == TopUp::TOPUP_STATUS_COMFIRM_PAYMENT && $model->paymentMethod == 1) {
                                $customerName = User::userName($model->userId);
                                $customerTel = User::userTel($model->userId);
                                $taxId = '0105553036789';
                                $topUpNo = $model->topUpNo;
                                $tel = str_replace("-", "", $customerTel);
                                $amount = $model->money;
                                $topUpCut = str_replace("/", "", $model->topUpNo);
                                $amount1 = str_replace(",", "", number_format($amount, 2));
                                $amount2 = str_replace(".", "", $amount1);
                                $barCode = $taxId . $topUpCut . $tel . $amount2;
                                $data = "| " . $taxId . " " . $topUpCut . " " . $tel . " " . $amount2;
                                return TopUp::statusText($model->status) . '<br>' .
                                        '<i class="fa fa-print" aria-hidden="true"></i>'
                                        . ' <a href="' . Yii::$app->homeUrl . 'top-up/print-payment-form-topdf?amount=' . $amount . '&customerName=' . $customerName . '&customerTel=' . $customerTel . '&topUpNo=' . $topUpNo . '&taxId=' . $taxId . '&barCode=' . $barCode . '&data=' . $data . '"'
                                        . 'style = "color:blue;font-size:10pt;" target="_blank">Re-print Bill payment</a>';
                            } else {
                                return TopUp::statusText($model->status);
                            }
                        }
                    ],
                        ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Bill',
                        'template' => '{view}{history}',
                        'buttons' => [
                            'view' => function( $url, $model) {
                                if ($model->status == TopUp::TOPUP_STATUS_E_PAYMENT_SUCCESS) {
                                    $topUpId = common\models\ModelMaster::encodeParams($model->topUpId);
                                    return Html::a('<span class = "btn btn-sm">Print</span>', [Yii::$app->homeUrl . 'top-up/billpay?epay = ' . $topUpId], [
                                                'target' => '_blank'
                                                    ]
                                    );
                                }
                            },]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>

