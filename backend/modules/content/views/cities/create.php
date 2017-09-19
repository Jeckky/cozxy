<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\Cities */

$this->title = 'Create Cities';
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
$this->params['status'] = 'Create';
?>
<div class="cities-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
