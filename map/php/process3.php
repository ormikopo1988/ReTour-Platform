<?php
require_once("connection.php");
header('Content-Type: text/html; encoding=UTF-8');
//Pass parameters from marker click
$provider_id = $_REQUEST['provider_id'];
$status = $_REQUEST['status'];
$i = 1;

//Establish Connection
$conn = mysql_connect ($db_server, $user, $pass);

if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

$sql= sprintf("UPDATE providers SET status = status + '%d', votes = votes + '%d' WHERE provider_id = %d", $status, $i, $provider_id);
		
mysql_select_db($database);

$retval = mysql_query( $sql, $conn );

if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}

$sql2= sprintf("UPDATE providers SET avg = status / votes WHERE provider_id = %d", $provider_id);
		
mysql_select_db($database);

$retval = mysql_query( $sql2, $conn );

if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}

mysql_close($conn);

?>