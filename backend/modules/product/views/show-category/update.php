<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ShowCategory */

$this->title = 'Update Show Category: ' . ' ' . $model->showCategoryId;
$this->params['breadcrumbs'][] = ['label' => 'Show Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->showCategoryId, 'url' => ['view', 'id' => $model->showCategoryId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="show-category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
