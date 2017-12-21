<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Section */

$this->title = 'Update Section: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->sectionId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="section-update">


    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
