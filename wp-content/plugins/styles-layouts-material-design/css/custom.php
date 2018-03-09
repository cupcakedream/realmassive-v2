<?php
echo '<style>
@media screen and (min-width: 641px) {
	#gform_wrapper_'.$form_id.' .stla_material_large {
	  width: 100% !important;
	}
	#gform_wrapper_'.$form_id.' .stla_material_medium {
	  width: 50% !important;
	}
	#gform_wrapper_'.$form_id.' .stla_material_small {
	  width: 25% !important;
	}
  }
  #gform_wrapper_'.$form_id.' .mdc-text-field__input {
	width: 100% !important;
	border-top: 0 !important;
	border-left: 0 !important;
	border-right: 0 !important;
	margin-bottom:0;
  }

  #gform_wrapper_'.$form_id.' .mdc-switch__native-control{
	width: 48px !important;
	height: 48px !important;
  }

  #gform_wrapper_'.$form_id.' .field_sublabel_below .ginput_complex.ginput_container label,
  #gform_wrapper_'.$form_id.' .field_sublabel_below div[class*="gfield_time_"].ginput_container label {
	margin-bottom: 0px !important;
  }
  #gform_wrapper_'.$form_id.' .ginput_complex label,
  #gform_wrapper_'.$form_id.' .ginput_container_time label {
	line-height: 1.4;
  }
  #gform_wrapper_'.$form_id.' select.mdc-text-field__input {
	background-repeat: no-repeat;
	background-position: right 8px bottom 8px;
	cursor: pointer;
	background-image: url(data:image/svg+xml,%3Csvg%20width%3D%2210px%22%20height%3D%225px%22%20viewBox%3D%227%2010%2010%205%22%20version%3D%221.1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%0A%20%20%20%20%3Cpolygon%20id%3D%22Shape%22%20stroke%3D%22none%22%20fill%3D%22%230%22%20fill-rule%3D%22evenodd%22%20opacity%3D%220.54%22%20points%3D%227%2010%2012%2015%2017%2010%22%3E%3C%2Fpolygon%3E%0A%3C%2Fsvg%3E);
  }
  #gform_wrapper_'.$form_id.' ul.gfield_checkbox li input[type="checkbox"].mdc-checkbox__native-control,
  #gform_wrapper_'.$form_id.' ul.gfield_radio li input[type="radio"].mdc-radio__native-control {
	width: 100% !important;
  }

  #gform_wrapper_'.$form_id.' li.gfield.gf_list_2col ul.gfield_checkbox,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_2col ul.gfield_radio,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_3col ul.gfield_checkbox,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_3col ul.gfield_radio,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_4col ul.gfield_checkbox,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_4col ul.gfield_radio,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_5col ul.gfield_checkbox,
  #gform_wrapper_'.$form_id.' li.gfield.gf_list_5col ul.gfield_radio,
  #gform_wrapper_'.$form_id.' ul.gfield_checkbox li,
  #gform_wrapper_'.$form_id.' ul.gfield_radio li {
	overflow: visible !important;
  }
  #gform_wrapper_'.$form_id.' .mdc-checkbox {
	box-sizing: content-box !important;
  }
  #gform_wrapper_'.$form_id.' .mdc-form-field {
	display: inline-flex !important;
  }
  .gfield_checkbox .mdc-form-field,
   .gfield_radio .mdc-form-field,
  #gform_wrapper_'.$form_id.' .ginput_container_multiselect select.mdc-list {
	width: 100%;
  }
  #gform_wrapper_'.$form_id.' .ginput_container_fileupload,
  #gform_wrapper_'.$form_id.' .ginput_container_post_image {
	text-align: left;
  }
  #gform_wrapper_'.$form_id.' .ginput_container_fileupload input[type="file"].mdc-button,
  #gform_wrapper_'.$form_id.' .ginput_container_post_image input[type="file"].mdc-button {
	padding-left: 0;
	text-align: left;
  }
  #gform_wrapper_'.$form_id.' .gfield_list_icons .add_list_item {
	margin-right: 10px;
  }
  #gform_wrapper_'.$form_id.' .ginput_complex .ginput_right.mdc-text-field__input {
	min-height: auto;
  }
  #gform_wrapper_'.$form_id.' .sk-gfield_error .gfield_label,
  #gform_wrapper_'.$form_id.' .gfield_description.validation_message {
	color: #d50000;
  }
  #gform_wrapper_'.$form_id.' .mdc-list option {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-ms-flex-align: center;
	-webkit-box-pack: start;
	-ms-flex-pack: start;
	height: 40px;
	padding: 0 16px;
  }
  #gform_wrapper_'.$form_id.' .mdc-list {
	height: auto !important;
	padding: 0 !important;
  }

  #gform_wrapper_'.$form_id.' .field_description_below .gfield_description{
	padding-top: 8px;
  }

  #gform_wrapper_'.$form_id.' .gfield_list_group, #gform_wrapper_'.$form_id.' .gfield_list_cell, #gform_wrapper_'.$form_id.' .gfield_list_cell .mdc-text-field{
	padding-top: 0;
	margin:0;
  }
 	</style> 
  ';
  