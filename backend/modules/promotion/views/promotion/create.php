<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Promotion */

$this->title = 'Create Promotion';
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotion-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'brands' => $brands
    ])
    ?>

</div>
