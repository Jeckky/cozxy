<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\EPayment */

$this->title = 'Update Epayment: ' . ' ' . $model->ePaymentId;
$this->params['breadcrumbs'][] = ['label' => 'Epayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ePaymentId, 'url' => ['view', 'id' => $model->ePaymentId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="epayment-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
