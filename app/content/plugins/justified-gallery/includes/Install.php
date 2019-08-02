<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Installation related functions and actions.
 *
 */
class DGWT_JG_Install {

	/**
	 * Hook in tabs.
	 */
	public static function init() {

		add_action( 'admin_init', array( __CLASS__, 'check_version' ), 5 );
	}

	/**
	 * Install
	 */
	public static function install() {


		if ( !defined( 'DGWT_JG_INSTALLING' ) ) {
			define( 'DGWT_JG_INSTALLING', true );
		}

		self::save_activation_date();

		self::create_options();

		// Migrate to v1.2.1
		self::migrate121();

		// Update plugin version
		update_option( 'dgwt_jg_version', DGWT_JG_VERSION );


	}

	/**
	 * Save activation timestamp
	 * Used to display notice, asking for a feedback
	 *
	 * @return null
	 */
	private static function save_activation_date() {

		$date = get_option( 'dgwt_jg_activation_date' );

		if ( empty( $date ) ) {
			update_option( 'dgwt_jg_activation_date', time() );
		}

	}

	/**
	 * Default options
	 */
	private static function create_options() {

		global $dgwt_jg_settings;

		$sections = DGWT_JG()->settings->settings_fields();

		$settings = array();

		if ( is_array( $sections ) && !empty( $sections ) ) {
			foreach ( $sections as $options ) {

				if ( is_array( $options ) && !empty( $options ) ) {

					foreach ( $options as $option ) {

						if ( isset( $option[ 'name' ] ) && !isset( $dgwt_jg_settings[ $option[ 'name' ] ] ) ) {

							$settings[ $option[ 'name' ] ] = isset( $option[ 'default' ] ) ? $option[ 'default' ] : '';
						}
					}
				}
			}
		}

		$update_options = array_merge( $settings, $dgwt_jg_settings );

		update_option( DGWT_JG_SETTINGS_KEY, $update_options );
	}


	/**
	 * Check version
	 */
	public static function check_version() {

		if ( !defined( 'IFRAME_REQUEST' ) ) {

			if ( get_option( 'dgwt_jg_version' ) != DGWT_JG_VERSION ) {
				self::install();
			}
		}
	}

	/**
	 * Migrate to version 1.2.1
	 *
	 * @return null
	 */
	private static function migrate121(){

		if(DGWT_JG()->settings->get_opt( 'lightbox' ) === 'yes'){

			DGWT_JG()->settings->update_option( 'lightbox', 'photoswipe' );

		}

	}

}


DGWT_JG_Install::init();
