<?php
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
echo CHtml::hiddenField("access_key", $ePayment->ePaymentAccessKey);
echo CHtml::hiddenField("profile_id", $ePayment->ePaymentProfileId);
echo CHtml::hiddenField("transaction_uuid", uniqid());
echo CHtml::hiddenField("signed_field_names", "access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount"
	. ",currency"
	//. ", override_custom_receipt_page"
	//. ", item_0_name, item_1_name"
);
//Product Parameter
$unsignedField = ""
	. "bill_to_address_city,bill_to_address_country,bill_to_address_line1,bill_to_address_line2,bill_to_address_postal_code"
	. ",bill_to_address_state,bill_to_email,bill_to_forename,bill_to_phone,bill_to_surname,bill_to_address_country"
	. ",device_fingerprint_id,customer_ip_address,consumer_id"
	. ",ship_to_address_city,ship_to_address_country,ship_to_address_line1,ship_to_address_line2,ship_to_address_postal_code"
	. ",ship_to_address_state,ship_to_forename,ship_to_phone,ship_to_surname,shipping_method"
//	. ", item_0_name, item_1_name"
	. ",merchant_defined_data1,merchant_defined_data2,merchant_defined_data3,merchant_defined_data4,merchant_defined_data5,merchant_defined_data6,merchant_defined_data7,merchant_defined_data8,merchant_defined_data9"
	. ",merchant_defined_data10,merchant_defined_data11,line_item_count";

echo CHtml::hiddenField("transaction_type", "sale");
echo CHtml::hiddenField("signed_date_time", gmdate("Y-m-d\TH:i:s\Z"));
echo CHtml::hiddenField("locale", "en");
echo CHtml::hiddenField("currency", "THB");
echo CHtml::hiddenField("payment_method", "card");
//Standard Parameter
//
//Order Parameter
echo CHtml::hiddenField("reference_number", $model->orderNo);
echo CHtml::hiddenField("amount", number_format($model->summary, 2, ".", ""));
//Order Parameter
//
//Billing Address Parameter
echo CHtml::hiddenField("bill_to_address_city", $model->paymentAmphur->amphurName);
echo CHtml::hiddenField("bill_to_address_country", "TH");
echo CHtml::hiddenField("bill_to_address_line1", $model->paymentAddress1);
echo CHtml::hiddenField("bill_to_address_line2", $model->paymentAddress2);
echo CHtml::hiddenField("bill_to_address_postal_code", $model->paymentPostcode);
echo CHtml::hiddenField("bill_to_address_state", $model->paymentProvince->provinceName);
//echo CHtml::hiddenField("bill_to_company_name", $model->paymentCompany);
echo CHtml::hiddenField("bill_to_email", $model->email);
echo CHtml::hiddenField("bill_to_forename", $model->paymentFirstname);
echo CHtml::hiddenField("bill_to_surname", $model->paymentLastname);
echo CHtml::hiddenField("bill_to_phone", $model->telephone);
//Billing Address Parameter
//
//Shipping Address Parameter
echo CHtml::hiddenField("ship_to_address_city", $model->shippingAmphur->amphurName);
echo CHtml::hiddenField("ship_to_address_country", "TH");
echo CHtml::hiddenField("ship_to_address_line1", $model->shippingAddress1);
echo CHtml::hiddenField("ship_to_address_line2", $model->shippingAddress2);
echo CHtml::hiddenField("ship_to_address_postal_code", $model->shippingPostCode);
echo CHtml::hiddenField("ship_to_address_state", $model->shippingProvince->provinceName);
//echo CHtml::hiddenField("ship_to_company_name", $model->paymentCompany);
//echo CHtml::hiddenField("ship_to_email", $model->email);
echo CHtml::hiddenField("ship_to_forename", $model->paymentFirstname);
echo CHtml::hiddenField("ship_to_surname", $model->paymentLastname);
echo CHtml::hiddenField("ship_to_phone", $model->telephone);
echo CHtml::hiddenField("shipping_method", "other");
//Shipping Address Parameter
//
//Customer Parameter
?>

<?php
//echo CHtml::hiddenField("override_custom_receipt_page", "Web");
echo CHtml::hiddenField("customer_ip_address", CHttpRequest::getUserHostAddress());
echo CHtml::hiddenField("consumer_id", (isset($model->userId) && $model->userId > 0) ? $model->userId : 1);
echo CHtml::hiddenField("device_fingerprint_id", $session_id);
//Customer Parameter
//
//Merchant Parameter
echo CHtml::hiddenField("merchant_defined_data1", "Thailand");
echo CHtml::hiddenField("merchant_defined_data2", "thai");
//echo CHtml::hiddenField("merchant_defined_data3", "TH");
echo CHtml::hiddenField("merchant_defined_data3", (isset($model->pointToBaht) && $model->pointToBaht > 0) ? number_format($model->pointToBaht, 2, ".", "") : 0);
echo CHtml::hiddenField("merchant_defined_data4", 1);
echo CHtml::hiddenField("merchant_defined_data5", "daii-its@daiigroup.com");
echo CHtml::hiddenField("merchant_defined_data6", "Daiibuy");
echo CHtml::hiddenField("merchant_defined_data7", "DaiiGroup");
echo CHtml::hiddenField("merchant_defined_data8", hash("md5", uniqid()));
echo CHtml::hiddenField("merchant_defined_data9", "Thailand");
echo CHtml::hiddenField("merchant_defined_data10", $ePayment->ePaymentTel);

//Merchant Parameter
//
$i = 0;
foreach ($model->orders as $order)
{
//	throw new Exception(print_r($order->orderItems, true));
	foreach ($order->orderItems as $item)
	{
		$unsignedField .=",item_" . $i . "_unit_price,item_" . $i . "_tax_amount,item_" . $i . "_code,item_" . $i . "_name,item_" . $i . "_sku,item_" . $i . "_quantity";
		echo CHtml::hiddenField("item_" . $i . "_unit_price", number_format($item->price, 2, ".", ""));
		echo CHtml::hiddenField("item_" . $i . "_tax_amount", number_format(($item->total / 1.07), 2, ".", ""));
		echo CHtml::hiddenField("item_" . $i . "_code", "default");
		echo CHtml::hiddenField("item_" . $i . "_name", isset($item->product->name) ? $item->product->name : $item->title);
		echo CHtml::hiddenField("item_" . $i . "_sku", isset($item->product->name) ? $item->product->name : "-");
		echo CHtml::hiddenField("item_" . $i . "_quantity", $item->quantity);
		$i++;
	}
}
echo CHtml::hiddenField("unsigned_field_names", $unsignedField
);
$itemCount = $i++;
echo CHtml::hiddenField("line_item_count", $itemCount);
echo CHtml::hiddenField("merchant_defined_data11", $itemCount);
?>
