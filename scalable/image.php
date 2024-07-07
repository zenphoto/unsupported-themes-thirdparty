<?php if (!defined('WEBPATH')) die(); $themeResult = getTheme($zenCSS, $themeColor, 'light'); $firstPageImages = normalizeColumns('2', '6');?>
<?php $album = $_zp_current_image->getAlbum(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php zenJavascript(); ?>
	<title><?php echo getBareGalleryTitle(); ?> | <?php echo getBareAlbumTitle();?> | <?php echo getBareImageTitle();?></title>
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.layout.js"></script> 
<!--	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.core.js"></script> 
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ui.draggable.js"></script> -->
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/jquery/js/jquery-ui-1.6.custom.min.js"></script>
	<script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/json2.js"></script> 
	<script type="text/javascript">
	$(function() {
		$("#slider").slider({
			startValue: 80,
			min: 40,
			max: 160,
			steps: 6,
			slide: function(event, ui) {
				$("ul.ad-thumb-list > li > a > img").attr("width", ui.value);
			}
		});
	});
	</script>
	<script type="text/javascript"> 
	$(document).ready(function () {
		$('body').layout(layoutSettings);
		$("ul.ad-thumb-list > li > a > img").attr("width", 80);
	});

	var layoutSettings = {
		applyDefaultStyles:		true,
		defaults: {
			//size:								"auto",
			resizerTip:					"Resize This Pane",
			contentPane:				".content"
		},
		north: {
			spacing_open:				0,
			resizable:					false,
			closable:						false
		},
		south: {
			spacing_open:				0,
			resizable:					false,
			closable:						false
		},
		east: {
			spacing_open:				3,
			resizable:					true
		},
		center: {
			minWidth:						200,
			minHeight:					200
		}
	};

	var currentImageURL = document.location.href;

	/*** Wrapper function to override the editInPlace save_url ***/
	function updateEditInPlace(url, target, context, field) {
		alert(url);
		var form_type = (field == 'desc') ? 'textarea' : 'text';
		jQuery('#'+target).eip(
			{
				save_url: url,
				eip_context: context,
				eip_field: field,
				form_type: form_type
			}	
		);
	}
	</script> 
  <link rel="stylesheet" href="<?php echo $_zp_themeroot ?>/styles/jquery.ad-gallery.css" type="text/css" > 
  <script type="text/javascript" src="<?php echo $_zp_themeroot ?>/js/jquery.ad-gallery.js?rand=995"></script> 
  <script type="text/javascript"> 
  $(function() {
    var galleries = $('.ad-gallery').adGallery({
      loader_image: '<?php echo $_zp_themeroot ?>/images/loader.gif',
      width: $("div.ui-layout-center").width() - 200, // Width of the image, set to false and it will read the CSS width
      height: $("div.ui-layout-center").height() - 2*	$("ul.ad-thumb-list > li > a > img").attr("width"), // Height of the image, set to false and it will read the CSS height
      thumb_opacity: 0.7, // Opacity that the thumbs fades to/from, (1 removes fade effect)
                          // Note that this effect combined with other effects might be resource intensive
                          // and make animations lag
      start_at_index: <?php echo $_zp_current_image->getIndex(); ?>, // Which image should be displayed at first? 0 is the first image
      animate_first_image: false, // Should first image just be displayed, or animated in?
      animation_speed: 400, // Which ever effect is used to switch images, how long should it take?
      display_next_and_prev: true, // Can you navigate by clicking on the left/right on the image?
      display_back_and_forward: true, // Are you allowed to scroll the thumb list?
      scroll_jump: 0, // If 0, it jumps the width of the container
      slideshow: {
        enable: true,
        autostart: false,
        speed: 3000,
        start_label: 'Start',
        stop_label: 'Stop',
        stop_on_scroll: true, // Should the slideshow stop if the user scrolls the thumb list?
        countdown_prefix: '(', // Wrap around the countdown
        countdown_sufix: ')',
        onStart: function() {
          // Do something wild when the slideshow starts
        },
        onStop: function() {
          // Do something wild when the slideshow stops
        }
      },
      effect: 'none', // or 'slide-vert', 'resize', 'fade', 'none' or false
      enable_keyboard_move: true, // Move to next/previous image with keyboard arrows?
      cycle: false, // If set to false, you can't go from the last image to the first, and vice versa
      // All callbacks has the AdGallery objects as 'this' reference
      callbacks: {
        // Executes right after the internal init, can be used to choose which images
        // you want to preload
        init: function() {
          // preloadAll uses recursion to preload each image right after one another
          //this.preloadAll();
          // Or, just preload the first three
          //this.preloadImage(0);
          //this.preloadImage(1);
          //this.preloadImage(2);
        },
        // This gets fired right after the new_image is fully visible
				afterImageVisible: function() {
					// For example, preload the next image
          var context = this;
          this.loading(true);
          this.preloadImage(this.current_index + 1,
            function() {
              // This function gets executed after the image has been loaded
              context.loading(false);
            }
          );
        },
        // This gets fired right before old_image is about to go away, and new_image
        // is about to come in
        beforeImageVisible: function(new_image, old_image) {
          // update metadata
					var data = 
					{ 
						"album": "<?php echo $_zp_current_image->getAlbum()->getFolder() ?>",
						"image": new_image
					}
					var dataString = JSON.stringify(data);
					$.post("<?php echo  $_zp_themeroot ?>/imagejson.php", {data: dataString}, showResult, "text");

        }
      }
    });
    
		$('#switch-effect').change(
      function() {
        galleries[0].settings.effect = $(this).val();
        return false;
      }
    );
  });

	function showResult(res)
	{
		$("#commentcontent").text(res);
		var obj = JSON.parse(res);
		$("span.zp_editable_image_title").text(obj.title);
		$("span.zp_editable_image_desc").text(obj.desc);
		//updateEditInPlace(obj.link, 'editable_2', 'image', 'title');
		//updateEditInPlace(obj.link, 'editable_3', 'image', 'desc');
		var edit = $("span#editable_3");
		var editdata = jQuery.data(edit, "obj");
		//alert();
		//$("table#imagemetadata").(obj.exifdata);
		//$("span.zp_editable_image__update_tags").replaceWith(obj.tags);
		//$("#sales1Lastname").html("Lastname of sales[1]: " +obj.sales[1].lastname);
	}
  </script> 
	<link rel="stylesheet" href="<?php echo  $zenCSS ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo $_zp_themeroot ?>/jquery/css/flick/ui.all.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/js/thickbox.css" type="text/css" />
	<script src="<?php echo FULLWEBPATH . "/" . ZENFOLDER ?>/js/thickbox.js" type="text/javascript"></script>
	<script type="text/javascript">
		function toggleComments() {
			var commentDiv = document.getElementById("comments");
			if (commentDiv.style.display == "block") {
				commentDiv.style.display = "none";
			} else {
				commentDiv.style.display = "block";
			}
		}
	</script>
		<?php printRSSHeaderLink('Gallery',gettext('Gallery RSS')); ?>

</head>

<body>

	<div class="ui-layout-north">
		<div id="gallerytitle">
			<div class="imgnav">
				Effect: <select id="switch-effect"> 
					<option value="none">None</option> 
					<option value="fade">Fade</option> 
					<option value="slide-hori">Slide horizontal</option> 
					<option value="slide-vert">Slide vertical</option> 
					<option value="resize">Shrink/grow</option> 
				</select>
			</div>
			<?php if (getOption('Allow_search')) {  printSearchForm(''); } ?>
			<?php printAdminToolbox(); ?>
			<h2><span><?php printHomeLink('', ' | '); ?><a href="<?php echo htmlspecialchars(getGalleryIndexURL());?>" title="<?php gettext('Albums Index'); ?>"><?php echo getGalleryTitle();?>
				</a> | <?php printParentBreadcrumb("", " | ", " | "); printAlbumBreadcrumb("", " | "); ?>
				</span> <?php printImageTitle(true); ?>
			</h2>
		</div>
	</div>


	<div class="ui-layout-center">
		<!-- The Image -->
		<?php if (!checkForPassword()) { ?>
		<div class="ad-gallery">
			<div class="ad-nav">
				<div class="ad-thumbs">
					<ul class="ad-thumb-list">
						<?php for ($index = 0; $index < $album->getNumImages(); $index++) {
									$image = $album->getImage($index); ?>
						<li>
							<a href="<?php echo $image->getSizedImage(getOption('image_size')); ?>">
								<img src="<?php echo $image->getThumb() ?>" title="<?php echo $image->getTitle() ?>" <?php if ($index == $_zp_current_image->getIndex()) {echo 'class="image0"'; } ?>>
							</a>
						</li>
						<?php } ?>
		      </ul>
		    </div>
		  </div>
			<div class="ad-controls">
			</div>
			<div class="ad-image-wrapper">
			</div>
			<?php if (function_exists('printUserSizeImage') && isImagePhoto()) printUserSizeSelectior(); ?>
		</div>
		<?php } ?>
	</div>
		
<div class="ui-layout-east">
	<div class="content">
		<div class="sliderbox">
			<div id="slider"></div>
		</div>
		<?php if (function_exists('printLanguageSelector')) { printLanguageSelector(); } ?>
		<?php if (!checkForPassword()) { ?>
		<?php printImageDesc(true); ?>
		<?php if (function_exists('printSlideShowLink')) printSlideShowLink(gettext('View Slideshow')); ?>
		<hr /><br />
		<?php
			if (getImageEXIFData()) {echo "<div id=\"exif_link\"><a href=\"#TB_inline?height=345&amp;width=400&amp;inlineId=imagemetadata\" title=\"".gettext("Image Info")."\" class=\"thickbox\">".gettext("Image Info")."</a></div>";
				printImageMetadata('', false);
			}
		?>
		<?php printTags('links', gettext('<strong>Tags:</strong>').' ', 'taglist', ''); ?>
		<br clear=all />

		<?php if (function_exists('printImageMap')) printImageMap(); ?>

    <?php if (function_exists('printRating')) printRating(); ?>

		<?php if (function_exists('printShutterfly')) printShutterfly(); ?>

		<?php if (function_exists('printCommentForm')) printCommentForm(); ?>
		<?php } ?>
	</div>
</div>

	<div class="ui-layout-south">
		<div id="credit">
			<?php printRSSLink('Gallery','','RSS', ' | '); ?> <?php printCustomPageURL(gettext("Archive View"),"archive"); ?> | 
			<?php printZenphotoLink(); ?>
			<?php if (function_exists('printUserLogout')) {
				printUserLogout(" | ");
			} ?>
		</div>
	</div>

</body>
</html>
