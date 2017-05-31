<input type="hidden" name="access_key" value="<?php echo Yii::app()->params["ePaymentAccessKey"]; ?>">
<input type="hidden" name="profile_id" value="<?php echo Yii::app()->params["ePaymentProfileId"]; ?>">
<input type="hidden" name="transaction_uuid" value="<?php echo uniqid() ?>">
<input type="hidden" name="signed_field_names"
	   value="access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,override_custom_receipt_page">
<input type="hidden" name="unsigned_field_names" value="bill_to_address_city,bill_to_address_country,bill_to_address_line1,bill_to_address_line2,bill_to_address_postal_code,bill_to_address_state,bill_to_email,bill_to_forename,bill_to_phone,bill_to_surname">
<!--			<input type="hidden" name="unsigned_field_names" >-->
<input type="hidden" name="signed_date_time" value="<?php echo gmdate("Y-m-d\TH:i:s\Z"); ?>">
<input type="hidden" name="locale" value="en">

<input type="hidden" name="bill_to_address_city" value="bangkok">
<input type="hidden" name="bill_to_address_country" value="TH">
<input type="hidden" name="bill_to_address_line1" value="1 floor 7 soi.Ladprao19">
<input type="hidden" name="bill_to_address_line2" value="Jomphol Jatujak">
<input type="hidden" name="bill_to_address_postal_code" value="10900">
<input type="hidden" name="bill_to_address_state" value="BKK">
<input type="hidden" name="bill_to_email" value="kamon.p@daiigroup.com">
<input type="hidden" name="bill_to_forename" value="Kamon">
<input type="hidden" name="bill_to_phone" value="0836134241">
<input type="hidden" name="bill_to_surname" value="Puanggasem">
<?php
$ipaddress = getenv('HTTP_CLIENT_IP')? :
	getenv('HTTP_X_FORWARDED_FOR')? :
		getenv('HTTP_X_FORWARDED')? :
			getenv('HTTP_FORWARDED_FOR')? :
				getenv('HTTP_FORWARDED')? :
					getenv('REMOTE_ADDR');
?>
<input type="hidden" name="customer_ip_address" value="<?php echo $ipaddress; ?>">
<input type="hidden" name="override_custom_receipt_page" value="Web">
<input type="hidden" name="merchant_defined_data1" value="Thailand">
<input type="hidden" name="consumer_id" value="1">
<input type="hidden" name="payment_method" value="Credit card">

<input type="hidden" name="transaction_type" value="sale">
<input type="hidden" name="reference_number" value="1234567890">
<input type="hidden" name="amount" value="3200">
<input type="hidden" name="currency" value="THB">

<?php $session_id = uniqid(); ?>
<p style="background:url(https://h.online-metrix.net/fp/clear.png?org_id=1snn5n9w&amp;session_id=kr950210500<?php echo $session_id ?>&amp;m=1)"></p>
<img src="https://h.online-metrix.net/fp/clear.png?org_id=1snn5n9w&amp;session_id=kr950210500<?php echo $session_id ?>UGPJZXFWHFOMTQFISIQCFEQ&amp;m=2" alt="">
<object type="application/x-shockwave-flash" data="https://h.online-metrix.net/fp/fp.swf?org_id=1snn5n9w&amp;session_id=kr950210500<?php echo $session_id ?>" width="1" height="1" id="thm_fp">
	<param name="movie" value="https://h.online-metrix.net/fp/fp.swf?org_id=1snn5n9w&amp;session_id=kr950210500<?php echo $session_id ?>" />
</object>
<script src="https://h.online-metrix.net/fp/check.js?org_id=1snn5n9w&amp;session_id=kr950210500<?php echo $session_id ?>"
type="text/javascript"></script>
<input type="hidden" name="device_finger_print_id" value="<?php echo $session_id ?>">