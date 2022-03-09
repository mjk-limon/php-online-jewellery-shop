<?php
	session_start();
	include "doc/includes/config.php";
	require_once "doc/includes/functions.php";
?>
<?php 
	$page	= isset($_GET['page']) ? $_GET['page'] : 'index';
	$result_page	= get_inner_page($page);
	if($result_page->num_rows == 0) exit(header('Location: '.$base));
	else $row_page = $result_page->fetch_array();
?>
<?php include "doc/includes/header.php"; ?>
	<div class="limon-login">
		<div class="wrapper inner-page">
			<h2><?= htmlspecialchars($row_page['header']); ?></h2>
			<div class="limlog-form inner-page">
				<?= $row_page['content']; ?>
			</div>
		</div>
	</div>
<?php include "doc/includes/footer.php"; ?>