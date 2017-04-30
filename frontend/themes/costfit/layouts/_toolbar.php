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
<style type="text/css">
    .menu {
        background: none;
    }
    .menu .catalog li a {
        color: #000;
    }
    .menu .catalog li:hover a {
        transition: none;
        color: rgba(255,212,36,.9);
    }
    .menu .catalog li a {
        padding: 5px 0px 9px 0px;
        color: #fff;
        background: none;
        text-transform: none;
        font-size: 1.2em;
    }
</style>