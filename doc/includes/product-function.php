<?php
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$sort = isset($_GET["sort"]) ? $_GET["sort"] : 0;
$brand = isset($_GET["brand"]) ? get_url_variables($_GET["brand"]) : 0;

if ($page <= 0) header('Location: ' . $base);
else {
	$page2 		= 	$page * $product_page_limit;
	$offset1 	=	$page2 - $product_page_limit;
}
?>
<?php
(!empty($brand)) ? $sor = "AND brand = '{$brand}' " : $sor = "";
switch ($subheader) {
	case 'all_products':
		$sql = "WHERE 1";
		break;
	case 'all':
		$sql = "WHERE category='{$main}' ";
		break;
	case 'new_arrivals':
		$sql = "WHERE 1";
		break;
	case 'special_discount':
		$sql = "WHERE discount > 0 ";
		$sort = 3;
		break;
	default:
		$sql = "WHERE 1";
}
switch ($sort) {
	case 1:
		$sor .= "ORDER BY views DESC,id DESC";
		break;
	case 2:
		$sor .= "ORDER BY id DESC";
		break;
	case 3:
		$sortvalue = (isset($_GET['size']) && !empty($_GET['size'])) ? $conn->real_escape_string($_GET['size']) : "";
		$sor .= "AND size LIKE '%{$sortvalue}\"%' ";
		break;
	case 12:
		$sortvalue = (isset($_GET['range']) && !empty($_GET['range'])) ? $_GET['range'] : "0,10000";
		$price_sort_value = explode(',', $sortvalue);
		$sor .= "AND price BETWEEN {$price_sort_value[0]} AND {$price_sort_value[1]} ";
		break;
	default:
		$sor .= "ORDER BY id DESC";
}
?>
<?php
if ($search !== null) {
	$lknm = "LIKE '%" . $search . "%'";
	$sql = "WHERE id {$lknm} OR category {$lknm} OR subcategory {$lknm} OR name {$lknm} ";
	$result_products = get_subfilter_products($main, $sql, $sor, $product_page_limit, $offset1);
	$result_total_products = get_subfilter_products($main, $sql, $sor, 9999999999, 0);
} else {
	$result_products = get_products($main, $sub, $sor, $product_page_limit, $offset1);
	$result_total_products 	= get_products($main, $sub, $sor, 9999999999, 0);
}
?>
<?php
$total_products	= $result_total_products->num_rows;
$last_page		= $total_products / $product_page_limit;
$last_page = (is_float($last_page)) ? intval($last_page) + 1 : $last_page;
?>