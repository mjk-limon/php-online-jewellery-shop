<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$prid	= mysqli_real_escape_string($conn, $_POST['pid']);
		if(file_exists("../proimg/{$prid}")) deleteDir("../proimg/{$prid}");
		
		$sql	= DeleteTable('products'," id = '{$prid}' ");
		if($conn->query($sql)==true) {adminMessage('green', 'Successfully Deleted Product');}
		else {adminMessage('red', $conn->error);} 
	}
?>
<?php include "includes/header.php"; ?>
<div class="main-grid">
	<div class="panel panel-widget agile-validation">
		<div class="row my-div">
			<div class="col-md-12 my-div-heading"><h2>Delete Product</h2></div>
			<div class="col-md-12">
				<form enctype="multipart/form-data" method="post" action="" class="valida" autocomplete="on" novalidate="novalidate">
					<!------- Query Section ----------->
					<div class="well" id="product-query">
						<label for="field-1">Select Category</label>
						<div class="form-group selection-buttons">
						<?php
							$result_main = get_menu();
							while($row_main = $result_main->fetch_array()) {
						?>
							<div class="dropdown">
								<button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown">
									<?= htmlspecialchars($row_main['main']) ?>
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<h5>Select Product Name</h5>
								<?php 
									$result_products= get_products("category='".addslashes($row_main['main'])."'");
									while($row_products = $result_products->fetch_array()) {
								?>
									<li><a href="javascript:void(0)" data-prid="<?= $row_products['id']; ?>"><?= htmlspecialchars($row_products['name'].' - '.$row_products['id']); ?></a></li>
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
						<p style="text-align: center;"><img src="images/giphy.gif" alt="" class="checking" style="display: none; width: 50px"/></p>
					</div>
					<!------- End Query Section ----------->
				
					<div id="q-product-details" >
						<div class="form-group">
							<label for="field-1-2">Product Name</label>
							<input type="text" name="pname" required="true" id="field-1-2" class="form-control disabled" placeholder="Enter Product Name Here..." disabled>
						</div>
						<div class="form-group">
							<label for="field-1-4">Description</label>
							<textarea name="pdis" id="field-1-4" required="true" class="form-control disabled" style="height:100px;" disabled></textarea>
						</div>
						
						<div class="form-group">
							<input type="submit" name="sub-1" value="Delete" class="btn btn-warning">
							<input type="reset" name="res-1" id="res-1" value="Reset" class="btn btn-danger">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/valida.2.1.6.min.js"></script>
<script type="text/javascript" src="js/__dtag_s_input.js"></script>
<script type="text/javascript">$(document).ready(function() { $('.valida').valida(); });</script>
<script src="js/validator.min.js"></script>
<script type="text/javascript" src="js/summernote.js"></script>
<?php
	include "includes/footer.php";
?>
