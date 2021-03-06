<?php

use yii\helpers\Html;
use leandrogehlen\treegrid\TreeGrid;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Menu */

$this->title = 'Create Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="menu-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'listViewLevels' => $listViewLevels,
        'actions' => $actions,
        'title' => Html::encode($this->title)
    ])
    ?>

</div>
