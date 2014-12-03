<?php

# 'testing' or 'production'. Errors are displayed in 'testing' mode.
define("MODE", "testing");
define("DATA_FOLDER", "../../hushBoxData/");

if ($_SERVER['HTTPS']!=='on') {
	$securePage = "https://secure.bluehost.com/~codyroma".$_SERVER["REQUEST_URI"];
	header("Location: ".$securePage);
}


function makeFile($name, $contents)
{
	if ($fh = fopen($name, 'wb')) {
		fwrite($fh, $contents); 
		fclose($fh); 
		return true; 
	}
	return false; 
}

function filesExist($files)
{
	foreach($files as $f) {
		if (!file_exists($f)) {
			return false; 
		}
	}
	return true; 
}

?>
<!doctype HTML>
<html>
<head>
	<title> HushBox </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$("input:first").focus();
	});
	</script>

<style type="text/css">
html,body,input{
	font-family:sans-serif;
}
.inputSelected{
	color:#efe;
}
input[type=text],input[type=password],textarea{
	background:#eee;
}
form{
	border:solid #123456 1px;
	display:block;
	width:75%;
	border-radius:10px;
	padding:10px 0px 10px 10px;
}
#header img{
	margin-right:5px;
	width:50px;
}
#header{
	width:600px;
}
#header * {
	vertical-align: center;
	text-align:center;
	margin:0px; padding:0px;
}
h1{ color:#123456;
	margin:1% 50px 15px 25px;
	font-size:155%;
}
h2{ color:#555;font-size:105%;
	margin:0px 0px 25px 50px;
}
fieldset{ border:none;}
legend{
	font-weight:bold;
	color:#123456;
}
input,textarea{
	border-radius:5px;
	font-size:115%;
}
.formButton{
	background:#123456;
	color:#fff;
	padding:1em;
	font-weight:bold;
	border-radius:15px;
	text-decoration:none;
	margin:10px 0px 10px 0px;
	display:inline-block;

}
input{
	border:solid #555 1px;
	padding:0.5em 0.5em 0.5em 0.5em;
}

textarea{
	width:550px;
	height:250px;
	line-height:150%;
}
body{
	width:800px;
	margin:50px auto 0px auto;
}
</style>


</head>
<body>
		<table id="header" border="0">
		<tr>
			<td style="width:10%;"> <img src="https://secure.bluehost.com/~codyroma/hushbox/message.png"/></td>
			<td style="width:20%;"> <h1> Hush Box </h1> </td>
			<td style="width:69%;text-align:right;"> <h2>Secure, self-destructing email.</h2> </td>
		</tr>
	</table>

	<br/>