<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<ul class="main">
    <li class="has-submenu"><a href="<?php echo $baseUrl; ?>"><i class="fa fa-chevron-down"></i></a>
        <!--Class "has-submenu" for proper highlighting and dropdown <span>H</span>ome-->
    </li>
</ul>