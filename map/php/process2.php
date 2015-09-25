<?php
require_once("connection.php");
header('Content-Type: text/html; encoding=UTF-8');
//Pass parameters from marker click
$provider_name = $_REQUEST['provider_name'];
$email = $_REQUEST['email'];
$address = $_REQUEST['address'];
$phone = $_REQUEST['phone'];
$service = $_REQUEST['service'];
$amea = $_REQUEST['amea'];
$details = $_REQUEST['details'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$status = $_REQUEST['status'];

//Establish Connection
$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

mysql_select_db($database);

// Perform insert
$query = "INSERT INTO providers (provider_id, name, email, address, details, phone, service, amea, lat, lng, status) VALUES (NULL, '".$provider_name."', '".$email."', '".$address."', '".$details."', '".$phone."', '".$service."', '".$amea."', '".$lat."', '".$lng."', '".$status."')";

mysql_query($query) or die(mysql_error());

?>