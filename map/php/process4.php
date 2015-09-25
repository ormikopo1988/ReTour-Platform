<?php
	require_once("connection.php");
	
	//Pass parameters from marker click
	$type1 = $_REQUEST['type1']; //disabled
	$type2 = $_REQUEST['type2']; //cardiometabolic
	$type3 = $_REQUEST['type3']; //musculoskeletal
	$type4 = $_REQUEST['type4']; //accomodation
	$type5 = $_REQUEST['type5']; //fun
	$swLat = $_REQUEST['swLat']; //39.25938850043023
	$swLng = $_REQUEST['swLng']; //22.61548739965815
	$neLat = $_REQUEST['neLat']; //39.464839618782754
	$neLng = $_REQUEST['neLng']; //23.268830600341744

	//Establish Connection
	$mySqlConnection = @mysql_connect ($db_server, $user, $pass) or die ('Error: '.mysql_error());
	mysql_set_charset('utf8',$mySqlConnection);

	// Set the active MySQL database
	$db_selected = mysql_select_db($database, $mySqlConnection);
	if (!$db_selected) {
	  die ('Can\'t use db : ' . mysql_error());
	}

	if($type1 == "Yes" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "No" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "No" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "No" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "No" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "Yes" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "No" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "No" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "No" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "No" && $type3 == "No" && $type4 == "Yes" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "No" && $type3 == "Yes" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "No" && $type3 == "Yes" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "No" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE (amea = 'true') AND (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "No" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "Yes" && $type2 == "Yes" && $type3 == "No" && $type4 == "No" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat) AND (lng > $swLng AND lng < $neLng))";
	}

	else if ($type1 == "Yes" && $type2 == "No" && $type3 == "Yes" && $type4 == "No" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE amea = 'true' AND ((service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}


	else if ($type1 == "No" && $type2 == "No" && $type3 == "No" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng))";
	}

	else if ($type1 == "No" && $type2 == "No" && $type3 == "No" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "No" && $type3 == "Yes" && $type4 == "No" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "No" && $type4 == "No" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "Yes" && $type4 == "No" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κέντρο Αποκατάστασης' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κέντρο Αποκατάστασης' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "No" && $type4 == "Yes" && $type5 == "No") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Ξενοδοχείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Ξενοδοχείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Επιτόπια μετακίνηση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Επιτόπια μετακίνηση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}

	else if ($type1 == "No" && $type2 == "Yes" && $type3 == "No" && $type4 == "No" && $type5 == "Yes") {
		$sql = "SELECT * FROM `providers` WHERE ((service = 'Νοσοκομείο' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Νοσοκομείο' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Κλινική' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Κλινική' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) OR (service = 'Τοπική διασκέδαση' AND avg = (SELECT MAX(avg) FROM providers WHERE service = 'Τοπική διασκέδαση' AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)) AND (lat > $swLat AND lat < $neLat ) AND (lng > $swLng AND lng < $neLng)))";
	}
			
	$result = mysql_query($sql);
	if (!$result) {
	  die('Invalid query: ' . mysql_error());
	}

	header("Content-type: text/xml encoding=UTF-8");

	// Start XML file, echo parent Node
	echo '<markers>';

	// Iterate through the rows, printing XML Nodes for each
	while ($row = @mysql_fetch_assoc($result)){
	  // ADD TO XML DOCUMENT NoDE
	  echo '<marker ';
	  echo 'provider_id="' . $row['provider_id'] . '" ';
	  echo 'name="' . $row['name'] . '" ';
	  echo 'email="' . $row['email'] . '" ';
	  echo 'address="' . $row['address'] . '" ';
	  echo 'details="' . $row['details'] . '" ';
	  echo 'phone="' . $row['phone'] . '" ';
	  echo 'service="' . $row['service'] . '" ';
	  echo 'amea="' . $row['amea'] . '" ';
	  echo 'lat="' . $row['lat'] . '" ';
	  echo 'lng="' . $row['lng'] . '" ';
	  echo 'status="' . $row['status'] . '" ';
	  echo 'votes="' . $row['votes'] . '" ';
	  echo '/>';
	}

	// End XML file
	echo '</markers>';

?>