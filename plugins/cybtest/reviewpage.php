<?php include 'security.php' ?>

<html>
<head>
<title>PHP Test</title>
</head>
<body>
<h3>Testing Cybersource Secure Acceptance Web/Mobile</h3>
<p>
Click button below to submit parameters to Cybersource SA.
</p>
<form action="https://testsecureacceptance.cybersource.com/pay" method="post">
	<input type="submit" name="btnSubmit">
	
	<?php
		
		/* php calc vals */
		
		$signed_datetime = gmdate("Y-m-d\TH:i:s\Z");
		$uuid = uniqid();
		
		/* signed params */
	  
		$saparams = array(
			"access_key" => "12543b47e17e350f8f59fec948cc31b5",
			
			"bill_to_forename" => "Eva",
			"bill_to_surname" => "Adelseck",
			"bill_to_address_line1" => "Department of German Studies",
			"bill_to_address_line2" => "Samuel Alexander Building",
			"bill_to_address_city" => "Manchester",
			"bill_to_address_country" => "gb",
			"bill_to_address_postal_code" => "M139PL",
			"bill_to_address_state" => "",
			"bill_to_company_name" => "University of Manchester",
			"bill_to_phone" => "7093005526",
			"bill_to_email" => "jnana.sowmya29@gmail.com",

			"payment_method" => "card",
			"profile_id" => "test_dup",
			"signed_date_time" => $signed_datetime,
			"locale" => "en-us",
			"signed_field_names" => "access_key,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_country,bill_to_address_postal_code,bill_to_address_state,bill_to_company_name,bill_to_phone,bill_to_email,payment_method,profile_id,signed_date_time,locale,signed_field_names,transaction_type,transaction_uuid,unsigned_field_names,currency,amount,reference_number,override_custom_receipt_page,override_custom_cancel_page",
			"transaction_type" => "sale",
			"transaction_uuid" => $uuid,
			
			"unsigned_field_names" => "",
			"currency" => "USD",
			"amount" => "25.00",
			"reference_number" => "9999999999",
			"override_custom_receipt_page" => "https://dev.dukeupress.edu/_arieltest/responsepage.php",
			"override_custom_cancel_page" => "https://dev.dukeupress.edu/_arieltest/cancelpage.php"
		);
	
	?>
		
	<input type="hidden" name="signature" value="<?php echo sign($saparams) ?>"/>
	
	
	<input type="hidden" name="bill_to_forename" value="Eva">
   <input type="hidden" name="bill_to_surname" value="Adelseck">
   <input type="hidden" name="bill_to_address_line1" value="Department of German Studies">
   <input type="hidden" name="bill_to_address_line2" value="Samuel Alexander Building">
   <input type="hidden" name="bill_to_address_city" value="Manchester">
   <input type="hidden" name="bill_to_address_country" value="gb">
   <input type="hidden" name="bill_to_address_postal_code" value="M139PL">
   <input type="hidden" name="bill_to_address_state" value="">
   <input type="hidden" name="bill_to_company_name" value="University of Manchester">
   <input type="hidden" name="bill_to_phone" value="9196873600">
   <input type="hidden" name="bill_to_email" value="ariel.dela.fuente@dukeupress.edu">

   <input type="hidden" name="payment_method" value="card"/>
   <input type="hidden" name="profile_id" value="test_dup"/>
   
   <input type="hidden" name="signed_date_time" value="<?php echo $signed_datetime; ?>">
   <input type="hidden" name="locale" value="en-us">
   <input type="hidden" name="signed_field_names"
           value="access_key,bill_to_forename,bill_to_surname,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_country,bill_to_address_postal_code,bill_to_address_state,bill_to_company_name,bill_to_phone,bill_to_email,payment_method,profile_id,signed_date_time,locale,signed_field_names,transaction_type,transaction_uuid,unsigned_field_names,currency,amount,reference_number,override_custom_receipt_page,override_custom_cancel_page">
   <input type="hidden" name="transaction_type" value="sale"/>
   <input type="hidden" name="transaction_uuid" value="<?php echo $uuid; ?>">
   <input type="hidden" name="access_key" value="cf36a17c14c33a33a92c003c3c15f7bd">
   <input type="hidden" name="unsigned_field_names">
   <input type="hidden" name="currency" value="USD">
   
   
   <input type="hidden" name="amount" value="25.00">   
   <input type="hidden" name="reference_number" value="9999999999"/>
   
   <input type="hidden" name="override_custom_receipt_page" value="https://dev.dukeupress.edu/_arieltest/responsepage.php"/>
   <input type="hidden" name="override_custom_cancel_page" value="https://dev.dukeupress.edu/_arieltest/cancelpage.php"/>
   
   

   
</form>

</body>
</html>