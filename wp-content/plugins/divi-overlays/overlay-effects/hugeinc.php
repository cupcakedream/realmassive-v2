<?php
add_action('wp_enqueue_scripts', 'fwds_styles');

function fwds_styles() {
	
	wp_register_style('style1_css', plugins_url('css/style1.css', __FILE__));
    wp_enqueue_style('style1_css');
}
add_action('wp_footer','add_over_content');
function add_over_content(){
	?>
	<div id="trigger-overlay"></div>
	<div class="overlay overlay-hugeinc">
		<button type="button" class="overlay-close">Close</button>
		<?php //echo $post_data->post_content;?>
		<div class="mydata"></div>
	</div>
	
	<?php
}