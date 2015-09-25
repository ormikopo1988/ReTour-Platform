<?php
require_once("php/connection.php");
function popup($vMsg,$vDestination) {
	echo("<html>\n");
	echo("<head>\n");
	echo("<script language=\"JavaScript\" type=\"text/JavaScript\">\n");
	echo("alert('$vMsg');\n");
	echo("window.location = ('$vDestination');\n");
	echo("</script>\n");
	echo("</head>\n");
	echo("</html>\n");
	exit;
}
//STEP 1 Connect To Database
$connect = mysql_connect($db_server, $user, $pass);
if (!$connect)
{
	die("MySQL could not connect!");
}

$DB = mysql_select_db($database);

if(!$DB)
{
	die("MySQL could not select Database!");
}

//STEP 2 Declare Variables

$username = mysql_real_escape_string($_REQUEST['username']);
$password = mysql_real_escape_string($_REQUEST['password']);

$query = "SELECT * FROM wp_users WHERE user_login = '".$username."' AND user_email = '".$password."'";
$result = mysql_query($query);

$row = mysql_fetch_object($result);

$NumRows = mysql_num_rows($result);

$_SESSION['user_login'] = $username;
$_SESSION['user_email'] = $password;

//STEP 3 Check to See If User Entered All Of The Information

if(empty($_SESSION['user_login']) || empty($_SESSION['user_email']))
{
	Logout();
	header("Location:LoginPage.php");
}

if($username == "" && $password == "")
{
	header("Location:LoginPage.php");
}

if($username == "")
{
	header("Location:LoginPage.php");
}

if($password == "")
{
	header("Location:LoginPage.php");
}

//STEP 4 Check Username And Password With The MySQL Database

if($NumRows != 0) {}

else if ($NumRows == 0)
{
	popup('Λάθος όνομα χρήστη/email.Προσπαθήστε ξανά!','LoginPage.php');
}

function Logout() {
   session_start();
   session_unset();
   header("Location: /map");
   return false;
   exit();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<title>ReTour Map App</title>
		<link rel="stylesheet" type="text/css" href="css/styles.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/gsearch.css">
		<link type="text/css" rel="stylesheet" href="css/places.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
		<style type="text/css">
		
			html,body {width:100%;height:100%;margin:0;padding:0;}
			
			.controls {
				margin-top: 5px;
				border: 1px solid transparent;
				border-radius: 2px 0 0 2px;
				box-sizing: border-box;
				-moz-box-sizing: border-box;
				height: 30px;
				outline: none;
				box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			}
			
			.controls2 {
				margin-top: -2px;
				border: 1px solid transparent;
				border-radius: 2px 0 0 2px;
				box-sizing: border-box;
				-moz-box-sizing: border-box;
				height: 27px;
				outline: none;
				box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			}
			
			#pac-input {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 262px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#pac-input:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 263px;
			}
			
			#dest {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 221px;
				font-family: Roboto;
				font-size: 14px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#dest:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 222px;
			}
			
			#autocomplete {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 165px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#autocomplete:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 166px;
			}
			
			#start {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 79px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#start:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 80px;
			}
			
			#end {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 88px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#end:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 89px;
			}
			
			#search3 {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 240px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#search3:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 241px;
			}
			
			#search4 {
				background-color: #fff;
				padding: 0 11px 0 13px;
				width: 238px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#search4:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 239px;
			}
			
			#tag {
				background-color: #fff;
				padding: 0px 11px 0px 13px;
				width: 300px;
				font-family: Roboto;
				font-size: 15px;
				font-weight: 300;
				text-overflow: ellipsis;
			}

			#tag:focus {
				border-color: #4d90fe;
				margin-left: -1px;
				padding-left: 14px;  /* Regular padding-left + 1. */
				width: 301px;
			}
			
			#panel {
				position: absolute;
				top: 5px;
				left: 50%;
				margin-left: -180px;
				z-index: 5;
				background-color: #fff;
				padding: 5px;
				border: 1px solid #999;
				border-radius:10px;
		    }
			
			#photo-panel {
				background: #fff;
				padding: 5px;
				overflow-y: auto;
				overflow-x: hidden;
				width: 160px;
				max-height: 160px;
				font-size: 13px;
				font-family: Arial;
				border: 1px solid #ccc;
				box-shadow: -2px 2px 2px rgba(33, 33, 33, 0.4);
				display: none;
				border-radius:10px;
			}
			
			#findhotels {
				position: absolute;
				text-align: right;
				width: 100px;
				font-size: 14px;
				padding: 4px;
				z-index: 5;
				background-color: #fff;
			}
			
			#locationField {
				
				width: 150px;
				height: 0px;
				left: 0px;
				top: 0px;
				z-index: 5;
				background-color: #fff;
			}
			
			.placeIcon {
				width: 20px;
				height: 34px;
				margin: 4px;
			}
			
			.hotelIcon {
				width: 24px;
				height: 24px;
			}
			
			#rating {
				font-size: 13px;
				font-family: Arial Unicode MS;
			}
			
			.iw_table_row {
				height: 18px;
			}
			
			.iw_attribute_name {
				font-weight: bold;
				text-align: right;
			}
			
			.iw_table_icon {
				text-align: right;
			}
			
			#rateStatus{float:left; clear:both; width:100%; height:50px;}
			#rateMe{float:left; clear:both; width:100%; height:auto; padding:0px; margin:0px;}
			#rateMe li{float:left;list-style:none;}
			#rateMe li a:hover,
			#rateMe .on{background:url(images/star_on.png) no-repeat;width:32px; height:32px;}
			#rateMe a{float:left;background:url(images/star_off.png) no-repeat;width:32px; height:32px;}
			#ratingSaved{display:none;}
			.saved{color:red; }
   
			#map-canvas
			{
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
			}
			
			#directions-panel {
				height: 40%;
				float: right;
				width: 20%;
				overflow: auto;
				background: #DCEEF4;
			}
			
			/*#tabs {
				height: 10%;
				width: 27%;
				overflow: auto;
			}
			
			#directions {
				height: 11%;
				width: 18%;
				overflow: auto;
			}
			
			#visitors {
				height: 10%;
				width: 35%;
				overflow: auto;
			}
			
			#providers {
				height: 12%;
				width: 26%;
				overflow: auto;
			}*/
			
			.ui-tabs .ui-tabs-panel {
				background: #DCEEF4;
			}
			
			.ui-tabs .ui-tabs-nav li.ui-tabs-active {
				background: #DCEEF4;
			}
			.ui-tabs .ui-tabs-nav li.ui-tabs-active a {
				background: #DCEEF4;
			}
			
			.ui-corner-top {
				background: #DCEEF4;
			}
			
			/*======= Map Styling ============*/
			.gmnoprint a, .gmnoprint span {
				display:none;
			}
			//.gmnoprint div {
				//display:none;
			//}
			#GMapsID div div a div img{
				display:none;
			}
			
			#recent_posts {
				color:white;
				/*padding:10px;
				background: rgba(0,0,0,.5);
				position:absolute;
				border-radius: 5px;
				top:70px;
				left:-420px;
				width:310px;
				height:160px;*/
				z-index:100;
				//overflow:scroll;
				padding:10px;
				background: rgba(0,0,0,.5);
				position:absolute;
				border-radius: 5px;
				top:60px;
				right:160px;
				width:245px;
				height:160px;
				display:none;
			}

			.close_box{
				background:#00AEEF;
				color:#fff;
				padding:1px 4px 1px;
				display:inline;
				position:absolute;
				right:0px;
				top:0px;
				height:20px;
				border-radius:3px;
				cursor:pointer;
				z-index:100;
				text-decoration:none;
			}
		</style>
		<script type="text/javascript"
			src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBvJFVY3P3bwTflFzlBIU6pdPQjTqGpsNQ&libraries=weather,places,panoramio&sensor=false">
		</script>
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<script type="text/javascript" language="javascript" src="js/ratingsys.js"></script> 
		<script src="http://api.webcams.travel/jsapi?devid=44b68eeb4ad4fda5d7d1458793527b66" type="text/javascript"></script>
		<script type="text/javascript" src="http://www.google.com/uds/api?file=uds.js&v=1.0&key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxQ82LsCgTSsdpNEnBsExtoeJv4cdBSUkiLH6ntmAr_5O4EfjDwOa0oZBQ"></script>
		<script src="js/markerclusterer.js" type="text/javascript"></script>
		<script type="text/javascript">
			google.maps.visualRefresh = true;
			var map;
			var markerClusterer = null;
			var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&' +
						   'chco=FFFFFF,008CFF,000000&ext=.png';
			var directionsDisplay;
			var directionsService = new google.maps.DirectionsService();
			var stepDisplay;
			var markerArray = [];
			var places;
			var markers = [];
			var countryRestrict = { 'country': 'gr' };
			var MARKER_PATH = 'https://maps.gstatic.com/intl/en_us/mapfiles/marker_green';
			var hostnameRegexp = new RegExp('^https?://.+?/');
			
			var countries = {
				'gr': {
					center: new google.maps.LatLng(39.24528, 23.2144),
					zoom: 8
				}
			};

			
			var weatherLayer = new google.maps.weather.WeatherLayer({
				temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
			});
			var cloudsLayer = new google.maps.weather.CloudLayer();
			var georssLayer = new google.maps.KmlLayer({
				//url: 'http://api.flickr.com/services/feeds/geo/?g=1416694@N22' //visitgreece
				url: 'http://api.flickr.com/services/feeds/geo/?g=2403053@N25'
			});
			var infowindow = new google.maps.InfoWindow();
			var elevator;
			var InfoWindow = new google.maps.InfoWindow();
			var home = new google.maps.LatLng(39.24528, 23.2144);
			var panoramioLayer = new google.maps.panoramio.PanoramioLayer();
			
			var gLocalSearch;
			var gInfoWindow;
			var details = [];
			var gSelectedResults = [];
			var gCurrentResults = [];
			var gSearchForm;

			// Create our "tiny" marker icon
			var gYellowIcon = new google.maps.MarkerImage(
				"http://labs.google.com/ridefinder/images/mm_20_yellow.png",
				new google.maps.Size(12, 20),
				new google.maps.Point(0, 0),
				new google.maps.Point(6, 20));
			var gRedIcon = new google.maps.MarkerImage(
				"http://labs.google.com/ridefinder/images/mm_20_red.png",
				new google.maps.Size(12, 20),
				new google.maps.Point(0, 0),
				new google.maps.Point(6, 20));
			var gSmallShadow = new google.maps.MarkerImage(
				"http://labs.google.com/ridefinder/images/mm_20_shadow.png",
				new google.maps.Size(22, 20),
				new google.maps.Point(0, 0),
				new google.maps.Point(6, 20));

			// Define a property to hold the Home state
			HomeControl.prototype.home_ = null;

			// Define setters and getters for this property
			HomeControl.prototype.getHome = function() {
				return this.home_;
			}

			HomeControl.prototype.setHome = function(home) {
				this.home_ = home;
			}


			function HomeControl(controlDiv, map, home) 
			{
				// We set up a variable for this since we're adding
				// event listeners later.
				var control = this;

				// Set the home property upon construction
				control.home_ = home;

				// Set CSS styles for the DIV containing the control
				// Setting padding to 5 px will offset the control
				// from the edge of the map
				controlDiv.style.padding = '5px';

				// Set CSS for the control border
				var goHomeUI = document.createElement('div');
				goHomeUI.style.backgroundColor = 'white';
				goHomeUI.style.borderStyle = 'solid';
				goHomeUI.style.borderWidth = '2px';
				goHomeUI.style.cursor = 'pointer';
				goHomeUI.style.textAlign = 'center';
				goHomeUI.title = 'Click to set the map to Home';
				controlDiv.appendChild(goHomeUI);

				// Set CSS for the control interior
				var goHomeText = document.createElement('div');
				goHomeText.style.fontFamily = 'Arial,sans-serif';
				goHomeText.style.fontSize = '12px';
				goHomeText.style.paddingLeft = '4px';
				goHomeText.style.paddingRight = '4px';
				goHomeText.innerHTML = '<b>Home</b>';
				goHomeUI.appendChild(goHomeText);

				// Set CSS for the setHome control border
				var setHomeUI = document.createElement('div');
				setHomeUI.style.backgroundColor = 'white';
				setHomeUI.style.borderStyle = 'solid';
				setHomeUI.style.borderWidth = '2px';
				setHomeUI.style.cursor = 'pointer';
				setHomeUI.style.textAlign = 'center';
				setHomeUI.title = 'Click to set Home to the current center';
				controlDiv.appendChild(setHomeUI);

				// Set CSS for the control interior
				var setHomeText = document.createElement('div');
				setHomeText.style.fontFamily = 'Arial,sans-serif';
				setHomeText.style.fontSize = '12px';
				setHomeText.style.paddingLeft = '4px';
				setHomeText.style.paddingRight = '4px';
				setHomeText.innerHTML = '<b>Set Home</b>';
				setHomeUI.appendChild(setHomeText);

				// Setup the click event listener for Home:
				// simply set the map to the control's current home property.
				google.maps.event.addDomListener(goHomeUI, 'click', function() {
					var currentHome = control.getHome();
					map.setCenter(currentHome);
					map.setZoom(8);
				});

				// Setup the click event listener for Set Home:
				// Set the control's home to the current Map center.
				google.maps.event.addDomListener(setHomeUI, 'click', function() {
					var newHome = map.getCenter();
					control.setHome(newHome);
					//map.setZoom(8);
				});
			}
			
			function initialize() {
			
				var mapOptions = {
					center: new google.maps.LatLng(39.24528, 23.2144),
					zoom: 8,
					//minZoom: 8,
					//maxZoom: 10,
					panControl: true,
					panControlOptions: {
						position: google.maps.ControlPosition.LEFT_CENTER
					},
					zoomControl: true,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.LEFT_CENTER
					},
					scaleControl: false,
					mapTypeControl: true,
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
						mapTypeIds: ['coordinate', google.maps.MapTypeId.ROADMAP],
					},
					streetViewControl: true,
					streetViewControlOptions: {
						position: google.maps.ControlPosition.LEFT_CENTER
					},
					overviewMapControl: true
				};
				map = new google.maps.Map(document.getElementById("map-canvas"),
					mapOptions);
				
				// Create a renderer for directions and bind it to the map.
				var rendererOptions = {
					map: map,
					draggable: true
				}

				directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
				directionsDisplay.setPanel(document.getElementById('directions-panel'));
				
				google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
					computeTotalDistance(directionsDisplay.getDirections());
				});

				
				// Instantiate an info window to hold step text.
				stepDisplay = new google.maps.InfoWindow();

				var input = /** @type {HTMLInputElement} */(
				document.getElementById('tabs'));
				map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
				
				var input = /** @type {HTMLInputElement} */(
				document.getElementById('directions-panel'));
				map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(input);
				
				var input = /** @type {HTMLInputElement} */(
				document.getElementById('cart'));
				map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
				
				var input = /** @type {HTMLInputElement} */(
				document.getElementById('first_buttons'));
				map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
				
				var input = /** @type {HTMLInputElement} */(
				document.getElementById('providers'));
				map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(input);
				
				var input = /** @type {HTMLInputElement} */(
				document.getElementById('visitors'));
				map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(input);
				
				var input = /** @type {HTMLInputElement} */(
				document.getElementById('first_search'));
				map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
				
				
					
				gInfoWindow = new google.maps.InfoWindow;
				google.maps.event.addListener(gInfoWindow, 'closeclick', function() {
					unselectMarkers();
				});
				
				// Initialize the local searcher
				gLocalSearch = new GlocalSearch();
				gLocalSearch.setSearchCompleteCallback(null, OnLocalSearch);

				infoWindow = new google.maps.InfoWindow({
					content: document.getElementById('info-content'),
					maxWidth: 500
				});

				// Create the autocomplete object and associate it with the UI input control.
				// Restrict the search to the default country, and to place type "cities".
				autocomplete = new google.maps.places.Autocomplete(
					/** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
					{
						types: ['(cities)'],
						componentRestrictions: countryRestrict
					}
				);
				places = new google.maps.places.PlacesService(map);

				google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);

				// Add a DOM event listener to react when the user selects a country.
				google.maps.event.addDomListener(document.getElementById('country'), 'change',
				setAutocompleteCountry);
								
				// Create the DIV to hold the control and
				// call the HomeControl() constructor passing
				// in this DIV.
				var homeControlDiv = document.createElement('div');
				var homeControl = new HomeControl(homeControlDiv, map, home);

				homeControlDiv.index = 1;
				map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
				
				//weatherLayer.setMap(map);
				//cloudsLayer.setMap(map);
				
				$('#webcam_box').click(function(){
					if ($(this).is(':checked'))
						webcamstravel.easymap.load(map);
					else 
						webcamstravel.easymap.unload();
				});
				
				$('#webcam_box').removeAttr('disabled');

				$('#flickr_box').click(function(){
					georssLayer.setMap($(this).is(':checked') ? map : null);
				});
				
				$('#flickr_box').removeAttr('disabled');
				
				$('#weather_box').click(function(){
					weatherLayer.setMap($(this).is(':checked') ? map : null);
					cloudsLayer.setMap($(this).is(':checked') ? map : null);
				});

				$('#weather_box').removeAttr('disabled');
				
				$('#elevator_box').click(function(){
					if($(this).is(':checked')) {
						map.setMapTypeId(google.maps.MapTypeId.TERRAIN);
						alert("Right click on the map where you want to see the elevation of the area!");
						elevator = new google.maps.ElevationService();

						// Add a listener for the click event and call getElevation on that location
						var listener = google.maps.event.addListener(map, 'rightclick', getElevation);
						google.maps.event.addListener(map, 'click', function() {
							infowindow.close();
						});
					}
					
					else {
						map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
						infowindow.close();
						google.maps.event.removeListener(listener);
					}
				});
				
				$('#elevator_box').removeAttr('disabled');
				  
				$('#panoramio_box').click(function(){
					panoramioLayer.setMap($(this).is(':checked') ? map : null);
					if($(this).is(':checked')) {
						jQuery('#filter').show();
						jQuery('#photo-panel').show();
					}
					else {
						jQuery('#filter').hide();
						jQuery('#photo-panel').hide();
					}
				});

				$('#panoramio_box').removeAttr('disabled');
				
				$('#visitor_box').click(function(){
					if($(this).is(':checked')) {
						//alert("You can post your own travel review by finding the place you visited and double click on the map!");
						load1();
						InfoWindow.close();
					}
					else {
						test1();
					}
				});

				$('#visitor_box').removeAttr('disabled');
				
				$('#service_box').click(function(){
					if($(this).is(':checked')) {
						//alert("You can post your own travel service by finding the place of your service and double click on the map!");
						load2();
						InfoWindow.close();
					}
					else {
						test1();
					}
				});

				$('#service_box').removeAttr('disabled');
				
				$('#hospital_box').click(function(){
					if($(this).is(':checked')) {
						load3();
					}
					else {
						test3();
					}
				});

				$('#hospital_box').removeAttr('disabled');
				
				$('#clinic_box').click(function(){
					if($(this).is(':checked')) {
						load4();
					}
					else {
						test4();
					}
				});

				$('#clinic_box').removeAttr('disabled');
				
				$('#center_box').click(function(){
					if($(this).is(':checked')) {
						load5();
					}
					else {
						test5();
					}
				});

				$('#center_box').removeAttr('disabled');
				
				$('#hotel_box').click(function(){
					if($(this).is(':checked')) {
						load6();
					}
					else {
						test6();
					}
				});

				$('#hotel_box').removeAttr('disabled');
				
				$('#airport_box').click(function(){
					if($(this).is(':checked')) {
						load7();
					}
					else {
						test7();
					}
				});

				$('#airport_box').removeAttr('disabled');
				
				$('#transport_box').click(function(){
					if($(this).is(':checked')) {
						load8();
					}
					else {
						test8();
					}
				});

				$('#transport_box').removeAttr('disabled');
				
				$('#fun_box').click(function(){
					if($(this).is(':checked')) {
						load9();
					}
					else {
						test9();
					}
				});

				$('#fun_box').removeAttr('disabled');

				var tag = document.getElementById('tag');
				var button = document.getElementById('filter-button');

				google.maps.event.addDomListener(button, 'click', function() {
					panoramioLayer.setTag(tag.value);
				});
				
				var filter = document.getElementById('filter');
				map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(filter);
				filter.style.bottom = "3px";
				jQuery('#filter').hide();
				jQuery('#tabs').hide();
				jQuery('#directions').hide();
				//jQuery('#queryInput').hide();
				//$( "#tabs" ).tabs( "option", "hide", { effect: "explode", duration: 1000 } );
				
				var photoPanel = document.getElementById('photo-panel');
				map.controls[google.maps.ControlPosition.RIGHT_TOP].push(photoPanel);

				google.maps.event.addListener(panoramioLayer, 'click', function(photo) {
					var li = document.createElement('li');
					var link = document.createElement('a');
					link.innerHTML = photo.featureDetails.title + ': ' +
					photo.featureDetails.author;
					link.setAttribute('href', photo.featureDetails.url);
					link.setAttribute('target', '_blank');
					li.appendChild(link);
					photoPanel.appendChild(li);
					photoPanel.style.display = 'block';
					photoPanel.style.top = "48px";
				});
				
				$('#weather_box').prop('checked', false);
				$('#elevator_box').prop('checked', false);
				$('#panoramio_box').prop('checked', false);
				$('#visitor_box').prop('checked', false);
				$('#service_box').prop('checked', false);
				$('#hospital_box').prop('checked', false);
				$('#clinic_box').prop('checked', false);
				$('#center_box').prop('checked', false);
				$('#hotel_box').prop('checked', false);
				$('#airport_box').prop('checked', false);
				$('#transport_box').prop('checked', false);
				$('#fun_box').prop('checked', false);
				$('#flickr_box').prop('checked', false);
				$('#webcam_box').prop('checked', false);
				jQuery('#info-content').hide();
				jQuery('#controls').hide();
				jQuery("#autocomplete").clearForm().clearFields().resetForm();
				jQuery("#pac-input").clearForm().clearFields().resetForm();
				jQuery("#tag").clearForm().clearFields().resetForm();
				jQuery('#listing').hide();
				jQuery('#providers').hide();
				jQuery('#visitors').hide();
				jQuery('#cart').hide();
				jQuery('#first_search').hide();
				jQuery('#first_search2').hide();
				jQuery("#search2").clearForm().clearFields().resetForm();
				jQuery("#search10").clearForm().clearFields().resetForm();
				jQuery("#start").clearForm().clearFields().resetForm();
				jQuery("#end").clearForm().clearFields().resetForm();
				jQuery("#mode").clearForm().clearFields().resetForm();
				jQuery("#detailed_form").clearForm().clearFields().resetForm();
				jQuery("#mode").val('sel3');
				jQuery('#directions-panel').hide();
				jQuery('#photo-panel').hide();
				jQuery('#recent_posts').hide();
				
				$('#weather_box').hide();
				$('#panoramio_box').hide();
			}
			
			function calcRoute() {
				// First, remove any existing markers from the map.
				for (var i = 0; i < markerArray.length; i++) {
					markerArray[i].setMap(null);
				}
				
				// Now, clear the array itself.
				markerArray = [];

				directionsDisplay.setMap(map);
				var start = document.getElementById("start").value;
				var end = document.getElementById("end").value;
				var selectedMode = document.getElementById("mode").value;
				
				var request = {
					origin: start,
					destination: end,
					// Note that Javascript allows us to access the constant
					// using square brackets and a string value as its
					// "property."
					travelMode: google.maps.TravelMode[selectedMode]
				};
				
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						var warnings = document.getElementById('warnings_panel');
						warnings.innerHTML = '<b>' + response.routes[0].warnings + '</b>';
						directionsDisplay.setDirections(response);
						showSteps(response);
						jQuery('#directions-panel').show();
					}
				});
			}
			
			function computeTotalDistance(result) {
				var total = 0;
				var myroute = result.routes[0];
				for (var i = 0; i < myroute.legs.length; i++) {
					total += myroute.legs[i].distance.value;
				}
				total = total / 1000.0;
				document.getElementById('total').innerHTML = total + ' km';
			}

			
			function showSteps(directionResult) {
				// For each step, place a marker, and add the text to the marker's
				// info window. Also attach the marker to an array so we
				// can keep track of it and remove it when calculating new
				// routes.
				var myRoute = directionResult.routes[0].legs[0];

				for (var i = 0; i < myRoute.steps.length; i++) {
					var marker = new google.maps.Marker({
						position: myRoute.steps[i].start_location,
						map: map
					});
					attachInstructionText(marker, myRoute.steps[i].instructions);
					markerArray[i] = marker;
				}
			}

			function attachInstructionText(marker, text) {
				google.maps.event.addListener(marker, 'click', function() {
					// Open an info window when the marker is clicked on,
					// containing the text of the step.
					stepDisplay.setContent(text);
					stepDisplay.open(map, marker);
				});
			}

			function resetRoute() {
				directionsDisplay.setMap(null);
				jQuery("#start").clearForm().clearFields().resetForm();
				jQuery("#end").clearForm().clearFields().resetForm();
				//jQuery("#mode").clearForm().clearFields().resetForm();
				jQuery("#mode").val('sel3');
				jQuery('#directions-panel').hide();
				for (var i = 0; i < markerArray.length; i++) {
					markerArray[i].setMap(null);
				}
				
				// Now, clear the array itself.
				markerArray = [];
			}
			
			function getElevation(event) {

				var locations = [];

				// Retrieve the clicked location and push it on the array
				var clickedLocation = event.latLng;
				locations.push(clickedLocation);

				// Create a LocationElevationRequest object using the array's one value
				var positionalRequest = {
					'locations': locations
				}

				// Initiate the location request
				elevator.getElevationForLocations(positionalRequest, function(results, status) {
					if (status == google.maps.ElevationStatus.OK) {

						// Retrieve the first result
						if (results[0]) {

							// Open an info window indicating the elevation at the clicked position
							infowindow.setContent('The elevation on this area <br>is ' + results[0].elevation + ' meters.');
							infowindow.setPosition(clickedLocation);
							infowindow.open(map);
						} 
						else {
							alert('No results found');
						}
					} else {
						alert('Elevation service failed due to: ' + status);
					}
				});
			}
			
			// When the user selects a city, get the place details for the city and
			// zoom the map in on the city.
			function onPlaceChanged() {
				var place = autocomplete.getPlace();
				if (place.geometry) {
					map.panTo(place.geometry.location);
					map.setZoom(15);
					search();
				} 
				else {
					document.getElementById('autocomplete').placeholder = 'Enter a city...';
				}

			}
			
			// Search for hotels in the selected city, within the viewport of the map.
			function search() {
				var search = {
					bounds: map.getBounds(),
					types: ['lodging']
				};

				places.nearbySearch(search, function(results, status) {
					if (status == google.maps.places.PlacesServiceStatus.OK) {
						clearResults();
						clearMarkers();
						// Create a marker for each hotel found, and
						// assign a letter of the alphabetic to each marker icon.
						for (var i = 0; i < results.length; i++) {
							var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
							var markerIcon = MARKER_PATH + markerLetter + '.png';
							// Use marker animation to drop the icons incrementally on the map.
							markers[i] = new google.maps.Marker({
								position: results[i].geometry.location,
								animation: google.maps.Animation.DROP,
								icon: markerIcon
							});
							// If the user clicks a hotel marker, show the details of that hotel
							// in an info window.
							markers[i].placeResult = results[i];
							google.maps.event.addListener(markers[i], 'click', showInfoWindow);
							google.maps.event.addListener(markers[i], 'click', showInfoContent);
							setTimeout(dropMarker(i), i * 100);
							addResult(results[i], i);
						}
					}
				});
			}
			
			function clearMarkers() {
				for (var i = 0; i < markers.length; i++) {
					if (markers[i]) {
						markers[i].setMap(null);
					}
				}
				markers = [];
			}
			
			function resetMarkers() {
				for (var i = 0; i < markers.length; i++) {
					if (markers[i]) {
						markers[i].setMap(null);
					}
				}
				markers = [];
				jQuery('#listing').hide();
				jQuery("#autocomplete").clearForm().clearFields().resetForm();
			}
			
			// The START and END in square brackets define a snippet for our documentation:
			// Set the country restriction based on user input.
			// Also center and zoom the map on the given country.
			function setAutocompleteCountry() {
				var country = document.getElementById('country').value;
				autocomplete.setComponentRestrictions({ 'country': country });
				map.setCenter(countries[country].center);
				map.setZoom(countries[country].zoom);
				clearResults();
				clearMarkers();
			}
			
			function dropMarker(i) {
				return function() {
					markers[i].setMap(map);
				};
			}
			
			function addResult(result, i) {
				var results = document.getElementById('results');
				var markerLetter = String.fromCharCode('A'.charCodeAt(0) + i);
				var markerIcon = MARKER_PATH + markerLetter + '.png';

				var tr = document.createElement('tr');
				tr.style.backgroundColor = (i % 2 == 0 ? '#F0F0F0' : '#FFFFFF');
				tr.onclick = function() {
					google.maps.event.trigger(markers[i], 'click');
				};

				var iconTd = document.createElement('td');
				var nameTd = document.createElement('td');
				var icon = document.createElement('img');
				icon.src = markerIcon;
				icon.setAttribute('class', 'placeIcon');
				icon.setAttribute('className', 'placeIcon');
				var name = document.createTextNode(result.name);
				iconTd.appendChild(icon);
				nameTd.appendChild(name);
				tr.appendChild(iconTd);
				tr.appendChild(nameTd);
				results.appendChild(tr);
			}
			
			function clearResults() {
				var results = document.getElementById('results');
				while (results.childNodes[0]) {
					results.removeChild(results.childNodes[0]);
				}
			}
			
			// Get the place details for a hotel. Show the information in an info window,
			// anchored on the marker for the hotel that the user selected.
			function showInfoWindow() {
				var marker = this;
				places.getDetails({reference: marker.placeResult.reference},
				function(place, status) {
					if (status != google.maps.places.PlacesServiceStatus.OK) {
						return;
					}
					infoWindow.open(map, marker);
					google.maps.event.addListener(map,"click", function() {
						infoWindow.close();
					});
					buildIWContent(place);
				});
			}
			
			function showInfoContent() {
				jQuery('#info-content').show();
			}
			
			// Load the place information into the HTML elements used by the info window.
			function buildIWContent(place) {
				document.getElementById('iw-icon').innerHTML = '<img class="hotelIcon" ' +
				'src="' + place.icon + '"/>';
				document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
				'" target="_blank">' + place.name + '</a></b>';
				document.getElementById('iw-address').textContent = place.vicinity;

				if (place.formatted_phone_number) {
					document.getElementById('iw-phone-row').style.display = '';
					document.getElementById('iw-phone').textContent =
					place.formatted_phone_number;
				} 
				
				else {
					document.getElementById('iw-phone-row').style.display = 'none';
				}

				// Assign a five-star rating to the hotel, using a black star ('&#10029;')
				// to indicate the rating the hotel has earned, and a white star ('&#10025;')
				// for the rating points not achieved.
				if (place.rating) {
					var ratingHtml = '';
					for (var i = 0; i < 5; i++) {
						if (place.rating < (i + 0.5)) {
							ratingHtml += '&#10025;';
						} 
						
						else {
							ratingHtml += '&#10029;';
						}
						document.getElementById('iw-rating-row').style.display = '';
						document.getElementById('iw-rating').innerHTML = ratingHtml;
					}
				} 
				
				else {
					document.getElementById('iw-rating-row').style.display = 'none';
				}

				// The regexp isolates the first part of the URL (domain plus subdomain)
				// to give a short URL for displaying in the info window.
				if (place.website) {
					var fullUrl = place.website;
					var website = hostnameRegexp.exec(place.website);
					if (website == null) {
						website = 'http://' + place.website + '/';
						fullUrl = website;
					}
					document.getElementById('iw-website-row').style.display = '';
					document.getElementById('iw-website').textContent = website;
				} 
				
				else {
					document.getElementById('iw-website-row').style.display = 'none';
				}
			}
			
			function unselectMarkers() {
				for (var i = 0; i < gCurrentResults.length; i++) {
					gCurrentResults[i].unselect();
				}
			}
			
			function doSearch() {
				var query = document.getElementById("pac-input").value;
				if (query != "") {
					gLocalSearch.setCenterPoint(map.getCenter());
					gLocalSearch.execute(query);
				}
				
				else {
					for (var i = 0; i < gCurrentResults.length; i++) {
						gCurrentResults[i].marker().setMap(null);
					}
					// Close the infowindow
					gInfoWindow.close();
				}
			}
			
			function clearLocal() {
				for (var i = 0; i < gCurrentResults.length; i++) {
					gCurrentResults[i].marker().setMap(null);
				}
				// Close the infowindow
				gInfoWindow.close();
				jQuery("#pac-input").clearForm().clearFields().resetForm();
			}
			
			// Called when Local Search results are returned, we clear the old
			// results and load the new ones.
			function OnLocalSearch() {
				if (!gLocalSearch.results) return;
			
				for (var i = 0; i < gCurrentResults.length; i++) {
					gCurrentResults[i].marker().setMap(null);
				}
				// Close the infowindow
				gInfoWindow.close();

				gCurrentResults = [];
				for (var i = 0; i < gLocalSearch.results.length; i++) {
					gCurrentResults.push(new LocalResult(gLocalSearch.results[i]));
				}

				var attribution = gLocalSearch.getAttribution();

				// Move the map to the first result
				var first = gLocalSearch.results[0];
				map.setCenter(new google.maps.LatLng(parseFloat(first.lat),
													parseFloat(first.lng)));
			}
			
			// Cancel the form submission, executing an AJAX Search API search.
			function CaptureForm(searchForm) {
				gLocalSearch.execute(searchForm.input.value);
				return false;
			}
			
			// A class representing a single Local Search result returned by the
			// Google AJAX Search API.
			function LocalResult(result) {
				var me = this;
				me.result_ = result;
				me.resultNode_ = me.node();
				me.marker_ = me.marker();
				google.maps.event.addDomListener(me.resultNode_, 'mouseover', function() {
					// Highlight the marker and result icon when the result is
					// mouseovered.  Do not remove any other highlighting at this time.
					me.highlight(true);
				});
				google.maps.event.addDomListener(me.resultNode_, 'mouseout', function() {
					// Remove highlighting unless this marker is selected (the info
					// window is open).
					if (!me.selected_) me.highlight(false);
				});
				google.maps.event.addDomListener(me.resultNode_, 'click', function() {
					me.select();
				});
			}
			
			LocalResult.prototype.node = function() {
				if (this.resultNode_) return this.resultNode_;
				return this.html();
			};
			
			// Returns the map marker for this result, creating it with the given
			// icon if it has not already been created.
			LocalResult.prototype.marker = function() {
				var me = this;
				if (me.marker_) return me.marker_;
				var marker = me.marker_ = new google.maps.Marker({
					position: new google.maps.LatLng(parseFloat(me.result_.lat),
													 parseFloat(me.result_.lng)),
					icon: gYellowIcon, shadow: gSmallShadow, map: map
				});
				google.maps.event.addListener(marker, "click", function() {
					me.select();
				});
				return marker;
			};
			
			// Unselect any selected markers and then highlight this result and
			// display the info window on it.
			LocalResult.prototype.select = function() {
				unselectMarkers();
				this.selected_ = true;
				this.highlight(true);
				gInfoWindow.setContent(this.html(true));
				gInfoWindow.open(map, this.marker());
			};
			
			LocalResult.prototype.isSelected = function() {
				return this.selected_;
			};
			
			// Remove any highlighting on this result.
			LocalResult.prototype.unselect = function() {
				this.selected_ = false;
				this.highlight(false);
			};
			
			// Returns the HTML we display for a result before it has been "saved"
			LocalResult.prototype.html = function() {
				var me = this;
				var container = document.createElement("div");
				container.className = "unselected";
				container.appendChild(me.result_.html.cloneNode(true));
				return container;
			}
			
			LocalResult.prototype.highlight = function(highlight) {
				this.marker().setOptions({icon: highlight ? gRedIcon : gYellowIcon});
				this.node().className = "unselected" + (highlight ? " red" : "");
			}

			GSearch.setOnLoadCallback(initialize);
			
			google.maps.event.addDomListener(window, 'load', initialize);
			google.maps.event.addDomListener(window, "resize", function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center); 
			});
		</script>
	</head>
	<body>
		<br>
		<div id="first_buttons" style="padding-top:10px;">
			<span style="margin-left:0px">
				<a class="option1" id="target1" href="javascript:void(0);" onclick="this.style.color='black';target2.style.color='white';">Traveler</a>
				<span style="margin-left:12px">
					<a class="option2" id="target2" href="javascript:void(0);" onclick="this.style.color='black';target1.style.color='white';">Provider</a>
				</span>
			</span>
		</div>
		<div id="cart">
			<input type="submit" value="" title="View your travel cart" id="cart_button"
			style="font-family:sans-serif; font-size:12pt;
			font-weight:bold; background-image:url('images/cart.png'); none; color:white; width:4.10em; height:4.10em; border-radius: 40px;">
			</SUBMIT>
		</div>
		<div id="recent_posts" style="display: block;">
			<a href="#" class="close_box" id="close_recent_posts_div">close </a>
			<span>
				<form id="visitor_details" method="post">
					<b>Your ReTour login email</b><br>
					<input type="text" name="l_email"/><br><br>
					<input type="submit" onclick="showpackage(); return false" value="Show my package">
				</form>
			</span>
		</div>
		<br>
		<div id="filter" style="bottom:3px;">
			<input class="controls" id="tag" placeholder="Images based on keywords (e.g Greece)...">
			<input type="button" id="filter-button" value="Filter">
		</div>
		<div id="photo-panel">
			<ul>
				<li><strong>Images clicked</strong></li>
			</ul>
		</div>
		
		<div id="map-canvas"></div>
		
		<div id="listing">
			<table id="resultsTable">
				<tbody id="results"></tbody>
			</table>
		</div>

		<div id="info-content">
			<table>
				<tr id="iw-url-row" class="iw_table_row">
					<td id="iw-icon" class="iw_table_icon"></td>
					<td id="iw-url"></td>
				</tr>
				<tr id="iw-address-row" class="iw_table_row">
					<td class="iw_attribute_name">Address:</td>
					<td id="iw-address"></td>
				</tr>
				<tr id="iw-phone-row" class="iw_table_row">
					<td class="iw_attribute_name">Phone:</td>
					<td id="iw-phone"></td>
				</tr>
				<tr id="iw-rating-row" class="iw_table_row">
					<td class="iw_attribute_name">Rating:</td>
					<td id="iw-rating"></td>
				</tr>
				<tr id="iw-website-row" class="iw_table_row">
					<td class="iw_attribute_name">Website:</td>
					<td id="iw-website"></td>
				</tr>
			</table>
		</div>
		<br>
		<div id="visitors">
			<div class="fbplbadge2"></div>
			<table style="background:#DCEEF4" border="1" cellpadding="7">
				<tbody>
					<tr>
						<td align="center">
							<form id="detailed_form" method="post" action="php/process4.php">
								<input class="controls2" type="text" id="dest" name="dest" placeholder="Insert or zoom on destination..."/> 
								<select name="type1">
									<option selected value="1">-Disabled-</option>
									<option value="Yes">Dis.->Yes
									<option value="No">Dis.->No
								</select>
								<select name="type2">
									<option selected value="2">-Cardiometabolic/Renal-</option>
									<option value="Yes">Card./Ren.->Yes
									<option value="No">Card./Ren.->No
								</select><br>
								<select name="type3">
									<option selected value="3">-Musculoskeletal-</option>
									<option value="Yes">Musc.->Yes
									<option value="No">Musc.->No
								</select>
								<select name="type4">
									<option selected value="4">-Αccommodation/Transport-</option>
									<option value="Yes">Αcc./Trans.->Yes
									<option value="No">Αcc./Trans.->No
								</select>
								<select name="type5">
									<option selected value="5">-Fun-</option>
									<option value="Yes">Fun->Yes
									<option value="No">Fun->No
								</select>
								<div align="center">
									<button type="button" name="submit" onclick="detailed(dest.value, type1.value, type2.value, type3.value); return false">Show me the best travel package</button>
								</div>
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<label><input type="checkbox" id="hospital_box" disabled="true">Hospitals</label>
							<label><input type="checkbox" id="clinic_box" disabled="true">Clinics</label>
							<label><input type="checkbox" id="center_box" disabled="true">Rehabilitation centers</label>
							<label><input type="checkbox" id="hotel_box" disabled="true">Hotels</label>
							<label><input type="checkbox" id="airport_box" disabled="true">Airlines</label>
							<label><input type="checkbox" id="transport_box" disabled="true">Transport</label>
							<label><input type="checkbox" id="fun_box" disabled="true">Fun</label>
						</td>
					</tr>
					<tr>
						<td align="center" colspan="2">
							<label><input type="checkbox" id="weather_box" disabled="true"></label>
							<label><input type="checkbox" id="elevator_box" disabled="true">Elevation</label>
							<label><input type="checkbox" id="panoramio_box" disabled="true"></label>
							<label><input type="checkbox" id="flickr_box" disabled="true">Visitor photos & videos</label>
							<label><input type="checkbox" id="webcam_box" disabled="true">Webcams</label>
							<label><input type="checkbox" id="visitor_box" disabled="true">Travel reviews</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div id="controls">
			<select id="country">
				<option value="gr">Ελλάδα</option>
			</select>
		</div>
		
		<div id="providers">
			<div class="fbplbadge4"></div>
			<table style="background:#DCEEF4" border="1" cellpadding="10">
				<tbody>
					<tr>
						<td align="center" colspan="2">
							<div id="first_search2">
								<form id="search10" onsubmit="showAddress2(); return false" action="#">
									<input class="controls" id="search4" size="40" type="text" value="" placeholder="Search for an area on the map...">
									<input type="submit" style="font-family:sans-serif; font-size:10pt; font-weight:bold; background-image:url('images/fakos2.gif'); none; color:white; width:1.3em" value="" title="Ψάξε">
								</form>
							</div>
						</td>
					</tr>
					<tr>
						<td align="center">
							<label><input type="checkbox" id="service_box" disabled="true">Show existing declared services</label>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div id="first_search">
			<form id="search2" onsubmit="showAddress1(); return false" action="#">
				<input class="controls" id="search3" size="40" type="text" value="" placeholder="Search for an area on the map...">
				<input type="submit" style="font-family:sans-serif; font-size:10pt; font-weight:bold; background-image:url('images/fakos2.gif'); none; color:white; width:1.3em" value="" title="Search">
			</form>
		</div>
		
		<div id="tabs">
			<div class="fbplbadge"></div>
			<ul>
				<li><a href="#fragment-1"><span>Areas</span></a></li>
				<li><a href="#fragment-2"><span>Directions</span></a></li>
				<li><a href="#fragment-3"><span>Hotels not credited by us</span></a></li>
				<li><a href="#fragment-4"><span>Flights</span></a></li>
			</ul>
			<div align="center" id="fragment-1">
				<div id="first_search">
					<form id="search2" onsubmit="showAddress1(); return false" action="#">
						<input class="controls" id="search3" size="40" type="text" value="" placeholder="Search for an area on the map...">
						<input type="submit" style="font-family:sans-serif; font-size:10pt; font-weight:bold; background-image:url('images/fakos2.gif'); none; color:white; width:1.3em" value="" title="Search">
					</form>
				</div>
			</div>
			<div align="center" id="fragment-2">
				<table cellpadding="5" border="1" style="background:none">
					<tbody>
						<tr><td align="center"><input placeholder="Departure..." id="start"></td><td align="center"><input placeholder="Destination..." id="end"></td></tr>
						<tr><td align="center"><select id="mode">
							<option selected value="sel3">-Transport-</option>
							<option value="DRIVING">Driving</option>
							<option value="WALKING">Walking</option>
							<option value="TRANSIT">Transit</option>
						</select></td>
						<td align="center"><input type="button" onclick="calcRoute()" value="Show route"><br><input type="button" onclick="resetRoute()" value="Reset"></td></tr>
					</tbody>
				</table>
				
				<div id="directions-panel"><p>Total Distance: <span id="total"></span></p></div>
				
				<!--<div id="queryInput">
					<input type="text" style="width: 262px;" class="controls" id="pac-input" placeholder="Find local service(e.g restaurants)...">
					<input type="button" onclick="doSearch()" value="Search">
					<input type="button" onclick="clearLocal()" value="Reset">
				</div>-->
			</div>
			<div align="center" id="fragment-3">
				<div id="first_search">
					<input id="autocomplete" placeholder="Enter city to find hotels..." type="text" />
					<input type="button" onclick="resetMarkers()" value="Clear map">
				</div>
			</div>
			<div id="fragment-4">
				<div id="flights"></div>
			</div>
		</div>
		<div id="warnings_panel" style="width:100%;height:10%;text-align:center"></div>
		<noscript><b>JavaScript must be enabled in order for you to use Google Maps.</b> 
		  However, it seems JavaScript is either disabled or not supported by your browser. 
		  To view Google Maps, enable JavaScript by changing your browser options, and then 
		  try again.
		</noscript>
		<style type="text/css">
			/*<![CDATA[*/
			#tabs{display: block;padding: 0;z-index: 99999;position: fixed;}
			.fbplbadge {background-color:#3B5998;display: block;height: 91px;top: 50%;margin-top: -46px;position: absolute;right: -50px;width: 50px;background-image: url("http://www.xavier.edu/ts/images-2012/research-1.png");background-repeat: no-repeat;overflow: hidden;-webkit-border-top-right-radius: 8px;-webkit-border-bottom-right-radius: 8px;-moz-border-radius-topright: 8px;-moz-border-radius-bottomright: 8px;border-top-right-radius: 8px;border-bottom-right-radius: 8px;}
			.fbplbadge2 {background-color:#3B5998;display: block;height: 50px;top: 50%;margin-top: -158px;margin-left: 207px;position: absolute;bottom: -100px;width: 100px;transform:rotate(-0deg);background-image: url("http://www.dopazoinsurance.com/images/companies/travelers_logo.gif");background-repeat: no-repeat;overflow: hidden;-webkit-border-top-right-radius: 8px;-webkit-border-top-left-radius: 8px;-moz-border-radius-topright: 8px;-moz-border-radius-topleft: 8px;border-top-right-radius: 8px;border-top-left-radius: 8px;}
			.fbplbadge3 {background-color:#3B5998;display: block;height: 50px;top: 50%;margin-top: 52px;margin-left: 81px;position: absolute;bottom: -100px;width: 100px;transform:rotate(-0deg);background-image: url("http://www.trinitybightvacations.com/buttons/directions_off.jpg");background-repeat: no-repeat;overflow: hidden;-webkit-border-bottom-left-radius: 8px;-webkit-border-bottom-right-radius: 8px;-moz-border-radius-bottomleft: 8px;-moz-border-radius-bottomright: 8px;border-bottom-left-radius: 8px;border-bottom-right-radius: 8px;}
			.fbplbadge4 {background-color:#3B5998;display: block;height: 50px;top: 50%;margin-top: -102px;margin-left: 102px;position: absolute;bottom: -100px;width: 91px;transform:rotate(-0deg);background-image: url("http://www.traditionalsignwriters.com/images/services_out_100x50.png");background-repeat: no-repeat;overflow: hidden;-webkit-border-top-right-radius: 8px;-webkit-border-top-left-radius: 8px;-moz-border-radius-topright: 8px;-moz-border-radius-topleft: 8px;border-top-right-radius: 8px;border-top-left-radius: 8px;}
			/*]]>*/
		</style>
		<script type="text/javascript">
			function detailed(type1, type2, type3, dest) {
				var errors = '';
		
				var dest = jQuery("#detailed_form [name='dest']").val();
				//if (!dest) {
					//errors += ' - Please enter your destination\n';
				//}
				
				var type1 = jQuery("#detailed_form [name='type1']").val();
				var type2 = jQuery("#detailed_form [name='type2']").val();
				var type3 = jQuery("#detailed_form [name='type3']").val();
				var type4 = jQuery("#detailed_form [name='type4']").val();
				var type5 = jQuery("#detailed_form [name='type5']").val();
				
				if ((type1=="1") || (type2=="2") || (type3=="3") || (type4=="4") || (type5=="5")) {
					errors += ' - Please fill all the options\n';
				}
				
				else if((type1=="Yes") && (type2=="No") && (type3=="No") && (type4=="No") && (type5=="No")) {
					errors += ' - You must better declare your travel purpose\n';
				}
				
				else if((type1=="No") && (type2=="No") && (type3=="No") && (type4=="No") && (type5=="No")) {
					errors += ' - You must better declare your travel purpose\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
					for (var i=0; i<packageoffer.length; i++) {
						packageoffer[i].setVisible(false);
						InfoWindow.close();
					}
					packageoffer = [];
					geocoder.geocode( { 'address': dest}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							var lat = results[0].geometry.location.lat();
							var lng = results[0].geometry.location.lng();
							map.setZoom(15);
							load10(map,type1, type2, type3, type4, type5);
						} 
						else {
						  load10(map,type1, type2, type3, type4, type5);
						}
					});
					jQuery("#detailed_form").clearForm().clearFields().resetForm();
				}
			}
		</script>
		<script type="text/javascript">
			/*<![CDATA[*/
			(function(w2b){
				w2b(document).ready(function(){
					var $dur = "medium"; // Duration of Animation
					w2b("#tabs").hover(function () {
						w2b(this).stop().animate({
							left: 0
						}, $dur);
					}, function () {
						w2b(this).stop().animate({
							left: -420
						}, $dur);
					});
					
					w2b("#visitors").hover(function () {
						w2b(this).stop().animate({
							bottom: 0
						}, $dur);
					}, function () {
						w2b(this).stop().animate({
							bottom: -216
						}, $dur);
					});
					
					w2b("#directions").hover(function () {
						w2b(this).stop().animate({
							top: 0
						}, $dur);
					}, function () {
						w2b(this).stop().animate({
							top: -110
						}, $dur);
					});
					
					w2b("#providers").hover(function () {
						w2b(this).stop().animate({
							bottom: 0
						}, $dur);
					}, function () {
						w2b(this).stop().animate({
							bottom: -105
						}, $dur);
					});
				});
			})(jQuery);
			/*]]>*/
		</script>
		<script type="text/javascript">
			var geocoder = new google.maps.Geocoder(); 
		  
			// ====== Geocoding ======
			function showAddress1() {
				var address = document.getElementById('search3').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						map.setZoom(12);
					} 
					else {
					  alert('Geocode was not successful for the following reason: ' + status);
					}
				});
				jQuery("#search2").clearForm().clearFields().resetForm();
			}
			
			// ====== Geocoding ======
			function showAddress2() {
				var address = document.getElementById('search4').value;
				geocoder.geocode( { 'address': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						map.setZoom(12);
					} 
					else {
					  alert('Geocode was not successful for the following reason: ' + status);
					}
				});
				jQuery("#search10").clearForm().clearFields().resetForm();
			}
		</script>
		<script>
			jQuery('#target1').click(function() {
				jQuery('#filter').hide();
				jQuery('#cart').show();
				jQuery('#tabs').show();
				jQuery('#providers').hide();
				jQuery('#visitors').show();
				jQuery('#first_search').show();
				jQuery('#first_search2').hide();
				jQuery('#filter').hide();
				jQuery('#directions').show();
				$('#service_box').prop('checked', false);
				for (var i=0; i<showprovider1.length; i++) {
					showprovider1[i].setVisible(false);
					InfoWindow.close();
				}
				
				$('#visitor_box').prop('checked', false);
				for (var i=0; i<showvisitor.length; i++) {
					showvisitor[i].setVisible(false);
					InfoWindow.close();
				}
				test2();
				$('#hospital_box').prop('checked', false);
				test3();
				$('#clinic_box').prop('checked', false);
				test4();
				$('#center_box').prop('checked', false);
				test5();
				$('#hotel_box').prop('checked', false);
				test6();
				$('#airport_box').prop('checked', false);
				test7();
				$('#transport_box').prop('checked', false);
				test8();
				$('#fun_box').prop('checked', false);
				test9();
				
				$( "#tabs" ).tabs();
				$( "#tabs" ).tabs({ show: { effect: "blind", duration: 500 } });
				
				dblclick1();

				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				return false;
				
			});
		</script>
		<script>
			jQuery('#target2').click(function() {
				jQuery('#filter').hide();
				jQuery('#cart').hide();
				jQuery('#tabs').hide();
				jQuery('#recent_posts').hide();
				jQuery('#providers').show();
				jQuery('#visitors').hide();
				jQuery('#first_search2').show();
				jQuery('#directions').hide();
				$('#panoramio_box').prop('checked', false);
				panoramioLayer.setMap(null);
				jQuery('#photo-panel').hide();
				$('#flickr_box').prop('checked', false);
				georssLayer.setMap(null);
				$('#webcam_box').prop('checked', false);
				webcamstravel.easymap.unload();
				$('#weather_box').prop('checked', false);
				weatherLayer.setMap(null);
				cloudsLayer.setMap(null);				
				$('#visitor_box').prop('checked', false);
				for (var i=0; i<showvisitor.length; i++) {
					showvisitor[i].setVisible(false);
					InfoWindow.close();
				}
				$('#service_box').prop('checked', false);
				for (var i=0; i<showprovider1.length; i++) {
					showprovider1[i].setVisible(false);
					InfoWindow.close();
				}
				$('#elevator_box').prop('checked', false);
				map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				infowindow.close();
				jQuery('#filter').hide();
				clearLocal();
				resetMarkers();
				$('#hospital_box').prop('checked', false);
				test3();
				$('#clinic_box').prop('checked', false);
				test4();
				$('#center_box').prop('checked', false);
				test5();
				$('#hotel_box').prop('checked', false);
				test6();
				$('#airport_box').prop('checked', false);
				test7();
				$('#transport_box').prop('checked', false);
				test8();
				$('#fun_box').prop('checked', false);
				test9();
				clear();
				jQuery("#start").clearForm().clearFields().resetForm();
				jQuery("#end").clearForm().clearFields().resetForm();
				jQuery("#mode").val('sel3');
				jQuery('#directions-panel').hide();
				directionsDisplay.setMap(null);
				
				for (var i = 0; i < markerArray.length; i++) {
					markerArray[i].setMap(null);
				}
				
				// Now, clear the array itself.
				markerArray = [];
				
				dblclick2();
				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				for (var i=0; i<packageoffer.length; i++) {
					packageoffer[i].setVisible(false);
					InfoWindow.close();
				}
				
				return false;
			});
		</script>
		<script>
			jQuery('#cart_button').click(function() {
				$("#recent_posts").fadeIn(10);
				return false;
			});
			
			$("#close_recent_posts_div").click(function(){
				$("#recent_posts").fadeOut(10);
				return false;
			});
		</script>
		<script>
			var tmpmarkers = [];
			var providermarkers = [];
			var visitormarkers = [];
			var showprovider1 = [];
			var showhospital = [];
			var showclinic = [];
			var showcenter = [];
			var showhotel = [];
			var showairport = [];
			var showtransport = [];
			var showfun = [];
			var showvisitor = [];
			var packageoffer = [];
			
			var iwform1 =   ' <form id="visitor_details" method="post" action="php/process1.php" enctype="multipart/form-data">'
					  + '   <fieldset>'
					  + '   <legend>Visitor review</legend>'
					  + '   <label style="padding-left:3px;">Visitor name</label>'
					  + '   <input type="text" id="visitor_name" name="visitor_name"/><br>'
					  + '   <label for="communicate" style="padding-left:3px;">Enter your email address:</label><br>'
				      + '   <img type="image" src="images/email_logo.jpg" name="image" width="26px" height="22px"> '
					  + '   <input type="text" id="email" name="email"/><br>'
					  + '   <label for="details" style="padding-left:3px;">Impressions of your trip:</label>'
				      + '   <textarea name="details" rows="3" cols="40"></textarea><br><br>'
					  + '	<select name="rating">'
				      + '	<option selected value="choice"> - Rate this place (1-5) - </option>'
				      + ' 	<option value="1">1'
				      + ' 	<option value="2">2'
				      + ' 	<option value="3">3'
					  + ' 	<option value="4">4'
					  + ' 	<option value="5">5'
					  + '	</select><br>'
					  + '   <label style="padding-left:3px;">Youtube video embed url (*optional)</label>'
					  + '   <input type="text" id="youtube" name="youtube"/><br>'
					  + '   <button type="button" name="submit" onclick="process1(email.value,visitor_name.value,rating.value,form.details.value, youtube.value); return false">Submit</button>'
					  + ' 	</fieldset>'
				      + ' </form>'
					  
			var iwform2 =   ' <form id="provider_details" method="post" action="php/process2.php">'
					  + '   <fieldset>'
					  + '   <legend>Provider details</legend>'
					  + '   <label style="padding-left:3px;">Service name/payee</label>'
					  + '   <input type="text" id="provider_name" name="provider_name" placeholder="e.g Hotel Elvis..."/><br>'
					  + '   <label for="communicate" style="padding-left:3px;">Enter your contact details:</label><br>'
				      + '   <img type="image" src="images/email_logo.jpg" name="image" width="26px" height="22px"> '
					  + '   <input type="text" id="email" name="email" placeholder="Email..."/><br>'
					  + '	<img type="image" style="margin-left:0px" src="images/facebook_logo.jpg" name="image" width="26px" height="22px"> '
					  + '	http://www.facebook.com/<input type="text" id="phone" name="phone" placeholder="facebook username..."/><br>'
					  + '	<img type="image" style="margin-left:0px" src="http://www.24hourfitness.com/mobile/images/buttons/homeButton.png" name="image" width="26px" height="22px"> '
					  + '	http://<input type="text" style="width:150px" id="address" name="address" placeholder="Service website..."/><br><br>'
					  + '   <label style="padding-left:3px;">Type of service</label>'
				      + ' 	<select name="service">'
					  + '	<option selected value="choice1"> - Service - </option>'
				      + ' 	<option value="Νοσοκομείο">Hospital'
				      + ' 	<option value="Κλινική">Clinic'
					  + ' 	<option value="Κέντρο Αποκατάστασης">Rehabilitation center'
					  + ' 	<option value="Ξενοδοχείο">Hotel'
					  + ' 	<option value="Αεροπορική εταιρία">Airline'
					  + ' 	<option value="Επιτόπια μετακίνηση">Local transport (taxis, buses)'
					  + ' 	<option value="Τοπική διασκέδαση">Local entertainment (restaurants, coffee)'
					  + '	</select><br>'
					  + '   <label><input type="checkbox" id="amea_box" name="amea_box">Special facilities for the disabled</label>'
					  + '   <label for="details" style="padding-left:3px;">What you offer:</label>'
				      + '   <textarea name="details" rows="3" cols="40"></textarea><br><br>'
					  + '   <button type="button" name="submit" onclick="process2(email.value,phone.value,amea_box.value,provider_name.value,service.value,form.details.value,form.address.value); return false">Submit</button>'
					  + ' 	</fieldset>'
				      + ' </form>'
			
			function dblclick1() {
				google.maps.event.addListener(map,'dblclick',function(event){
					
					for (var i=0; i<tmpmarkers.length; i++) {
						tmpmarkers[i].setVisible(false);
					}
					
					createInputMarker1(event.latLng);
				});
			}
			
			function dblclick2() {
				google.maps.event.addListener(map,'dblclick',function(event){
					
					for (var i=0; i<tmpmarkers.length; i++) {
						tmpmarkers[i].setVisible(false);
					}
					
					createInputMarker2(event.latLng);
				});
			}
			
			function createInputMarker1(point) {
			    
				var marker = new google.maps.Marker({
					position: point,
					map: map,
					draggable:true
				});
				
				for (var i=0; i<tmpmarkers.length; i++) {
						infowindow.close();
				}
				
				google.maps.event.addListener(marker,"click", function() {
					lastmarker = marker;
					infowindow.open(map,lastmarker);
				});

				marker.setMap(map);
				lastmarker=marker;				
				infowindow.setContent(iwform1);
				infowindow.open(map,marker);
				tmpmarkers.push(marker);
				
				google.maps.event.addListener(map,"click", function() {
					for (var i=0; i<tmpmarkers.length; i++) {
						infowindow.close();
					}
				});
				
				return marker;
			}
			
			function createInputMarker2(point) {
				var marker = new google.maps.Marker({
					position: point,
					map: map,
					draggable:true
				});
				
				for (var i=0; i<tmpmarkers.length; i++) {
						infowindow.close();
				}
			    
				google.maps.event.addListener(marker,"click", function() {
					lastmarker = marker;
					infowindow.open(map,lastmarker);
				});
				
				marker.setMap(map);
				lastmarker=marker;
				infowindow.setContent(iwform2);
				infowindow.open(map,marker);
				tmpmarkers.push(marker);
				
				google.maps.event.addListener(map,"click", function() {
					for (var i=0; i<tmpmarkers.length; i++) {
						infowindow.close();
					}
				});
				
				return marker;
			}
			
			function process1 (email,visitor_name,rating,details) {
			
				var lat = lastmarker.getPosition().lat();
				var lng = lastmarker.getPosition().lng();
				
				var errors = '';
				var visitor_id = null;
				
				var visitor_name = jQuery("#visitor_details [name='visitor_name']").val();
				if (!visitor_name) {
					errors += ' - Please enter your name\n';
				}
				
				var details = jQuery("#visitor_details [name='details']").val();
				if (!details) {
					errors += ' - Please enter your impressions of your trip\n';
				}
				
				var rating = jQuery("#visitor_details [name='rating']").val();
				if (rating == "choice") {
					errors += ' - Please select a rating\n';
				}
				
				var youtube = jQuery("#visitor_details [name='youtube']").val();
				
				var email = jQuery("#visitor_details [name='email']").val();

				if (!email.match(/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i)) {
					errors += ' - Please enter a valid email address\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
			
					var url = "php/process1.php?visitor_id=" +visitor_id+ "&visitor_name=" +visitor_name+ "&email=" +email+ "&rating=" +rating+ "&details=" +details+ "&youtube=" +youtube+ "&lat=" +lat+ "&lng=" +lng;

					jQuery.ajax({
						url: url,
						type: "POST",
						dataType: 'json',
						success: function(){
							showResult1("ok");
						}
					});
					infowindow.close();
					var marker = createMarker1(lastmarker.getPosition(),visitor_name,rating,email,details);
					//google.maps.event.trigger(marker,"mouseover");
					google.maps.event.trigger(marker,"click");
				}
			}
			
			function createMarker1(point,visitor_name,rating,email,details) {
				var marker = new google.maps.Marker({
					position: point,
					animation: google.maps.Animation.DROP
				});
				
				
				var txt = '<u><b>Name</b></u>' + ': ' + visitor_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Rating</b></u>' + ': ' + rating + ' / 5' + '<br>' + '<u><b>Travel impressions</b></u>' + '<br>' + details;
			
				//infowindow.open(map,marker);
				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				google.maps.event.addListener(marker,"click", function() {
					marker.setIcon('http://maps.google.com/mapfiles/kml/pal2/icon14.png');
					InfoWindow.setContent(txt);
					InfoWindow.open(map,marker);
				});
			
				marker.setMap(map);
				visitormarkers.push(marker);
				google.maps.event.addListener(map,"click", function() {
					for (var i=0; i<visitormarkers.length; i++) {
						InfoWindow.close();
					}
				});
				return marker;
			}
		
			function process2(email,phone,amea_box,provider_name,service,details,address) {
			
				var lat = lastmarker.getPosition().lat();
				var lng = lastmarker.getPosition().lng();
				
				var errors = '';
				var provider_id = null;
				var status = 0;

				var provider_name = jQuery("#provider_details [name='provider_name']").val();
				if (!provider_name) {
					errors += ' - Please enter the name of the service / beneficiary\n';
				}	
				
				var service = jQuery("#provider_details [name='service']").val();
				if (service == "choice1") {
					errors += ' - Please select the type of service you offer\n';
				}
				
				if ($('#amea_box').is(':checked')) {
					var amea = true;
				}
				
				else { 
					var amea = false;
				}
				
				var details = jQuery("#provider_details [name='details']").val();
				if (!details) {
					errors += ' - Please enter a short description of what you have to offer\n';
				}
				
				var address = jQuery("#provider_details [name='address']").val();
				if (!address) {
					errors += ' - Please enter the website of your service\n';
				}
				
				var email = jQuery("#provider_details [name='email']").val();
				
				if (!email.match(/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i)) {
					errors += ' - Please enter a valid email address\n';
				}
				
				var phone = jQuery("#provider_details [name='phone']").val();
				if (!phone) {
					errors += ' - Please enter the service page at facebook\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
					var url = "php/process2.php?provider_id=" +provider_id+ "&provider_name=" +provider_name+ "&email=" +email+ "&service=" +service+ "&amea=" +amea+ "&address=" +address+ "&phone=" +phone+ "&details=" +details+ "&lat=" +lat+ "&lng=" +lng+ "&status=" +status;

					jQuery.ajax({
						url: url,
						type: "POST",
						success: function(){
							showResult2("ok");
						}
					});
					
					infowindow.close();
					var marker = createMarker2(lastmarker.getPosition(),email,phone,amea,provider_name,service,details,address,status);
					//google.maps.event.trigger(marker,"mouseover");
					google.maps.event.trigger(marker,"click");
				}
			}
			
			function process5(provider_id) {
				
				var errors = '';
				
				var details = jQuery("#visitor_details [name='v_details']").val();
				if (!details) {
					errors += ' - Please enter your review for this service\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
			
					var url = "php/process5.php?provider_id=" +provider_id+ "&details=" +details;

					jQuery.ajax({
						url: url,
						type: "POST",
						dataType: 'json',
						success: function(){
							showResult1("ok");
						}
					});
					InfoWindow.close();
				}
			}
			
			function createMarker2(point,email,phone,amea,provider_name,service,details,address,votes,status) {
				if (amea == true) {
					amea = "YES";
				}
				else {
					amea = "NO";
				}
				
				var rating = '-';
				
				var marker = new google.maps.Marker({
					position: point,
					animation: google.maps.Animation.DROP
				});
				
				var txt = '<u><b>Service name</b></u>' + '<br>' + provider_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Facebook page</b></u>' + ': ' + '<a href="http://facebook.com/'+phone+'" target="_blank">'+phone+'</a>'  + '<br>' + '<u><b>Website</b></u>' + ': ' + '<a href="http://'+address+'" target="_blank">'+address+'</a>' + '<br>' + '<u><b>Disabled facilities</b></u>' + ': ' + amea + '<br>' + '<u><b>Package offer</b></u>' + '<br>' + details + '<br>' + '<u><b>Satisfaction of visitors</b></u>' + '<br>' + rating + ' / 5';
				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				if (service == "Νοσοκομείο") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon('images/hospital.png');
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κλινική") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal4/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κέντρο Αποκατάστασης") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal3/icon21.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Ξενοδοχείο") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon20.png");	
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Αεροπορική εταιρία") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon48.png");
						InfoWindow.setContent(txt);						
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Επιτόπια μετακίνηση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon39.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Τοπική διασκέδαση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
				
					marker.setMap(map);
					providermarkers.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<providermarkers.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
			}
			
			function createMarker3(visitor_id,visitor_name,email,details,point,rating, youtube) {
				var marker = new google.maps.Marker({
					position: point,
					animation: google.maps.Animation.DROP
				});
				
				if(youtube == "") {
					var txt = '<u><b>Name</b></u>' + ': ' + visitor_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Rating</b></u>' + ': ' + rating + ' / 5' + '<br>' + '<u><b>Travel impressions</b></u>' + '<br>' + details;
				}
				
				else {
					//alert(youtube);
					var txt = '<u><b>Name</b></u>' + ': ' + visitor_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Rating</b></u>' + ': ' + rating + ' / 5' + '<br>' + '<u><b>Travel impressions</b></u>' + '<br>' + details + '<br>' + '<u><b>Video</b></u>' + '<br>' + '<iframe width="560" height="315" src="'+youtube+'" frameborder="0" allowfullscreen></iframe>';
				}
				
				//infowindow.open(map,marker);
				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				google.maps.event.addListener(marker,"click", function() {
					marker.setIcon('http://maps.google.com/mapfiles/kml/pal2/icon14.png');
					InfoWindow.setContent(txt);
					InfoWindow.open(map,marker);
				});
				
				setTimeout(function() {
					for (var i=0; i<showvisitor.length; i++) {
						InfoWindow.close();
					}
				}, 0);
			
				marker.setMap(map);
				showvisitor.push(marker);
				google.maps.event.addListener(map,"click", function() {
					for (var i=0; i<showvisitor.length; i++) {
						InfoWindow.close();
					}
				});
				return marker;
			}
			
			function createMarker4(provider_id,provider_name,email,address,phone,service,amea,details,point,status,votes) {
				if (amea == "true") {
					amea = "YES";
				}
				else {
					amea = "NO";
				}
				
				if(status == 0 && votes == 0) {
					var rating = '-';
				}
				
				else {
					var rating = (status/votes).toFixed(2);
				}
				
				var marker = new google.maps.Marker({
					position: point,
					animation: google.maps.Animation.DROP
				});
				
				var txt = '<u><b>Service name</b></u>' + '<br>' + provider_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Facebook page</b></u>' + ': ' + '<a href="http://facebook.com/'+phone+'" target="_blank">'+phone+'</a>'  + '<br>' + '<u><b>Website</b></u>' + ': ' + '<a href="http://'+address+'" target="_blank">'+address+'</a>' + '<br>' + '<u><b>Disabled facilities</b></u>' + ': ' + amea + '<br>' + '<u><b>Package offer</b></u>' + '<br>' + details + '<br>' + '<u><b>Satisfaction of visitors</b></u>' + '<br>' + rating + ' / 5' + '<br>' + '<u><b>Total votes</b></u>: ' + votes;				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				for (var i=0; i<showprovider1.length; i++) {
					InfoWindow.close();
				}
				
				if (service == "Νοσοκομείο") {
					
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon('images/hospital.png');	
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κλινική") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal4/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κέντρο Αποκατάστασης") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal3/icon21.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Ξενοδοχείο") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon20.png");
						InfoWindow.setContent(txt);							
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Αεροπορική εταιρία") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon48.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Επιτόπια μετακίνηση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon39.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Τοπική διασκέδαση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showprovider1.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showprovider1.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
			}
			
			function createMarker5(provider_id,provider_name,email,address,phone,service,amea,details,point,status,votes) {
				if (amea == "true") {
					amea = "YES";
				}
				else {
					amea = "NO";
				}
				
				if(status == 0 && votes == 0) {
					var rating = '-';
				}
				
				else {
					var rating = (status/votes).toFixed(2);
				}
								
				var marker = new google.maps.Marker({
					position: point,
					animation: google.maps.Animation.DROP
				});
				
				var txt = '<u><b>Service name</b></u>' + '<br>' + provider_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Facebook page</b></u>' + ': ' + '<a href="http://facebook.com/'+phone+'" target="_blank">'+phone+'</a>'  + '<br>' + '<u><b>Website</b></u>' + ': ' + '<a href="http://'+address+'" target="_blank">'+address+'</a>' + '<br>' + '<u><b>Disabled facilities</b></u>' + ': ' + amea + '<br>' + '<u><b>Package offer</b></u>' + '<br>' + details + '<br>' + '<u><b>Satisfaction of visitors</b></u>' + '<br>' + rating + ' / 5' + '<br>' + '<u><b>Total votes</b></u>: ' + votes + '<br>'
						+ '<br>' + '<div id="rating"><span id="rateStatus">Rate me...</span><span id="ratingSaved">Your rating was saved!</span><div style="padding-bottom:20px;" id="rateMe" title="Rate me..."><a onclick="rateIt(this, '+ provider_id +')" id="_1" title="Hmmm..." onmouseover="rating(this, '+ provider_id +')" onmouseout="off(this, '+ provider_id +')"></a><a onclick="rateIt(this, '+ provider_id +')" id="_2" title="Not bad..." onmouseover="rating(this, '+ provider_id +')" onmouseout="off(this, '+ provider_id +')"></a><a onclick="rateIt(this, '+ provider_id +')" id="_3" title="Pretty good..." onmouseover="rating(this, '+ provider_id +')" onmouseout="off(this, '+ provider_id +')"></a><a onclick="rateIt(this, '+ provider_id +')" id="_4" title="Excellent!" onmouseover="rating(this, '+ provider_id +')" onmouseout="off(this, '+ provider_id +')"></a><a onclick="rateIt(this, '+ provider_id +')" id="_5" title="Pretty awesome!!!" onmouseover="rating(this, '+ provider_id +')" onmouseout="off(this, '+ provider_id +')"></a></div></div>'
						+ '<a href="#" onclick="review('+ provider_id +')" id="make">Make review</a>' + ' | ' + '<a href="#" onclick="see('+ provider_id +')" id="see">See reviews</a>'
						+ ' | ' + '<a href="#" onclick="quote('+ provider_id +')" id="quote">Request quote</a>' + ' | ' + '<a href="#" onclick="t_package('+ provider_id +')" id="quote">Add to package</a>';
				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				for (var i=0; i<showhospital.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showclinic.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showcenter.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showhotel.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showairport.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showtransport.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showfun.length; i++) {
					InfoWindow.close();
				}
				
				if (service == "Νοσοκομείο") {
					
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon('images/hospital.png');	
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showhospital.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showhospital.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showhospital.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κλινική") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal4/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showclinic.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showclinic.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showclinic.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κέντρο Αποκατάστασης") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal3/icon21.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showcenter.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showcenter.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showcenter.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Ξενοδοχείο") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon20.png");
						InfoWindow.setContent(txt);							
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showhotel.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showhotel.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showhotel.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Αεροπορική εταιρία") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon48.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showairport.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showairport.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showairport.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Επιτόπια μετακίνηση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon39.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showtransport.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showtransport.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showtransport.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Τοπική διασκέδαση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showfun.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showfun.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showfun.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
			}
			
			function createMarker6(provider_name,email,address,phone,service,point) {
								
				var marker = new google.maps.Marker({
					position: point,
					animation: google.maps.Animation.DROP
				});
				
				var txt = '<u><b>Service name</b></u>' + '<br>' + provider_name + '<br>' + '<u><b>Email</b></u>' + ': ' + email + '<br>' + '<u><b>Facebook page</b></u>' + ': ' + '<a href="http://facebook.com/'+phone+'" target="_blank">'+phone+'</a>'  + '<br>' + '<u><b>Website</b></u>' + ': ' + '<a href="http://'+address+'" target="_blank">'+address+'</a>'
				
				for (var i=0; i<tmpmarkers.length; i++) {
					tmpmarkers[i].setVisible(false);
					infowindow.close();
				}
				
				for (var i=0; i<showhospital.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showclinic.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showcenter.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showhotel.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showairport.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showtransport.length; i++) {
					InfoWindow.close();
				}
				
				for (var i=0; i<showfun.length; i++) {
					InfoWindow.close();
				}
				
				if (service == "Νοσοκομείο") {
					
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon('images/hospital.png');	
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showhospital.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showhospital.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showhospital.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κλινική") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal4/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showclinic.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showclinic.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showclinic.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Κέντρο Αποκατάστασης") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal3/icon21.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showcenter.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showcenter.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showcenter.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Ξενοδοχείο") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon20.png");
						InfoWindow.setContent(txt);							
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showhotel.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showhotel.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showhotel.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Αεροπορική εταιρία") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon48.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showairport.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showairport.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showairport.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Επιτόπια μετακίνηση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon39.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showtransport.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showtransport.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showtransport.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
				
				else if (service == "Τοπική διασκέδαση") {
					google.maps.event.addListener(marker,"click", function() {
						marker.setIcon("http://maps.google.com/mapfiles/kml/pal2/icon55.png");
						InfoWindow.setContent(txt);
						InfoWindow.open(map,marker);
					});
					
					setTimeout(function() {
						for (var i=0; i<showfun.length; i++) {
							InfoWindow.close();
						}
					}, 0);
				
					marker.setMap(map);
					showfun.push(marker);
					google.maps.event.addListener(map,"click", function() {
						for (var i=0; i<showfun.length; i++) {
							InfoWindow.close();
						}
					});
					return marker;
				}
			}
			
			function review(provider_id) {
				var iwform3 =   ' <form id="visitor_details" method="post" action="php/process5.php">'
						  + '   <fieldset>'
						  + '   <legend>Visitor Review</legend>'
						  + '   <label for="v_details" style="padding-left:3px;">Comments:</label>'
						  + '   <textarea name="v_details" rows="3" cols="40"></textarea><br><br>'
						  + '   <button type="button" name="submit" onclick="process5('+provider_id+'); return false">Submit</button>'
						  + ' 	</fieldset>'
						  + ' </form>'
						  
				InfoWindow.setContent(iwform3);		  
				//alert("Παρακαλώ εισάγετε τα στοιχεία που σας ζητούνται για να ολοκληρωθεί η κράτηση!");
						
			}
			
			function quote(provider_id) {
				
				downloadUrl("php/quote.php?provider_id=" +provider_id, function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/quote.php?provider_id=" +provider_id, false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var quotes = xml.documentElement.getElementsByTagName("quote");
					for (var i = 0; i < quotes.length; i++) {
						var q = quotes[i].getAttribute("email");
					}
					
					var email =   ' <form id="visitor_details" method="post">'
					  + '   <fieldset>'
					  + '   <legend>Request a quote</legend>'
					  + '   <label for="p_email" style="padding-left:3px;">Provider email:</label>'
					  + '   <input disabled type="text" size="30" name="p_email" value="'+q+'"/><br>'
					  + '   <label for="v_email" style="padding-left:3px;">Your email:</label>'
					  + '   <input type="text" name="v_email"/><br>'
					  + '   <label for="v_details" style="padding-left:3px;">Comments:</label>'
					  + '   <textarea name="v_details" rows="3" cols="40"></textarea><br><br>'
					  + '   <button type="button" name="submit" onclick="email('+provider_id+'); return false">Send</button>'
					  + ' 	</fieldset>'
					  + ' </form>'
					InfoWindow.setContent(email);
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}						
			}
			
			function t_package(provider_id) {
				
				var form =   ' <form id="visitor_details" method="post">'
				  + '   <fieldset>'
				  + '   <legend>Your ReTour login email</legend>'
				  + '   <label for="u_email" style="padding-left:3px;">Your ReTour login email:</label>'
				  + '   <input type="text" name="u_email"/><br><br>'
				  + '   <button type="button" name="submit" onclick="book('+provider_id+'); return false">Add to my travel cart</button>'
				  + ' 	</fieldset>'
				  + ' </form>'
				InfoWindow.setContent(form);
					
			}
			
			function book(provider_id) {
				
				var errors = '';
				
				var email = jQuery("#visitor_details [name='u_email']").val();

				if (!email.match(/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i)) {
					errors += ' - Please enter a valid ReTour login email address\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
				
					downloadUrl("php/book.php?email=" +email+ "&provider_id=" +provider_id, function(data) {
						//--------------------------------------------------
						var data = new XMLHttpRequest(); 
						data.open("GET", "php/book.php?email=" +email+ "&provider_id=" +provider_id, false); 
						data.overrideMimeType("text/xml");
						data.send(null);
						//--------------------------------------------------
						var xml = data.responseXML;
						var users = xml.documentElement.getElementsByTagName("user");
						for (var i = 0; i < users.length; i++) {
							var q1 = users[i].getAttribute("id");
							var q2 = users[i].getAttribute("service");
						}
						if (users.length != 0) {
							pcg(provider_id, q1, q2);
							InfoWindow.close();
						}
						else {
							var error = "It seems you are not registered in ReTour system. Do it <a href='http://83.212.100.158/wp-login.php?action=register' target='_blank'>here</a>";
							InfoWindow.setContent(error);
						}
					});
				}
				
				function downloadUrl(url, callback) {
						var request = window.ActiveXObject ?
						new ActiveXObject('Microsoft.XMLHTTP') :
						new XMLHttpRequest;

						request.onreadystatechange = function() {
							if (request.readyState == 4) {
								request.onreadystatechange = doNothing;
								callback(request, request.status);
							}
						};
						
						request.open('GET', url, true);
						request.send(null);
					}
			  
				function doNothing() {}
			}
			
			function showpackage() {
				
				var errors = '';
				
				var email = jQuery("#visitor_details [name='l_email']").val();

				if (!email.match(/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i)) {
					errors += ' - Please enter a valid ReTour login email address\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
				
					downloadUrl("php/showpackage.php?email=" +email, function(data) {
						//--------------------------------------------------
						var data = new XMLHttpRequest(); 
						data.open("GET", "php/showpackage.php?email=" +email, false); 
						data.overrideMimeType("text/xml");
						data.send(null);
						//--------------------------------------------------
						var xml = data.responseXML;
						var pkg = xml.documentElement.getElementsByTagName("package");
						for (var i = 0; i < pkg.length; i++) {
							var q1 = pkg[i].getAttribute("id");
						}
						if (pkg.length != 0) {
							downloadUrl("php/showpackage2.php?q1=" +q1, function(data) {
								//--------------------------------------------------
								var data = new XMLHttpRequest(); 
								data.open("GET", "php/showpackage2.php?q1=" +q1, false); 
								data.overrideMimeType("text/xml");
								data.send(null);
								//--------------------------------------------------
								var xml = data.responseXML;
								var pkg2 = xml.documentElement.getElementsByTagName("package");
								for (var i = 0; i < pkg2.length; i++) {
									var hospital = pkg2[i].getAttribute("hospital");
									var clinic = pkg2[i].getAttribute("clinic");
									var rehabilitation = pkg2[i].getAttribute("rehabilitation");
									var hotel = pkg2[i].getAttribute("hotel");
									var airline = pkg2[i].getAttribute("airline");
									var transport = pkg2[i].getAttribute("transport");
									var fun = pkg2[i].getAttribute("fun");
								}
								if (pkg2.length != 0) {
									var travel_package = "Hospital id: " + hospital + "<br>" + "Clinic id: " + clinic + "<br>" + "Rehabilitation center id: " + rehabilitation + "<br>" + "Hotel id: " + hotel + "<br>" + "Airline id: " + airline + "<br>" + "Transport id: " + transport + "<br>" + "Fun id: " + fun;
									downloadUrl("php/packagetomap.php?hospital=" +hospital+ "&clinic=" +clinic+ "&rehabilitation=" +rehabilitation+ "&hotel=" +hotel+ "&airline=" +airline+ "&transport=" +transport+ "&fun=" +fun, function(data) {
										//--------------------------------------------------
										var data = new XMLHttpRequest(); 
										data.open("GET", "php/packagetomap.php?hospital=" +hospital+ "&clinic=" +clinic+ "&rehabilitation=" +rehabilitation+ "&hotel=" +hotel+ "&airline=" +airline+ "&transport=" +transport+ "&fun=" +fun, false); 
										data.overrideMimeType("text/xml");
										data.send(null);
										//--------------------------------------------------
										var xml = data.responseXML;
										var services = xml.documentElement.getElementsByTagName("service");
										for (var i = 0; i < services.length; i++) {
											var name = services[i].getAttribute("name");
											var email = services[i].getAttribute("email");
											var address = services[i].getAttribute("address");
											var phone = services[i].getAttribute("phone");
											var service = services[i].getAttribute("service");
											var point = new google.maps.LatLng(
												parseFloat(services[i].getAttribute("lat")),
												parseFloat(services[i].getAttribute("lng")));
											var marker = createMarker6(name,email,address,phone,service,point);
											google.maps.event.trigger(marker,"click");
										}
									});
									$("#recent_posts span").html(travel_package + "<br><input type='submit' id='back' value='Go back'>");
									$('#back').click(function(){
										$("#recent_posts span").html("<form id='visitor_details' method='post'><b>Your ReTour login email</b><br><input type='text' name='l_email'/><br><br><input type='submit' onclick='showpackage(); return false' value='Show my package'></form>");
									});
								}
								else {
									$("#recent_posts span").html("<br><b style='font-size:16pt'>It seems you have not made a travel package yet!</b><br><input type='submit' id='back' value='Go back'>");
									$('#back').click(function(){
										$("#recent_posts span").html("<form id='visitor_details' method='post'><b>Your ReTour login email</b><br><input type='text' name='l_email'/><br><br><input type='submit' onclick='showpackage(); return false' value='Show my package'></form>");
									});
								}
							});
						}
						else {
							$("#recent_posts span").html("<br><b style='font-size:16pt'>It seems you are not registered in ReTour system. Do it <a href='http://83.212.100.158/wp-login.php?action=register' target='_blank' style='color:#FF96FF;'>here</a> or </b><input type='submit' id='back' value='Go back'>");
							$('#back').click(function(){
								$("#recent_posts span").html("<form id='visitor_details' method='post'><b>Your ReTour login email</b><br><input type='text' name='l_email'/><br><br><input type='submit' onclick='showpackage(); return false' value='Show my package'></form>");
							});
						}
					});
				}
				
				function downloadUrl(url, callback) {
						var request = window.ActiveXObject ?
						new ActiveXObject('Microsoft.XMLHTTP') :
						new XMLHttpRequest;

						request.onreadystatechange = function() {
							if (request.readyState == 4) {
								request.onreadystatechange = doNothing;
								callback(request, request.status);
							}
						};
						
						request.open('GET', url, true);
						request.send(null);
					}
			  
				function doNothing() {}
			}
			
			function pcg(provider_id, q1, q2) {
				//alert('User with id ' + q1 + ' wants to go to a ' + q2 + ' with id ' + provider_id);
				
				var url = "php/package.php?provider_id=" +provider_id+ "&q1=" +q1+ "&q2=" +q2;

				jQuery.ajax({
					url: url,
					type: "POST",
					dataType: 'json',
					success: function(){
						showResult1("ok");
					}
				});				
			}
			
			function email(provider_id) {
				
				var errors = '';
				
				var details = jQuery("#visitor_details [name='v_details']").val();
				if (!details) {
					errors += ' - Please enter the quote you want from the service\n';
				}
				
				var q = jQuery("#visitor_details [name='p_email']").val();
				
				var email = jQuery("#visitor_details [name='v_email']").val();

				if (!email.match(/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i)) {
					errors += ' - Please enter a valid email address\n';
				}
				
				if (errors) {
					errors = ' The following errors occurred: \n' + errors;
					alert(errors);
					return false;
				}
				
				else {
			
					var url = "php/email.php?details=" +details+ "&q=" +q+ "&email=" +email;

					jQuery.ajax({
						url: url,
						type: "POST",
						dataType: 'json',
						success: function(){
							showResult1("ok");
						}
					});
					InfoWindow.close();
				}
			}
			
			function see(provider_id) {
				details = [];						  

				downloadUrl("php/emfanishreviews.php?provider_id=" +provider_id, function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishreviews.php?provider_id=" +provider_id, false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var reviews = xml.documentElement.getElementsByTagName("review");
					for (var i = 0; i < reviews.length; i++) {
						var rev = reviews[i].getAttribute("details");
						details.push(i+1 + ') ' + rev);
					}
					
					var str = details.join(" <hr> "); 
					InfoWindow.setContent(str);
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}						
			}
			
			function showResult1(data) {
				jQuery("#visitor_details").clearForm().clearFields().resetForm();
				return false;
			}
			
			function showResult2(data) {
				jQuery("#provider_details").clearForm().clearFields().resetForm();
				return false;
			}
		</script>
		<script type="text/javascript">
			function load1() {
				showvisitor = [];
				downloadUrl("php/emfanishmarkers1.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers1.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var visitor_id = markers[i].getAttribute("visitor_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var details = markers[i].getAttribute("details");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var rating = markers[i].getAttribute("rating");
						var youtube = markers[i].getAttribute("youtube");
						var marker = createMarker3(visitor_id,name,email,details,point,rating, youtube);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
					markerClusterer = new MarkerClusterer(map, showvisitor);
					InfoWindow.close();
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load2() {
				showprovider1 = [];
				downloadUrl("php/emfanishmarkers2.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers2.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker4(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
					markerClusterer = new MarkerClusterer(map, showprovider1);
					InfoWindow.close();
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load3() {
				downloadUrl("php/emfanishmarkers3.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers3.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load4() {
				downloadUrl("php/emfanishmarkers4.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers4.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load5() {
				downloadUrl("php/emfanishmarkers5.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers5.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load6() {
				downloadUrl("php/emfanishmarkers6.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers6.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load7() {
				downloadUrl("php/emfanishmarkers7.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers7.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load8() {
				downloadUrl("php/emfanishmarkers8.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers8.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load9() {
				downloadUrl("php/emfanishmarkers9.php", function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", "php/emfanishmarkers9.php", false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function load10(map,type1,type2,type3,type4,type5) {
				// First, determine the map bounds
				var bounds = map.getBounds();

				// Then the points
				var swPoint = bounds.getSouthWest();
				var nePoint = bounds.getNorthEast();

				// Now, each individual coordinate
				var swLat = swPoint.lat();
				var swLng = swPoint.lng();
				var neLat = nePoint.lat();
				var neLng = nePoint.lng();
			
				downloadUrl('php/process4.php?type1=' +type1+ '&type2=' +type2+ '&type3=' +type3+ '&type4=' +type4+ '&type5=' +type5+ '&swLat=' +swLat+ '&swLng=' +swLng+ '&neLat=' +neLat+ '&neLng=' +neLng, function(data) {
					//--------------------------------------------------
					var data = new XMLHttpRequest(); 
					data.open("GET", 'php/process4.php?type1=' +type1+ '&type2=' +type2+ '&type3=' +type3+ '&type4=' +type4+ '&type5=' +type5+ '&swLat=' +swLat+ '&swLng=' +swLng+ '&neLat=' +neLat+ '&neLng=' +neLng, false); 
					data.overrideMimeType("text/xml");
					data.send(null);
					//--------------------------------------------------
					var xml = data.responseXML;
					var markers = xml.documentElement.getElementsByTagName("marker");
					
					for (var i = 0; i < markers.length; i++) {
						var provider_id = markers[i].getAttribute("provider_id");
						var name = markers[i].getAttribute("name");
						var email = markers[i].getAttribute("email");
						var address = markers[i].getAttribute("address");
						var details = markers[i].getAttribute("details");
						var phone = markers[i].getAttribute("phone");
						var service = markers[i].getAttribute("service");
						var amea = markers[i].getAttribute("amea");
						var point = new google.maps.LatLng(
							parseFloat(markers[i].getAttribute("lat")),
							parseFloat(markers[i].getAttribute("lng")));
						var status = markers[i].getAttribute("status");
						var votes = markers[i].getAttribute("votes");
						var marker = createMarker5(provider_id,name,email,address,phone,service,amea,details,point,status,votes);
						packageoffer.push(marker);
						google.maps.event.trigger(marker,"click");
						//google.maps.event.trigger(marker,"click");
					}
				});
	  
				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
					new ActiveXObject('Microsoft.XMLHTTP') :
					new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request, request.status);
						}
					};
					
					request.open('GET', url, true);
					request.send(null);
				}
		  
				function doNothing() {}
			}
			
			function test1() {
				for (var i=0; i<showvisitor.length; i++) {
					showvisitor[i].setVisible(false);
				}
				for (var i=0; i<visitormarkers.length; i++) {
					visitormarkers[i].setVisible(false);
				}
				InfoWindow.close();
				clear();
				
			}
			
			function test2() {
				for (var i=0; i<showprovider1.length; i++) {
					showprovider1[i].setVisible(false);
					showprovider1 = [];
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
					providermarker = [];
				}
				InfoWindow.close();
				clear();
				
			}
			
			function test3() {
				for (var i=0; i<showhospital.length; i++) {
					showhospital[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function test4() {
				for (var i=0; i<showclinic.length; i++) {
					showclinic[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function test5() {
				for (var i=0; i<showcenter.length; i++) {
					showcenter[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function test6() {
				for (var i=0; i<showhotel.length; i++) {
					showhotel[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function test7() {
				for (var i=0; i<showairport.length; i++) {
					showairport[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function test8() {
				for (var i=0; i<showtransport.length; i++) {
					showtransport[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function test9() {
				for (var i=0; i<showfun.length; i++) {
					showfun[i].setVisible(false);
				}
				for (var i=0; i<providermarkers.length; i++) {
					providermarkers[i].setVisible(false);
				}
				InfoWindow.close();
			}
			
			function clear() {
				if(markerClusterer) {
					markerClusterer.clearMarkers();
				}
				else {
					return false;
				}
			}
		</script>
		<script type="text/javascript" src="js/form.js"></script>
		<script type="text/javascript" src="//api.skyscanner.net/api.ashx?key=ea7253d4-7313-4c6e-a95f-b0d278c8a7fb "></script>
		<script type="text/javascript">
			skyscanner.load("maps", "1");
			var flights;
			function main() {
				
				flights = new skyscanner.maps.Map();
				flights.setRoute("GR","");
				flights.setDepartureResetEnabled(true);
				flights.setDestinationResetEnabled(true);
				flights.setSize(373, 200);
				flights.setCulture("el-GR");
				flights.setCurrency("EUR");
				flights.showPrices(true);
				flights.draw(document.getElementById("flights"));
				
			}
			skyscanner.setOnLoadCallback(main);
		</script>
	</body>
</html>