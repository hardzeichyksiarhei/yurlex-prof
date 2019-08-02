<?php

class DGWT_JG_Layla_Admin {

	/**
	 * @var string
	 */
	protected $assets_url = '';

	public function __construct( $assets_url ) {
		$this->assets_url = $assets_url;
		$this->init();
	}

	public function init() {

		$this->join_settings();

		$this->prepare_preview();
	}


	/**
	 * Method to register settings
	 */
	public function join_settings() {

		add_filter('dgwt/jg/settings/tiles_style', array($this, 'register_settings'));

		add_filter( 'dgwt/jg/settings/tiles_style/options', function ( $options ) {

			$options['layla'] = __( 'Layla', 'justified-gallery' );


			return $options;
		} );

		add_filter('dgwt/jg/settings/promobox/id=promobox_ts_layla', array($this, 'add_promobox'));
	}


	/**
	 * Add settings for this style
	 *
	 * @param array $settings
	 *
	 * @return array
	 */
	public static function register_settings( $settings ) {

		$settings[] = array(
			'name'    => 'ts_layla_preview_head',
			'label'   => __( 'Preview', 'justified-gallery' ),
			'type'    => 'head',
			'class' => 'opt-layla dgwt-jg-sgs-header',
		);

		$settings[] = array(
			'name'    => 'promobox_ts_layla',
			'label'   => '',
			'type'    => 'promobox',
			'class' => 'opt-layla'
		);

		$settings[] = array(
			'name'    => 'ts_layla_customize_head',
			'label'   => __( 'Layla Settings', 'justified-gallery' ),
			'type'    => 'head',
			'class' => 'opt-layla dgwt-jg-sgs-header',
		);


		if (!dgwt_freemius()->is_premium()) {
			$desc = sprintf(__('These are the default settings for the <b>%s</b> style. To change the following options you must <a href="%s">upgrade your plan</a>.', 'justified-gallery'), __('Layla', 'justified-gallery'), DGWT_JG_Upgrade::get_upgrade_url());

			$settings[] = array(
				'name' => 'ts_layla_free_desc',
				'label' => '',
				'type' => 'desc',
				'desc' => $desc,
				'class' => 'opt-layla dgwt-jg-option-as-desc'
			);
		}


		$settings[] = array(
			'name'    => 'ts_layla_description',
			'label'   => __( 'Caption', 'justified-gallery' ),
			'type'    => 'radio',
			'class' => 'opt-layla dgwt-jg-premium-only',
			'options' => array(
				'show' => __( 'Show', 'justified-gallery' ),
				'hide' => __( 'Hide', 'justified-gallery' ),
			),
			'default' => 'show',
		);

		$settings[] = array(
			'name'    => 'ts_layla_font-size',
			'label'   => __( 'Caption size', 'justified-gallery' ),
			'type'    => 'select',
			'class' => 'opt-layla dgwt-jg-premium-only',
			'options' => array(
				'8' => __( '8pt', 'justified-gallery' ),
				'10' => __( '10pt', 'justified-gallery' ),
				'12' => __( '12pt', 'justified-gallery' ),
				'14' => __( '14pt', 'justified-gallery' ),
				'18' => __( '18pt', 'justified-gallery' ),
				'24' => __( '24pt', 'justified-gallery' ),

			),
			'default' => '10',
		);

		$settings[] = array(
			'name'    => 'ts_layla_bg_color',
			'label'   => __( 'Background color', 'justified-gallery' ),
			'type'    => 'color',
			'class' => 'opt-layla dgwt-jg-premium-only',
			'default' => '#000000',
		);

		$settings[] = array(
			'name'    => 'ts_layla_bg_copacity',
			'label'   => __( 'Background opacity', 'justified-gallery' ),
			'type'    => 'number',
			'size' => 'small',
			'desc' => '%',
			'class' => 'opt-layla dgwt-jg-premium-only',
			'default' => '60',
		);

		$settings[] = array(
			'name'    => 'ts_layla_content_color',
			'label'   => __( 'Content color', 'justified-gallery' ),
			'type'    => 'color',
			'class' => 'opt-layla dgwt-jg-premium-only',
			'default' => '#FFFFFF',
		);

		return $settings;
	}


	/**
	 * Return HTML of the tile hover style preview on the settings screen
	 * @param string $html
	 *
	 * @return string
	 */
	public static function add_promobox($html){
		ob_start();
		include dirname(__FILE__) . '/promobox.php';
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


	/**
	 * The special demo gallery instance for the settings page
	 */
	public function prepare_preview() {

		if ( ! is_admin() ) {
			return;
		}

		/**
		 * Image URL
		 *
		 * @param string $html_img
		 * @param object $attachment
		 * @param array $atts
		 * @param int $image_counter
		 *
		 * @return string (HTML)
		 */
		add_filter( 'dgwt/jg/gallery/html_img/hover=layla', function ( $html_img, $attachment, $atts, $imstance, $image_counter ) {
			if ( ! empty( $atts['demo'] ) ) {
				$url = '';
				switch ( $image_counter ) {
					case 1:
						$url = DGWT_JG_URL . 'assets/img/hovers-demo1.jpg';
						break;
					case 2:
						$url = DGWT_JG_URL . 'assets/img/hovers-demo2.jpg';
						break;
					case 3:
						$url = DGWT_JG_URL . 'assets/img/hovers-demo3.jpg';
						break;
				}
				$html_img = '<img src="' . $url . '" />';
			}

			return $html_img;
		}, 10, 5 );


	}

}