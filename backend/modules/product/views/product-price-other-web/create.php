<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ProductPriceOtherWeb */

$this->title = 'Create Product Price Other Web';
$this->params['breadcrumbs'][] = ['label' => 'Product Price Other Webs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-other-web-create">



    <?=
    $this->render('_form', [
        'model' => $model,
        'productName' => $productName,
        'website' => $website,
        'title' => $this->title
    ])
    ?>

</div>
