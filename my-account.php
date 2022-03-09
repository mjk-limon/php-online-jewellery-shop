<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php
	if(!isset($_COOKIE['clt'])) header('Location: login/?ref='.urlencode($_SERVER['REQUEST_URI']));
	$result_user = get_user_info($_COOKIE['clt']);
	if($result_user->num_rows==1) $row_user	= $result_user->fetch_array();
	else {
		setcookie('clt', null, time() - 3600, "/");
		exit(header('Location: login/?emsg='.urlencode("Invalid token or user deleted !")));
	}
?>
<?php include "doc/includes/header.php"; ?>
	<div class="limon-login">
		<div class="wrapper my-account">
			<h2>Welcome, <?php echo $row_user['last_name']; ?></h2>
			<div class="limlog-form inner-page">
				<p class="text-center"><a href="order-history">View Order History</a></p>
				<table class="table">
					<form method="post" action="" id="updadeMyAccount">
						<input type="hidden" name="updadeMyAccount" />
						<input type="hidden" name="id" value="<?php echo $row_user['id']; ?>"/>
						<thead>
							<tr>
								<td>First Name:</td>
								<td><input type="text" name="first_name" class="form-control" value="<?php echo $row_user['first_name']; ?>"/></td>
							</tr>
							<tr>
								<td>Last Name:</td>
								<td><input type="text" name="last_name" class="form-control" value="<?php echo $row_user['last_name']; ?>" /></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><input type="text" name="email" class="form-control" value="<?php echo $row_user['email']; ?>" /></td>
							</tr>
							<tr>
								<td>Address:</td>
								<td><input type="text" name="address" class="form-control" value="<?php echo $row_user['address']; ?>" /></td>
							</tr>
							<tr>
								<td>City:</td>
								<td><input type="text" name="city" class="form-control" value="<?php echo $row_user['city']; ?>" /></td>
							</tr>
							<tr>
								<td>District:</td>
								<td><input type="text" name="district" class="form-control" value="<?php echo $row_user['district']; ?>" /></td>
							</tr>
							<tr>
								<td>Postal Code:</td>
								<td><input type="text" name="postalcode" class="form-control" value="<?php echo $row_user['postalcode']; ?>" /></td>
							</tr>
							<tr>
								<td>Mobile Number:</td>
								<td><input type="text" name="mobile_number" class="form-control" value="<?php echo $row_user['mobile_number']; ?>" /></td>
							</tr>
							<tr>
								<td colspan="2"><input type="submit" value="Update" class="btn btn-success"></td>
							</tr>
						</thead>
					</form>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include "doc/includes/footer.php"; ?>