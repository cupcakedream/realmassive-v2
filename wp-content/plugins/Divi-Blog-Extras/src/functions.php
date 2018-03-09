<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! function_exists('el_blog_admin_styles') ) {
	function el_blog_admin_styles(){
	    wp_register_style('el-blog-admin-style', plugins_url('assets/css/elicus-blog-admin.css', dirname(__FILE__)), array(), ELICUS_BLOG_VERSION);
		wp_enqueue_style('el-blog-admin-style');
        wp_enqueue_style( 'wp-color-picker' );
	}
	add_action('admin_enqueue_scripts', 'el_blog_admin_styles');
}

if ( ! function_exists('el_blog_scripts') ) {
	function el_blog_scripts(){
		wp_register_script( 'elicus-blog-js', plugins_url( 'assets/js/elicus-blog.js', dirname(__FILE__) ), array('jquery'), ELICUS_BLOG_VERSION );
		wp_localize_script( 'elicus-blog-js', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php'), 'ajax_nonce' => wp_create_nonce('elicus-blog-nonce') ) );
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'elicus-blog-js' );
	}
	add_action('wp_enqueue_scripts', 'el_blog_scripts');
	add_action('admin_enqueue_scripts', 'el_blog_scripts');
}

if ( ! function_exists('el_blog_styles') ) {
	function el_blog_styles(){
	    $theme    = wp_get_theme();
		$name     = $theme->get('Name');
		$template = $theme->get('Template');
		if (strtolower($name) == 'divi' || strtolower($name) == 'extra' || strtolower($template) == 'divi' || strtolower($template) == 'extra') {
	        wp_register_style( 'elicus-blog-css', plugins_url('assets/css/elicus-blog.css', dirname(__FILE__) ), '', ELICUS_BLOG_VERSION );
	        wp_enqueue_style( 'elicus-blog-css' );
		} else {
		    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		    if (is_plugin_active('divi-builder/divi-builder.php')) {
		        wp_register_style('elicus-blog-builder-style', plugins_url('assets/css/elicus-blog-builder.css', dirname(__FILE__)), '', ELICUS_BLOG_VERSION);
			    wp_enqueue_style('elicus-blog-builder-style');
		    }
		}
	}
	add_action('wp_enqueue_scripts', 'el_blog_styles', 999);
}
/*
// Clears Builder Cache
if ( ! function_exists('el_dbe_clear_builder_cache') ) {
	function el_dbe_clear_builder_cache(){
		wp_register_script('builder-cache', plugins_url('../assets/js/builder-cache.js', __FILE__), true);
		wp_enqueue_script('builder-cache');
	}
	add_action('admin_enqueue_scripts', 'el_dbe_clear_builder_cache');
}
*/
if ( ! function_exists('el_register_taxonomy_meta') ) {
    function el_register_taxonomy_meta() {
        register_meta( 'term', 'el_term_color', '' );
        register_meta( 'term', 'el_term_hover_color', '' );
        register_meta( 'term', 'el_term_bgcolor', '' );
        register_meta( 'term', 'el_term_hover_bgcolor', '' );
    }
    add_action( 'init', 'el_register_taxonomy_meta' );
}

if ( ! function_exists('el_term_color_field') ) {
    function el_term_color_field() {
    
        wp_nonce_field( 'el-term-color-nonce', 'term_color_nonce' );
        
        ?>
        <div class="form-field el-term-color-wrap">
            <label for="el-term-color"><?php _e( 'Category Text Color', 'et_builder' ); ?></label>
            <input type="text" name="el_term_color" id="el-term-color" value="" class="el-term-color-field" data-default-color="" />
        </div>
        <div class="form-field el-term-color-wrap">
            <label for="el-term-hover-color"><?php _e( 'Category Hover Text Color', 'et_builder' ); ?></label>
            <input type="text" name="el_term_hover_color" id="el-term-hover-color" value="" class="el-term-color-field" data-default-color="" />
        </div>
        <div class="form-field el-term-color-wrap">
            <label for="el-term-bgcolor"><?php _e( 'Category Background Color', 'et_builder' ); ?></label>
            <input type="text" name="el_term_bgcolor" id="el-term-bgcolor" value="" class="el-term-color-field" data-default-color="" />
        </div>
        <div class="form-field el-term-color-wrap">
            <label for="el-term-hover-bgcolor"><?php _e( 'Category Hover Background Color', 'et_builder' ); ?></label>
            <input type="text" name="el_term_hover_bgcolor" id="el-term-hover-bgcolor" value="" class="el-term-color-field" data-default-color="" />
        </div>
        
        <?php
    }
    add_action( 'category_add_form_fields', 'el_term_color_field' );
}

if ( ! function_exists('el_edit_term_color_field') ) {
    function el_edit_term_color_field( $term ) {

        $default        = '';
        $color          = get_term_meta( $term->term_id, 'el_term_color', true );
        $hover_color    = get_term_meta( $term->term_id, 'el_term_hover_color', true );
        $bgcolor        = get_term_meta( $term->term_id, 'el_term_bgcolor', true );
        $hover_bgcolor  = get_term_meta( $term->term_id, 'el_term_hover_bgcolor', true );
        
        ?>
        
        <tr class="form-field el-term-color-wrap">
            <th scope="row"><label for="el-term-color"><?php _e( 'Category Text Color', 'et_builder' ); ?></label></th>
            <td>
                <?php wp_nonce_field( 'el-term-color-nonce', 'term_color_nonce' ); ?>
                <input type="text" name="el_term_color" id="el-term-color" value="<?php echo esc_attr( $color ); ?>" class="el-term-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
            </td>
        </tr>
        <tr class="form-field el-term-color-wrap">
            <th scope="row"><label for="el-term-hover-color"><?php _e( 'Category Hover Text Color', 'et_builder' ); ?></label></th>
            <td>
                <?php wp_nonce_field( 'el-term-color-nonce', 'term_color_nonce' ); ?>
                <input type="text" name="el_term_hover_color" id="el-term-hover-color" value="<?php echo esc_attr($hover_color); ?>" class="el-term-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
            </td>
        </tr>
        <tr class="form-field el-term-color-wrap">
            <th scope="row"><label for="el-term-bgcolor"><?php _e( 'Category Background Color', 'et_builder' ); ?></label></th>
            <td>
                <?php wp_nonce_field( 'el-term-color-nonce', 'term_color_nonce' ); ?>
                <input type="text" name="el_term_bgcolor" id="el-term-bgcolor" value="<?php echo esc_attr( $bgcolor ); ?>" class="el-term-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
            </td>
        </tr>
        <tr class="form-field el-term-color-wrap">
            <th scope="row"><label for="el-term-hover-bgcolor"><?php _e( 'Category Hover Background Color', 'et_builder' ); ?></label></th>
            <td>
                <?php wp_nonce_field( 'el-term-color-nonce', 'term_color_nonce' ); ?>
                <input type="text" name="el_term_hover_bgcolor" id="el-term-hover-bgcolor" value="<?php echo esc_attr($hover_bgcolor); ?>" class="el-term-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />
            </td>
        </tr>
        <?php
        
    }
    add_action( 'category_edit_form_fields', 'el_edit_term_color_field' );    
}

if ( ! function_exists('el_save_term_color') ) {
    function el_save_term_color( $term_id ) {
    
        if ( ! isset( $_POST['term_color_nonce'] ) || ! wp_verify_nonce( $_POST['term_color_nonce'], 'el-term-color-nonce' ) )
            return;
        
        $color          = isset( $_POST['el_term_color'] ) ? esc_attr( $_POST['el_term_color'] ) : '';
        $hover_color    = isset( $_POST['el_term_hover_color'] ) ? esc_attr( $_POST['el_term_hover_color'] ) : '';
        $bgcolor        = isset( $_POST['el_term_bgcolor'] ) ? esc_attr( $_POST['el_term_bgcolor'] ) : '';
        $hover_bgcolor  = isset( $_POST['el_term_hover_bgcolor'] ) ? esc_attr( $_POST['el_term_hover_bgcolor'] ) : '';
    
        update_term_meta( $term_id, 'el_term_color', $color );
        update_term_meta( $term_id, 'el_term_hover_color', $hover_color );
        update_term_meta( $term_id, 'el_term_bgcolor', $bgcolor );
        update_term_meta( $term_id, 'el_term_hover_bgcolor', $hover_bgcolor );
        
    }
    add_action( 'edit_category',   'el_save_term_color' );
    add_action( 'create_category', 'el_save_term_color' );
}

if ( ! function_exists('el_edit_term_columns') ) {
    function el_edit_term_columns( $columns ) {
    
        $columns['term_color'] = __( 'Text Color', 'et_builder' );
        $columns['term_hover_color'] = __( 'Hover Text Color', 'et_builder' );
        $columns['term_bgcolor'] = __( 'Background Color', 'et_builder' );
        $columns['term_hover_bgcolor'] = __( 'Hover Background Color', 'et_builder' );
    
        return $columns;
    }
    add_filter( 'manage_edit-category_columns', 'el_edit_term_columns' );
}

if ( ! function_exists('el_manage_term_custom_column') ) {
    function el_manage_term_custom_column( $out, $column, $term_id ) {
    
        if ( 'term_color' === $column ) {
            $color = get_term_meta( $term_id, 'el_term_color', true );
            $out = sprintf( '<span class="color-block" style="display: block; background: %s; height: 25px; border: 1px solid #ddd;"></span>', esc_attr( $color ) );
        }
        
        if ( 'term_hover_color' === $column ) {
            $hover_color = get_term_meta( $term_id, 'el_term_hover_color', true );
            $out = sprintf( '<span class="color-block" style="display: block; background: %s; height: 25px; border: 1px solid #ddd;"></span>', esc_attr( $hover_color ) );
        }
    
        if ( 'term_bgcolor' === $column ) {
            $bgcolor = get_term_meta( $term_id, 'el_term_bgcolor', true );
            $out = sprintf( '<span class="color-block" style="display: block; background: %s; height: 25px; border: 1px solid #ddd;"></span>', esc_attr( $bgcolor ) );
        }
        
        if ( 'term_hover_bgcolor' === $column ) {
            $hover_bgcolor = get_term_meta( $term_id, 'el_term_hover_bgcolor', true );
            $out = sprintf( '<span class="color-block" style="display: block; background: %s; height: 25px; border: 1px solid #ddd;"></span>', esc_attr( $hover_bgcolor ) );
        }
    
        return $out;
    }
    add_filter( 'manage_category_custom_column', 'el_manage_term_custom_column', 10, 3 );
}

if ( ! function_exists('el_blog_custom_module') ) {
    
	function el_blog_custom_module(){
		global $pagenow;
		$is_admin = is_admin();
		$action_hook = $is_admin ? 'et_builder_ready' : 'et_builder_ready';
		$required_admin_pages = array( 'edit.php', 'post.php', 'post-new.php', 'admin.php', 'customize.php', 'edit-tags.php', 'admin-ajax.php', 'export.php' ); // list of admin pages where we need to load builder files
		$specific_filter_pages = array( 'edit.php', 'admin.php', 'edit-tags.php' );
		$is_edit_library_page = 'edit.php' === $pagenow && isset( $_GET['post_type'] ) && 'et_pb_layout' === $_GET['post_type'];
		$is_role_editor_page = 'admin.php' === $pagenow && isset( $_GET['page'] ) && 'et_divi_role_editor' === $_GET['page'];
		$is_import_page = 'admin.php' === $pagenow && isset( $_GET['import'] ) && 'wordpress' === $_GET['import'];
		$is_edit_layout_category_page = 'edit-tags.php' === $pagenow && isset( $_GET['taxonomy'] ) && 'layout_category' === $_GET['taxonomy'];

		if ( ! $is_admin || ( $is_admin && in_array( $pagenow, $required_admin_pages ) && ( ! in_array( $pagenow, $specific_filter_pages ) || $is_edit_library_page || $is_role_editor_page || $is_edit_layout_category_page || $is_import_page ) ) ) {
			add_action( $action_hook, 'el_blog_module', 20 );
		}
	}
	add_action('init', 'el_blog_custom_module');
	
}

if ( ! function_exists('el_blog_module') ) {
	function el_blog_module(){
		if( class_exists("ET_Builder_Module") ){
		    include_once ( ELICUS_BLOG_DIR_PATH. 'src/module/class.blog-module.php' );
		}
	}
}

if ( ! function_exists('set_blog_default_values') ) {
    
    function set_blog_default_values(){
        
        $font_defaults_h1 = array(
			'size'           => '30px',
			'letter_spacing' => '0px',
			'line_height'    => '1em',
		);

		$font_defaults = array(
			'size'           => '14',
			'color'          => '#666666',
			'letter_spacing' => '0px',
			'line_height'    => '1.7em',
		);

		$background_gradient_defaults = array(
			'start'            => '#2b87da',
			'end'              => '#29c4a9',
			'type'             => 'linear',
			'direction'        => '180deg',
			'direction_radial' => 'center',
			'start_position'   => '0%',
			'end_position'     => '100%',
			'overlays_image'   => 'off',
		);

		$background_image_defaults = array(
			'size'     => 'cover',
			'position' => 'center',
			'repeat'   => 'no-repeat',
			'blend'    => 'normal',
		);

		$background_blend_mode_defaults = array(
			'background_blend_mode' => $background_image_defaults['blend'],
		);

		$filter_defaults = array(
			'filter_hue_rotate' => '0deg',
			'filter_saturate'   => '100%',
			'filter_brightness' => '100%',
			'filter_contrast'   => '100%',
			'filter_invert'     => '0%',
			'filter_sepia'      => '0%',
			'filter_opacity'    => '100%',
			'filter_blur'       => '0px',
		);
        
        $blog_defaults = array(
            // Global: Buttons
			'all_buttons_font_size'                                  => '20',
			'all_buttons_border_width'                               => '2',
			'all_buttons_border_radius'                              => '3',
			'all_buttons_spacing'                                    => '0',
			'all_buttons_font_style'                                 => '',
			'all_buttons_border_radius_hover'                        => '3',
			'all_buttons_spacing_hover'                              => '0',
			// Global: Background Gradients
			'all_background_gradient_start'                          => $background_gradient_defaults['start'],
			'all_background_gradient_end'                            => $background_gradient_defaults['end'],
			'all_background_gradient_type'                           => $background_gradient_defaults['type'],
			'all_background_gradient_direction'                      => $background_gradient_defaults['direction'],
			'all_background_gradient_direction_radial'               => $background_gradient_defaults['direction_radial'],
			'all_background_gradient_start_position'                 => $background_gradient_defaults['start_position'],
			'all_background_gradient_end_position'                   => $background_gradient_defaults['end_position'],
			'all_background_gradient_overlays_image'                 => $background_gradient_defaults['overlays_image'],
			// Global: Filters
			'all_filter_hue_rotate'                                  => $filter_defaults['filter_hue_rotate'],
			'all_filter_saturate'                                    => $filter_defaults['filter_saturate'],
			'all_filter_brightness'                                  => $filter_defaults['filter_brightness'],
			'all_filter_contrast'                                    => $filter_defaults['filter_contrast'],
			'all_filter_invert'                                      => $filter_defaults['filter_invert'],
			'all_filter_sepia'                                       => $filter_defaults['filter_sepia'],
			'all_filter_opacity'                                     => $filter_defaults['filter_opacity'],
			'all_filter_blur'                                        => $filter_defaults['filter_blur'],
			// Global: Mix Blend Mode
			'all_mix_blend_mode'                                     => 'normal',
			// Module: Accordion
			'et_pb_accordion-toggle_font_size'                       => '16',
			'et_pb_accordion-toggle_font_style'                      => '',
			'et_pb_accordion-inactive_toggle_font_style'             => '',
			'et_pb_accordion-toggle_icon_size'                       => '16',
			'et_pb_accordion-custom_padding'                         => '20',
			'et_pb_accordion-toggle_line_height'                     => '1em',
			'et_pb_accordion-toggle_letter_spacing'                  => $font_defaults['letter_spacing'],
			'et_pb_accordion-body_font_size'                         => $font_defaults['size'],
			'et_pb_accordion-body_line_height'                       => $font_defaults['line_height'],
			'et_pb_accordion-body_letter_spacing'                    => $font_defaults['letter_spacing'],
			// Module: Audio
			'et_pb_audio-title_font_size'                            => '26',
			'et_pb_audio-title_letter_spacing'                       => $font_defaults['letter_spacing'],
			'et_pb_audio-title_line_height'                          => $font_defaults['line_height'],
			'et_pb_audio-title_font_style'                           => '',
			'et_pb_audio-caption_font_size'                          => $font_defaults['size'],
			'et_pb_audio-caption_letter_spacing'                     => $font_defaults['letter_spacing'],
			'et_pb_audio-caption_line_height'                        => $font_defaults['line_height'],
			'et_pb_audio-caption_font_style'                         => '',
			'et_pb_audio-title_text_color'                           => '#666666',
			'et_pb_audio-background_size'                            => $background_image_defaults['size'],
			'et_pb_audio-background_position'                        => $background_image_defaults['position'],
			'et_pb_audio-background_repeat'                          => $background_image_defaults['repeat'],
			'et_pb_audio-background_blend'                           => $background_image_defaults['blend'],
			// Module: Blog
			'et_pb_blog-header_font_size'                            => '18',
			'et_pb_blog-header_font_style'                           => '',
			'et_pb_blog-meta_font_size'                              => '14',
			'et_pb_blog-meta_font_style'                             => '',
			'et_pb_blog-meta_line_height'                            => $font_defaults['line_height'],
			'et_pb_blog-meta_letter_spacing'                         => $font_defaults['letter_spacing'],
			'et_pb_blog-header_color'                                => '#333333',
			'et_pb_blog-header_line_height'                          => '1em',
			'et_pb_blog-header_letter_spacing'                       => $font_defaults['letter_spacing'],
			'et_pb_blog-body_font_size'                              => $font_defaults['size'],
			'et_pb_blog-body_line_height'                            => $font_defaults['line_height'],
			'et_pb_blog-body_letter_spacing'                         => $font_defaults['letter_spacing'],
			'et_pb_blog_masonry-header_font_size'                    => '26',
			'et_pb_blog_masonry-header_font_style'                   => '',
			'et_pb_blog_masonry-meta_font_size'                      => '14',
			'et_pb_blog_masonry-meta_font_style'                     => '',
			// Module: Blurb
			'et_pb_blurb-header_font_size'                           => '18',
			'et_pb_blurb-header_color'                               => '#333333',
			'et_pb_blurb-header_letter_spacing'                      => $font_defaults['letter_spacing'],
			'et_pb_blurb-header_line_height'                         => '1em',
			'et_pb_blurb-body_font_size'                             => $font_defaults['size'],
			'et_pb_blurb-body_color'                                 => '#666666',
			'et_pb_blurb-body_letter_spacing'                        => $font_defaults['letter_spacing'],
			'et_pb_blurb-body_line_height'                           => $font_defaults['line_height'],
			'et_pb_blurb-text_orientation'                           => 'left',
			'et_pb_blurb-background_size'                            => $background_image_defaults['size'],
			'et_pb_blurb-background_position'                        => $background_image_defaults['position'],
			'et_pb_blurb-background_repeat'                          => $background_image_defaults['repeat'],
			'et_pb_blurb-background_blend'                           => $background_image_defaults['blend'],
			// Module: Circle Counter
			'et_pb_circle_counter-title_font_size'                   => '16',
			'et_pb_circle_counter-title_letter_spacing'              => $font_defaults['letter_spacing'],
			'et_pb_circle_counter-title_line_height'                 => '1em',
			'et_pb_circle_counter-title_font_style'                  => '',
			'et_pb_circle_counter-number_font_size'                  => '46',
			'et_pb_circle_counter-number_font_style'                 => '',
			'et_pb_circle_counter-title_color'                       => '#333333',
			'et_pb_circle_counter-number_line_height'                => '225px',
			'et_pb_circle_counter-number_letter_spacing'             => $font_defaults['letter_spacing'],
			'et_pb_circle_counter-circle_color_alpha'                => '0.1',
			// Module: Contact Form
			'et_pb_contact_form-title_font_size'                     => '26',
			'et_pb_contact_form-title_font_style'                    => '',
			'et_pb_contact_form-form_field_font_size'                => '14',
			'et_pb_contact_form-form_field_font_style'               => '',
			'et_pb_contact_form-captcha_font_size'                   => '14',
			'et_pb_contact_form-captcha_font_style'                  => '',
			'et_pb_contact_form-padding'                             => '16',
			'et_pb_contact_form-title_color'                         => '#333333',
			'et_pb_contact_form-title_line_height'                   => '1em',
			'et_pb_contact_form-title_letter_spacing'                => $font_defaults['letter_spacing'],
			'et_pb_contact_form-form_field_color'                    => '#999999',
			'et_pb_contact_form-form_field_line_height'              => $font_defaults['line_height'],
			'et_pb_contact_form-form_field_letter_spacing'           => $font_defaults['letter_spacing'],
			// Module: Countdown Timer
			'et_pb_countdown_timer-header_font_size'                 => '22',
			'et_pb_countdown_timer-header_font_style'                => '',
			'et_pb_countdown_timer-header_color'                     => '#333333',
			'et_pb_countdown_timer-header_line_height'               => '1em',
			'et_pb_countdown_timer-header_letter_spacing'            => $font_defaults['letter_spacing'],
			'et_pb_countdown_timer-numbers_font_size'                => '54px',
			'et_pb_countdown_timer-numbers_line_height'              => '54px',
			'et_pb_countdown_timer-numbers_letter_spacing'           => $font_defaults['letter_spacing'],
			'et_pb_countdown_timer-label_line_height'                => '25px',
			'et_pb_countdown_timer-label_letter_spacing'             => $font_defaults['letter_spacing'],
			'et_pb_countdown_timer-label_font_size'                  => $font_defaults['size'],
			'et_pb_countdown_timer-background_size'                  => $background_image_defaults['size'],
			'et_pb_countdown_timer-background_position'              => $background_image_defaults['position'],
			'et_pb_countdown_timer-background_repeat'                => $background_image_defaults['repeat'],
			'et_pb_countdown_timer-background_blend'                 => $background_image_defaults['blend'],
			// Module: Bar Counters Item
			'et_pb_counter-background_size'                          => $background_image_defaults['size'],
			'et_pb_counter-background_position'                      => $background_image_defaults['position'],
			'et_pb_counter-background_repeat'                        => $background_image_defaults['repeat'],
			'et_pb_counter-background_blend'                         => $background_image_defaults['blend'],
			// Module: Bar Counters
			'et_pb_counters-title_font_size'                         => '12',
			'et_pb_counters-title_letter_spacing'                    => $font_defaults['letter_spacing'],
			'et_pb_counters-title_line_height'                       => $font_defaults['line_height'],
			'et_pb_counters-title_font_style'                        => '',
			'et_pb_counters-percent_font_size'                       => '12',
			'et_pb_counters-percent_letter_spacing'                  => $font_defaults['letter_spacing'],
			'et_pb_counters-percent_line_height'                     => $font_defaults['line_height'],
			'et_pb_counters-percent_font_style'                      => '',
			'et_pb_counters-border_radius'                           => '0',
			'et_pb_counters-padding'                                 => '0',
			'et_pb_counters-title_color'                             => '#999999',
			'et_pb_counters-percent_color'                           => '#ffffff',
			'et_pb_counters-background_size'                         => $background_image_defaults['size'],
			'et_pb_counters-background_position'                     => $background_image_defaults['position'],
			'et_pb_counters-background_repeat'                       => $background_image_defaults['repeat'],
			'et_pb_counters-background_blend'                        => $background_image_defaults['blend'],
			// Module: CTA
			'et_pb_cta-header_font_size'                             => '26',
			'et_pb_cta-header_font_style'                            => '',
			'et_pb_cta-custom_padding'                               => '40',
			'et_pb_cta-header_text_color'                            => '#333333',
			'et_pb_cta-header_line_height'                           => '1em',
			'et_pb_cta-header_letter_spacing'                        => $font_defaults['letter_spacing'],
			'et_pb_cta-body_font_size'                               => $font_defaults['size'],
			'et_pb_cta-body_line_height'                             => $font_defaults['line_height'],
			'et_pb_cta-body_letter_spacing'                          => $font_defaults['letter_spacing'],
			'et_pb_cta-text_orientation'                             => 'center',
			'et_pb_cta-background_size'                              => $background_image_defaults['size'],
			'et_pb_cta-background_position'                          => $background_image_defaults['position'],
			'et_pb_cta-background_repeat'                            => $background_image_defaults['repeat'],
			'et_pb_cta-background_blend'                             => $background_image_defaults['blend'],
			// Module: Divider
			'et_pb_divider-show_divider'                             => 'off',
			'et_pb_divider-divider_style'                            => 'solid',
			'et_pb_divider-divider_weight'                           => '1',
			'et_pb_divider-height'                                   => '1',
			'et_pb_divider-divider_position'                         => 'top',
			// Module: Filterable Portfolio
			'et_pb_filterable_portfolio-hover_overlay_color'         => 'rgba(255,255,255,0.9)',
			'et_pb_filterable_portfolio-title_font_size'             => '18',
			'et_pb_filterable_portfolio-title_letter_spacing'        => $font_defaults['letter_spacing'],
			'et_pb_filterable_portfolio-title_line_height'           => $font_defaults['line_height'],
			'et_pb_filterable_portfolio-title_font_style'            => '',
			'et_pb_filterable_portfolio-title_color'                 => '#333333',
			'et_pb_filterable_portfolio-caption_font_size'           => '14',
			'et_pb_filterable_portfolio-caption_letter_spacing'      => $font_defaults['letter_spacing'],
			'et_pb_filterable_portfolio-caption_line_height'         => $font_defaults['line_height'],
			'et_pb_filterable_portfolio-caption_font_style'          => '',
			'et_pb_filterable_portfolio-filter_font_size'            => '14',
			'et_pb_filterable_portfolio-filter_letter_spacing'       => $font_defaults['letter_spacing'],
			'et_pb_filterable_portfolio-filter_line_height'          => $font_defaults['line_height'],
			'et_pb_filterable_portfolio-filter_font_style'           => '',
			'et_pb_filterable_portfolio-pagination_font_size'        => '14',
			'et_pb_filterable_portfolio-pagination_letter_spacing'   => $font_defaults['letter_spacing'],
			'et_pb_filterable_portfolio-pagination_line_height'      => $font_defaults['line_height'],
			'et_pb_filterable_portfolio-pagination_font_style'       => '',
			'et_pb_filterable_portfolio-background_size'             => $background_image_defaults['size'],
			'et_pb_filterable_portfolio-background_position'         => $background_image_defaults['position'],
			'et_pb_filterable_portfolio-background_repeat'           => $background_image_defaults['repeat'],
			'et_pb_filterable_portfolio-background_blend'            => $background_image_defaults['blend'],
			// Module: Fullwidth Header
			'et_pb_fullwidth_header-scroll_down_icon_size'           => '50px',
			'et_pb_fullwidth_header-subhead_font_size'               => '18px',
			'et_pb_fullwidth_header-button_one_font_size'            => '20px',
			'et_pb_fullwidth_header-button_one_border_radius'        => '3px',
			'et_pb_fullwidth_header-button_two_font_size'            => '20px',
			'et_pb_fullwidth_header-button_two_border_radius'        => '3px',
			'et_pb_fullwidth_header-background_size'                 => $background_image_defaults['size'],
			'et_pb_fullwidth_header-background_position'             => $background_image_defaults['position'],
			'et_pb_fullwidth_header-background_repeat'               => $background_image_defaults['repeat'],
			'et_pb_fullwidth_header-background_blend'                => $background_image_defaults['blend'],
			// Module: Fullwidth Menu
			'et_pb_fullwidth_menu-background_size'                   => $background_image_defaults['size'],
			'et_pb_fullwidth_menu-background_position'               => $background_image_defaults['position'],
			'et_pb_fullwidth_menu-background_repeat'                 => $background_image_defaults['repeat'],
			'et_pb_fullwidth_menu-background_blend'                  => $background_image_defaults['blend'],
			// Module: Fullwidth Portfolio
			'et_pb_fullwidth_portfolio-background_size'              => $background_image_defaults['size'],
			'et_pb_fullwidth_portfolio-background_position'          => $background_image_defaults['position'],
			'et_pb_fullwidth_portfolio-background_repeat'            => $background_image_defaults['repeat'],
			'et_pb_fullwidth_portfolio-background_blend'             => $background_image_defaults['blend'],
			// Module: Fullwidth Post Title
			'et_pb_fullwidth_post_title-title_font_size'             => '26px',
			'et_pb_fullwidth_post_title-title_line_height'           => '1em',
			'et_pb_fullwidth_post_title-title_letter_spacing'        => $font_defaults['letter_spacing'],
			'et_pb_fullwidth_post_title-meta_font_size'              => $font_defaults['size'],
			'et_pb_fullwidth_post_title-meta_line_height'            => '1em',
			'et_pb_fullwidth_post_title-meta_letter_spacing'         => $font_defaults['letter_spacing'],
			// Module: Fullwidth Slider
			'et_pb_fullwidth_slider-header_font_size'                => '46',
			'et_pb_fullwidth_slider-header_font_style'               => '',
			'et_pb_fullwidth_slider-body_font_size'                  => '16',
			'et_pb_fullwidth_slider-body_font_style'                 => '',
			'et_pb_fullwidth_slider-body_line_height'                => $font_defaults['line_height'],
			'et_pb_fullwidth_slider-body_letter_spacing'             => $font_defaults['letter_spacing'],
			'et_pb_fullwidth_slider-padding'                         => '16',
			'et_pb_fullwidth_slider-header_color'                    => '#ffffff',
			'et_pb_fullwidth_slider-header_line_height'              => '1em',
			'et_pb_fullwidth_slider-header_letter_spacing'           => $font_defaults['letter_spacing'],
			'et_pb_fullwidth_slider-body_color'                      => '#ffffff',
			'et_pb_fullwidth_slider-background_size'                 => $background_image_defaults['size'],
			'et_pb_fullwidth_slider-background_position'             => $background_image_defaults['position'],
			'et_pb_fullwidth_slider-background_repeat'               => $background_image_defaults['repeat'],
			'et_pb_fullwidth_slider-background_blend'                => $background_image_defaults['blend'],
			// Module: Gallery
			'et_pb_gallery-hover_overlay_color'                      => 'rgba(255,255,255,0.9)',
			'et_pb_gallery-title_font_size'                          => '16',
			'et_pb_gallery-title_color'                              => '#333333',
			'et_pb_gallery-title_letter_spacing'                     => $font_defaults['letter_spacing'],
			'et_pb_gallery-title_line_height'                        => '1em',
			'et_pb_gallery-title_font_style'                         => '',
			'et_pb_gallery-caption_font_size'                        => '14',
			'et_pb_gallery-caption_font_style'                       => '',
			'et_pb_gallery-caption_color'                            => '#f3f3f3',
			'et_pb_gallery-caption_line_height'                      => '18px',
			'et_pb_gallery-caption_letter_spacing'                   => $font_defaults['letter_spacing'],
			// Module: Image
			'et_pb_image-animation'                                  => 'left',
			// Module: Login
			'et_pb_login-header_font_size'                           => '26',
			'et_pb_login-header_letter_spacing'                      => $font_defaults['letter_spacing'],
			'et_pb_login-header_line_height'                         => $font_defaults['line_height'],
			'et_pb_login-body_font_size'                             => $font_defaults['size'],
			'et_pb_login-body_letter_spacing'                        => $font_defaults['letter_spacing'],
			'et_pb_login-body_line_height'                           => $font_defaults['line_height'],
			'et_pb_login-header_font_style'                          => '',
			'et_pb_login-custom_padding'                             => '40',
			'et_pb_login-focus_border_color'                         => '#ffffff',
			'et_pb_login-background_size'                            => $background_image_defaults['size'],
			'et_pb_login-background_position'                        => $background_image_defaults['position'],
			'et_pb_login-background_repeat'                          => $background_image_defaults['repeat'],
			'et_pb_login-background_blend'                           => $background_image_defaults['blend'],
			// Module: Number Counter
			'et_pb_number_counter-title_font_size'                   => '16',
			'et_pb_number_counter-title_line_height'                 => '1em',
			'et_pb_number_counter-title_letter_spacing'              => $font_defaults['letter_spacing'],
			'et_pb_number_counter-title_font_style'                  => '',
			'et_pb_number_counter-number_font_size'                  => '72',
			'et_pb_number_counter-number_line_height'                => '72px',
			'et_pb_number_counter-number_letter_spacing'             => $font_defaults['letter_spacing'],
			'et_pb_number_counter-number_font_style'                 => '',
			'et_pb_number_counter-title_color'                       => '#333333',
			'et_pb_number_counter-background_size'                   => $background_image_defaults['size'],
			'et_pb_number_counter-background_position'               => $background_image_defaults['position'],
			'et_pb_number_counter-background_repeat'                 => $background_image_defaults['repeat'],
			'et_pb_number_counter-background_blend'                  => $background_image_defaults['blend'],
			// Module: Portfolio
			'et_pb_portfolio-hover_overlay_color'                    => 'rgba(255,255,255,0.9)',
			'et_pb_portfolio-title_font_size'                        => '18',
			'et_pb_portfolio-title_letter_spacing'                   => $font_defaults['letter_spacing'],
			'et_pb_portfolio-title_line_height'                      => $font_defaults['line_height'],
			'et_pb_portfolio-title_font_style'                       => '',
			'et_pb_portfolio-title_color'                            => '#333333',
			'et_pb_portfolio-caption_font_size'                      => '14',
			'et_pb_portfolio-caption_letter_spacing'                 => $font_defaults['letter_spacing'],
			'et_pb_portfolio-caption_line_height'                    => $font_defaults['line_height'],
			'et_pb_portfolio-caption_font_style'                     => '',
			'et_pb_portfolio-pagination_font_size'                   => '14',
			'et_pb_portfolio-pagination_letter_spacing'              => $font_defaults['letter_spacing'],
			'et_pb_portfolio-pagination_line_height'                 => $font_defaults['line_height'],
			'et_pb_portfolio-pagination_font_style'                  => '',
			'et_pb_portfolio-background_size'                        => $background_image_defaults['size'],
			'et_pb_portfolio-background_position'                    => $background_image_defaults['position'],
			'et_pb_portfolio-background_repeat'                      => $background_image_defaults['repeat'],
			'et_pb_portfolio-background_blend'                       => $background_image_defaults['blend'],
			// Module: Post Title
			'et_pb_post_title-title_font_size'                       => '26px',
			'et_pb_post_title-title_line_height'                     => '1em',
			'et_pb_post_title-title_letter_spacing'                  => $font_defaults['letter_spacing'],
			'et_pb_post_title-meta_font_size'                        => $font_defaults['size'],
			'et_pb_post_title-meta_line_height'                      => '1em',
			'et_pb_post_title-meta_letter_spacing'                   => $font_defaults['letter_spacing'],
			'et_pb_post_title-parallax'                              => 'off',
			'et_pb_post_title-background_size'                       => $background_image_defaults['size'],
			'et_pb_post_title-background_position'                   => $background_image_defaults['position'],
			'et_pb_post_title-background_repeat'                     => $background_image_defaults['repeat'],
			'et_pb_post_title-background_blend'                      => $background_image_defaults['blend'],
			// Module: Post Slider
			'et_pb_post_slider-background_size'                      => $background_image_defaults['size'],
			'et_pb_post_slider-background_position'                  => $background_image_defaults['position'],
			'et_pb_post_slider-background_repeat'                    => $background_image_defaults['repeat'],
			'et_pb_post_slider-background_blend'                     => $background_image_defaults['blend'],
			// Module: Pricing Tables Item (Pricing Table)
			'et_pb_pricing_table-header_font_size'                   => '22px',
			'et_pb_pricing_table-header_color'                       => '#ffffff',
			'et_pb_pricing_table-header_line_height'                 => '1em',
			'et_pb_pricing_table-subheader_font_size'                => '16px',
			'et_pb_pricing_table-subheader_color'                    => '#ffffff',
			'et_pb_pricing_table-price_font_size'                    => '80px',
			'et_pb_pricing_table-price_color'                        => '#2EA3F2',
			'et_pb_pricing_table-price_line_height'                  => '82px',
			'et_pb_pricing_table-body_line_height'                   => '24px',
			'et_pb_pricing_table-background_size'                    => $background_image_defaults['size'],
			'et_pb_pricing_table-background_position'                => $background_image_defaults['position'],
			'et_pb_pricing_table-background_repeat'                  => $background_image_defaults['repeat'],
			'et_pb_pricing_table-background_blend'                   => $background_image_defaults['blend'],
			// Module: Pricing Tables
			'et_pb_pricing_tables-header_font_size'                  => '22',
			'et_pb_pricing_tables-header_font_style'                 => '',
			'et_pb_pricing_tables-subheader_font_size'               => '16',
			'et_pb_pricing_tables-subheader_font_style'              => '',
			'et_pb_pricing_tables-price_font_size'                   => '80',
			'et_pb_pricing_tables-price_font_style'                  => '',
			'et_pb_pricing_tables-header_color'                      => '#ffffff',
			'et_pb_pricing_tables-header_line_height'                => '1em',
			'et_pb_pricing_tables-subheader_color'                   => '#ffffff',
			'et_pb_pricing_tables-currency_frequency_font_size'      => '16px',
			'et_pb_pricing_tables-currency_frequency_letter_spacing' => '0px',
			'et_pb_pricing_tables-currency_frequency_line_height'    => '1.7em',
			'et_pb_pricing_tables-price_letter_spacing'              => '0px',
			'et_pb_pricing_tables-price_color'                       => '#2EA3F2',
			'et_pb_pricing_tables-price_line_height'                 => '82px',
			'et_pb_pricing_tables-body_line_height'                  => '24px',
			'et_pb_pricing_tables-background_size'                   => $background_image_defaults['size'],
			'et_pb_pricing_tables-background_position'               => $background_image_defaults['position'],
			'et_pb_pricing_tables-background_repeat'                 => $background_image_defaults['repeat'],
			'et_pb_pricing_tables-background_blend'                  => $background_image_defaults['blend'],
			// Module: Shop
			'et_pb_shop-title_font_size'                             => '16',
			'et_pb_shop-title_font_style'                            => '',
			'et_pb_shop-sale_badge_font_size'                        => '16',
			'et_pb_shop-sale_badge_font_style'                       => '',
			'et_pb_shop-price_font_size'                             => '14',
			'et_pb_shop-price_font_style'                            => '',
			'et_pb_shop-sale_price_font_size'                        => '14',
			'et_pb_shop-sale_price_font_style'                       => '',
			'et_pb_shop-title_color'                                 => '#333333',
			'et_pb_shop-title_line_height'                           => '1em',
			'et_pb_shop-title_letter_spacing'                        => $font_defaults['letter_spacing'],
			'et_pb_shop-price_line_height'                           => '26px',
			'et_pb_shop-price_letter_spacing'                        => $font_defaults['letter_spacing'],
			// Module: Sidebar
			'et_pb_sidebar-header_font_size'                         => '18',
			'et_pb_sidebar-header_font_style'                        => '',
			'et_pb_sidebar-header_color'                             => '#333333',
			'et_pb_sidebar-header_line_height'                       => '1em',
			'et_pb_sidebar-header_letter_spacing'                    => $font_defaults['letter_spacing'],
			'et_pb_sidebar-remove_border'                            => 'off',
			'et_pb_sidebar-body_font_size'                           => $font_defaults['size'],
			'et_pb_sidebar-body_line_height'                         => $font_defaults['line_height'],
			'et_pb_sidebar-body_letter_spacing'                      => $font_defaults['letter_spacing'],
			// Module: Signup
			'et_pb_signup-header_font_size'                          => '26',
			'et_pb_signup-header_letter_spacing'                     => $font_defaults['letter_spacing'],
			'et_pb_signup-header_line_height'                        => $font_defaults['line_height'],
			'et_pb_signup-body_font_size'                            => $font_defaults['size'],
			'et_pb_signup-body_letter_spacing'                       => $font_defaults['letter_spacing'],
			'et_pb_signup-body_line_height'                          => $font_defaults['line_height'],
			'et_pb_signup-header_font_style'                         => '',
			'et_pb_signup-padding'                                   => '20',
			'et_pb_signup-focus_border_color'                        => '#ffffff',
			'et_pb_signup-background_size'                           => $background_image_defaults['size'],
			'et_pb_signup-background_position'                       => $background_image_defaults['position'],
			'et_pb_signup-background_repeat'                         => $background_image_defaults['repeat'],
			'et_pb_signup-background_blend'                          => $background_image_defaults['blend'],
			// Module: Slider Item (Slide)
			'et_pb_slide-header_font_size'                           => '26px',
			'et_pb_slide-header_color'                               => '#ffffff',
			'et_pb_slide-header_line_height'                         => '1em',
			'et_pb_slide-body_font_size'                             => '16px',
			'et_pb_slide-body_color'                                 => '#ffffff',
			'et_pb_slide-background_size'                            => $background_image_defaults['size'],
			'et_pb_slide-background_position'                        => $background_image_defaults['position'],
			'et_pb_slide-background_repeat'                          => $background_image_defaults['repeat'],
			'et_pb_slide-background_blend'                           => $background_image_defaults['blend'],
			// Module: Slider
			'et_pb_slider-header_font_size'                          => '46',
			'et_pb_slider-header_line_height'                        => '1em',
			'et_pb_slider-header_letter_spacing'                     => $font_defaults['letter_spacing'],
			'et_pb_slider-header_font_style'                         => '',
			'et_pb_slider-body_font_size'                            => '16',
			'et_pb_slider-body_letter_spacing'                       => $font_defaults['letter_spacing'],
			'et_pb_slider-body_line_height'                          => $font_defaults['line_height'],
			'et_pb_slider-body_font_style'                           => '',
			'et_pb_slider-padding'                                   => '16',
			'et_pb_slider-header_color'                              => '#ffffff',
			'et_pb_slider-header_line_height'                        => '1em',
			'et_pb_slider-body_color'                                => '#ffffff',
			'et_pb_slider-background_size'                           => $background_image_defaults['size'],
			'et_pb_slider-background_position'                       => $background_image_defaults['position'],
			'et_pb_slider-background_repeat'                         => $background_image_defaults['repeat'],
			'et_pb_slider-background_blend'                          => $background_image_defaults['blend'],
			// Module: Social Media Follow
			'et_pb_social_media_follow-icon_size'                    => '14',
			'et_pb_social_media_follow-button_font_style'            => '',
			// Module: Tabs
			'et_pb_tabs-tab_font_size'                               => $font_defaults['size'],
			'et_pb_tabs-tab_line_height'                             => $font_defaults['line_height'],
			'et_pb_tabs-tab_letter_spacing'                          => $font_defaults['letter_spacing'],
			'et_pb_tabs-title_font_size'                             => $font_defaults['size'],
			'et_pb_tabs-body_font_size'                              => $font_defaults['size'],
			'et_pb_tabs-body_line_height'                            => $font_defaults['line_height'],
			'et_pb_tabs-body_letter_spacing'                         => $font_defaults['letter_spacing'],
			'et_pb_tabs-title_font_style'                            => '',
			'et_pb_tabs-padding'                                     => '30',
			'et_pb_tabs-background_size'                             => $background_image_defaults['size'],
			'et_pb_tabs-background_position'                         => $background_image_defaults['position'],
			'et_pb_tabs-background_repeat'                           => $background_image_defaults['repeat'],
			'et_pb_tabs-background_blend'                            => $background_image_defaults['blend'],
			// Module: Tabs Item (Tab)
			'et_pb_tab-background_size'                              => $background_image_defaults['size'],
			'et_pb_tab-background_position'                          => $background_image_defaults['position'],
			'et_pb_tab-background_repeat'                            => $background_image_defaults['repeat'],
			'et_pb_tab-background_blend'                             => $background_image_defaults['blend'],
			// Module: Team Member (Person)
			'et_pb_team_member-header_font_size'                     => '18',
			'et_pb_team_member-header_font_style'                    => '',
			'et_pb_team_member-subheader_font_size'                  => '14',
			'et_pb_team_member-subheader_font_style'                 => '',
			'et_pb_team_member-social_network_icon_size'             => '16',
			'et_pb_team_member-header_color'                         => '#333333',
			'et_pb_team_member-header_line_height'                   => '1em',
			'et_pb_team_member-header_letter_spacing'                => $font_defaults['letter_spacing'],
			'et_pb_team_member-body_font_size'                       => $font_defaults['size'],
			'et_pb_team_member-body_line_height'                     => $font_defaults['line_height'],
			'et_pb_team_member-body_letter_spacing'                  => $font_defaults['letter_spacing'],
			'et_pb_team_member-background_size'                      => $background_image_defaults['size'],
			'et_pb_team_member-background_position'                  => $background_image_defaults['position'],
			'et_pb_team_member-background_repeat'                    => $background_image_defaults['repeat'],
			'et_pb_team_member-background_blend'                     => $background_image_defaults['blend'],
			// Module: Testimonial
			'et_pb_testimonial-portrait_border_radius'               => '90',
			'et_pb_testimonial-portrait_width'                       => '90',
			'et_pb_testimonial-portrait_height'                      => '90',
			'et_pb_testimonial-author_name_font_style'               => 'bold',
			'et_pb_testimonial-author_details_font_style'            => 'bold',
			'et_pb_testimonial-border_color'                         => '#ffffff',
			'et_pb_testimonial-border_width'                         => '1px',
			'et_pb_testimonial-body_font_size'                       => $font_defaults['size'],
			'et_pb_testimonial-body_line_height'                     => '1.5em',
			'et_pb_testimonial-body_letter_spacing'                  => $font_defaults['letter_spacing'],
			'et_pb_testimonial-background_size'                      => $background_image_defaults['size'],
			'et_pb_testimonial-background_position'                  => $background_image_defaults['position'],
			'et_pb_testimonial-background_repeat'                    => $background_image_defaults['repeat'],
			'et_pb_testimonial-background_blend'                     => $background_image_defaults['blend'],
			'et_pb_testimonial-quote_icon_background_color'          => '#f5f5f5',
			// Module: Text
			'et_pb_text-header_font_size'                            => $font_defaults_h1['size'],
			'et_pb_text-header_letter_spacing'                       => $font_defaults_h1['letter_spacing'],
			'et_pb_text-header_line_height'                          => $font_defaults_h1['line_height'],
			'et_pb_text-text_font_size'                              => $font_defaults['size'],
			'et_pb_text-text_letter_spacing'                         => $font_defaults['letter_spacing'],
			'et_pb_text-text_line_height'                            => $font_defaults['line_height'],
			'et_pb_text-border_color'                                => '#ffffff',
			'et_pb_text-border_width'                                => '1px',
			'et_pb_text-background_size'                             => $background_image_defaults['size'],
			'et_pb_text-background_position'                         => $background_image_defaults['position'],
			'et_pb_text-background_repeat'                           => $background_image_defaults['repeat'],
			'et_pb_text-background_blend'                            => $background_image_defaults['blend'],
			// Module: Toggle
			'et_pb_toggle-title_font_size'                           => '16',
			'et_pb_toggle-title_letter_spacing'                      => $font_defaults['letter_spacing'],
			'et_pb_toggle-title_font_style'                          => '',
			'et_pb_toggle-inactive_title_font_style'                 => '',
			'et_pb_toggle-toggle_icon_size'                          => '16',
			'et_pb_toggle-title_color'                               => '#333333',
			'et_pb_toggle-title_line_height'                         => '1em',
			'et_pb_toggle-custom_padding'                            => '20',
			'et_pb_toggle-body_font_size'                            => $font_defaults['size'],
			'et_pb_toggle-body_line_height'                          => $font_defaults['line_height'],
			'et_pb_toggle-body_letter_spacing'                       => $font_defaults['letter_spacing'],
			'et_pb_toggle-background_size'                           => $background_image_defaults['size'],
			'et_pb_toggle-background_position'                       => $background_image_defaults['position'],
			'et_pb_toggle-background_repeat'                         => $background_image_defaults['repeat'],
			'et_pb_toggle-background_blend'                          => $background_image_defaults['blend'],
            
            // Module Blog Extras         
            'et_pb_blog_extras-header_font_style'           => '',
            'et_pb_blog_extras-header_font_size'            => '18',
            'et_pb_blog_extras-header_line_height'          => '1.5',
            'et_pb_blog_extras-header_letter_spacing'       => '0',
            'et_pb_blog_extras-header_color'                => '',
            'et_pb_blog_extras-meta_font_style'             => '',
			'et_pb_blog_extras-meta_font_size'              => '14',
			'et_pb_blog_extras-meta_line_height'            => '1.3',
			'et_pb_blog_extras-meta_letter_spacing'         => '0',
			'et_pb_blog_extras-meta_color'                  => '',
			'et_pb_blog_extras-body_font_style'             => '',
			'et_pb_blog_extras-body_font_size'              => '16',
			'et_pb_blog_extras-body_line_height'            => '1.3',
			'et_pb_blog_extras-body_letter_spacing'         => '0',
			'et_pb_blog_extras-body_color'                  => '',
                    );
        
        if ( ! et_is_builder_plugin_active() ) {
			$blog_defaults['et_pb_gallery-zoom_icon_color']              = et_get_option( 'accent_color', '#2ea3f2' );
			$blog_defaults['et_pb_portfolio-zoom_icon_color']            = et_get_option( 'accent_color', '#2ea3f2' );
			$blog_defaults['et_pb_filterable_portfolio-zoom_icon_color'] = et_get_option( 'accent_color', '#2ea3f2' );
		}
        
        foreach ( $blog_defaults as $blog_setting_name => $blog_default_value ) {
        
            $blog_defaults[$blog_setting_name] = array( 'default' => $blog_default_value );
            
            $blog_actual_value = ! et_is_builder_plugin_active() ? et_get_option( $blog_setting_name, $blog_default_value, '', true ) : '';
        	if ( '' !== $blog_actual_value ) {
        		$blog_defaults[ $blog_setting_name ]['actual']  = $blog_actual_value;
        	}
        
        }
         
        return $blog_defaults;
    }
    add_filter( 'et_set_default_values', 'set_blog_default_values' );

}

if ( ! function_exists( 'el_blog_strip_shortcodes' ) ) {
    
    function el_blog_strip_shortcodes( $content, $truncate_post_based_shortcodes_only = false ) {
    	global $shortcode_tags;
    
    	$content = trim( $content );
    
    	$strip_content_shortcodes = array(
    		'et_pb_code',
    		'et_pb_fullwidth_code'
    	);
    
    	// list of post-based shortcodes
    	if ( $truncate_post_based_shortcodes_only ) {
    		$strip_content_shortcodes = array(
    			'et_pb_post_slider',
    			'et_pb_fullwidth_post_slider',
    			'et_pb_blog',
    			'et_pb_comments',
    		);
    	}
    
    	foreach ( $strip_content_shortcodes as $shortcode_name ) {
    		$regex = '(\['.$shortcode_name.'[^\]]*\][^\[]*\[\/'.$shortcode_name.'\]|\['.$shortcode_name.'[^\]]*\])';
    
    		$content = preg_replace( $regex, '', $content );
    	}
    
    	// do not proceed if we need to truncate post-based shortcodes only
    	if ( $truncate_post_based_shortcodes_only ) {
    		return $content;
    	}
    
    	$shortcode_tag_names = array();
    	foreach ( $shortcode_tags as $shortcode_tag_name => $shortcode_tag_cb ) {
    		if ( 0 !== strpos( $shortcode_tag_name, 'et_pb_' ) ) {
    			continue;
    		}
    
    		$shortcode_tag_names[] = $shortcode_tag_name;
    	}
    
    	$et_shortcodes = implode( '|', $shortcode_tag_names );
    
    	$regex_opening_shortcodes = '(\[('.$et_shortcodes.')[^\]]+\])';
    	$regex_closing_shortcodes = '(\[\/('.$et_shortcodes.')\])';
    
    	$content = preg_replace( $regex_opening_shortcodes, '', $content );
    	$content = preg_replace( $regex_closing_shortcodes, '', $content );
    
    	return $content;
    }

}

if ( ! function_exists( 'el_blog_truncate_post' ) ) {

	function el_blog_truncate_post( $amount, $echo = true, $post = '', $strip_shortcodes = false ) {
		global $shortname;

		if ( '' == $post ) global $post;

		$post_excerpt = '';
		$post_excerpt = apply_filters( 'the_excerpt', $post->post_excerpt );

		if ( 'on' == et_get_option( $shortname . '_use_excerpt' ) && '' != $post_excerpt ) {
			if ( $echo ) echo $post_excerpt;
			else return $post_excerpt;
		} else {
			// get the post content
			$truncate = $post->post_content;
            
			// remove caption shortcode from the post content
			$truncate = preg_replace( '@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate );

			// remove post nav shortcode from the post content
			$truncate = preg_replace( '@\[et_pb_post_nav[^\]]*?\].*?\[\/et_pb_post_nav]@si', '', $truncate );

			// Remove audio shortcode from post content to prevent unwanted audio file on the excerpt
			// due to unparsed audio shortcode
			$truncate = preg_replace( '@\[audio[^\]]*?\].*?\[\/audio]@si', '', $truncate );

			// Remove embed shortcode from post content
			$truncate = preg_replace( '@\[embed[^\]]*?\].*?\[\/embed]@si', '', $truncate );

			if ( $strip_shortcodes ) {
				$truncate = el_blog_strip_shortcodes( $truncate );
			} else {
				// apply content filters
				$truncate = apply_filters( 'the_content', $truncate );
			}
            
            
			// decide if we need to append dots at the end of the string
			if ( strlen( $truncate ) <= $amount ) {
				$echo_out = '';
			} else {
				$echo_out = '...';
				$amount = $amount - 3;
			}
                       
			// trim text to a certain number of characters, also remove spaces from the end of a string ( space counts as a character )
			$truncate = rtrim( et_wp_trim_words( $truncate, $amount, '' ) );
            
			// remove the last word to make sure we display all words correctly
			if ( '' != $echo_out ) {
				$new_words_array = (array) explode( ' ', $truncate );
				array_pop( $new_words_array );

				$truncate = implode( ' ', $new_words_array );

				// append dots to the end of the string
				if( '' != $truncate ){
				    $truncate .= $echo_out;
				}
			}

			if ( $echo ) echo $truncate;
			else return $truncate;
		}
	}

}


if ( ! function_exists( 'el_process_font_icon' ) ) {
    function el_process_font_icon( $font_icon, $symbols_function = 'default' ) {
    	// the exact font icon value is saved
    	if ( 1 !== preg_match( "/^%%/", trim( $font_icon ) ) ) {
    		return $font_icon;
    	}
    
    	// the font icon value is saved in the following format: %%index_number%%
    	$icon_index   = (int) str_replace( '%', '', $font_icon );
    	$icon_symbols = 'default' === $symbols_function ? el_get_font_icon_symbols() : call_user_func( $symbols_function );
    	$font_icon    = isset( $icon_symbols[ $icon_index ] ) ? $icon_symbols[ $icon_index ] : '';
    
    	return $font_icon;
    }
}

if ( ! function_exists( 'el_get_font_icon_symbols' ) ){
    function el_get_font_icon_symbols() {
	    $symbols = array( '&amp;#x21;', '&amp;#x22;', '&amp;#x23;', '&amp;#x24;', '&amp;#x25;', '&amp;#x26;', '&amp;#x27;', '&amp;#x28;', '&amp;#x29;', '&amp;#x2a;', '&amp;#x2b;', '&amp;#x2c;', '&amp;#x2d;', '&amp;#x2e;', '&amp;#x2f;', '&amp;#x30;', '&amp;#x31;', '&amp;#x32;', '&amp;#x33;', '&amp;#x34;', '&amp;#x35;', '&amp;#x36;', '&amp;#x37;', '&amp;#x38;', '&amp;#x39;', '&amp;#x3a;', '&amp;#x3b;', '&amp;#x3c;', '&amp;#x3d;', '&amp;#x3e;', '&amp;#x3f;', '&amp;#x40;', '&amp;#x41;', '&amp;#x42;', '&amp;#x43;', '&amp;#x44;', '&amp;#x45;', '&amp;#x46;', '&amp;#x47;', '&amp;#x48;', '&amp;#x49;', '&amp;#x4a;', '&amp;#x4b;', '&amp;#x4c;', '&amp;#x4d;', '&amp;#x4e;', '&amp;#x4f;', '&amp;#x50;', '&amp;#x51;', '&amp;#x52;', '&amp;#x53;', '&amp;#x54;', '&amp;#x55;', '&amp;#x56;', '&amp;#x57;', '&amp;#x58;', '&amp;#x59;', '&amp;#x5a;', '&amp;#x5b;', '&amp;#x5c;', '&amp;#x5d;', '&amp;#x5e;', '&amp;#x5f;', '&amp;#x60;', '&amp;#x61;', '&amp;#x62;', '&amp;#x63;', '&amp;#x64;', '&amp;#x65;', '&amp;#x66;', '&amp;#x67;', '&amp;#x68;', '&amp;#x69;', '&amp;#x6a;', '&amp;#x6b;', '&amp;#x6c;', '&amp;#x6d;', '&amp;#x6e;', '&amp;#x6f;', '&amp;#x70;', '&amp;#x71;', '&amp;#x72;', '&amp;#x73;', '&amp;#x74;', '&amp;#x75;', '&amp;#x76;', '&amp;#x77;', '&amp;#x78;', '&amp;#x79;', '&amp;#x7a;', '&amp;#x7b;', '&amp;#x7c;', '&amp;#x7d;', '&amp;#x7e;', '&amp;#xe000;', '&amp;#xe001;', '&amp;#xe002;', '&amp;#xe003;', '&amp;#xe004;', '&amp;#xe005;', '&amp;#xe006;', '&amp;#xe007;', '&amp;#xe009;', '&amp;#xe00a;', '&amp;#xe00b;', '&amp;#xe00c;', '&amp;#xe00d;', '&amp;#xe00e;', '&amp;#xe00f;', '&amp;#xe010;', '&amp;#xe011;', '&amp;#xe012;', '&amp;#xe013;', '&amp;#xe014;', '&amp;#xe015;', '&amp;#xe016;', '&amp;#xe017;', '&amp;#xe018;', '&amp;#xe019;', '&amp;#xe01a;', '&amp;#xe01b;', '&amp;#xe01c;', '&amp;#xe01d;', '&amp;#xe01e;', '&amp;#xe01f;', '&amp;#xe020;', '&amp;#xe021;', '&amp;#xe022;', '&amp;#xe023;', '&amp;#xe024;', '&amp;#xe025;', '&amp;#xe026;', '&amp;#xe027;', '&amp;#xe028;', '&amp;#xe029;', '&amp;#xe02a;', '&amp;#xe02b;', '&amp;#xe02c;', '&amp;#xe02d;', '&amp;#xe02e;', '&amp;#xe02f;', '&amp;#xe030;', '&amp;#xe103;', '&amp;#xe0ee;', '&amp;#xe0ef;', '&amp;#xe0e8;', '&amp;#xe0ea;', '&amp;#xe101;', '&amp;#xe107;', '&amp;#xe108;', '&amp;#xe102;', '&amp;#xe106;', '&amp;#xe0eb;', '&amp;#xe010;', '&amp;#xe105;', '&amp;#xe0ed;', '&amp;#xe100;', '&amp;#xe104;', '&amp;#xe0e9;', '&amp;#xe109;', '&amp;#xe0ec;', '&amp;#xe0fe;', '&amp;#xe0f6;', '&amp;#xe0fb;', '&amp;#xe0e2;', '&amp;#xe0e3;', '&amp;#xe0f5;', '&amp;#xe0e1;', '&amp;#xe0ff;', '&amp;#xe031;', '&amp;#xe032;', '&amp;#xe033;', '&amp;#xe034;', '&amp;#xe035;', '&amp;#xe036;', '&amp;#xe037;', '&amp;#xe038;', '&amp;#xe039;', '&amp;#xe03a;', '&amp;#xe03b;', '&amp;#xe03c;', '&amp;#xe03d;', '&amp;#xe03e;', '&amp;#xe03f;', '&amp;#xe040;', '&amp;#xe041;', '&amp;#xe042;', '&amp;#xe043;', '&amp;#xe044;', '&amp;#xe045;', '&amp;#xe046;', '&amp;#xe047;', '&amp;#xe048;', '&amp;#xe049;', '&amp;#xe04a;', '&amp;#xe04b;', '&amp;#xe04c;', '&amp;#xe04d;', '&amp;#xe04e;', '&amp;#xe04f;', '&amp;#xe050;', '&amp;#xe051;', '&amp;#xe052;', '&amp;#xe053;', '&amp;#xe054;', '&amp;#xe055;', '&amp;#xe056;', '&amp;#xe057;', '&amp;#xe058;', '&amp;#xe059;', '&amp;#xe05a;', '&amp;#xe05b;', '&amp;#xe05c;', '&amp;#xe05d;', '&amp;#xe05e;', '&amp;#xe05f;', '&amp;#xe060;', '&amp;#xe061;', '&amp;#xe062;', '&amp;#xe063;', '&amp;#xe064;', '&amp;#xe065;', '&amp;#xe066;', '&amp;#xe067;', '&amp;#xe068;', '&amp;#xe069;', '&amp;#xe06a;', '&amp;#xe06b;', '&amp;#xe06c;', '&amp;#xe06d;', '&amp;#xe06e;', '&amp;#xe06f;', '&amp;#xe070;', '&amp;#xe071;', '&amp;#xe072;', '&amp;#xe073;', '&amp;#xe074;', '&amp;#xe075;', '&amp;#xe076;', '&amp;#xe077;', '&amp;#xe078;', '&amp;#xe079;', '&amp;#xe07a;', '&amp;#xe07b;', '&amp;#xe07c;', '&amp;#xe07d;', '&amp;#xe07e;', '&amp;#xe07f;', '&amp;#xe080;', '&amp;#xe081;', '&amp;#xe082;', '&amp;#xe083;', '&amp;#xe084;', '&amp;#xe085;', '&amp;#xe086;', '&amp;#xe087;', '&amp;#xe088;', '&amp;#xe089;', '&amp;#xe08a;', '&amp;#xe08b;', '&amp;#xe08c;', '&amp;#xe08d;', '&amp;#xe08e;', '&amp;#xe08f;', '&amp;#xe090;', '&amp;#xe091;', '&amp;#xe092;', '&amp;#xe0f8;', '&amp;#xe0fa;', '&amp;#xe0e7;', '&amp;#xe0fd;', '&amp;#xe0e4;', '&amp;#xe0e5;', '&amp;#xe0f7;', '&amp;#xe0e0;', '&amp;#xe0fc;', '&amp;#xe0f9;', '&amp;#xe0dd;', '&amp;#xe0f1;', '&amp;#xe0dc;', '&amp;#xe0f3;', '&amp;#xe0d8;', '&amp;#xe0db;', '&amp;#xe0f0;', '&amp;#xe0df;', '&amp;#xe0f2;', '&amp;#xe0f4;', '&amp;#xe0d9;', '&amp;#xe0da;', '&amp;#xe0de;', '&amp;#xe0e6;', '&amp;#xe093;', '&amp;#xe094;', '&amp;#xe095;', '&amp;#xe096;', '&amp;#xe097;', '&amp;#xe098;', '&amp;#xe099;', '&amp;#xe09a;', '&amp;#xe09b;', '&amp;#xe09c;', '&amp;#xe09d;', '&amp;#xe09e;', '&amp;#xe09f;', '&amp;#xe0a0;', '&amp;#xe0a1;', '&amp;#xe0a2;', '&amp;#xe0a3;', '&amp;#xe0a4;', '&amp;#xe0a5;', '&amp;#xe0a6;', '&amp;#xe0a7;', '&amp;#xe0a8;', '&amp;#xe0a9;', '&amp;#xe0aa;', '&amp;#xe0ab;', '&amp;#xe0ac;', '&amp;#xe0ad;', '&amp;#xe0ae;', '&amp;#xe0af;', '&amp;#xe0b0;', '&amp;#xe0b1;', '&amp;#xe0b2;', '&amp;#xe0b3;', '&amp;#xe0b4;', '&amp;#xe0b5;', '&amp;#xe0b6;', '&amp;#xe0b7;', '&amp;#xe0b8;', '&amp;#xe0b9;', '&amp;#xe0ba;', '&amp;#xe0bb;', '&amp;#xe0bc;', '&amp;#xe0bd;', '&amp;#xe0be;', '&amp;#xe0bf;', '&amp;#xe0c0;', '&amp;#xe0c1;', '&amp;#xe0c2;', '&amp;#xe0c3;', '&amp;#xe0c4;', '&amp;#xe0c5;', '&amp;#xe0c6;', '&amp;#xe0c7;', '&amp;#xe0c8;', '&amp;#xe0c9;', '&amp;#xe0ca;', '&amp;#xe0cb;', '&amp;#xe0cc;', '&amp;#xe0cd;', '&amp;#xe0ce;', '&amp;#xe0cf;', '&amp;#xe0d0;', '&amp;#xe0d1;', '&amp;#xe0d2;', '&amp;#xe0d3;', '&amp;#xe0d4;', '&amp;#xe0d5;', '&amp;#xe0d6;', '&amp;#xe0d7;', '&amp;#xe600;', '&amp;#xe601;', '&amp;#xe602;', '&amp;#xe603;', '&amp;#xe604;', '&amp;#xe605;', '&amp;#xe606;', '&amp;#xe607;', '&amp;#xe608;', '&amp;#xe609;', '&amp;#xe60a;', '&amp;#xe60b;', '&amp;#xe60c;', '&amp;#xe60d;', '&amp;#xe60e;', '&amp;#xe60f;', '&amp;#xe610;', '&amp;#xe611;', '&amp;#xe612;', '&amp;#xe008;', );

    	$symbols = apply_filters( 'et_pb_font_icon_symbols', $symbols );

	    return $symbols;
    }
}


if ( ! function_exists('el_blog_load_posts') ) {
    
    function el_blog_load_posts(){
        
        //check_ajax_referer( 'elicus-blog-nonce', 'security', true );
        
        $params = $_POST['parameters'];
        
        $page   = esc_attr( $_POST['page'] );
        $total  = esc_attr( $_POST['total_pages'] );
        
        foreach( $params as $key => $value ){
           ${$key} = $value;
        }
        
        if ( 'on' === $use_overlay ) {
            $data_icon = '' !== $hover_icon
                ? sprintf(
                    ' data-icon="%1$s"',
                    esc_attr( $hover_icon )
                )
                : '';

            $overlay_output = sprintf(
                '<span class="et_overlay%1$s"%2$s></span>',
                ( '' !== $hover_icon ? ' et_pb_inline_icon' : '' ),
                $data_icon
            );
        }
        
        if ( 'on' !== $show_content ) {
            if( $layout == 'classic' ){
                $excerpt_length = ( '' === $excerpt_length ) ? 600 : esc_attr( $excerpt_length );
            }else{
                $excerpt_length = ( '' === $excerpt_length ) ? 270 : esc_attr( $excerpt_length );
            }
        }
        
        if ( 'on' == $show_more ) {
            $read_more_text = ( '' === $read_more_text ) ? 'Read More' : esc_attr( $read_more_text );
        }
        
        if ( 'on' == $show_load_more ) {
            $load_more_text = ( '' === $load_more_text ) ? 'Load More' : esc_attr( $load_more_text );
            $show_less_text = ( '' === $show_less_text ) ? 'Show Less' : esc_attr( $show_less_text );
        }

        $overlay_class = 'on' === $use_overlay ? ' et_pb_has_overlay' : '';

        $args = array( 'posts_per_page' => intval($posts_number) );
        
        $args['post_type'] = 'post';
        
        $args['post_status'] = 'publish';

        if ( '' !== $include_categories ) {
            $args['cat'] = $include_categories;
        }
        
        $args['offset'] =  ( intval( $page ) * intval($posts_number) ) + intval( $offset_number );
        
        $args['order'] =  esc_attr($post_order);

        if ( is_single() && ! isset( $args['post__not_in'] ) ) {
            $args['post__not_in'] = array( get_the_ID() );
        }
        
        $Query = new WP_Query($args);
       
        if ( $Query->have_posts() ) {
            
            $posts = '';
            
            if( $layout == 'block_extended' ){
                $counter = ( intval( $page ) * intval($posts_number) ) + intval( $offset_number ) + 1;
            }else{
                $counter = '';
            }
            
            while ( $Query->have_posts() ) {
                
                $Query->the_post();
                
                global $post;
                $pid        = $post->ID;
                
                $thumb = '';
				$classtext = 'et_pb_post_main_image';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail( '', '', $classtext, $titletext, $titletext, false, 'Blogimage' );
				$thumb = $thumbnail["thumb"];

                $no_thumb_class = '' === $thumb || 'off' === $show_thumbnail ? ' et_pb_no_thumb' : '';
                
                if ( '' !== $thumb && 'on' === $show_thumbnail ) {
                    if( $layout == 'block_extended' ){
                        
                        if( $image_position != 'alternate' ){
                            $image_class = ' image-'.$image_position;
                        } else {
                            if( $counter%2 != 0 ){
                                $image_class = ' image-background';
                            }else{
                                $image_class = ' image-top';
                            }
                        }
                        
                    }else{
                        $image_class = '';
                    }
                }else{
                    $image_class = '';
                }

                $layout_class = ' el_dbe_'.$layout;
                
                if( $animation == 'off' ){
                    $animation = 'bottom';
                }
                
                $animation_class = ' et-waypoint et_pb_animation_'.$animation;
  
                $post_class = implode( " ", get_post_class('et_pb_post et_pb_post_extra et_pb_text_align_left' . $animation_class . $layout_class . $no_thumb_class . $overlay_class . $image_class . ' et-animated'));
                
                $posts .= '<article id="post-'. $pid .'" class="'.$post_class.'" >';

                $posts .= el_blog_ajax_layout($pid,$counter,$layout,$show_categories,$category_meta_colors,$meta_date,$show_content,$read_more_text,$excerpt_length,$show_more,$show_author,$show_date,$show_comments,$thumb,$show_thumbnail,$image_position,$no_thumb_class,$show_social_icons,$use_overlay,$overlay_output);
                        
                $posts .= '</article> <!-- .et_pb_post_extra -->';
                
                if( $layout == 'block_extended' ){
                    $counter++;
                }
               
            } // endwhile

            if ( 'on' === $show_load_more && ! is_search() ) {

                $ajax_pagination_data_icon            = ( 'on' == $ajax_pagination_use_icon && '' !== $ajax_pagination_icon && 'on' === $custom_ajax_pagination) ? sprintf(' data-icon="%1$s"', esc_attr(el_process_font_icon($ajax_pagination_icon))) : '';
	            $ajax_pagination_custom_icon_class    = ( 'on' == $ajax_pagination_use_icon && '' !== $ajax_pagination_icon && 'on' === $custom_ajax_pagination) ? ' et_pb_custom_button_icon' : '';
                $page++;	            
        		if( $page < $total ){
        		    $posts .= '<div class="ajax-pagination"><a'.$ajax_pagination_data_icon.' class="et_pb_button el-button el-load-more et-waypoint et_pb_animation_bottom et-animated'.$ajax_pagination_custom_icon_class.'" data-load="'.$page.'" data-total="'.$total.'">'.$load_more_text.'</a></div>';
        		}else{
        		    $posts .= '<div class="ajax-pagination"><a'.$ajax_pagination_data_icon.' class="et_pb_button el-button el-show-less et-waypoint et_pb_animation_bottom et-animated'.$ajax_pagination_custom_icon_class.'" data-load-more-text="'.$load_more_text.'" data-num="'.esc_attr( $posts_number ).'" data-total="'.$total.'">'.$show_less_text.'</a></div>';
        		}
               
            }

            wp_reset_query();
        }
        
        $output = $posts;
        
        echo $output;
        exit;
    }
    add_action( 'wp_ajax_el_load_posts', 'el_blog_load_posts' );
    add_action( 'wp_ajax_nopriv_el_load_posts', 'el_blog_load_posts' );
    
}

if ( ! function_exists('el_blog_ajax_layout') ) {
    
    function el_blog_ajax_layout($pid,$counter,$layout,$show_categories,$category_meta_colors,$meta_date,$show_content,$read_more_text,$excerpt_length,$show_more,$show_author,$show_date,$show_comments,$thumb,$show_thumbnail,$image_position,$no_thumb_class,$show_social_icons,$use_overlay,$overlay_output){
        if( file_exists( get_stylesheet_directory_uri() . '/divi-blog-extras/ajax-layouts/'.$layout.'.php' ) ) {
            require get_stylesheet_directory_uri() . '/divi-blog-extras/ajax-layouts/'.$layout.'.php';
        }else if( file_exists(ELICUS_BLOG_DIR_PATH .'src/ajax-layouts/'.$layout.'.php') ) {
            require ( ELICUS_BLOG_DIR_PATH .'src/ajax-layouts/'.$layout.'.php' );
        }
        return $html;
    }

}

if ( ! function_exists('el_blog_update') ) {
    function el_blog_update(){
        if( is_admin() ){
            require_once ( ELICUS_BLOG_DIR_PATH. 'src/class.update.php' );
        }
    }
    add_action('wp_loaded', 'el_blog_update');
}

if ( ! function_exists('el_plugin_divi_check') ) {
    function el_plugin_divi_check() {
            
		$theme      = wp_get_theme();
		$name       = $theme->get( 'Name' );
		$template   = $theme->get( 'Template' );
		$version    = $theme->get( 'Version' );
		
		if( strtolower( $name ) == 'divi' || strtolower( $name ) == 'extra' ){
		    
		    if( strtolower( $name ) == 'divi' ) {
			    if ( version_compare( $version, '2.5' ) < 0 ) {
				    deactivate_plugins( ELICUS_BLOG_BASE_NAME );
			    }
		    }else if( strtolower( $name ) == 'extra' ){
		        if ( version_compare( $version, '2.0.70' ) < 0 ) {
		            deactivate_plugins( ELICUS_BLOG_BASE_NAME );
		        }
		    }
			
		}else if( strtolower( $template ) == 'divi' || strtolower( $template ) == 'extra' ){
		    
		    if( strtolower( $template ) == 'divi' ){
    		    $theme      = wp_get_theme('Divi');
    		    $version    = $theme->get( 'Version' );
    		    
    			if ( version_compare( $version, '2.5' ) < 0 ) {
    			    deactivate_plugins( ELICUS_BLOG_BASE_NAME );
    			}
		    }else if( strtolower( $template ) == 'extra' ){
		        $theme      = wp_get_theme('Extra');
    		    $version    = $theme->get( 'Version' );
    		    
    			if ( version_compare( $version, '2.0.70' ) < 0 ) {
    			    deactivate_plugins( ELICUS_BLOG_BASE_NAME );
    			}
		    }
			
		}else if ( ! function_exists( 'is_plugin_active' ) ) {
                require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
                if( ! is_plugin_active('divi-builder/divi-builder.php') ){
		            deactivate_plugins( ELICUS_BLOG_BASE_NAME );
                }
        }else if( ! is_plugin_active('divi-builder/divi-builder.php') ){
		    deactivate_plugins( ELICUS_BLOG_BASE_NAME );
		}
		
	}
	add_action('admin_init', 'el_plugin_divi_check');
}