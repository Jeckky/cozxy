<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Promotion */

$this->title = 'Update Promotion: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->promotionId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promotion-update">


    <?=
    $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'brands' => $brands
    ])
    ?>

</div>
