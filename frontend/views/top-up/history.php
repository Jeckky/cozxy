<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

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
                <div class="col-md-6">ประวัติการเติมเงิน</div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Order', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" style="color: #000;text-align: center">
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
                            return frontend\controllers\MasterController::dateThai($model->updateDateTime, 1);
                        }
                    ],
                        [
                        'attribute' => 'status',
                        'value' => function($model) {
                            return common\models\costfit\TopUp::statusText($model->status);
                        }
                    ],
                        ['class' => 'yii\grid\ActionColumn',
                        'header' => 'Actions',
                        'template' => '{view}{history}',
                        'buttons' => [
                            'view' => function($url, $model) {
                                $topUpId = common\models\ModelMaster::encodeParams($model->topUpId);
                                return Html::a('<span class="btn btn-sm">Print</span>', [Yii::$app->homeUrl . 'top-up/billpay?epay=' . $topUpId], [
                                            'target' => '_blank'
                                                ]
                                );
                            },]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>

