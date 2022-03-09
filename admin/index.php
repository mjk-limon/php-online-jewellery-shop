<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
	$extra_sql = true;
	if(isset($_GET['sort'])) {
		$from = isset($_GET['from']) ? date('Y-m-d H:i:s', strtotime($_GET['from'])) : date('Y-m-d H:i:s',strtotime('-30 day'));
		$to = isset($_GET['to']) ? date('Y-m-d H:i:s',strtotime('+1 day',strtotime($_GET['to']))) : date('Y-m-d H:i:s');
	}
?>
<?php include "includes/header.php"; ?>
	<script>
	var sell_data = [
	<?php
	if(isset($_GET['sort'])) $extra_sql = "date BETWEEN '{$from}' AND '{$to}'";
	$total_sell = 0; $total_sell_in_today = 0; $total_discount = 0; 
	$result_orders = get_some_data("p_order", "{$extra_sql} AND admin_read != '0' LIMIT 30");
	while($row_orders = $result_orders->fetch_assoc()) {
	if(strpos($row_orders['date'], date("Y-m-d")) !== false) {
		$ordered_products_today = explode(',', $row_orders['pr_id']);
		foreach($ordered_products_today as $tprids){
			$tproduct_price = get_single_index_data("products", "id='".$tprids."'", "price");
			$tproduct_discount = get_single_index_data("products", "id='".$tprids."'", "discount");
			$tdiscount_in_taka = $tproduct_price*($tproduct_discount/100); $tprice_with_discount = $tproduct_price-$tdiscount_in_taka; 
			$total_sell_in_today += $tprice_with_discount;
		}
	}
	$ordered_products = explode(',', $row_orders['pr_id']); $total_sell_in_day = 0; $total_discount_in_day = 0;
	foreach($ordered_products as $prids){
		$product_price = get_single_index_data("products", "id='".$prids."'", "price");
		$product_discount = get_single_index_data("products", "id='".$prids."'", "discount");
		$discount_in_taka = $product_price*($product_discount/100); $price_with_discount = $product_price-$discount_in_taka; 
		$total_sell_in_day += $price_with_discount; $total_discount_in_day += $discount_in_taka;
	}
	?>
	{"elapsed": "<?= date('F j,Y',strtotime($row_orders['date'])) ?>", "value": <?= $total_sell_in_day ?>},
	<?php
	$total_sell += $total_sell_in_day; $total_discount += $total_discount_in_day;
	}
	mysqli_free_result($result_orders);
	?>
	];

	var products_chart = [
	<?php
	$today_added_products = get_total_rows("products", "date_added LIKE '".date("Y-m-d")."%'");
	$result_categories = get_menu(); $total_products = 0;	
	while($row_main	= $result_categories->fetch_array()) {
	$result_products	= get_some_data("products", "category = '".addslashes($row_main['main'])."'");
	$total_products_in_this = $result_products->num_rows; $total_products += $total_products_in_this;
	?>
	{value: <?= $total_products_in_this ?>, label: '<?= addslashes(ucwords($row_main['main'])); ?>', formatted: '<?= $total_products_in_this ?>' },
	<?php
	}
	mysqli_free_result($result_categories);
	?>
	]

	var ordering_data = [
	<?php
	if(isset($_GET['sort'])) $extra_sql = "date BETWEEN '{$from}' AND '{$to}'";	
	$total_order=0; $total_processing_order=0; $total_delivered=0;
	$result_orders = get_some_data("p_order", "{$extra_sql} LIMIT 30");
	$today_order = get_total_rows("p_order", "date LIKE '".date("Y-m-d")."%'");
	while($row_orders = $result_orders->fetch_assoc()) {
	$total_order_in_day = get_total_rows("p_order", "date LIKE '".date("Y-m-d", strtotime($row_orders['date']))."%'");
	$total_processing_order_in_day = get_total_rows("p_order", "admin_read = '1' AND date LIKE '".date("Y-m-d", strtotime($row_orders['date']))."%'");
	$total_delivered_in_day = get_total_rows("p_order", "admin_read = '2' AND date LIKE '".date("Y-m-d", strtotime($row_orders['date']))."%'");
	$total_order += $total_order_in_day; $total_processing_order += $total_processing_order_in_day; $total_delivered += $total_delivered_in_day;
	?>
	{a: '<?= $row_orders['date'] ?>', x: <?= $total_order_in_day ?>, y: <?= $total_processing_order_in_day ?>, z: <?= $total_delivered_in_day ?>},
	<?php
	}
	mysqli_free_result($result_orders);
	?>
	]
	</script>
	<div class="main-grid">
		<div class="index-grids">
			<div class="col-md-4 charts-right">
				<div class="area-grids">
					<div class="area-grids-heading"><h3>Prouducts Chart</h3></div>
					<div id="product-chart"></div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	
		<div class="index-grids">
			<div class="grid table-responsive">
				<div class="form-inline">
					<label>Search: </label>
					<div class="input-group">
						<input type="search" id="search-field" class="form-control" onkeyup="searchFunction()" />
						<span class="input-group-btn">
							<button class="btn btn-info" type="submit">
								 <i class="glyphicon glyphicon-search"></i>
							</button>
						</span>
					</div>
				</div>
				<p> &nbsp; </p>
				<table class="table table-hover table-striped" border id="report">
					<thead>
						<tr>
							<th>Date</th>
							<th>Uploaded Product</th>
							<th>Total Order</th>
							<th>Processed Order</th>
							<th>Delivered Order</th>
							<th>Total Sell</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$total_upload = 0; $subtotal_order = 0; $subtotal_processed = 0;
						$subtotal_delivered = 0; $subtotal_sell = 0;
						$limit = 300; $to = date('Y-m-d'); 
						if(isset($_GET['sort'])) {
							$from = $conn->real_escape_string($_GET['from']);
							$to = $conn->real_escape_string($_GET['to']);
							$diff=date_diff(date_create($from),date_create($to));
							$limit = $diff->format("%a");
						}
						for($i=0; $i<$limit; $i++){
							$date = date("Y-m-d", strtotime("-{$i} Day", strtotime($to)));
							
							$uploaded_product = get_total_rows("products", "date_added LIKE '".$date."%'"); 
							$total_order = get_total_rows("p_order", "date LIKE '".date("Y-m-d", strtotime($date))."%'", "date"); 
							$total_processed = get_total_rows("p_order", "date LIKE '".date("Y-m-d", strtotime($date))."%' AND admin_read='1'", "date,admin_read");
							$total_delivered = get_total_rows("p_order", "date LIKE '".date("Y-m-d", strtotime($date))."%' AND admin_read='2'", "date,admin_read");
							
							$total_upload += $uploaded_product; 
							$subtotal_order += $total_order;
							$subtotal_processed += $total_processed;
							$subtotal_delivered += $total_delivered;
							
							if(empty($uploaded_product) && empty($total_order)) continue;
					?>
						<tr>
							<td><?= date("F j, Y", strtotime($date)) ?></td>
							<td>
								<?= $uploaded_product ?>
							</td>
							<td>
								<?= $total_order ?>
							</td>
							<td>
								<?= $total_processed ?>
							</td>
							<td>
								<?= $total_delivered ?>
							</td>
							<td>
								Tk.
								<?php
									$total_sell = 0;
									$orders = get_some_data("p_order", "date LIKE '".date("Y-m-d", strtotime($date))."%' AND admin_read='2'");
									while($row_od = $orders->fetch_array()) {
										$product_ids_array = explode(',', $row_od['pr_id']);
										$product_qty_array = explode(',', $row_od['pr_qty']);
										foreach($product_ids_array as $key=>$pr_id) {
											$row_details = product_details($pr_id);
											$product_price = $row_details['price']; $product_discount = $row_details['discount'];
											$discount_in_amount = $product_price*($product_discount/100);
											$price_after_discount = $product_price-$discount_in_amount;
											$total_sell += $price_after_discount*$product_qty_array[$key];
										}
									}
									$subtotal_sell += $total_sell;
									echo $total_sell;
								?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<th>Total</th>
						<th><?= $total_upload ?></th>
						<th><?= $subtotal_order ?></th>
						<th><?= $subtotal_processed ?></th>
						<th><?= $subtotal_delivered ?></th>
						<th>Tk.<?= $subtotal_sell ?></th>
					</tfoot>
				</table>
				<a href="javascript:;" onclick="window.print()"><i class="fa fa-print"></i> Print Report</a>
				<style>input[type="date"]{padding: 0 20px;}</style>
				<form class="form-inline" action="" method="GET">
					<input type="hidden" name="sort" />
					<div class="form-group">
						<label>From:</label>
						<input type="date" name="from" max="<?= date('Y-m-d', strtotime('-1 day')) ?>" value="<?= date('Y-m-d', strtotime('-1 day')) ?>" class="form-control date-select">
					</div>
					<div class="form-group">
						<label>To:</label>
						<input type="date" name="to" max="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control date-select">
					</div>
					<button type="submit" class="btn btn-default">Submit</button>
					<?php if(isset($_GET['sort'])){ ?>
						<a href="index.php" class="btn btn-danger">Clear Sort</a>
					<?php } ?>
				</form> 
				<script>
				function searchFunction() {
					var input, filter, table, tr, td, i;
					input = document.getElementById("search-field");
					filter = input.value.toUpperCase();
					table = document.getElementById("report");
					tr = table.getElementsByTagName("tr");
					for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[0];
						if (td) {
							if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							} else {
								tr[i].style.display = "none";
							}
						}       
					}
				}
				</script>
				<style>
					@media print {
						body * {
							visibility: hidden;
						}
						.table, .table * {
							visibility: visible;
						}
						.table {
							width: 100%;
							position: absolute;
							left: 0;
							top: 0;
						}
					}
				</style>
			</div>
		</div>
		<style>input[type="date"]{padding: 0 20px;}</style>
	</div>
	<script src="js/raphael-min.js"></script>
	<script src="js/morris.js"></script>
	<script>
	Morris.Donut({
		element: 'product-chart',
		data: products_chart,
		formatter: function (x, data) { return data.formatted; }
	});
	</script>
<?php include "includes/footer.php"; ?>