<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php
	if(isset($_POST['login'])) {
		$username	= $conn->real_escape_string($_POST['username']);
		$password	= $conn->real_escape_string($_POST['password']);
		$sql = "SELECT * FROM users ";
		$sql.= "WHERE binary username='{$username}' ";
		if(is_numeric($username)) $sql.= "OR mobile_number LIKE '%{$username}' ";
		$sql.= "AND binary password='{$password}'";
		$result	= $conn->query($sql);
		if($result->num_rows == 1) {
			$row = $result->fetch_assoc();
			setcookie("clt", $row['token'], time() + (86400 * 2),"/");
			exit("1");
		} else exit("0");
	}
?>
<?php
	if(isset($_POST['newsletter_add'])) {
		$field['email']	= mysqli_real_escape_string($conn,$_POST['email']);
		$check	= "SELECT * FROM newsletter WHERE email='{$field['email']}'";
		$result	= $conn->query($check);
		if($result->num_rows == 0) {
			$sql	= InsertInTable('newsletter', $field);
			$conn->query($sql);
			exit('<i class="fa fa-check"></i> Success');
		} else exit('Already Exixts');
	}
?>
<?php
	if(isset($_POST['coupon_form'])) {
		$code	= mysqli_real_escape_string($conn,$_POST['code']);
		if(!empty($_COOKIE['clt'])) {
			$result_user	= get_user_info($_COOKIE['clt']);
			if($result_user->num_rows ==1) {
				$row_user	= $result_user->fetch_array();
				$check	= "SELECT * FROM coupons WHERE username='{$row_user['username']}' AND coupon='{$code}'";
				if($conn->query($check)->num_rows > 0) {
					$row_coupon	= $conn->query($check)->fetch_array();
					exit($row_coupon['discount']);
				} else exit("You Have Entered An Invalid Coupon Code !");
			} else exit('Invaild User ! Please <a href="logout.php">Login Again</a>');
		} else exit('Please <a href="login">Login</a> First To Use Coupon');
	}
?>
<?php
	if(isset($_POST['wishlist_add'])) {
		$prid	= mysqli_real_escape_string($conn,$_POST['prid']);
		if(!empty($_COOKIE['clt'])) {
			$result_user	= get_user_info($_COOKIE['clt']);
			if($result_user->num_rows ==1) {
				$row_user	= $result_user->fetch_array();
				$user_id	= $row_user['id'];
				$prev_wishlists	= $row_user['wishlists'];
				
				if(empty($prev_wishlists)) $fields['wishlists']	= $prid;
				else {
					$wishlist_array	= explode(',', $row_user['wishlists']);
					if(in_array($prid, $wishlist_array)) exit("2");
					else $fields['wishlists']	= $prev_wishlists.','.$prid;
				}
				$sql	= UpdateTable('users', $fields, "id='{$user_id}'");
				$conn->query($sql);
				exit("1");
			} else exit($prid);
		} else exit($prid);
	}
?>
<?php
	if(isset($_POST['remove_wishlist'])) {
		$id		= mysqli_real_escape_string($conn,$_POST['id']);
		if(!empty($_COOKIE['clt'])) {
			$result_user	= get_user_info($_COOKIE['clt']);
			if($result_user->num_rows ==1) {
				$row_user	= $result_user->fetch_array();
				$user_id	= $row_user['id'];
				
				$prev_wishlists	= $row_user['wishlists'];
				$wishlist_array	= explode(',', $prev_wishlists);
				unset($wishlist_array[$id]);
				$fields['wishlists']	= implode(',', $wishlist_array);
				
				$sql	= UpdateTable('users', $fields, "id='{$user_id}'");
				$conn->query($sql);
				
				exit(1);
			} else exit("User Removed !");
		} else exit("Not Logged In");
	}
?>
<?php 
	if(isset($_POST['register_user'])) {
		$field['username']			= $conn->real_escape_string($_POST['email']);
		$field['password']			= $conn->real_escape_string($_POST['password']);
		$field['token']					= random_token();
		$field['first_name']		= $conn->real_escape_string($_POST['first_name']);
		$field['last_name']			= $conn->real_escape_string($_POST['last_name']);
		$field['email']				= $conn->real_escape_string($_POST['email']);
		$field['address']			= $conn->real_escape_string($_POST['address_line_1']);
		$field['city']				= $conn->real_escape_string($_POST['state']);
		$field['district']			= $conn->real_escape_string($_POST['city']);
		$field['postalcode']		= $conn->real_escape_string($_POST['postalcode']);
		$field['country']		= $conn->real_escape_string("Bangladesh");
		$field['mobile_number']		= $conn->real_escape_string($_POST['phone']);
		$field['wishlists']			= '';
		
		$check = "SELECT * FROM users ";
		$check.= "WHERE username='{$field['username']}' ";
		$check.= "OR mobile_number LIKE '%{$field['mobile_number']}'";
		$check_result	= $conn->query($check);
		
		if($check_result->num_rows != 0) exit('2');
		else {
			echo $check_result->num_rows;
			$sql	= InsertInTable('users',$field);
			$ref_page	= isset($_POST['ref']) ? $_POST['ref'] : 'index';
			if($conn->query($sql)) {
				setcookie("clt", $field['token'], time() + (86400 * 2),"/");
				exit('1');
			} else exit($conn->error);
		}
	}
?>
<?php 
	if(isset($_POST['order_submit'])) {
		$fields['order_no'] = (rand(10000,99999));
		$fields['date'] = date("Y-m-d H:i:s");
		if(!empty($_POST['userToken'])) {
			$result_user	= get_user_info($_POST['userToken']);
			$row_user	= $result_user->fetch_array();
			$fields['name'] = $row_user['first_name'].' '.$row_user['last_name'];
			$fields['phone'] = $row_user['mobile_number'];
			$fields['email'] = $row_user['email']; $fields['location'] = $row_user['district'];
			$fields['address'] = $row_user['address'].', '.$row_user['district'].', '.$row_user['city'];
		} else {	
			$fields['name'] = 'Guest';
			$fields['phone'] = $conn->real_escape_string($_POST['mobileNumber']);
			$fields['email'] = ''; $fields['location'] = $conn->real_escape_string($_POST['orderLocation']);
			$fields['address'] = $conn->real_escape_string($_POST['fullAddress']);
		}
		$fields['shipment'] = isset($_POST['shipment']) ? $_POST['shipment'] : 'Normal';
		$fields['payment'] = $_POST['paymentType'];
		$fields['payment_number']	= $_POST['paymentNumber'];
		$fields['payment_trxn_id'] = $_POST['paymentTrxnId'];
		$fields['pr_id'] = (isset($_POST['pr_id'])) ? ($_POST['pr_id']) : $_SESSION['prids'];
		$fields['pr_size'] = (isset($_POST['pr_size'])) ? ($_POST['pr_size']) : $_SESSION['size'];
		$fields['pr_qty'] = (isset($_POST['pr_qty'])) ? ($_POST['pr_qty']) : $_SESSION['qty'];
		$fields['pr_color'] = (isset($_POST['pr_color'])) ? ($_POST['pr_color']) : $_SESSION['color'];
		$fields['admin_read'] = 0;
		
		$sql	= InsertInTable('p_order',$fields);	
		if($conn->query($sql)) {
			$AdminText = "You have received a new order from your website";
			$AdminText.= "Order No: {$fields['order_no']}<br/>";
			$AdminText.= "Order By: {$fields['name']}<br/>";
			$AdminText.= "Mobile Number: {$fields['phone']}<br/><br/>";
			$AdminText.= '<a href="'.$base.'adminorders">Click here</a> to check your orders';
			
			$UserText = "Thanks for ordering us !.<br/>";
			$UserText.= "Your Order No: {$fields['order_no']}<br/>";
			$UserText.= "Ordered as: {$fields['name']}<br/>";
			$UserText.= "Mobile Number: {$fields['phone']}<br/><br/>";
			$UserText.= '<a href="'.$base.'order-history">Click here</a> to check your orders';
			
			//send_mail("no-reply@dhakasolution.com", $EmailToSend, "New order from your website !", $AdminText);
			//if(!empty($fields['email'])) send_mail($EmailToSend, $fields['email'], "Thanks for ordering us !", $UserText);
			exit("{$fields['order_no']}");
		} else exit($conn->error);
	}
?>
<?php 
	if(isset($_POST['updadeMyAccount'])) {
		$id	= $_POST['id'];
		$fields['first_name']	= $conn->real_escape_string($_POST['first_name']);
		$fields['last_name']	= $conn->real_escape_string($_POST['last_name']);
		$fields['email']		= $conn->real_escape_string($_POST['email']);
		$fields['address']		= $conn->real_escape_string($_POST['address']);
		$fields['city']			= $conn->real_escape_string($_POST['city']);
		$fields['district']		= $conn->real_escape_string($_POST['district']);
		$fields['postalcode']		= $conn->real_escape_string($_POST['postalcode']);
		$fields['mobile_number']		= $conn->real_escape_string($_POST['mobile_number']);
		
		$sql	= UpdateTable('users', $fields, "id='{$id}'");
		if($conn->query($sql)) exit('<i class="fa fa-check"></i> Success');
		else echo $conn->error;
	}
?>
<?php
	if(isset($_POST['contactFormSubmit'])) {
		$email_subject = "New Contact From ".addslashes($companyName);
		$email_message = "Form details below.\n\n";
		$email_message .= "Name: ".clean_string($name)."\n";
		$email_message .= "Email: ".clean_string($email_from)."\n";
		$email_message .= "Telephone: ".clean_string($telephone)."\n";
		$email_message .= "Comments: ".clean_string($comments)."\n";
		
		if(send_mail($email_from, $EmailToSend, $email_subject, $email_message) !== false) {
			$fields['date'] = date("Y-m-d H:i:s"); $fields['admin_read'] = 0;
			$fields['Name'] = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : null;
			$fields['Email'] = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : null;
			$fields['Number'] = isset($_POST['telephone']) ? $conn->real_escape_string($_POST['telephone']) : null;
			$fields['Message'] = isset($_POST['comments']) ? $conn->real_escape_string($_POST['comments']) : null;
			$sql	= InsertInTable('contact',$fields);
			if($conn->query($sql) == true) echo "Your Message Has Been Successfully Sent !";
			else echo $conn->error;
		}
	}
?>
<?php
	if(isset($_POST['forgotPassword'])) {
		$check = "SELECT * FROM users ";
		$check.= "WHERE username='".addslashes($_POST['username'])."' ";
		$check.= "OR mobile_number LIKE '%".addslashes($_POST['username'])."' ";
		$check_result	= $conn->query($check);
		if($check_result->num_rows != 0) {
			$check_row	= $check_result->fetch_array();
			$email_to 		= isset($_POST['username']) ? addslashes($_POST['username']) : null;
			$email_from 	= "no-reply@dhakasolution.com";
			$email_subject 	= "Forgot Your Password!";
				
	    $email_message = "<img src='".$base."images/logo.png' style='width: 150px' /><br/>";
			$email_message.= "<h2>".$companyName." Password Reset</h2><br/>";
			$email_message.= "<b>Your Email Address: </b>".$email_to."<br/>";
			$email_message.= "<b>Your Password: </b><span style='color: #f00;'>".addslashes($check_row['password'])."</span><br/><br/>";
			$email_message.= "Now go back to <a href='".$base."login'> login </a> page and login again ! ";
			if(send_mail($email_from, $email_to, $email_subject, $email_message) !== false) exit("Password has been sent ! Please Check your Email");
			else exit('No mail integretted !');
		} else exit("No User Found !");
	}
?>
<?php 
	if(isset($_POST['comment_submit'])) {
		$fields['name'] = isset($_POST['Name']) ? $conn->real_escape_string($_POST['Name']) : null;
		$fields['email'] = isset($_POST['Email']) ? $conn->real_escape_string($_POST['Email']) : null;
		$fields['message'] = isset($_POST['Message']) ? $conn->real_escape_string($_POST['Message']) : null;
		$fields['prid'] = isset($_POST['prid']) ? $conn->real_escape_string($_POST['prid']) : null;
		$fields['admin_read'] = 0; $fields['date']	= date("Y-m-d H:i:s");
		
		$sql = InsertInTable('product_comments', $fields);
		if($conn->query($sql)) {
?>
	<div class="media">
		<div class="media-left">
			<img src="images/man3.png" class="media-object" style="width:60px">
		</div>
		<div class="media-body">
			<span class="pull-right"><?= date('F j, Y', strtotime($fields['date'])) ?></span>
			<h4 class="media-heading"><?= $fields['name'] ?></h4>
			<p><?= $fields['message'] ?></p>
		</div>
	</div><hr/>
<?php
		} else echo $conn->error;
	}
?>
<?php 
	if(isset($_POST['quick_view'])) {
		$prid	= $_POST['prid'];
		$row_details	= details_page($prid);
		$ava_images		= $row_details['images'];
		$ava_color		= $row_details['colors'];
		$ava_colors		= explode(',', $ava_color);
?>
	<div class="modal-header">
		<h4 class="modal-title"><?php echo "{$row_details['name']}" ;?></h4>
	</div>
	<div class="modal-body">
		<div class="col-md-4 col-xs-12 col-sm-4">
			<div class="img-block1">
				<a href="">
					<?php 
						$thirtydays	= date('Y-m-d', strtotime('-10 days'));
						if(strtotime($thirtydays) < strtotime($row_details['date_added'])) {
					?>
						<p class="new-box1">
							<span class="new-label">New</span>
						</p>
					<?php 
						}
					?>
					<img src="<?php echo "proimg/{$row_details['id']}/{$ava_colors[0]}1.jpg" ?>" class="img-responsive">										
				</a>
			</div>
		</div>
		<div class="col-md-8 col-xs-12 col-sm-4 pdt-10">
			<p><strong>Brand:</strong> <?php echo $row_details['brand'] ;?></p>
			<p class="title"><strong>Price: </strong><?php echo ' BDT '.$row_details['price'] ;?></p>
			<div class="description" style="max-height: 7.5em; overflow: hidden; margin-bottom: 10px;"><?php echo $row_details['description']; ?></div>
			<?php
				$ava_size	= $row_details['size'];
				
				if($ava_size != '' && $ava_size != NULL) {
					$ava_size	= explode(',',$ava_size);
				
			?>
			<ul class="Sizepdc">
				<p>Available Sizes :</p>
				<?php
					foreach($ava_size as $row_ava_size) {
				?>
				<li class="pr-size-btn" data-size="<?php echo "{$row_ava_size}" ?>"><?php echo "{$row_ava_size}" ?></li>
				<?php }	?>
			</ul>
			<?php 	
				}	
				if(!empty($ava_color)) {
					$ava_color	= explode(',', $ava_color);
			?>
			<ul class="colorpdc">
				<p>Available Colors :</p>
				<?php
					foreach($ava_color as $row_ava_color) {
						$image_key	= array_search("{$row_ava_color}", $ava_color);
						$row_ava_image	= $ava_images[$image_key];	
				?>
				<li class="color1" onclick="image_change('<?php echo htmlspecialchars($row_ava_color); ?>', '<?php echo $row_ava_image; ?>', this)" style="background: <?php echo "{$row_ava_color}"; ?>"></li>
				<?php } ?>
			</ul>
			<?php }	?>
		</div>
		<div class="clearfix"></div>
	</div>
<?php
	}
?>
<?php
	if(isset($_POST['add_to_cart'])) {
		if(isset($_SESSION['prids']) && !empty($_SESSION['prids'])) {
			$prids = explode(',', $_SESSION['prids']); $quantity	= explode(',', $_SESSION['qty']);
			$size = explode(',', $_SESSION['size']); $color = explode(',', $_SESSION['color']); 
			$check_prid = array_search($_POST['prid'], $prids);
			if($check_prid !== false){
				foreach(array_unique($prids) as $uniquePrid){
					$v = array_keys($prids, $uniquePrid);
					if(count($v) > 1){
						foreach($v as $key){
							$check_size = $size[$key]; $check_color = $color[$key];
							if($check_color == $_POST['color'] && $check_size == $_POST['size']) $match = $key;
						}
					} else {
						$check_size = $size[$check_prid]; $check_color = $color[$check_prid];
						if($check_color == $_POST['color'] && $check_size == $_POST['size']) $match	= $check_prid;
					}
				}
				if(isset($match)) {
					$quantity[$match]	= $quantity[$match] + $_POST['qty'];
					$new_qty = implode(',', $quantity);
					$prids	= $_SESSION['prids']; $qty	= $new_qty;
					$size	= $_SESSION['size']; $color	= $_SESSION['color'];
				} else {
					$prids	= $_SESSION['prids'].','.$_POST['prid'];
					$qty	= $_SESSION['qty'].','.$_POST['qty'];
					$size	= $_SESSION['size'].','.$_POST['size'];
					$color	= $_SESSION['color'].','.$_POST['color'];
				}
			} else {
				$prids	= $_SESSION['prids'].','.$_POST['prid'];
				$qty	= $_SESSION['qty'].','.$_POST['qty'];
				$size	= $_SESSION['size'].','.$_POST['size'];
				$color	= $_SESSION['color'].','.$_POST['color'];
			}
		} else {
			$prids	= $_POST['prid'];
			$qty	= $_POST['qty'];
			$size	= $_POST['size'];
			$color	= $_POST['color'];
		}
		$_SESSION['prids']	= $prids;
		$_SESSION['qty']	= $qty;
		$_SESSION['size']	= $size;
		$_SESSION['color']	= $color;
		exit;
	}
?>
<?php 
	if(isset($_POST['update_cart'])) {
		$key = isset($_POST['prid']) ? $_POST['prid'] : exit;
		$new_qty = isset($_POST['qty']) ? $_POST['qty'] : exit;
		$quantity = explode(',', $_SESSION['qty']);
		$quantity[$key]= $new_qty;
		$quantity_new = implode(',', $quantity);
		$_SESSION['qty'] = $quantity_new;
		exit;
	}
?>
<?php
	if(isset($_POST['delete_from_cart'])) {
		$key	= isset($_POST['prid']) ? $_POST['prid'] : exit;
		$prids = explode(',', $_SESSION['prids']); $quantity	= explode(',', $_SESSION['qty']);
		$size = explode(',', $_SESSION['size']); $color = explode(',', $_SESSION['color']);
		
		unset($prids[$key]); unset($quantity[$key]);
		unset($size[$key]); unset($color[$key]);
		
		$_SESSION['prids'] = implode(',', $prids); $_SESSION['qty'] = implode(',', $quantity);
		$_SESSION['size'] = implode(',', $size); $_SESSION['color'] = implode(',', $color);
		exit;
	}
?>