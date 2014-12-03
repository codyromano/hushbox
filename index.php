<?php

require 'stdlib.php';

error_reporting(E_ALL);
ini_set('display_errors',1);


if (!empty($_POST)) {

	$recipient = $_POST['recipient'];
	$senderName = $_POST['senderName'];
	$body = addslashes($_POST['senderBody']);
	$password = $_POST['pass'];
	$hint = $_POST['passHint'];

	if (empty($body)  || empty($password)) {
		exit('Please fill in everything.');
	}

	if (!is_dir(DATA_FOLDER) && !mkdir(DATA_FOLDER)) {
		exit('Cannot create data folder.');
	}

	$docName = SHA1(uniqid());
	$docPassName = $docName.'_pass';
	$docPassHintName = $docName.'_hint';
	$link = 'www.codyromano.com/hushbox/read.php?m='.$docName;

	makeFile(DATA_FOLDER . $docName, $body); 
	makeFile(DATA_FOLDER . $docPassName, SHA1($password));

	if (!empty($hint)) {
		makeFile(DATA_FOLDER . $docPassHintName, htmlentities($hint));
	}

	if (!filesExist(array(DATA_FOLDER. $docName, DATA_FOLDER . $docPassName))) {
		exit("Whoops! Files could not be created successfully.");
	}

	$subject = $senderName . " sent you a secure message";

	$body = "HushBox is a free tool that lets you send password-protected, self-destructing messages. ";
	$body.= "Please keep in mind that {$senderName}'s message will delete itself "
	."after you read it: \n\n".$link . "\n\n";
	$body.="To send secure messages of your own, please visit www.codyromano.com/hushbox/";

	$headers = 'From: noreply@coastinventions.com' . "\r\n" .
    'Reply-To: noreply@coastinventions.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

	if (mail($recipient, $subject, $body, $headers)) {
		$messageSent = true; 
	}

}

include 'templates/heading.html';

if (isset($messageSent)) {
	echo "Message sent successfully!<br/><br/> <a href='index.php' class='formButton'>Send another</a> ";
} else {
	include 'templates/compose-email.html';
}

include 'templates/footing.html';

?>
