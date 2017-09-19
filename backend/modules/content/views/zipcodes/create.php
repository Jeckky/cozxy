<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Zipcodes */

$this->title = 'Create Zipcodes';
$this->params['breadcrumbs'][] = ['label' => 'Zipcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="zipcodes-create">

    <?= $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ]) ?>

</div>
