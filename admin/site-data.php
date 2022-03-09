<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
	$dt = isset($_GET['dt']) ? $_GET['dt'] : header('Location: index.php');
	$filter = isset($_GET['filter']) ? $_GET['filter'] : 0;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$offset = ($page < 1) ? 0 : (($page*20)-20);
	switch($dt) {
		case 'msg' : $table_name='contact'; $title = 'Mailbox'; $sbis = array("All","Unseen"); $vdms = 'md';break;
		case 'odr' : $table_name='p_order'; $title = 'Orders'; $sbis = array("All","Unseen","Processing","Delivered","Cancelled"); $vdms = 'lg';break;
		case 'apr' : $table_name='products'; $title = 'All Products'; $sbis = array("All","Old uploaded","Most viewed","Discount","Low Stock"); $vdms = 'lg';break;
		case 'cls' : $table_name='users'; $title = 'Customer List'; $sbis = array("All","Old registered"); $vdms = 'lg';break;
		case 'cpn' : $table_name='coupons';  $title = 'Coupons'; $sbis = array("All","Discount","Used amount"); $vdms = 'md';break;
		case 'nws' : $table_name='newsletter'; $title = 'Subscribers'; $sbis = array("All","Old subscribed"); $vdms = 'md';break;
		case 'adm' : $table_name='admins'; $title = 'Admins'; $sbis = array("All","Old registered"); $vdms = 'md';break;
	}
?>
<?php include "includes/form-submissions.php"; ?>
<?php include "includes/header.php"; ?>
<div class="main-grid">
	<div class="panel panel-widget">
		<div class="row my-div">
			<div class="col-md-12 my-div-heading">
				<div class="dropdown pull-right">
					<button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">FILTER
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
					<?php foreach($sbis as $key=>$sbi){ ?>
						<li><a href="?dt=<?= $dt ?>&filter=<?= $key ?>&page=<?= $page ?>"><?= $sbi ?></a></li>
					<?php } ?>
					</ul>
				</div>
				<h2><?= $title ?></h2>
			</div>
			<div class="col-md-12">
			<?php if($dt=='msg'){ ?>
<!------ mailbox --------->	
				<?php switch($filter){case 1:$sort_sql="admin_read='0'";break;default: $sort_sql="1";} ?>
				<div class="mailbox">
				<?php
					$result_message = get_messages($sort_sql." ORDER BY id DESC LIMIT 20 OFFSET ".$offset);
					while($row_message = $result_message->fetch_array()) {
					switch($row_message['admin_read']) {
					case 0: $label = 'success'; $text = 'New'; break;
					case 1: $label = 'default'; $text = 'Replied'; break;
					default: $label = 'danger'; $text = 'Data Error';
					}
				?>
					<div id="mail-<?= trim($row_message['Id']) ?>" data-vid="<?= trim($row_message['Id']) ?>" class="row message">
						<div class="button-group col-md-2 col-sm-12 col-xs-12">
							<a href="?update_mail_status=1&id=<?= $row_message['Id']; ?>&value=0<?php if($row_message['admin_read']==0)echo"1"; ?>">
								<i class="fa fa-envelope-<?php if($row_message['admin_read']==1)echo"open-"; ?>o"></i>
							</a>
							<a href="#" data-reply="<?= $row_message['Email'] ?>"><i class="fa fa-reply"></i></a>
							<a href="#" data-delete="<?= $row_message['Id'] ?>"><i class="fa fa-trash-o"></i></a>
							<a href="#" data-delete="<?= $row_message['Id'] ?>"><i class="fa fa-flag-o"></i></a>
						</div>
						<div class="col-md-7 col-sm-6 col-xs-6"><?= $row_message['Name'] ; ?> &lt;<?= $row_message['Email'] ; ?>&gt;</div>
						<div class="col-md-1 col-sm-1 col-xs-1"><span class="label label-<?= $label ?>"><?= $text ?></span></div>
						<div class="col-md-2 col-sm-3 col-xs-3"><?= $row_message['date'] ; ?></div>
					</div>
				<?php } mysqli_free_result($result_message); ?>
				</div>
			<?php }else if($dt=='odr'){ ?>
<!------ orders --------->
			<?php
				switch($filter) {
				case 1: $sort_sql = "admin_read='0'"; break;
				case 2: $sort_sql = "admin_read='1'"; break;
				case 3: $sort_sql = "admin_read='2'"; break;
				case 4: $sort_sql = "admin_read='3'"; break;
				default: $sort_sql = "1";
				}
			?>
				<table class="table">
					<thead><tr><th>Order From</th><th>Description</th><th>Action</th></tr></thead>
					<tbody>
					<?php
						$result_order = get_orders($sort_sql." ORDER BY id DESC LIMIT 20 OFFSET ".$offset);
						if($result_order->num_rows > 0) {
						while($row_order = $result_order->fetch_array()) {
						if((!empty($row_order['name'])) && ($row_order['name'] != 'Guest')) {
						$row_user_info	= get_user_info("username='".$row_order['email']."'");
						$address = (!empty($row_user_info['district'])) 
						? $row_user_info['address'].", ".$row_user_info['district'].", ".$row_user_info['city']." (".$row_user_info['country'].")"
						: $row_user_info['address'].", ".$row_user_info['city']." (".$row_user_info['country'].")";
						} else {
						$row_user_info['first_name'] = "Guest"; $row_user_info['last_name'] = "";
						$row_user_info['email'] = ""; $row_user_info['mobile_number']	= $row_order['phone']; $address	= $row_order['address'];
						}
						switch($row_order['admin_read']) {
						case 0: $label = 'success'; $text = 'New'; break;
						case 1: $label = 'warning'; $text = 'Proccessing'; break;
						case 2: $label = 'primary'; $text = 'Delivered'; break;
						case 3: $label = 'default'; $text = 'Cancelled'; break;
						default: $label = 'danger'; $text = 'Data Error';
						}
					?>
					<tr id="order-<?php echo $row_order['id']; ?>">
						<td>
							<h4><?php echo $row_user_info['first_name']." ".$row_user_info['last_name'] ; ?></h4>
							<p> &nbsp; </p>
							<p><strong>Mobile:</strong> <?php echo $row_user_info['mobile_number'] ; ?></p>
							<p><?php echo $row_user_info['email'] ; ?></p>
							<span class="label label-<?= $label ?>"><?= $text ?></span>
						</td>
						<td>
							<p><strong> Order No : </strong>&nbsp; <?php echo $row_order['order_no'] ; ?> &nbsp; <strong> Order Date: </strong>&nbsp; <?php echo $row_order['date'] ; ?></p>
							<p><strong> Address: </strong>&nbsp; <?php echo $address; ?></p>
							<p><strong> Location: </strong>&nbsp; <?php echo ucwords($row_order['location']); ?></p>
							<p><strong> Shipment: </strong>&nbsp; <?php if($row_order['shipment'] == null) {echo "Normal";} else {echo $row_order['shipment'];} ?></p>
							<p><strong> Payment: </strong>&nbsp; <?php $payment = $row_order['payment']; if($payment == 'rocket') {echo 'Rocket';} else if($payment == 'bkash'){echo 'bKash';} else {echo 'Cash On Delivery';} ?></p>
							<?php if($row_order['payment'] == 'bkash') { ?>
							<p><strong>Bkash Number: </strong><?php echo $row_order['payment_number'] ; ?></p>
							<p><strong>Bkash Trxn ID: </strong><?php echo $row_order['payment_trxn_id'] ; ?></p>
							<?php } else if($row_order['payment'] == 'rocket') { ?>
							<p> Rocket Number: <strong><?php echo $row_order['payment_number'] ; ?></strong></p>
							<p> Rocket Trxn ID: <strong><?php echo $row_order['payment_trxn_id'] ; ?></strong></p>
							<?php	} ?>
							<p> &nbsp; </p>
							
							<table class="table">
								<thead><tr><th>Products</th><th>Size</th><th>Color</th><th>Quantity</th><th>Action</th></tr></thead>
								<?php
								$o_products_id 		= explode(",", $row_order['pr_id']); $o_products_size	= explode(",", $row_order['pr_size']);
								$o_products_color	= explode(",", $row_order['pr_color']); $o_products_qty		= explode(",", $row_order['pr_qty']);
								for($i = 0; $i < count($o_products_id) ; $i++) {
								$row_details	= product_details($o_products_id[$i]);
								?>
								<tr>
									<td><?= $row_details['name']; ?></td>
									<td><?= $o_products_size[$i] ?></td>
									<td><?= $o_products_color[$i] ?></td>
									<td><?= $o_products_qty[$i] ?></td>
									<td><a href="<?= $base; ?>details/boys/<?= $o_products_id[$i] ?>" target="_blank"> View </a> </td>
								</tr>
								<?php } ?>
							</table>
						</td>
						<td style="vertical-align: top;">
							Status: 
							<select class="order-status" data-order-id="<?php echo $row_order['id']; ?>">
								<option value="0" <?php if($row_order['admin_read'] == 0) echo "selected"; ?>>Unreviewed</option>
								<option value="1" <?php if($row_order['admin_read'] == 1) echo "selected"; ?>>Proccessing</option>
								<option value="2" <?php if($row_order['admin_read'] == 2) echo "selected"; ?>>Delivered</option>
								<option value="3" <?php if($row_order['admin_read'] == 3) echo "selected"; ?>>Cancelled</option>
							</select>
							<p> &nbsp; </p>
							<p><a href="order-invoice.php?orderno=<?php echo $row_order['order_no'] ; ?>" target="_blank"><i class="fa fa-print"></i> Print Invoice</a></p>
							<p><a href="#" data-delete="<?= $row_order['id']; ?>"><i class="fa fa-times"></i> Delete</a></p>
						</td>
					</tr>
					<?php }} else { ?>
						<tr><td colspan="6" class="text-center bg-danger text-light">No data found!</td></tr>
					<?php } mysqli_free_result($result_order); ?>
					</tbody>
					</tbody>
				</table>
				<script>$('.order-status').on('change',function(){var value=$(this).val();var id=$(this).attr('data-order-id');window.location="?update_order_status=1&id="+id+"&value="+value;});</script>
			<?php }else if($dt=='apr'){ ?>
<!------ all products --------->
				<?php
					switch($filter) {
					case 1: $sort_sql = "1 ORDER BY id ASC "; break;
					case 2: $sort_sql = "1 ORDER BY views DESC "; break;
					case 3: $sort_sql = "1 ORDER BY discount DESC "; break;
					case 4: $sort_sql = "1 ORDER BY item_left ASC "; break;
					default: $sort_sql = "1 ORDER BY id DESC";
					}
				?>
				<table class="table">
					<thead><tr><th>#</th><th>Id</th><th>Title</th><th>Price</th><th>Category</th><th width="16.6666%">Action</th></tr></thead>
					<tbody>
					<?php
						$result_products = get_some_data("products", $sort_sql." LIMIT 20 OFFSET {$offset}");
						if($result_products->num_rows > 0) {
						while($row_pr = $result_products->fetch_array()) {
						$primg = (!empty($row_pr['colors'])) ? "../proimg/".$row_pr['id']."/".explode(",", $row_pr['colors'])[0]."1.jpg" :  "../proimg/".$row_pr['id']."/1.jpg";
					?>
						<tr>
							<td><img src="<?= $primg ?>" class="img-fluid img-thumbnail" style="max-height: 70px;" /></td>
							<td>#<?= $row_pr['id'] ?></td>
							<td><?= $row_pr['name'] ?></td>
							<td>Tk <?= ($row_pr['others']==2) ? $caretRate*$row_pr['price']: $row_pr['price']; ?></td>
							<td><?= $row_pr['category'] ?> - <?= $row_pr['subcategory'] ?></td>
							<td class="td-actions">
								<a href="<?= '../details/'.restyle_url($row_pr['category']).'/'.restyle_url($row_pr['id']) ?>" target="_blank" class="btn btn-primary btn-sm">
									<i class="fa fa-eye"></i> View Details
								</a><br/>
								<a href="update-product.php?edit=<?= restyle_url($row_pr['id']) ?>" class="btn btn-link btn-info btn-sm"><i class="fa fa-pencil"></i></a>
								<button type="button" class="btn btn-link btn-danger btn-sm" data-delete="<?= $row_pr['id'] ?>"><i class="fa fa-times"></i></button>
							</td>
						</tr>
					<?php }} else { ?>
						<tr><td colspan="6" class="text-center bg-danger text-light">No data found!</td></tr>
					<?php } mysqli_free_result($result_products); ?>
					</tbody>
				</table>
			<?php }else if($dt=='cls'){ ?>
				<?php switch($filter){case 1:$sort_sql="1 ORDER BY id ASC";break;default: $sort_sql="1 ORDER BY id DESC";}?>
				<table class="table">
					<thead class="text-primary"><tr><th>#</th><th>Customer Info</th><th>Address</th><th width="25%">Action</th></tr></thead>
					<tbody>
					<?php
						$result_users = get_some_data("users", $sort_sql);
						if($result_users->num_rows > 0) {
							while($row_us = $result_users->fetch_array()){
					?>
						<tr class="ppot">
							<td><img src="images/avatar.png" class="img-responsive" style="max-height: 80px" /></td>
							<td class="customer-info">
								<h4><?= $row_us['first_name']." ".$row_us['last_name'] ?></h4>
								<p class="text-muted"><i class="fa fa-envelope"></i> &nbsp; <?= $row_us['email'] ?></p>
								<p class="text-muted"><i class="fa fa-phone"></i> &nbsp; <?= $row_us['mobile_number'] ?></p>
							</td>
							<td><?= $row_us['address'] ?></td>
							<td class="td-actions">
								<button type="button" class="btn btn-primary btn-sm" data-vid="<?= $row_us['id'] ?>">
									<i class="fa fa-eye"></i> View Details
								</button>
								<button type="button" class="btn btn-info btn-link btn-sm" data-reply="<?= $row_us['email'] ?>">
									<i class="fa fa-paper-plane-o"></i>
								</button>
								<button type="button"  class="btn btn-danger btn-link btn-sm" data-delete="<?= $row_us['id'] ?>">
									<i class="fa fa-times"></i>
								</button>
							</td>
						</tr>
					<?php
							}
						} else {
					?>
						<tr><td colspan="4" class="text-center bg-danger">No data found!</td></tr>
					<?php
						}
						mysqli_free_result($result_users)
					?>
					</tbody>
				</table>
			<?php } else if($dt == 'adm'){ ?>
				<?php switch($filter){case 1:$sort_sql="1 ORDER BY id ASC";break;default: $sort_sql="1 ORDER BY id DESC";} ?>
				<table class="table">
					<thead><tr><th>Id</th><th>Username</th><th>Date Added</th><th style="width: 15%;">Action</th></tr></thead>
					<tbody>
				<?php
					$result_admins = get_some_data('admins', $sort_sql." LIMIT 20 OFFSET ".$offset);
					while($row_admins = $result_admins->fetch_array()) {
				?>
						<tr class="ppot">
							<td><?= $row_admins['id'] ?></td>
							<td><?= $row_admins['username'] ?></td>
							<td><?= $row_admins['date_added']; ?></td>
							<td class="td-actions">
								<button type="button" class="btn btn-info btn-link" data-vid="<?= $row_admins['id'] ?>">
									<i class="fa fa-pencil"></i>
								</button>
							<?php if($row_admins['Token'] != $_COOKIE['user']){ ?>
								<a href="#" data-delete="<?= $row_admins['id'] ?>" class="btn btn-danger btn-link"><i class="fa fa-times"></i></a>
							<?php } ?>
							</td>
						</tr>
				<?php
					}
					mysqli_free_result($result_admins);
				?>
					</tbody>
				</table>
				<div class="text-center my-2"><button class="btn btn-success" data-vid=""><i class="fa fa-plus"></i> Add New</button></div>
			<?php } ?>
				<nav><ul class="pagination justify-content-end"><?= get_paging(get_total_rows($table_name, $sort_sql), 20, $page, "?dt=".$dt."&filter=".$filter."&") ?></ul></nav>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="replyModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Reply</h4>
			</div>
			<div class="modal-body">
				<form id="" action="" method="post">
					<input type="hidden" name="send_mail" value="1"/>
					<div class="row">
						<div class="form-group col-md-6 col-sm-6 col-xs-12">
							<label>Email</label>
							<input type="text" name="email" class="form-control" id="reply-input" required />
						</div>
						<div class="form-group col-md-6 col-sm-6 col-xs-12">
							<label>Subject</label>
							<input type="text" name="subject" class="form-control" value="Reply mail from <?php echo htmlspecialchars($companyName); ?>" required />
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<label>Message</label>
							<textarea name="message" rows="5" class="form-control" id="field-1-4" required></textarea>
						</div>
					</div>
					
					<div class="row">
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<input type="submit" name="submit" value="Send" class="btn btn-success"/>
							<input type="reset" value="Reset" class="btn btn-warning"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/__ds_confirm_ation.js"></script>
<script type="text/javascript" src="js/summernote.js"></script>
<script>
	$(document).ready(function(){
		$('#field-1-4').summernote({height: 200,tabsize: 3});
		$('.button-group').click(function(e){e.stopPropagation()});
		$('[data-reply]').click(function(){
			var reply_to	= $(this).data('reply');
			if(reply_to) {
				$('#reply-input').val(reply_to);
				$('#replyModal').modal('show');
			} else ds.showNotification('bottom','right','danger','warning', 'Sender email is empty');
		});
		$('[data-vid]').click(function(){
			var vid = $(this).data("vid");
			var data = {view_details: '<?= $dt ?>', vid: vid};
			$('.site-msg').addClass('show msg-loading');
			$.ajax({
				type: 'POST', url: 'ajax.php', data: data,
				success: function(data) {
					$('.site-msg .sm-cajax').html(data);
					$('.site-msg').removeClass('msg-loading');
				}
			});
		});
		$('[data-delete]').confirmation({
			rootSelector: '[data-delete]',
			onConfirm: function(value) {
				var button = $(this); var table = "<?= $table_name ?>"; var id = button.data("delete");
				button.closest(".ppot").fadeOut();
				$.ajax({
					type: 'POST', url: 'ajax.php', data: {del_data: 1, table: table, id: id},
					success: function(data) {
						ds.showNotification('bottom','right','success','delete_forever', data);
					}
				});
			},
			content: "This might lost your data",
			singleton: true,
			buttons: [{
					class: 'btn btn-success',
					label: 'Continue'
				},{
					class: 'btn btn-warning',
					label: 'Stoooop!',
					cancel: true
				}
			]
		});
		$('.site-msg .sm-cheader .fa-times').on('click', function(){
			$('.site-msg').removeClass('show');
			$('.site-msg .sm-cajax').html('');
		});
		$('.site-msg .sm-cheader .fa-window-maximize').on('click', function(){
			$('.site-msg').toggleClass('fullscreen');
			$(this).toggleClass('fa-window-restore ');
		});
		if(window.location.hash) {
			var hash = window.location.hash.substring(1);
			$('#'+hash).addClass('bgBlinking');
			window.location.hash = '';
		}
	});
</script>
<?php include "includes/footer.php"; ?>