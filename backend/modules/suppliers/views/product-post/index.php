<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Posts';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageHeader'] = Html::encode($this->title);
?>
<div class="product-post-index">

    <?php
    $form = ActiveForm::begin([
        'options' => ['class' => 'panel panel-default form-horizontal', 'enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-9">{input}</div>',
            'labelOptions' => [
                'class' => 'col-sm-3 control-label'
            ]
        ]
    ]);
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6"><?= $this->title ?></div>
                <div class="col-md-6">
                    <div class="btn-group pull-right">
                        <?//= Html::a('<i class=\'glyphicon glyphicon-plus\'></i> Create Product Post', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?//= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->widget(\yii\redactor\widgets\Redactor::className()) ?>

            <?= $form->field($model, 'description', ['options' => ['class' => 'row form-group']])->textArea(['rows' => '6']) ?>

            <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3">
                    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php $this->registerJs("
           init.push(function () {
            if (!$('html').hasClass('ie8')) {
                $('#productpost-description').summernote({
                    height: 600,
                    tabsize: 2,
                    codemirror: {
                        theme: 'monokai'
                    }
                });


            }

        });



", \yii\web\View::POS_END); ?>
</div>
