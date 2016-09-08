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

	if (isset($_REQUEST['email'])) {
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
	Header("Location: thankyou.html");




?>
