<?php

//
define( "USER",		"ranf@anfs.de" );
define( "VERSION",	"/0.9 (2017-07-20)" );

define( "APP_NAME", 	"test" );



function curl_get( $url, $func="some", $ldebug = false ) {

$agent =	APP_NAME ." " . basename( $func, ".php" ) . VERSION;

if( $ldebug ) {
    print "HTTP user agent (GET): " . $agent . PHP_EOL;
//    exit (123);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,			$url );
curl_setopt($ch, CURLOPT_RETURNTRANSFER,	true );
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,	0 );
curl_setopt($ch, CURLOPT_USERAGENT,		$agent );
$output = curl_exec(	$ch);
$info   = curl_getinfo(	$ch);
$err    = curl_error(	$ch);
if( ! empty( $err)) {
    print "[-] error: " .$err .PHP_EOL;
}
curl_close($ch);
if( $ldebug ) {
    print "curl_get() Debug info:" . PHP_EOL;
    print_r( $info );
}

return $output;
} // func


?>