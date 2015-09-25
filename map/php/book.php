<?php
require_once("connection.php");
// Opens a connection to a MySQL server

$email = $_REQUEST['email'];
$provider_id = $_REQUEST['provider_id'];

$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

// Set the active MySQL database
$db_selected = mysql_select_db($database, $mySqlConnection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
//$query = "SELECT * FROM `providers` WHERE `status` = 'Αναμονή για πιστοποίηση...'";
$query1 = "SELECT `ID` FROM `wp_users` WHERE `user_email` = '$email'";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
}

$query2 = "SELECT `service` FROM `providers` WHERE `provider_id` = $provider_id";
$result2 = mysql_query($query2);
if (!$result2) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml encoding=UTF-8");

// Start XML file, echo parent node
echo '<users>';

// Iterate through the rows, printing XML nodes for each
while (($row1 = @mysql_fetch_assoc($result1)) && ($row2 = @mysql_fetch_assoc($result2))){
  // ADD TO XML DOCUMENT NODE
  echo '<user ';
	echo 'id="' . $row1['ID'] . '" ';
	echo 'service="' . $row2['service'] . '" ';
  echo '/>';
}

// End XML file
echo '</users>';

?>