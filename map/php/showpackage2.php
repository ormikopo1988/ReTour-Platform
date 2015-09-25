<?php
require_once("connection.php");
// Opens a connection to a MySQL server

$q1 = $_REQUEST['q1'];

$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

// Set the active MySQL database
$db_selected = mysql_select_db($database, $mySqlConnection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
//$query = "SELECT * FROM `providers` WHERE `status` = 'Αναμονή για πιστοποίηση...'";
$query1 = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
$result1 = mysql_query($query1);
if (!$result1) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml encoding=UTF-8");

// Start XML file, echo parent node
echo '<packages>';

// Iterate through the rows, printing XML nodes for each
while ($row1 = @mysql_fetch_assoc($result1)){
  // ADD TO XML DOCUMENT NODE
  echo '<package ';
	echo 'hospital="' . $row1['hospital'] . '" ';
	echo 'clinic="' . $row1['clinic'] . '" ';
	echo 'rehabilitation="' . $row1['rehabilitation'] . '" ';
	echo 'hotel="' . $row1['hotel'] . '" ';
	echo 'airline="' . $row1['airline'] . '" ';
	echo 'transport="' . $row1['transport'] . '" ';
	echo 'fun="' . $row1['fun'] . '" ';
  echo '/>';
}

// End XML file
echo '</packages>';

?>