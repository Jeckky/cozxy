<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<h1>CSV Importer category to Database</h1>

<div id="content-wrapper">
    <div class="row">

        <div class="panel ">
            <div class="panel-heading ">
                <span class="panel-title"><i class="fa fa-th-large"></i> Upload CSV Importer category to Database</span>
            </div>
            <div class="panel-body">

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
                <br><br>
                <div class="row form-group field-brand-title required">
                    <label class="col-sm-3 control-label" for="brand-title">File </label>
                    <div class="col-sm-9">
                        <input type="hidden" name="File[image]" value="">
                        <?= Html::input('file', 'File[image]') ?>
                    </div>
                    <?php if ($notify == 'warning') { ?>
                        <div class="col-sm-9">
                            <div class="note note-warning">
                                <h4 class="note-title">Warning note title</h4>
                                Warning note text here.
                            </div>
                        </div>
                        <?php
                    } else if ($notify == 'success') {
                        ?> 
                        <div class="col-sm-9">
                            <div class="note note-success">
                                <h4 class="note-title">Success note title</h4>
                                Success note text here.
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div> <!-- / .row -->
</div> <!-- / #content-wrapper -->
