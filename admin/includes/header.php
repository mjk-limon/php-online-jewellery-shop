<?php
if (!isset($_COOKIE['user'])) exit(header('Location: login.php?emsg=' . urlencode("You must login first") . '&ref=' . urlencode($_SERVER['REQUEST_URI'])));
if (isset($_GET['logout'])) {
	setcookie('user', null, time() - 3600, "/");
	header('Location: login.php?emsg=' . urlencode("Successfully logged out !"));
}
$userinfo	= $conn->query("SELECT * FROM admins where Token = '" . $conn->real_escape_string($_COOKIE['user']) . "'");
if ($userinfo->num_rows  == 1) {
	$list_row	= $userinfo->fetch_array();
	$check_username = $list_row['username'];
} else {
	setcookie("user", null, time() - 3600, "/");
	exit(header('Location: login.php?emsg=' . urlencode("Invalid token or user deleted !")));
}
?>
<!DOCTYPE html>

<head>
	<title><?= get_title('Admin Panel V 4.1') ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Colored Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
	Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<link rel="stylesheet" href="css/_ds_adm_boot.css">
	<link href="css/_ds_adm_design.css" rel='stylesheet' type='text/css' />
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/_ds_font_aws.css" type="text/css" />

	<link rel="stylesheet" href="css/_ds_admmorris.css">
	<link href="css/_ds_file_input.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/_ds_note_summer.css">

	<script src="js/__ds_design_jquery.min.js"></script>
	<script src="js/__ds_adm_boot.js"></script>
	<script src="js/__ds_dmodernizr.js"></script>
	<script src="js/__ds_file_inp.js" type="text/javascript"></script>
</head>

<body class="dashboard-page">
	<nav class="main-menu">
		<ul>
			<li>
				<a href="index.php">
					<i class="fa fa-home nav_icon"></i>
					<span class="nav-text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="site-data.php?dt=msg">
					<i class="fa fa-envelope-o nav_icon"></i>
					<span class="nav-text">Mailbox</span>
				</a>
			</li>
			<li>
				<a href="site-data.php?dt=odr">
					<i class="fa fa-bell-o nav_icon"></i>
					<span class="nav-text">Orders</span>
				</a>
			</li>
			<li class="has-subnav">
				<a href="javascript:void(0);">
					<i class="fa fa-cubes nav_icon"></i><span class="nav-text">Products</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li><a class="subnav-text" href="add-product.php">Add</a></li>
					<li><a class="subnav-text" href="update-product.php">Update</a></li>
					<li><a class="subnav-text" href="delete-product.php">Delete</a></li>
					<li><a class="subnav-text" href="site-data.php?dt=apr">View All Products</a></li>
				</ul>
			</li>
			<li>
				<a href="product-category.php">
					<i class="fa fa-list nav_icon"></i>
					<span class="nav-text">Product Categories</span>
				</a>
			</li>
			<li>
				<a href="javascript:void(0)">
					<i class="fa fa-wpexplorer nav-icon"></i>
					<span class="nav-text">Site Data</span>
					<i class="icon-angle-right"></i><i class="icon-angle-down"></i>
				</a>
				<ul>
					<li><a class="subnav-text" href="update-site-settings.php?ref=cin">Contact Information</a></li>
					<li><a class="subnav-text" href="site-data.php?dt=cls">Registered Users</a></li>
				</ul>
			</li>
			<li>
				<a href="inner-pages.php">
					<i class="fa fa-address-card-o nav-icon"></i>
					<span class="nav-text">Footer Pages</span>
				</a>
			</li>
		</ul>
		<ul class="logout">
			<li>
				<a href="?logout">
					<i class="icon-off nav-icon"></i>
					<span class="nav-text">Logout</span>
				</a>
			</li>
		</ul>
	</nav>

	<section class="wrapper scrollable">
		<div class="site-message">Hi </div>
		<nav class="user-menu">
			<a href="javascript:;" class="main-menu-access">
				<i class="icon-proton-logo"></i>
				<i class="icon-reorder"></i>
			</a>
		</nav>
		<section class="title-bar">
			<div class="logo">
				<h1><a href="index.php"><img src="../images/logo.png" alt="" /></a></h1>
			</div>
			<div class="header-right">
				<div class="profile_details_left">
					<div class="header-right-left">
						<ul class="nofitications-dropdown">
							<li class="dropdown head-dpdn">
								<?php
								$unread_message = get_messages("admin_read='0'");
								$unread_message_count	= $unread_message->num_rows;
								?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i><?php if ($unread_message_count != 0) { ?><span class="badge"><?php echo $unread_message_count; ?></span><?php } ?></a>
								<ul class="dropdown-menu anti-dropdown-menu w3l-msg">
									<li>
										<div class="notification_header">
											<h3>You have <?= $unread_message_count; ?> new messages</h3>
										</div>
									</li>
									<?php
									$result_messages	= get_messages("admin_read='0' ORDER BY id DESC LIMIT 3");
									while ($row_message = $result_messages->fetch_array()) {
									?>
										<li>
											<a href="site-data.php?dt=msg#mail-<?= $row_message['Id']; ?>">
												<div class="user_img"><i class="fa fa-envelope"></i></div>
												<div class="notification_desc">
													<p><?= $row_message['Name']; ?><?php if ($row_message['admin_read'] == 0) { ?> <span style="color: red!important">(NEW)</span> <?php } ?></p>
													<p><span><?= $row_message['Email']; ?></span></p>
												</div>
												<div class="clearfix"></div>
											</a>
										</li>
									<?php
									}
									mysqli_free_result($result_messages);
									?>
									<li>
										<div class="notification_bottom"><a href="site-data.php?dt=msg">See all messages</a></div>
									</li>
								</ul>
							</li>
							<li class="dropdown head-dpdn">
								<?php
								$unread_order = get_orders("admin_read='0'");
								$unread_order_count	= $unread_order->num_rows;
								?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><?php if ($unread_order_count != 0) { ?><span class="badge blue"><?php echo $unread_order_count; ?></span><?php } ?></a>
								<ul class="dropdown-menu anti-dropdown-menu agile-notification">
									<li>
										<div class="notification_header">
											<h3>You have <?= $unread_order_count; ?> new orders</h3>
										</div>
									</li>
									<?php
									$result_order	= get_orders("admin_read='0' ORDER BY id DESC LIMIT 3");
									while ($row_order = $result_order->fetch_array()) {
									?>
										<li>
											<a href="site-data.php?dt=odr#order-<?= trim($row_order['id']) ?>">
												<div class="user_img"><i class="fa fa-bell"></i></div>
												<div class="notification_desc">
													<p><?= $row_order["name"] ?><span style="color: red!important">(NEW)</span></p>
													<p><span><?= $row_order["pr_id"] ?></span></p>
												</div>
												<div class="clearfix"></div>
											</a>
										</li>
									<?php
									}
									mysqli_free_result($result_order);
									?>
									<li>
										<div class="notification_bottom"><a href="site-data.php?dt=odr">See all orders</a></div>
									</li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>
					<div class="profile_details">
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">
										<span class="prfil-img"><i class="fa fa-user" aria-hidden="true"></i></span>
										<div class="clearfix"></div>
										<b><?= $check_username; ?></b>
									</div>
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="site-data.php?dt=adm"><i class="fa fa-user-circle-o"></i> Manage Admins</a> </li>
									<li> <a href="?logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>

		<?php if ($unread_order_count > 0 || $unread_message_count > 0) { ?>
			<div class="alert alert-danger notification text-center">
				<?php if ($unread_order_count > 0) { ?>
					You Have <strong><?php echo $unread_order_count; ?></strong> New <a href="site-data.php?dt=odr" class="alert-link"> Product Orders</a>
				<?php } ?>
				<?php if ($unread_order_count > 0 && $unread_message_count > 0) { ?>
					, And <strong><?= $unread_message_count; ?></strong> New <a href="site-data.php?dt=msg" class="alert-link"> Message</a>.
				<?php } else if ($unread_message_count > 0) { ?>
					You Have <strong><?= $unread_message_count; ?></strong> New <a href="site-data.php?dt=msg" class="alert-link"> Message</a>.
				<?php } ?>
			</div>
		<?php } ?>