<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
?>
<?php
$this->beginContent('@app/themes/costfit/layouts/main.php');
//$logo = common\models\costfit\ContentGroup::find()->where("lower(title)='logoimage'")->one();
?>

<div class="page-content-payment">
    <?php echo $content; ?>
</div>

<?php
$this->registerJs("
 ", \yii\web\View::POS_END);
?>
<?php $this->endContent(); ?>
