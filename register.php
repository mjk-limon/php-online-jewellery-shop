<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php 
	if(isset($_COOKIE['clt'])) header('Location: my-account');
	$f_n = isset($_GET['fn']) ? $_GET['fn'] : null; $l_n = isset($_GET['ln']) ? $_GET['ln'] : null; 
	$email = isset($_GET['e']) ? $_GET['e'] : null; $gen = isset($_GET['g']) ? $_GET['g'] : null; 
	$adr = isset($_GET['ad']) ? $_GET['ad'] : null; $loc = isset($_GET['loc']) ? $_GET['loc'] : null;
	if(isset($_GET['id'])) {
		$emsg  = (empty($f_n)) ? '<li>* First name is empty</li>' : '';
		$emsg .= (empty($l_n)) ? '<li>* Last name is empty</li>' : '';
		$emsg .= (empty($email)) ? '<li>* Email is empty</li>' : '';
		if(empty($gen)) { $emsg .= '<li>* Gender not defined</li>';} else { echo '<script>$(document).ready(function(){ $("#gen-'.strtolower($gen).'").prop("checked", true); }); </script>';}
		if(empty($loc)) { $emsg .= '<li>* Location not defined</li>';} else { echo '<script>$(document).ready(function(){ $("#id_city").val("'.trim(strtolower($loc)).'"); }); </script>';}
		$emsg .= (empty($adr)) ? '<li>* Address is empty</li>' : '';
	}
?>
<?php include "doc/includes/header.php"; ?>
	<div class="limon-login">
		<div class="wrapper my-account">
			<h2>Create New Account</h2>
			<div class="limlog-form inner-page">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<form id="registrationForm" action="ajax" method="post">
							<input type="hidden" name="register_user" />
							<div class="form-group">
								<label> First Name </label>
								<input class="form-control validate" name="first_name" placeholder="First Name:" type="text" tabindex="1" required autofocus>
								<span style="color:red;font-size:12px"></span>
							</div>
							<div class="form-group">
								<label> Last Name </label>
								<input class="form-control validate" name="last_name" placeholder="Last Name:" type="text" tabindex="2" required>
								<span style="color:red;font-size:12px"></span>
							</div>
							<div class="form-group">
								<label> Email </label>
								<input class="form-control" name="email" placeholder="Email Address:" type="email" tabindex="3" required>
							</div>
							
							<div class="form-group">
								<label>Mobile Number </label>
								<input class="form-control" name="phone" placeholder="Mobile Number:" type="number" tabindex="3" required>
							</div>
							
							<div class="form-group">
								<label>I Am: &nbsp;&nbsp;</label>
								<label class="radio-inline"><input type="radio" name="radio" id="gen-male" required><i></i>Male</label>
								<label class="radio-inline"><input type="radio" name="radio" id="gen-female"><i></i>Female</label>
							</div>
							
							<div class="form-group">
								<label> Password </label>
								<input class="form-control" name="password" placeholder="password" type="password" tabindex="4" required>
							</div>
							
							<div class="form-group">
								<label> Address </label>
								<input class="form-control" name="address_line_1" placeholder="Address:" type="text" tabindex="3" required>
							</div>
							
							<div class="form-group">
								<label> Devision/City </label>
								<select class="form-control" id="id_city" name="state">
									<option value="barisal">Barisal</option>
									<option value="chittagong">Chittagong</option>
									<option value="dhaka" selected>Dhaka</option>
									<option value="khulna">Khulna</option>
									<option value="mymensingh">Mymensingh</option>
									<option value="rajshahi">Rajshahi</option>
									<option value="rangpur">Rangpur</option>
									<option value="sylhet">Sylhet</option>
								</select>
							</div>
							
							<div class="form-group">
								<label> District/State </label>
								<select class="form-control" id="id_state" name="city">
									
								</select>
							</div>
							
							<div class="form-group hidden">
								<label> Postal Code </label>
								<input class="form-control" name="postalcode" placeholder="Postal Code:" type="text" tabindex="3">
							</div>
							
							<input type="hidden" name="ref" value="index" />
							<input type="hidden" name="country" value="bangladesh" />
							<div class="form-group"><input type="submit" value="create an account" class="btn btn-success" /></div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	chittagong	= ["Brahmanbaria", "Comilla", "Chandpur", "Lakshimpur", "Noakhali", "Feni", "Khagrachari", "Rangamati", "Bandarban", "Chittagong", "Coxs Bazar"];
	dhaka		= ["Dhaka", "Gazipur", "Kishoreganj", "Manikganj", "Munshiganj", "Narayanganj", "Narshindi", "Tangail", "Faridpur", "Gopalganj", "Madaripur", "Rajbari", "Shariatpur"];
	khulna		= ["Bagerhat", "Chuadanga", "Jessore", "Jhenaidah", "Khulna", "Kustia", "Magura", "Meherpur", "Narail", "Satkhira"];
	barisal		= ["Barisal", "Borguna", "Bhola", "Jalokhathi", "Patuakhali", "Pirojpur"];
	rajshahi	= ["Bogra", "Chapainawabganj", "Joypurhat", "Naogaon", "Natore", "Pabna", "Rajshahi", "Sirajganj"];
	sylhet		= ["Hobiganj", "Moulvibazar", "Sunamganj", "Sylhet"];
	rangpur		= ["Thakurgaon", "Rangpur", "Panchagarh", "Nilphamari", "Lalmonirhat", "Kurigram", "Gaibandha", "Dinajpur"];
	mymensingh	= ["Jamalpur", "Mymensingh", "Netrokona", "Sherpur"];
	
	$(document).ready(function(){
		sid_city = eval($('#id_city').val()); html_for_state = '';
		$.each(sid_city, function(index, value){ html_for_state	+= '<option value="'+value+'">'+value+'</option>'; });
		$('#id_state').html(html_for_state);
		
		$('#id_city').change(function(){
			state_array	= eval($(this).val()); html_for_state	= '';
			$.each(state_array, function(index, value){ html_for_state	+= '<option value="'+value+'">'+value+'</option>'; });
			$('#id_state').html(html_for_state);
		});
		$('.validate').on('keyup', function(e){
			var value = $(this).val();
			var lastChar = value.substr(value.length - 1); 
			if(!lastChar.match(/[A-Za-z| ]/g)) {
				$(this).val(value.slice(0, value.length-1));
				$(this).parent().find("span").text('Input can only accept the Alphabets (A-Z and a-z)');
			}
		});
		
	});
</script>
<?php include "doc/includes/footer.php"; ?>