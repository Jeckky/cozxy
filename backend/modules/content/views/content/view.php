<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\costfit\Content */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="content-view">

    <div class="panel colourable">
        <div class="panel-heading">
            <span class="panel-title">With buttons</span>
            <div class="panel-heading-controls">
                <?= Html::a('Update', ['update', 'id' => $model->contentId], ['class' => 'btn btn-xs btn-primary btn-outline']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->contentId], [
                    'class' => 'btn btn-xs btn-outline btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div> <!-- / .panel-heading-controls -->
        </div> <!-- / .panel-heading -->
        <div class="panel-body">
            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'contentId',
                    'contentGroupId',
                    'title',
                    'description:ntext',
                    'status',
                    [
                        'attribute' => 'image',
                        'value' => $model->image,
                        'format' => ['image', ['width' => '100', 'height' => '100']],
                    ],
                    'createDateTime',
                    'updateDateTime',
                ],
            ])
            ?>
        </div>
    </div>

</div>
