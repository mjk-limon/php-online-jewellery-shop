<?php
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
	$today = date("d-m-Y");
	$orderno = (isset($_GET['orderno'])) ? $_GET['orderno'] : exit(header('Location: index'));
	if(!is_numeric($orderno)) exit("{$orderno}");
	$row_oi = get_single_data("p_order", "order_no = '{$orderno}'");
	if(empty($row_oi['order_no'])) exit(header("Location: index"));
	if(!empty($row_oi['name']) && $row_oi['name'] != 'Guest') {
		$userinfo = get_single_data("users", "username = '{$row_oi['email']}'");
		$name = $userinfo['first_name'].' '.$userinfo['last_name'];
		$mobile = $userinfo['mobile_number']; $email = $userinfo['email'];
		$address = $userinfo['address'].', '.$userinfo['district'].', '.$userinfo['city'];
		$location = $userinfo['district']; 
	} else {
		$name = $row_oi['name']; $mobile = $row_oi['phone'];
		$email = $row_oi['email']; $address = $row_oi['address'];
		$location = (strtolower($row_oi['location'])=='dhaka') ? "Inside Dhaka" : "Outside Dhaka"; 
	}
	$shipment = $row_oi['shipment'];
	switch($row_oi['payment']) {
		case 'bkash': $payment="Bkash"; break;
		case 'rocket': $payment="Rocket"; break;
		default: $payment="Cash On Delivery";
	}
	$payment_number = $row_oi['payment_number'];
	$payment_trid = $row_oi['payment_trxn_id']; $pr_id = $row_oi['pr_id'];
	$pr_size = $row_oi['pr_size']; $pr_qty = $row_oi['pr_qty'];	$pr_color = $row_oi['pr_color'];
	if(!isset($currencyRate)) $currencyRate = array("BDT" => 1);
	$dcharge = (strtolower($location)=="dhaka" || $location=="Inside Dhaka") ? $dCost['dhaka'] : $dCost['other']; 
?>
<?php include "doc/includes/header.php"; ?>
	<div id="thank-you">
		<div class="container">
			<div class="top-content">
				<h2 class="successfull"> Successfully Posted Your Order! </h2> 
				<p>Thank you so much for ordering us. Our representative will confirm the order by contacting you within the maximum 24 hours. If your order no. <?php echo $orderno; ?> is confirmed then we will reach your product within the maximum 3 days. You can also review the product if you want to verify it.</p>
				<p><?= $companyName ?> always considers the quality of the product and its acceptability to the customer. In that continuation, we promise you always good products. Even then, if the product is broken / damaged / bad, or if the quality is not expected, then we request you to let us know within 24 hours of receiving the product. </p>
			</div>
			<div class="your-data">
				<h3><span class="p-title"> YOUR DATA </span></h3>
				<div class="row background-white">
					<div class="col-md-6 col-md-offset-3">
						<table border="0" class="">
							<tbody>
								<tr><td>Name</td><td>:</td><td><?= $name ?></td></tr>
								<tr><td>Mobile Number</td><td>:</td><td><?= $mobile ?> </td></tr>
								<tr><td>Email</td><td>:</td><td><?= $email ?> </td></tr>
								<tr><td>Address</td><td>:</td><td><?= $address ?></td></tr>
								<tr><td>Location</td><td>:</td><td><?= $location ?></td></tr>
								<tr><td>Delivery</td><td>:</td><td><?= $shipment ?></td></tr>
								<tr><td>Payment Type</td><td>:</td><td><?= $payment ?></td></tr>
							<?php if($payment=='Bkash'){ ?>
								<tr><td> bKash Number</td><td>:</td><td><?= $payment_number ?></td> </tr>
								<tr><td> Transaction ID</td><td>:</td><td><?= $payment_trid ?></td> </tr>
							<?php } else if($payment=='Rocket') { ?>
								<tr><td>Rocket Number</td><td>:</td><td> <?= $payment_number ?></td> </tr>
								<tr><td>Transaction ID</td><td>:</td><td> <?= $payment_trid ?></td> </tr>
							<?php	}	?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="your-bill">
				<h3><span class="p-title">YOUR BILL</span></h3> 
				<p><span class="invoice-print" onclick="window.print()"><i class="fa fa-download"></i> Download PDF |  </span><span class="invoice-print" onclick="window.print()"><i class="fa fa-print"></i> Print</span></p> 
				
				<div class="row background-white">
					<div class="invoice">
						<img src="images/logo.png" class="_invoice_watermark">
						<div class="row invoice-top">
							<div class="col-md-3 col-sm-3 col-xs-3">
								<img src="images/logo.png">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 tagline">
								<h2 class="company-name"><?= $companyName; ?></h2>
								<div class="separator"></div>
								<p class="company-address"><?= get_contact_information('address'); ?></p>
								<p class="company-contact"><?= get_contact_information('mobile1'); ?> | <?= get_contact_information('email'); ?></p>
							</div>
							<div class="col-md-3 col-sm-3 col-xs-3 qr">
								<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?php echo urlencode($base); ?>&choe=UTF-8" />
							</div>
						</div>
						<div class="row invoice-middle">
							<div class="col-md-12 invoice-id">
								<h1>INVOICE</h1>
								<div class="separator"></div>
								<h3>#<?= $orderno ?></h3>
							</div>
							<div class="clearfix"></div>
							<div class="col-md-6 col-sm-6 col-xs-6 invoice-info">
								<table border="0">
									<tr><td>Issue Date</td><td>:</td><td><?php echo date("d-m-Y H:iA") ?> </td></tr>
									<tr><td>Currency</td><td>:</td><td> <?php echo $currency; ?> </td></tr>
									<tr><td>Net</td><td>:</td><td> <?php echo $currencyRate[$currency]; ?> </td></tr>
									<tr><td>Delivery Type</td><td>:</td><td>Normal</td></tr>
									<tr><td>Payment Type</td><td>:</td><td><?= $payment ?></td></tr>
								</table>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6 invoice-bill-to">
								<p><u>Bill To: </u></p>
								<p><strong><?= htmlspecialchars($name) ?></strong></p>
								<p><?= htmlspecialchars($address) ?></p>
								<p>Delivery Location: <?= htmlspecialchars($location) ?></p>
								<p><?= htmlspecialchars($mobile) ?></p>
								<p><?= htmlspecialchars($email) ?></p>
							</div>
						</div>
						<div class="row invoice-table">
							<div class="col-md-12">
								<table border="0" class="itemLists">
									<thead>
										<tr>
											<th>#</th>
											<th style="width:55%">Description</th>
											<th>Quantity</th>
											<th>Unit Price</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$prids = explode(',' , $pr_id); $qty = explode(',' , $pr_qty);
										$size = explode(',' , $pr_size); $color = explode(',' , $pr_color);
										$subtotal		= 0;
										for($i = 0;$i < count($prids);$i++) {
										$row_details	= details_page($prids[$i]);
										$unit_price = ($row_details['others'] == 2) ? $caretRate * $row_details['price'] : $row_details['price'];
										$pr_total = $unit_price*$qty[$i];
										$subtotal	= $subtotal+$pr_total;
									?>
										<tr>
											<td><?= $i+1 ;?> </td>
											<td>
												<p class="ipnaid ipname"><?= htmlspecialchars($row_details['name'])?></p>
												<p class="ipnaid">
													ID: <?= $row_details['id'] ?><?php if($size[$i]!='N/A') echo ', Size: '.$size[$i] ?><?php if($color[$i]!='N/A') echo ', Color: '.ucfirst($color[$i]) ?>
												</p>
											</td>
											<td><?= $qty[$i] ?></td>
											<td><?= $unit_price ?></td>
											<td><?= $currency.' '.$pr_total ?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
								<table class="itemTotal" border="0">
									<tr><td>Total</td><td><?php echo $currency.' '.$subtotal ?></td></tr>
									<tr><td>Delivery Cost</td><td><?php echo $currency.' '.$dcharge ?></td></tr>
									<tr class="subtotal"><td>Subtotal</td><td><?= $currency ?> <?= $subtotal+$dcharge ?></td></tr>
								</table>
								<div class="clearfix"></div>
								
								<div class="separator"></div>
								<div class="payment-info">
									Payment Details: <?= $payment ?>
									<?php if($payment == 'Bkash' || $payment == 'Rocket') { ?>
									, Number: <?= $payment_number ?> 
									, Trxn ID: <?= $payment_trid ?>
									<?php } ?>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>			
		</div>
	</div>
<?php include "doc/includes/footer.php"; ?>