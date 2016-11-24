<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="brand-index">

    
    <?php Pjax::begin(['id' => 'employee-grid-view']); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?=$this->title?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Brand', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
                            <?= GridView::widget([
                'layout' => "{summary}\n{pager}\n{items}\n{pager}\n",
                'dataProvider' => $dataProvider,
                'pager' => [
                'options' => ['class' => 'pagination pagination-xs']
                ],
                'options' => [
                'class' => 'table-light'
                ],
                'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                                            					'brandId',
                                                        					'title',
                                                        					'description:ntext',
                                                        					'image',
                                                        					'status',
                            					// 'parentId',
					// 'createDateTime',
					// 'updateDateTime',
                ['class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                                'template' => '{view} {update} {delete}',
                'buttons'=> []
                ],
                ],
                ]); ?>
                    </div>
    </div>
    <?php Pjax::end(); ?>
</div>
