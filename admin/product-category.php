<?php
include "../doc/includes/config.php";
require_once "includes/functions.php";
?>
<?php
if (isset($_POST['add_category'])) {
	$fields['main'] = $conn->real_escape_string(strtolower($_POST['main']));
	$main	= $fields['main'];
	$sub = $conn->real_escape_string(strtolower($_POST['sub']));
	$fields['header'] = $conn->real_escape_string(strtolower($_POST['sub_header']));
	$fields['main_bn'] = "";
	$fields['position'] = (isset($_POST['position'])) ? $_POST['position'] : 100;

	if (!empty($_FILES["cat_sample"]['name'][0])) {
		foreach ($_FILES["cat_sample"]['name'] as $key => $image_name) {
			$img_number = $key + 1;
			$file = upload_image("cat_sample", $key, "../");
			if ($file !== false) {
				rename($file, "../images/category-slides/" . restyle_url($main) . "-" . $img_number . ".jpg");
				$uploadOk += 1;
			}
		}
	}
	if (!empty($_FILES["cat_icon"]['name'])) {
		$file = upload_image_noArray("cat_icon", "../");
		rename($file, "../images/category-slides/" . restyle_url($main) . "-icon.png");
	}
	$adminMessage	= 0;
	$subs = explode(',', $sub);
	foreach ($subs as $sub_name) {
		$fields['sub']	= $sub_name;

		$sql	= InsertInTable('procat', $fields);
		if ($conn->query($sql) == true) {
			$adminMessage	+= 1;
		} else {
			$adminMessage	.= $conn->error;
		}
	}
	adminMessage('green', $adminMessage . " item added !");
}
if (isset($_POST['update_category'])) {
	$main	= strtolower($_POST['main']);
	$uploadOk = 0;
	if (!empty($_FILES["cat_sample"]['name'][0])) {
		foreach ($_FILES["cat_sample"]['name'] as $key => $image_name) {
			$img_number = $key + 1;
			$file = upload_image("cat_sample", $key, "../");
			if ($file !== false) {
				rename($file, "../images/category-slides/" . restyle_url($main) . "-" . $img_number . ".jpg");
				$uploadOk += 1;
			}
		}
	}

	if (!empty($_FILES["cat_icon"]['name'])) {
		$file = upload_image_noArray("cat_icon", "../");
		if (rename($file, "../images/category-slides/" . restyle_url($main) . "-icon.png"))
			$uploadOk += 1;
	}
	adminMessage('green', $uploadOk . " image updated !");
}
if (isset($_POST['update_main_position'])) {
	$total_main	= $_POST['total_main'];
	$adminMessage = 0;
	for ($i = 1; $i <= $total_main; $i++) {
		$fields['position']	= $i;
		$main = get_single_index_data('procat', "id='" . $conn->real_escape_string($_POST[$i]) . "'", "main");
		$sql	= UpdateTable('procat', $fields, "main = '" . addslashes($main) . "'");
		if ($conn->query($sql) == true) $adminMessage += 1;
		else adminMessage('red', $conn->error);
	}
	adminMessage('green', $adminMessage . " items updated !");
}
if (isset($_GET['delete'])) {
	$adminMessage = "";
	$dataDeleted = 0;
	$id = explode(',', $conn->real_escape_string($_GET['delete']));
	foreach ($id as $value) {
		$deleted_main = get_single_index_data("procat", "id='{$value}'", "main");
		$deleted_sub = get_single_index_data("procat", "id='{$value}'", "sub");

		$result_deleted_ids	= get_some_data("products", "category='" . addslashes($deleted_main) . "' AND subcategory='" . addslashes($deleted_sub) . "'");
		while ($row_ids = $result_deleted_ids->fetch_array()) {
			if (file_exists("../proimg/" . $row_ids['id'])) deleteDir("../proimg/" . $row_ids['id']);
			$adminMessage .= "proimg/" . $row_ids['id'] . " folder deleted. ";
		}
		mysqli_free_result($result_deleted_ids);

		$delete_products	= DeleteTable('products', " category='" . addslashes($deleted_main) . "' AND subcategory='" . addslashes($deleted_sub) . "'");
		$delete_from_procat	= DeleteTable('procat', " id = '{$value}' ");
		if ($conn->query($delete_from_procat) && $conn->query($delete_products)) {
			$dataDeleted += mysqli_affected_rows($conn);
		} else $adminMessage .= $conn->error;
	}
	adminMessage('green', $dataDeleted . " data deleted. " . $adminMessage, "delete");
}
?>
<?php include "includes/header.php" ?>
<div class="main-grid">
	<div class="grids">
		<?php
		$result_main	= get_menu();
		$total_category	= $result_main->num_rows;
		?>
		<div class="forms-grids">
			<div class="panel panel-widget">
				<div class="row my-div">
					<div class="col-md-12 my-div-heading">
						<h2>Product Category</h2>
					</div>
					<div class="col-md-6 <?php if (!isset($secondary_category) || !$secondary_category) echo 'col-md-offset-3'; ?>">
						<div class="well">
							<h5>Upload Main Category</h5>
							<hr />
							<form enctype="multipart/form-data" method="post" action="product-category.php" class="valida">
								<input type="hidden" name="add_category" value="1" />

								<div class="form-group">
									<label>Category Name</label>
									<input type="text" name="main" required="true" class="form-control" placeholder="eg: Men, Women, Kids" list="main-category">
									<datalist id="main-category"></datalist>
								</div>
								<div class="form-group">
									<label>Sub Category Header</label>
									<input type="text" name="sub_header" class="form-control" placeholder="eg: Clothing, Footware, Home Applience" list="sub-headers">
									<datalist id="sub-headers"></datalist>
								</div>
								<div class="form-group" style="display: none;">
									<label>Sub Category</label>
									<input type="text" name="sub" class="form-control" placeholder="eg: Shirt, Sari, Mobile">
								</div>

								<?php if (isset($category_sample) || isset($category_icon)) { ?>
									<div class="toggle-input form-group">
										<?php if (isset($category_sample)) { ?>
											<div class="form-group">
												<label>Upload Category Sample <span class="image-size">(Size: <?= explode(',', $category_sample)[1] ?>&times;<?= explode(',', $category_sample)[2] ?>, Format: JPG, Max Size: 2MB)</span></label>
												<input class="cat-sample" name="cat_sample[]" type="file" class="file" multiple data-show-upload="false" data-name="cat_sample[]" data-show-caption="true" data-max-file-count="<?= explode(',', $category_sample)[0] ?>" data-msg-placeholder="Select {files} for upload..." />
											</div>
										<?php }
										if (isset($category_icon)) { ?>
											<div class="form-group">
												<label>Upload Category Icon <span class="image-size">(Size: <?= explode(',', $category_icon)[0] ?>&times;<?= explode(',', $category_icon)[1] ?>, Format: PNG)</span></label>
												<input class="cat-icon" name="cat_icon" type="file" class="file" data-show-upload="false" data-name="cat_icon" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." />
											</div>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="form-group"><input type="submit" name="sub-1" value="Submit" class="btn btn-primary"></div>
							</form>
						</div>
					</div>
					<?php if (isset($secondary_category) && $secondary_category) { ?>
						<div class="col-md-6">
							<div class="well">
								<h5>Upload Secondary Category</h5>
								<hr />
								<form enctype="multipart/form-data" method="post" action="product-category.php" class="valida">
									<input type="hidden" name="add_category" value="1" />
									<input type="hidden" name="position" value="0" />
									<input type="hidden" name="sub" value="all" />
									<input type="hidden" name="sub_header" value="all" />

									<div class="form-group">
										<label>Category Name</label>
										<input type="text" name="main" required="true" class="form-control" placeholder="eg: Men, Women, Kids">
									</div>

									<div class="form-group"><input type="submit" name="sub-1" value="Submit" class="btn btn-primary"></div>
								</form>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php if ($total_category > 0) { ?>
			<?php $result_main	= get_menu('position != 0');	?>
			<script>
				main = [
					<?php while ($row_main = $result_main->fetch_array()) { ?> {
							id: <?= $row_main['id'] ?>,
							name: "<?= htmlspecialchars(ucfirst($row_main['main'])) ?>"
						},
					<?php } ?>
				]
			</script>
			<?php mysqli_free_result($result_main);	?>

			<div class="forms-grids">
				<div class="w3agile-validation">
					<div class="panel panel-widget agile-validation">
						<div class="row my-div">
							<div class="col-md-12 well">
								<h5>Update Category Position</h5>
								<hr />
								<form class="alignments" method="post" action="">
									<input type="hidden" name="update_main_position" />
									<input type="hidden" name="total_main" value="" />

									<div class="current-menu"></div>
									<div class="operators"><button class="btn btn-warning edit"> <i class="fa fa-pencil"></i> Edit </button></div>
									<div class="clearfix"></div>
								</form>
							</div>
							<?php if (isset($category_sample) || isset($category_icon)) { ?>
								<div class="col-md-6 col-md-offset-3 well">
									<h5>Update Category Image</h5>
									<hr />
									<form enctype="multipart/form-data" method="post" action="product-category.php" class="valida">
										<input type="hidden" name="update_category" value="1" />

										<label for="field-1">Select Category</label>
										<div class="form-group">
											<div id="brandDiv">
												<select name="main" id="field-1-3" class="form-control">
													<?php $result_main	= get_menu(); ?>
													<?php while ($row_main = $result_main->fetch_array()) { ?>
														<option value="<?= htmlspecialchars($row_main['main']); ?>"> <?= htmlspecialchars(ucfirst($row_main['main'])) ?> </option>
													<?php } ?>
													<?php mysqli_free_result($result_main); ?>
												</select>
											</div>
										</div>
										<?php if (isset($category_sample)) { ?>
											<div class="form-group">
												<label>Upload Category Sample <span class="image-size">(Size: <?= explode(',', $category_sample)[1] ?>&times;<?= explode(',', $category_sample)[2] ?>, Format: JPG, Max Size: 2MB)</span></label>
												<input class="cat-sample" name="cat_sample[]" type="file" class="file" multiple data-show-upload="false" data-name="cat_sample[]" data-show-caption="true" data-max-file-count="<?= explode(',', $category_sample)[0] ?>" data-msg-placeholder="Select {files} for upload..." />
											</div>
										<?php }
										if (isset($category_icon)) { ?>
											<div class="form-group">
												<label>Upload Category Icon <span class="image-size">(Size: <?= explode(',', $category_icon)[0] ?>&times;<?= explode(',', $category_icon)[1] ?>, Format: PNG)</span></label>
												<input class="cat-icon" name="cat_icon" type="file" class="file" data-show-upload="false" data-name="cat_icon" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." />
											</div>
										<?php } ?>
										<div class="form-group"><input type="submit" name="sub-1" value="Submit" class="btn btn-primary"></div>
									</form>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

			<div class="forms-grids">
				<div class="w3agile-validation">
					<div class="panel panel-widget agile-validation">
						<div class="row my-div">
							<div class="col-md-12">
								<h5>Delete Category</h5>
								<hr />
								<div id="product-query">
									<div class="form-group selection-buttons">
										<?php $result_main = get_menu();
										while ($row_main = $result_main->fetch_array()) { ?>
											<input type="button" data-target="p<?= $row_main['id'] ?>" class="btn btn-danger show-sub-btn" value="<?php echo htmlspecialchars($row_main['main']) ?>" />
										<?php }
										mysqli_free_result($result_main); ?>
									</div>

									<?php $result_main = get_menu();
									while ($row_main = $result_main->fetch_array()) { ?>
										<div class="form-group dsub-item" id="p<?= $row_main['id'] ?>" style="display: none;">
											<label id="subLabel">Select Sub Category</label>
											<div class="well">
												<?php
												$result_sub		= get_sub_by_menu($row_main['main']);
												while ($row_sub = $result_sub->fetch_array()) {
												?>
													<div><label><input type="checkbox" name="delSub[]" value="<?php echo $row_sub['id']; ?>" /> <?= ucwords($row_sub['header'] . " - " . $row_sub['sub']) ?><label></div>
												<?php }
												mysqli_free_result($result_sub); ?>
												<button class="btn btn-info delete-btn">Delete Selected</button>
											</div>
										</div>
									<?php }
									mysqli_free_result($result_main); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript" src="js/valida.2.1.6.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.valida').valida();
	});
</script>
<script src="js/validator.min.js"></script>
<script>
	$(".cat-sample").fileinput({
		rtl: true,
		allowedFileExtensions: ["jpg"]
	});
</script>
<script>
	$(".cat-icon").fileinput({
		rtl: true,
		allowedFileExtensions: ["png"]
	});
</script>
<script>
	$(document).ready(function() {
		if ($(".toggle-input").length) {
			$('input[name="main"]').on('input', function(e) {
				var option = $('#main-category option').filter(function() {
					return this.value === $('input[name="main"]').val();
				}).val();

				if (option) $(".toggle-input").slideUp();
				else $(".toggle-input").slideDown();
			});
		}

		$('.delete-btn').click(function() {
			var checked = []
			$("input[name='delSub[]']:checked").each(function() {
				checked.push(parseInt($(this).val()));
			});
			var checkst = checked.join(',');
			window.location = '?delete=' + checkst;
		});
		$('.show-sub-btn').click(function() {
			var value = $(this).attr('data-target');
			$('.dsub-item').each(function() {
				$(this).hide();
			})
			$('#' + value).fadeIn();
		})

		/*============ Sorting Category ========*/
		$('input[name="total_main"]').val(main.length);
		for (var i = 0; i < main.length; i++) {
			$('.alignments .current-menu').append('<button class="btn btn-primary disabled">' + main[i].name + '</button>');
			$('#main-category').append('<option value="' + main[i].name + '">');
		}
		$('.operators .btn.edit').click(function() {
			var pos1 = '<select name="1" onchange="newMenu(this.value)">';
			pos1 += '	<option value=""> Select 1 Position </option>';
			for (pos_i = 0; pos_i < main.length; pos_i++) {
				pos1 += '	<option value="' + main[pos_i].id + '">' + main[pos_i].name + '</option>';
			}
			pos1 += '</select>';

			$('.alignments .current-menu').html(pos1);
			$('.alignments .operators').html('<a href="product-category.php" class="btn btn-info reset" >Reset</a>');
		});
	});

	prev_name_i = 1;

	function newMenu(nvalue) {
		if (main.length > 1) {
			$('select[name="' + prev_name_i + '"]').addClass('disabled');
			array_pos = 0;
			$.each(main, function(key, value) {
				if (value.id == nvalue) return false;
				array_pos++;
			});
			main.splice(array_pos, 1);
			console.log(array_pos);
			console.log(main);
			new_name_i = prev_name_i + 1;
			var pos2 = '<select name="' + new_name_i + '" onchange="newMenu(this.value)">';
			pos2 += '	<option value=""> Select ' + new_name_i + ' Position </option>';
			for (pos_i = 0; pos_i < main.length; pos_i++) {
				pos2 += '	<option value="' + main[pos_i].id + '">' + main[pos_i].name + '</option>';
			}
			pos2 += '</select>';

			$('.alignments .current-menu').append(pos2);
			prev_name_i++;
		} else {
			$('select[name="' + prev_name_i + '"]').addClass('disabled');
			$('.alignments .operators').html('<input type="submit" class="btn btn-success" value="Update">');
		}
	}
</script>
<?php include "includes/footer.php"; ?>