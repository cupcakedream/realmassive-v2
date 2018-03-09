<?php
/**
 * Plugin Name: Gravity Forms Material Design
 * Plugin URI: https://www.wpmonks.com
 * Description: Adds Material Design styling to Gravity Forms
 * Version: 2.0
 * Author: Sushil Kumar
 * Author URI: https://www.wpmonks.com
 * Text Domain: skgftermslock
 */
if ( ! defined( 'ABSPATH' ) ) exit;

define( "STLA_MATERIAL_DIR", WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ) );
define( "STLA_MATERIAL_URL", plugins_url() . "/" . basename( dirname( __FILE__ ) ) );
define( "GF_MATDES_STORE_URL", "https://wpmonks.com" );
include_once WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ) . '/update.php';
class Sk_Stla_Material {
	private $is_frontend = false;
	public function __construct() {
		//modify text, dropdowns, radio, checkbox fields
		add_filter( 'gform_field_content', array( $this, 'add_material_support' ), 10, 5 );
		add_action( 'gform_enqueue_scripts', array( $this, 'add_gravity_styles_scripts' ), 10, 2 );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'add_styles_scripts' ), 99, 2 );
		//modify structure of next button
		add_filter( 'gform_next_button', array( $this, 'input_to_button' ), 10, 2 );
		//modify structure of previous button
		add_filter( 'gform_previous_button', array( $this, 'input_to_button' ), 10, 2 );
		//modify structure of submit button
		add_filter( 'gform_submit_button', array( $this, 'input_to_button' ), 10, 2 );
		add_filter( 'gform_pre_render', array( $this, 'before_form_render' ) );
		//modify structure of progress button
		add_filter( 'gform_progress_bar', array( $this, 'modify_progress_bar' ), 10, 3 );
		// //modify structure of validation message
		add_filter( 'gform_validation_message', array( $this, 'modify_validation_message' ), 10, 2 );
		//add and remove css classes
		add_filter( 'gform_field_css_class', array( $this, 'modify_field_css_classes' ), 10, 3 );
		// //modify confimation message
		// add_filter( 'gform_confirmation', array( $this, 'modify_confirmation_message'), 10, 4 );
		add_action( 'admin_notices', array( $this, 'check_plugin_dependencies' ) );
		//add_action( 'wp_head', array( $this, 'gf_stla_add_material_css_to_frontend' ) );
		add_action( 'gf_stla_add_theme_section', array( $this, 'gf_stla_add_material_design_section' ), 14, 2 );
		//set our trigger to true if parameter is found

	}


	/** function to add all the sections and settings for material design in customizer */
	function gf_stla_add_material_design_section( $wp_customize, $current_form_id ) {
		//$trigger = true;
		//  die();
		//Add Material Design section
		// if ( get_query_var( $this->stla_query_var ) ) {
		$wp_customize->add_section( 'gf_stla_form_id_material_design' , array(
				'title' => 'Material Design',
				'panel' => 'gf_stla_panel',
			) );

		//add material design settings and controls to enable and disable it
		$wp_customize->add_setting( 'gf_stla_form_id_material_design_' . $current_form_id . '[enabled]', array(
				'default'     => false,
				//'transport'   => 'postMessage',
				'type' => 'option'
			) );

		$wp_customize->add_control( 'gf_stla_form_id_material_design_' . $current_form_id . '[enabled]',   array(
				'type' => 'checkbox',
				'priority' => 10, // Within the section.
				'section' => 'gf_stla_form_id_material_design', // Required, core or custom.
				'label' => __( 'Enable Material Design' ),

			) );
		// Option to select Theme
		$wp_customize->add_setting( 'gf_stla_form_id_material_design_' . $current_form_id . '[theme]', array(
				'default'     => '#6200ee',
				//'transport'   => 'postMessage',
				'type' => 'option'
			) );

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, // WP_Customize_Manager
				'gf_stla_form_id_material_design_' . $current_form_id . '[theme]', // Setting id
				array( // Args, including any custom ones.
					'label' => __( 'Theme Color' ),
					'section' => 'gf_stla_form_id_material_design',
				)
			)
		);

		//Option to convert checkboxes into switches
		$wp_customize->add_setting( 'gf_stla_form_id_material_design_' . $current_form_id . '[checkbox-to-switch]', array(
				'default'     => false,
				//'transport'   => 'postMessage',
				'type' => 'option'
			) );

		$wp_customize->add_control( 'gf_stla_form_id_material_design_' . $current_form_id . '[checkbox-to-switch]',   array(
				'type' => 'checkbox',
				'priority' => 10, // Within the section.
				'section' => 'gf_stla_form_id_material_design', // Required, core or custom.
				'label' => __( 'Convert Checkbox to Switches' ),
			) );

		//}

	}

	//check if styles and layouts is present
	function check_plugin_dependencies() {
		if ( ! class_exists( 'Gravity_customizer_admin' ) ) {
			$class = 'notice notice-error';
			$message = '<a href="https://wordpress.org/plugins/styles-and-layouts-for-gravity-forms/">Styles & Layouts for Gravity Forms </a>is not installed. <strong>Gravity Forms Material Design </strong> can\'t work without Styles & Layouts for Gravity Forms ';

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message  );
		}
	}

	//modify confirmation message
	function modify_confirmation_message( $confirmation, $form, $entry, $ajax ) {
		$form_id = $form['id'];
		$enabled = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $enabled['enabled'];
		if ( ! $enabled ) {
			return $confirmation;
		}
		$confirmation = str_replace( 'gform_confirmation_wrapper', 'alert alert-success', $confirmation );
		return $confirmation;
	}

	//find and remove css classes
	function modify_field_css_classes( $classes, $field, $form ) {
		$form_id = $form['id'];
		$enabled = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $enabled['enabled'];
		if ( ! $enabled ) {
			return $classes;
		}
		//var_dump($classes);
		if ( strpos( $classes, 'gfield_error' ) !== false ) {
			$classes = str_replace( 'gfield_error', '', $classes );
			$classes .= ' sk-gfield_error';
		}

		return $classes;
	}

	//check if frontend view

	function before_form_render( $form ) {
		$this->is_frontend = true;
		return $form;
	}
	//modify_validation_message

	function modify_validation_message( $message, $form ) {
		$form_id = $form['id'];
		$enabled = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $enabled['enabled'];
		if ( ! $enabled ) {
			return $message;
		}
		//var_dump($message);
		$dom = new DOMDocument;
		$dom->loadHTML( $message );
		$get_div = $dom->getElementsByTagName( 'div' )->item( 0 );
		$get_div->removeAttribute( 'class' );
		$error_message = $get_div->textContent;
		$get_div->textContent = '';
		$inner_span = $dom->createElement( 'span' );
		$error_container = $dom->createElement( 'p', $error_message );
		$get_div->appendChild( $inner_span );
		$get_div->appendChild( $error_container );
		$dom->getElementsByTagName( 'p' )->item( 0 )->setAttribute( 'class', 'mdc-text-field-helper-text mdc-text-field-helper-text--persistent mdc-text-field-helper-text--validation-msg' );
		$dom->getElementsByTagName( 'span' )->item( 0 )->setAttribute( 'class', 'mdc-text-field--invalid' );
		$message = $dom->saveHTML();
		return $message;
	}


	//modify markup of progress bar
	function modify_progress_bar( $progress_bar, $form, $confirmation_message ) {
		$form_id = $form['id'];
		$enabled = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $enabled['enabled'];
		if ( ! $enabled ) {
			return $progress_bar;
		}

		$dom = new DOMDocument;
		$dom->loadHTML( $progress_bar );
		$divs = $dom->getElementsByTagName( 'div' );
		foreach ( $divs as $div ) {
			$current_div_classes = $div->getAttribute( 'class' );
			if ( preg_match( '/^gf_progressbar$/', $current_div_classes ) ) {
				$div->setAttribute( 'class', 'mdc-linear-progress' );

				$progress_buffer = $dom->createElement( 'div' );
				$progress_buffer->setAttribute( 'class', 'mdc-linear-progress__buffer' );

				$secondary_bar = $dom->createElement( 'div' );
				$secondary_bar->setAttribute( 'class', ' mdc-linear-progress__bar mdc-linear-progress__secondary-bar' );

				$secondary_bar_inner  = $dom->createElement( 'span' );
				$secondary_bar_inner->setAttribute( 'class', 'mdc-linear-progress__bar-inner' );

				$child_divs = $div->getElementsByTagName( 'div' );
				//add linear progress to html
				$div->appendChild( $progress_buffer );
				foreach ( $child_divs as $child_div ) {

					$child_div_classes = $child_div->getAttribute( 'class' );
					// var_dump( $child_div_classes );
					if ( strpos( $child_div_classes, 'gf_progressbar_percentage' ) !== false ) {
						// var_dump('this worked');
						$child_div->setAttribute( 'class', 'mdc-linear-progress__bar mdc-linear-progress__primary-bar' );
						$progress_amount = $child_div->getElementsByTagName( 'span' )->item( 0 );
						$progress_amount->setAttribute( 'class', 'mdc-linear-progress__bar-inner' );

						//move child div below linear progress
						$div->appendChild( $child_div );
						break;
					}


				}

				$div->appendChild( $secondary_bar );

				//find secondary bar and append secodary bar inner ot it
				$all_divs = $div->getElementsByTagName( 'div' );
				foreach ( $all_divs as $all_div ) {
					$get_div_classes = $all_div->getAttribute( 'class' );
					if ( strpos( $get_div_classes, 'mdc-linear-progress__secondary-bar' ) !== false ) {
						$all_div->appendChild( $secondary_bar_inner );
					}
				}


			}

		}

		$progress_bar = $dom->saveHTML();
		//  //var_dump($progress_bar);
		return $progress_bar;
	}


	//add styles and scripts which loads only if gravity forms is present on page
	function add_gravity_styles_scripts( $form, $is_ajax ) {
		$form_id = $form['id'];
		$enabled = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $enabled['enabled'];
		if ( ! $enabled ) {
			return;
		}



		wp_enqueue_style( 'stla_material_frontend_css', STLA_MATERIAL_URL . '/css/material-components-web.css' );
		//wp_enqueue_style( 'stla_material_custom_css', STLA_MATERIAL_URL . '/css/custom.css' );
		wp_enqueue_script( 'stla_material_frontend_js', STLA_MATERIAL_URL . '/js/material-components-web.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'stla_initialize_material_js', STLA_MATERIAL_URL . '/js/initialize-material.js', array( 'jquery' ), false, true );
		include STLA_MATERIAL_DIR . '/css/custom.php';
		include STLA_MATERIAL_DIR . '/css/theming.php';
	}

	function add_styles_scripts() {
		wp_enqueue_script( 'gf_stla_customize_control_js', STLA_MATERIAL_URL . '/js/customize-control-script.js', array( 'jquery' ), false, true );
	}


	//change submit/next/previous input tags to buttons
	function input_to_button( $button, $form ) {
		$form_id = $form['id'];
		$enabled = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $enabled['enabled'];
		if ( ! $enabled ) {
			return $button;
		}
		$dom = new DOMDocument();
		$dom->loadHTML( $button );

		$input = $dom->getElementsByTagName( 'input' )->item( 0 );
		$new_button = $dom->createElement( 'button' );
		$new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
		$input->removeAttribute( 'value' );
		foreach ( $input->attributes as $attribute ) {
			if ( $attribute->name == 'class' ) {
				$new_button->setAttribute( $attribute->name, $attribute->value . ' mdc-button mdc-button--raised ' );
			}
			else {
				$new_button->setAttribute( $attribute->name, $attribute->value );
			}
		}
		$input->parentNode->replaceChild( $new_button, $input );

		return $dom->saveHtml( $new_button );
	}

	//modify the html structure of gravity form fields to support material design
	function add_material_support( $content, $field, $value, $lead_id, $form_id ) {
		$material_options = get_option( 'gf_stla_form_id_material_design_' . $form_id );
		$enabled = $material_options['enabled'];
		if ( ! $enabled ) {
			return $content;
		}

		if ( $this->is_frontend ) {
			//var_dump($field->type);
			$input_fields = array( 'text', 'number', 'email', 'website', 'date', 'phone', 'post_title', 'post_tags', 'quantity', 'post_custom_field' ) ;
			$select_fields = array( 'select', 'post_tags', 'post_custom_field', 'post_category', 'quantity', 'option', 'shipping' );
			$checkbox_fields = array( 'checkbox', 'post_tags', 'post_custom_field', 'post_category', 'quantity', 'option' );
			$radio_fields = array( 'radio', 'post_tags', 'post_custom_field', 'post_category', 'option', 'shipping' );
			$complex_fields = array( 'name', 'address' );
			$multiselect_fields = array( 'multiselect', 'post_tags', 'post_custom_field', 'post_category' );

			$dom = new DOMDocument;
			$dom->loadHTML( $content );

			include STLA_MATERIAL_DIR . '/includes/input.php';
			include STLA_MATERIAL_DIR . '/includes/checkbox.php';
			include STLA_MATERIAL_DIR . '/includes/dropdown.php';
			include STLA_MATERIAL_DIR . '/includes/list.php';
			include STLA_MATERIAL_DIR . '/includes/radio.php';
			include STLA_MATERIAL_DIR . '/includes/textarea.php';
			include STLA_MATERIAL_DIR . '/includes/time.php';
			include STLA_MATERIAL_DIR . '/includes/upload.php';
			include STLA_MATERIAL_DIR . '/includes/complex.php';
			include STLA_MATERIAL_DIR . '/includes/multiselect.php';
			include STLA_MATERIAL_DIR . '/includes/switch.php';
		}
		return $content;
	}
}

add_action( 'plugins_loaded', 'sk_stla_material' );

function sk_stla_material() {
	new Sk_Stla_Material();
}
