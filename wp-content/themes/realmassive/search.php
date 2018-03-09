<?php get_header(); ?>
<main id="lb-content" class="lco-search" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">

		<header class="lco-post-header">
			<h1><?php the_title(); ?></h1>
			<p class="lco-post-meta">Posted
				<time class="lco-post-time" datetime="<?php echo get_the_time('Y-m-d'); ?>">
					<?php echo get_the_time(get_option('date_format')); ?>
				</time>
				<span class="lco-post-by">by</span>
				<span class="lco-post-author">
						<?php echo get_the_author_link( get_the_author_meta( 'ID' ) ); ?>
				</span>
			</p>
		</header>

		<section class="lco-post-content">
			<?php the_content(); ?>
		</section>

		<footer class="lco-post-footer">
			<p>Filed under <?php echo get_the_category_list(', '); ?></p>
			<?php the_tags( '<p class="tags"><span>Tags:</span>', ', ', '</p>' ); ?>
		</footer> <?php // end article footer ?>

	</article> <?php // end article ?>

	<?php endwhile; ?>

	<?php else : ?>

	<article class="lb-content-error">
		<h1>Error</h1>
		<p>We couldn't find anything. Please check that link and try again.</p>
	</article>

	<?php endif; ?>

</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
