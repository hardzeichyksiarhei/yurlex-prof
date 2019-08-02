<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class DGWT_JG_Lightbox_Loader
 */
class DGWT_JG_Lightbox_Loader {

	/**
	 * Selected ligthbox slug by user
	 * @var string
	 */
	private $lightbox = '';

	/**
	 * Local dirname
	 * @var string
	 */
	private $dir = '';

	public function __construct() {

		$this->dir = dirname(__FILE__);
		$this->lightbox = DGWT_JG()->settings->get_opt( 'lightbox' );

		$this->load_lightboxes();

	}

	/**
	 *
	 * Load source of selected lightbox
	 *
	 * return void
	 */
	public function load_lightboxes() {

		// Load the abstract class
		include $this->dir . '/Lightbox.php';

        include $this->dir . '/Photoswipe/Admin.php';
		include $this->dir . '/Photoswipe/Photoswipe.php';

        include $this->dir . '/Swipebox/Admin.php';
        include $this->dir . '/Swipebox/Swipebox.php';

		new DGWT_JG_Photoswipe();
		new DGWT_JG_Swipebox();

	}

}