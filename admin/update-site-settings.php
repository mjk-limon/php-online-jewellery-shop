<?php
	include "../doc/includes/config.php";
	require_once "includes/functions.php";
	$dt = isset($_GET['ref']) ? $_GET['ref'] : exit(header('Location: index.php'));
?>
<?php if($_SERVER['REQUEST_METHOD'] == 'POST') include "includes/form-submissions.php"; ?>
<?php include "includes/header.php"; ?>
<div class="main-grid">
	<div class="panel panel-widget">
		<div class="row my-div"> 
			<div class="col-md-12 my-div-heading"><h2>Update Site Settings</h2></div>
			<div class="col-md-12">
				<div class="form-body form-body-info">
					<div class="row">
					<?php if($dt == 'caret'){ ?>
						<div class="col-md-6 col-md-offset-3">
							<div class="well">
								<form enctype="multipart/form-data" method="post" action="" class="valida" >
									<input type="hidden" name="update_caret" value="1" />
									
									<div class="form-group">
										<label>Per caret price</label>
										<input type="text" class="form-control" placeholder="Page Title" name="title" value="<?php echo get_caret_price(); ?>">
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</form>
							</div>
						</div>
					<?php } else if($dt == 'cin') { ?>
						<form enctype="multipart/form-data" method="post" action="" class="valida">
							<input type="hidden" name="update_contact_information" value="1" />
							<div class="col-lg-6 col-md-6">
								<div class="well">
									<h5>Contact Information</h5><hr>
									<div class="form-group">
										<label for="field-3">Address</label>
										<textarea name="address" required="true" id="field-3" class="form-control"><?php echo get_contact_information('address'); ?></textarea>
									</div>			
									<div class="form-group">
										<label for="field-3-2">Address Line 2</label>
										<textarea name="address2" id="field-3-2" class="form-control"><?php echo get_contact_information('address2'); ?></textarea>
									</div>
									<div class="form-group">
										<label for="field-4">Mobile Number 1</label>
										<input type="text" value="<?php echo get_contact_information('mobile1'); ?>" name="mobile1" required="true" id="field-4" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-5">Mobile Number 2</label>
										<input type="text" name="mobile2" value="<?php echo get_contact_information('mobile2'); ?>" id="field-5" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-6">Mobile Number 3</label>
										<input type="text" name="mobile3" value="<?php echo get_contact_information('mobile3'); ?>" id="field-6" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-7">Telephone</label>
										<input type="text" name="phone" value="<?php echo get_contact_information('phone'); ?>" id="field-7" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-8">E-mail </label>
										<input type="email" name="email" value="<?php echo get_contact_information('email'); ?>" id="field-8" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="well">
									<h5>Social Information</h5><hr>
									<div class="form-group">
										<label for="field-9"><i class="fa fa-facebook" style="color: #3b5999"></i> Facebook</label>
										<input type="text" name="facebook" value="<?php echo get_contact_information('facebook'); ?>" id="field-9" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-10"><i class="fa fa-twitter" style="color: #55acee"></i> Twitter</label>
										<input type="text" name="twitter" value="<?php echo get_contact_information('twitter'); ?>" id="field-10" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-11"><i class="fa fa-instagram" style="color: #3f729b"></i> Instagram</label>
										<input type="text" name="instagram" value="<?php echo get_contact_information('instagram'); ?>" id="field-11" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-12"><i class="fa fa-google-plus" style="color: #dd4b39"></i> Google Plus</label>
										<input type="text" name="googleplus" value="<?php echo get_contact_information('googleplus'); ?>" id="field-12" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-12c"><i class="fa fa-envelope" style="color: #d44638"></i> Gmail</label>
										<input type="text" name="gmail" value="<?php echo get_contact_information('gmail'); ?>" id="field-12c" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-12d"><i class="fa fa-youtube" style="color: #f00"></i> YouTube</label>
										<input type="text" name="youtube" value="<?php echo get_contact_information('youtube'); ?>" id="field-12d" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-13"><i class="fa fa-pinterest" style="color: #bd081c"></i> Pinterest</label>
										<input type="text" name="yahoo" value="<?php echo get_contact_information('yahoo'); ?>" id="field-13" class="form-control">
									</div>
									<div class="form-group">
										<label for="field-14"><i class="fa fa-skype" style="color: #00AFF0"></i> Skype</label>
										<input type="text" name="skype" value="<?php echo get_contact_information('skype'); ?>" id="field-14" class="form-control">
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<input type="submit" name="sub-1" value="Submit" class="btn btn-primary">
									<input type="reset" name="res-1" id="res-1" value="Reset" class="btn btn-danger">
								</div>
							</div>
						</form>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/valida.2.1.6.min.js"></script>
<script type="text/javascript" >$(document).ready(function(){$('.valida').valida()});</script>
<script src="js/validator.min.js"></script>
<?php
	include "includes/footer.php";
?>