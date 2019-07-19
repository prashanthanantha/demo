<?php

// error_reporting(E_ALL);

// error_reporting(1);

require 'default_config/index.php';

require 'common_file/mail.php';

require 'common_file/inout_function.php';



$app->any('/postDelete', function ($request, $response, $args){

	if (isset($_POST) && count($_POST) > 0) {

		$id = $_POST["post_id"];
		$user_id = $_POST["user_id"];

		$DeleteResponceArray = postCurls('users/deletePost',$_POST);

		if($DeleteResponceArray['success'] != ''){

	    	header("Location: http://localhost/manast_curl_changes/accountInfo.php/my-account");

			die();

	    }else{

	    	header("Location: http://localhost/manast_curl_changes");

			die();

	    	

	    }

		}

});



$app->run();