jQuery(document).ready( function() {

	jQuery('.gfield input').focus( function() {
		jQuery(this).closest('.gfield').addClass('lb-in-focus');
	});

	jQuery('.gfield input').blur( function() {
		jQuery(this).val() ?
			jQuery(this).closest('.gfield').removeClass('lb-in-focus').addClass('lb-has-value') :
			jQuery(this).closest('.gfield').removeClass('lb-in-focus');
	});

	jQuery('.ginput_container_select, .ginput_container_textarea').each( function() {
		jQuery(this).parent().addClass('lb-remove-label');
	});

	// Open Mobile Menu
	jQuery('.lb-mobile-open').click( function() {
		jQuery('#lb-page').toggleClass('lb-menu-open');
	});

	// Open Submenu
	jQuery('#lb-mobile .menu-item-has-children a').click( function() {
		jQuery(this).parent().toggleClass('lb-submenu-open');
	});

	// Add Image Bleed Styles
	jQuery('.lb-bleed-image').each( function() {

		// Get elements
		var $parent = jQuery(this);
		var $text = $parent.find('.et_pb_text');
		var $image = $parent.find('.et_pb_column_empty');
		var $row = $parent.find('.et_pb_row');
		var text_height = $text.parent().outerHeight();

		// Set image height
		$image.css({ 'height' : text_height + 'px' });

		// Re-order image position
		if ( $image.is(':last-child') ) {
			$parent.addClass('lb-right-image');
			$image.remove();
			$row.prepend($image);
		}

	});

});
