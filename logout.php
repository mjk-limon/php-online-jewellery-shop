<?php
	include('doc/includes/config.php');
	require_once('doc/includes/functions.php');
	$ref_page	= isset($_GET['ref_page']) ? get_url_variables($_GET['ref_page']) : $base.'index';
	
	if (!isset($_COOKIE['clt'])) {
		header('Location:'.$ref_page);	
	} else {
		setcookie('clt','user',time()-24*60*60,"/");
		header('Location:'.$ref_page);
	}
?>