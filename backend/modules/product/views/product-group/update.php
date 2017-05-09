<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductGroup */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->productGroupId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-group-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title),
        'ms' => $ms,
        'description' => $description
    ])
    ?>

</div>
