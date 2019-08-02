<?php

class DGWT_JG_Photoswipe_Admin
{

    /**
     * @var string
     */
    protected $assets_url = '';

    public function __construct($assets_url)
    {
        $this->assets_url = $assets_url;
        $this->init();
    }

    public function init()
    {

        $this->join_settings();

        $this->prepare_preview();
    }

    /**
     * Method to register settings
     */
    public function join_settings()
    {

        add_filter('dgwt/jg/settings/lightbox', array($this, 'register_settings'));
        add_filter('dgwt/jg/settings/promobox/id=promobox_photoswipe', array($this, 'add_promobox'));

    }


    /**
     * Add settings
     * @param array[] $settings
     * @return array[]
     */
    public function register_settings($settings) {

	    $settings[] = array(
		    'name' => 'photoswipe_preview_head',
		    'label' => __('Photoswipe preview', 'justified-gallery'),
		    'type' => 'head',
		    'class' => 'opt-photoswipe dgwt-jg-sgs-header',
	    );

        $settings[] = array(
            'name' => 'promobox_photoswipe',
            'label' => '',
            'type' => 'promobox',
            'class' => 'opt-photoswipe'
        );

        $settings[] = array(
            'name' => 'photoswipe_customize_head',
            'label' => __('PhotoSwipe settings', 'justified-gallery'),
            'type' => 'head',
            'class' => 'opt-photoswipe dgwt-jg-sgs-header',
        );

        if (!dgwt_freemius()->is_premium()) {
            $desc = sprintf(__('These are the default settings for the <b>%s</b> lightbox. To change the following options you must <a href="%s">upgrade your plan</a>.', 'justified-gallery'), __('Photoswipe', 'justified-gallery'), DGWT_JG_Upgrade::get_upgrade_url());

            $settings[] = array(
                'name' => 'photoswipe_free_desc',
                'label' => '',
                'type' => 'desc',
                'desc' => $desc,
                'class' => 'opt-photoswipe dgwt-jg-option-as-desc'
            );
        }

        $settings[] = array(
            'name' => 'photoswipe_theme',
            'label' => __('Theme', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'dgwt-jg-premium-only opt-photoswipe',
            'options' => array(
                'dark' => __('Dark', 'justified-gallery'),
                'white-light' => __('White light (wedding themed)', 'justified-gallery'),
            ),
            'default' => 'dark',
        );

        $settings[] = array(
            'name' => 'photoswipe_caption',
            'label' => __('Caption', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'dgwt-jg-premium-only opt-photoswipe',
            'options' => array(
                'show' => __('Show', 'justified-gallery'),
                'hide' => __('Hide', 'justified-gallery'),
            ),
            'default' => 'show',
        );

        $settings[] = array(
            'name' => 'photoswipe_share',
            'label' => __('Share buttons', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'dgwt-jg-premium-only opt-photoswipe',
            'options' => array(
                'show' => __('Show', 'justified-gallery'),
                'hide' => __('Hide', 'justified-gallery'),
            ),
            'default' => 'show',
        );

        $settings[] = array(
            'name' => 'photoswipe_download',
            'label' => __('Download image button', 'justified-gallery'),
            'type' => 'radio',
            'class' => 'dgwt-jg-premium-only opt-photoswipe',
            'options' => array(
                'show' => __('Show', 'justified-gallery'),
                'hide' => __('Hide', 'justified-gallery'),
            ),
            'default' => 'show',
        );

        $settings[] = array(
            'name' => 'photoswipe_bg_opacity',
            'label' => __('Background opacity', 'justified-gallery'),
            'desc' => '%. ' . __('Set a value from 0 to 100%.', 'justified-gallery'),
            'type' => 'number',
            'class' => 'dgwt-jg-premium-only opt-photoswipe',
            'size' => 'small',
            'default' => '100',
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
        add_filter('dgwt/jg/gallery/html_img/lightbox=photoswipe', function ($html_img, $attachment, $atts, $imstance, $image_counter) {
            if (!empty($atts['demo'])) {
                $url = '';
                switch ($image_counter) {
                    case 1:
                        $url = $this->assets_url . '/img/ps-demo1.jpg';
                        break;
                    case 2:
                        $url = $this->assets_url . '/img/ps-demo2.jpg';
                        break;
                    case 3:
                        $url = $this->assets_url . '/img/ps-demo3.jpg';
                        break;
                }
                $html_img = '<img src="' . $url . '" />';
            }
            return $html_img;
        }, 10, 5);

        /**
         * FigureImage link
         */
        add_filter('dgwt/jg/gallery/tile_atts/lightbox=photoswipe', function ($atts, $attachment, $gallery_atts, $instance, $image_counter)
        {
            if (!empty($gallery_atts['demo'])) {

                switch ($image_counter) {
                    case 1:
                        $atts['data-size'] = '768x513';
                        break;
                    case 2:
                        $atts['data-size'] = '768x1151';
                        break;
                    case 3:
                        $atts['data-size'] = '768x512';
                        break;
                }
            }
            return $atts;
        }, 10, 5);

        /**
         * Image link
         */
        add_filter('dgwt/jg/gallery/link_atts/lightbox=photoswipe', function ($atts, $attachment, $gallery_atts, $instance, $image_counter)
        {
            if (!empty($gallery_atts['demo'])) {

                switch ($image_counter) {
                    case 1:
                        $atts['href'] = $this->assets_url . '/img/ps-demo1.jpg';
                        break;
                    case 2:
                        $atts['href'] = $this->assets_url . '/img/ps-demo2.jpg';
                        break;
                    case 3:
                        $atts['href'] = $this->assets_url . '/img/ps-demo3.jpg';
                        break;
                }
            }
            return $atts;
        }, 10, 5);

    }

}
