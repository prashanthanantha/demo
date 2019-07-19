<?php
/**
* 
*/
class CryptoJSAes 
{
	
	/**
	* Helper library for CryptoJS AES encryption/decryption
	* Allow you to use AES encryption on client side and server side vice versa
	*
	* @author BrainFooLong (bfldev.com)
	* @link https://github.com/brainfoolong/cryptojs-aes-php
	*/

	/**
	* Decrypt data from a CryptoJS json encoding string
	*
	* @param mixed $passphrase
	* @param mixed $jsonString
	* @return mixed
	*/
	function cryptoJsAesDecrypt($jsonString){
	    $passphrase = "mypass";
	    $jsondata = json_decode($jsonString, true);
	    try {
	        $salt = hex2bin($jsondata["s"]);
	        $iv  = hex2bin($jsondata["iv"]);
	    } catch(Exception $e) { return null; }
	    $ct = base64_decode(str_pad(strtr($jsondata["ct"], '-_', '+/'), strlen($jsondata["ct"]) % 4, '=', STR_PAD_RIGHT));

	    $concatedPassphrase = $passphrase.$salt;
	    $md5 = array();
	    $md5[0] = md5($concatedPassphrase, true);
	    $result = $md5[0];
	    for ($i = 1; $i < 3; $i++) {
	        $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
	        $result .= $md5[$i];
	    }
	    $key = substr($result, 0, 32);
	    $data = openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);

	    return json_decode($data, true);
	}

	/**
	* Encrypt value to a cryptojs compatiable json encoding string
	*
	* @param mixed $passphrase
	* @param mixed $value
	* @return string
	*/
	function cryptoJsAesEncrypt($value){

	    $passphrase = "mypass";
	    $salt = openssl_random_pseudo_bytes(8);
	    $salted = '';
	    $dx = '';
	    while (strlen($salted) < 48) {
	        $dx = md5($dx.$passphrase.$salt, true);
	        $salted .= $dx;
	    }
	    $key = substr($salted, 0, 32);
	    $iv  = substr($salted, 32,16);
	    $encrypted_data = openssl_encrypt(json_encode($value), 'aes-256-cbc', $key, true, $iv);
	    $data = array("ct" => rtrim(strtr(base64_encode($encrypted_data), '+/', '-_'), '='), "iv" => bin2hex($iv), "s" => bin2hex($salt));

	    return json_encode($data);

	    //$jsonObj = '{"username" : username, "password" : digest_md5 }';
		//echo $jsonObj;
		//$temp = cryptoJsAesEncrypt($jsonObj);
		//echo $temp;
		//$temp = cryptoJsAesDecrypt($temp);
		//echo $temp;
	}


	function cryptoDecrypt($val){

	    $passphrase = "mypass";
	    $jsondata = $val;
	    try {
	        $salt = hex2bin($jsondata["s"]);
	        $iv  = hex2bin($jsondata["iv"]);
	    } catch(Exception $e) { return null; }
	    $ct = base64_decode($jsondata);

	   
	    $concatedPassphrase = $passphrase.$salt;
	    $md5 = array();
	    $md5[0] = md5($concatedPassphrase, true);
	    $result = $md5[0];
	    for ($i = 1; $i < 3; $i++) {
	        $md5[$i] = md5($md5[$i - 1].$concatedPassphrase, true);
	        $result .= $md5[$i];
	    }
	    $key = substr($result, 0, 32);
	    $data = openssl_decrypt($ct, 'aes-256-cbc');

	    return json_decode($data, true);
	}


	function cEn($vals)
	{
		$vals = '10050';
		$passphrase = "mypass";
	    $salt = openssl_random_pseudo_bytes(8);
	    $salted = '';
	    $dx = '';
	    while (strlen($salted) < 48) {
	        $dx = md5($dx.$passphrase.$salt, true);
	        $salted .= $dx;
	    }
	    $key = substr($salted, 0, 32);
	    $iv  = substr($salted, 32,16);
	    $encrypted_data = openssl_encrypt($vals, 'aes-256-cbc', $key, true, $iv);
	    $data = base64_encode($encrypted_data);

	    echo "<pre>";
	    print_r($data);
	   
	    return $data;


	}


}




?>