﻿<?php
require_once("connection.php");
// Opens a connection to a MySQL server
$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

// Set the active MySQL database
$db_selected = mysql_select_db($database, $mySqlConnection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM `visitors`";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

//header("Content-type: text/xml encoding=UTF-8");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'visitor_id="' . $row['visitor_id'] . '" ';
  echo 'name="' . $row['name'] . '" ';
  echo 'email="' . $row['email'] . '" ';
  echo 'details="' . $row['details'] . '" ';
  echo 'youtube="' . $row['youtube'] . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'rating="' . $row['rating'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>