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
                    '<li class="dropdown-header">Store</li>',
                    ['label' => 'Store', 'url' => ['/store/store']],
                    ['label' => 'Import Product', 'url' => ['/store/store-product-group']],
//                    ['label' => 'Project Asset', 'url' => ['/project/project-asset']],
                    '<li class="divider"></li>',
                    '<li class="dropdown-header">Location</li>',
                    ['label' => 'Region', 'url' => ['/store/region']],
                ],
            ],
            [
                'label' => 'Supplier',
                'items' => [
                    '<li class="dropdown-header">Supplier</li>',
                    ['label' => 'Supplier', 'url' => ['/supplier/supplier']],
                ],
            ],
            [
                'label' => 'Product',
                'items' => [
                    '<li class="dropdown-header">Product</li>',
                    ['label' => 'Brand', 'url' => ['/product/brand']],
                    ['label' => 'Category', 'url' => ['/product/category']],
                    ['label' => 'Product Group', 'url' => ['/product/product-group']],
                    ['label' => 'Product Price Group', 'url' => ['/product/product-group']],
                    ['label' => 'Product', 'url' => ['/product/product']],
                    ['label' => 'Unit', 'url' => ['/product/unit']],
                ],
            ],
            [
                'label' => 'Shipping',
                'items' => [
                    '<li class="dropdown-header">Package</li>',
                    ['label' => 'Package', 'url' => ['/shipping/package']],
                    ['label' => 'Package Type', 'url' => ['/shipping/package-type']],
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
