<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */
if ($receive == 1) {
    $txt = 'Create Picking Points :: Lockers';
} else {
    $txt = 'Create Picking Points :: Booth';
}
$this->title = $txt;
$this->params['breadcrumbs'][] = ['label' => 'Picking Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'receive' => $receive
    ])
    ?>

</div>
