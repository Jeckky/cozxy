<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="bg-yellow1 topbar">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-12 pull-right text-right"><a href="#" class="dismiss"><i class="fa fa-close fc-black"></i></a></div>
            <div class="col-md-3 col-sm-4 col-xs-6 size12-xs"><!--<i class="fa fa-phone"></i>--><?= Html::img(Url::home() . 'imgs/i-phone.png') ?>&nbsp;&nbsp;Hotline: 098-394-859 &nbsp; </div>
            <div class="col-md-7 col-sm-5 col-xs-6 size12-xs"><!--<i class="fa fa-truck"></i>--><?= Html::img(Url::home() . 'imgs/i-truck.png') ?>&nbsp;&nbsp;Free Shipping &nbsp; </div>
        </div>
    </div>
</div>

<div class="bg-black headbar">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12"><a href="<?= Url::to(['/']) ?>"><?= Html::img(Url::home() . 'imgs/cozxy.png') ?></a></div>
            <div class="col-md-3 col-sm-6 col-xs-12 pull-right text-right">
                <div class="row user-menu">
                    <?php
                    if (isset(Yii::$app->user->identity->userId)) {
                        echo '<div class="col-xs-3">' . Html::a('&nbsp;', ['/my-account'], ['class' => 'u-menu-1']) . '</div>';
                    } else {
                        echo '';
                    }
                    ?>
                    <div class="col-xs-3"><a href="my-account?act=2" class="u-menu-2">&nbsp;</a></div>
                    <div class="col-xs-3"><?= Html::a('&nbsp;', ['/cart'], ['class' => 'u-menu-3']) ?>
                        <!--<span style="display: block;  margin: 0; font-size: 12px;  padding:5px;  line-height: 1; font-weight: 400; position: absolute; top: -1px; right: 5px;color: #000 !important;  background-color: #fee60a;"></span>-->
                    </div>
                    <div class="col-xs-3">
                        <?php
                        if (isset(Yii::$app->user->identity->userId)) {
                            echo Html::a('&nbsp;', ['/site/logout'], ['class' => 'u-menu-4']);
                        } else {
                            echo Html::a('&nbsp;', ['/site/login'], ['class' => 'u-menu-4']);
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="rela" style="height: 64px;">
                    <?php $form = ActiveForm::begin(['id' => 'register-form', 'action' => Yii::$app->homeUrl . 'search/cozxy-product', 'options' => ['class' => 'registr-form']]); ?>
                    <div class="align-center align-middle fullwidth"><input type="text" name="search" id="search" class="search-input" placeholder="SEARCH PRODUCT"></div>
                    <div class="align-middle text-right" style="width:120px; right:0;"><input type="submit" value="SEARCH" class="search-btn bg-yellow3"></div>
                    <div class="align-middle text-right size24" style="width:32px; padding-top: 8px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-black menubar hidden-md hidden-sm hidden-xs">
    <div class="container">
        <div class="row">
            <?php
            $category = \common\models\costfit\ProductSuppliers::find()
            ->select('`product_suppliers`.categoryId , `category`.title , count(`product_suppliers`.`categoryId`)')
            ->join("LEFT JOIN", "category", "category.categoryId=product_suppliers.categoryId")
            ->groupBy('`product_suppliers`.categoryId')
            ->orderBy('count(`product_suppliers`.`categoryId`) asc')
            ->limit(12)
            ->all();
            foreach ($category as $value) {
                $params = \common\models\ModelMaster::encodeParams(['categoryId' => $value->categoryId]);
                $strtoupper = strtoupper($value->title);
                $strtolower = strtolower($value->title);
                echo \yii\helpers\Html::a("$strtoupper", ['/search/' . $value->createTitle() . '/' . $params . '?c=' . $strtolower], ['class' => 'menu-item']);
            }
            ?>
            <?php
            /* $Category = common\models\costfit\Category::find()->where('status=1')->limit(14)->all();
              foreach ($Category as $value) {
              $params = \common\models\ModelMaster::encodeParams(['categoryId' => $value->categoryId]);
              $strtoupper = strtoupper($value->title);
              $strtolower = strtolower($value->title);
              echo \yii\helpers\Html::a("$strtoupper", ['/search/' . $value->createTitle() . '/' . $params . '?c=' . $strtolower], ['class' => 'menu-item']);
              } */
            ?>
            <!--            <a href="product.php" class="menu-item">RING</a>-->
            <!--            <a href="product.php" class="menu-item">HAT</a>-->
            <!--            <a href="product.php" class="menu-item">CLOTHING</a>-->
            <!--            <a href="product.php" class="menu-item">SHOES</a>-->
            <!--            <a href="product.php" class="menu-item">BAGS</a>-->
            <!--            <a href="product.php" class="menu-item">WATCHS</a>-->
            <!--            <a href="product.php" class="menu-item">ACCESSORIES</a>-->
            <!--            <a href="product.php" class="menu-item">GROOMING</a>-->
            <!--            <a href="product.php" class="menu-item">SPORTS</a>-->
            <!--            <a href="product.php" class="menu-item">BRANDS</a>-->
            <!--            <a href="product.php" class="menu-item">SHIRTS</a>-->
            <!--            <a href="product.php" class="menu-item">CLOTHING</a><span class="stretch"></span>-->
        </div>
    </div>
</div>