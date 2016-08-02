<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\UpdatePrice */

$this->title = 'Update Update Price: ' . $model->updatePriceId;
$this->params['breadcrumbs'][] = ['label' => 'Update Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->updatePriceId, 'url' => ['view', 'id' => $model->updatePriceId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="update-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
