<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\EPayment */

$this->title = 'Create Epayment';
$this->params['breadcrumbs'][] = ['label' => 'Epayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="epayment-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
