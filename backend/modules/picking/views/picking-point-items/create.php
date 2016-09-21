<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPointItems */

$this->title = 'Create Picking Point Items';
$this->params['breadcrumbs'][] = ['label' => 'Picking Point Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
