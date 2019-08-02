<?php

class DGWT_JG_Swipebox_Admin
{

    /**
     * @var string
     */
    protected $assets_url = '';

    public function __construct($assets_url ){
        $this->assets_url = $assets_url;
        $this->init();
    }

    public function init(){

        $this->join_settings();

        $this->prepare_preview();
    }


    /**
     * Method to register settings
     */
    public function join_settings()
    {

        add_filter('dgwt/jg/settings/lightbox', array($this, 'register_settings'));

        add_filter('dgwt/jg/settings/lightbox/options', function ($options) {
            $options['swipebox'] = __('Swipebox', 'justified-gallery');

            return $options;
        });

        add_filter('dgwt/jg/settings/promobox/id=promobox_swipebox', array($this, 'add_promobox'));

    }


    /**
     * Add settings
     * @param array[] $settings
     * @return array[]
     */
    public function register_settings($settings)
    {

	    $settings[] = array(
		    'name' => 'swipebox_preview_head',
		    'label' => __('Swipebox preview', 'justified-gallery'),
		    'type' => 'head',
		    'class' => 'opt-swipebox dgwt-jg-sgs-header',
	    );

        $settings[] = array(
            'name' => 'promobox_swipebox',
            'label' => '',
            'type' => 'promobox',
            'class' => 'opt-swipebox'
        );

        $settings[] = array(
            'name' => 'swipebox_customize_head',
            'label' => __('Swipebox settings', 'justified-gallery'),
            'type' => 'head',
            'class' => 'opt-swipebox dgwt-jg-sgs-header',
        );

        if (!dgwt_freemius()->is_premium()) {
            $desc = sprintf(__('These are the default settings for the <b>%s</b> lightbox. To change the following options you must <a href="%s">upgrade your plan</a>.', 'justified-gallery'), __('Swipebox', 'justified-gallery'), DGWT_JG_Upgrade::get_upgrade_url());

            $settings[] = array(
                'name' => 'swipebox_free_desc',
                'label' => '',
                'type' => 'desc',
                'desc' => $desc,
                'class' => 'opt-swipebox dgwt-jg-option-as-desc'
            );
        }

        $settings[] = array(
            'name' => 'swipebox_caption',
            'label' => __('Show caption', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'opt-swipebox dgwt-jg-premium-only',
            'options' => array(
                'show' => __('Show', 'justified-gallery'),
                'hide' => __('Hide', 'justified-gallery'),
            ),
            'default' => 'hide',
        );

        $settings[] = array(
            'name' => 'swipebox_bars_delay',
            'label' => __('Delay', 'justified-gallery'),
            'desc' => __('in milliseconds. Delay before hiding bars on desktop.', 'justified-gallery'),
            'type' => 'number',
            'class' => 'opt-swipebox dgwt-jg-premium-only',
            'size' => 'small',
            'default' => '3000',
        );

        $settings[] = array(
            'name' => 'swipebox_loop',
            'label' => __('Loop at end', 'justified-gallery'),
            'desc' => __('Return to the first image after the last image is reached', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'opt-swipebox dgwt-jg-premium-only',
            'options' => array(
                'yes' => __('Yes', 'justified-gallery'),
                'no' => __('No', 'justified-gallery'),
            ),
            'default' => 'no',
        );

        $settings[] = array(
            'name' => 'swipebox_show_closebtn_mob',
            'label' => __('Close button on mobile', 'justified-gallery'),
            'desc' => __('Show the close button on mobile devices', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'opt-swipebox dgwt-jg-premium-only',
            'options' => array(
                'show' => __('Show', 'justified-gallery'),
                'hide' => __('Hide', 'justified-gallery'),
            ),
            'default' => 'show',
        );

        $settings[] = array(
            'name' => 'swipebox_show_bars_mob',
            'label' => __('Bars on mobile', 'justified-gallery'),
            'desc' => __('Show the navigation and the caption bar on mobile devices', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'opt-swipebox dgwt-jg-premium-only',
            'options' => array(
                'show' => __('Show', 'justified-gallery'),
                'hide' => __('Hide', 'justified-gallery'),
            ),
            'default' => 'hide',
        );

        return $settings;
    }

    /**
     * Return HTML of the lightbox preview on the settings screen
     * @param string $html
     *
     * @return string
     */
    public function add_promobox($html)
    {
        ob_start();
        include dirname(__FILE__) . '/promobox.php';
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }


    /**
     * The special demo gallery instance for the settings page
     */
    public function prepare_preview()
    {

        if(!is_admin()){
            return;
        }

        /**
         * Image URL
         * @param string $html_img
         * @param object $attachment
         * @param array $atts
         * @param int $image_counter
         *
         * @return string (HTML)
         */
        add_filter('dgwt/jg/gallery/html_img/lightbox=swipebox', function ($html_img, $attachment, $atts, $imstance, $image_counter) {
            if (!empty($atts['demo'])) {
                $url = '';
                switch ($image_counter) {
                    case 1:
                        $url = $this->assets_url . '/img/sb-demo1.jpg';
                        break;
                    case 2:
                        $url = $this->assets_url . '/img/sb-demo2.jpg';
                        break;
                    case 3:
                        $url = $this->assets_url . '/img/sb-demo3.jpg';
                        break;
                }
                $html_img = '<img src="' . $url . '" />';
            }
            return $html_img;
        }, 10, 5);

        /**
         * Image link
         */
     //   add_filter('dgwt/jg/gallery/tile_atts/lightbox=swipebox', array($this, 'add_figure_atts'), 10, 2);
        add_filter('dgwt/jg/gallery/link_atts/lightbox=swipebox', function ($atts, $attachment, $gallery_atts, $instance, $image_counter)
        {
            if (!empty($gallery_atts['demo'])) {

                switch ($image_counter) {
                    case 1:
                        $atts['href'] = $this->assets_url . '/img/sb-demo1.jpg';
                        break;
                    case 2:
                        $atts['href'] = $this->assets_url . '/img/sb-demo2.jpg';
                        break;
                    case 3:
                        $atts['href'] = $this->assets_url . '/img/sb-demo3.jpg';
                        break;
                }
            }
            return $atts;
        }, 10, 5);

    }

}