<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$baseUrl = Yii::$app->getUrlManager()->getBaseUrl();

$form = ActiveForm::begin([
            'id' => 'default-shipping-address',
            'action' => $baseUrl . '/checkout/confirmation/' . $model->encodeParams(['orderId' => $model->orderId]),
            'options' => ['class' => 'space-bottom'],
        ]);
?>

<section class="support">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-xs-12">
                <h3>Confirm Payment</h3>

                <?php echo $this->render("//profile/purchase_order", ['order' => $model]); ?>
                <?php
                echo $this->render("//e_payment/_parameter_form", array(
                    'model' => $model,
                    'ePayment' => $ePayment));
                ?>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12">
                <h3>Point</h3>
                <div class="col-lg-12 text-center" style="border: 1px solid #ddd;padding: 20px;">
                    <table style="width: 100%;color: #000;">
                        <tr style="height: 40px;">
                            <td style="text-align: left;">Current Point</td><td style="text-align: right;"><?= number_format($userPoint->currentPoint, 2) ?></td>
                        </tr>
                        <tr style="height: 40px;">
                            <td style="text-align: left;">Order subtotal</td><td style="text-align: right;"><?= number_format($model->summary, 2) ?></td>
                        </tr>
                        <tr style="height: 40px;">
                            <?php
                            if ($userPoint->currentPoint >= $model->summary) {
                                ?>
                                <td style="text-align: left;color: #33cc00;">Balance</td><td style="text-align: right;color: #33cc00;"><?= number_format($userPoint->currentPoint - $model->summary, 2) ?></td>
                            <?php } else { ?>
                                <td style="text-align: left;color: #ff0033;">Balance</td><td style="text-align: right;color: #ff0033;"> - <?= number_format($model->summary - $userPoint->currentPoint, 2) ?></td>

                            <?php }
                            ?>
                        </tr>
                        <tr style="height: 80px;">
                            <td colspan="2">
                                <?php
                                if ($userPoint->currentPoint >= $model->summary) {
                                    echo '<br><br>* ระบบจะตัด Points หลังจากกด "Confirm"<br><br><br>';
                                    echo Html::submitButton("Confirm", ['class' => 'btn btn-md btn-primary col-lg-12']);
                                } else {
                                    echo '<br><br><br>';
                                    echo Html::submitButton("Top up", ['class' => 'btn btn-md btn-primary col-lg-12']);
                                }
                                ?>
                            </td>
                        <tr style="height: 80px;">
                            <td colspan="2" style="text-align: center;">
                                <?php echo Html::a("Back", Yii::$app->homeUrl . "checkout/reverse-order-to-cart/" . common\models\ModelMaster::encodeParams(['orderId' => $model->orderId]), ['class' => 'btn btn-warning col-lg-12']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

<?php ActiveForm::end();
?>


