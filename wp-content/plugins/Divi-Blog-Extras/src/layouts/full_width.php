<?php
/**
 * The Template for displaying Full Width Layout
 *
 * This template can be overridden by copying it to yourtheme/divi-blog-extras/layouts/full_width.php.
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
 
if( $counter == 1 ){

    if ( '' !== $show_categories ) {
        
        if ( '' !== $category_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%% .et_pb_post_extra .post-categories a',
                'declaration' => sprintf(
                    'color: %1$s;',
                    esc_html( $category_color )
                ),
            ) );
        }
        
        if ( '' !== $category_background ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%% .et_pb_post_extra .post-categories a',
                'declaration' => sprintf(
                    'background-color: %1$s; 
                     padding: 2px 4px;',
                    esc_html( $category_background )
                ),
            ) );
        }
        
        if ( '' !== $category_hover_color ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%% .et_pb_post_extra .post-categories a:hover',
                'declaration' => sprintf(
                    'color: %1$s;',
                    esc_html( $category_hover_color )
                ),
            ) );
        }
        
        if ( '' !== $category_hover_background ) {
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%% .et_pb_post_extra .post-categories a:hover',
                'declaration' => sprintf(
                    'background-color: %1$s;',
                    esc_html( $category_hover_background )
                ),
            ) );
        }
        
        if( 'on' === $category_meta_colors ){
            ET_Builder_Element::set_style( $function_name, array(
                'selector'    => '%%order_class%% .et_pb_post_extra .post-categories a',
                'declaration' => 'padding: 2px 4px;',
            ) );
        }
    
    }
    
}

if ( 'on' === $show_date ){
    $date = explode('-', esc_html( get_the_date( 'M-Y-j', $pid ) ) );
    $month = $date[0];
    $year  = $date[1];
    $day   = $date[2];
    ?>
    <div class='post-date'>
    <?php echo et_get_safe_localization( sprintf( __( '%s', 'et_builder' ), '<span class="published"><em class="month">' .$month  . '</em><em class="year">'.$year.'</em><em class="day">'.$day.'</em></span>' ) ); ?>
    </div>
    <?php
}
?>
<div class="post-content">

    <h2 class="entry-title"><a href="<?php esc_url( the_permalink($pid) ); ?>"><?php echo get_the_title($pid); ?></a></h2><?php
        
    if ( 'on' === $show_author || 'on' === $show_categories || 'on' === $show_comments ) {
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
        printf( '<p class="post-meta">%1$s %2$s %3$s %4$s %5$s</p>',
            (
            'on' === $show_author
                ? et_get_safe_localization( sprintf( __( 'By %s', 'et_builder' ), '<span class="author vcard">' .  et_pb_get_the_author_posts_link() . '</span>' ) )
                : ''
            ),
            (
            ( 'on' === $show_author  && 'on' === $show_categories)
                ? ' | '
                : ''
            ),
            (
            'on' === $show_categories
                ? '<span class="post-categories">'.$category_list.'</span>'
                : ''
            ),
            (
            (( 'on' === $show_author || 'on' === $show_categories ) && 'on' === $show_comments)
                ? ' | '
                : ''
            ),
            (
            'on' === $show_comments
                ? sprintf( esc_html( _nx( '1 Comment', '%s Comments', get_comments_number(), 'number of comments', 'et_builder' ) ), number_format_i18n( get_comments_number() ) )
                : ''
            )
        );
    }
    
    $post_object    = get_post($pid);
    $post_content   = el_blog_strip_shortcodes( $post_object->post_content, true );

    if ( 'on' === $show_content ) {
        global $more;

        // page builder doesn't support more tag, so display the_content() in case of post made with page builder
        if ( et_pb_is_pagebuilder_used( $pid ) ) {
            $more = 1;
            echo '<div class="post-data">'.apply_filters( 'the_content', $post_content ).'</div>';
        } else {
            $more = null;
            echo '<div class="post-data">'.apply_filters( 'the_content', $post_content ).'</div>';
        }
        
    } else {
        
        if ( has_excerpt() ) {
            echo '<div class="post-data">'.el_blog_strip_shortcodes( get_the_excerpt($pid) ).'</div>';
        } else {
            if( $excerpt_length != 0 ){
                echo '<div class="post-data">'.wpautop( strip_shortcodes( el_blog_truncate_post( $excerpt_length, false, $post_object, true ) ) ).'</div>';
            }
        }
        
    }

    if ( 'on' !== $show_content ) {
        $more = 'on' == $show_more ? sprintf( ' <a href="%1$s" class="more-link" >%2$s</a>' , esc_url( get_permalink($pid) ), esc_html__( $read_more_text, 'et_builder' ) )  : '';
        echo $more;
    }
    
    ?>

</div>

<?php

if ( '' !== $thumb && 'on' === $show_thumbnail ) {
    
    $attach_id = function_exists('attachment_url_to_postid') ? attachment_url_to_postid($thumb ) : '';
    if( $attach_id != 0 && $attach_id != '' && $attach_id != '0' ){
        $alttext = get_post_meta( $attach_id, '_wp_attachment_image_alt', true );
    }else{
        $alttext = get_the_title($pid);
    }
    $alttext = '' != $alttext ? $alttext : get_the_title($pid);
    
    ?>
    <div class="post-media" style="background-image: url(<?php echo $thumb; ?>)">
        <a href="<?php esc_url( the_permalink($pid) ); ?>" class="entry-featured-image-url">
            <img src="<?php echo $thumb; ?>" alt="<?php echo $alttext; ?>" />
            <?php if ( 'on' === $use_overlay ) {
                echo $overlay_output;
            } ?>
        </a>
    </div>
    <?php
} 
?>