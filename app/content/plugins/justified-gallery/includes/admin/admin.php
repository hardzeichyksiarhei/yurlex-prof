<?php

/**
 * Submenu page
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class DGWT_JG_Admin {

	public function __construct() {

		add_action( 'admin_menu', array( $this, 'add_menu' ), 20 );

		add_action( 'admin_head', array( $this, 'hide_gallery_setting' ), 20 );
	}

	/**
	 * Add meun items
	 */
	public function add_menu() {

		add_menu_page( __( 'Justified Gallery', 'justified-gallery' ), __( 'Justified Gallery', 'justified-gallery' ), 'manage_options', 'dgwt_jg_settings', array( $this, 'settings_page' ), DGWT_JG_URL . 'assets/img/admin-icon.png', 56 );
	
		//add_submenu_page( 'options-general.php', __( 'Justified Gallery', 'justified-gallery' ), __( 'Justified Gallery', 'justified-gallery' ), 'manage_options', 'dgwt_jg_settings', array( $this, 'settings_page' ) );
	}

	/**
	 * Settings page
	 */
	public function settings_page() {
		DGWT_JG_Settings::output();
	}

	public function hide_gallery_setting() {
		?>
		<style>
			.gallery-settings h2::after{
				display: block;
				clear: both;
				color: #5fba7d;
				display: block;
				margin-top: 15px;
                text-transform: none;
				content: "<?php _e( 'You use the Justified Gallery plugin. The options (Columns) and (Size) will be ignored.', 'justified-gallery' ) ?>";
			}
            .gallery-settings label:nth-child(3),
            .gallery-settings label:nth-child(5){
                opacity: 0.5;
            }
		</style>
		<?php

	}

}

$dgwt_jg_admin = new DGWT_JG_Admin();

