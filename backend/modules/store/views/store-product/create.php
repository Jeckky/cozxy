<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\StoreProduct */

$this->title = 'Create Store Product';
$this->params['breadcrumbs'][] = ['label' => 'Store Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="store-product-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'storeProductGroupId' => $storeProductGroupId,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
