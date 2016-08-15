<?php
//$this->renderPartial("security", array(
//	'ePayment'=>$ePayment));
include 'security.php';
$this->registerJs("
		setTimeout(function () {
			$('#confirmationForm').submit();
		}, 1000
				);
	", yii\web\View::POS_READY);
?>
<!--<script >
    $(document).ready(function () {
        setTimeout(function () {
            $('#confirmationForm').submit();
            alert(111);
        }, 1000
                );
    });
</script>-->



<?php
//throw new \yii\base\Exception(print_r($_REQUEST, true));
foreach ($_REQUEST as $name => $value) {
    if (strtolower($name) == 'submit')
        continue;

    $params[$name] = $value;
}
?>
<div class="bs-callout bs-callout-warning" id="callout-formgroup-inputgroup">
    <section class="support">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-md-8 col-sm-8">

                    <div class="sidebar-box-heading">
                        <i class="icons icon-box-2"></i>
                        <h4 style="color:black">Waiting e-Payment</h4>
                    </div>
                    <div class="sidebar-box-content sidebar-padding-box">
                        <!--<div class="row">-->
                        <!--<div class="col-md-12" style="height: 100px">-->
                        <?php
//					echo CHtml::image(Yii::app()->baseUrl . "/images/logo.png", "", array(
//						"style"=>"width:250px"));
                        ?>
                        <!--</div>-->
                        <!--</div>-->
                        <div class="row">
                            <div class="col-md-12" style="color:black">
                                <i class="fa fa-spinner fa-3"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span  style="font-size: 30px;font-weight: bold">ระบบกำลังดำเนินการ ติดต่อธนาคารเพื่อชำระเงิน</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>
</div>
<?php // echo $ePayment->ePaymentUrl; ?>
<form id="confirmationForm" action="<?php echo $ePayment->ePaymentUrl; ?>" method="post">
    <?php
    foreach ($params as $name => $value) {
        echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
    }

    echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . sign($params) . "\"/>\n";
    ?>

    <!--<input type="submit" id="submit" value="submit" />-->

</form>

