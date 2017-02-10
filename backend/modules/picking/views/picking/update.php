<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */

$this->title = $model->title . ($receive) == 1 ? ' Update Picking Point :: Lockers' : ' Update Picking Point :: Booth';
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
