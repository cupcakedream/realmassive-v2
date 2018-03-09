<?php
/*
Plugin Name: Divi Blog Extras (Modified)
Plugin URI: https://diviextended.com/
Description: Add new blog layout in Divi theme
Author: Elicus Technologies
Version: 99.0.12
Author URI: https://elicus.com
Text Domain: Divi
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'ELICUS_BLOG_VERSION', '2.0.12' );
define( 'ELICUS_BLOG_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ELICUS_BLOG_BASE_NAME', plugin_basename(__FILE__) );

require_once ( ELICUS_BLOG_DIR_PATH. 'src/class.installation.php' );
require_once ( ELICUS_BLOG_DIR_PATH. 'src/class.compatibility.php' );

register_activation_hook( __FILE__, array( 'El_Blog_Compatibility', 'el_plugin_activated' ) );
register_deactivation_hook( __FILE__, array( 'El_Blog_Compatibility', 'el_plugin_deactivated' ) );
add_action( 'after_switch_theme',  array( 'El_Blog_Compatibility', 'el_theme_change' ) );

require_once ( ELICUS_BLOG_DIR_PATH. 'src/functions.php' );
