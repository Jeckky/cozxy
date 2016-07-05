<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Coupon */

$this->title = 'Update Coupon: ' . ' ' . $model->couponId;
$this->params['breadcrumbs'][] = ['label' => 'Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->couponId, 'url' => ['view', 'id' => $model->couponId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="coupon-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
