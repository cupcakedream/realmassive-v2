function _getAllValuesCustomClose() {
	var options = {};
	options['color'] = jQuery('.doclosebtn-text-color').val();
	options['backgroundColor'] = jQuery('.doclosebtn-bg-color').val();
	options['fontsize'] = parseFloat( jQuery('.post_doclosebtn_fontsize').val() );
	options['borderRadius'] = parseFloat( jQuery('.post_doclosebtn_borderradius').val() );
	options['padding'] = parseFloat( jQuery('.post_doclosebtn_padding').val() );
	
	return options;
};

jQuery(document).ready(function( $ ) {
    
	CustomClose = new CustomClose( _getAllValuesCustomClose() );
	CustomClose.update();
	
	
	$('.doclosebtn-text-color').wpColorPicker({
		clear: function() {

			CustomClose.color = '';
			CustomClose.update();
		},
		change: function(event, ui) {
			
			var hexcolor = jQuery( this ).wpColorPicker( 'color' );
			
			CustomClose.color = hexcolor;
			CustomClose.update();
		}
	});
	
	
	$('.doclosebtn-bg-color').wpColorPicker({
		clear: function() {

			CustomClose.backgroundColor = '';
			CustomClose.update();
		},
		change: function(event, ui) {
			
			var hexcolor = jQuery( this ).wpColorPicker( 'color' );
			
			CustomClose.backgroundColor = hexcolor;
			CustomClose.update();
		}
	});
	
	
	/* Close Button cookie */
	$('#slider-doclosebtn-cookie').slider({
		value: 0,
		min: 0,
		max: 99,
		step: 1,
		slide: function(event, ui) {
			var val = do_getFromField(ui.value, 0, 99);
			
			$('.dov_closebtn_cookie').val(val);
		}
	});
	
	/* Close Button font size */
	$('#slider-doclosebtn-fontsize').slider({
		value: 25,
		min: 25,
		max: 250,
		step: 1,
		slide: function(event, ui) {
			var val = do_getFromField(ui.value, 25, 250);
			CustomClose.fontsize = val;
			CustomClose.update();
			
			$('.post_doclosebtn_fontsize').val(val);
		}
	});
	
	var default_val = $('.post_doclosebtn_fontsize').val();
	$('#slider-doclosebtn-fontsize').slider('value', default_val);
	
	
	/* Close Button border radius */
	$('#slider-doclosebtn-borderradius').slider({
		value: 0,
		min: 0,
		max: 50,
		step: 1,
		slide: function(event, ui) {
			var val = do_getFromField(ui.value, 0, 50);
			CustomClose.borderRadius = val;
			CustomClose.update();
			
			$('.post_doclosebtn_borderradius').val(val);
		}
	});
	
	var default_val = $('.post_doclosebtn_borderradius').val();
	$('#slider-doclosebtn-borderradius').slider('value', default_val);
	
	
	/* Close Button padding */
	$('#slider-doclosebtn-padding').slider({
		value: 0,
		min: 0,
		max: 99,
		step: 1,
		slide: function(event, ui) {
			var val = do_getFromField(ui.value, 0, 99);
			CustomClose.padding = val;
			CustomClose.update();
			
			$('.post_doclosebtn_padding').val(val);
		}
	});
	
	default_val = $('.post_doclosebtn_padding').val();
	$('#slider-doclosebtn-padding').slider('value', default_val);
});

jQuery( function ( $ ) {
	
	if ( $('.enableurltrigger_filters').length ) {
	
		$(".chosen").chosen({disable_search_threshold: 4, width: "95%"});
		$(".do-list-pages").chosen({ width: "95%" });
		
		$('body').on('click','.enableurltrigger', function(event){
			
			if( $(this).is(':checked') ) {
			
				$('.enableurltrigger_filters').addClass('do-show');
				
			} else {
				
				$('.enableurltrigger_filters').removeClass('do-show');
			}
		});
		
		$('body').on('change','.overlay-filter-by-pages', function(event){
			
			var type_pages = $(this).val();
			
			if ( type_pages == 'specific' ) {
				
				$(this).parent().find('.do-list-pages-container').addClass('do-show');
			}
			else {
				
				$(this).parent().find('.do-list-pages-container').removeClass('do-show');
			}
		});
		
		
		$('body').on('click','.enable_custombtn', function(event){
			
			if( $(this).is(':checked') ) {
			
				$('.enable_customizations').addClass('do-show');
				
			} else {
				
				$('.enable_customizations').removeClass('do-show');
			}
		});
		
		
		$('body').on('change','.post_overlay_automatictrigger', function(event){
			
			var type_at = $(this).val();
			
			if ( type_at == 'overlay-timed' ) {
				
				$('.divi_automatictrigger_timed').addClass('do-show');
			}
			else {
				
				$('.divi_automatictrigger_timed').removeClass('do-show');
			}
			
			
			if ( type_at == 'overlay-scroll' ) {
				
				$('.divi_automatictrigger_scroll').addClass('do-show');
			}
			else {
				
				$('.divi_automatictrigger_scroll').removeClass('do-show');
			}
		});
	}
	
	
	$('body').on('click','[data-showhideblock]', function(event){
		
		var block_content = $(this).data('showhideblock');
		
		if ( $(this).is(':checked') ) {
		
			$( block_content ).addClass('do-show');
			
		} else {
			
			$( block_content ).removeClass('do-show');
		}
	});
	
	
	// Scheduling
	var select = 'select[name="dov_settings[dov_timezone]"]';
	if ( $( select ).length ) {
		
		var timezones = moment.tz.names(), timezone_title;
		
		for (var i = 0; i < timezones.length; i++) {
			
			timezone_title = timezones[i].replace('_', ' ');
			
			$( select ).append('<option value="' + timezones[i] + '">' + timezone_title + '</option>');
		}
		
		$( select ).selectpicker({
			
			liveSearch: true
			
		}).on('loaded.bs.select', function (e) {
			
			var default_value = $( select ).data('defaultvalue');
			
			if ( default_value != '' ) {
			
				$( select ).selectpicker('val', default_value);
			}
		});
	}
	
    $('input[name="do_date_start"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
		timePickerIncrement: 30,
		"opens": "center",
		"drops": "up",
		minDate: moment().format('MM/DD/YYYY h A'),
		locale: {
			format: 'MM/DD/YYYY h:mm A'
		}
    }, 
    function(start, end, label) {
		
		
	});
	
    $('input[name="do_date_end"]').daterangepicker({
		autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: true,
		timePickerIncrement: 30,
		"opens": "center",
		"drops": "up",
		minDate: moment().add(30, 'minute').format('MM/DD/YYYY h A'),
		locale: {
			format: 'MM/DD/YYYY h:mm A',
			cancelLabel: 'Clear'
		}
    }, 
    function(start, end, label) {
		
		
	});
	
	$('input[name="do_date_end"]').on('apply.daterangepicker', function(ev, picker) {
		$(this).val( picker.endDate.format('MM/DD/YYYY h:mm A') );
	});
	
	$('input[name="do_date_end"]').on('cancel.daterangepicker', function(ev, picker) {
		$(this).val('');
	});
});

function CustomClose (options) {
    this.htmlElement = jQuery('.overlay-customclose-btn');
    this.color = options['color'] || '#333333';
	this.backgroundColor = options['backgroundColor'] || '';
	this.fontsize = options['fontsize'] || 25;
	this.borderRadius = options['borderRadius'] || 0;
    this.padding = options['padding'] || 0;
    
};

CustomClose.prototype.update = function () {
	this.htmlElement.css('color', this.color, 'important');
	this.htmlElement.css('background-color', this.backgroundColor, 'important');
	this.htmlElement.css('-moz-border-radius', this.borderRadius + '%', 'important');
	this.htmlElement.css('-webkit-border-radius', this.borderRadius + '%', 'important');
	this.htmlElement.css('-khtml-border-radius', this.borderRadius + '%', 'important');
	this.htmlElement.css('font-size', this.fontsize + 'px', 'important');
	this.htmlElement.css('border-radius', this.borderRadius + '%', 'important');
	this.htmlElement.css('padding', this.padding + 'px', 'important');
};

function do_getFromField(value, min, max, elem) {
	var val = parseFloat(value);
	if (isNaN(val) || val < min) {
		val = 0;
	} else if (val > max) {
		val = max;
	}

	if (elem)
		elem.val(val);

	return val;
}