<?php

// echo Yii::$app->homeUrl . Yii::$app->controller->id;
//echo 'Test =' . Yii::$app->homeUrl;
//echo '<br>' . Yii::$app->controller->id;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\controllers\MasterController;
use common\models\ModelMaster;
?>
<div class="toolbar-container">
    <div class="container">
        <!--Toolbar-->
        <div class="toolbar group">
            <?php
//throw new \yii\base\Exception(print_r(Yii::$app->user->identity, true));
            if (Yii::$app->user->isGuest):
                ?>
                <a class="login-btn btn-outlined-invert" href="#" data-toggle="modal" data-target="#loginModal"><i
                        class="icon-profile"></i> <span><b>L</b>ogin</span></a>
                <?php else: ?>
                    <?= yii\helpers\Html::a("<i class='icon-lock-closed'></i> <span><b>L</b>ogout</span>", ["site/logout"], ['class' => 'login-btn btn-outlined-invert']) ?>
                <a class="btn-outlined-invert" href="<?= Yii::$app->homeUrl ?>wishlist"><i class="icon-heart"></i>
                    <span><b>W</b>ishlist</span></a>
            <?php endif; ?>
            <?= $this->render('_cart') ?>
            <button class="search-btn btn-outlined-invert"><i class="icon-magnifier"></i></button>

        </div><!--Toolbar Close-->

    </div><!--
    <div class="language-bar">
    <?php
    //echo Html::a(Html::img(Yii::$app->homeUrl . '/images/flags/flag_th.jpg'), Url::current(['language' => 'th-TH']), ['class' => (Yii::$app->request->cookies['language'] == 'th-TH' ? 'active' : '')]);
    // echo Html::a(Html::img(Yii::$app->homeUrl . '/images/flags/flag_en.jpg'), Url::current(['language' => 'en-US']), ['class' => (Yii::$app->request->cookies['language'] == 'en-US' ? 'active' : '')]);
    ?>
    </div>-->
</div>