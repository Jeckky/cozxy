<?php

use yii\helpers\Html;

//Standard Parameter
$session_id = uniqid();
$orgId = $ePayment->ePaymentOrgId;
$merchantId = $ePayment->ePaymentMerchantId;
?>
<p style="background:url(https://h.online-metrix.net/fp/clear.png?org_id=<?php echo $orgId; ?>&amp;session_id=<?php echo $merchantId . $session_id ?>&amp;m=1)"></p>
<img src="https://h.online-metrix.net/fp/clear.png?org_id=<?php echo $orgId; ?>&amp;session_id=<?php echo $merchantId . $session_id ?>&amp;m=2" alt="">
<object type="application/x-shockwave-flash" data="https://h.online-metrix.net/fp/fp.swf?org_id=<?php echo $orgId; ?>&amp;session_id=<?php echo $merchantId . $session_id ?>" width="1" height="1" id="thm_fp">
    <param name="movie" value="https://h.online-metrix.net/fp/fp.swf?org_id=<?php echo $orgId; ?>&amp;session_id=<?php echo $merchantId . $session_id ?>" />
</object>
<script src="https://h.online-metrix.net/fp/check.js?org_id=<?php echo $orgId; ?>&amp;session_id=<?php echo $merchantId . $session_id ?>"
type="text/javascript"></script>
<?php
echo Html::hiddenInput("access_key", $ePayment->ePaymentAccessKey);
echo Html::hiddenInput("profile_id", $ePayment->ePaymentProfileId);
echo Html::hiddenInput("transaction_uuid", uniqid());
echo Html::hiddenInput("signed_field_names", "access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount"
 . ",currency"
//. ", override_custom_receipt_page"
//. ", item_0_name, item_1_name"
);
//Product Parameter
$unsignedField = ""
 . "bill_to_address_city,bill_to_address_country,bill_to_address_line1,bill_to_address_postal_code"
 . ",bill_to_address_state,bill_to_email,bill_to_forename,bill_to_phone,bill_to_surname,bill_to_address_country"
 . ",device_fingerprint_id,customer_ip_address,consumer_id"
 . ",ship_to_address_city,ship_to_address_country,ship_to_address_line1,ship_to_address_postal_code"
 . ",ship_to_address_state,ship_to_forename,ship_to_phone,ship_to_surname,shipping_method"
//	. ", item_0_name, item_1_name"
 . ",merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4,merchant_defined_data5,merchant_defined_data6,merchant_defined_data7,merchant_defined_data8,merchant_defined_data9"
 . ",merchant_defined_data10,merchant_defined_data11,line_item_count";

//throw new \yii\base\Exception(gmdate("Y-m-d\TH:i:s\Z"));
echo Html::hiddenInput("transaction_type", "sale");
echo Html::hiddenInput("signed_date_time", gmdate("Y-m-d\TH:i:s\Z"));
echo Html::hiddenInput("locale", "en");
echo Html::hiddenInput("currency", "THB");
echo Html::hiddenInput("payment_method", "card");
//Standard Parameter
//
//Order Parameter
echo Html::hiddenInput("reference_number", $model->orderNo);
echo Html::hiddenInput("amount", number_format($model->summary, 2, ".", ""));
//Order Parameter
//
//Billing Address Parameter
echo Html::hiddenInput("bill_to_address_city", $model->billingCities->localName);
echo Html::hiddenInput("bill_to_address_country", "TH");
echo Html::hiddenInput("bill_to_address_line1", $model->billingAddress);
//echo Html::hiddenInput("bill_to_address_line2", "");
echo Html::hiddenInput("bill_to_address_postal_code", $model->billingZipcode);
echo Html::hiddenInput("bill_to_address_state", $model->billingProvince->localName);
//echo Html::hiddenInput("bill_to_company_name", $model->billingCompany);
echo Html::hiddenInput("bill_to_email", $model->user->email);
echo Html::hiddenInput("bill_to_forename", $model->user->firstname);
echo Html::hiddenInput("bill_to_surname", $model->user->lastname);
echo Html::hiddenInput("bill_to_phone", $model->billingTel);
//Billing Address Parameter
//
//Shipping Address Parameter
echo Html::hiddenInput("ship_to_address_city", $model->shippingCities->localName);
echo Html::hiddenInput("ship_to_address_country", "TH");
echo Html::hiddenInput("ship_to_address_line1", $model->shippingAddress);
//echo Html::hiddenInput("ship_to_address_line2", "");
echo Html::hiddenInput("ship_to_address_postal_code", $model->shippingZipcode);
echo Html::hiddenInput("ship_to_address_state", $model->shippingProvince->localName);
//echo Html::hiddenInput("ship_to_company_name", $model->billingCompany);
//echo Html::hiddenInput("ship_to_email", $model->email);
echo Html::hiddenInput("ship_to_forename", $model->user->firstname);
echo Html::hiddenInput("ship_to_surname", $model->user->lastname);
echo Html::hiddenInput("ship_to_phone", $model->shippingTel);
echo Html::hiddenInput("shipping_method", "other");
//Shipping Address Parameter
//
//Customer Parameter
?>

<?php
//echo Html::hiddenInput("override_custom_receipt_page", "Web");
echo Html::hiddenInput("customer_ip_address", Yii::$app->request->userIP);
echo Html::hiddenInput("consumer_id", (isset($model->userId) && $model->userId > 0) ? $model->userId : 1);
echo Html::hiddenInput("device_fingerprint_id", $session_id);
//Customer Parameter
//
//Merchant Parameter
echo Html::hiddenInput("merchant_defined_data1", "Thailand");
echo Html::hiddenInput("merchant_defined_data2", "thai");
//echo Html::hiddenInput("merchant_defined_data3", "TH");
echo Html::hiddenInput("merchant_defined_data3", (isset($model->pointToBaht) && $model->pointToBaht > 0) ? number_format($model->pointToBaht, 2, ".", "") : 0);
echo Html::hiddenInput("merchant_defined_data4", 1);
echo Html::hiddenInput("merchant_defined_data5", "daii-its@daiigroup.com");
echo Html::hiddenInput("merchant_defined_data6", "Daiibuy");
echo Html::hiddenInput("merchant_defined_data7", "DaiiGroup");
echo Html::hiddenInput("merchant_defined_data8", hash("md5", uniqid()));
echo Html::hiddenInput("merchant_defined_data9", "Thailand");
echo Html::hiddenInput("merchant_defined_data10", $ePayment->ePaymentTel);

//Merchant Parameter
//
$i = 0;
//	throw new Exception(print_r($order->orderItems, true));
foreach ($model->orderItems as $item) {
    $unsignedField .=",item_" . $i . "_unit_price,item_" . $i . "_tax_amount,item_" . $i . "_code,item_" . $i . "_name,item_" . $i . "_sku,item_" . $i . "_quantity";
    echo Html::hiddenInput("item_" . $i . "_unit_price", number_format($item->price, 2, ".", ""));
    echo Html::hiddenInput("item_" . $i . "_tax_amount", number_format(($item->total / 1.07), 2, ".", ""));
    echo Html::hiddenInput("item_" . $i . "_code", "default");
    echo Html::hiddenInput("item_" . $i . "_name", isset($item->product->title) ? $item->product->title : $item->title);
    echo Html::hiddenInput("item_" . $i . "_sku", isset($item->product->isbn) ? $item->product->isbn : "-");
    echo Html::hiddenInput("item_" . $i . "_quantity", number_format($item->quantity, 0));
    $i++;
}
echo Html::hiddenInput("unsigned_field_names", $unsignedField
);
$itemCount = $i++;
echo Html::hiddenInput("line_item_count", $itemCount);
echo Html::hiddenInput("merchant_defined_data11", $itemCount);
?>
