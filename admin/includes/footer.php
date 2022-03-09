		<div class="footer">
			<p>© <?= date("Y"); ?> . All Rights Reserved. Design by <a>Rakiba Nasrin Ratri</a></p>
		</div>
	</section>
	<div class="site-msg">
		<div class="sm-loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>
		<div class="sm-content">
			<div class="sm-cheader"><i class="fa fa-times"></i><i class="fa fa-window-maximize"></i></div>
			<div class="sm-cajax"></div>
		</div>
	</div>
	<script src="js/__ds_adm_proton.js"></script>
	<script src="js/ds_adm_page_func.js"></script>
	<script src="js/__ds_noti.js"></script>
<?php if(isset($_GET['smsg']) || isset($_GET['emsg'])){$type = (isset($_GET['smsg'])) ? 1 : 0;
switch($type){case 0:$msg=$_GET['emsg'];$label='danger';break;case 1:$msg=$_GET['smsg'];$label='success';break;}?>
	<script>$(document).ready(function(){ds.showNotification('bottom','right','<?= $label ?>','warning', "<?= $msg ?>")});</script>
<?php } ?>
</body>
</html>