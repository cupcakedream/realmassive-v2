<?php

// don't load it if you can't comment
if ( post_password_required() ) {
  return;
}

?>

  <?php if ( have_comments() ) : ?>

    <h3><?php comments_number( __( '<span>No</span> Comments', 'bonestheme' ), __( '<span>One</span> Comment', 'bonestheme' ), __( '<span>%</span> Comments', 'bonestheme' ) );?></h3>

    <section id="lco-comments">
      <?php
        wp_list_comments( array(
          'style'             => 'div',
          'short_ping'        => true,
          'avatar_size'       => 40,
          'callback'          => 'bones_comments',
          'type'              => 'all',
          'reply_text'        => __('Reply', 'bonestheme'),
          'page'              => '',
          'per_page'          => '',
          'reverse_top_level' => null,
          'reverse_children'  => ''
        ) );
      ?>
    </section>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

    	<nav class="lco-comment-nav">
      	<div class="lco-comment-prev"><?php previous_comments_link( '&larr; Previous Comments' ); ?></div>
      	<div class="lco-comment-next"><?php next_comments_link( 'More Comments &rarr;' ); ?></div>
    	</nav>

    <?php endif; ?>

    <?php if ( ! comments_open() ) : ?>

    	<p class="lco-comments-closed">Comments are closed.</p>

    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(); ?>
