<?php
	include "../doc/includes/config.php";
	if(isset($_COOKIE['user'])) header('Location: index.php');
	$emsg = (isset($_GET['emsg'])) ? $_GET['emsg'] : null;
	$ref = (isset($_GET['ref'])) ? $_GET['ref'] : "index.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = $conn->real_escape_string($_POST['username']);
		$password = $conn->real_escape_string($_POST['password']);
			
		$get = "SELECT * FROM admins ";
		$get.= "WHERE binary username = '{$username}' ";
		$get.= "AND password = '{$password}'";
		$result 	= $conn->query($get);
		
		if ($result->num_rows == 1) {
			$row	= $result->fetch_array();
			setcookie("user", $row['Token'], time() + (86400 * 30),"/");
			header('Location: '.$ref);
		} else $emsg = "Incorrect username or password !";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login To Admin Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/login.css" rel="stylesheet" type="text/css" media="all">
<body>
<div class="main-w3l">
	<div class="w3layouts-main">
		<h2>Login To Admin Panel</h2>
		<form method="post">
			<input value="USERNAME" name="username" type="text" required="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'username';}"/>
			<input value="PASSWORD" name="password" type="password" required="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"/>
			<span class="remember"><input type="checkbox" checked="true"/> Remember Me</span>
			
			<div class="clear"></div>
			<input type="submit" value="login" name="login">
		</form>
	</div>
<?php if(isset($emsg) && !empty($emsg)) { ?>
	<div class="alert alert-danger"><?= $emsg ?></div>
<?php } ?>
</div>
</body>
</html>