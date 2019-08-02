<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class DGWT_TilesStyle_Loader {

	/**
	 * Type of tiles style
	 * @var string
	 */
	private $style = '';

	/**
	 * Local dirname
	 * @var string
	 */
	private $dir = '';

	public function __construct() {

		$this->dir = dirname(__FILE__);

		$this->style = DGWT_JG()->settings->get_opt( 'tiles_style' );

		$this->load_style();

	}

	/**
	 *
	 * Load source of selected tiles style
	 *
	 * return void
	 */
	public function load_style() {

		// Load the abstract class
		include $this->dir . '/TilesStyle.php';

		include $this->dir . '/JGStandard/Admin.php';
		include $this->dir . '/JGStandard/JGStandard.php';

		include $this->dir . '/Layla/Admin.php';
		include $this->dir . '/Layla/Layla.php';

		new DGWT_JG_TilesStyle_JGStandard();
		new DGWT_JG_TilesStyle_Layla();

	}

}