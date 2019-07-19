<?php

require 'class.phpmailer.php';

require 'class.smtp.php';

/**

* 

*/

class Mail

{

	

	function func_send_email($emailTemplate, $emailToAddress, $emailFromAddress, $subject)

	{


		/*

		 * Adding new Mail functionality

		 */

		

		if($mail = new PHPMailer())

		{

				//echo "yes";

		}

		else

		{

				//echo "no";

		}

		

		$mail->IsSMTP();
		$mail->CharSet = "utf-8";
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "smtp.gmail.com"; // SMTP server

		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)


		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier

		$mail->Port       = 25;                   // set the SMTP port for the GMAIL server



		$mail->Username   = "mnsnews8@gmail.com";  // GMAIL username

		$mail->Password   = "mnsnews8@";



		$mail->AddReplyTo("donotreply@manast.com", "donotreply@manast.com");

		$mail->SetFrom("maruti4411ww@gmail.com", "manastsite");



		$subject = $subject;

		$emailToAddress = $emailToAddress;

		$mail->Subject    = $subject;

		$mail->IsHTML(true);

		$mail->MsgHTML($emailTemplate);



		if(is_array($emailToAddress) == true)

		{

			$emails_array = $emailToAddress;

			//$emails_array['maruti4411y@gmail.com'] = 'maruti4411y@gmail.com';

			//$emails_array['jnana.s@etisbew.com'] = 'jnana.s@etisbew.com';

		}

		else

		{

			$is_multiple_emails = strpos($emailToAddress, ',');

			$emails_array = array();

			if($is_multiple_emails === false)

			{

				$emails_array[0] = trim($emailToAddress);

			}

			else

			{

				$emails_array = explode(',', $emailToAddress);

			}

		}



		foreach($emails_array as $current_email)

		{

			$current_email = trim($current_email);

			

			$mail->AddAddress($current_email, $current_email);

			if(!$mail->Send())

			{

					$is_sent = false;

			}

			else

			{

					$is_sent = true;

			}



			$mail->ClearAddresses();

		}

		return $is_sent;

	}

}



?>