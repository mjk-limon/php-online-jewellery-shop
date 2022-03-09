<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fields['id'] = mysqli_real_escape_string($conn, $_POST['pid']);
		$fields['name'] = mysqli_real_escape_string($conn, $_POST['pname']);
		$fields['category'] = mysqli_real_escape_string($conn, $_POST['category']);
		$fields['subcategory'] = mysqli_real_escape_string($conn, $_POST["subcategory"]);
		$fields['brand'] = mysqli_real_escape_string($conn, $_POST['brand']);
		$fields['size'] = mysqli_real_escape_string($conn, $_POST['psizes']);
		$fields['description'] = mysqli_real_escape_string($conn, $_POST['pdis']);
		$fields['price'] = mysqli_real_escape_string($conn, $_POST['pprice']);
		$fields['views'] = 0;
		$bdtDiscount = mysqli_real_escape_string($conn, $_POST['pdiscount']);
		$fields['discount'] = ($bdtDiscount/$fields['price'])*100;
		
		$fields['date_added'] = date('Y-m-d H:i:s');
		$fields['item_left'] = mysqli_real_escape_string($conn, $_POST['pstock']);
		
		$color = isset($_POST['color']) ? $_POST['color'] : null; $total_image=0; $uploadOk=0; 
		if(!empty($color)) {
			$fields['colors'] = implode(',', $color); $field_for_image = array();
			foreach($color as $color_key=>$each_color_name) {
				$field_for_image[] = count($_FILES[$each_color_name."pr_img"]['name']); $total_image += count($_FILES[$each_color_name."pr_img"]['name']);
				foreach($_FILES[$each_color_name."pr_img"]['name'] as $key=>$value) {
					$j = $key+1; $file = upload_image($each_color_name."pr_img", $key, "../proimg/{$fields['id']}/");
					if($file !== false){rename($file, "../proimg/{$fields['id']}/{$each_color_name}{$j}.jpg"); $uploadOk += 1;}
				}
			}
			$fields['images'] = implode(',', $field_for_image); 
		} else {
			$fields['colors'] = null; $fields['images']	= count($_FILES["pr_img"]['name']); $total_image += $fields['images'];
			foreach($_FILES["pr_img"]['name'] as $key=>$value) {
				$j=$key+1; $file = upload_image("pr_img", $key, "../proimg/{$fields['id']}/");
				if($file !== false){rename($file, "../proimg/{$fields['id']}/{$j}.jpg"); $uploadOk += 1;}
			}
		}
		if(isset($_POST['others']) && !empty($_POST['others'])) $fields['others'] = $conn->real_escape_string($_POST['others']);

		$sql = InsertInTable('products',$fields);
		if($uploadOk == $total_image) {
			if($conn->query($sql)==true) adminMessage('green', 'Successfully Uploaded Product'); else adminMessage('red', $conn->error);
		}
	}
?>
<?php include "includes/header.php" ?>
<div class="main-grid">
	<div class="panel panel-widget">
		<div class="row my-div">
			<div class="col-md-12 my-div-heading"><h2>Add Product</h2></div>
			<div class="col-md-12">
				<form enctype="multipart/form-data" method="post" action="" class="valida" >
					<input type="hidden" name="discount" value="0" />
					<input type="hidden" name="pid" value="<?= get_product_id(); ?>">
					
					<ul class="nav nav-tabs">
						<li class="active" id="step1-btn"><a>Select Category</a></li>
						<li id="step2-btn"><a>Product Details</a></li>
					 </ul>
					 
					<div class="tab-content">
						<div id="step1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-xs-12 col-sm-4">
									<p><span class="badge">1</span> Select Main Category</p>
									<div class="form-group">
										<ul>
											<?php
												$main_i = 1;$result_main	= get_menu();
												while($row_main = $result_main->fetch_array()) { $main	= $row_main['main'];
											?>
											<li id="m<?php echo $main_i; ?>" class="sl-main" data-main="<?php echo htmlspecialchars($main); ?>"> <?php echo htmlspecialchars(ucwords($main)); ?> <i class="fa fa-chevron-right"></i></li>
											<?php
													$main_i++;
												}
												mysqli_free_result($result_main);
											?>
										</ul>													
									</div>
								</div>

								<div class="col-xs-12 col-sm-4">
									<p id="subLabel"><span class="badge">2</span> Select Sub Category</p>
									<div class="form-group">
									<?php
										$sub_i = 1;$result_main	= get_menu();
										while($row_main = $result_main->fetch_array()){ $main	= $row_main['main'];
									?>
										<ul id="sm<?php echo $sub_i; ?>" class="sl-sub-ul" style="display: none;">
									<?php
											$result_sub		= get_sub_by_menu($main);
											while($row_sub = $result_sub->fetch_array()) {
												$sub_header	= $row_sub['header']; $sub = $row_sub['sub'];
									?>
											<li class="sl-sub" data-sub="<?php echo htmlspecialchars($sub); ?>"> <?php echo htmlspecialchars(ucwords($sub_header)); ?><?php if(!empty($sub)) {echo " - ".htmlspecialchars(ucwords($sub));} ?></li>
									<?php
											}
											mysqli_free_result($result_sub);
									?>
										</ul>
									<?php
											$sub_i++;
										}
										mysqli_free_result($result_main);
									?>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<p>&nbsp;</p>
									<input type="hidden" name="category" value="" />
									<input type="hidden" name="subcategory" value="" />
									
									<p class="selected-p">Selected Main Category: <span class="main"></span></p>
									<p class="selected-p">Selected Sub Category: <span class="sub"></span></p>
									<a data-toggle="tab" href="#step2" id="next-btn"><button class="btn btn-success">Continue <i class="fa fa-arrow-right"></i></button> </a>
								</div>
							</div>
						</div>
						
						<div id="step2" class="tab-pane fade">
							<div class="form-group">
								<ul class="list-inline">
									<li class="title"><i class="fa fa-file-text-o"></i> Category </li>
									<li><span class="main"></span> &nbsp; <i class="fa fa-arrow-right"></i></li>
									<li><span class="sub"></span></li>
								</ul>
							</div>
							<div class="form-group">
								<label for="field-1-2">Product Name</label>
								<input type="text" name="pname" required="true" id="field-1-2" class="form-control" placeholder="Enter Product Name Here...">
							</div>
							<div class="form-group">
								<label for="field-1-4">Description</label>
								<textarea name="pdis" id="field-1-4" required="true"></textarea>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<label for="field-1-5-1">Price / Caret</label>
										<div class="input-group dropdown">
											<input type="hidden" name="others" id="selltype-input" value="1" />
											<input type="number" name="pprice" id="field-1-5-1" class="form-control" step="0.01" required="true" placeholder="Enter Product Price Here...">
											<span class="input-group-addon" id="selltype-addon" data-toggle="dropdown"><?php echo $currency; ?> <span class="caret"></span></span>
											<ul class="dropdown-menu price-picker">
												<li><a href="#" data-type="1">BDT</a></li>
												<li><a href="#" data-type="2">Caret</a></li>
											</ul>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<label for="field-1-3">Brand</label>
										<input type="text" name="brand" list="brand-list" class="form-control"  placeholder="Enter Product Brand Here..."/>
										<datalist id="brand-list">
											<?php 
												$result_brands	= get_all_brands();
												while($row_brands = $result_brands->fetch_array()) {
											?>
												<option value="<?php echo $row_brands['brand']; ?>"> <?php echo $row_brands['brand']; ?> </option>
											<?php 
												}
												mysqli_free_result($result_brands);
											?>
										</datalist>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="product-image">
										<div class="col-xs-12 col-sm-6 proimg-md" id="proimg1">
											<label for="input-b0" class="control-label">Product Image <span class="image-size">(Size: 960&times;1280)</span></label>
											<input id="input-b0" name="pr_img[]" type="file" class="file" multiple required
												data-show-upload="false" data-max-file-size="2048"
											/>
										</div>
										<div class="col-md-6 col-sm-12">
											<label for="field-1-9">Item In Stock</label>
											<div class="input-group wow fadeInUp animated" data-wow-delay=".5s">
												<input type="number" min="0" name="pstock" required="true" id="field-1-9" class="form-control" value="100" onfocus="this.value=''" onblur="if(this.value == ''){this.value='100';}" aria-describedby="basic-addon2">
												<span class="input-group-addon" id="basic-addon2">Pcs</span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Available Sizes</label>
								<input type="text" name="psizes" class="form-control" data-role="tagsinput">
								<span class="form-help">Type a product sizes and hit 'Enter' or 'Comma'</span>
							</div>
							<div class="form-group">
								<input type="submit" name="sub-1" value="Submit" class="btn btn-primary">
								<a href="add-product.php" class="btn btn-danger">Reset </a>
							</div>
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
		$(".price-picker a").on("click", function(){
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
<script type="text/javascript">$(document).ready(function(){$('#field-1-4').summernote({height: 300,tabsize: 2})});</script>
<?php include "includes/footer.php"; ?>