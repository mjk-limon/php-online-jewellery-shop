<?php
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php
	$main = isset($_GET['main']) ? get_url_variables($_GET['main']) : null;
	$subheader = isset($_GET['subheader']) ? get_url_variables($_GET['subheader']) : null;
	$sub =	isset($_GET['sub']) ? get_url_variables($_GET['sub']) : null;
	$search =	isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : null;
	include "doc/includes/product-function.php";
?>
<?php include "doc/includes/header.php"; ?>
	<div class="categories-item product-page mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="agile-box">
						<h4 class="agile-title">SHOP BY CATEGORY</h4>
						<ul class="agile-list">
						<?php
								$result_main = get_menu();
								while($row_menu = $result_main->fetch_array()) {
							?>
							<li><a href="products.php?main=<?= restyle_url($row_menu['main']) ?>"><?= strtoupper(trim($row_menu['main'])); ?></a></li>
						<?php
							}
							mysqli_free_result($result_main);
						?>
						</ul>
					</div>
					<div class="agile-box">
						<h4 class="agile-title">SHOP BY PRICE</h4>
						<ul class="agile-list">
						<?php 
							$row_min_price	= get_min_price_from_category($main, $sor); $row_max_price	= get_max_price_from_category($main, $sor);
							$min_max_price_range	= $row_max_price['price']-$row_min_price['price']; $each_sort_min_value	= intval($row_min_price['price']);
							$price_range		= (isset($_GET['range']) && !empty($_GET['range'])) ? $_GET['range'] : "{$row_min_price['price']},{$row_max_price['price']}";
							$price_sort_value	= explode(',' , $price_range);
						?>
							<li>
								<a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=12&range=<?= ($each_sort_min_value)+1; ?>,<?= ($each_sort_min_value*2); ?>&page=<?= $page; ?>">
									Tk <?= ($each_sort_min_value); ?> - Tk <?= $each_sort_min_value*2; ?>
								</a>
							</li>
							<li>
								<a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=12&range=<?= ($each_sort_min_value*2)+1; ?>,<?= ($each_sort_min_value*3); ?>&page=<?= $page; ?>">
									Tk <?= ($each_sort_min_value*2)+1; ?> - Tk <?= $each_sort_min_value*3; ?>
								</a>
							</li>
							<li>
								<a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=12&range=<?= ($each_sort_min_value*3)+1; ?>,<?= ($each_sort_min_value*4); ?>&page=<?= $page; ?>">
									Tk <?= ($each_sort_min_value*3)+1; ?> - Tk <?= $each_sort_min_value*4; ?>
								</a>
							</li>
							<li>
								<a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=12&range=<?= ($each_sort_min_value*4)+1; ?>,<?= ($each_sort_min_value*5); ?>&page=<?= $page; ?>">
									Tk <?= ($each_sort_min_value*4)+1; ?> - Tk <?= $each_sort_min_value*5; ?>
								</a>
							</li>
							<li>
								<a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=12&range=<?= ($each_sort_min_value*5)+1; ?>,<?= ($each_sort_min_value*6); ?>&page=<?= $page; ?>">
									Tk <?= ($each_sort_min_value*5)+1; ?> - Tk <?= $each_sort_min_value*6; ?>
								</a>
							</li>
							<li>
								<a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=12&range=<?= ($each_sort_min_value*6)+1; ?>,<?= $row_max_price['price']; ?>&page=<?= $page; ?>">
									Above Tk <?= ($each_sort_min_value*6); ?>
								</a>
							</li>
						</ul>
					</div>
					<div class="agile-box">
						<h4 class="agile-title">SHOP BY JEWELLERY SIZE</h4>
						<ul class="agile-list" style="max-height:220px;overflow-y:auto">
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("2.4") ?>&page=<?= $page; ?>">2.4"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("2.6") ?>&page=<?= $page; ?>">2.6"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("2.8") ?>&page=<?= $page; ?>">2.8"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("3") ?>&page=<?= $page; ?>">3"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("4") ?>&page=<?= $page; ?>">4"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("7") ?>&page=<?= $page; ?>">7"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("10") ?>&page=<?= $page; ?>">10"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("16") ?>&page=<?= $page; ?>">16"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("17") ?>&page=<?= $page; ?>">17"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("18") ?>&page=<?= $page; ?>">18"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("19") ?>&page=<?= $page; ?>">19"</a></li>
							<li><a href="?main=<?= restyle_url($main) ?>&sub=<?= restyle_url($sub) ?>&sort=3&size=<?= urlencode("20") ?>&page=<?= $page; ?>">20"</a></li>
						</ul>
					</div>
				</div>
				
				<div class="col-md-9 product-page">
					<div class="row">
						<div class="col-md-12 text-center">
							<h4 class="h4_und product">
								<?= htmlspecialchars(ucwords($main)) ?>
								<?php if(!empty($sub)) echo ' - '.htmlspecialchars(ucwords($sub)) ?>
							</h4>
						</div>
					</div>
				<?php if($total_products == 0) { ?>
					<div class="no-products">
						<h4>Sorry! No Products</h4>
						<ul>
							<li>We have not any product in this category </li>
							<li>Please go back to Home Page. And select other category.</li>
							<li>For any help, Please contact our help center</li>
						</ul>
					</div>
				<?php } ?>	
					<div class="row mt-3">
					<?php
						$i = 1;
						while($row_products = $result_products->fetch_array()) {
						$pr_price = ($row_products['others'] == 2) ? $caretRate * $row_products['price'] : $row_products['price'];
						$pr_discount_tk= $pr_price*($row_products['discount']/100);
						$price_after_discount	= $pr_price - $pr_discount_tk;
					?>
						<div class="col-lg-3 col-md-3 px-1">
							<ul class="categories product-tab_l">
								<li>
									<a class="pr-info" href="details.php?prid=<?= $row_products['id']; ?>">
										<img src="proimg/<?= $row_products['id'] ?>/1.jpg" title="Ring">
										<h2 class="pr-name"><?= htmlspecialchars($row_products['name']); ?></h2>
										<h3><?= $currency.' '.$pr_price ?></h3>
									</a>
								</li>
							</ul>
						</div>
					<?php
							if($i%4 == 0) echo '</div><div class="row mt-3">';
							$i++;
						}
						mysqli_free_result($result_products);
					?>	
					</div>		
				</div>
			</div>
		</div>
	</div>
<?php include "doc/includes/footer.php"; ?>
