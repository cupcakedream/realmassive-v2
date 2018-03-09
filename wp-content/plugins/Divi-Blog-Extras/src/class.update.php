<?php
/**
 * @author    Elicus Technologies <hello@elicus.com>
 * @link      https://www.elicus.com/
 * @copyright 2017 Elicus Technologies Private Limited
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( ! class_exists( 'El_Blog_Update' ) ) {
        
    class El_Blog_Update {
        
        private $plugin_url = 'https://diviextended.com/product/divi-blog-extras';
        private $plugin_update_url = 'https://elicus.com/plugins/dbe/update/update-status.php';
        private $plugin_name = 'Divi Blog Extras';
        private $plugin_slug = 'Divi-Blog-Extras';
        private $plugin_path = 'Divi-Blog-Extras/divi-blog-extras.php';
        private $current_version;
        private $remote_version;
    
        
        public function __construct() {
            $this->current_version = ELICUS_BLOG_VERSION;
            if( $this->check_updates() ) {
                add_filter( 'pre_set_site_transient_update_plugins', array(&$this,'set_update_transient') );
                add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
            }
        }
        
        public function check_info( $results, $action, $args ) {
           if ( isset($args->slug) && $args->slug === $this->plugin_slug  && $action == 'plugin_information' ) {
                $results = $this->get_update_information();
                return $results;
            }
            return $results;
        }
        
        public function set_update_transient($transient) {
            global $wp_version;
    
            if( isset($transient) ) {
                $obj = new stdClass();
                $obj->name = $this->plugin_name;
                $obj->slug = $this->plugin_slug;
                $obj->plugin = $this->plugin_path;
                $obj->new_version = $this->remote_version;
                $obj->url = $this->plugin_url;    
                $response = wp_remote_post($this->plugin_update_url, array(
                            'user-agent' => 'WordPress/'.$wp_version.';'.get_bloginfo('url'),
                            'body'       => array(
                                                'action' => urlencode('path'), 
                                            )
                            ));
                if (!is_wp_error($response) || wp_remote_retrieve_response_code($response) === 200) {
                    $data = wp_remote_retrieve_body( $response );
                    $data = json_decode($data);
                    $obj->package = $data->path;
                }
                $transient->response[$this->plugin_path] = $obj;
            }
            return $transient;
        }
        
        public function get_remote_version() {          
            global $wp_version;
            $force_check = false;
            
            if(isset($_GET['force-check']) && $_GET['force-check'] == '1') {
                $force_check = true;
            }
            
            $last_check = get_option('divi-blog-extras-update-check');
            if($last_check == false){
                $last_check = time();
                update_option('divi-blog-extras-update-check', $last_check);
                $last_check = 0;
            }
                
            if( (time() - $last_check) > 172800 || $force_check == true){
                $response = wp_remote_post($this->plugin_update_url, array(
                            'user-agent' => 'WordPress/'.$wp_version.';'.get_bloginfo('url'),
                            'body'       => array(
                                                'action' => urlencode('version'), 
                                            )
                            ));
                if (!is_wp_error($response) || wp_remote_retrieve_response_code($response) === 200) {
                    $data = wp_remote_retrieve_body( $response );
                    $data = json_decode($data);
                    update_option( 'divi-blog-extras-latest-version' , $data->version );
                }
            }
        }
        
        public function check_updates() {
            $this->get_remote_version(); 
            if( get_option('divi-blog-extras-latest-version') ) {
                $this->remote_version = get_option('divi-blog-extras-latest-version');
                if( version_compare( $this->current_version, $this->remote_version ) < 0 ){
                    return true;
                } else {
                    return false;
                }
            }   
        }
        
        public function get_update_information() {
            global $wp_version;
            $request = wp_remote_post($this->plugin_update_url, array(
                            'user-agent' => 'WordPress/'.$wp_version.';'.get_bloginfo('url'),
                            'body'       => array(
                                                'action' => urlencode('info'), 
                                            )
                        ));
            if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
                return unserialize($request['body']);
            }
            return false;
        }
 
        
    }
    new El_Blog_Update;
    
}

?>