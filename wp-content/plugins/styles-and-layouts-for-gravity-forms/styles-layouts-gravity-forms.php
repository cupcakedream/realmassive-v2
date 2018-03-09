<?php
/*
Plugin Name: Styles & Layouts Gravity Forms
Plugin URI:  http://wpmonks.com/styles-layouts-gravity-forms
Description: Create beautiful styles for your gravity forms
Version:     3.0.3
Author:      Sushil Kumar
Author URI:  http://wpmonks.com/
License:     GPL2License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// don't load directly
if ( !defined( 'ABSPATH' ) ) die( '-1' );

define( "GF_STLA_DIR", WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ) );
define( "GF_STLA_URL", plugins_url() . "/" . basename( dirname( __FILE__ ) ) );
define( "GF_STLA_STORE_URL", "https://wpmonks.com" );

if ( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
	include_once GF_STLA_DIR.'/admin-menu/EDD_SL_Plugin_Updater.php';
}

include_once GF_STLA_DIR.'/admin-menu/licenses.php';
include_once GF_STLA_DIR.'/admin-menu/addons.php';
include_once GF_STLA_DIR.'/admin-menu/welcome-page.php';

//Main class of Styles & layouts Gravity Forms
class Gravity_customizer_admin {

	public $all_found_forms_ids=array();
	private $trigger;
	private $stla_form_id;
	/**
	 *  method for all hooks
	 *
	 * @author Sushil Kumar
	 * @since  v1.0
	 */
	function __construct() {
		global $wp_version;
		//add_action( 'wp', array( $this, 'get_gravity_forms_shortcode' ) );
		//add_action( 'wp_head', array( $this, 'gf_stla_add_css_to_frontend' ) );
		add_action( 'customize_register', array( $this, 'gf_stla_customize_register' ) ) ;
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'gf_stla_autosave_form' ) );
		add_action( 'customize_preview_init', array( $this, 'gf_stla_live_preview' ) );
		register_activation_hook( __FILE__, array( $this, 'gf_stla_welcome_screen_activate' ) );
		add_action( 'admin_init', array( $this, 'gf_stla_welcome_screen_do_activation_redirect' ) );
		add_action( 'customize_save_after', array( $this, 'gf_stla_action_after_saving' ) );
		$this->all_found_forms_ids = '';
		add_filter( 'gform_pre_render', array( $this, 'gf_stla_show_css_frontend' ) );
		add_action( 'init', array( $this, 'gf_stla_enable_admin_bar' ) );
		add_action( 'admin_notices', array($this, 'check_plugin_dependencies'));
		add_filter( 'gform_toolbar_menu', array($this, 'add_style_layouts_gravity_toolbar'), 10, 2 );
		

		if (  class_exists( 'GFForms' ) ) {
			add_action( 'template_redirect', array( $this, 'gf_stla_preview_template' ) );
			$this->trigger = 'stla-gravity-forms-customizer';

			// only load controls for this plugin
			if ( isset( $_GET[ $this->trigger ] ) ) {

				$this->stla_form_id =sanitize_text_field($_GET['stla_form_id' ]);
				add_filter( 'customize_register', array( $this, 'remove_sections' ), 60 );

				// if ( version_compare( $wp_version, '4.4', '>=' ) ) {
				// 	add_filter( 'customize_loaded_components', array( $this, 'remove_widget_panels' ), 60 );
				// 	add_filter( 'customize_loaded_components', array( $this, 'remove_nav_menus_panels' ), 60 );
				// } else {
				// 	add_filter( 'customize_register', array( $this, 'remove_panels' ), 60 );
				// }

				// add_filter( 'customize_register', array( $this, 'customizer_sections' ), 40 );
				// add_filter( 'customize_register', array( $this, 'customizer_controls' ), 50 );
				add_filter( 'customize_control_active', array( $this, 'control_filter' ), 10, 2 );
				// add our custom query vars to the whitelist
				add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
				//add_action( 'customize_preview_init', array( $this, 'customizer_styles' ) );

				// enqueue customizer js
				//add_action( 'customize_preview_init', array( $this, 'enqueue_customizer_script' ) );

				//add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_customizer_control_script' ) );
				// listen for the query var and load template
				add_action( 'template_redirect', array( $this, 'load_preview_template' ) );
			}

		}
		// else {

		// 	add_action( 'admin_notices', array( $this, 'missing_notice' ) );

		// }
	}

	function gf_stla_enable_admin_bar() {
		$gf_stla_genreal_options = get_option('gf_stla_general_settings') ;
		$is_admin_bar_enabled = isset($gf_stla_genreal_options['admin-bar'])?$gf_stla_genreal_options['admin-bar']:true;
		if (current_user_can( 'manage_options' ) && $is_admin_bar_enabled) {

			add_filter( 'show_admin_bar', '__return_true',999 );
		}
	}
	/* Code removed in version 2.0 */
	/*	function gf_stla_add_css_to_frontend() {
		$force_styles_enabled = get_option( 'gf_stla_general_settings' );

		if ( $force_styles_enabled['force-styles'] == 1 ) {

			//get all gravity forms created by user
			if ( class_exists( 'RGFormsModel' ) ) {
				$forms = RGFormsModel::get_forms( null, 'title' );

				$select_form = array();
				foreach ( $forms as $form ) {
					$style_current_form = get_option( 'gf_stla_form_id_'.$form->id );
					if ( !empty( $style_current_form ) ) {

						$css_form_id = $form->id;
						$main_class_object = $this;
						include 'display/class-styles.php';
					}
				}
			}
		}
		else {
			if ( !empty( $this->all_found_forms_ids ) ) {
				$number_of_forms = count( $this->all_found_forms_ids );
				for ( $i=0; $i<$number_of_forms; $i++ ) {
					$current_selected_form_id = 'gf_stla_form_id_'.$this->all_found_forms_ids[$i];
					$get_style_options = get_option( $current_selected_form_id );
					if ( !empty( $get_style_options ) ) {
						$css_form_id = $this->all_found_forms_ids[$i];
						$main_class_object = $this;
						include 'display/class-styles.php';

					}
				}
			}
		}
		do_action( 'gf_stla_after_post_style_display', $this );
	}*/

	/**
	 *  find all gravity forms in post_content using regex
	 *
	 * @author Sushil Kumar
	 * @since  v1.0 (Removed in version 2.0)
	 * @return [null]
	 */

	// function get_gravity_forms_shortcode() {
	//  global $post;
	//  if ( is_object( $post ) ) {
	//   $found_pos = 0;
	//   $forms_count = substr_count( $post->post_content, 'gravityform id=' );

	//   for ( $i = 0; $i < $forms_count; $i++ ) {

	//    $str_position = strpos( $post->post_content, 'gravityform id="', $found_pos );
	//    $str_position_end = strpos( $post->post_content, ']', $str_position );
	//    $str_length = $str_position_end - $str_position;
	//    $gravity_substr = substr( $post->post_content, $str_position, $str_length );
	//    preg_match_all( "!\d+!", $gravity_substr, $matched );
	//    $this->all_found_forms_ids[$i] = $matched[0][0];
	//    $found_pos = $str_position_end;
	//   }
	//  }
	//}
	/**
	 *  enqueue js file that autosaves the form selection in database
	 *
	 * @author Sushil Kumar
	 * @since  v1.0
	 * @return null
	 */
	function gf_stla_autosave_form() {

		wp_enqueue_script( 'gf_stla_auto_save_form', GF_STLA_URL. '/js/auto-save-form.js', array( 'jquery' ), '', true );

	}

	/**
	 *  shows live preview of css changes
	 *
	 * @author Sushil Kumar
	 * @since  v1.0
	 * @return null
	 */
	function gf_stla_live_preview() {
		$current_form_id = get_option( 'gf_stla_select_form_id' );
		wp_enqueue_script( 'gf_stla_show_live_changes', GF_STLA_URL. '/js/live-preview-changes.js', array( 'jquery', 'customize-preview' ), '', true );
		wp_localize_script( 'gf_stla_show_live_changes', 'gf_stla_localize_current_form', $current_form_id );

	}

	/**
	 *  Function that adds panels, sections, settings and controls
	 *
	 * @author Sushil Kumar
	 * @since  v1.0
	 * @param main    wp customizer object
	 * @return null
	 */

	function gf_stla_customize_register( $wp_customize ) {
		if(isset($this->stla_form_id)){
			update_option('gf_stla_select_form_id', $this->stla_form_id);
		}

		$current_form_id = get_option( 'gf_stla_select_form_id' );
		$border_types = array( "inherit" => "Inherit", "solid" =>"Solid", "dotted"=> "Dotted", "dashed"=> "Dashed", "double"=> "Double", "groove"=> "Groove", "ridge"=> "Ridge", "inset"=> "Inset", "outset"=> "Outset" );
		$align_pos =array( "left" =>"Left", "center" => "Center", "justify" => "Justify", "right" => "Right", );
		$font_collection = array( 'Default'=>'Default', "Roboto"=>"Roboto", "Open Sans"=>"Open Sans", "Lato"=>"Lato", "Slabo 27px"=>"Slabo 27px", "Oswald"=>"Oswald", "Roboto Condensed"=>"Roboto Condensed", "Source Sans Pro"=>"Source Sans Pro", "Montserrat"=>"Montserrat", "Raleway"=>"Raleway", "PT Sans"=>"PT Sans", "Roboto Slab"=>"Roboto Slab", "Merriweather"=>"Merriweather", "Open Sans Condensed"=>"Open Sans Condensed", "Droid Sans"=>"Droid Sans", "Ubuntu"=>"Ubuntu", "Lora"=>"Lora", "Droid Serif"=>"Droid Serif", "Playfair Display"=>"Playfair Display", "Arimo"=>"Arimo", "PT Serif"=>"PT Serif", "Noto Sans"=>"Noto Sans", "Titillium Web"=>"Titillium Web", "PT Sans Narrow"=>"PT Sans Narrow", "Muli"=>"Muli", "Indie Flower"=>"Indie Flower", "Bitter"=>"Bitter", "Poppins"=>"Poppins", "Fjalla One"=>"Fjalla One", "Inconsolata"=>"Inconsolata", "Hind"=>"Hind", "Dosis"=>"Dosis", "Oxygen"=>"Oxygen", "Anton"=>"Anton", "Cabin"=>"Cabin", "Noto Serif"=>"Noto Serif", "Arvo"=>"Arvo", "Lobster"=>"Lobster", "Crimson Text"=>"Crimson Text", "Yanone Kaffeesatz"=>"Yanone Kaffeesatz", "Nunito"=>"Nunito", "Libre Baskerville"=>"Libre Baskerville", "Bree Serif"=>"Bree Serif", "Catamaran"=>"Catamaran", "Josefin Sans"=>"Josefin Sans", "Merriweather Sans"=>"Merriweather Sans", "Abel"=>"Abel", "Exo 2"=>"Exo 2", "Gloria Hallelujah"=>"Gloria Hallelujah", "Abril Fatface"=>"Abril Fatface", "Fira Sans"=>"Fira Sans", "Pacifico"=>"Pacifico", "Varela Round"=>"Varela Round", "Ubuntu Condensed"=>"Ubuntu Condensed", "Roboto Mono"=>"Roboto Mono", "Quicksand"=>"Quicksand", "Karla"=>"Karla", "Asap"=>"Asap", "Amatic SC"=>"Amatic SC", "Rokkitt"=>"Rokkitt", "Signika"=>"Signika", "Rubik"=>"Rubik", "Archivo Narrow"=>"Archivo Narrow", "Play"=>"Play", "Shadows Into Light"=>"Shadows Into Light", "Questrial"=>"Questrial", "Work Sans"=>"Work Sans", "Cuprum"=>"Cuprum", "Dancing Script"=>"Dancing Script", "Francois One"=>"Francois One", "Alegreya"=>"Alegreya", "PT Sans Caption"=>"PT Sans Caption", "Vollkorn"=>"Vollkorn", "Exo"=>"Exo", "Maven Pro"=>"Maven Pro", "Patua One"=>"Patua One", "Orbitron"=>"Orbitron", "Acme"=>"Acme", "Ropa Sans"=>"Ropa Sans", "Source Code Pro"=>"Source Code Pro", "Pathway Gothic One"=>"Pathway Gothic One", "EB Garamond"=>"EB Garamond", "Crete Round"=>"Crete Round", "Cinzel"=>"Cinzel", "Comfortaa"=>"Comfortaa", "Lobster Two"=>"Lobster Two", "Alegreya Sans"=>"Alegreya Sans", "Josefin Slab"=>"Josefin Slab", "News Cycle"=>"News Cycle", "Architects Daughter"=>"Architects Daughter", "Noticia Text"=>"Noticia Text", "Yellowtail"=>"Yellowtail", "Russo One"=>"Russo One", "Poiret One"=>"Poiret One", "Source Serif Pro"=>"Source Serif Pro", "ABeeZee"=>"ABeeZee", "Monda"=>"Monda", "Satisfy"=>"Satisfy", "Quattrocento Sans"=>"Quattrocento Sans", "Hammersmith One"=>"Hammersmith One" );

		$wp_customize->add_panel( 'gf_stla_panel', array(
				'title' => __( 'Styles & Layouts Gravity Forms' ),
				'description' => '<p> Craft your Forms</p>', // Include html tags such as <p>.
				'priority' => 160, // Mixed with top-level-section hierarchy.
			) );

		//hidden field to get form id in jquery
		//var_dump($_GET);

		if ( !array_key_exists( 'autofocus', $_GET ) ) {
			//write_log($_GET);

			$wp_customize->add_setting( 'gf_stla_hidden_field_for_form_id' , array(
					'default'     => $current_form_id,
					'transport'   => 'postMessage',
					'type' => 'option'
				) );

			$wp_customize->add_control( 'gf_stla_hidden_field_for_form_id', array(
					'type' => 'hidden',
					'priority' => 10, // Within the section.
					'section' => 'gf_stla_select_form_section', // Required, core or custom.
					'input_attrs' => array(
						'value' => $current_form_id,
						'id' => 'gf_stla_hidden_field_for_form_id'
					),
				) );
		}
		include 'includes/custom-controls/custom-controls.php';
		include 'includes/form-select.php';
		include 'includes/customizer-addons.php';
		include 'includes/general-settings.php';
		do_action( 'gf_stla_add_theme_section', $wp_customize, $current_form_id );
		include 'includes/form-wrapper.php';
		include 'includes/form-header.php';
		include 'includes/form-title.php';
		include 'includes/form-description.php';
		// //include 'includes/outer-shadow.php';
		// //include 'includes/inner-shadow.php';
		include 'includes/field-labels.php';
		include 'includes/field-sub-labels.php';
		include 'includes/placeholders.php';
		include 'includes/field-descriptions.php';
		include 'includes/text-fields.php';
		include 'includes/dropdown-fields.php';
		include 'includes/radio-inputs.php';
		include 'includes/checkbox-inputs.php';
		include 'includes/paragraph-textarea.php';
		include 'includes/section-break-title.php';
		include 'includes/section-break-description.php';
		include 'includes/list-field.php';
		include 'includes/submit-button.php';
		include 'includes/confirmation-message.php';
		include 'includes/error-message.php';
	} // main customizer function ends here

	function gf_sb_get_saved_styles( $form_id, $category, $important = '') {

		$settings = get_option( 'gf_stla_form_id_'.$form_id );

		if ( empty( $settings ) ) {
			return;
		}

		$input_styles = '';
		if ( isset( $settings[$category]['use-outer-shadows'] ) ) {
			$input_styles.= empty( $settings[$category]['horizontal-offset'] )?'box-shadow: 0px ':'box-shadow:'. $settings[$category]['outer-horizontal-offset'].' ';
			$input_styles.= empty( $settings[$category]['outer-vertical-offset'] )?'0px ': $settings[$category]['outer-vertical-offset'].' ';
			$input_styles.= empty( $settings[$category]['outer-blur-radius'] )?'0px ': $settings[$category]['outer-blur-radius'].' ';
			$input_styles.= empty( $settings[$category]['outer-spread-radius'] )?'0px ': $settings[$category]['outer-spread-radius'].' ';
			$input_styles.= empty( $settings[$category]['outer-shadow-color'] )?';': $settings[$category]['outer-shadow-color'].' ';

			if ( isset( $settings[$category]['use-inner-shadows'] ) ) {
				$input_styles.= empty( $settings[$category]['inner-horizontal-offset'] )?', 0px ':', '. $settings[$category]['inner-horizontal-offset'].' ';
				$input_styles.= empty( $settings[$category]['inner-vertical-offset'] )?'0px ': $settings[$category]['inner-vertical-offset'].' ';
				$input_styles.= empty( $settings[$category]['inner-blur-radius'] )?'0px ': $settings[$category]['inner-blur-radius'].' ';
				$input_styles.= empty( $settings[$category]['inner-spread-radius'] )?'0px ': $settings[$category]['inner-spread-radius'].' ';
				$input_styles.= empty( $settings[$category]['inner-shadow-color'] )?';': $settings[$category]['inner-shadow-color'].' inset; ';
			} else {
				$input_styles.= ';';
			}
		}

		if ( isset(  $settings[$category]['use-outer-shadows'] ) ) {
			$input_styles.= empty( $settings[$category]['outer-horizontal-offset'] )?'-moz-box-shadow: 0px ':'-moz-box-shadow:'. $settings[$category]['outer-horizontal-offset'].' ';
			$input_styles.= empty( $settings[$category]['outer-vertical-offset'] )?'0px ': $settings[$category]['outer-vertical-offset'].' ';
			$input_styles.= empty( $settings[$category]['outer-blur-radius'] )?'0px ': $settings[$category]['outer-blur-radius'].' ';
			$input_styles.= empty( $settings[$category]['outer-spread-radius'] )?'0px ': $settings[$category]['outer-spread-radius'].' ';
			$input_styles.= empty( $settings[$category]['outer-shadow-color'] )?';': $settings[$category]['outer-shadow-color'].' ';

			if ( isset( $settings[$category]['use-inner-shadows'] ) ) {
				$input_styles.= empty( $settings[$category]['inner-horizontal-offset'] )?', 0px ':', '. $settings[$category]['inner-horizontal-offset'].' ';
				$input_styles.= empty( $settings[$category]['inner-vertical-offset'] )?'0px ': $settings[$category]['inner-vertical-offset'].' ';
				$input_styles.= empty( $settings[$category]['inner-blur-radius'] )?'0px ': $settings[$category]['inner-blur-radius'].' ';
				$input_styles.= empty( $settings[$category]['inner-spread-radius'] )?'0px ': $settings[$category]['inner-spread-radius'].' ';
				$input_styles.= empty( $settings[$category]['inner-shadow-color'] )?';': $settings[$category]['inner-shadow-color'].' inset; ';
			}

			else {
				$input_styles.= ';';
			}
		}

		if ( isset( $settings[$category]['use-outer-shadows'] ) ) {
			$input_styles.= empty( $settings[$category]['outer-horizontal-offset'] )?'-webkit-box-shadow: 0px ':'-webkit-box-shadow:'. $settings[$category]['outer-horizontal-offset'].' ';
			$input_styles.= empty( $settings[$category]['outer-vertical-offset'] )?'0px ': $settings[$category]['outer-vertical-offset'].' ';
			$input_styles.= empty( $settings[$category]['outer-blur-radius'] )?'0px ': $settings[$category]['outer-blur-radius'].' ';
			$input_styles.= empty( $settings[$category]['outer-spread-radius'] )?'0px ': $settings[$category]['outer-spread-radius'].' ';
			$input_styles.= empty( $settings[$category]['outer-shadow-color'] )?';': $settings[$category]['outer-shadow-color'].' ';

			if ( isset( $settings[$category]['use-inner-shadows'] ) ) {
				$input_styles.= empty( $settings[$category]['inner-horizontal-offset'] )?', 0px ':', '. $settings[$category]['inner-horizontal-offset'].' ';
				$input_styles.= empty( $settings[$category]['inner-vertical-offset'] )?'0px ': $settings[$category]['inner-vertical-offset'].' ';
				$input_styles.= empty( $settings[$category]['inner-blur-radius'] )?'0px ': $settings[$category]['inner-blur-radius'].' ';
				$input_styles.= empty( $settings[$category]['inner-spread-radius'] )?'0px ': $settings[$category]['inner-spread-radius'].' ';
				$input_styles.= empty( $settings[$category]['inner-shadow-color'] )?';': $settings[$category]['inner-shadow-color'].' inset; ';
			}

			else {
				$input_styles.= ';';
			}
		}

		$input_styles.= empty( $settings[$category]['color'] )?'':'color:'. $settings[$category]['color'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['background-color'] )?'':'background-color:'. $settings[$category]['background-color'].' '.$important.';';
		//Gradient for themes
		$input_styles.= empty( $settings[$category]['background-color1'] )?'':'background:-webkit-linear-gradient(to left,'. $settings[$category]['background-color'].','.$settings[$category]['background-color1'].') '.$important.';';
		$input_styles.= empty( $settings[$category]['background-color1'] )?'':'background:linear-gradient(to left,'. $settings[$category]['background-color'].','.$settings[$category]['background-color1'].') '.$important.';';

		//$input_styles.= empty( $settings[$category]['padding'] )?'':'padding:'. $settings[$category]['padding'].';';
		$input_styles.= empty( $settings[$category]['width'] )?'':'width:'. $settings[$category]['width'].$this->gf_stla_add_px_to_value($settings[$category]['width']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['height'] )?'':'height:'. $settings[$category]['height'].$this->gf_stla_add_px_to_value($settings[$category]['height']).' '.$important.';';

		$input_styles.= empty( $settings[$category]['title-position'] )?'':'text-align:'. $settings[$category]['title-position'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['text-align'] )?'':'text-align:'. $settings[$category]['text-align'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['error-position'] )?'':'text-align:'. $settings[$category]['error-position'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['description-position'] )?'':'text-align:'. $settings[$category]['description-position'].' '.$important.';';

		$input_styles.= empty( $settings[$category]['title-color'] )?'':'color:'. $settings[$category]['title-color'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['font-color'] )?'':'color:'. $settings[$category]['font-color'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['description-color'] )?'':'color:'. $settings[$category]['description-color'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['button-color'] )?'':'background-color:'. $settings[$category]['button-color'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['description-color'] )?'':'color:'. $settings[$category]['description-color'].' '.$important.';';

		$input_styles.= empty( $settings[$category]['font-family'] )?'':'font-family:'. $settings[$category]['font-family'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['font-size'] )?'':'font-size:'. $settings[$category]['font-size'].$this->gf_stla_add_px_to_value($settings[$category]['font-size'] ).' '.$important.';';
		$input_styles.= empty( $settings[$category]['max-width'] )?'':'width:'. $settings[$category]['max-width'].$this->gf_stla_add_px_to_value($settings[$category]['max-width']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['maximum-width'] )?'':'width:'. $settings[$category]['maximum-width'].$this->gf_stla_add_px_to_value($settings[$category]['maximum-width']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['margin'] )?'':'margin:'. $this->gf_stla_add_px_to_padding_margin($settings[$category]['margin']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['padding'] )?'':'padding:'. $this->gf_stla_add_px_to_padding_margin($settings[$category]['padding']).' '.$important.';';

		$input_styles.= empty( $settings[$category]['border-size'] )?'':'border-width:'. $settings[$category]['border-size'].$this->gf_stla_add_px_to_value($settings[$category]['border-size']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['border-color'] )?'':'border-color:'. $settings[$category]['border-color'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['border-type'] )?'':'border-style:'. $settings[$category]['border-type'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['border-bottom'] )?'':'border-bottom-style:'. $settings[$category]['border-bottom'].' '.$important.';';
		$input_styles.= empty( $settings[$category]['border-bottom-size'] )?'':'border-bottom-width:'. $settings[$category]['border-bottom-size'].$this->gf_stla_add_px_to_value($settings[$category]['border-bottom-size']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['border-bottom-color'] )?'':'border-bottom-color:'. $settings[$category]['border-bottom-color'].' '.$important.';';



		$input_styles.= empty( $settings[$category]['background-image-url'] )?'':'background: url('. $settings[$category]['background-image-url'].') no-repeat '.$important.';';
		$input_styles.= empty( $settings[$category]['border-bottom-color'] )?'':'border-bottom-color:'. $settings[$category]['border-bottom-color'].';';
		if (isset($settings[$category]['display'])) {
			$input_styles.=  $settings[$category]['display'] ?'display:none '.$important.';':'display:inherit '.$important.';';
		}
		if ( !empty( $settings[$category]['border-radius'] ) ) {
			$input_styles .= 'border-radius:'.$settings[$category]['border-radius'].$this->gf_stla_add_px_to_value($settings[$category]['border-radius']).' '.$important.';';
			$input_styles .= '-web-border-radius:'.$settings[$category]['border-radius'].$this->gf_stla_add_px_to_value($settings[$category]['border-radius']).' '.$important.';';
			$input_styles .= '-moz-border-radius:'.$settings[$category]['border-radius'].$this->gf_stla_add_px_to_value($settings[$category]['border-radius']).' '.$important.';';
		}
		$input_styles.= empty( $settings[$category]['custom-css'] )?'':$settings[$category]['custom-css'].';';
		return $input_styles;
	}

	function gf_sb_get_saved_styles_tab( $form_id, $category, $important = '') {

		$settings = get_option( 'gf_stla_form_id_'.$form_id );

		if ( empty( $settings ) ) {
			return;
		}

		$input_styles = '';

		$input_styles.= empty( $settings[$category]['width-tab'] )?'':'width:'. $settings[$category]['width-tab'].$this->gf_stla_add_px_to_value($settings[$category]['width-tab']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['max-width-tab'] )?'':'width:'. $settings[$category]['max-width-tab'].$this->gf_stla_add_px_to_value($settings[$category]['max-width-tab']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['maximum-width-tab'] )?'':'width:'. $settings[$category]['maximum-width-tab'].$this->gf_stla_add_px_to_value($settings[$category]['maximum-width-tab']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['height-tab'] )?'':'height:'. $settings[$category]['height-tab'].$this->gf_stla_add_px_to_value($settings[$category]['height-tab']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['font-size-tab'] )?'':'font-size:'. $settings[$category]['font-size-tab'].$this->gf_stla_add_px_to_value($settings[$category]['font-size-tab'] ).' '.$important.';';
		return $input_styles;

	}

	function gf_sb_get_saved_styles_phone( $form_id, $category, $important = '') {

		$settings = get_option( 'gf_stla_form_id_'.$form_id );

		if ( empty( $settings ) ) {
			return;
		}

		$input_styles = '';

		$input_styles.= empty( $settings[$category]['width-phone'] )?'':'width:'. $settings[$category]['width-phone'].$this->gf_stla_add_px_to_value($settings[$category]['width-phone']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['max-width-phone'] )?'':'width:'. $settings[$category]['max-width-phone'].$this->gf_stla_add_px_to_value($settings[$category]['max-width-phone']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['maximum-width-phone'] )?'':'width:'. $settings[$category]['maximum-width-phone'].$this->gf_stla_add_px_to_value($settings[$category]['maximum-width-phone']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['height-phone'] )?'':'height:'. $settings[$category]['height-phone'].$this->gf_stla_add_px_to_value($settings[$category]['height-phone']).' '.$important.';';
		$input_styles.= empty( $settings[$category]['font-size-phone'] )?'':'font-size:'. $settings[$category]['font-size-phone'].$this->gf_stla_add_px_to_value($settings[$category]['font-size-phone'] ).' '.$important.';';
		return $input_styles;
	}

	/**
	 * Function to add px if not available (not for padding and margin)
	 */

	function gf_stla_add_px_to_value($value) {
		$int_parsed = (int) $value;
		if (ctype_digit($value) ) {
			$value = 'px';
		}

		else{
			$value = '';
		}
		return $value;
	}

	/**
	 * Function to add px if not available for padding and margin
	 */

	function gf_stla_add_px_to_padding_margin($value) {
			$margin_padding = explode(' ', $value);
			$new_margin_padding = '';
			foreach($margin_padding as $att_value){
				if (ctype_digit($att_value) ) {
						$new_margin_padding .= $att_value.'px ';
					}

					else{
						$new_margin_padding .= $att_value.' ';
					}

			}
			
			return $new_margin_padding;
		}

	/**
	 * Convert HSL colors into RGBA (used to convert gradient colors), Opacity is fetched from database
	 */
	function hslToRgba($h, $s, $l, $background_opacity){
		$h /=360;
        $r = $l;
        $g = $l;
        $b = $l;
        $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);
        if ($v > 0){
              $m;
              $sv;
              $sextant;
              $fract;
              $vsf;
              $mid1;
              $mid2;

              $m = $l + $l - $v;
              $sv = ($v - $m ) / $v;
              $h *= 6.0;
              $sextant = floor($h);
              $fract = $h - $sextant;
              $vsf = $v * $sv * $fract;
              $mid1 = $m + $vsf;
              $mid2 = $v - $vsf;

              switch ($sextant)
              {
                    case 0:
                          $r = $v;
                          $g = $mid1;
                          $b = $m;
                          break;
                    case 1:
                          $r = $mid2;
                          $g = $v;
                          $b = $m;
                          break;
                    case 2:
                          $r = $m;
                          $g = $v;
                          $b = $mid1;
                          break;
                    case 3:
                          $r = $m;
                          $g = $mid2;
                          $b = $v;
                          break;
                    case 4:
                          $r = $mid1;
                          $g = $m;
                          $b = $v;
                          break;
                    case 5:
                          $r = $v;
                          $g = $m;
                          $b = $mid2;
                          break;
              }
        }
        $rgba = 'rgba('. floor($r * 255).','. floor($g * 255).','.floor($b * 255).','.$background_opacity.')';
        return $rgba;
}

	
/**
 * Convert Hex to rgba
 */

function hex_rgba($hex_code, $background_opacity){
	$r = ''; 
    $g = ''; 
    $b = '';
	list($r, $g, $b) = sscanf($hex_code, "#%02x%02x%02x");
	return  'rgba('.$r.','. $g.','.  $b.','.$background_opacity.')';
}

/**
 * Set Gradient properties for all browsers 
 */
	function set_gradient_properties($gradientColor1, $gradientColor2, $direction){
		switch($direction){
                  case 'left':
                      $gradientDirection = 'right,';
                      $gradientDirectionSafari = 'left,';
                      $gradientDirectionStandard = 'to right,';
                      break;
                   case 'diagonal':
                      $gradientDirection = 'bottom right,';
                      $gradientDirectionSafari = 'left top,';
                      $gradientDirectionStandard = 'to bottom right,'; 
                      break;
                    default:
                      $gradientDirection = '';
                      $gradientDirectionSafari = '';
                      $gradientDirectionStandard = ''; 
                }

		$gradient_css = 'background: linear-gradient('."$gradientDirectionStandard"."$gradientColor1".','. $gradientColor2.');';
		$gradient_css .= 'background: -o-linear-gradient('."$gradientDirection"."$gradientColor1".','. $gradientColor2.');';
		$gradient_css .= 'background: -moz-linear-gradient('."$gradientDirection"."$gradientColor1".','. $gradientColor2.');';
		$gradient_css .= 'background: -webkit-linear-gradient('."$gradientDirectionSafari"."$gradientColor1" .','. $gradientColor2.');';
                // $gradient_css='apple';
		return $gradient_css;
	}
	function gf_stla_welcome_screen_activate() {
		set_transient( 'gf_stla_welcome_activation_redirect', true, 30 );
	}


	function gf_stla_welcome_screen_do_activation_redirect() {
		// Bail if no activation redirect
		if ( ! get_transient( 'gf_stla_welcome_activation_redirect' ) ) {
			return;
		}

		// Delete the redirect transient
		delete_transient( 'gf_stla_welcome_activation_redirect' );

		// Bail if activating from network, or bulk
		if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
			return;
		}

		// Redirect to welcome about page
		wp_safe_redirect( add_query_arg( array( 'page' => 'stla-documentation' ), admin_url( 'admin.php' ) ) );

	}

	function gf_stla_action_after_saving() {

		//get name of style to be deleted

		$style_to_be_deleted = get_option( 'gf_stla_general_settings' );
		if ( $style_to_be_deleted['reset-styles'] != -1 || !empty( $style_to_be_deleted['reset-styles'] ) ) {
			delete_option( 'gf_stla_form_id_'.$style_to_be_deleted['reset-styles'] );
			$style_to_be_deleted['reset-styles'] = -1;
			update_option( 'gf_stla_general_settings', $style_to_be_deleted );

		}

	}

	function gf_stla_show_css_frontend($form){

		//show css in frontend
		$style_current_form = get_option( 'gf_stla_form_id_'.$form['id'] );
		if ( !empty( $style_current_form ) ) {

			$css_form_id = $form['id'];
			$main_class_object = $this;
			include 'display/class-styles.php';
		}
		do_action( 'gf_stla_after_post_style_display', $this );
		return $form;


	}

	function check_plugin_dependencies(){
		if(!class_exists('GFForms')){
			$class = 'notice notice-error';
			$message = '<a href="http://www.gravityforms.com/">Gravity Forms</a> not installed. <strong>Styles & Layouts for Gravity Forms</strong> can\'t work without Gravity Forms ';

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ),  $message  );
		}
	}

	function add_style_layouts_gravity_toolbar($menu_items, $form_id ){

		 $menu_items['styles-layouts-gravity-forms'] = array(
		 'icon' => '<i class="fa fa-paint-brush fa-lg"></i>',	
        'label' => 'Styles & Layouts', // the text to display on the menu for this link
        'title' => 'Styles & Layouts', // the text to be displayed in the title attribute for this link
        'url' => $this->_set_customizer_url($form_id), // the URL this link should point to
        'menu_class' => 'sk-style', // optional, class to apply to menu list item (useful for providing a custom icon)
        'link_class' => rgget( 'page' ) == 'my_custom_page' ? 'gf_toolbar_active' : '*', // class to apply to link (useful for specifying an active style when this link is the current page)
        'capabilities' => array( 'gravityforms_edit_forms' ), // the capabilities the user should possess in order to access this page
        'priority' => 500 // optional, use this to specify the order in which this menu item should appear; if no priority is provided, the menu item will be append to end
    );
    
    return $menu_items;

	}


	/**
	 * Remove any unwanted default conrols.
	 *
	 * @param object  $wp_customize
	 * @since 1.0.0
	 */
	public function remove_sections( $wp_customize ) {
		global $wp_customize;

		$wp_customize->remove_section( 'themes' );

		return true;
	}

	/**
	 * Removes the core 'Widgets' panel from the Customizer.
	 *
	 * @param array   $components Core Customizer components list.
	 * @return array (Maybe) modified components list.
	 */
	public function remove_widget_panels( $components ) {
		$i = array_search( 'widgets', $components );
		if ( false !== $i ) {
			unset( $components[ $i ] );
		}
		return $components;
	}

	/**
	 * Removes the core 'Menus' panel from the Customizer.
	 *
	 * @param array   $components Core Customizer components list.
	 * @return array (Maybe) modified components list.
	 */
	public function remove_nav_menus_panels( $components ) {
		$i = array_search( 'nav_menus', $components );
		if ( false !== $i ) {
			unset( $components[ $i ] );
		}
		return $components;
	}

	/**
	 * Remove any unwanted default panels.
	 *
	 * @param object  $wp_customize
	 * @since 1.1.2
	 */
	public function remove_panels( $wp_customize ) {
		global $wp_customize;

		// note this causes a undefined object notice
		// but I believe this is a WP core issue
		//$wp_customize->remove_panel( 'nav_menus' );

		// because above causes issues, for now use below work around
		$wp_customize->get_panel( 'nav_menus' )->active_callback = '__return_false';
		$wp_customize->remove_panel( 'widgets' );

		return true;
	}

	/**
	 * Add custom variables to the available query vars
	 *
	 * @param mixed   $vars
	 * @return mixed
	 * @since 1.0.0
	 */
	public function add_query_vars( $vars ) {
		$vars[] = $this->trigger;

		return $vars;
	}

	/**
	 * If the right query var is present load the Gravity Forms preview template
	 *
	 * @since 1.0.0
	 */
	public function gf_stla_preview_template( $wp_query ) {

		// load this conditionally based on the query var
		if ( get_query_var( $this->trigger ) ) {

			wp_head();

			ob_start();
			$form_id = sanitize_text_field($_GET['stla_form_id']);

			include( GF_STLA_DIR . '/includes/views/html-template-preview.php' );

			$message = ob_get_clean();


			wp_footer();

			echo $message;
			exit;
		}

		return $wp_query;
	}

	/**
	 * Set the customizer url
	 *
	 * @since 1.0.0
	 */
	private function _set_customizer_url( $form_id ) {


		$url = admin_url( 'customize.php' );

		$url = add_query_arg( 'stla-gravity-forms-customizer', 'true', $url );

		$url = add_query_arg( 'stla_form_id', $form_id, $url );
		$url = add_query_arg( 'autofocus[panel]', 'gf_stla_panel', $url );

		$url = add_query_arg( 'url', wp_nonce_url(  urlencode( add_query_arg( array( 'stla_form_id' => $form_id, 'stla-gravity-forms-customizer' => 'true', 'autofocus[panel]' => 'gf_stla_panel' ), site_url())), 'preview-popup' ), $url );

		$url = add_query_arg( 'return', urlencode( add_query_arg( array( 'page' => 'gf_edit_forms', 'id' => $form_id ), admin_url( 'admin.php' ) ) ), $url );

		$this->customizer_url = esc_url_raw( $url );

		return $this->customizer_url;
	}

		/**
	 * Show only our email settings in the preview
	 *
	 * @since 1.0.0
	 */
	public function control_filter( $active, $control ) {
		

		if ( in_array( $control->section, array('gf_stla_select_form_section' ) ) ) {
		//	write_log($control->section);
		
			return false;
		}

		return true;
	}

	/* 

		function to get styles for Tabs
	*/
	// function gf_sb_get_saved_styles_tab( $form_id, $category ) {


	// 	$settings = get_option( 'gf_stla_form_id_'.$form_id );

	// 	if ( empty( $settings ) ) {
	// 		return;
	// 	}

	// 	$input_styles = '';


	// 	$input_styles.= empty( $settings[$category]['font-size-tab'] )?'':'font-size:'. $settings[$category]['font-size-tab'].$this->gf_stla_add_px_to_value($settings[$category]['font-size-tab'] ).';';
	// 	$input_styles.= empty( $settings[$category]['max-width-tab'] )?'':'width:'. $settings[$category]['max-width-tab'].$this->gf_stla_add_px_to_value($settings[$category]['max-width-tab']).';';
	// 	$input_styles.= empty( $settings[$category]['height-tab'] )?'':'height:'. $settings[$category]['height-tab'].$this->gf_stla_add_px_to_value($settings[$category]['height-tab']).';';
	
	// 	return $input_styles;
	// }

	// 	function gf_sb_get_saved_styles_phone( $form_id, $category ) {


	// 	$settings = get_option( 'gf_stla_form_id_'.$form_id );

	// 	if ( empty( $settings ) ) {
	// 		return;
	// 	}

	// 	$input_styles = '';


	// 	$input_styles.= empty( $settings[$category]['font-size-phone'] )?'':'font-size:'. $settings[$category]['font-size-phone'].$this->gf_stla_add_px_to_value($settings[$category]['font-size-phone'] ).';';
	// 	$input_styles.= empty( $settings[$category]['max-width-phone'] )?'':'width:'. $settings[$category]['max-width-phone'].$this->gf_stla_add_px_to_value($settings[$category]['max-width-phone']).';';
	// 	$input_styles.= empty( $settings[$category]['height-phone'] )?'':'height:'. $settings[$category]['height-phone'].$this->gf_stla_add_px_to_value($settings[$category]['height-phone']).';';
	
	// 	return $input_styles;
	// }

}// class ends here

add_action('plugins_loaded', 'sk_start_styles_layouts');

function sk_start_styles_layouts(){
	new Gravity_customizer_admin();
	
}

