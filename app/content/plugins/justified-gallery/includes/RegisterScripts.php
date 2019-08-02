<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register necessary JS and CSS
 */
class DGWT_JG_Scripts {

	function __construct() {

		add_action( 'wp_footer', array( $this, 'js_scripts' ), 3 );

		add_action( 'wp_footer', array( $this, 'css_style' ), 3 );

        add_action( 'admin_footer', array( $this, 'js_scripts' ), 3);
        add_action( 'admin_footer', array( $this, 'css_style' ), 3);
	}

	/*
	 * Register scripts.
	 * Uses a WP hook wp_enqueue_scripts
	 *
	 * @return null
	 */

	public function js_scripts() {

		if ( DGWT_JG_Helpers::can_display_jg()) {

			if ( DGWT_JG_DEBUG === false ) {
				wp_register_script( 'dgwt-justified-gallery', DGWT_JG_URL . 'assets/js/jquery.justifiedGallery.min.js', array( 'jquery' ), DGWT_JG_VERSION, true );
			} else {
				wp_register_script( 'dgwt-justified-gallery', DGWT_JG_URL . 'assets/js/jquery.justifiedGallery.js', array( 'jquery' ), DGWT_JG_VERSION, true );
			}

			$vars = array(
				'plugin_url' => DGWT_JG_URL,
			);
			wp_localize_script( 'dgwt-justified-gallery', 'DGWT_JG', $vars );

			wp_enqueue_script( array(
				'dgwt-justified-gallery'
			) );
		}
	}

    /**
     * Register and enqueue style
     * @return null
     */

    public function css_style(){

        if (DGWT_JG_Helpers::can_display_jg()) {

            // Main CSS
            if (DGWT_JG_DEBUG === false) {
                wp_register_style('dgwt-jg-style', DGWT_JG_URL . 'assets/css/style.min.css', array(), DGWT_JG_VERSION);
            } else {
                wp_register_style('dgwt-jg-style', DGWT_JG_URL . 'assets/css/style.css', array(), DGWT_JG_VERSION);
            }

            wp_enqueue_style(array(
                'dgwt-jg-style'
            ));

        }
    }

}

$attach_scripts = new DGWT_JG_Scripts;
?>