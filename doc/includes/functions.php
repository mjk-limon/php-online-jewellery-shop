<?php
	function restyle_url($url){
		$from1 = array("-", "~", "!", "#", "^", "*", "(", ")", "'");
		$from2 = array("\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ");
		$to1 = array("-dash-", "-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-");
		$to2 = array("-dquote-", "-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-");
		
		$restyle = trim(strtolower($url));
		$restyle = str_replace(array_merge($from1,$from2), array_merge($to1,$to2), $restyle);
		$restyle = str_replace("--", "~", $restyle);
		return $restyle;
	}
	function get_url_variables($variable){
		$variable	= str_replace("~", "--", $variable);
		$from1 = array("-tide-", "-int-", "-hash-", "-caret-", "-star-", "-open-", "-close-", "-squote-", "-dquote-");
		$from2 = array("-comma-", "-percent-", "-and-", "-dollar-", "-at-", "-slash-", "-backslash-", "-semicolon-", "-", " dash ");
		$to = array("~", "!", "#", "^", "*", "(", ")", "'", "\"", ",", "%", "&", "$", "@", "/", "\\", ";", " ", "-");
		
		$restyle	= trim($variable);
		$restyle	= str_replace(array_merge($from1,$from2), $to, $restyle);
		return $restyle;
	}
	function device_checker(){
		global $_SERVER;
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		$mb_useragents = "/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|";
		$mb_useragents.= "elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|";
		$mb_useragents.= "mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket";
		$mb_useragents.= "|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ";
		$mb_useragents.= "(ce|phone)|xda|xiino/i";
		$mb_useragent2 = "/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)";
		$mb_useragent2.= "|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|";
		$mb_useragent2.= "avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|";
		$mb_useragent2.= "ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s";
		$mb_useragent2.= "|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|";
		$mb_useragent2.= "ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|";
		$mb_useragent2.= "gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht";
		$mb_useragent2.= "(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea";
		$mb_useragent2.= "|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt ";
		$mb_useragent2.= "|kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50";
		$mb_useragent2.= "\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do";
		$mb_useragent2.= "|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)";
		$mb_useragent2.= "|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)";
		$mb_useragent2.= "|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)";
		$mb_useragent2.= "|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek";
		$mb_useragent2.= "|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)";
		$mb_useragent2.= "|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)";
		$mb_useragent2.= "|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)";
		$mb_useragent2.= "|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up";
		$mb_useragent2.= "(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|";
		$mb_useragent2.= "vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700";
		$mb_useragent2.= "|yas\-|your|zeto|zte\-/i";
		if(preg_match($mb_useragents,$useragent)||preg_match($mb_useragent2,substr($useragent,0,4))) return 'mobile';
		else return 'desktop';
	}
	function random_token(){
		$alpha = "abcdefghijklmnopqrstuvwxyz"; $alpha_upper = strtoupper($alpha);
		$numeric = "0123456789"; $special = ".-+=_,!@$#*%<>[]{}"; $chars = "";
		$chars = $alpha . $alpha_upper . $numeric; $length = 16;
		$len = strlen($chars); $pw = '';
		for($i=0; $i<$length; $i++) $pw .= substr($chars, rand(0, $len-1), 1);
		return str_shuffle($pw);
	}
	function get_title(){
		global $_SERVER, $conn, $main, $prid, $page, $search, $companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/products") !== false) return ucwords($main).' - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/search") !== false) return 'Search: '.$search.' - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/details") !== false) return details_page($prid)['name'].' - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/cart") !== false) return 'Cart - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/checkout") !== false) return 'Checkout - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/login") !== false) return 'Login - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/register") !== false) return 'Register - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/my-account") !== false) return 'My Account - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/order-history") !== false) return 'Order History - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/contact") !== false) return 'Contact Us - '.$companyName;
		if(strpos($_SERVER['REQUEST_URI'], "/page") !== false) return ucwords(str_replace("-"," ",$page)).' - '.$companyName;
		else {
			$row = $conn->query("SELECT title FROM site_settings")->fetch_array();
			return $row['title'];
		}
	}
	function get_caret_price()  {
		global $conn;
		return get_single_index_data("site_settings", "1", "caret_price");
	}
	$caretRate = get_caret_price();
	function cart_total(){
		$prids = isset($_SESSION['prids']) ? $_SESSION['prids'] : '';
		$qty = isset($_SESSION['qty']) ? $_SESSION['qty'] : '';
		
		if(empty($prids)) $total = 0;
		else {
			$prids=explode(',' , $prids); $qty=explode(',' , $qty); $total= 0;
			$length	= count($prids);
			for($i=0 ; $i<$length ; $i++) $total	= $total+(1*$qty[$i]);
		}
		return $total;
	}
	function get_cart_information($index){
		global $caretRate;
		if(isset($_SESSION['prids']) && !empty($_SESSION['prids'])) {
			$prids = explode(',' , $_SESSION['prids']) ;
			$qty = explode(',' , $_SESSION['qty']) ;
			$size = explode(',' , $_SESSION['size']) ;
			$color = explode(',' , $_SESSION['color']) ;
			$length = count($prids); $subtotal = 0; $discount_total = 0;
			for($i = 0;$i < $length;$i++){
				$prid			= $prids[$i];
				$row_details	= details_page($prid);
				
				$unit_price = ($row_details['others'] == 2) ? $caretRate * $row_details['price'] : $row_details['price'];
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
	function get_browse_menu(){
		global $conn;
		$get = "SELECT id,main,position FROM procat ";
		$get.= "WHERE position='0' ORDER BY id ASC";
		$result_menu	= $conn->query($get);
		return  $result_menu;
	}
	function get_menu(){
		global $conn;
		$get = "SELECT main,main_bn,position FROM procat ";
		$get.= "WHERE position!='0' GROUP BY main ";
		$get.= "ORDER BY position ASC";
		$result_menu	= $conn->query($get);
		return  $result_menu;
	}
	function get_sub($main, $offset){
		global $conn;
		$get = "SELECT sub,main,header FROM procat ";
		$get.= "WHERE main= '".addslashes($main)."' GROUP BY sub ";
		$get.= "ORDER BY id ASC LIMIT 6 OFFSET {$offset} ";
		$result_sub	= $conn->query($get);
		return  $result_sub;
	}
	function get_header_by_menu($main){
		global $conn;
		$get = "SELECT header FROM procat ";
		$get.= "WHERE main= '".addslashes($main)."' ";
		$get.= "GROUP BY header ORDER BY id ASC";
		$result = $conn->query($get);
		return $result;
	}
	function get_sub_by_header($main,$header){
		global $conn;
		$get = "SELECT sub,main,header FROM procat ";
		$get.= "WHERE main= '".addslashes($main)."' ";
		$get.= "AND header='".addslashes($header)."' ";
		$get.= "GROUP BY sub ORDER BY id ASC";
		$result = $conn->query($get);
		return $result;
	}
	function get_subItems_by_sub($main,$header,$sub){
		global $conn;
		$get = "SELECT * FROM procat ";
		$get.= "WHERE main= '".addslashes($main)."' ";
		$get.= "AND header='".addslashes($header)."' ";
		$get.= "AND sub='".addslashes($sub)."' ORDER BY id ASC";
		$result = $conn->query($get);
		return $result;
	}
	function get_sliders($page, $position){
		global $conn;
		$sql = "SELECT * FROM sliders ";
		$sql.= "WHERE page='{$page}' AND position='{$position}' ";
		$sql.= "ORDER BY id ASC";
		$result	= $conn->query($sql);
		return $result;
	}
	function get_stickers($page, $position){
		global $conn;
		$sql = "SELECT * FROM sliders ";
		$sql.= "WHERE page='{$page}' AND position='{$position}'";
		$sql.= "ORDER BY id ASC";
		$result	= $conn->query($sql);
		$row = $result->fetch_array();
		return $row;
	}
	function get_inner_page($page){
		global $conn;
		$get = "SELECT * FROM page_contents WHERE page='{$page}'";
		$result = $conn->query($get);
		return $result;
	}
	function get_user_info($token){
		global $conn;
		$get = "SELECT * FROM users WHERE token='{$token}'";
		$result = $conn->query($get);
		return $result;
	}
	function get_order_history($email){
		global $conn;
		$get = "SELECT * FROM p_order WHERE email='{$email}'";
		$result = $conn->query($get);
		return $result;
	}
	function get_contact_information($index){
		global $conn;
		$get = "SELECT * FROM contact_information";
		$result = $conn->query($get);
		$row = $result->fetch_array();
		$output = $row[$index];
		return $output;
	}
	function get_products($main , $sub,  $sor , $limit , $offset){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "WHERE category= '".addslashes($main)."' ";
		$get.= "AND subcategory LIKE '".addslashes($sub)."%' {$sor} ";
		$get.= "LIMIT {$limit} OFFSET {$offset} ";
		$result = $conn->query($get);
		return $result;
	}
	function get_product_price($originalPrice, $discount, $currency, $onlyPrice = false) {
		global $currencyRate;
		$discount_in_taka = $originalPrice*($discount/100);
		$dprice = $originalPrice - $discount_in_taka;
		$converted_price = round((1/$currencyRate[$currency]) * $originalPrice, 2);
		$converted_dprice = round((1/$currencyRate[$currency]) * $dprice, 2);
		return  (!$onlyPrice) ? $currency ." ". $converted_dprice : $converted_dprice;
	}
	function get_subfilter_products($main , $sql,  $sor , $limit , $offset){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= $sql." ".$sor." ";
		$get.= "LIMIT {$limit} OFFSET {$offset} ";
		$result = $conn->query($get);
		return  $result;
	}
	function get_min_price_from_category($main){
		global $conn;
		$get	 = "SELECT  MIN(price) AS price FROM products WHERE category = '".addslashes($main)."' ";
		$result	 = $conn->query($get);
		$row	 = $result->fetch_array();
		return  $row;
	}
	function get_max_price_from_category($main){
		global $conn;
		$get	 = "SELECT  MAX(price) AS price FROM products WHERE category = '".addslashes($main)."' ";
		$result	 = $conn->query($get);
		$row	 = $result->fetch_array();
		return  $row;
	}
	function paging($main , $sub , $sor){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "WHERE category = '".addslashes($main)."' ";
		$get.= "AND subcategory='".addslashes($sub)."' ";
		$get.= "{$sor} ";
		$result = $conn->query($get);
		return  $result;
	}
	function details_page($prid){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "WHERE id = '{$prid}' ";
		$result_details = $conn->query($get);
		$row_details = $result_details->fetch_array();	 
		return $row_details;
	}
	function get_suggestion($main,$limit){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "WHERE category = '".addslashes($main)."' ";
		$get.= "ORDER BY id DESC ";
		$get.= "LIMIT {$limit} ";
		$result_suggestion	= $conn->query($get);
		return  $result_suggestion;
	}
	function  get_product_comments($prid){
		global $conn;
		$get = "SELECT * FROM product_comments ";
		$get.= "WHERE prid = '{$prid}' ";
		$get.= "ORDER BY id DESC ";
		$result_comments	= $conn->query($get);
		return  $result_comments;  
	}
	function get_new_arrivals($limit){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "ORDER BY date_added DESC ";
		$get.= "LIMIT {$limit} ";
		$result_new		= $conn->query($get);
		return  $result_new;  
	}
	function get_trending($limit){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "ORDER BY views DESC,id DESC ";
		$get.= "LIMIT {$limit} ";
		$result_new = $conn->query($get);
		return $result_new; 
	}
	function get_featured_product($limit){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "ORDER BY discount DESC,views DESC ";
		$get.= "LIMIT {$limit} ";
		$result_new = $conn->query($get);
		return $result_new;
	}
	function get_best_selling($limit){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "ORDER BY views DESC ";
		$get.= "LIMIT {$limit} ";
		$result_new = $conn->query($get);
		return $result_new; 
	}
	function get_offers($limit){
		global $conn;
		$get = "SELECT * FROM products ";
		$get.= "ORDER BY discount DESC ";
		$get.= "LIMIT {$limit} ";
		$result_new = $conn->query($get);
		return $result_new; 
	}
	function get_brands(){
		global $conn;
		$get = "SELECT id,brand FROM products GROUP BY brand ";
		$get.= "ORDER BY id DESC ";
		$result_brands = $conn->query($get);
		return  $result_brands;  
	}
	function get_brands_by_manu($main){
		global $conn;
		$get = "SELECT * FROM brands ";
		$get.= "WHERE main='".addslashes($main)."' ";
		$get.= "ORDER BY id DESC ";
		$result_brands = $conn->query($get);
		return $result_brands;  
	}
	function get_page_view() {
		global $conn;
		$get = "SELECT * FROM About ";		
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row['page_view'];
	}
	function update_page_view($count){
		global $conn;
		$count = $count+1;
		$update = "UPDATE about SET page_view = '{$count}'";		
		$conn->query($update);
	}
	function get_highest_discount(){
		global $conn;
		$sql	= "SELECT category,MAX(discount) AS discount FROM products";
		$result	= $conn->query($sql);
		$row	= $result->fetch_array();
		return $row;
	}
	function get_paging($total_item, $item_per_page, $current_page, $target_url) {
		$total_page = $total_item/$item_per_page;
		$total_page = (is_float($total_page)) ? intval($total_page+1) : $total_page;
		echo '<li class="page-item'; if($current_page < 2)echo ' disabled'; echo '"><a class="page-link" href="'.$target_url.'page='.($current_page-1).'">«</a></li>';
		for($pagei = 1; $pagei <= $total_page; $pagei++) {
			echo '<li class="page-item'; if($current_page == $pagei) echo ' active'; echo '"><a class="page-link" href="'.$target_url.'page='.$pagei.'">'.$pagei.'</a></li>';
		}
		echo '<li class="page-item'; if($current_page == $total_page)echo ' disabled'; echo '"><a class="page-link" href="'.$target_url.'page='.($current_page+1).'">»</a></li>';
	}
	function send_mail($email_from, $email_to, $email_subject, $messageBody) {
		if(!preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/',$email_to)) return false;
		if(!preg_match('/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/',$email_from)) return false;
		if(!isset($messageBody) || strlen($messageBody) <= 5) return false;
		else {
			$bad 	= array("content-type","bcc:","to:","cc:");
			$Xman = array("\r\n","\n");
			$email_message	= str_replace($bad,"",$messageBody);
			$email_message	= str_replace($Xman,"<br>",$email_message);
		}
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$email_from."\r\n";
		mail($email_to, $email_subject, $email_message, $headers);
	}
	 
	/*============ common functions ========*/ 
	function get_max($table, $index, $min) {
		global $conn;
		$get = "SELECT MAX({$index}) as {$index} FROM {$table}";
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
	function get_total_rows($table, $extra_sql=true){
		global $conn;
		$get = "SELECT * FROM {$table} ";
		$get.= "WHERE ".$extra_sql;
		$result = $conn->query($get); $num = $result->num_rows;
		return $num;
	}
	function get_all($tablename, $extra_sql=true) {
		global $conn;
		$get = "SELECT * FROM {$tablename} ";
		$get.= $extra_sql; 
		$result = $conn->query($get) or trigger_error($get);
		return $result;
	}
	function get_some_data($tablename, $condition) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		return $result;
	}
	function get_single_data($tablename, $condition) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row;
	}
	function get_single_index_data($tablename, $condition, $index) {
		global $conn;
		$get = "SELECT * FROM ".$tablename." ";
		$get.= "WHERE ".$condition;
		$result = $conn->query($get);
		$row = $result->fetch_array();
		return $row[$index];
	}
	function get_imploded_column($char, $tablename, $column, $extra_sql=true){
		global $conn;
		$implode_array = array(); $result = get_some_data($tablename, $extra_sql);
		foreach($result as $value) $implode_array[] = $value[$column];
		return implode($char, $implode_array);
	}
	function InsertInTable($table,$fields){
		global $conn;
		$sql  = "INSERT INTO {$table} (".implode(" , ",array_keys($fields)).") ";
		$sql .= "VALUES('";      
		foreach($fields as $key => $value) { 
			$fields[$key] = $value;
		}
		$sql .= implode("' , '",array_values($fields))."');";       
		return $sql;
	}
	function UpdateTable($table,$fields,$condition) {
		global $conn;
		$sql = "UPDATE {$table} SET ";
		foreach($fields as $key => $value) { 
			$fields[$key] = " {$key} = '{$value}' ";
		}
		$sql .= implode(" , ",array_values($fields))." WHERE ".$condition.";";  
		return $sql;
	}
	function DeleteTable($tablename, $condition) {
		$sql = "DELETE FROM {$tablename} ";
		$sql.= "WHERE {$condition}" ;
		return $sql;
	}
?>