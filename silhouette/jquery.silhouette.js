
/**
 * Silhouette (http://alexwilsonphoto.com/)
 *
 * Version 0.5
 * March 07, 2010
 *
 * Copyright (c) 2010 Alex Wilson (http://alexwilsonphoto.com/)
 * Licensed under the GPL licenses.
 * http://www.gnu.org/licenses/gpl.txt
 **/

/**
 * 
 * @desc Convert images from a simple html <ul> into a horizontal panoramic
 * @author Alex Wilson
 * @version 0.5
 *
 * @name Silhouette
 * @type jQuery
 *
 * @cat plugins/Media
 * 
 * @example $('#silhouette_container').silhouette({options});
 * @desc Create a scrolling gallery from an unordered list of images with thumbnails
 * @options
 * //todo
**/

(function($) {

	var $$;
	
	$$ = $.fn.silhouette = function(options){

		// default configuration properties
		var defaults = {
			current: 			0,
			range:				4,
			container_height:	600,
			container_edge:		25,
			scroll_speed: 		400,
			scroll_easing: 		'swing',
			fade_speed: 		400,
			img_padding_right: 	0,
			img_opacity: 		0.25
		}; 

		//set variables
		var _container = $(this);
		$("ul",_container).wrap('<div id="silhouette_gallery"/>');
		var _gallery = $("div", _container);
		var _thumbs = $("ul", _gallery);

		var options = $.extend(defaults, options);


		//set the container div height and properties
		_container.height(options.container_height+"px");
		_container.width(_container.parent().width()-options.container_edge+"px"); //todo:  IE6 (and sometimes FF) is too wide, adds horizontal scroll
		_container.css("overflow","hidden");
		_container.css("position","relative"); //IE6 sucks

		_gallery.css("position","relative");
		_gallery.height(options.container_height+"px");
		_gallery.width( _container.width() );

		_thumbs.css("padding","0");
		_thumbs.css("margin","0");
		_thumbs.css("top","0");
		_thumbs.css("list-style","none");

		//restyle and add images from thumbs
		var _counter = 0;
		_thumbs.children().each(function() {
			var full_image = $(this).find("a");
			var thumb_image = $("a img", this);
			
			var thumb_orig_height = thumb_image.height();
			var thumb_orig_width = thumb_image.width();

			$(this).css("position","relative");
			$(this).css("zoom","1"); //IE is stoopid
			$(this).css("display","inline");

			thumb_image.height(options.container_height+"px");

			// expand the gallery width as images are loaded (chrome has image width at 0 until it loads)
			$(thumb_image).load(function() {
				_gallery.width( _gallery.width() + $(this).width() + options.img_padding_right );
			});

			thumb_image.data("silhouette_loaded", false );
			thumb_image.data("silhouette_fullImg", full_image.attr("href") );
			
			jQuery.fn.loadFull = function ( ){
				var self = $(this[0]);
				if( !self.data("silhouette_loaded") ){
					self.attr({src: self.data("silhouette_fullImg")});
					self.data("silhouette_loaded", true );
				}
			}

			full_image.attr({href: "javascript:changeImage("+_counter+")"});
			
			thumb_image.css("padding","0");
			thumb_image.css("border","0");
			thumb_image.css("margin","0");
			thumb_image.css("float","left");
			thumb_image.css("display","inline-block");
			thumb_image.css("vertical-align", "top");
			thumb_image.css("padding-right", options.img_padding_right+"px");
			thumb_image.css("opacity",options.img_opacity);

			_counter++;
			
		});

		//start with the first image just off the right side
		_gallery.css("left",_container.width());
		
		preloadImages = function(cur,range){
			var imgs = $("a img",_thumbs).toArray();
			if( range/2 > imgs.length/2 ){
				range = Math.floor(imgs.length/2);
			}
			for( var i=cur-range;  i<= cur+range; i++ ){
				var im = imgs[(imgs.length + i )%imgs.length];
				$(im).loadFull();
			}
		};


		changeImageMove = function(moveTo, keepCurrent){
			if( moveTo == options.current && !keepCurrent ){
				moveTo += 1;
			}
			moveTo = ($("a img",_thumbs).length + moveTo) % $("a img",_thumbs).length;
			//grab images
			var thumbArray = $("a img",_thumbs).toArray();
			var curImageLi = $(thumbArray[options.current]);
			var toImageLi = $(thumbArray[moveTo]);
			preloadImages(moveTo,options.range);

			var toImgTop = toImageLi.offset().top - _container.offset().top;
			if( toImgTop >= options.container_height ){
				_gallery.width( _gallery.width() * Math.ceil(toImgTop/options.container_height) );
			}

			//calculate its left since .position doesn't work with block/float
			var curGalleryLeft = _gallery.css("left").replace(/px,*\)*/g,"");
			var toImgLeft = toImageLi.offset().left - _container.offset().left;

			//fade out current image, fade in new image
			if( options.current != moveTo ){
				curImageLi.stop().animate({ 'opacity' : options.img_opacity }, options.fade_speed);
			}
			toImageLi.stop().animate({ 'opacity' : "1.0" }, options.fade_speed);


			//check to see if everything is good, loaded and it the right position -- if not, we will re-call this function until it is
			var allSet = false;
			var toGalleryLeft = _container.width()/2 - (toImgLeft-curGalleryLeft) - toImageLi.width()/2;
			if( Math.abs(toGalleryLeft-curGalleryLeft)>10 ){
				//move middle of image to middle of container
				_gallery.stop().animate({
					'left' : toGalleryLeft+"px"},
					options.scroll_speed,
					options.scroll_easing
				);
				_container.data("silhouette_animating", true );
			}else{
				allSet=true;
			}

			//make sure all images from first to moveTo have loaded so we know the width is correct
			for( var i=0; i<=moveTo && allSet; i++ ){
				if( $(thumbArray[i]).width() == null || $(thumbArray[i]).width() == 0 ){
					allSet = false;
				}
			}
			if( !allSet ){
				clearTimeout( _container.t );
				_container.t = setTimeout( 'changeImageMove('+moveTo+',true)', options.scroll_speed );
			}else{
				_container.data("silhouette_animating", false );
			}
			options.current = moveTo;

			//todo: update history/hash so using back button to come back to this page load last image you saw
			//Remembers current hash on Firefox and IE6 without adding to history, but Chrome doesn't remember hashes added, and Safari adds all to history (but back button just changes URL without updateing screen)
			//window.location.replace("#"+moveTo);
		};

		changeImage = function(moveTo){
			changeImageMove( moveTo, false );
		}

		//initial image load
		var hash = window.location.hash;
		if( hash != null && hash.length > 1){
			var num=hash.substring(1);
			if( !isNaN(num) && (num.indexOf(".") == -1) && num >=0 ){
				options.current = num;
			}
		}
		changeImageMove(options.current,true);
		
		$(document).keydown(function(e) {
			if(e.keyCode==37){ //left arrow
				changeImage(options.current-1);
			}
			else if(e.keyCode==39){ //right arrow
				changeImage(options.current+1);
			}


		});

		$(window).resize(function() {
			_container.width(_container.parent().width()-options.container_edge+"px");
			changeImageMove(options.current,true);
		});

		checkImageMove = function(){
			if( !_container.data("silhouette_animating") ){
				var thumbArray = $("a img",_thumbs).toArray();
				var curImageLi = $(thumbArray[options.current]);
				var curGalleryLeft = _gallery.css("left").replace(/px,*\)*/g,"");
				var curImgLeft = curImageLi.offset().left - _container.offset().left;
				var toGalleryLeft = _container.width()/2 - (curImgLeft-curGalleryLeft) - curImageLi.width()/2;
				if( Math.abs(toGalleryLeft-curGalleryLeft)>10 ){
					changeImageMove( options.current,true );
				}
			}
		}
		_container.t_i = setInterval( 'checkImageMove()', options.scroll_speed );
		

	};
})(jQuery);




