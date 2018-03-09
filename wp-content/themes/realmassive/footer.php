		<footer class="lb-footer">
			<div class="lb-footer-wrap">
				<?php if ( is_active_sidebar( 'lb_footer' ) ) : ?>
					<div id="et_builder_outer_content" class="et_builder_outer_content">
						<?php dynamic_sidebar( 'lb_footer' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</footer>

	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
