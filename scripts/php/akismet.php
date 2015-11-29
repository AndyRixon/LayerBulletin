<?php
 
function akismet_check ( $vars ) {
	if ( !( _akismet_login() ) ) { return false; }
	$vars["blog"]	= $GLOBALS["akismet_home"];
	$host				= $GLOBALS["akismet_key"] . "." . $GLOBALS["akismet_host"];
	$url				= "http://$host/" . $GLOBALS["akismet_url"] 
						. "/comment-check";
	$result			= _akismet_send( $vars, $host, $url );
	if ( $result == "false" ) { return false; }
	else                      { return true;  }
}

function akismet_spam ( $vars ) {
	$vars["blog"]	= $GLOBALS["akismet_home"];
	$host				= $GLOBALS["akismet_key"] . "." . $GLOBALS["akismet_host"];
	$url				= "http://$host/" . $GLOBALS["akismet_url"] 
						. "/submit-spam";
	return _akismet_send( $vars, $host, $url );
}

function akismet_ham ( $vars ) {
	$vars["blog"]	= $GLOBALS["akismet_home"];
	$host				= $GLOBALS["akismet_key"] . "." . $GLOBALS["akismet_host"];
	$url				= "http://$host/" . $GLOBALS["akismet_url"] 
						. "/submit-ham";
	return _akismet_send( $vars, $host, $url );
}

function _akismet_login ( ) {
	$args		= array( "key"  => $GLOBALS["akismet_key"],
							"blog" => $GLOBALS["akismet_home"] );
	$host		= $GLOBALS["akismet_host"];
	$url		= "http://$host/" . $GLOBALS["akismet_url"] . "/verify-key";
	$valid	= _akismet_send( $args, $host, $url );	
	if ( $valid == 'valid' ) { return true;  }
	else                     { return false; }
}

function _akismet_send ( $args = "", $host = "", $url = "" ) {

	// All of these are mandatory
	if ( !( is_array( $args ) ) ) { return false; }
	if ( $host == "" )            { return false; }
	if ( $url  == "" )            { return false; }
	
	// The request we wish to send
	$content	= "";
	foreach ( $args as $key => $val ) {
		$content	.= "$key=" . rawurlencode( strip_slashes( $val ) ) . "&";
	}

	// The actual HTTP request
	$request	= "POST $url HTTP/1.0\r\n"
		. "Host: $host\r\n"
		. "Content-Type: application/x-www-form-urlencoded\r\n"
		. "User-Agent: " . $GLOBALS["akismet_ua"] . " | vanhegan.net-akismet.inc.php/1.0\r\n"
		. "Content-Length: " . strlen( $content ) . "\r\n\r\n"
		. "$content\r\n";
		
	$port			= 80;
	$response	= "";
	
	// Open a TCP file handle to the server, send our data
	if ( false !== ( $fh = fsockopen( $host, $port, $errno, $errstr, 3 ) ) ) {
		fwrite( $fh, $request );
		while ( !( feof( $fh ) ) ) { $response	.= fgets( $fh, 1160 ); }
		fclose( $fh );	
		// Split header and footer
		$response	= explode( "\r\n\r\n", $response, 2 );
	}
	return $response[ 1 ];
}

?>