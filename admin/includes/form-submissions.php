<?php
	if(isset($_POST['send_mail'])) {
		$email_to			= $conn->real_escape_string($_POST['email']);
		$email_subject= $conn->real_escape_string($_POST['subject']);
		$messageBody	= $conn->real_escape_string($_POST['message']);
		$email_from		= get_contact_information('email');
		
		if(!isset($messageBody) || strlen($messageBody) <= 5) exit('Message content must be greater than 5 letter...');		
		else {
			$email_message	= str_replace(array("content-type","bcc:","to:","cc:"),"",$messageBody);
			$email_message	= str_replace(array("\r\n","\n"),"<br>",$email_message);
		}
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$email_from."\r\n";
		if(mail($email_to, $email_subject, $email_message, $headers)) adminMessage('green', 'Email Successfully Sent !');
		else adminMessage('red', 'No Mailer Integrated !');
	}
	if(isset($_GET['update_mail_status'])) {
		$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : exit(header('Location: site-data.php?dt=msg'));
		$fields['admin_read']	= $conn->real_escape_string($_GET['value']);
		$sql	= UpdateTable('contact',$fields," id = '{$id}' ");
			
		if($conn->query($sql) == true) header("Location:site-data.php?dt=msg#mail-".$id);
		else adminMessage('red', $conn->error);
	}
	if(isset($_GET['update_order_status'])) {
		$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : exit(header('Location: site-data.php?dt=odr'));
		$fields['admin_read']	= $conn->real_escape_string($_GET['value']);
		$sql	= UpdateTable('p_order',$fields," id = '{$id}' ");
		if($conn->query($sql) == true) header("Location:site-data.php?dt=odr#order-".$id);
		else adminMessage('red', $conn->error);
	}
	if(isset($_POST['update_admin_info'])) {
		if($_POST['password'] == $_POST['password2']){
			$id = isset($_POST['id']) ? $conn->real_escape_string($_POST['id']) : exit(header('Location: site-data.php?dt=adm'));
			$fields['Token']	= random_token();
			$fields['password']	= $conn->real_escape_string($_POST['password']);
			$sql = UpdateTable('admins',$fields," id = '{$id}' ");
			if($conn->query($sql) == true) adminMessage('green', "Successfully updated admin info !");
			else adminMessage('red', $conn->error);
		} else adminMessage('red', "Two password don't match !");
	}
	if(isset($_POST['add_new_admin'])) {
		if($_POST['password'] == $_POST['password2']){
			$fields['username']	= $conn->real_escape_string($_POST['username']);
			$fields['password']	= $conn->real_escape_string($_POST['password']);
			$fields['date_added']	= date("d/m/Y");
			$fields['Token']	= random_token();
			$sql = InsertInTable('admins',$fields);
			if($conn->query($sql) == true) adminMessage('green', "Successfully updated admin info !");
			else adminMessage('red', $conn->error);
		} else adminMessage('red', "Two password don't match !");
	}
	if(isset($_POST['update_title'])) {
		if(!empty($_FILES['image']['name'])) {
			$file = upload_image_noArray("image", "../");
			if($file !== false) rename($file, "../favicon.ico");
		}
		$fields['title']	= mysqli_real_escape_string($conn, $_POST['title']);
		$sql = UpdateTable('site_settings',$fields,'1');
		if($conn->query($sql)==true) adminMessage('green', 'Successfully Updated Title');
		else adminMessage('red', $conn->error);
	}
	if(isset($_POST['update_caret'])) {
		$fields['caret_price']	= mysqli_real_escape_string($conn, $_POST['title']);
		$sql = UpdateTable('site_settings',$fields,'1');
		if($conn->query($sql)==true) adminMessage('green', 'Successfully Updated Caret Price');
		else adminMessage('red', $conn->error);
	}
	if(isset($_POST['update_logo'])) {
		if(!empty($_FILES['image']['name'])) {
			$file = upload_image_noArray("image", "../");
			if($file !== false) rename($file, "../images/logo.png");
			adminMessage('green', 'Successfully updated logo !');
		} else adminMessage('red', 'No file selected !');
	}
	if(isset($_POST['update_contact_information'])) {
		$fields['address']	= $conn->real_escape_string($_POST['address']);
		$fields['address2']	= $conn->real_escape_string($_POST['address2']);
		$fields['mobile1']	= $conn->real_escape_string($_POST['mobile1']);
		$fields['mobile2']	= $conn->real_escape_string($_POST['mobile2']);
		$fields['mobile3']	= $conn->real_escape_string($_POST['mobile3']);
		$fields['phone']		= $conn->real_escape_string($_POST['phone']);
		$fields['email']		= $conn->real_escape_string($_POST['email']);
		$fields['facebook']	= $conn->real_escape_string($_POST['facebook']);
		$fields['twitter']	= $conn->real_escape_string($_POST['twitter']);
		$fields['instagram']	= $conn->real_escape_string($_POST['instagram']);
		$fields['googleplus']= $conn->real_escape_string($_POST['googleplus']);
		$fields['gmail']		= $conn->real_escape_string($_POST['gmail']);
		$fields['youtube']	= $conn->real_escape_string($_POST['youtube']);
		$fields['yahoo']		= $conn->real_escape_string($_POST['yahoo']);
		$fields['skype']		= $conn->real_escape_string($_POST['skype']);

		$sql	= UpdateTable('contact_information',$fields,'1');
		if($conn->query($sql)) adminMessage('green', 'Successfully Updated Contact Information');
		else adminMessage('red', $conn->error);
	}
	if(isset($_POST['comment_reply'])) {
		$cmntid = $conn->real_escape_string($_POST['cmnt_id']); 
		$fields['name'] = $conn->real_escape_string($companyName);
		$fields['email'] = $conn->real_escape_string(get_contact_information('email'));
		$fields['message'] = $conn->real_escape_string($_POST['text']);
		$fields['prid'] = $conn->real_escape_string($_POST['prid']);
		$fields['admin_read'] = $ufields['admin_read'] = 1;
		
		$insert_sql	= InsertInTable('product_comments', $fields);
		$update_sql	= UpdateTable('product_comments', $ufields, "id='{$cmntid}'");
		if($conn->query($insert_sql) && $conn->query($update_sql)) 
			adminMessage('green', 'Successfully replied comment !');
		else adminMessage('red', $conn->error);
	}
	if(isset($_POST['add_banner_slider'])) {
		$fields['image_heading']= isset($_POST['image_heading']) ? $conn->real_escape_string($_POST['image_heading']) : '';
		$fields['image_text1']	= isset($_POST['image_text1']) ? $conn->real_escape_string($_POST['image_text1']) : '';
		$fields['image_text2']	= isset($_POST['image_text2']) ? $conn->real_escape_string($_POST['image_text2']) : '';
		$fields['image_text3']	= isset($_POST['image_text3']) ? $conn->real_escape_string($_POST['image_text3']) : '';
		$fields['image_link']	= isset($_POST['image_link']) ? $conn->real_escape_string($_POST['image_link']) : '';
		$fields['heading_link']	= isset($_POST['heading_link']) ? $conn->real_escape_string($_POST['heading_link']) : '';
		$fields['text1_link']	= isset($_POST['text1_link']) ? $conn->real_escape_string($_POST['text1_link']) : '';
		$fields['text2_link']	= isset($_POST['text2_link']) ? $conn->real_escape_string($_POST['text2_link']) : '';
		$fields['text3_link']	= isset($_POST['text3_link']) ? $conn->real_escape_string($_POST['text3_link']) : '';
		$fields['page'] = $page = $conn->real_escape_string($_POST['page']);
		$fields['position'] = $position = $conn->real_escape_string( $_POST['position']);
		$imgSize = (isset($_POST['imgsize']) && $_POST['imgsize']!=',') ? explode(',',$_POST['imgsize']) : array(1920,0);
		
		if(!empty($_FILES["image"]['name'])) {
			$file = upload_image_noArray("image", "../images/slider/");
			if($file !== false)
				$ext = resize_image($imgSize[0],$imgSize[1],"../images/slider/{$page}-{$position}-".date("Y-m-d_H-i-s"), $file);
			$fields['image'] = "images/slider/{$page}-{$position}-".date("Y-m-d_H-i-s").".".$ext;
			$sql = InsertInTable('sliders',$fields);
			if($conn->query($sql)==true) adminMessage('green', 'Successfully Added Banner');
			else adminMessage('red', $conn->error);
		} else adminMessage('red','Product Image Not Found');
	}
	if(isset($_POST['update_banner_slider'])) {
		$id = $conn->real_escape_string($_POST['slider_id']);
		
		$fields['image_heading']= isset($_POST['image_heading']) ? $conn->real_escape_string($_POST['image_heading']) : '';
		$fields['image_text1']	= isset($_POST['image_text1']) ? $conn->real_escape_string($_POST['image_text1']) : '';
		$fields['image_text2']	= isset($_POST['image_text2']) ? $conn->real_escape_string($_POST['image_text2']) : '';
		$fields['image_text3']	= isset($_POST['image_text3']) ? $conn->real_escape_string($_POST['image_text3']) : '';
		$fields['image_link']	= isset($_POST['image_link']) ? $conn->real_escape_string($_POST['image_link']) : '';
		$fields['heading_link']	= isset($_POST['heading_link']) ? $conn->real_escape_string($_POST['heading_link']) : '';
		$fields['text1_link']	= isset($_POST['text1_link']) ? $conn->real_escape_string($_POST['text1_link']) : '';
		$fields['text2_link']	= isset($_POST['text2_link']) ? $conn->real_escape_string($_POST['text2_link']) : '';
		$fields['text3_link']	= isset($_POST['text3_link']) ? $conn->real_escape_string($_POST['text3_link']) : '';
		$fields['page'] = $page = $conn->real_escape_string($_POST['page']); 
		$fields['position'] = $position = $conn->real_escape_string($_POST['position']);
		$imgSize = (isset($_POST['imgsize']) && $_POST['imgsize']!='0,0') ? explode(',',$_POST['imgsize']) : array(1920,0);
		
		if(!empty($_FILES["image"]['name'])) {
			if(file_exists('../'.$_POST['old_image']) && !is_dir('../'.$_POST['old_image'])) unlink('../'.$_POST['old_image']);
			$file = upload_image_noArray("image", "../images/slider/");
			if($file !== false)
				$ext = resize_image($imgSize[0],$imgSize[1],"../images/slider/{$page}-{$position}-".date("Y-m-d_H-i-s"), $file);
			$fields['image'] = "images/slider/{$page}-{$position}-".date("Y-m-d_H-i-s").".".$ext;
			adminMessage('green', 'Successfully Updated Banner');
		}
		
		$sql	= UpdateTable('sliders',$fields, "id='{$id}'");
		if($conn->query($sql) == true) adminMessage('green', 'Successfully Updated Banner');
		else adminMessage('red', $conn->error);
	}
	if(isset($_POST['update_banner_slider_nodb'])) {
		$imgSize = (isset($_POST['imgsize']) && $_POST['imgsize']!='0,0') ? explode(',',$_POST['imgsize']) : array(0,0);
		if(!empty($_FILES["image"]['name'])) {
			if(file_exists("../".$_POST['old_image']) && !is_dir("../".$_POST['old_image'])) unlink("../".$_POST['old_image']);
			$file = upload_image_noArray("image", "../");
			if($file !== false) $ext = resize_image($imgSize[0],$imgSize[1],"../__tmp_up", $file);
			rename("../__tmp_up.".$ext, "../".$_POST['old_image']);
			adminMessage('green', "Successfully updated sticker !");
		} else adminMessage('red', "Upload image first !");
	}
	if(isset($_POST['update_inner_page'])) {
		$id	= $conn->real_escape_string($_POST['id']);
		$fields['header']	= $conn->real_escape_string($_POST['header']);
		$fields['content']	= $conn->real_escape_string($_POST['content']);
			
		$sql	= UpdateTable('page_contents',$fields,"id='{$id}'");	
		if($conn->query($sql) == true) adminMessage('green', 'Successfully Updated Page Content');
		else adminMessage('red', $conn->error);
	}
?>