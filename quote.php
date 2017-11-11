<?php

include 'config/config.php';
	error_reporting (E_ALL ^ E_NOTICE);
	$post = (!empty($_POST)) ? true : false;
	ini_set('display_errors', 1);

if($post)
	{
		include 'config/functions.php';
		$name = stripslashes($_POST['name']);
		$email = trim($_POST['email']);
		$address = stripslashes($_POST['address']);
		$postcode = trim($_POST['postcode']);
		$home = trim($_POST['home']);
		$work = trim($_POST['work']);
		$mobile = trim($_POST['mobile']);
		$verandah = trim($_POST['verandah']);
		$message = stripslashes($_POST['message']);
		$where = stripslashes($_POST['where']);

		$error = '';

// Check name
if(!$name)
	{
		$error .= 'Please enter your name.<br />';
	}
// checke email
if($email && !ValidateEmail($email))
	{
		$error .= 'Invalid E-mail<br />';
	}
// Check address
if(!$address)
	{
		$error .= 'Please enter your site address.<br />';
	}
// Check postcode
if(!$postcode)
	{
		$error .= 'Please enter your postcode.<br />';
	}
// Check mobile
if(!$mobile)
	{
		$error .= 'Please enter your mobile.<br />';
	}
// Check verandah
if(!$verandah)
	{
		$error .= 'Please enter your product.<br />';
	}
if(!$error)
	{
		function clean_string($string) {
		  $bad = array("content-type","bcc:","to:","cc:","href");
		  return str_replace($bad,"",$string);
		}

		$subject = clean_string($name).": Website Inquiry from Innovative Verandah Website";

		// PREPARE THE BODY OF THE MESSAGE

		$email_message = '<html><body>';
		$email_message .= '<img src="http://www.innovativeverandahs.com/images/innovative-logo.jpg" /><br><br>';
		$email_message .= '<table rules="all" style="border-color: #666;" border="1" cellspacing="5" cellpadding="10">';
		$email_message .= "<tr><td><strong>Name:</strong> </td><td>" . clean_string($name) . "</td></tr>";
		$email_message .= "<tr><td><strong>Email:</strong> </td><td>" . clean_string($email) . "</td></tr>";
		$email_message .= "<tr><td><strong>Address:</strong> </td><td>" . clean_string($address) . "</td></tr>";
		$email_message .= "<tr><td><strong>Post Code:</strong> </td><td>" . clean_string($postcode) . "</td></tr>";
		$email_message .= "<tr><td><strong>Home Number:</strong> </td><td>" . clean_string($home) . "</td></tr>";
		$email_message .= "<tr><td><strong>Work Number:</strong> </td><td>" . clean_string($work) . "</td></tr>";
		$email_message .= "<tr><td><strong>Mobile Phone:</strong> </td><td>" . clean_string($mobile) . "</td></tr>";
		$email_message .= "<tr><td><strong>Type of Product:</strong> </td><td>" . clean_string($verandah) . "</td></tr>";
		$email_message .= "<tr><td><strong>Other Details / Message:</strong> </td><td>" . clean_string($message) . "</td></tr>";
		$email_message .= "<tr><td><strong>Where did you hear about Innovative Verandahs?:</strong> </td><td>" . clean_string($where) . "</td></tr>";
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