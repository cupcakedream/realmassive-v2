
jQuery(document).bind('gform_post_render', function(){

	mdc.autoInit();
	jQuery('.mdc-checkbox').each(function(){
        mdc.checkbox.MDCCheckbox.attachTo(this);
	})

	jQuery('.mdc-radio').each(function(){
        mdc.radio.MDCRadio.attachTo(this);
	});

	jQuery('.gfield_list_icons').click(function(){
		mdc.autoInit(/* root */ document, () => {});
	});

	//ripple effect

	var btns = document.querySelectorAll('.mdc-button');
	        for (var i = 0, btn; btn = btns[i]; i++) {
	          mdc.ripple.MDCRipple.attachTo(btn);
	        }

	//keep the float above class for input fields that have placeholder

	jQuery('.mdc-text-field__input').on('blur',  function(){
		var current_field_id = jQuery(this).prop('id');
		
		if( jQuery('#'+current_field_id).attr('placeholder') !== undefined ){
			jQuery( 'label[for='+current_field_id+'].mdc-text-field__label' ).addClass('mdc-text-field__label--float-above');
		}
	
	});

	//keep the float above class for dropdown fields that have placeholder

	jQuery('select.mdc-text-field__input').on('blur',  function(){
		var current_field_id = jQuery(this).prop('id');
		jQuery('#'+current_field_id +' option').each( function (){
			if( jQuery(this).hasClass('gf_placeholder') || jQuery(this).hasClass( 'stla-material-placeholder')){
			jQuery( 'label[for="'+current_field_id+'"].mdc-text-field__label' ).addClass('mdc-text-field__label--float-above');
		} 
		});
	
	});

	//set progress bar

	var determinates = document.querySelectorAll('.mdc-linear-progress');
	for (var i = 0, determinate; determinate = determinates[i]; i++) {
	  var linearProgress = mdc.linearProgress.MDCLinearProgress.attachTo(determinate);
	  linearProgress.progress = 1;
	}

	});
