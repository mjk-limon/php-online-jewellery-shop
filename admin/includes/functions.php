<?php
	/*===== Common Functions =====*/
	function restyle_url($url) {
		$from = array("-", "~", "!", "#", "^", "*", "(", ")", "'", "\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ");
		$to = array("-dash-", "-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-", "-dquote-", "-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-");
		
		$restyle	= trim(strtolower($url));
		$restyle	= str_replace($from, $to, $restyle);
		$restyle	= str_replace("--", "~", $restyle);
		return $restyle;
	}
	function get_url_variables($variable) {
		$variable	= str_replace("~", "--", $variable);
		$from = array("-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-", "-dquote-", "-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-", " dash ");
		$to = array("~", "!", "#", "^", "*", "(", ")", "'", "\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ", "-");
		
		$restyle	= trim($variable);
		$restyle	= str_replace($from, $to, $restyle);
		return $restyle;
	}
	function restyle_text($input){
		$input = number_format($input);
		$input_count = substr_count($input, ',');
		if($input_count != '0'){
			if($input_count == '1') return substr($input, 0, -4).'K';
			else if($input_count == '2') return substr($input, 0, -8).'M';
			else if($input_count == '3') return substr($input, 0,  -12).'B';
			else return;
		} else {
			return $input;
		}
	}
	function get_paging($total_item, $item_per_page, $current_page, $target_url) {
		$total_page = $total_item/$item_per_page;
		$total_page = (is_float($total_page)) ? intval($total_page+1) : $total_page;
		echo '<li class="page-item'; if($current_page < 2)echo ' disabled'; echo '"><a class="page-link" href="'.$target_url.'page='.($current_page-1).'">Previous</a></li>';
		for($pagei = 1; $pagei <= $total_page; $pagei++) {
			echo '<li class="page-item'; if($current_page == $pagei) echo ' active'; echo '"><a class="page-link" href="'.$target_url.'page='.$pagei.'">'.$pagei.'</a></li>';
		}
		echo '<li class="page-item'; if($current_page == $total_page)echo ' disabled'; echo '"><a class="page-link" href="'.$target_url.'page='.($current_page+1).'">Next</a></li>';
	}
	function get_user_info($extra_sql=true) {
		return get_single_data("users", $extra_sql);
	}
	function get_menu($extra_sql=true) {
		return get_some_data("procat", $extra_sql." GROUP BY main ORDER BY position ASC", "id,main,position");
	}
	function get_header_by_menu($main, $extra_sql=true){
		return get_some_data("procat", $extra_sql." AND main='".addslashes($main)."' GROUP BY header ORDER BY id ASC", "id,main,header");
	}
	function get_sub_by_menu($main, $extra_sql=true)  {
		return get_some_data("procat", $extra_sql." AND main='".addslashes($main)."' GROUP BY sub ORDER BY id ASC", "id,main,header,sub");
	}
	function get_sub_by_header($main, $header, $extra_sql=true){
		return get_some_data("procat", $extra_sql." AND main='".addslashes($main)."' AND header='".addslashes($header)."' GROUP BY sub ORDER BY id ASC", "id,main,sub,header");
	}
	function get_sub_items_by_sub($main, $header, $sub, $extra_sql=true){
		return get_some_data("procat", $extra_sql." AND main='".addslashes($main)."' AND header='".addslashes($header)."' AND sub='".addslashes($sub)."' ORDER BY id ASC");
	}
	function get_sliders($page, $position, $needed_index='*') {
		return get_some_data("sliders", "page='{$page}' AND position='{$position}' ORDER BY id ASC", $needed_index);
	}
	function get_stickers($page, $position, $needed_index='*') {
		return get_single_data("sliders", "page='{$page}' AND position='{$position}'",  $needed_index);
	}
	function get_inner_page($extra_sql=true) {
		return get_some_data("page_contents", $extra_sql);
	}
	function get_order_history($extra_sql){
		return get_some_data("p_order", $extra_sql);
	}
	function get_contact_information($index) {
		return get_single_index_data("contact_information", true, $index);
	}
	function get_products($extra_sql=true, $needed_index='*') {
		return get_some_data("products", $extra_sql, $needed_index);
	}
	function product_details($prid, $needed_index='*') {
		return get_single_data("products", "id='{$prid}'", $needed_index);
	}
	function get_product_price($originalPrice, $discount, $currency, $onlyPrice = false) {
		global $currencyRate;
		$discount_in_taka = $originalPrice*($discount/100);
		$dprice = $originalPrice - $discount_in_taka;
		$converted_price = round((1/$currencyRate[$currency]) * $originalPrice, 2);
		$converted_dprice = round((1/$currencyRate[$currency]) * $dprice, 2);
		return  (!$onlyPrice) ? $currency ." ". $converted_dprice : $converted_dprice;
	}
	function get_all_brands() {
		return get_all("products", "GROUP BY brand ORDER BY id DESC ", "id,brand");
	}
	function get_brands_by_menu($main) {
		return get_some_data("products", "category='".addslashes($main)."' GROUP BY brand ORDER BY id DESC", "id,category,brand");
	}
	/*===== Main Site Functions =====*/
	function get_title($page_name='index')  {
		global $base, $companyName;
		switch ($page_name){
			case 'index' : return get_single_index_data('site_settings', true, 'title'); break;
			case 'product-page': global $main, $sub; return ucwords($main).' - '.ucwords($sub).' || '.$companyName; break;
			case 'details-page': global $product_name; return $product_name.' - '.$companyName; break;
			case 'inner-page': global $page_header; return $page_header.' - '.$companyName; break;
			case 'search-page': global $search; return $search.' - '.$companyName; break;
			default: return $page_name.' - '.$companyName;
		}
	}
	function get_caret_price()  {
		global $conn;
		return get_single_index_data("site_settings", "1", "caret_price");
	}
	$caretRate = get_caret_price();
	function cart_total() {
		$prids = isset($_SESSION['prids']) ? $_SESSION['prids'] : null;
		$qty = isset($_SESSION['qty']) ? $_SESSION['qty'] : null;
		if(empty($prids)) return 0;
		else {
			$prids = explode(',' , $prids) ; $qty = explode(',' , $qty) ; $total = 0;
			for($i=0 ; $i<count($prids) ; $i++) $total	= $total+(1*$qty[$i]);
			return $total;
		}
	}
	function get_cart_information($index) {
		if(isset($_SESSION['prids']) && !empty($_SESSION['prids'])) {
			$prids = explode(',', $_SESSION['prids']) ; $qty = explode(',' , $_SESSION['qty']);
			$size = explode(',', $_SESSION['size']) ; $color = explode(',' , $_SESSION['color']);
			$subtotal	= 0; $discount_total = 0;
			for($i = 0;$i < count($prids) ;$i++) {
				$prid = $prids[$i];
				$row_details	= product_details($prid, "price,discount");
				$unit_price		= $row_details['price'];
				$unit_discount	= $row_details['price']*($row_details['discount']/100);
				$unit_dprice	= $unit_price-$unit_discount;
				
				$item_price_total		= $unit_dprice*$qty[$i];
				$item_discount_total	= $unit_discount*$qty[$i];
				
				$subtotal			= $subtotal+$item_price_total;
				$discount_total		= $discount_total+$item_discount_total;
			}
			$output_array	= array("subtotal" => $subtotal, "discount_total" =>  $discount_total, "total_without_discount" => $subtotal+$discount_total);
			return $output_array[$index];
		} else {
			$output_array	= array("subtotal" => 0,"discount_total" => 0, "total_without_discount" => 0);
			return $output_array[$index];
		}
	}
	function get_product_suggestion($main, $limit, $extra_sql=true, $needed_index='*') {
		return get_some_data("products", $extra_sql." AND category='".addslashes($main)."' ORDER BY RAND() LIMIT {$limit}", $needed_index);
	}
	function get_product_comments($prid, $needed_index='*'){
		return get_some_data("product_comments", "prid='{$prid}' ORDER BY id DESC", $needed_index); 
	}
	function update_page_view($count) {
		global $conn;
		$count = $count+1;
		$update = "UPDATE site_settings SET page_view = '{$count}' WHERE 1";		
		$conn->query($update);
	}
	/*===== Admin Panel Functions =====*/
	function get_admin($extra_sql=true){
		return get_some_data("admins", $extra_sql);
	}
	function get_page_view() {
		return get_single_index_data("site_settings", true, "page_view");
	}
	function get_messages($extra_sql=true) {
		return get_some_data("contact", $extra_sql);
	}
	function get_orders($extra_sql=true) {
		return get_some_data("p_order", $extra_sql);
	}
	function get_comments($extra_sql=true) {
		return get_some_data("product_comments", $extra_sql);
	}
	function get_product_id(){
		global $min_prid;
		return get_max("products", "id", $min_prid) + 1;
	}
	function get_registered_users() {
		return get_all("users", "ORDER BY id DESC ");
	}
	function get_edit_field_name_and_label($input){
		switch ($input) {
			case 1: $label = 'Image'; $name = 'image'; break;
			case 2: $label = 'Image Link'; $name = 'image_link'; break;
			case 3: $label = 'Image Heading'; $name = 'image_heading'; break;
			case 4: $label = 'Heading Link'; $name = 'heading_link'; break;
			case 5: $label = 'Text Line 1'; $name = 'image_text1'; break;
			case 6: $label = 'Text Line 1 Link'; $name = 'text1_link'; break;
			case 7: $label = 'Text Line 2'; $name = 'image_text2'; break;
			case 8: $label = 'Text Line 2 Link'; $name = 'text2_link'; break;
			case 9: $label = 'Text Line 3'; $name = 'image_text3'; break;
			case 10: $label = 'Text Line 3 Link'; $name	= 'text3_link'; break;
			default: return false;
		}
		$output	= array('label' => $label, 'name' => $name);
		return $output;
	}
	function adminMessage($background, $html, $cv=false) {
		global $_SERVER;
		$href = $_SERVER['REQUEST_URI'];
		$query = parse_url( $href, PHP_URL_QUERY );
		parse_str( $query, $params );
		$params['emsg'] = ($background == 'red') ?  $html : null;
		$params['smsg'] = ($background == 'green') ?  $html : null;
		if($cv){foreach(explode(',',$cv) as $pv)$params[$pv] = null;}
		$query = http_build_query( $params );
		header('Location: '. explode( '?', $href )[0] . '?' . $query);
	}
	/*===== Compulsory Functions =====*/
	function get_min($table, $index, $extra_sql=true) {
		global $conn;
		$get = "SELECT MIN({$index}) as {$index} FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		if(empty($row[$index])) { return 0;}
		else { return $row[$index]; }
	}
	function get_max($table, $index, $min, $extra_sql=true) {
		global $conn;
		$get = "SELECT MAX({$index}) as {$index} FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		if(empty($row[$index])) { return $min;}
		else { return $row[$index]; }
	}
	function get_sum_of_index($table, $index, $extra_sql=true){
		global $conn;
		$get = "SELECT SUM({$index}) AS {$index} FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		if(empty($row[$index])) { return 0;}
		else { return $row[$index]; }
	}
	function get_total_rows($table, $extra_sql=true, $needed_index='*'){
		global $conn;
		$get = "SELECT ".$needed_index." FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get); $num = $result->num_rows;
		return $num;
	}
	function get_all($tablename, $extra_sql=true, $needed_index='*') {
		global $conn;
		$get = "SELECT ".$needed_index." FROM {$tablename} ";
		$get .= $extra_sql;
		$result = $conn->query($get);
		return $result;
	}
	function get_some_data($tablename, $condition, $needed_index='*') {
		global $conn;
		$get = "SELECT ".$needed_index." FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		return $result;
	}
	function get_single_data($tablename, $condition, $needed_index='*') {
		global $conn;
		$get = "SELECT ".$needed_index." FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row;
	}
	function get_single_index_data($tablename, $condition, $index) {
		global $conn;
		$get = "SELECT ".$index." FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row[$index];
	}
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime; $ago = new DateTime($datetime); $diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7); $diff->d -= $diff->w * 7;
		$string = array(
			'y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 
			'h' => 'hour', 'i' => 'minute', 's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if($diff->$k){$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');}
			else{unset($string[$k]);}
		}
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	function random_token() {
		$alpha = "abcdefghijklmnopqrstuvwxyz"; $alpha_upper = strtoupper($alpha);
		$numeric = "0123456789"; $special = ".-+=_,!@$#*%<>[]{}"; $chars = "";
		$chars = $alpha . $alpha_upper . $numeric; $length = 16;
		$len = strlen($chars); $pw = '';
		for($i=0; $i<$length; $i++) $pw .= substr($chars, rand(0, $len-1), 1);
		return str_shuffle($pw);
	}
	function upload_image($imageName, $imageArray, $outputFolder){
		$target_path = "../".basename($_FILES[$imageName]['name'][$imageArray]);
		$imageFileType = pathinfo($target_path,PATHINFO_EXTENSION);
		$image_temp_name = (!empty($_FILES[$imageName]['tmp_name'][$imageArray])) ? $_FILES[$imageName]['tmp_name'][$imageArray] : "../index.php";
		if(!getimagesize($image_temp_name)) $error_message = "Uploaded file is not a image or Too large file !";
		if($_FILES[$imageName]["size"][$imageArray] > 2000000) $error_message = $_FILES[$imageName]["size"][$imageArray]. " Uploaded file must be less than 2M";
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !=   "jpeg" && $imageFileType != "gif") $error_message = "Incorrect Image Format";
		
		if(isset($error_message) && strlen($error_message) > 0) {
			adminMessage('red', $error_message); return false;
		} else {
			if(move_uploaded_file($_FILES[$imageName]['tmp_name'][$imageArray], $target_path)){
				if(!file_exists($outputFolder)) mkdir($outputFolder, 0777, true);
				$file = basename($_FILES[$imageName]['name'][$imageArray]);
				rename($target_path , $outputFolder.$file); return $outputFolder.$file;
			}
			else {adminMessage("red", "Error uploading file !"); return false;}
		}
	}
	function upload_image_noArray($imageName, $outputFolder){
		$target_path = "../".basename($_FILES[$imageName]['name']);
		$image_temp_name = (!empty($_FILES[$imageName]["tmp_name"])) ? $_FILES[$imageName]["tmp_name"] : "../index.php";
		if((!empty($image_tmp_name)) && (getimagesize($image_tmp_name==false))) $error_message = "Uploaded file is not a image or Too large file !";
		if(getimagesize($_FILES[$imageName]["tmp_name"]) == false) $error_message = "Uploaded file is not a image";
		if($_FILES[$imageName]["size"] > 2000000) $error_message = "Uploaded file must be less than 2M";
		
		if(isset($error_message) && strlen($error_message) > 0) {
			adminMessage('red', $error_message); return false;
		} else {
			if(move_uploaded_file($_FILES[$imageName]['tmp_name'], $target_path)) {
				if(!file_exists($outputFolder)) mkdir($outputFolder, 0777, true);
				$file = basename($_FILES[$imageName]['name']);
				rename($target_path , $outputFolder.$file); return $outputFolder.$file;
			} else {adminMessage('red', 'Error Uploading File ');return false;}
		}
	}
	function resize_image($newWidth, $newHeight, $targetFile, $originalFile, $delete_original=true) {
		$info = getimagesize($originalFile); $mime = $info['mime'];
		switch ($mime) {
			case 'image/jpeg':
				$image_create_func = 'imagecreatefromjpeg';
				$image_save_func = 'imagejpeg';
				$new_image_ext = 'jpg';
				break;
			case 'image/png':
				$image_create_func = 'imagecreatefrompng';
				$image_save_func = 'imagepng';
				$new_image_ext = 'png';
				break;
			case 'image/gif':
				$image_create_func = 'imagecreatefromgif';
				$image_save_func = 'imagegif';
				$new_image_ext = 'gif';
				break;
			default: throw new Exception('Unknown image type.');
		}
		$img = $image_create_func($originalFile);
		list($width, $height) = getimagesize($originalFile);
		
		$newWidth = (empty($newWidth)) ? $width : $newWidth;
		$newHeight = (empty($newHeight)) ? (($height/$width)*$newWidth) : $newHeight;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

		if($delete_original && file_exists($originalFile)) unlink($originalFile);
		$image_save_func($tmp, "{$targetFile}.{$new_image_ext}");
		return $new_image_ext;
	}
	function get_image_information($originalFile) {
		if(file_exists($originalFile) && $originalFile != "../"){
			if($info = getimagesize($originalFile)) {
				$mime = $info['mime'];
				switch ($mime) {
					case 'image/jpeg': $image_extension = 'jpg'; break;
					case 'image/png': $image_extension = 'png'; break;
					case 'image/gif': $image_extension = 'gif'; break;
					default: throw new Exception('Unknown image type.');
				}
				list($width, $height) = getimagesize($originalFile);
				return array($width, $height, $image_extension);
			} else return array(0, 0, 'Unknown');
		} else return array(0, 0, 'Unknown');
	}
	function send_mail($email_from, $email_to, $email_subject, $messageBody) {
		if(!isset($messageBody) || strlen($messageBody) <= 5) {
			echo 'Message content must be greater than 5 letter...'; return false;		
		} else {
			$bad 	= array("content-type","bcc:","to:","cc:");
			$Xman = array("\r\n","\n");
			$email_message	= str_replace($bad, "", $messageBody);
			$email_message	= str_replace($Xman, "<br>", $email_message);
		}
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers.= 'From: '.$email_from."\r\n";
		return mail($email_to, $email_subject, $email_message, $headers);
	}
	function InsertInTable($table,$fields){
		$sql = "INSERT INTO {$table} (".implode(" , ",array_keys($fields)).") ";
		$sql.= "VALUES('";      
		foreach($fields as $key => $value) $fields[$key] = $value;
		$sql.= implode("' , '",array_values($fields))."');";       
		return $sql;
	}
	function UpdateTable($table,$fields,$condition) {
		$sql = "UPDATE {$table} SET ";
		foreach($fields as $key => $value) $fields[$key] = " {$key} = '{$value}' ";
		$sql.= implode(" , ",array_values($fields))." WHERE ".$condition.";";  
		return $sql;
	}
	function DeleteTable($tablename, $condition) {
		$sql= "DELETE FROM {$tablename} ";
		$sql.= "WHERE {$condition}" ;
		return $sql;
	}
	function deleteDir($dir) { 
		if(!file_exists($dir)) return false;
		else {
			$files = array_diff(scandir($dir), array('.','..')); 
			foreach ($files as $file) { 
				(is_dir("{$dir}/{$file}")) ? deleteDir("{$dir}/{$file}") : unlink("{$dir}/{$file}"); 
			}
			return rmdir($dir); 
		}
	}