<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\productmanager\models\Product */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <p>
        <?php if($model->parentId !== NULL): ?>
            <?= Html::a('Go Back', ['view', 'id' => $model->parentId], ['class' => 'btn']) ?>
        <?php else: ?>
            <?= Html::a('Go Back', ['index', 'id' => $model->parentId], ['class' => 'btn']) ?>
        <?php endif; ?>
    </p>

<!--    <div class="panel panel-info">-->
<!--        <div class="panel-body">-->
<!--            Wizard-->
<!--        </div>-->
<!--    </div>-->

    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'brandFilter'=>$brandFilter,
                'categoryFilter'=>$categoryFilter,
                'productGroupTemplateFilter'=>$productGroupTemplateFilter,
                'productPriceCurrencyModel'=>$productPriceCurrencyModel,
                'currencyModel' => $currencyModel,
            ]) ?>
        </div>
    </div>

</div>
