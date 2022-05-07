<?php
include "doc/includes/config.php";
require_once "doc/includes/functions.php";
?>
<?php
$prid	= isset($_GET['prid']) ? get_url_variables($_GET['prid']) : exit();
$main	= isset($_GET['main']) ? get_url_variables($_GET['main']) : null;
$row_details	= 	details_page($prid);
$product_name = $row_details['name'];
$page_name = 'details-page';
$pr_price = $row_details['price'];
$pr_discount_tk = $pr_price * ($row_details['discount'] / 100);
$price_after_discount = $pr_price - $pr_discount_tk;
?>
<?php include "doc/includes/header.php"; ?>
<div class="container">
	<?php if (empty($row_details)) { ?>
		<div class="alert alert-danger text-center">
			<strong>Product Not Found!</strong> Invalid Product Id Or Product Deleted! Go Back To <a href="index" class="alert-link">Home Page</a>.
		</div>
	<?php } else {	?>
		<div class="row details-page-box mt-3">
			<div class="col-md-5 single-top-left">
				<div class="flexslider">
					<ul class="slides">
						<?php
						$images = $row_details['images'];
						$ava_images = explode(',', $images);
						for ($j = 1; $j <= $ava_images[0]; $j++) {
						?>
							<li data-thumb="proimg/<?= $row_details['id']; ?>/<?= $j; ?>.jpg">
								<div class="thumb-image detail_images" id="slides">
									<img src="proimg/<?= $row_details['id']; ?>/<?= $j; ?>.jpg" data-imagezoom="true" class="img-responsive" style="width:100%">
								</div>
							</li>
						<?php } ?>

						<div class="clearfix"></div>
					</ul>
				</div>
			</div>
			<div class="col-md-5 single-top-right">
				<div class="row cart-title-top">
					<div class="col-md-12 cart-product-name">
						<h2 class="p-name"><?= $row_details['name'] ?></h2>
						<small>By <?= $row_details['brand'] ?></small>
						<p class="p-price"><?= $currency ?> <?= $price_after_discount ?></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php
						$ava_size	= $row_details['size'];
						if (!empty($ava_size)) {
							$ava_size	= explode(',', $ava_size);
						?>
							<ul class="p-available-size">
								<p>Size</p>
								<?php foreach ($ava_size as $row_ava_size) { ?>
									<li class="prsize-btn" data-size="<?= $row_ava_size ?>"><?= $row_ava_size ?></li>
								<?php }	?>
							</ul>
							<script>
								hasSize = true;
								$('.prsize-btn').click(function() {
									pr_size = $(this).attr('data-size');
									$('.prsize-btn').each(function() {
										$(this).css('background', '#fff');
									});
									$(this).css('background', '#d6d6d6');
								});
							</script>
						<?php } ?>
					</div>
					<div class="col-md-6 col-sm-12">
						<div class="row call-for-order">
							<div class="col-md-12">
								<div class="call-box">
									<div class="call-icon">
										<i class="fa fa-phone" aria-hidden="true"></i>
									</div>
									<div class="call-number">
										<p class="cn-title">Call for Order</p>
										<p class="cn-number"><?php echo get_contact_information('mobile1') ?></p>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p class="freeora" id="item_alert" style="display: block; width: 100%; color: red;"></p>
						<ul class="p-quantity">
							<li>
								<ul class="quantity-nav">
									<li class="item_minus">-</li>
									<li class="item_qty" data-value="1"><input type="text" value="1" class="item_qty_input" onkeyup="keyUpQty(this.value)" /></li>
									<li class="item_plus">+</li>
								</ul>
							</li>
							<img src="images/no-stock.png" alt="No Stock" id="no-stock" style="width: 150px;display: none;" />
							<li class="add-to-cart"><a href="#">BUY NOW</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 syn-payment-methods">
						<h3 class="payment-methods-heading">Payment Methods</h3>
						<p class="freeora1">Card/Cash on delivery</p>
						<p class="freeora1">bKash/Online payment</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<ul class="share">
							<p class="shareli">Share on:</p>
							<li><a href="http://twitter.com/share?text=<?php echo $companyName; ?>+Product&url=<?php echo urlencode($base . 'details/' . $main . '/' . $prid); ?>&hashtags=<?php echo $companyName; ?>,Ecommerce,Products,<?php echo urlencode($main); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($base . 'details/' . $main . '/' . $prid); ?>&title=<?php echo $companyName; ?>%20Products&summary=&source=" target="_blank"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="https://plus.google.com/share?url=<?php echo urlencode($base . 'details/' . $main . '/' . $prid); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode($base . 'proimg/' . $prid . '/') . '1.jpg'; ?>&media=<?php echo urlencode($base . 'details/' . $main . '/' . $prid); ?>&description=" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-2 details-top-right">
				<ul class="list-group">
					<li class="list-group-item">
						<span class="title">Delivered In :</span>
						<p class="info"><i class="fa fa-map-marker"></i> Inside Dhaka City <span>2-3 Working Days</span></p>
						<p class="info"><i class="fa fa-map-marker"></i> Outside Dhaka City <span>4-5 Working Days</span></p>
					</li>
					<li class="list-group-item">
						<p class="info"><i class="fa fa-home"></i> Home Delivery</p>
						<p class="info"><i class="fa fa-handshake-o"></i> Cash On Delivery</p>
					</li>
					<li class="list-group-item">
						<span class="title">Return & Warranty:</span>
						<p class="info"><i class="fa fa-repeat"></i> 7 Day Free Shipping Return</p>
					</li>
					<li class="list-group-item">
						<span class="title">Delivery Cost:</span>
						<p class="info"><i class="fa fa-telegram"></i> Inside Dhaka: <?= $dCost['dhaka'] ?>Tk</p>
						<p class="info"><i class="fa fa-telegram"></i> Outside Dhaka: <?= $dCost['other'] ?>Tk</p>
					</li>
				</ul>
			</div>
		</div>

		<div class="row details-page-box details-page-bottom">
			<div class="col-md-12 p-0">
				<h4 class="discription-review-title">Product Full Description</h4>
			</div>
			<div class="col-md-12">
				<div class="discription-review-body">
					<?= $row_details['description'] ?>
				</div>
			</div>
		</div>
		<div class="row details-page-box">
			<div class="col-md-12 text-center">
				<h1 class="h1_und">Related Products</h1>
			</div>
			<?php
			$result_trending	= get_suggestion($row_details['category'], 4);
			while ($row_trending	= $result_trending->fetch_array()) {
				$pr_price = ($row_trending['others'] == 2) ? $caretRate * $row_trending['price'] : $row_trending['price'];
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<ul class="categories product-tab_l">
						<li>
							<a class="pr-info" href="details.php?prid=<?= $row_trending['id']; ?>">
								<img src="proimg/<?= $row_trending['id']; ?>/1.jpg" title="Ring">
								<h2 class="pr-name"><?php echo htmlspecialchars($row_trending['name']); ?></h2>
								<h3><?= $currency . ' ' . $pr_price ?></h3>
							</a>
						</li>
					</ul>
				</div>
			<?php
			}
			mysqli_free_result($result_trending);
			?>
		</div>
	<?php } ?>
</div>
<script src="js/jquery.flexslider.js"></script>
<script src="js/imagezoom.js"></script>
<script>
	$(document).ready(function() {
		$('.flexslider').flexslider({
			animation: "fade",
			controlNav: "thumbnails",
			autoplay: true
		});
	});
</script>
<script>
	$(document).ready(function() {
		item_left = <?= isset($row_details['item_left']) ? $row_details['item_left'] : 0; ?>;
		item_qty = $('.item_qty_input').val();
		if (item_left == 0) {
			$('#no-stock').show();
			$('.contaty').remove();
			$('.add-to-card').remove();
			$('.add-to-wishlist').remove();
		}

		$('.item_plus').click(function() {
			if (item_qty < item_left) {
				item_qty++;
				$('#item_alert').html('');
				keyUpQty(item_qty);
			} else {
				$('#item_alert').html('* Low Stock');
				return false;
			}

			$('.item_qty_input').val(item_qty);
			$('.item_qty').attr('data-value', item_qty);
		});
		$('.item_minus').click(function() {
			if (item_qty > 1) {
				item_qty--;
				$('#item_alert').html('');
				keyUpQty(item_qty);
			} else {
				$('#item_alert').html('* Minimmum quantity selection is 1');
				return false;
			}

			$('.item_qty_input').val(item_qty);
			$('.item_qty').attr('data-value', item_qty);
		});
		$('.add-to-wishlist').click(function() {
			$this = $(this);
			pr_id = $this.find('a').attr('data-id');
			$.post("ajax", {
				prid: pr_id,
				wishlist_add: 1
			}, function(data, status) {
				if (data == 1) $this.find('a').html('<i class="fa fa-check"></i> Added');
				else if (data == 2) $this.find('a').html('Already Added')
				else window.location = "login?wishlist=" + encodeURIComponent(data);
			});
		});

		$('.add-to-cart').click(function() {
			$('#item_alert').html('');
			if (typeof(hasSize) != "undefined") {
				if (typeof(pr_size) == "undefined") {
					$('#item_alert').html('Please Select Product Size');
					return false;
				}
			} else pr_size = 'N/A';
			if (typeof(hasColor) != "undefined") {
				if (typeof(pr_color) == "undefined") {
					$('#item_alert').html('Please Select Product Color');
					return false;
				}
			} else pr_color = 'N/A';

			$.post("ajax.php", {
				prid: <?= $row_details['id']; ?>,
				qty: item_qty,
				size: pr_size,
				color: pr_color,
				add_to_cart: 1
			}, function(data, status) {
				window.location.href = "cart.php";
			});
		});
	});

	function keyUpQty(value) {
		if (value <= item_left) {
			item_qty = value;
			value = value.toString();
			$('#item_alert').html('');
		} else {
			$('#item_alert').html('* Low Stock');
			$('.item_qty_input').val(item_left);
		}
		$('.item_qty').css({
			"width": 30 + (12 * (value.length - 1)),
		});
	}
</script>
<?php include "doc/includes/footer.php"; ?>