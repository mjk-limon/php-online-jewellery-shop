<?php
include "doc/includes/config.php";
require_once "doc/includes/functions.php";
?>
<?php include "doc/includes/header.php"; ?>

<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 1400px; height: 450px; overflow:hidden;">
	<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1400px; height: 450px; overflow: hidden;">
		<div><img u="image" src="images/slider/01.jpg" /></div>
		<div><img u="image" src="images/slider/02.jpg" /></div>
		<div><img u="image" src="images/slider/03.jpg" /></div>
		<div><img u="image" src="images/slider/04.jpg" /></div>
		<div><img u="image" src="images/slider/05.jpg" /></div>
		<div><img u="image" src="images/slider/06.jpg" /></div>
		<div><img u="image" src="images/slider/07.jpg" /></div>
	</div>
	<div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
		<div u="prototype"></div>
	</div>
	<style>
		.jssora12l,
		.jssora12r {
			display: block;
			position: absolute;
			width: 30px;
			height: 46px;
			cursor: pointer;
			background: url(images/a12.png) no-repeat;
			overflow: hidden
		}

		.jssora12l {
			background-position: -16px -37px
		}

		.jssora12r {
			background-position: -75px -37px
		}

		.jssora12l:hover {
			background-position: -136px -37px
		}

		.jssora12r:hover {
			background-position: -195px -37px
		}

		.jssora12l.jssora12ldn {
			background-position: -256px -37px
		}

		.jssora12r.jssora12rdn {
			background-position: -315px -37px
		}

		.jssora12l,
		.jssora12r {
			display: block;
			position: absolute;
			width: 30px;
			height: 46px;
			cursor: pointer;
			background: url(images/a12.png) no-repeat;
			overflow: hidden
		}

		.jssora12l {
			background-position: -16px -37px
		}

		.jssora12r {
			background-position: -75px -37px
		}

		.jssora12l:hover {
			background-position: -136px -37px
		}

		.jssora12r:hover {
			background-position: -195px -37px
		}

		.jssora12l.jssora12ldn {
			background-position: -256px -37px
		}

		.jssora12r.jssora12rdn {
			background-position: -315px -37px
		}
	</style>
	<span u="arrowleft" class="jssora12l" style="top: 123px; left: 0px;"></span>
	<span u="arrowright" class="jssora12r" style="top: 123px; right: 0px;"></span>
</div>

<div class="container my-4">
	<div class="row my-2">
		<div class="col-md-12 text-center">
			<h1 class="h1_und">OUR CATEGORIES</h1>
		</div>
	</div>
</div>
<div class="categories-item">
	<div class="container">
		<div class="row">
			<?php
			$MainCats = get_menu();
			while ($Main = $MainCats->fetch_assoc()) {
				$mm = $Main['main'];
			?>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<ul class="categories">
						<li>
							<a href="products.php?main=<?php echo urlencode($mm) ?>">
								<img src="images/category-slides/<?php echo restyle_url($mm) ?>-1.jpg" alt="Category Thumb">
								<h2></h2>
								<h3><?php echo ucwords($mm) ?></h3>
							</a>
						</li>
					</ul>
				</div>
			<?php
			}
			$MainCats->free();
			?>

		</div>
	</div>
</div>
<script type="text/javascript" src="js/jssor.js"></script>
<script type="text/javascript" src="js/jssor.slider.js"></script>
<script>
	jQuery(document).ready(function($) {

		var _SlideshowTransitions = [
			//Fade
			{
				$Duration: 1200,
				$Opacity: 2
			}
		];

		var options = {
			$AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
			$AutoPlaySteps: 1, //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
			$AutoPlayInterval: 3000, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
			$PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

			$ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
			$SlideDuration: 500, //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
			$MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20
			//$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
			//$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
			$SlideSpacing: 0, //[Optional] Space between each slide in pixels, default value is 0
			$DisplayPieces: 1, //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
			$ParkingPosition: 0, //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
			$UISearchMode: 1, //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
			$PlayOrientation: 1, //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
			$DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

			$SlideshowOptions: { //[Optional] Options to specify and enable slideshow or not
				$Class: $JssorSlideshowRunner$, //[Required] Class to create instance of slideshow
				$Transitions: _SlideshowTransitions, //[Required] An array of slideshow transitions to play slideshow
				$TransitionsOrder: 1, //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
				$ShowLink: true //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
			},

			$BulletNavigatorOptions: { //[Optional] Options to specify and enable navigator or not
				$Class: $JssorBulletNavigator$, //[Required] Class to create navigator instance
				$ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
				$AutoCenter: 1, //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
				$Steps: 1, //[Optional] Steps to go for each navigation request, default value is 1
				$Lanes: 1, //[Optional] Specify lanes to arrange items, default value is 1
				$SpacingX: 10, //[Optional] Horizontal space between each item in pixel, default value is 0
				$SpacingY: 10, //[Optional] Vertical space between each item in pixel, default value is 0
				$Orientation: 1 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
			},

			$ArrowNavigatorOptions: {
				$Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
				$ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
				$Steps: 1 //[Optional] Steps to go for each navigation request, default value is 1
			}
		};
		var jssor_slider1 = new $JssorSlider$("slider1_container", options);

		//responsive code begin
		//you can remove responsive code if you don't want the slider scales while window resizes
		function ScaleSlider() {
			var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
			if (parentWidth)
				jssor_slider1.$ScaleWidth(Math.min(parentWidth, 1400));
			else
				window.setTimeout(ScaleSlider, 30);
		}
		ScaleSlider();

		$(window).bind("load", ScaleSlider);
		$(window).bind("resize", ScaleSlider);
		$(window).bind("orientationchange", ScaleSlider);
		//responsive code end
	});
</script>
<?php include "doc/includes/footer.php"; ?>