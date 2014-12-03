<?php

# 'testing' or 'production'. Errors are displayed in 'testing' mode.
define("MODE", "testing");
define("DATA_FOLDER", "../../hushBoxData/");
define("SECURE_DOMAIN_BASE_URI", "https://secure.bluehost.com/~codyroma");

if ($_SERVER['HTTPS']!=='on' && MODE !== 'testing') {
	$securePage = SECURE_DOMAIN_BASE_URI . $_SERVER["REQUEST_URI"];
	header("Location: " . $securePage);
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
