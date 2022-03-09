$(document).ready(function() {
	$('#yt-totop').click(function(){
		$('html body').animate({
			scrollTop: 0
		}, 1000);
	});
		
	$('#loginForm').submit(function(e) {
		var ref_page	= $(this).find('input[name="ref_page"]').val();
		
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $(this).serialize(), 
			success: function(data){
				if(data == 0) {
					showPageAlert('Error !', 'Invalid Username Or Password !');
					$this.button('reset');
				} else if(data == 1) {
					window.location.href=ref_page;
				} else {
					showPageAlert('Error' , data);
				}
			}
		});

		e.preventDefault();
	});
	$('#registrationForm').submit(function(e) {
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $(this).serialize(), 
			success: function(data){
				if(data == 1) {
					showPageAlert('Alert !', 'Successfully Registered ! Please go back to <a href="index">Home</a> Page');
				} else if(data == 2) {
					showPageAlert('Error !', 'Email Or Mobile Number Already Registered !');
				} else {
					showPageAlert('Alert !', data);
				}
			}
		});

		e.preventDefault();
	});
	$('#contactForm').submit(function(e) {
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $("#contactForm").serialize(), 
			success: function(data){
				showPageAlert('Alert !', data);
			}
		});

		e.preventDefault();
	});
	$('#updadeMyAccount').submit(function(e) {
		showPageLoading();
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $("#updadeMyAccount").serialize(), 
			success: function(data){
				showPageAlert('Alert !', data);
			}
		});

		e.preventDefault();
	});
	$("#newslettersubmit").submit(function(e) {
		showPageLoading();
		var url = "ajax"; 

		$.ajax({
			type: "POST",
			url: url,
			data: $("#newslettersubmit").serialize(), 
			success: function(data){
				showPageAlert('Alert !', data);
			}
		});

		e.preventDefault();
	});
	$("#couponForm").submit(function(e) {
		e.preventDefault();
		showPageLoading();
		
		$.ajax({
			type: "POST",
			url: "ajax",
			data: $(this).serialize(), 
			success: function(data){
				if(data == 12) {
					showPageAlert('Alert !', 'You have '+data+'% discount');
				} else {
					showPageAlert('Alert !', data);
				}
			}
		});
		
	});
	$(".pass").click(function() {
		var html	 = '<div class="w3ls-form">';
		html	 	+= '	<form action="#" method="post" id="forgotPassword">';
		html		+= '		<input type="hidden" name="forgotPassword" />';
		html		+= '		<label>Email Or Phone</label>';
		html		+= '		<input type="text" name="username" placeholder="Enter Your Email Or Phone" required/>';
		html		+= '		<input type="submit" value="Send" />';
		html		+= '	</form>';
		html		+= '</div>';

		showPageAlert('Forgot Password !', html);
	});
	$("body").on('submit', '#forgotPassword', function(e) {
		showPageLoading();
		var url = "ajax"; 

		$.ajax({
			type: "POST",
			url: url,
			data: $(this).serialize(), 
			success: function(data){
				showPageAlert('Alert !', data);
			}
		});

		e.preventDefault(); 
	});
	$("#reviewForm").submit(function(e) {
		var url = "ajax"; 
		$.ajax({
				 type: "POST",
				 url: url,
				 data: $("#reviewForm").serialize(), 
				 success: function(data) {
					//$('html body').load(window.location.href);
					$('#comments').prepend(data);
					//alert(data);
					$('html, body').animate({
						scrollTop: $("#Reviews").offset().top
					}, 1000);
				 }
			 });

		e.preventDefault();
	});
	if($('div.product-item').length > 0) {
		var maxHeight = Math.max.apply(null, $("div.product-item").map(function(){
			return $(this).height();
		}).get());
		$('div.product-item').height(maxHeight);
	}
	
	/*------------------------------------------
	------------ PHP CEHECKOUT ----------------*/
	$('a[href="#"]').click(function(e){e.preventDefault();});
	$('.quick-checkout-btn').click(function(){$('.not-logged-in').hide();$('.quick-checkout').fadeIn('slow');});
	$('.back-login-btn').click(function(){$('.quick-checkout').hide();$('.not-logged-in').fadeIn('slow');});
	
	$('.first-tab-btn').click(function(){$('#menu1-btn').click();});
	$('.second-tab-btn').click(function(){
		$('#menu2-btn').click();
		$('#menu2-btn').parent().removeClass('disabled');
		
		var twi	= parseInt($('.order-summery #_cart_twd').text());
		var dl = (orderLocation.toLowerCase() == 'dhaka') ? "Dhaka City" : orderLocation;
		var dc = (orderLocation.toLowerCase() == 'dhaka') 
						? parseInt($('.order-summery #_cart_dc').data("dcd")) : parseInt($('.order-summery #_cart_dc').data("dco"));
		var t	= twi+dc;
		$('.order-summery #_cart_dl').html(dl+' Division');
		$('.order-summery #_cart_dc').html(dc);
		$('.order-summery #_cart_odr_ttl').html(t);
	});
	$('.third-tab-btn').click(function(){
		$('#menu3-btn').click();
		$('#menu3-btn').parent().removeClass('disabled');
	});
	$('#quickCheckout').submit(function(e){
		e.preventDefault();
		$('#menu2-btn').click();
		$('#menu2-btn').parent().removeClass('disabled');
		
		userToken		= '';
		orderLocation	= $(this).find('select[name="delivery_location"]').val();
		mobileNumber	= $(this).find('input[name="mobile_number"]').val();
		fullAddress		= $(this).find('textarea[name="address"]').val();
		
		var twi	= parseInt($('.order-summery #_cart_twd').text());
		var dl = (orderLocation.toLowerCase() == 'dhaka') ? "Dhaka City" : "Outside Dhaka";
		var dc = (orderLocation.toLowerCase() == 'dhaka') 
						? parseInt($('.order-summery #_cart_dc').data("dcd")) : parseInt($('.order-summery #_cart_dc').data("dco"));
		var t	= twi+dc;
		$('.order-summery #_cart_dl').html(dl);
		$('.order-summery #_cart_dc').html(dc);
		$('.order-summery #_cart_odr_ttl').html(t);
	});
	$('.payment-information .radio-inline').click(function(){
		var payment_type	= $('input[name=payment_type]:checked', '#co-payment-information').val();
		if(payment_type == 'bkash' || payment_type == 'rocket') {
			$('.get-transaction-id').slideDown();
			$('.get-transaction-id #payment-type').html(payment_type);
		} else $('.get-transaction-id').slideUp('fast');
		$('.payment-information .radio-inline').each(function(){ $(this).removeClass('active'); });
		$(this).addClass('active');
	});

	$('.submit-order').click(function(){
		paymentType	= $('input[name=payment_type]:checked', '#co-payment-information').val();
		paymentNumber	= $('input[name=account_number]', '#co-payment-information').val();
		paymentTrxnId	= $('input[name=transaction_id]', '#co-payment-information').val();
		
		if(paymentType == 'bkash' || paymentType == 'rocket') {
			if(paymentNumber == '' || paymentNumber == null || paymentTrxnId =='' || paymentTrxnId == null) {
				showPageAlert('Please Enter Payment Number and Transaction Id !!');
				return false;
			}
		}
		
		$.post("ajax", {
			order_submit: 1,
			userToken: userToken,
			mobileNumber: mobileNumber,
			orderLocation: orderLocation,
			fullAddress: fullAddress,
			paymentType: paymentType,
			paymentNumber: paymentNumber,
			paymentTrxnId: paymentTrxnId
		}, function(data){
			window.location="thank-you?orderno="+ encodeURIComponent(data);
		});
	});
	/*------------------------------------------
	-------------- PHP Cart ------------------*/
	cart_total 	= $('#cart_total').text();
	cart_total	= parseInt(cart_total);
	
	$('.add_to_wishlist_btn').click(function(){
		$this	= $(this);
		pr_id	= $this.attr('data-id');
		$.post("ajax",{
		  prid: pr_id,
		  wishlist_add: 1
		}, function(data,status){
			if(data == 1) {
				$this.css({"background-position": "-147px -246px" , "background-color" : "#f47721"});
			}else if(data == 2){
				showPageAlert('Error !', 'Already Added');
				$this.css({"background-position": "-147px -246px" , "background-color" : "#f47721"});
			}else {
				//alert(data);
				window.location="login?wishlist="+data;
			}
		});
	});
	$('.wishlist_added').click(function(){
		$this		= $(this);
		array_id	= $this.attr('data-array-num');
		$.post("ajax",{
		  id: array_id,
		  remove_wishlist: 1
		}, function(data,status){
			if(data == 1) {
				$('html body').load('wishlists');
			}else {
				//alert(data);
				showPageAlert('Alert !', data);
			}
		});
	});
	$('.quickview').click(function(){
		showPageLoading();
		var prid	= $(this).attr('data-id');
		$.ajax({
			type: "POST",
			url: "ajax",
			data: {"prid": prid, "quick_view":"1"}, 
			success: function(data){
				showPageAlert('Product Id : '+prid , data);
			}
		});
	});	
	
	$('.add-to-cart.quick').click(function(){
		pr_id	= $(this).attr('data-id');
		that	= this;
		
		$(this).closest('.product-thumb').find('.button-group').hide();
		
		if($(this).closest('.product-thumb').find('.size-group').children().length>0){
			$(this).closest('.product-thumb').find('.size-group').fadeIn();
		} else if($(this).closest('.product-thumb').find('.color-group').children().length>0) {
			pr_size		= 'N/A';
			
			$(this).closest('.product-thumb').find('.color-group').fadeIn();
		} else {
			pr_size		= 'N/A';
			pr_color	= 'N/A';
			
			showPageAlert('Success !', 'Product added to cart. <a href="cart">View Cart</a>');
			//$(this).closest('.product-overlay').next().fadeIn();
			PostProductToAjax(pr_id,pr_size,pr_size,that);
		}
	});

	$('.pr-size-btn').click(function(){
		pr_size	= $(this).attr('data-size');
		that	= this;
		
		$(this).closest('.product-thumb').find('.size-group').hide();	
		
		if($(this).closest('.product-thumb').find('.color-group').children().length>0) {
			$(this).closest('.product-thumb').find('.color-group').fadeIn();
		} else {
			pr_color	= 'N/A';
			//$(this).closest('.product-overlay').next().fadeIn();
			showPageAlert('Success !', 'Product added to cart. <a href="cart">View Cart</a>');
			PostProductToAjax(pr_id,pr_size,pr_color,that);
		}
	});
	$('.pr-color-btn').click(function(){							
		pr_color	= $(this).attr('data-color');
		that	= this;
		
		$(this).closest('.product-thumb').find('.color-group').hide();	
		showPageAlert('Success !', 'Product added to cart. <a href="cart">View Cart</a>');
		
		PostProductToAjax(pr_id,pr_size,pr_color,that)
	});
	
	$('.product-thumb').mouseleave(function(){
		$(this).find('.button-group').fadeIn();	
		$(this).find('.size-group').hide();	
		$(this).find('.color-group').hide();		
	});
});

$(document).ready(function(){
	$('a[href="#"]').click(function(e){e.preventDefault()});
	$(window).scroll(function() {
		var windscroll = $(window).scrollTop();
		if (windscroll >= 135) $('#top').addClass('attach-fixed');
		else $('#top').removeClass('attach-fixed');
	});	
});
function isInt(n){return +n === n && !(n % 1);}
function PostProductToAjax(pr_id,pr_size,pr_color,that) {
	$.post("ajax",{
	  prid: pr_id,
	  qty: 1,
	  size: pr_size,
	  color: pr_color,
	  add_to_cart: 1
	}, function(data,status){
		cart_total++;
		$('#cart_total').html(cart_total);
	});
	setTimeout(function(){
		$(that).closest('.product-overlay').next().hide();
	}, 3000);
}
function showPageAlert(header, htmlToAlert) {
	$('body .page-alert #alertHeader').html(header);
	$('body .page-alert #alertText').html(htmlToAlert);
	$('body .page-alert').fadeIn('fast');
}
function showPageLoading() {
	$('body .page-alert #alertHeader').html('Loading....');
	$('body .page-alert #alertText').html('<center><img src="images/ajax-loader.gif" class="loading"></img></center>');
	$('body .page-alert').show();
}
$('[data-close="pageAlert"]').click(function(){
	hidePageAlert();
}).children().click(function(e) {
	e.stopPropagation();
});

function hidePageAlert() {
	$('body .page-alert').fadeOut();
}