<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') include "includes/form-submissions.php"; ?>
<?php $result_page = get_inner_page(); ?>
<?php include "includes/header.php"; ?>
<div class="main-grid">
	<div class="panel panel-widget agile-validation">
		<div class="row my-div">
			<div class="col-md-12 my-div-heading"><h2>Inner Content</h2></div>
			<div class="col-md-12">
		<?php while($row_pages = $result_page->fetch_array()) { 	?>
				<div class="well">
					<form enctype="multipart/form-data" method="post" action="" class="valida">
						<input type="hidden" name="update_inner_page" value="1" />
						<input type="hidden" name="id" value="<?= $row_pages['id']; ?>" />
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Page Name</label>
									<input type="text" name="header" value="<?php echo ucfirst($row_pages['page']); ?>" class="form-control" required disabled />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Header</label>
									<input type="text" name="header" value="<?php echo $row_pages['header']; ?>" class="form-control" required />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Content</label>
							<textarea rows="5" name="content" class="form-control content-codes" required><?php echo $row_pages['content']; ?></textarea>
						</div>

						<p>
							<input type="submit" name="sub-1" value="Update" class="btn btn-primary">
						</p>
					</form>
				</div>
			<?php 
				}
				mysqli_free_result($result_page);
			?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/valida.2.1.6.min.js"></script>
<script type="text/javascript">$(document).ready(function(){$('.valida').valida()});</script>
<script src="js/validator.min.js"></script>
<script type="text/javascript" src="js/summernote.js"></script>
<script type="text/javascript">$(document).ready(function(){$('.form-control.content-codes').summernote({height:300,tabsize:2})});</script>
<?php include "includes/footer.php"; ?>
