<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php include "doc/includes/header.php"; ?>
<section class="partition">
	<div class="container">
		<div class="row">				
			<div class="col-sm-12">
				<div class="features_items">						
					<div class="row">
						<div class="col-md-12">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Cart</li>
								</ol>
							</nav>
						</div>
					</div>
					<div class="row hrbotder">
						<div class="col-md-12">
						<?php
							if(isset($_SESSION['prids']) && !empty($_SESSION['prids'])) {
							$prids = explode(',' , $_SESSION['prids']) ; $qty = explode(',' , $_SESSION['qty']) ;
							$size = explode(',' , $_SESSION['size']) ; $color = explode(',' , $_SESSION['color']) ;
							$length = count($prids); $subtotal = 0; $discount_total = 0;
						?>
							<table class="cart-table">
								<tbody>
								 <tr class="cart-table-header"><td class="cart-table-header-ITEM">ITEM</td><td>QUANTITY</td><td>UNIT PRICE</td><td>SUBTOTAL</td></tr>
							<?php
							for($i = 0;$i < $length;$i++) {
							$prid = $prids[$i]; $row_details = details_page($prid);
							$ava_color = $row_details['colors']; $ava_colors = explode(',', $ava_color);
							?>
							<?php 	
							$unit_price = ($row_details['others'] == 2) ? $caretRate * $row_details['price'] : $row_details['price'];
							$unit_discount = $row_details['price']*($row_details['discount']/100);
							$unit_dprice = $unit_price-$unit_discount;
							$item_price_total = $unit_dprice*$qty[$i];
							$item_discount_total = $unit_discount*$qty[$i];
							$subtotal = $subtotal+$item_price_total;
							$discount_total = $discount_total+$item_discount_total;
							?>
								<tr class="cart-table-detal">
									<td class="cart-table-header-ITEM">
										<img src="<?= "proimg/{$row_details['id']}/{$ava_colors[0]}1.jpg" ?>" class="osh-order-image">
										<div class="item1">
											<div class="ft-product-Georgette"><?= $row_details['name'] ?></div>
											<div class="ft-product-name">Size: <?= $size[$i] ?> &nbsp; Color: <?= $color[$i] ?></div>
											<div class="ft-product-name ">Brand: <?= $row_details['brand'] ?></div>
											<a class="remove" data-dynamic="<?= $i ?>">Remove Item</a> 
										</div>
										<div class="clearfix"></div>
									</td>
									<td style="text-align: center;">
										<input type="number" class="input-quantity" value="<?= $qty[$i] ?>" data-ogn="<?= $qty[$i] ?>" min="1" max="<?php echo $row_details['item_left']; ?>"/> <br/>
										<p style="visibility:hidden;font-size:10px;">Press <span style="color:blue;">Enter</span> To Save<br/><span style="color:blue;">Esc</span> To Cancel</p>
									</td>
									<td>
										<div class="unit-price ft-product-unit-price">
											<div class="current"><?= $currency." ".$unit_dprice ;?></div>
											<?php if($unit_discount > 0) {?>
											<span class="old"><?= $currency.' '.$unit_price ?></span> 
											<div class="save">
												<span> Savings: </span> 
												<span><?= $currency." ".$unit_discount ;?></span> 
											</div>
											<?php } ?>
										</div>
									</td>
									<td>
										<div class="subtotal">												
											<span><?= $currency." ".$item_price_total; ?></span> 
										</div> 
									</td>
								</tr>
							<?php } ?>
								</tbody>
							</table>
							<div class="sutotota">
								<div class="suto">
									<div class="coupon-width">
									</div>
									<div class="Subtotal-width">
										<div class="osh-resume">
											<div class="ft-total">
												<span class="ft-total-left">Total:</span>
												<span class="ft-total-right"><?= $currency.' '.$subtotal ?></span> 
											</div>
										</div>
									</div>											
								</div>
								<div class="bott-part">
									<div class="ft-total-bottom">
										<span class="title">Total:</span>
										<span class="ft-total-tk">
											<?= $currency.' '.$subtotal ?>
										</span>
									</div>
									<div class="Checkout-Proceed">
										<a href="index" class="ft-go-to-checkout continue-shopping">Continue Shopping</a>
										<a href="checkout" class="ft-go-to-checkout">Proceed to Checkout</a>
									</div>
								</div>
							</div>
					<?php } else { ?>
						<div class="no-products">
							<h4> Shopping Cart Empty! </h4>
							<ul>
								<li>You didn't add any product to cart. </li>
								<li>Please go back to Product Page. And add a product to cart.</li>
								<li>For any help, Please contact our help center</li>
							</ul>
						</div>
					<?php } ?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
$(".remove").on('click', function(){
	var dynamic_value = $(this).data("dynamic");
	$(this).closest('.cart-table-detal').fadeOut('slow', function(){
		showPageLoading();
		$.post("ajax", {
			prid: dynamic_value, delete_from_cart: 1
		}, function(data){
			$('html body').load("cart")
		}); 
	});
});
$(".input-quantity").bind("keyup change",function(e) {
	$(this).parent().find('p').css('visibility', 'visible');
	if(e.keyCode === 13) {
		showPageLoading();
		var dynamic_value = $(this).parent().prev().find('.remove').attr("data-dynamic");
		var new_qty = Math.abs(parseInt($(this).val())); if(new_qty == 0) new_qty = 1;
		$.post("ajax", {
			prid: dynamic_value, qty: new_qty, update_cart: 1
		}, function(data,status){
			$('html body').load("cart");
		});
	} else if (e.keyCode === 27) {
		$(this).blur(); $(this).val($(this).data("ogn"));
		$(this).parent().find('p').css('visibility', 'hidden');
	}
});
</script>
<?php include "doc/includes/footer.php"; ?>