<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\PickingPoint */

$this->title = ($receive) == 1 ? 'Create Picking Points :: Lockers' : 'Create Picking Points :: Booth';
$this->params['breadcrumbs'][] = ['label' => 'Picking Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picking-point-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
