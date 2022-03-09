<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
	$boot3 = true;
?>
<?php include "doc/includes/header.php"; ?>
	<style>.fade.in {opacity:1!important;}</style>
	<div id="checkout">
		<div class="container">
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<div id="mainContentWrapper">
						<section class="panel panel-default">
							<div class="clearfix">
								<div class="steps">
									<ul class="">
										<li>Checkout<span class="chevron"></span></li>
										<li class="active"><a data-toggle="tab" href="#co-login" id="menu1-btn"><span class="badge badge-success">1</span>Your Information<span class="chevron"></span></a></li>
										<li class="disabled"><a data-toggle="tab" href="#co-order-summery" id="menu2-btn"><span class="badge badge-info">2</span>Review Your Order<span class="chevron"></span></a></li>
										<li class="disabled"><a data-toggle="tab" href="#co-payment-information" id="menu3-btn"><span class="badge">3</span>Payment &amp; Comfirm</span></a></li>
									</ul>
								</div>
							</div>
						</section>

						<section class="panel panel-default tab-content mainContentpanel">
							<div id="co-login" class="tab-pane fade in active">
							<?php if(!isset($_COOKIE['clt'])){ ?>
								<!--Not Logged In-->
								<div class="row not-logged-in">
									<div class="col-md-6 offset-md-3 checkout-login checkout-login-left">
										<div class="limlog-form">
											<h4 class="title">login with <?php echo $companyName; ?> </h4>
											<form action="#" method="post" id="loginForm">
												<input type="hidden" name="login" />
												<input type="hidden" name="ref_page" value="checkout" />
												
												<label>Username</label>
												<input type="text" name="username" placeholder="Username" required />
												
												<label>Password</label>
												<input type="password" name="password" placeholder="Password" required />
												
												<a href="#" class="pass">Forgot Password ?</a>
												<input type="submit" value="LogIn" />
											</form>
											<a href="register" class="newacc">Create New Account</a>
										</div>
									</div>
								</div>
							<?php 
								} else {
									$result_user	= get_user_info($_COOKIE['clt']);
									if($result_user->num_rows ==1) {
										$row_user	= $result_user->fetch_array();
									} else {
										setcookie("clt", null, time() - 3600, "/");
										header("Location: ".$base."checkout");
									}
								?>
								<!--Logged In-->
								<div class="row logged-in">
									<div class="col-md-6 offset-md-3">
										<div class="login-check"><i class="fa fa-check"></i></div>
										<div class="limlog-form">
											<h3>you are logged in with <?php echo $row_user['last_name']; ?></h3>
											<table class="" border="0">
												<tr><td>Your Email Address:</td><td><?php echo $row_user['email']; ?></td></tr>
												<tr><td>Your Mobile Number:</td><td><?php echo $row_user['mobile_number']; ?></td></tr>
												<tr><td>Your Full Address: </td><td><?php echo $row_user['address']; ?>, <?php echo $row_user['district']; ?>, <?php echo $row_user['city']; ?></td></tr>
												<tr><td colspan="2"><a href="logout?ref_page=checkout">Not You ? Login Again</a> </td></tr>
											</table>
										</div>
									</div>
									<a class="next second-tab-btn" href="javascript:void(0)">Conitinue To Order Summery</a>
								</div>
								<script>userToken='<?= addslashes($_COOKIE['clt']) ?>'; orderLocation='<?= addslashes($row_user['city']) ?>'; mobileNumber=null; fullAddress=null;</script>
							<?php } ?>
							</div>
							
							<div id="co-order-summery" class="tab-pane fade">
								<div class="order-summery">
									<div class="flex">
										<div class="order-summery-tab-1">
											<h3>Product Total</h3>
											<p>Total In Cart : <?= cart_total(); ?> item</p>
											<p>Total Amount : <?= $currency ?> <span id="_cart_twd"><?= get_cart_information("total_without_discount"); ?></span></p>
										</div>
										<div class="order-summery-tab-1">
											<h3>Delivery Cost</h3>
											<p>Delivery Location: <span id="_cart_dl"></span></p>
											<p>Delivery Charge: <?= $currency ?> <span id="_cart_dc" data-dcd="<?= $dCost['dhaka'] ?>" data-dco="<?= $dCost['other'] ?>"></span></p>
										</div>
									</div>									
									<div class="row">
										<div class="col-md-6 offset-md-3 order-total">
											<h4>Order Total</h4>
											<h3><span><?= $currency ?> <span id="_cart_odr_ttl"></span></span></h3>
										</div>
									</div>
								</div>
								
								<a class="previous has-next first-tab-btn" href="#"> Go Back </a>
								<a class="next has-previous third-tab-btn" href="#"> Conitinue To Payment</a>
							</div>
							<div id="co-payment-information" class="tab-pane fade">
								<div class="payment-information">
									<div class="flex">
										<label class="radio-inline">
											<h3>Cash On Delivery</h3>
											<p>Select if you want to make payment with Cash on delivery. </p>
											
											<input class="form-check-input" type="radio" name="payment_type" value="cod" checked>
											<span class="checkmark"></span>
										</label>
										<label class="radio-inline">
											<h3>bKash</h3>
											<p>Make a payment to our bKash/Rocket merchant number. Save the transaction number obtained from the bKash/Rocket. And enter the input below.</p>
											
											<input class="form-check-input" type="radio" name="payment_type" value="bkash">
											<span class="checkmark"></span>
										</label>
										<label class="radio-inline">
											<h3>Rocket</h3>
											<p>Make a payment to our bKash/Rocket merchant number. Save the transaction number obtained from the bKash/Rocket. And enter the input below.</p>
											
											<input class="form-check-input" type="radio" name="payment_type" value="rocket">
											<span class="checkmark"></span>
										</label>
									</div>
									
									<div class="row">
										<div class="col-md-6 offset-md-3 get-transaction-id">
											<div class="limlog-form">
												<h4 class="title"><span id="payment-type"></span> Payment</h4>
												
												<label>Your <span id="payment-type"></span> Account Number</label>
												<input type="text" name="account_number" placeholder="Enter Account Number..." required/>
												
												<label><span id="payment-type"></span> Transaction Id</label>
												<input type="text" name="transaction_id" placeholder="Enter Transaction Id..." required />
											</div>
										</div>
									</div>
								</div>
								<a class="next submit-order" href="#">Place Order</a>
							</div>
						</section>
					</div>
				</div>
			</div>	
		</div>
	</div>
<?php include "doc/includes/footer.php"; ?>