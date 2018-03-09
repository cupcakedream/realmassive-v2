<?php
/**
 * @author    Elicus Technologies <hello@elicus.com>
 * @link      https://www.elicus.com/
 * @copyright 2017 Elicus Technologies Private Limited
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( ! class_exists( 'El_Blog_Installation' ) ){
    
    class El_Blog_Installation {
        
        private static $path   = 'https://elicus.com/plugins/dbe/install/install-status.php';
        
        public static function init($status){
            
            switch( $status ){
                
                case 'activated': 
                    self::el_plugin_add_active_installs();
                    break;
                    
                case 'deactivated':
                     self::el_plugin_remove_active_installs();
                
                default:
                    break;

            }
            
        } // init
        
        private static function el_plugin_add_active_installs() {
            
            global $wp_version;
            $install_path = self::$path;
            $response = wp_remote_post( $install_path, array(
                            'user-agent' => 'WordPress/'.$wp_version.';'.get_bloginfo('url'),
                            'body'       => array(
            					                'status' => urlencode('active'),
            					                'url' => urlencode(site_url()),
            				                )
                        ));
                        
        } // el_plugin_add_active_installs
        
        
        private static function el_plugin_remove_active_installs() {    
            
            global $wp_version;
            $install_path = self::$path;
            $response = wp_remote_post( $install_path, array(
                            'user-agent' => 'WordPress/'.$wp_version.';'.get_bloginfo('url'),
                            'body'       => array(
            					                'status' => urlencode('inactive'),
            					                'url' => urlencode(site_url()),
            				                )
                        ));
                        
        } // el_plugin_remove_active_installs
        
        
    }

}