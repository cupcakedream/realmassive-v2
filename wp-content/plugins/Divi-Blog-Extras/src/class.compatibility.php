<?php
/**
 * @author    Elicus Technologies <hello@elicus.com>
 * @link      https://www.elicus.com/
 * @copyright 2017 Elicus Technologies Private Limited
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if( ! class_exists( 'El_Blog_Compatibility' ) ){
    
    class El_Blog_Compatibility {
        
        public static function el_plugin_activated() {
            
            if ( ! self::el_plugin_divi_check() ) {
                deactivate_plugins( plugin_basename( __FILE__ ) );
    			wp_die( __( 'This Plugin requires either of these Divi 2.5 or higher, Extra 2.0.70 or higher, Divi Builder 2.0.33 or higher!', 'Divi' ) );
            }
            
            El_Blog_Installation::init('activated');
            
        } // el_plugin_activated
        
        
        public static function el_plugin_deactivated() {
            
            El_Blog_Installation::init('deactivated');
            
        } // el_plugin_deactivated
        
        
        public static function el_plugin_divi_check() {
            
    		$theme      = wp_get_theme();
    		$name       = $theme->get( 'Name' );
    		$template   = $theme->get( 'Template' );
    		$version    = $theme->get( 'Version' );
    		
    		if( strtolower( $name ) == 'divi' || strtolower( $name ) == 'extra' ){
    		    
    		    if( strtolower( $name ) == 'divi' ) {
    			    if ( version_compare( $version, '2.5' ) >= 0 ) {
    				    return true;
    			    }else{
    				    return false;
    			    }
    		    }else if( strtolower( $name ) == 'extra' ){
    		        if ( version_compare( $version, '2.0.70' ) >= 0 ) {
    				    return true;
    			    }else{
    				    return false;
    			    }
    		    }
    			
    		}else if( strtolower( $template ) == 'divi' || strtolower( $template ) == 'extra' ){
    		    
    		    if( strtolower( $template ) == 'divi' ){
        		    $theme      = wp_get_theme('Divi');
        		    $version    = $theme->get( 'Version' );
        		    
        			if ( version_compare( $version, '2.5' ) >= 0 ) {
        			    return true;
        			}else{
        			    return false;
        			}
    		    }else if( strtolower( $template ) == 'extra' ){
    		        $theme      = wp_get_theme('Extra');
        		    $version    = $theme->get( 'Version' );
        		    
        			if ( version_compare( $version, '2.0.70' ) >= 0 ) {
        			    return true;
        			}else{
        			    return false;
        			}
    		    }
    			
    		}else if ( ! function_exists( 'is_plugin_active' ) ) {
                    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
                    if( is_plugin_active('divi-builder/divi-builder.php') ){
    		            return true;
                    }else{
                        return false;
                    }
            }else if( is_plugin_active('divi-builder/divi-builder.php') ){
    		    return true;
    		}else {
    			return false;
    		}
    		
    	} // el_plugin_divi_check
    	
    	public static function el_theme_change() {
    	
    	    if ( ! self::el_plugin_divi_check() ) {  
    	        add_action( 'admin_init', array( __CLASS__, 'el_plugin_deactivate' ) );      
    	    }
    	  
    	} // el_theme_change
    	
    	
    	public static function el_plugin_deactivate() {
    	    
    	    El_Blog_Installation::init('deactivated');
            deactivate_plugins( ELICUS_BLOG_BASE_NAME );
    	
    	} // el_plugin_deactivate
    	
        
    } // El_Blog_Compatibility
    
}
