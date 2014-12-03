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
?>


<?php
if (isset($messageSent)) {
	exit("Message sent successfully!<br/><br/> <a href='index.php' class='formButton'>Send another</a> ");
}
?>

<form method="post" id="send" name="compose">
	<table>
		<tr>
			<td>
				<fieldset>
					<legend> Recipient Email </legend>
					<input type="text" name="recipient"/>
				</fieldset>
			</td>
			<td>
			<fieldset>
				<legend> Your Name </legend>
				<input type="text" name="senderName"/>
			</fieldset>
			</td>
		</tr>
	</table>

	<fieldset>
		<legend> Message </legend> 
		<textarea name="senderBody"></textarea>
	</fieldset>

	<table>
		<tr>
			<td>
				<fieldset>
					<legend> Password </legend>
					<input type="password" name="pass"/>
				</fieldset>
			</td>
			<td>
				<fieldset>
					<legend> Password Hint <em>(Optional)</em> </legend>
					<input type="text" name="passHint"/>
				</fieldset>
			</td>
		</tr>
	</table>
	<fieldset style="text-align:right;">

<a href="javascript:document.compose.submit();" class="formButton">Send</a>
</fieldset> 

</form>

<br/>
<small style="color:#555;"> Concept & coding by <a href="http://www.codyromano.com">Cody Romano.</a> &copy; 2013 </small>
<br/><br/> 






</body>
</html>