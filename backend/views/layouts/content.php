<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
<div class="col-md-3">
    <?php
    //menu
    echo Nav::widget([
        'options' => ['class' => 'nav nav-pills nav-stacked'],
        'items' => [
//            [
//                'label' => 'Users',
//                'items' => [
//                    ['label' => 'Manage', 'url' => ['/user']],
////                    '<li class="divider"></li>',
////                    '<li class="dropdown-header">Dropdown Header</li>',
////                ['label' => 'Assets', 'url' => ['/project/project-asset']],
//                ],
//                ],
            [
                'label' => 'Store',
                'items' => [
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Store</li>',
                    ['label' => 'Store', 'url' => ['/store/store']],
                    ['label' => 'Import Product', 'url' => ['/store/store-product-group']],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Product</li>',
                    ['label' => 'Brand', 'url' => ['/store/brand']],
                    ['label' => 'Category', 'url' => ['/store/category']],
                    ['label' => 'Product Group', 'url' => ['/store/product-group']],
                    ['label' => 'Product', 'url' => ['/store/product']],
//                    ['label' => 'Project Asset', 'url' => ['/project/project-asset']],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Location</li>',
                    ['label' => 'Region', 'url' => ['/store/region']],
                    '<li class="dropdown-header">Supplier</li>',
                    ['label' => 'Supplier', 'url' => ['/store/supplier']],
                ],
            ],
        ],
    ]);
    ?>
</div>
<div class="col-md-9">
    <?= $content ?>
</div>
<?php $this->endContent(); ?>
