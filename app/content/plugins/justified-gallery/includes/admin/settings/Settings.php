<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Settings API data
 */
class DGWT_JG_Settings {
	/*
	 * @var string
	 * Unique settings slug
	 */

	private $setting_slug = DGWT_JG_SETTINGS_KEY;

	/*
	 * @var array
	 * All options values in one array
	 */
	public $opt;

	/*
	 * @var object
	 * Settings API object
	 */
	public $settings_api;

	public function __construct() {
		global $dgwt_jg_settings;

		// Set global variable with settings
		$settings = get_option( $this->setting_slug );
		if ( !isset( $settings ) || empty( $settings ) ) {
			$dgwt_jg_settings = array();
		} else {
			$dgwt_jg_settings = $settings;
		}

		$this->opt = $dgwt_jg_settings;

		$this->settings_api = new DGWT_JG_Settings_API( $this->setting_slug );

		add_action( 'admin_init', array( $this, 'settings_init' ) );

		add_filter( 'plugin_action_links_' . DGWT_JG_BASENAME, array( $this, 'add_action_links' ) );

        add_filter( 'dgwt/jg/settings/option_value', array($this, 'restore_default_value_if_free_plan'), 10, 3);

		add_action( 'wp_ajax_dgwt_jg_dismiss_how_to_use', array( $this, 'dismiss_how_to_use_notice' ) );

	}

	/*
	 * Set sections and fields
	 */

	public function settings_init() {

		//Set the settings
		$this->settings_api->set_sections( $this->settings_sections() );
		$this->settings_api->set_fields( $this->settings_fields() );

		//Initialize settings
		$this->settings_api->settings_init();
	}

	/*
	 * Set settings sections
	 * 
	 * @return array settings sections
	 */

	public function settings_sections() {

		$sections = array(
			array(
				'id'	 => 'dgwt_jg_basic',
				'title'	 => __( 'Basic', 'justified-gallery' )
			),
			array(
				'id'	 => 'dgwt_jg_tiles_style',
				'title'	 => __( 'Tiles style', 'justified-gallery' )
			),
			array(
				'id'	 => 'dgwt_jg_lightbox',
				'title'	 => __( 'Lightbox', 'justified-gallery' )
			)
		);
		return apply_filters( 'dgwt/jg/settings/sections', $sections );
	}

	/**
	 * Create settings fields
	 *
	 * @return array settings fields
	 */
	function settings_fields() {
		$settings_fields = array(
			'dgwt_jg_basic'		 => apply_filters( 'dgwt/jg/settings/basic', array(
                array(
                    'name'    => 'basic_main',
                    'label'   => __( 'Main', 'justified-gallery' ),
                    'type'    => 'head',
                    'class' => 'dgwt-jg-sgs-header'
                ),
				array(
					'name'		 => 'last_row',
					'label'		 => __( 'Last row', 'justified-gallery' ),
					'type'		 => 'select',
					'options'	 => array(
						'nojustify'	 => __( 'Align left', 'justified-gallery' ),
						'center'	 => __( 'Align center', 'justified-gallery' ),
						'right'		 => __( 'Align right', 'justified-gallery' ),
						'justify'	 => __( 'Justify', 'justified-gallery' ),
						'hide'		 => __( 'Hide', 'justified-gallery' )
					),
					'desc'		 => __( "Decide how to position the last row of images. Default the last row images are aligned to the left. You can also hide the row if it can't be justified and aligned to the center or to the right", 'justified-gallery' ),
					'default'	 => 'left',
				),
				array(
					'name'		 => 'margin',
					'label'		 => __( 'Space between images', 'justified-gallery' ),
					'type'		 => 'number',
					'size'		 => 'small',
					'desc'		 => ' px',
					'default'	 => 3,
				),
				array(
					'name'		 => 'row_height',
					'label'		 => __( 'Row height', 'justified-gallery' ),
					'type'		 => 'number',
					'size'		 => 'small',
					'desc'		 => ' px - ' . __( 'The preferred height of rows.', 'justified-gallery' ),
					'default'	 => 160,
				),
				array(
					'name'		 => 'max_row_height',
					'label'		 => __( 'Max row height', 'justified-gallery' ),
					'type'		 => 'number',
					'size'		 => 'small',
					'desc'		 => ' px - ' . __( 'Type <code>-1</code> to remove the limit of the maximum row height.', 'justified-gallery' ),
					'default'	 => -1,
				),
				array(
					'name'    => 'basic_performance',
					'label'   => __( 'Performance', 'justified-gallery' ),
					'type'    => 'head',
                    'class' => 'dgwt-jg-sgs-header'
				),
				 array(
					'name'    => 'performance_lazy_load',
					'label'   => __( 'Speed Up', 'justified-gallery' ),
					'desc' => __('Reduce the gallery loading time. Perfect for larger galleries. Using this option the layout is built immediately, and the thumbnails will appear randomly while they are loaded (asynchronous images loading)', 'justified-gallery'),
					'type'    => 'checkbox',
					'class' => 'dgwt-jg-premium-only',
					'default' => ''
				)
			) ),
			'dgwt_jg_tiles_style' => apply_filters( 'dgwt/jg/settings/tiles_style', array(
                array(
                    'name' => 'choose_tiles_style_head',
                    'label' => __('Select style', 'justified-gallery'),
                    'type' => 'head',
                    'class' => 'dgwt-jg-sgs-header'
                ),
				array(
					'name'    => 'tiles_style',
					'label'   => __( 'Select tiles style', 'justified-gallery' ),
					'desc'    => __( '', 'justified-gallery' ),
					'type'    => 'select',
					'class' => 'dgwt-jg-options-toggle',
					'options' => apply_filters( 'dgwt/jg/settings/tiles_style/options', array(
						'no'          => __( '-- without styling', 'justified-gallery' ),
						'jg_standard' => __( 'JG Standard', 'justified-gallery' )
					) ),
					'desc'   => __( 'Caption presentation, hover effects etc.', 'justified-gallery' ),
					'default' => 'jg_standard',
				),
			) ),
			'dgwt_jg_lightbox'	 => apply_filters( 'dgwt/jg/settings/lightbox', array(
                array(
                    'name' => 'choose_lightbox_head',
                    'label' => __('Select Lightbox', 'justified-gallery'),
                    'type' => 'head',
                    'class' => 'dgwt-jg-sgs-header'
                ),
				array(
					'name'    => 'lightbox',
					'label'   => __( 'Select Lightbox', 'justified-gallery' ),
					'desc'   => __( 'Allows users to open images in the Lightbox gallery.', 'justified-gallery' ),
					'type'    => 'select',
					'class' => 'dgwt-jg-lightbox-opt dgwt-jg-options-toggle',
					'options' => apply_filters( 'dgwt/jg/settings/lightbox/options', array(
						'no'          => __( '-- disable lightbox', 'justified-gallery' ),
						'photoswipe' => __( 'Photoswipe', 'justified-gallery' )
					)),
					'default' => 'photoswipe',
					'disabled' => array(
					)
				),
			) )
		);

        if (!dgwt_freemius()->is_premium()) {


            foreach ($settings_fields as $key => $sections) {
                $i = 0;
                foreach ($sections as $option) {
                    if (DGWT_JG()->settings->is_option_premium($option)) {
                        // $settings[$i]['pro'] = true;

                        $settings_fields[$key][$i]['label'] = DGWT_JG_Helpers::get_pro_label($option['label'], 'option-label');
                    }
                    $i++;
                }
            }
        }


		return $settings_fields;
	}

	/*
	 * Print optin value
	 * 
	 * @param string $option_key
	 * @param string $default default value if option not exist
	 * 
	 * @return string
	 */

	public function get_opt( $option_key, $default = '' ) {

		$value = '';

		if ( is_string( $option_key ) && !empty( $option_key ) ) {

			if ( array_key_exists( $option_key, $this->opt ) ) {
				$value = $this->opt[ $option_key ];
			} else {

				// Catch default
				foreach ( $this->settings_fields() as $section ) {
					foreach ( $section as $field ) {
						if ( $field[ 'name' ] === $option_key && isset( $field[ 'default' ] ) ) {
							$value = $field[ 'default' ];
						}
					}
				}
			}
		}

		if ( empty( $value ) && !empty( $default ) ) {
			$value = $default;
		}

		return apply_filters( 'dgwt/jg/options/value', $value, $option_key );
	}

	/**
	 * Update option
	 *
	 * @param string key
	 * @param string value
	 *
	 * @return boolean True if option value has changed, false if not or if update failed.
	 */
	public function update_option( $key, $value ) {

		$options = get_option( DGWT_JG_SETTINGS_KEY );

		$options[ $key ] = $value;

		return update_option( DGWT_JG_SETTINGS_KEY, $options );

	}

	/**
	 * Add settings action links
	 * @param $links
	 *
	 * @return array
	 */
	public function add_action_links( $links ) {
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=dgwt_jg_settings' ) . '">'. __( 'Settings', 'justified-gallery' ) .'</a>',
		);
		return array_merge( $settings_link, $links );
	}

    /**
     * Check if a option is premium
     * @param array $option
     * @return bool
     */
    public function is_option_premium($option){
        $is_premium = false;
        if(!empty($option['class']) && strpos($option['class'], 'dgwt-jg-premium-only') !== false){
            $is_premium = true;
        }

        return $is_premium;
    }

    /**
     * Restore default option value
     * @param mixed $value
     * @param mixed $default
     * @param array $option
     * @return mixed
     */
    public function restore_default_value_if_free_plan($value, $default, $option){
        if (!dgwt_freemius()->is_premium()) {
            if (DGWT_JG()->settings->is_option_premium($option)) {
                $value = $default;
            }
        }

        return $value;
    }

	/**
	 * Handles output of the settings
	 * @return null
	 */
	public static function output() {

		$settings = DGWT_JG()->settings->settings_api;

		include_once DGWT_JG_DIR . 'includes/admin/views/settings.php';
	}

	/**
	 * Dismiss how to use notice
	 * @return null
	 */
	public function dismiss_how_to_use_notice(){
		update_option( 'dgwt_jg_dismiss_how_to_use_notice', true );

		wp_send_json_success();
	}

}

/**
 * Disable details box setting tab if the option id rutns off
 */
add_filter( 'dgwt/jg/settings/sections', 'dgwt_jg_hide_settings_details_tab' );

function dgwt_jg_hide_settings_details_tab( $sections ) {

	if ( DGWT_JG()->settings->get_opt( 'show_details_box' ) !== 'on' && is_array( $sections ) ) {

		$i = 0;
		foreach ( $sections as $section ) {

			if ( isset( $section[ 'id' ] ) && $section[ 'id' ] === 'dgwt_jg_details_box' ) {
				unset( $sections[ $i ] );
			}

			$i++;
		}
	}

	return $sections;
}
