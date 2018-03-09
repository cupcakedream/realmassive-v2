<?php
/**
 * The Template for displaying Full Width Background Layout
 *
 * This template can be overridden by copying it to yourtheme/divi-blog-extras/ajax-layouts/full_width_background.php.
 *
 * HOWEVER, on occasion Divi-Blog-Extras will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @author      Elicus Technologies <hello@elicus.com>
 * @link        https://www.elicus.com/
 * @copyright   2017 Elicus Technologies Private Limited
 * @version     2.0.12
 */
 
$html   = '';
if ( '' !== $thumb && 'on' === $show_thumbnail ) {
    $html  .= '<div class="post-media" style="background-image: url('. $thumb .')">';
        $html .= '<a href="'. esc_url( get_the_permalink($pid) ) .'" class="abs-url">'. get_the_title($pid) .'</a>';
        if ( 'on' === $use_overlay ) {
            $html .=  $overlay_output;
        }
} 

$html  .= '<div class="post-content">';
       
    if ( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories || 'on' === $show_comments ) {
        if ( 'on' === $show_categories ) {
            $categories     = get_the_category($pid);
            $category_list  = '';    
            if( 'on' === $category_meta_colors ){
                foreach( $categories as $category ){
                    $color          = get_term_meta( $category->term_id, 'el_term_color', true );
                    $hover_color    = get_term_meta( $category->term_id, 'el_term_hover_color', true );
                    $bgcolor        = get_term_meta( $category->term_id, 'el_term_bgcolor', true );
                    $hover_bgcolor  = get_term_meta( $category->term_id, 'el_term_hover_bgcolor', true );
                    $color_style    = ( '' !== $color )     ? 'color: '.$color.';' : '';
                    $bg_style       = ( '' !== $bgcolor )   ? 'background-color: '.$bgcolor.';' : '';
                    $data_color     = ( '' !== $color )     ? ' data-color="'.$color.'"' : '';
                    $data_hovercolor= ( '' !== $hover_color ) ? ' data-hover-color="'.$hover_color.'"' : '';
                    $data_bg        = ( '' !== $bgcolor )   ? ' data-bgcolor="'.$bgcolor.'"' : '';
                    $data_hoverbg   = ( '' !== $hover_bgcolor ) ? ' data-hover-bgcolor="'.$hover_bgcolor.'"' : '';
                    $custom_style   = ' style="'.$color_style.$bg_style.'"';
                    $category_list .= '<a href="'.get_category_link($category->term_id).'" rel="category tag"'.$data_color.$data_hovercolor.$data_bg.$data_hoverbg.$custom_style.'>'.$category->name.'</a>';
                }
            }else{
                foreach( $categories as $category ){
                    $category_list .= '<a href="'.get_category_link($category->term_id).'" rel="category tag">'.$category->name.'</a>';
                }
            }
        }
        $html .= sprintf( '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s %6$s %7$s</p>',
            (
            'on' === $show_author
                ? et_get_safe_localization( sprintf( __( 'By %s', 'et_builder' ), '<span class="author vcard">' .  get_the_author_posts_link() . '</span>' ) )
                : ''
            ),
            (
            ( 'on' === $show_author && 'on' === $show_date )
                ? '<span class="divider"> | </span>'
                : ''
            ),
            (
    			'on' === $show_date
    				? et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published">' . esc_html( get_the_date( $meta_date, $pid ) ) . '</span>' ) )
    				: ''
    		),
    		(
    			(( 'on' === $show_author || 'on' === $show_date ) && 'on' === $show_categories)
    				? '<span class="divider"> | </span>'
    				: ''
    		),
    		(
    			'on' === $show_categories
    				? '<span class="post-categories">'.$category_list.'</span>'
    				: ''
    		),
    		(
    			(( 'on' === $show_author || 'on' === $show_date || 'on' === $show_categories ) && 'on' === $show_comments)
    				? '<span class="divider"> | </span>'
    				: ''
    		),
    		(
    			'on' === $show_comments
    				? sprintf( esc_html( _nx( '1 Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) )
    				: ''
    		)
        );
    }
    
    $html .= '<h2 class="entry-title"><a href="'. esc_url( get_the_permalink($pid) ) .'">'. get_the_title($pid) .'</a></h2>';
    
    $post_object    = get_post($pid);
    $post_content   = el_blog_strip_shortcodes( $post_object->post_content, true );
    
    if ( 'on' === $show_content ) {
        global $more;
        
        // page builder doesn't support more tag, so display the_content() in case of post made with page builder
        if ( et_pb_is_pagebuilder_used( $pid ) ) {
            $more = 1;
            $html .= '<div class="post-data">'.apply_filters( 'the_content', $post_content ).'</div>';
        } else {
            $more = null;
            $html .= '<div class="post-data">'.apply_filters( 'the_content', $post_content ).'</div>';
        }
        
    } else {
        
        if ( has_excerpt() ) {
            $html .= '<div class="post-data">'.el_blog_strip_shortcodes( get_the_excerpt($pid) ).'</div>';
        } else {
            if( $excerpt_length != 0 ){
                $html .= '<div class="post-data">'.wpautop( strip_shortcodes( el_blog_truncate_post( $excerpt_length, false, $post_object, true ) ) ).'</div>';
            }
        }
        
    }

    if ( 'on' !== $show_content ) {
        $html .= $more = 'on' == $show_more ? sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , esc_url( get_permalink($pid) ), esc_html__( $read_more_text, 'et_builder' ) )  : '';
        
    }
    
$html .= '</div>';

if ( '' !== $thumb && 'on' === $show_thumbnail ) {
    $html .= '</div>';    
} 
?>