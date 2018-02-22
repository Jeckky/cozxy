<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>
<div class="wrapper-cozxy">
    <?=
    $this->render('@app/themes/cozxy/layouts/_contact', [
        'msg' => isset($msg) ? $msg : false
    ])
    ?>
</div>

