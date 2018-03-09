jQuery(document).ready(function() {
	var triggerBttn = document.getElementById( 'trigger-overlay' );
	var overlay = document.querySelector( 'div.overlay' );
	var closeBttn = overlay.querySelector( 'button.overlay-close' );
	jQuery('body [id^="overlay_"]').on('click', function () {
		
		var overlayArr = jQuery(this).attr('id').split('_');
		var overlay_id = overlayArr[3];
		
		overlay = document.querySelector( '#overlay'+overlay_id );
		closeBttn = overlay.querySelector( 'button.overlay-close' );
		//alert(closeBttn.getAttribute('id'));
		jQuery( "#trigger-overlay" ).trigger( "click" );
		closeBttn.addEventListener( 'click', toggleOverlay );
		/*
		jQuery.ajax({			                    
				type: "POST",
				url: ajaxurl,	
				data: {action: 'my_action', overlay_id : overlay_id},
				success:function(data){	
					//alert(data);
					jQuery(".overlay-hugeinc .mydata").html(data);
					//alert("overlay_unique_id_"+overlay_id);
					jQuery( "#trigger-overlay" ).trigger( "click" );
				}
		});*/
	});
	jQuery('body [rel^="unique_overlay_"]').on('click', function () {
		var overlayArr = jQuery(this).attr('rel').split('_');
		var overlay_id = overlayArr[4];
		overlay = document.querySelector( '#overlay'+overlay_id );
		closeBttn = overlay.querySelector( 'button.overlay-close' );
		//alert(closeBttn.getAttribute('id'));
		jQuery( "#trigger-overlay" ).trigger( "click" );
		closeBttn.addEventListener( 'click', toggleOverlay );
		/*jQuery.ajax({
				type: "POST",
				url: ajaxurl,
				data: {action: 'my_action', overlay_id : overlay_id},
				success:function(data){
					//alert(data);
					jQuery(".overlay-hugeinc .mydata").html(data);
					//alert("overlay_unique_id_"+overlay_id);
					jQuery( "#trigger-overlay" ).trigger( "click" );
				}
		});*/
	});
	transEndEventNames = {
		'WebkitTransition': 'webkitTransitionEnd',
		'MozTransition': 'transitionend',
		'OTransition': 'oTransitionEnd',
		'msTransition': 'MSTransitionEnd',
		'transition': 'transitionend'
	},
	transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
	support = { transitions : Modernizr.csstransitions };
	function toggleOverlay() {
		/*var overlay = document.querySelector( 'div.overlay' );
		var closeBttn = overlay.querySelector( 'button.overlay-close' );
		jQuery("div#sidebar-overlay div[id^='overlay']").each(function()
		{
			if(jQuery(this).hasClass("hidden")==false)
			{
				overlay = document.querySelector( 'div.overlay.test' );
				closeBttn = overlay.querySelector( 'div.overlay.test button.overlay-close' );
			}
		});*/
		//alert(overlay.getAttribute("class"));
		if( classie.has( overlay, 'open' ) ) {
			classie.remove( overlay, 'open' );
			classie.add( overlay, 'close' );
			var onEndTransitionFn = function( ev ) {
				if( support.transitions ) {
					if( ev.propertyName !== 'visibility' ) return;
					this.removeEventListener( transEndEventName, onEndTransitionFn );
				}
				classie.remove( overlay, 'close' );
			};
			if( support.transitions ) {
				overlay.addEventListener( transEndEventName, onEndTransitionFn );
			}
			else {
				onEndTransitionFn();
			}
		}
		else if( !classie.has( overlay, 'close' ) ) {
			classie.add( overlay, 'open' );
		}
	}
	triggerBttn.addEventListener( 'click', toggleOverlay );
	closeBttn.addEventListener( 'click', toggleOverlay );
});
