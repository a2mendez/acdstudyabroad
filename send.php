<?php

function spamcheck($field)
  {
  //filter_var() sanitizes the e-mail
  //address using FILTER_SANITIZE_EMAIL
  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

  //filter_var() validates the e-mail
  //address using FILTER_VALIDATE_EMAIL
  if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
    return TRUE;
    }
  else
    {
    return FALSE;
    }
  }


/*require_once('recaptchalib.php');
$privatekey = "6LdPRgAAAAAAANILy94wzI7GdAxGc49czfjNrSdM";
$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);


if (!$resp->is_valid) {
  // What happens when the CAPTCHA was entered incorrectly
	die ("The reCAPTCHA wasn't entered correctly. Go back and try it again.");
} else {
// Your code here to handle a successful verification*/

/*	if (isset($_REQUEST['email'])) {
	//if "email" is filled out, proceed
	
		//check if the email address is invalid
		$mailcheck = spamcheck($_REQUEST['email']);
		if ($mailcheck==FALSE) {
		   echo "Invalid input";
		} else {
			//send email
			$email = $_REQUEST['email'];
			$subject = "[Web Request] Flight Academy Inquiry";
			$message = "This person would like to make an appointment for a Discovery Flight:\n\n".

			"Contact:\n".
			$_REQUEST['first-name'] ."\n".
			$_REQUEST['last-name-surname'] ."\n".
			$_REQUEST['email'] ."\n\n";

			mail("amendezt@lynn.edu", $subject, $message, "From: $email\n\rBCC:a2mendez@gmail.com" );
		}
	 }
	Header("Location: thank-you.html"); */
	
	require_once 'phpmailer/PHPMailerAutoload.php';
 
$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
 
class phpmailerAppException extends phpmailerException {}
 
try {
$to = 'info@acdstudyabroad.com';
if(!PHPMailer::validateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->isSMTP();
$mail->SMTPDebug  = 2;
$mail->Host       = "smtp.mandrillapp.com";
$mail->Port       = "587";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth   = true;
$mail->Username   = "Lynn University";
$mail->Password   = "1RocrPqxxE5bbjRrzHvULA";
$mail->addReplyTo("info@acdstudyabroad.com", "ACD Study Abroad");
$mail->setFrom("info@acdstudyabroad.com", "ACD Study Abroad");
$mail->addAddress("a2mendez@gmail.com", "tony");
$mail->addBCC("");
$mail->addCC("");
$mail->Subject  = "ACD Study Abroad - Interested Student";
//$body = <<<'EOT'
//testing 123
//EOT;

$body = "This person would like to make an appointment for ACD Study Abroad program:\r\n\n".

			"Contact:\r\n".
			$_REQUEST['formFieldFirstName'] ."\r\n".
			$_REQUEST['formFieldLastName'] ."\r\n".
			$_REQUEST['formField_Email'] ."\r\n";


$mail->WordWrap = 78;
$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
//$mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png');  // optional name
//$mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name
 
try {
  $mail->send();
  $results_messages[] = "Message has been sent using SMTP";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}
 
if (count($results_messages) > 0) {
  echo "<h2>Run results</h2>\n";
  echo "<ul>\n";
foreach ($results_messages as $result) {
  echo "<li>$result</li>\n";
}
echo "</ul>\n";
}

Header("Location: thank-you.html");



?>
