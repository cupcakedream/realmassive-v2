<?php get_header(); ?>

	<main id="lb-content" class="lb-page" role="main">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content(); ?>

		<?php endwhile; else : ?>
			<div class="lb-content-error">
				<h1>Error</h1>
				<p>That page doesn't exist. Check the link and try again.</p>
			</div>

		<?php endif; ?>

	</main>

<?php get_footer(); ?>
