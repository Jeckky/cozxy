<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\UpdatePrice */

$this->title = 'Create Update Price';
$this->params['breadcrumbs'][] = ['label' => 'Update Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="update-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
