<?php
	date_default_timezone_set("Asia/Dhaka");
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off' || $_SERVER['SERVER_PORT']==443) ? "https://" : "http://";
	$project_folder = ($_SERVER['HTTP_HOST']!='localhost') ? "/" : "/".explode('/',$_SERVER['REQUEST_URI'],4)[1]."/".explode('/',$_SERVER['REQUEST_URI'],4)[2]."/";
	$base = $protocol.$_SERVER['HTTP_HOST'].$project_folder;
	$companyName	= "Ornament World";
	$currency		= "BDT";
	$EmailToSend	= "info@ornamentworld.com";
	$uri_parts 		= explode('?', $_SERVER['REQUEST_URI'], 2);
	$self_url		= 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
	$min_prid		= "100100";
	$GoogleMapApi	= 'AIzaSyCM2ZcxLK4zaOcu8UCvyYxkFYP2j0a48_4';
	$product_page_limit	= 16;
	/*--------------------------------
	Currency rate conversion manuel:
	Currency => Per unit through BDT
	--------------------------------*/
	$currencyRate = array(
		"BDT" => 1
	);
	/*--------------------------------
	Delivery cost manuel:
	Delivery location => Cost in BDT
	--------------------------------*/
	$dCost = array(
		"dhaka" => 80,
		"other" => 120
	);
	define("_DS_SNAME", "localhost");
	define("_DS_USER", "root");
	define("_DS_PASS", "adminlimon");
	define("_DS_DB", "ratri");
	
	$conn = new mysqli(_DS_SNAME, _DS_USER, _DS_PASS, _DS_DB);
	if($conn->connect_error) die("connection failed !" .  $conn->connect_error);
?>