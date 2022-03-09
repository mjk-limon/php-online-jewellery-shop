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
		exit(header('Location: login?emsg='.urlencode("Invalid token or user deleted !")));
	}
?>
<?php include "doc/includes/header.php"; ?>
<style>
	.dailysell{width:85%;background-color:#c5b358;font-size:15px;color:#fff;text-align:center;padding:8px 0}
	.single-wishlist{box-shadow:#ccc 0 0 2px;background:rgba(255,255,255,0.7);margin-top:10px;margin-bottom:15px;padding:5px 10px}
	.orderHistory-title{padding:5px 2px}
	.orderHistory-title p{font-size:13px;width:50%;float:left}
	table.orderHistory-table td img{width:40px;vertical-align:top;margin-right:5px}
</style>
<div class="limon-login">
	<div class="wrapper inner-page">
		<div class="main">
			<div class="registration_left">
				<h2 class="text-center">Welcome, <?php echo $row_user['last_name']; ?></h2>
				<div class="registration_form">
					<div class="col-md-8 offset-md-2 login-area">
					<?php 
						$result_orderHistory	= get_order_history($row_user['email']);
						if($result_orderHistory->num_rows > 0) {
					?>
						<div class="secendslider">
							<div class="col-md-4">
								<div class="dailysell"> My Order History </div>
							</div>
							<div class="clearfix"></div>
						<?php
							while($row_orderHistory = $result_orderHistory->fetch_array()) {								
							switch($row_orderHistory['admin_read']) {
							case 0: $status	= 'Not Seen Yet'; break;
							case 1: $status	= 'Order Is Processing'; break;
							case 2: $status	= 'Order Delivered'; break;
							case 3: $status	= 'Cancelled'; break;
							default: $status = ''; break;
							}
						?>
							<div class="single-wishlist">									
								<div class="col-md-12">
									<div class="orderHistory-title">
										<p><strong>Order No:</strong> <?php echo $row_orderHistory['order_no']; ?></p>
										<p><strong>Ordering Date:</strong> <?php echo $row_orderHistory['date']; ?></p>
										<p><strong>Payment Type:</strong> Cash On Delivery</p>
										<p>
											<strong>Status:</strong> <span style="color: red;"><?php echo $status; ?></span> 
										</p>
										<div class="clearfix"></div>
									</div>
									
									<table class="table orderHistory-table" style="border: 1px solid #ddd;">
										<tr class="warning">
											<th> Product Name </th>
											<th> Size </th>
											<th> Color </th>
											<th> Quantity </th>
											<th> Action </th>
										</tr>
										<?php
											$o_products_id 		= explode(",", $row_orderHistory['pr_id']);
											$o_products_size	= explode(",", $row_orderHistory['pr_size']);
											$o_products_color	= explode(",", $row_orderHistory['pr_color']);
											$o_products_qty		= explode(",", $row_orderHistory['pr_qty']);
											$o_products_num = count($o_products_id) ;
											for($i = 0; $i < $o_products_num ; $i++) {
											$row_details	= details_page($o_products_id[0]);
											$ava_color		= $row_details['colors'];
											$ava_colors		= explode(',', $ava_color);
										?>
										<tr>
											<td> 
												<img src="proimg/<?php echo $row_details['id'] ?>/<?php echo $ava_colors[0] ?>1.jpg" alt="<?php echo $row_details['id'] ?>/<?php echo $ava_colors[0] ?>-1.jpg" />
												<?php echo $row_details['name'] ?> 
											</td>
											<td> <?php echo $o_products_size[$i] ?> </td>
											<td> <?php echo $o_products_color[$i] ?> </td>
											<td> <?php echo $o_products_qty[$i] ?> </td>
											<td> <a href="<?php echo $base; ?>details/boys/<?php echo $o_products_id[$i] ?>" target="blank"> Details </a> </td>
										</tr>
										<?php } ?>
									</table>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php
							}
							mysqli_free_result($result_orderHistory);
						?>
						</div> 
					<?php } else { ?>
						<div class="no-products">
							<h4> Order History Is Empty ! </h4>
							<ul>
								<li>You have no product in your order history </li>
								<li>Please go back. And order first</li>
								<li>For any help, Please contact our help center</li>
							</ul>
						</div>
					<?php	 } ?>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php include "doc/includes/footer.php"; ?>