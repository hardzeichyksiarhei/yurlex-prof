<?php

/**
 * Plugin Name: Justified Gallery
 * Plugin URI: https://wordpress.org/plugins/justified-gallery
 * Description: Display native WordPress galleries in a responsive justified image grid and a pretty Lightbox.
 * Version: 1.3.1
 * Author: Damian Góra
 * Author URI: http://damiangora.com
 * Text Domain: justified-gallery
 *
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'dgwt_freemius' ) ) {


	$fspath = dirname( __FILE__ ) . '/includes/fs/config.php';
	if ( file_exists( $fspath ) ) {
		require_once $fspath;
	}

	if ( ! class_exists( 'DGWT_JG_Core' ) ) {

		final class DGWT_JG_Core {

			private static $instance;
			private $tnow;
			public $detector;
			public $settings;
			public $gallery;
			public $lightbox;
			public $tilesStyle;

			public static function get_instance() {
				if ( ! isset( self::$instance ) && ! ( self::$instance instanceof DGWT_JG_Core ) ) {
					self::$instance = new DGWT_JG_Core;
					self::$instance->constants();

					if ( ! self::$instance->check_requirements() ) {
						return;
					}

					self::$instance->includes();
					self::$instance->hooks();

					self::$instance->detector   = new DGWT_JG_MobileDetect;
					self::$instance->settings   = new DGWT_JG_Settings;
					self::$instance->gallery    = new DGWT_JG_Gallery;
					self::$instance->lightbox   = new DGWT_JG_Lightbox_Loader;
					self::$instance->tilesStyle = new DGWT_TilesStyle_Loader;

				}
				self::$instance->tnow = time();

				return self::$instance;
			}

			/**
			 * Constructor Function
			 */
			private function __construct() {
				self::$instance = $this;
			}

			/*
			 * Check requirements
			 * @since 1.2.2
			 */

			private function check_requirements() {
				if ( version_compare( PHP_VERSION, '5.3.0' ) < 0 ) {
					add_action( 'admin_notices', array( $this, 'admin_notice_php' ) );

					return false;
				}

				return true;
			}

			/**
			 * Setup plugin constants
			 */
			private function constants() {

				$this->define( 'DGWT_JG_VERSION', '1.3.1' );
				$this->define( 'DGWT_JG_NAME', 'Justified Gallery' );
				$this->define( 'DGWT_JG_FILE', __FILE__ );
				$this->define( 'DGWT_JG_DIR', plugin_dir_path( __FILE__ ) );
				$this->define( 'DGWT_JG_URL', plugin_dir_url( __FILE__ ) );
				$this->define( 'DGWT_JG_BASENAME', plugin_basename( __FILE__ ) );

				$this->define( 'DGWT_JG_SETTINGS_KEY', 'dgwt_jg_settings' );

				$this->define( 'DGWT_JG_DEBUG', false );
			}

			/**
			 * Define constant if not already set
			 *
			 * @param  string $name
			 * @param  string|bool $value
			 */
			private function define( $name, $value ) {
				if ( ! defined( $name ) ) {
					define( $name, $value );
				}
			}

			/**
			 * Include required core files.
			 */
			public function includes() {

				require_once DGWT_JG_DIR . 'includes/Utils/Helpers.php';
				require_once DGWT_JG_DIR . 'includes/Utils/MobileDetect.php';

				require_once DGWT_JG_DIR . 'includes/Install.php';

				require_once DGWT_JG_DIR . 'includes/admin/settings/SettingsApi.php';
				require_once DGWT_JG_DIR . 'includes/admin/settings/Settings.php';

				require_once DGWT_JG_DIR . 'includes/RegisterScripts.php';

				require_once DGWT_JG_DIR . 'includes/admin/admin.php';
				require_once DGWT_JG_DIR . 'includes/admin/Promo/FeedbackNotice.php';
				require_once DGWT_JG_DIR . 'includes/admin/Promo/Upgrade.php';

				require_once DGWT_JG_DIR . 'includes/Gallery.php';
				require_once DGWT_JG_DIR . 'includes/TilesStyle/Loader.php';
				require_once DGWT_JG_DIR . 'includes/Lightbox/Loader.php';

			}

			/**
			 * Actions and filters
			 */
			private function hooks() {

				add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			}

			/*
			 * Enqueue admin sripts
			 */

			public function admin_scripts() {
				// Register CSS
				wp_register_style( 'dgwt-jg-admin-style', DGWT_JG_URL . 'assets/css/admin-style.css', array(), DGWT_JG_VERSION );

				// Enqueue CSS
				wp_enqueue_style( array(
					'dgwt-jg-admin-style'
				) );


				// Register JS
				if ( DGWT_JG_Helpers::is_settings_page() ) {
					wp_register_script( 'dgwt-jg-admin-js', DGWT_JG_URL . 'assets/js/admin.js', array( 'jquery' ), DGWT_JG_VERSION );
					wp_enqueue_script( 'dgwt-jg-admin-js' );
				}

			}

			/*
			 * Notice: PHP version less than 5.3
			 */

			public function admin_notice_php() {
				?>
                <div class="error">
                    <p>
						<?php
						printf( __( '<b>Justified Gallery Plugin</b>: You need PHP version at least 5.3 to run this plugin. You are currently using PHP version %s. Please upgrade PHP version or uninstall this plugin.', 'justified-gallery' ), PHP_VERSION );
						?>
                    </p>
                </div>
				<?php
			}

		}

	}

// Init the plugin
	function DGWT_JG() {
		return DGWT_JG_Core::get_instance();
	}

	DGWT_JG();
    
}