<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ViewLevels */

$this->title = 'Update เลือกกลุ่มที่เข้าใช้งาน: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'View Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->viewLevelsId]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="view-levels-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'listViewLevels' => $listViewLevels,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
