<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
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
<!doctype thml>
<html>
	<head>
		<title>Invoice Id : <?php echo $orderno; ?></title>
		<link rel="stylesheet" href="css/_ds_adm_boot.css" />
		<style>
			#thank-you{background-color:#f9f8f8}
			#thank-you h2.successfull{text-align:center;margin:2em 0;font-size:26px;color:#fdb90b;text-shadow:1px 1px 1px #666}
			#thank-you span.p-title{text-align:center;margin:1.5em 0;background-color:#fdb90b;color:#f9f8f8;font-size:20px;padding:.3em .6em;display:inline-block}
			#thank-you .separator{height:10px}
			#thank-you .row.background-white{background:#fff;border:1px solid #fdb90b;padding:.5em}
			#thank-you .your-data,#thank-you .your-bill{text-align:center}
			#thank-you .your-data table{width:100%;border-collapse:collapse;border-spacing:0;border:0}
			#thank-you .your-data table tr td{padding:2px;font-size:12px;text-align:left;color:#666}
			#thank-you .your-bill p{text-align:right}
			#thank-you .your-bill .invoice-print{color:#333;text-decoration:underline;font-size:14px;font-family:'Times New Roman';cursor:pointer}
			#thank-you .invoice{position:relative;width:8.268in;height:11.693in;margin:50px auto;text-align:left;padding:50px 65px;box-shadow:0 0 20px #ccc}
			#thank-you .invoice ._invoice_watermark{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:50%;filter:opacity(.04)}
			#thank-you .invoice-top img{max-width:100%;height:100px}
			#thank-you .invoice-top .tagline h2.company-name{margin:0;font-weight:700;font-size:28px;line-height:1em;text-transform:none}
			#thank-you .invoice-top .tagline p{text-align:left;color:#888;font-size:14px;margin-bottom:0;line-height:1.2em}
			#thank-you .invoice-top .qr{text-align:right}
			#thank-you .invoice-top .qr img{border:1px solid #e7e7e7}
			#thank-you .invoice-middle .invoice-id{margin-top:60px;margin-bottom:40px}
			#thank-you .invoice-middle h1{font-size:50px;font-family:'impact';color:#396E00;line-height:50px}
			#thank-you .invoice-middle .invoice-info table{width:auto;border-collapse:collapse;border-spacing:0}
			#thank-you .invoice-middle .invoice-info table tr td{padding:1px 3px}
			#thank-you .invoice-middle .invoice-bill-to p{text-align:left;margin-bottom:2px;font-size:14px;color:#000}
			#thank-you .invoice-table .itemLists{width:100%;border-collapse:collapse;border-spacing:0;margin-top:40px;font-size:14px}
			#thank-you .invoice-table .itemLists td,#thank-you .invoice-table .itemLists th{padding:10px}
			#thank-you .invoice-table .itemLists thead tr{border-bottom:2px solid #aaa;color:#333;font-weight:600}
			#thank-you .invoice-table .itemLists tbody tr{border-bottom:1px solid #ccc;color:#333;font-weight:500}
			#thank-you .invoice-table .itemLists td p.ipnaid{font-size:11px;color:#333;text-align:left;margin-bottom:0}
			#thank-you .invoice-table .itemLists td p.ipnaid.ipname{font-weight:600;font-size:13px}
			#thank-you .invoice-table .itemTotal{width:35%;border-collapse:collapse;border-spacing:0;margin-top:10px;font-size:14px;float:right;color:#333}
			#thank-you .invoice-table .itemTotal tr.subtotal{color:#396E00;border-top:2px dotted #aaa;font-size:16px}
			#thank-you .invoice-table .itemTotal tr td{padding:5px}
			#thank-you .invoice-table .payment-info{color:#888;font-size:12px;margin-top:20px;width:100%;font-weight:400}
			@media print {
				body *{visibility:hidden}
				@page{size:auto;margin:0}
				.invoice,.invoice *{visibility:visible}
				.invoice{width:100%;position:absolute;left:0;top:0}
			}
		</style>
		<script>window.onload = window.print();</script>
	</head>
	<body>
		<div id="thank-you">
			<div class="container your-bill">				
				<div class="row background-white">
					<div class="col-md-12">
						<p><span class="invoice-print" onclick="window.print()"><i class="fa fa-print"></i> Print</span></p> 
						<div class="invoice">
							<img src="../images/logo.png" class="_invoice_watermark">
							<div class="row invoice-top">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<img src="../images/logo.png">
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 tagline">
									<h2 class="company-name"><?= $companyName; ?></h2>
									<div class="separator"></div>
									<p class="company-address"><?= get_contact_information('address'); ?></p>
									<p class="company-contact"><?= get_contact_information('mobile1'); ?> | <?= get_contact_information('email'); ?></p>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-3 qr">
									<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?= urlencode($base) ?>&choe=UTF-8" />
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
										<tr><td>Issue Date</td><td>:</td><td><?= date("d-m-Y H:iA") ?> </td></tr>
										<tr><td>Currency</td><td>:</td><td> <?= $currency; ?> </td></tr>
										<tr><td>Net</td><td>:</td><td> <?= $currencyRate[$currency]; ?> </td></tr>
										<tr><td>Delivery Type</td><td>:</td><td>Normal</td></tr>
										<tr><td>Payment Type</td><td>:</td><td><?= $payment ?></td></tr>
									</table>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 invoice-bill-to">
									<p><u>Bill To: </u></p>
									<p><strong><?= $name ?></strong></p>
									<p><?= $address ?></p>
									<p>Delivery Location: <?=$location ?></p>
									<p><?= $mobile ?></p>
									<p><?= $email ?></p>
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
											$row_details	= product_details($prids[$i]);
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
	</body>
</html>