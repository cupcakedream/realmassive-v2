<?php get_header(); ?>
<main id="lb-content" class="archive" role="main">
	<?php if ( is_active_sidebar( 'lb_masthead' ) ) : ?>
		<div id="et_builder_outer_content" class="lb-masthead et_builder_outer_content">
			<?php dynamic_sidebar( 'lb_masthead' ); ?>
		</div>
	<?php endif; ?>
	<div class="wrap padding">
	<div class="lb-posts">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

			<header class="lb-post-header">
				<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail() ?></a>
				<p class="post-date"><?php echo get_the_time(get_option('date_format')); ?></p>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="lb-post-meta"><span class="lb-post-author">
						<?php echo the_author_posts_link(); ?>
					</span> | <span class="lb-post-cats">
						<?php echo get_the_category_list(', '); ?>
				</span></p>
			</header>

			<section class="lb-post-content">
				<?php the_excerpt(); ?>
				<a class="read-more button" href="<?php the_permalink() ?>">
					Read More</a>
			</section>

		</article>
	<?php endwhile; ?>
	<div id="lb-pagination">
		<?php lb_pagination_bar() ?>
	</div>
	</div>
	<?php get_sidebar(); ?>
	</div>
	<?php else : ?>

	<article class="lb-content-error">
		<h1>Error</h1>
		<p>We couldn't find that page. Please check that link and try again.</p>
	</article>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
