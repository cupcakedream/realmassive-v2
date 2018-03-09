<?php

// Enques Theme Files
add_action( 'wp_enqueue_scripts', 'lco_enqueue_theme_files' );
function lco_enqueue_theme_files() {
    wp_enqueue_style( 'lb-main-css', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'lb-main-js', get_template_directory_uri() . '/library/theme/theme.js', array('jquery'), null, true );
}

// Register Navigation Menus
add_action( 'after_setup_theme', 'lco_register_menus' );
function lco_register_menus() {
  register_nav_menu( 'lb-desktop', 'Desktop' );
  register_nav_menu( 'lb-mobile', 'Mobile' );
}

function footer_widgets_init() {
	register_sidebar( array(
		'name'          => 'Footer',
		'id'            => 'lb_footer',
		'before_widget' => '<div class="et_builder_inner_content et_pb_gutters3">',
		'after_widget'  => '</div>',
	));
	register_sidebar( array(
		'name'          => 'Blog Header',
		'id'            => 'lb_masthead',
		'before_widget' => '<div class="et_builder_inner_content et_pb_gutters3">',
		'after_widget'  => '</div>',
	));
	register_sidebar( array(
		'name'          => 'Blog Sidebar',
		'id'            => 'lb_sidebar',
		'before_widget' => '<div class="lco-sidebar-item">',
		'after_widget'  => '</div>',
	));
}
add_action( 'widgets_init', 'footer_widgets_init' );

add_filter( 'excerpt_more', function ($more) {
    return '';
});

function lb_pagination_bar() {

	global $wp_query;
	$total_pages = $wp_query->max_num_pages;

	if ($total_pages > 1) {

		$current_page = max(1, get_query_var('paged'));

		echo paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => '/page/%#%',
			'current' => $current_page,
			'total' => $total_pages,
		));
	}

}


?>
