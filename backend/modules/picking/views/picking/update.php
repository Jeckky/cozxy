<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */
//echo $receive;
if ($receive == 1) {
    $txt = 'Update Picking Point :: Lockers';
} else {
    $txt = 'Update Picking Point :: Booth';
}
$this->title = $model->title . ' :: ' . $txt;
$this->params['breadcrumbs'][] = ['label' => 'Picking Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->pickingId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="picking-point-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'receive' => $receive
    ])
    ?>

</div>
