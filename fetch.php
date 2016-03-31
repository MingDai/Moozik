<?php
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
$url = "https://c15519744.web.cddbp.net/webapi/json/1.0/";
if ($_GET['reg']=="1"){
	$url = $url."register?";
} else {
	$url = $url."radio/create?artist_name=".str_replace(" ", "+", $_GET['artist_name'])."&";
}
$url = $url."client=15519744-E87434BFD194B7702D673D0285756ACD";
if(isset($_GET['user'])){
	$url = $url."&user=".$_GET['user'];
}
$handle = fopen($url, "r");
if ($handle) {
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
        echo $buffer;
    }
}

fclose($handle);
?>