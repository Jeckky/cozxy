<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\ViewLevels */

$this->title = 'รายละเอียดระดับการเข้าถึง';
$this->params['breadcrumbs'][] = ['label' => 'View Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="view-levels-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'listViewLevels' => $listViewLevels,
        'actions' => $actions,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
