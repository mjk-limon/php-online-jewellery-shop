<?php
include "../doc/includes/config.php";
require_once "includes/functions.php";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$prid = mysqli_real_escape_string($conn, $_POST['pid']);
	$fields['name'] = mysqli_real_escape_string($conn, $_POST['pname']);
	$fields['brand'] = mysqli_real_escape_string($conn, $_POST['brand']);
	$fields['size']	=	mysqli_real_escape_string($conn, $_POST['psizes']);
	$color	= isset($_POST['color']) ? $_POST['color'] : null;
	if (!empty($color)) {
		$fields['colors']	= implode(',', $color);
		$color_count = count($color);
		$imageField	= "";
		for ($i	= 0; $i < $color_count; $i++) {
			$each_color_name	= $color[$i];
			$each_color_count	= count($_FILES["{$each_color_name}pr_img"]['name']);
			if ($i == $color_count - 1) $imageField .= $each_color_count;
			else $imageField .= $each_color_count . ',';
			if (!empty($_FILES[$each_color_name . "pr_img"]['name'][0])) {
				$fields['images']	= $imageField;
				for ($j = 1; $j <= $each_color_count; $j++) {
					$imageArray	= $j - 1;
					$file = upload_image($each_color_name . "pr_img", $key, "../proimg/{$prid}/");
					if ($file !== false) {
						rename($file, "../proimg/{$prid}/{$each_color_name}{$j}.jpg");
						$uploadOk += 1;
					}
				}
			}
		}
	} else {
		$fields['colors']	= null;
		if (!empty($_FILES["pr_img"]['name'][0])) {
			deleteDir("../proimg/{$prid}");
			$fields['images']	= count($_FILES["pr_img"]['name']);
			for ($j = 1; $j <= $fields['images']; $j++) {
				$imageArray	= $j - 1;
				$file = upload_image("pr_img", $key, "../proimg/{$prid}/");
				if ($file !== false) rename($file, "../proimg/{$prid}/{$j}.jpg");
			}
		}
	}
	$fields['description']	= mysqli_real_escape_string($conn, $_POST['pdis']);
	$fields['price']		= mysqli_real_escape_string($conn, $_POST['pprice']);
	$fields['discount']		= mysqli_real_escape_string($conn, $_POST['pdiscount']);
	$fields['views']		= 0;
	$fields['date_added']	= date('Y-m-d');
	$fields['item_left']	= mysqli_real_escape_string($conn, $_POST['pstock']);
	$fields['others']	= isset($_POST['others']) ? $_POST['others'] : null;

	$sql	= UpdateTable('products', $fields, " id = '{$prid}' ");
	if ($conn->query($sql) == true) adminMessage('green', 'Successfully Updated Product');
	else adminMessage('red', $conn->error);
}
?>
<?php include "includes/header.php"; ?>
<div class="main-grid">
	<div class="panel panel-widget agile-validation">
		<div class="row my-div">
			<div class="col-md-12 my-div-heading">
				<h2>Update Product</h2>
			</div>
			<div class="col-md-12">
				<form enctype="multipart/form-data" method="post" action="" class="valida" autocomplete="on" novalidate="novalidate">
					<input type="hidden" name="pdiscount" id="field-1-8">
					<!------- Query Section -------->
					<div class="well" id="product-query">
						<label for="field-1">Select Category</label>
						<div class="form-group selection-buttons">
							<?php
							$result_main = get_menu();
							while ($row_main = $result_main->fetch_array()) {
							?>
								<div class="dropdown">
									<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">
										<?= htmlspecialchars($row_main['main']) ?>
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<h5>Select Product Name</h5>
										<?php
										$result_products = get_products("category='" . addslashes($row_main['main']) . "'", "id,name");
										while ($row_products = $result_products->fetch_array()) {
										?>
											<li><a href="javascript:void(0)" data-prid="<?= $row_products['id']; ?>"><?= htmlspecialchars($row_products['name'] . ' - ' . $row_products['id']); ?></a></li>
										<?php
										}
										mysqli_free_result($result_products);
										?>
									</ul>
								</div>
							<?php
							}
							mysqli_free_result($result_main);
							?>
						</div>

						<div class="form-group">
							<label for="field-3">Or, Enter Product ID</label>
							<input type="text" name="pid" id="field-1-id" class="form-control" placeholder="Please Enter Your Product Id To Update" onkeyup="getProduct(this.value)">
						</div>

						<p><span style="color: red;display:none;font-size: 13px;" class="not-found">* No Product Found</span></p>
						<p style="text-align: center;"><img src="images/giphy.gif" alt="" class="checking" style="display: none; width: 50px" /></p>
					</div>
					<!----- End Query Section ------>

					<div id="q-product-details">
						<div class="form-group">
							<label for="field-1-2">Product Name</label>
							<input type="text" name="pname" required="true" id="field-1-2" class="form-control" placeholder="Enter Product Name Here...">
						</div>
						<div class="form-group">
							<label for="field-1-4">Description</label>
							<textarea name="pdis" id="field-1-4" required="true" class="form-control" style="height:100px;"></textarea>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label for="field-1-5-1">Price / Caret</label>
									<div class="input-group dropdown">
										<input type="hidden" name="others" id="selltype-input" value="1" />
										<input type="number" name="pprice" id="field-1-5-1" class="form-control" required="true" placeholder="Enter Product Price Here...">
										<span class="input-group-addon" id="selltype-addon" data-toggle="dropdown"><?php echo $currency; ?> <span class="caret"></span></span>
										<ul class="dropdown-menu price-picker">
											<li><a href="#" data-type="1">BDT</a></li>
											<li><a href="#" data-type="2">Caret</a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="field-1-3">Brand</label>
										<input type="text" name="brand" id="field-1-3" class="form-control" placeholder="Enter Product Brand Here..." />
									</div>
								</div>
							</div>
						</div>
						<div class="row form-group">
							<div class="product-image">
								<div class="col-xs-12 col-sm-6 proimg-md" id="proimg1">
									<label for="input-b0" class="control-label">Product Image <span class="image-size">(Size: 960&times;1280)</span></label>
									<input id="input-b0" name="pr_img[]" type="file" class="file" multiple data-show-upload="false" data-name="pr_img[]" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." />
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<label for="field-1-9">Item In Stock</label>
								<div class="input-group wow fadeInUp animated" data-wow-delay=".5s">
									<input type="number" min="0" name="pstock" required="true" id="field-1-9" class="form-control" placeholder="Enter Stock Here..." aria-describedby="basic-addon2">
									<span class="input-group-addon" id="basic-addon2">Pcs</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="field-1-8p">Available Sizes</label>
							<input type="text" name="psizes" id="field-1-8p" class="form-control" data-role="tagsinput">
							<span class="form-help">Type a product sizes and hit 'Enter' or 'Comma'</span>
						</div>
						<div class="form-group">
							<label>Others</label>
							<div class="checkbox-inline"><label><input type="checkbox" id="field-others" name="others" value="1">Exclusive Collection</label></div>
						</div>
						<div class="form-group">
							<input type="submit" name="sub-1" value="Submit" class="btn btn-primary">
							<input type="reset" name="res-1" id="res-1" value="Reset" class="btn btn-danger">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/valida.2.1.6.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.valida').valida();
		$(".price-picker a").on("click", function() {
			var type = $(this).data("type");
			var text = (type == 1) ? 'BDT' : 'Caret';
			text += ' <span class="caret"></span>';
			$("#selltype-addon").html(text);
			$("#selltype-input").val(type);
		});
	});
</script>
<script src="js/validator.min.js"></script>
<script type="text/javascript" src="js/summernote.js"></script>
<script type="text/javascript" src="js/__dtag_s_input.js"></script>
<?php if (isset($_GET['edit'])) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			var prid = '<?= $_GET['edit'] ?>';
			$('#field-1-id').val(prid);
			getProduct(prid);
			showDetails();
		});
	</script>
<?php } ?>
<?php
include "includes/footer.php";
?>