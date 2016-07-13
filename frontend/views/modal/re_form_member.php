<?php
/* @var $this yii\web\View HowCostFitWorks */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@app/themes/costfit/assets');
$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();
?>
<!--Confirm reFormMember-->

<div class="modal fade" id="reFormMember" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <span class="text-left">
                    <img src="<?php echo Yii::$app->homeUrl; ?>images/logo/costfit.png" alt="cost.fit" style="zoom:.2;">
                </span>
            </div>
            <div class="modal-body">
                <span class="text-center">
                    <center>
                        <img class="img-responsive img-circle-thumbnail" id="img_logo" src="<?php echo $baseUrl; ?>/images/modal/cost.fit.png" style="zoom:.8;">
                    </center>
                </span><br>
                <p class="large text-center">
                    <?php
                    if (!Yii::$app->user->isGuest) {
                        echo ' Hello , ' . (Yii::$app->user->identity->email);
                    } else {
                        echo 'Hello , Guest';
                    }
                    ?></p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #03a9f4;">
                <div class="text-center">
                    <a href="<?php echo Yii::$app->homeUrl; ?>profile" class="yes btn btn-primary">Update Info</a>
                    <a href="<?php echo Yii::$app->homeUrl; ?>" class="no btn btn-danger">No Thank</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.modal -->
<script language="JavaScript" type="text/javascript">
<?php
if (!Yii::$app->user->isGuest):
    $firstname = Yii::$app->user->identity->firstname;
    $lastname = Yii::$app->user->identity->lastname;
    if (empty($firstname)) {
        ?>
            $('#reFormMember').modal({
                show: 'false'
            });
        <?php
    }
    ?>
    <?php
    if (empty($lastname)) {
        ?>
            $('#reFormMember').modal({
                show: 'false'
            });
        <?php
    }
endif;
?>
</script>