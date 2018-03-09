<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit('restricted access');
}

delete_option('divi-blog-extras-update-check');
delete_option('divi-blog-extras-latest-version');

