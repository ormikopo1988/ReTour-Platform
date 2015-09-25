<?php
require_once("connection.php");
header('Content-Type: text/html; encoding=UTF-8');
//Pass parameters from marker click
$provider_id = $_REQUEST['provider_id'];
$details = $_REQUEST['details'];

//Establish Connection
$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

mysql_select_db($database);

// Perform insert
$query = "INSERT INTO provider_reviews (provider_id, details) VALUES ('".$provider_id."', '".$details."')";

mysql_query($query) or die(mysql_error());

?>