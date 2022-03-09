<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
	function replace_comma($variable) {$restyle	= str_replace(",", "~comma~", $variable);return $restyle;}
?>
<?php
	/*===================== delete data ================*/
	if(isset($_POST['del_data'])) {
		$delete_id = $conn->real_escape_string($_POST['id']);
		$table_name = $conn->real_escape_string($_POST['table']);
		$sql = DeleteTable($table_name, "id='{$delete_id}'");
		if($conn->query($sql)) exit('Successfully deleted data !');
		else exit("{$conn->error}");
	}
?>
<?php
	/*===================== messages ================*/
	if(isset($_POST['view_details']) && $_POST['view_details'] == 'msg') {
		$msginfo = get_single_data("contact", "Id = '{$_POST['vid']}'");
?>
	<div class="row single-message-info">
		<div class="col-md-12 p-4">
				<p>Date: <?= date('M j, Y (H:i)', strtotime($msginfo['date'])) ?></p>
				<p>From: <?= $msginfo['Name'] ?></p>
				<p><?= $msginfo['Email'] ?></p>
				<p>Subject: <u><?= $msginfo['Subject'] ?></u></p>
				<p>&nbsp;</p>
				<p><?= nl2br($msginfo['Message']) ?></p>
		</div>
	</div>
<?php } ?>
<?php
	/*===================== customer list ================*/
	if(isset($_POST['view_details']) && ($_POST['view_details'] == 'cls')) {
		$userinfo = get_user_info("id = '{$_POST['vid']}'");
?>
	<div class="single-customer-info">
		<img src="images/avatar.png" class="pull-right"/>
		<h3 class="text-info name"><?= $userinfo['first_name']." ".$userinfo['last_name'] ?><span class="text-muted font-italic">@<?= $userinfo['username'] ?></span></h3>
		<p class="text-muted"><i class="fa fa-envelope"></i> <?= $userinfo['email'] ?></p>
		<p class="text-muted"><i class="fa fa-phone"></i> <?= $userinfo['mobile_number'] ?></p>
		<p><strong>Address: </strong> <?= $userinfo['address'] ?></p>
		<p><strong>City: </strong> <?= $userinfo['city'] ?></p>
		<p><strong>District: </strong> <?= $userinfo['district'] ?></p>
		<p><strong>Country: </strong> <?= $userinfo['country'] ?></p>
	</div>
	<div class="clearfix"></div>
	<h4 class="text-center"><u>Customer Orders</u></h4>
	<?php
		$get_customer_orders = get_order_history("email = '".addslashes($userinfo['email'])."'");
		if($get_customer_orders->num_rows > 0) {
	?>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead><tr class="text-info"><th>Date</th><th>Total Cost</th><th>Ordered Products</th></tr></thead>
				<tbody>
				<?php
					while($row_oh = $get_customer_orders->fetch_array()){
						$product_names = array(); $total_price = 0;
						foreach(explode(",", $row_oh['pr_id']) as $single_prid) { 
							$row_oh_pd = product_details($single_prid);
							$product_names[] = !empty($row_oh_pd['name']) ? $row_oh_pd['name'] : '<span class="bg-danger text-light">Product Deleted</span>';
							$total_price += $row_oh_pd['price'];
						}
				?>
					<tr>
						<td><?= date('M j, Y', strtotime($row_oh['date'])) ?></td>
						<td>Tk <?= $total_price ?></td>
						<td><?= implode(", ", $product_names) ?></td>
					</tr>
				<?php } mysqli_free_result($get_customer_orders) ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php } else { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger text-center">
				This customer has no previous orders
			</div>
		</div>
	</div>
	<?php } ?>
<?php } ?>
<?php
	/*===================== coupons ================*/
	if(isset($_POST['view_details']) && ($_POST['view_details'] == 'cpn')) {
		$row_cp = get_single_data("coupons", "id = '".$_POST['vid']."'");
?>
	<form action="" method="post">
		<input type="hidden" name="update_coupon"/>
		<input type="hidden" name="cpid" value="<?= $row_cp['id'] ?>" />
		<div class="form-group">
			<label>Coupon Code</label>
			<input type="text" class="form-control" name="cp_code" value="<?= $row_cp['coupon'] ?>">
		</div>
		<div class="row form-group">
			<div class="col-md-6">
				<div class="form-group">
					<label>From</label>
					<input type="date" class="form-control" name="cp_from" value="<?= date("Y-m-d", strtotime("-3 day")) ?>" disabled>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>To</label>
					<input type="date" class="form-control" name="cp_to" value="<?= date("Y-m-d") ?>" disabled>
				</div>
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-8">
				<div class="form-group">
					<label>Amount</label>
					<input type="text" class="form-control" name="cp_discount" value="<?= $row_cp['discount'] ?>">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label for="exampleSelect1">Type</label>
					<select class="form-control" id="exampleSelect1" disabled >
						<option>TK</option>
						<option>%</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Limit</label>
			<input type="text" class="form-control" disabled>
		</div>
		<button class="btn btn-success">Update</button>
	</form>
<?php } ?>
<?php
	/*===================== admins ================*/
	if(isset($_POST['view_details']) && ($_POST['view_details'] == 'adm')) {
		$row_adm = get_single_data("admins", "id = '".$_POST['vid']."'");
		$ft = (!empty($_POST['vid'])) ? 'update_admin_info' : 'add_new_admin';
		$ulbl = (!empty($_POST['vid'])) ? 'disabled' : null;
		$sbval = (!empty($_POST['vid'])) ? 'Update' : 'Add';
?>
	<div class="col-md-6 col-md-offset-3 my-3">
		<form enctype="multipart/form-data" method="post" action="" >
			<input type="hidden" name="<?= $ft ?>" value="1">
			<input type="hidden" name="id" value="<?= $row_adm['id'] ?>">
			
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control" value="<?= $row_adm['username'] ?>" <?= $ulbl ?>/>
			</div>
			
			<div class="form-group">
				<label>New Password</label>
				<input type="password" name="password" class="form-control">
			</div>
			
			<div class="form-group">
				<label>Confirm New Password</label>
				<input type="password" name="password2" class="form-control">
			</div>
			
			<div class="form-group">
				<input type="submit" value="<?= $sbval ?>" class="btn btn-primary">
				<input type="reset" value="Reset" class="btn btn-danger">
			</div>
		</form>
	</div>
<?php } ?>
<?php
	/*===================== query products ================*/
	if(isset($_POST['getProducts'])) {
	$prid	= mysqli_real_escape_string($conn, $_POST['prid']);
	$sql	= "SELECT * FROM products WHERE id='".$prid."'";
	$result	= $conn->query($sql);
	if($result->num_rows == 0) exit("0");
	else {
	$row	= $result->fetch_array();
	$output  = replace_comma($row['name']).",";  //0
	$output .= replace_comma($row['brand']).",";	//1
	$output .= replace_comma($row['description']).",";	//2
	$output .= $row['price'].",";	//3
	$output .= replace_comma($row['size']).",";	//4
	$output .= str_replace(',','|',$row['colors']).",";	//5
	$output .= $row['discount'].",";	//6
	$output .= $row['item_left'].",";	//7
	$output .= $row['others'];	//8
	echo $output;
	}
	}
?>