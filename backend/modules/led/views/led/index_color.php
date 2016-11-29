<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leds';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="led-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div><h3>LED COLOR</h3></div> <div class="pull-right" style="margin-top: -45px;"><?= Html::a('<span class="btn btn-lg btn-success" style="margin-left: 5px;
            " >+ Create New</span>', ['led/create-color']); ?></div>
        </div>
        <div class="panel-body">
            <table class="table">
                <thead><th>No.</th><th>Color</th><th>html</th><th>RGB</th><th>Action</th></thead>
                <tbody>
                    <?php
                    if (isset($model)) {
                        $i = 1;
                        foreach ($model as $color):
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><input type="text" class="form-control" disabled="true" style="background-color: <?= $color->htmlCode ?>; height: 45px;"></td>
                                <td><?= $color->htmlCode; ?></td>
                                <td><?= $color->r . ', ' . $color->g . ', ' . $color->b; ?></td>
                                <td><?= Html::a('<span class="btn btn-xs btn-success" style="margin-left: 5px;
            " >Edit</span>', ['led/update-color', 'id' => $color->ledColorId]); ?>
                                    <?= Html::a('<span class="btn btn-xs btn-danger" style="margin-left: 5px;
            " >Delete</span>', ['led/delete-color', 'id' => $color->ledColorId], ['data-confirm' => 'Are you sure?']); ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        endforeach;
                    }else {
                        echo "no";
                    }
                    ?>
                </tbody>


            </table>
        </div>
    </div>
</div>
