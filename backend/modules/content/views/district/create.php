<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\District */

$this->title = 'Create District';
$this->params['breadcrumbs'][] = ['label' => 'Districts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
$this->params['status'] = 'Create';
?>
<div class="district-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
