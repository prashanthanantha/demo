<?php 



function getCurls($contrlfun){



	# An HTTP GET request example



	//$url = 'http://manastlouis.com/apiservices/Users/getAllStates';



	$url = GLOBAL_BACKEND_PATH."$contrlfun";

	


	$ch = curl_init($url);


	curl_setopt($ch, CURLOPT_TIMEOUT, 5);



	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);



	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



	$data = curl_exec($ch);



	curl_close($ch);



	$data = json_decode($data, true);




	//echo '13::<pre>'; print_r($data); echo '</pre>'; exit();



	return $data;



}



function postCurls($contrlfun,$senddata){



	# An HTTP GET request example



	//$url = 'http://manastlouis.com/cake_php_test/Users/getAllStates';



	$data_string = json_encode($senddata);



	$url = GLOBAL_BACKEND_PATH."$contrlfun";



	$ch = curl_init($url);



	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");



	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);



	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);



	curl_setopt($ch, CURLOPT_HTTPHEADER, array(



	    'Content-Type: application/json',



	    'Content-Length: ' . strlen($data_string))



	);



	curl_setopt($ch, CURLOPT_TIMEOUT, 5);



	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);







	//execute post



	$result = curl_exec($ch);







	//close connection



	curl_close($ch);



	$result = json_decode($result, true);



	return $result;



}



?>