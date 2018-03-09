<?php

class Stla_Material_Design_Update {

	function __construct() {
	//	set_site_transient( 'update_plugins', null );
		add_action( 'stla-license-fields', array( $this, 'add_material_design_license' ) );
		add_filter( 'pre_update_option_stla_licenses' , array( $this, 'check_license' ), 10, 3  );
		add_action( 'admin_init', array( $this, 'check_update' ) );
	}

	/**
	 * Add license setting Field
	 *
	 * @author sushil Kumar
	 * @since  1.0
	 * @param [type]  $license
	 */
	function add_material_design_license( $license ) {

		add_settings_field(
			'material_design_addon_license',
			'Material Design Addon License',
			array( $this, 'material_design_license' ),
			'stla_licenses',
			'stla_licenses_section'

		);

	}

	/**
	 * Show field
	 *
	 * @author Aman Saini
	 * @since  1.0
	 * @return [type]
	 */
	function material_design_license() {

		$settings = get_option( 'stla_licenses' );
		$material_design_addon_license= !empty( $settings['material_design_addon_license'] )?$settings['material_design_addon_license']:'';
		// Render the output
		echo '<input type="text" class="regular-text" id="url" name="stla_licenses[material_design_addon_license]" value="' . $material_design_addon_license. '" />';

		if ( get_option( 'material_design_addon_license_status' )=='valid' ) { ?>
                 <img  style="vertical-align:middle" src="<?php echo GF_STLA_URL.'/css/images/active.png' ?>"> Active
             <?php    }else { ?>
                 <img  style="vertical-align:middle" src="<?php echo GF_STLA_URL.'/css/images/inactive.png' ?>"> Inactive
              <?php
		}

	}

	// Check License

	function check_license( $value, $old_value, $option ) {
		//var_dump($value); die;
		if ( !empty( $value['material_design_addon_license'] ) ) {

			// Activate the license if needed
			// data to send in our API request
			$api_params = array(
				'edd_action'=> 'activate_license',
				'license'  => $value['material_design_addon_license'],
				'item_name' => urlencode( 'Gravity Forms Material Design' )
			);
			// Call the custom API.
			$response = wp_remote_get( add_query_arg( $api_params, GF_STLA_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) )
				return false;

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "active" or "inactive"

			update_option( 'material_design_addon_license_status', $license_data->license );

		}

		return $value;

	}

	function check_update() {

		$settings = get_option( 'stla_licenses' );
		$material_design_addon_license= !empty( $settings['material_design_addon_license'] )?$settings['material_design_addon_license']:'';
		$main_file = WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ).'/styles-layouts-material-design.php';
		if ( !empty( $material_design_addon_license ) ) {
			// setup the updater
			if(class_exists('EDD_SL_Plugin_Updater')){
			$edd_updater = new EDD_SL_Plugin_Updater( GF_STLA_STORE_URL, $main_file, array(
					'version'  => '2.0',
					'license'  => $material_design_addon_license,
					'item_id' => 900,
					// 'item_name' => 'Gravity Forms Material Design',
					'author'  => 'Sushil Kumar'
				)
			);
			// echo 'pre';
			 //var_dump($edd_updater);
		}
	}
	}

}

new Stla_Material_Design_Update();
