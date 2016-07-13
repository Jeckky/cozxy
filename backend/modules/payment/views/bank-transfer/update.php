<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\BankTransfer */

$this->title = 'Update Bank Transfer: ' . ' ' . $model->bankTransferId;
$this->params['breadcrumbs'][] = ['label' => 'Bank Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bankTransferId, 'url' => ['view', 'id' => $model->bankTransferId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="bank-transfer-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
