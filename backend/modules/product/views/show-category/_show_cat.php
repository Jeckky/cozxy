<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr style="background-color: #0073ea;color:white">
                    <td colspan="5" class="text-center"><h3>Show Home Category Setting</h3></td>
                </tr>
            <form method="POST">
                <tr style="background-color: wheat;color:white">
                    <td colspan="4" class="text-center">
                        <input class="form-control" name="searchText" value="<?= isset($searchText) ? $searchText : "" ?>">
                    </td>
                    <td>
                        <input type="submit" class="btn btn-success" value="Search">
                    </td>
                </tr>
            </form>
            <tr class="text-center" style="background-color: #0097cf;color:white">
                <td colspan="2">Save Category</td>
                <td colspan="2">Popular Category</td>
                <td></td>
            </tr>

            </thead>
            <tbody>
                <?php
                foreach ($categorys as $cat):
                    $showCat = \common\models\costfit\ShowCategory::find()->where("categoryId=" . $cat->categoryId)->one();
                    ?>
                    <tr>
                        <td>
                            <input type="radio" name="ShowCategory[<?= $cat->categoryId; ?>]" value="1" id="ShowCategory_<?= $cat->categoryId ?>_1" <?= (isset($showCat) && ($showCat->type == 1)) ? " checked='checked'" : "" ?> >
                        </td>
                        <td>
                            <label for="ShowCategory_<?= $cat->categoryId ?>_1">
                                <?= $cat->title ?>
                            </label>
                        </td>
                        <td>
                            <input type="radio" name="ShowCategory[<?= $cat->categoryId; ?>]" value="2" id="ShowCategory_<?= $cat->categoryId ?>_2" <?= (isset($showCat) && ($showCat->type == 2)) ? " checked='checked'" : "" ?> >
                        </td>
                        <td>
                            <label for="ShowCategory_<?= $cat->categoryId ?>_2">
                                <?= $cat->title ?>
                            </label>
                        </td>
                        <td>
                            <a href="<?= Yii::$app->homeUrl . "product/show-category/delete-show-category?id=" . $cat->categoryId; ?>" class="btn btn-danger btn-xs" onclick="return confirm('คุณต้องการลบ Show Category หรือไม่?')" >Delete</a>
                        </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-10 col-lg-offset-2">
        <input type="submit" class="btn btn-success" value="Save">
    </div>
</div>

<?php ActiveForm::end(); ?>