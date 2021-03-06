<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\EPayment */

$this->title = $model->ePaymentId;
$this->params['breadcrumbs'][] = ['label' => 'Epayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="epayment-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->ePaymentId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->ePaymentId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
//                    'ePaymentId',
                    'paymentMethodId',
                    'bankId',
                    'ePaymentTel',
                    'ePaymentMerchantId',
                    'ePaymentOrgId',
                    'ePaymentUrl:ntext',
                    'ePaymentAccessKey:ntext',
                    'ePaymentSecretKey:ntext',
                    'ePaymentProfileId',
//                    [
//                        'attribute' => 'ePaymentProfileId',
//                        'value' => Yii::$app->homeUrl . $model->ePaymentProfileId,
//                        'format' => ['image', ['width' => '100', 'height' => '100']],
//                    ],
                    'type',
                    'status',
                    'createDateTime',
                    'updateDateTime',
                ],
            ])
            ?>
        </div>
    </div>

</div>
