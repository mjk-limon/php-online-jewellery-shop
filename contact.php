<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php $message_value = isset($_GET['message']) ? "\r\n\r\n\r\n".$_GET['message'] : null; ?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$fields['date'] = date("Y-m-d H:i:s"); $fields['admin_read'] = 0;
		$fields['Name'] = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : null;
		$fields['Email'] = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : null;
		$fields['Subject'] = isset($_POST['subject']) ? $conn->real_escape_string($_POST['subject']) : null;
		$fields['Message'] = isset($_POST['comments']) ? $conn->real_escape_string($_POST['comments']) : null;
		$sql	= InsertInTable('contact',$fields);
		if($conn->query($sql) == true) $msg = "Your Message Has Been Successfully Sent !";
		else $msg = $conn->error;
	}
?>
<?php include "doc/includes/header.php"; ?>
	<div class="col-md-12 product-page">
		<div class="row my-2">
			<div class="col-md-12 text-center">
				<h1 class="h1_und product">Feel free to contact with us !!!</h1>
			</div>
		</div>
		</br>
	</div>
	
	<div class="categories-item">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="agile-box">
						<h3 class="agile-title">Get In Touch</h3>
						<b>Contact Address</b>
							<ul class="list-group">
								<li class="list-group-item"><i class="fa fa-map-marker"></i> Address : 87, BNS Center, Level 5, Room 618 ,Sector 7.</br> Uttara, Dhaka - 1230.</br> Bangladesh .</li>
							</ul>
				    </div>
				</div>
				<div class="col-md-8">
					<div class="form-table">
						<h3 class="agile-title"><center>Feel Free To Say Hello</center></h3>
						<form action="" method="post">
							<div class="form-group">
								<input type="text" class="form-control validate" name="name" placeholder="Enter name">
								<span style="color:red;font-size:12px"></span>
							</div>
							<div class="form-group">
								<input type="text" name="email" class="form-control" placeholder="Email Address">
							</div>
							<div class="form-group">
								<input type="text" name="subject" class="form-control" placeholder="Subject">
							</div>
							<div class="form-group">
								<textarea name="comments" class="form-control" rows="4" placeholder="Your message.."></textarea>
							</div>
						<?php if(isset($msg) && !empty($msg)){ ?><p class="text-info"><?= $msg ?></p><?php } ?>
							<button type="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>	
				</div>
			</div>
    </div>
	</div>
	<script>
		$(document).ready(function(){
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