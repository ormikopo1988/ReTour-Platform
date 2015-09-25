<?php
require_once("connection.php");
// Opens a connection to a MySQL server

$provider_id = $_REQUEST['provider_id'];
$q1 = $_REQUEST['q1'];
$q2 = $_REQUEST['q2'];
echo $q2;
$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
mysql_set_charset('utf8',$mySqlConnection);

// Set the active MySQL database
$db_selected = mysql_select_db($database, $mySqlConnection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Perform insert
if ($q2 == "Νοσοκομείο")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '".$provider_id."', '0', '0', '0', '0', '0', '0')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `hospital` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}

else if ($q2 == "Κλινική")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '0', '".$provider_id."', '0', '0', '0', '0', '0')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		echo "Test clinic";
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `clinic` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}

else if ($q2 == "Κέντρο Αποκατάστασης")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '0', '0', '".$provider_id."', '0', '0', '0', '0')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `rehabilitation` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}

else if ($q2 == "Ξενοδοχείο")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '0', '0', '0', '".$provider_id."', '0', '0', '0')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `hotel` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}

else if ($q2 == "Αεροπορική εταιρία")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '0', '0', '0', '0', '".$provider_id."', '0', '0')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `airline` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}

else if ($q2 == "Επιτόπια μετακίνηση")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '0', '0', '0', '0', '0', '".$provider_id."', '0')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `transport` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}

else if ($q2 == "Τοπική διασκέδαση")
{
	$query = "SELECT * FROM `travel_packages` WHERE `user_id` = '$q1'";
	$result = mysql_query($query) or die(mysql_error());
	if(mysql_num_rows($result) == 0) {
		$query = "INSERT INTO `travel_packages` (package_id, user_id, hospital, clinic, rehabilitation, hotel, airline, transport, fun) VALUES (NULL, '".$q1."', '0', '0', '0', '0', '0', '0', '".$provider_id."')";
		mysql_query($query) or die(mysql_error());
	} 

	else {
		$query = "UPDATE `travel_packages` SET `user_id` = '$q1', `fun` = '$provider_id' WHERE `user_id` = '$q1'";
		mysql_query($query) or die(mysql_error());
	}
}
?>