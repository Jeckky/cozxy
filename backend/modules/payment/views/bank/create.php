<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\costfit\Bank */

$this->title = 'Create Bank';
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="bank-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
