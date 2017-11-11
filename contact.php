<?php

include 'config/config.php';
	error_reporting (E_ALL ^ E_NOTICE);
	$post = (!empty($_POST)) ? true : false;
	ini_set('display_errors', 1);

if($post)
	{
		include 'config/functions.php';
		$name = stripslashes($_POST['name']);
		$phone = trim($_POST['phone']);
		$email = trim($_POST['email']);
		$verandah = trim($_POST['verandah']);
		$message = stripslashes($_POST['message']);

		$error = '';

// Check name
if(!$name)
	{
		$error .= 'Please enter your name.<br />';
	}
// Check email
if(!$email)
	{
		$error .= 'Please enter your e-mail id.<br />';
	}
if($email && !ValidateEmail($email))
	{
		$error .= 'Invalid E-mail<br />';
	}
if(!$error)
	{
		function clean_string($string) {
		  $bad = array("content-type","bcc:","to:","cc:","href");
		  return str_replace($bad,"",$string);
		}

		$subject = clean_string($name).": Website Inquiry from Innovative Verandahs Website";

		// PREPARE THE BODY OF THE MESSAGE

		$email_message = '<html><body>';
		$email_message .= '<img src="http://www.innovativeverandahs.com/images/innovative-logo.jpg" /><br><br>';
		$email_message .= '<table rules="all" style="border-color: #666;" border="1" cellspacing="5" cellpadding="10">';
		$email_message .= "<tr><td><strong>Name:</strong> </td><td>" . clean_string($name) . "</td></tr>";
		$email_message .= "<tr><td><strong>Phone:</strong> </td><td>" . clean_string($phone) . "</td></tr>";
		$email_message .= "<tr><td><strong>Email:</strong> </td><td>" . clean_string($email) . "</td></tr>";
		$email_message .= "<tr><td><strong>Verandah Type:</strong> </td><td>" . clean_string($verandah) . "</td></tr>";
		$email_message .= "<tr><td><strong>Message:</strong> </td><td>" . clean_string($message) . "</td></tr>";
		$email_message .= "</table>";
		$email_message .= "</body></html>";

		$headers = "From: " . $email . "\r\n";
		$headers .= "Reply-To: ". $email . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		$mail = mail(WEBMASTER_EMAIL, $subject, $email_message, $headers);

if($mail)
	{
		echo 'OK';
	}
}
else
	{
		echo '<div class="notification_error">'.$error.'</div>';
	}
}
?>