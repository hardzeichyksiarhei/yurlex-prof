<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class TilesStyle
 */
abstract class DGWT_JG_TilesStyle {

	/**
	 * A implementation ID
	 * Should be overwritten in the implementation
	 * @var string
	 */
	protected $slug = '';

	/**
	 * Absolute server path to a implementation root.
	 * @var string
	 */
	protected $dir = '';

	/**
	 * Absolute URL to assets for a implementation
	 * @var string
	 */
	protected $assets_url = '';


	public function __construct() {

		$this->dir        = dirname( __FILE__ ) . '/' . $this->slug;
		$this->assets_url = DGWT_JG_URL . 'includes/TilesStyle/' . $this->slug . '/assets';

		$this->load();
	}

	/**
	 * Add actions or filters
	 *
	 * @return null
	 */
	private function load() {

		add_action( 'wp_footer', array( $this, 'css_style' ), 5 );
		add_action( 'wp_footer', array( $this, 'js_scripts' ), 95 );


		add_action( 'admin_footer', array( $this, 'js_scripts' ), 95 );
		add_action( 'admin_footer', array( $this, 'css_style' ), 95 );

	}

	/**
	 * Method to register and enqueue JS files
	 * Should be overwritten in the implementation
	 *
	 * @return null
	 */
	public function js_scripts() {}

	/**
	 * Method to register and enqueue CSS files
	 * Should be overwritten in the implementation
	 *
	 * @return null
	 */
	public function css_style() {}


	/**
	 * Check if can load resources
	 * @return bool
	 */
	protected function can_load(){
		$slug = $this->slug === 'JGStandard' ? 'standard' : strtolower($this->slug);
		$load_on_frontend = in_array($slug, DGWT_JG()->gallery->get_hovers_to_load());
		$load_on_backend = DGWT_JG_Helpers::is_settings_page();
		return $load_on_frontend || $load_on_backend;
	}

}