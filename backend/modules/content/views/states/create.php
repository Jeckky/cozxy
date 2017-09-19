<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\dbworld\States */

$this->title = 'Create States';
$this->params['breadcrumbs'][] = ['label' => 'States', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
$this->params['status'] = 'Create';
?>
<div class="states-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
