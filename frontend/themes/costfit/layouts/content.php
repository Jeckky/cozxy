<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php
$this->beginContent('@app/themes/costfit/layouts/main.php');
$logo = common\models\costfit\ContentGroup::find()->where("lower(title)='logoimage'")->one();
?>
<?= $this->render('_modal_login') ?>
<?= $this->render('_header', compact('logo')) ?>
<div class="page-content">
    <div class="content-fluid">
        <div class="row">
            <div class="col-md-10">
                <?php echo $content; ?>
            </div>
	        <div class="col-md-2">
                right side bar
            </div>
        </div>
    </div>
</div>
<?php
$logoImage = common\models\costfit\ContentGroup::find()->where("lower(title)='logoImage'")->one();
$news = common\models\costfit\ContentGroup::find()->where("lower(title)='NEWS'")->one();
$footerContact = common\models\costfit\ContentGroup::find()->where("lower(title)='contactFooter'")->one();
echo $this->render('_footer', compact('logoImage', 'news', 'footerContact'));
?>
<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
