<!DOCTYPE html>
<html>

<head>
	<title> Online Jewellery Shop Management</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/ratri.css">
	<link rel="stylesheet" type="text/css" href="css/flexslider.css">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<?php if (!isset($boot3)) { ?>
		<script src="js/bootstrap.min.js"></script>
	<?php } else { ?>
		<script src="js/bootstrap3.min.js"></script>
	<?php } ?>
</head>

<body>
	<div class="page-alert" data-close="pageAlert">
		<div class="alert-text">
			<div class="alert-text-header"><span id="alertHeader"> Alert </span>
				<div class="close" data-close="pageAlert">&times;</div>
			</div>
			<div class="alert-text-doc" id="alertText"></div>
		</div>
	</div>
	<div class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<ul class="soc-link">
						<li><a href="https://mail.google.com/mail/" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
						<li><a href="https://facebook.com/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
						<li><a href="https://www.whatsapp.com/" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
						<li><a href="https://www.skype.com/en/get-skype/" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="header">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<form class="example" action="search" style="margin:auto;max-width:300px">
						<input type="text" placeholder="Search.." name="q">
						<button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="logo">
						<a href="index.php"><img src="images/ornament.png"></a>
					</div>
				</div>

				<div class="col-md-4 col-sm-4 col-xs-12">
					<ul class="right-bar">
						<li><a href="cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>My Cart</a></li>
						<?php if (!isset($_COOKIE['clt'])) { ?>
							<li><a href="login.php"><i class="fa fa-user-circle" aria-hidden="true"></i>Sign In</a></li>
						<?php } else { ?>
							<li><a href="my-account.php"><i class="fa fa-user" aria-hidden="true"></i>My Account</a></li>
							<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out</a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="menu">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<ul>
						<li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>

						<?php
						$MainCats = get_menu();
						while ($Main = $MainCats->fetch_assoc()) {
							$mm = $Main['main'];
						?>
							<li class="dropdown">
								<a href="products.php?main=<?php echo urlencode($mm) ?>"><span><?php echo $mm ?></span></a>

								<div class="dropdown-content">
									<?php
									$SubCats = get_header_by_menu($mm);
									while ($Sub = $SubCats->fetch_assoc()) {
										$ms = $Sub['header'];
									?>
										<a href="products.php?main=<?php echo urlencode($mm) ?>&sub=<?php echo urlencode($ms) ?>">
											<?php echo $ms ?>
										</a>
									<?php
									}
									$SubCats->free();
									?>

								</div>
							</li>
						<?php
						}
						$MainCats->free();
						?>

						<li><a href="contact.php">CONTACT US</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>