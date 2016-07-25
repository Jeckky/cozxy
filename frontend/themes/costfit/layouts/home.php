<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php $this->beginContent('@app/themes/costfit/layouts/main.php'); ?>
<div id="page-wrapper">

    <header id="header" class="navbar-static-top">
        <?php echo $this->render('_header_top_nav.php'); ?>
    </header>

    <section id="content" style="background-image: url('images/background/bg1.jpg');">
        <div class="container">
            <div id="main" >
                <?php echo $content; ?>
            </div>
        </div>
    </section>
    <?php
    $logoImage = common\models\costfit\ContentGroup::find()->where("lower(title)='logoImage'")->one();
    $news = common\models\costfit\ContentGroup::find()->where("lower(title)='NEWS'")->one();
    $footerContact = common\models\costfit\ContentGroup::find()->where("lower(title)='contactFooter'")->one();
    echo $this->render('_footer', compact('logoImage', 'news', 'footerContact'));
    ?>
</div>

<?php $this->registerJs("
", \yii\web\View::POS_END); ?>
<?php $this->endContent(); ?>
