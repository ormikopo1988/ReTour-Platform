<?php
require_once("connection.php");
// Opens a connection to a MySQL server

$hospital = $_REQUEST['hospital'];
$clinic = $_REQUEST['clinic'];
$rehabilitation = $_REQUEST['rehabilitation'];
$hotel = $_REQUEST['hotel'];
$airline = $_REQUEST['airline'];
$transport = $_REQUEST['transport'];
$fun = $_REQUEST['fun'];

/*echo $hospital;
echo $clinic;
echo $rehabilitation;
echo $hotel;
echo $airline;
echo $transport;
echo $fun;*/

$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

// Set the active MySQL database
$db_selected = mysql_select_db($database, $mySqlConnection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
//$query = "SELECT * FROM `providers` WHERE `status` = 'Αναμονή για πιστοποίηση...'";
$query = "SELECT `name`, `email`, `address`, `phone`, `service`, `lat`, `lng` FROM `providers` WHERE ((`provider_id` = $hospital) || (`provider_id` = $clinic) || (`provider_id` = $rehabilitation) || (`provider_id` = $hotel) || (`provider_id` = $airline) || (`provider_id` = $transport) || (`provider_id` = $fun))";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml encoding=UTF-8");

// Start XML file, echo parent node
echo '<services>';
// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<service ';
	echo 'name="' . $row['name'] . '" ';
	echo 'email="' . $row['email'] . '" ';
	echo 'address="' . $row['address'] . '" ';
	echo 'phone="' . $row['phone'] . '" ';
	echo 'service="' . $row['service'] . '" ';
	echo 'lat="' . $row['lat'] . '" ';
	echo 'lng="' . $row['lng'] . '" ';
  echo '/>';
}
// End XML file
echo '</services>';
?>