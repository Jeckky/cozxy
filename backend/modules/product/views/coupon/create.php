<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\Coupon */

$this->title = 'Create Coupon';
$this->params['breadcrumbs'][] = ['label' => 'Coupons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="coupon-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
