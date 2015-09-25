<?php
require_once("connection.php");
header('Content-Type: text/html; encoding=UTF-8');
//Pass parameters from marker click
$visitor_name = $_REQUEST['visitor_name'];
$email = $_REQUEST['email'];
$rating = $_REQUEST['rating'];
$details = $_REQUEST['details'];
$youtube = $_REQUEST['youtube'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];

//Establish Connection
$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

mysql_select_db($database);

// Perform insert
$query = "INSERT INTO visitors (visitor_id, name, email, rating, details, youtube, lat, lng) VALUES (NULL, '".$visitor_name."', '".$email."', '".$rating."', '".$details."', '".$youtube."', '".$lat."', '".$lng."')";

mysql_query($query) or die(mysql_error());

?>