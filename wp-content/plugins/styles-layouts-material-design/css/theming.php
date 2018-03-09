<?php
$material_options = get_option('gf_stla_form_id_material_design_' . $form_id);
$primary_color = isset($material_options['theme'])? $material_options['theme']: '#6200ee';
$secondary_color = $primary_color;
// $progress_color = isset( $material_options['progress-color'])?$material_options['progress-color']: '#28a745';

echo '<style>


  :root {
	--mdc-theme-primary: '.$primary_color.';
	--mdc-theme-secondary: '.$secondary_color.';
  }
  #gform_wrapper_'.$form_id.' .mdc-radio .mdc-radio__native-control:enabled:checked + .mdc-radio__background .mdc-radio__outer-circle {
	/* @alternate */
	border-color: '.$secondary_color.';
	border-color: var(--mdc-theme-secondary, #ccc);
  }
  #gform_wrapper_'.$form_id.' .mdc-radio .mdc-radio__native-control:enabled + .mdc-radio__background .mdc-radio__inner-circle {
	/* @alternate */
	background-color: '.$secondary_color.';
	background-color: var(--mdc-theme-secondary, #ccc);
  }
  #gform_wrapper_'.$form_id.' .mdc-radio .mdc-radio__background::before {
	/* @alternate */
	background-color: '.$secondary_color.';
  }
  @supports not (-ms-ime-align: auto) {
	#gform_wrapper_'.$form_id.' .mdc-radio .mdc-radio__background::before {
	  background-color: var(--mdc-theme-secondary, #ccc);
	}
  }
  #gform_wrapper_'.$form_id.' .mdc-radio::before,
  #gform_wrapper_'.$form_id.' .mdc-radio::after {
	/* @alternate */
	background-color: '.$secondary_color.';
  }
  @supports not (-ms-ime-align: auto) {
	#gform_wrapper_'.$form_id.' .mdc-radio::before,
	#gform_wrapper_'.$form_id.' .mdc-radio::after {
	  background-color: var(--mdc-theme-secondary, #ccc);
	}
  }
//   #gform_wrapper_'.$form_id.' .mdc-button:not(:disabled) {
// 	/* @alternate  button color*/
// 	color: '.$primary_color.';
// 	color: var(--mdc-theme-primary, red);
//   }
  #gform_wrapper_'.$form_id.' .mdc-button::before,
  #gform_wrapper_'.$form_id.' .mdc-button::after {
	/* @alternate */
	background-color: '.$primary_color.';
  }
  @supports not (-ms-ime-align: auto) {
	#gform_wrapper_'.$form_id.' .mdc-button::before,
	#gform_wrapper_'.$form_id.' .mdc-button::after {
	  background-color: var(--mdc-theme-primary, #00ff00);
	}
  }
  #gform_wrapper_'.$form_id.' .mdc-button:hover::before {
	opacity: 0.04;
  }
  #gform_wrapper_'.$form_id.' .mdc-button--raised:not(:disabled),
  #gform_wrapper_'.$form_id.' .mdc-button--unelevated:not(:disabled) {
	/* @alternate */
	background-color: '.$primary_color.';
  }
  @supports not (-ms-ime-align: auto) {
	#gform_wrapper_'.$form_id.' .mdc-button--raised:not(:disabled),
	#gform_wrapper_'.$form_id.' .mdc-button--unelevated:not(:disabled) {
	  background-color: var(--mdc-theme-primary, #00ff00);
	}
  }
  #gform_wrapper_'.$form_id.' .mdc-button--stroked:not(:disabled) {
	/* @alternate */
	border-color: '.$primary_color.';
	border-color: var(--mdc-theme-primary, #00ff00);
  }
  #gform_wrapper_'.$form_id.' .mdc-linear-progress__bar-inner {
	/* @alternate */
	background-color: '.$primary_color.';
	background-color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field .mdc-line-ripple {
	/* @alternate */
	background-color: '.$primary_color.';
	background-color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-text-field__outline-path {
	/* @alternate */
	stroke: '.$primary_color.';
	stroke: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__input::-webkit-input-placeholder {
	/* @alternate */
	color: '.$primary_color.';
	color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__input::-moz-placeholder {
	/* @alternate */
	color: '.$primary_color.';
	color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__input:-ms-input-placeholder {
	/* @alternate */
	color: '.$primary_color.';
	color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__input::placeholder {
	/* @alternate */
	color: '.$primary_color.';
	color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused .mdc-text-field__input:required + .mdc-text-field__label::after {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--focused + .mdc-text-field-helper-text:not(.mdc-text-field-helper-text--validation-msg) {
	opacity: 1;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--textarea.mdc-text-field--focused:not(.mdc-text-field--disabled) {
	/* @alternate */
	border-color: '.$primary_color.';
	border-color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--textarea.mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-text-field__input:focus {
	/* @alternate */
	border-color: '.$primary_color.';
	border-color: var(--mdc-theme-primary, #ff0000);
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--outlined):not(.mdc-text-field--textarea) .mdc-text-field__input {
	border-bottom-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--outlined):not(.mdc-text-field--textarea) .mdc-text-field__input:hover {
	border-bottom-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-line-ripple {
	background-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input::-webkit-input-placeholder {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input::-moz-placeholder {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input:-ms-input-placeholder {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__label,
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input::placeholder {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--invalid + .mdc-text-field-helper-text--validation-msg {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--invalid + .mdc-text-field-helper-text--validation-msg {
	opacity: 1;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled) {
	border-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--textarea.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input:focus {
	border-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__idle-outline {
	border-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-text-field__outline .mdc-text-field__outline-path {
	stroke: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__input:hover ~ .mdc-text-field__idle-outline,
  #gform_wrapper_'.$form_id.' .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled) .mdc-text-field__icon:hover ~ .mdc-text-field__idle-outline {
	border-color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field--outlined.mdc-text-field--invalid:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-text-field__outline-path {
	stroke: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-switch {
	display: inline-block;
	position: relative;
  }
  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:not(:checked) ~ .mdc-switch__background::before {
	background-color: #000;
  }
  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:not(:checked) ~ .mdc-switch__background .mdc-switch__knob {
	background-color: #fafafa;
  }
  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:not(:checked) ~ .mdc-switch__background .mdc-switch__knob::before {
	background-color: #9e9e9e;
  }
  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:checked ~ .mdc-switch__background::before {
	/* @alternate */
	background-color: '.$secondary_color.';
	background-color: var(--mdc-theme-secondary, #018786);
  }
  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:checked ~ .mdc-switch__background .mdc-switch__knob {
	/* @alternate */
	background-color: '.$secondary_color.';
	background-color: var(--mdc-theme-secondary, #018786);
  }
  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:checked ~ .mdc-switch__background .mdc-switch__knob::before {
	/* @alternate */
	background-color: '.$secondary_color.';
	background-color: var(--mdc-theme-secondary, #018786);
  }
  #gform_wrapper_'.$form_id.' .mdc-switch__native-control:disabled ~ .mdc-switch__background::before {
	background-color: #000;
	opacity: .12;
  }
  #gform_wrapper_'.$form_id.' .mdc-switch__native-control:disabled ~ .mdc-switch__background .mdc-switch__knob {
	background-color: #bdbdbd;
  }
  #gform_wrapper_'.$form_id.' select.mdc-list option:checked {
	color: red;
  }

  #gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:checked ~ .mdc-switch__background::before {
    /* @alternate */
    background-color: '.$secondary_color.';
    background-color: var(--mdc-theme-secondary, #018786); }
	#gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:checked ~ .mdc-switch__background .mdc-switch__knob {
    /* @alternate */
    background-color: '.$secondary_color.';
    background-color: var(--mdc-theme-secondary, #018786); }
	#gform_wrapper_'.$form_id.' .mdc-switch .mdc-switch__native-control:enabled:checked ~ .mdc-switch__background .mdc-switch__knob::before {
    /* @alternate */
    background-color: '.$secondary_color.';
	background-color: var(--mdc-theme-secondary, #018786); }
	
	#gform_wrapper_'.$form_id.' .mdc-checkbox::before, .mdc-checkbox::after {
		/* @alternate */
		background-color: '.$secondary_color.'; }
		@supports not (-ms-ime-align: auto) {
		  .mdc-checkbox::before, .mdc-checkbox::after {
			background-color: var(--mdc-theme-secondary, #953e44); } }
	
	#gform_wrapper_'.$form_id.' .mdc-checkbox__background::before {
	  /* @alternate */
	  background-color: '.$secondary_color.'; }
	  @supports not (-ms-ime-align: auto) {
		.mdc-checkbox__background::before {
		  background-color: var(--mdc-theme-secondary, #953e44); } }
	
	
	  #gform_wrapper_'.$form_id.' .mdc-checkbox__native-control:enabled:checked ~ .mdc-checkbox__background, .mdc-checkbox__native-control:enabled:indeterminate ~ .mdc-checkbox__background {
	  /* @alternate */
	  border-color: '.$secondary_color.';
	  border-color: var(--mdc-theme-secondary, #953e44);
	  /* @alternate */
	  background-color: '.$secondary_color.';
	  background-color: var(--mdc-theme-secondary, #953e44); }
	
	  @-webkit-keyframes mdc-checkbox-fade-in-background-0 {
	  0% {
		border-color: rgba(0, 0, 0, 0.54);
		background-color: transparent; }
	  50% {
		/* @alternate */
		border-color: '.$secondary_color.';
		border-color: var(--mdc-theme-secondary, #953e44);
		/* @alternate */
		background-color: '.$secondary_color.';
		background-color: var(--mdc-theme-secondary, #953e44); } }
	
	@keyframes mdc-checkbox-fade-in-background-0 {
	  0% {
		border-color: rgba(0, 0, 0, 0.54);
		background-color: transparent; }
	  50% {
		/* @alternate */
		border-color: '.$secondary_color.';
		border-color: var(--mdc-theme-secondary, #953e44);
		/* @alternate */
		background-color: '.$secondary_color.';
		background-color: var(--mdc-theme-secondary, #953e44); } }
	
	@-webkit-keyframes mdc-checkbox-fade-out-background-0 {
	  0%, 80% {
		/* @alternate */
		border-color:'.$secondary_color.';
		border-color: var(--mdc-theme-secondary, #953e44);
		/* @alternate */
		background-color: '.$secondary_color.';
		background-color: var(--mdc-theme-secondary, #953e44); }
	  100% {
		border-color: rgba(0, 0, 0, 0.54);
		background-color: transparent; } }
	
	@keyframes mdc-checkbox-fade-out-background-0 {
	  0%, 80% {
		/* @alternate */
		border-color: '.$secondary_color.';
		border-color: var(--mdc-theme-secondary, #953e44);
		/* @alternate */
		background-color: '.$secondary_color.';
		background-color: var(--mdc-theme-secondary, #953e44); }
	  100% {
		border-color: rgba(0, 0, 0, 0.54);
		background-color: transparent; } }
  

</style>';
