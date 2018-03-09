<?php
/* This file contains code from the Software Licensing addon by Easy Digital Downloads - GPLv2.0 or higher */
if (!defined('ABSPATH')) exit;

define( 'DS_PBWID_FILE', realpath(dirname(__FILE__).'/../divi-widget-builder.php') );
define( 'DS_PBWID_STORE_URL', 'https://divi.space/' );
define( 'DS_PBWID_ITEM_NAME', 'Divi Widget Builder' ); // Needs to exactly match the download name in EDD
define( 'DS_PBWID_PLUGIN_PAGE', 'admin.php?page=divi-space-pbwid' );

if( !class_exists( 'DS_PBWID_Plugin_Updater' ) ) {
	// load our custom updater
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

// Load translations
load_plugin_textdomain('aspengrove-updater', false, plugin_basename(dirname(__FILE__).'/lang'));

function DS_PBWID_updater() {

	// retrieve our license key from the DB
	$license_key = trim( get_option( 'DS_PBWID_license_key' ) );

	// setup the updater
	new DS_PBWID_Plugin_Updater( DS_PBWID_STORE_URL, DS_PBWID_FILE, array(
			'version' 	=> DS_PBWID_VERSION, // current version number
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => DS_PBWID_ITEM_NAME, 	// name of this plugin
			'author' 	=> 'Divi Space',  // author of this plugin
			'beta'		=> false
		)
	);

}
add_action( 'admin_init', 'DS_PBWID_updater', 0 );


function DS_PBWID_has_license_key() {
	if (isset($_POST['DS_PBWID_license_key_deactivate'])) {
		require_once(dirname(__FILE__).'/license-key-activation.php');
		DS_PBWID_deactivate_license();
	}
	return (get_option('DS_PBWID_license_status') === 'valid');
}

function DS_PBWID_activate_page() {
	$license = get_option( 'DS_PBWID_license_key' );
	$status  = get_option( 'DS_PBWID_license_status' );
	?>
		<div class="wrap" id="DS_PBWID_license_key_activation_page">
			<form method="post" action="options.php" id="DS_PBWID_license_form">
				<div id="DS_PBWID_license_form_header">
					<a href="https://divi.space/" target="_blank">
						<img src="<?php echo(plugins_url('divi-space-logo.png', __FILE__)); ?>" alt="Divi Space" />
					</a>
				</div>
				
				<div id="DS_PBWID_license_form_body">
					<h3>
						<?php echo(esc_html(DS_PBWID_ITEM_NAME)); ?>
						<small>v<?php echo(DS_PBWID_VERSION); ?></small>
					</h3>
					
					<p>
						Thank you for purchasing <?php echo(htmlspecialchars(DS_PBWID_ITEM_NAME)); ?>!<br />
						Please enter your license key below.
					</p>
					
					<?php settings_fields('DS_PBWID_license'); ?>
					<?php if( false !== $license ) {
						// Need to activate license here, only if submitted
						require_once(dirname(__FILE__).'/license-key-activation.php');
						DS_PBWID_activate_license();
					} ?>
					
					<label>
						<span><?php _e('License Key:', 'aspengrove-updater'); ?></span>
						<input name="DS_PBWID_license_key" type="text" class="regular-text"<?php if (!empty($_GET['license_key'])) { ?> value="<?php echo(esc_attr($_GET['license_key'])); ?>"<?php } else if (!empty($license)) { ?> value="<?php echo(esc_attr($license)); ?>"<?php } ?> />
					</label>
					
					<?php
						if (isset($_GET['sl_activation']) && $_GET['sl_activation'] == 'false') {
							echo('<p id="DS_PBWID_license_form_error">'.(empty($_GET['sl_message']) ? esc_html__('An unknown error has occurred. Please try again.', 'aspengrove-updater') : esc_html($_GET['sl_message'])).'</p>');
						}
						
						submit_button('Continue');
					?>
				</div>
			</form>
		</div>
	<?php
}

function DS_PBWID_license_key_box() {
	$status  = get_option( 'DS_PBWID_license_status' );
	?>
		<div id="DS_PBWID_license_key_box">
			<form method="post" id="DS_PBWID_license_form">
				<div id="DS_PBWID_license_form_header">
					<a href="https://divi.space/" target="_blank">
						<img src="<?php echo(plugins_url('divi-space-logo.png', __FILE__)); ?>" alt="Divi Space" />
					</a>
				</div>
				
				<div id="DS_PBWID_license_form_body">
					<h3>
						<?php echo(esc_html(DS_PBWID_ITEM_NAME)); ?>
						<small>v<?php echo(DS_PBWID_VERSION); ?></small>
					</h3>
					
					<label>
						<span><?php _e('License Key:', 'aspengrove-updater'); ?></span>
						<input type="text" readonly="readonly" value="<?php echo(esc_html(get_option('DS_PBWID_license_key'))); ?>" />
					</label>
					<?php wp_nonce_field( 'DS_PBWID_license_key_deactivate', 'DS_PBWID_license_key_deactivate' ); ?>
					<?php
						if (isset($_GET['sl_activation']) && $_GET['sl_activation'] == 'false') {
							echo('<p id="DS_PBWID_license_form_error">'.(empty($_GET['sl_message']) ? esc_html__('An unknown error has occurred. Please try again.', 'aspengrove-updater') : esc_html($_GET['sl_message'])).'</p>');
						}
						
						submit_button('Deactivate License Key', '');
					?>
				</div>
			</form>
		</div>
	<?php
}

function DS_PBWID_register_option() {
	// creates our settings in the options table
	register_setting('DS_PBWID_license', 'DS_PBWID_license_key', 'DS_PBWID_sanitize_license' );
}
add_action('admin_init', 'DS_PBWID_register_option');

function DS_PBWID_sanitize_license( $new ) {
	$old = get_option( 'DS_PBWID_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'DS_PBWID_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}