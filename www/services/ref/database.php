<?php
global $connection;

if ( isset( $connection ) )
	return;
mysqli_report(MYSQLI_REPORT_STRICT);

$connection = new mysqli("localhost", "root", "", "todo");

if (mysqli_connect_errno()) {		
	die(sprintf("Connect failed: %s\n", mysqli_connect_error()));
}
?>