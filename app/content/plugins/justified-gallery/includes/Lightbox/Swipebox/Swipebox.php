<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Swipebox integration
 */
class DGWT_JG_Swipebox extends DGWT_JG_Lightbox
{
    /**
     * @var array
     */
    private  $opt = array() ;
    /**
     * Unique slug for the instance
     * @var string
     */
    public  $slug = 'Swipebox' ;
    /**
     * Swipebox constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    public function init()
    {
        add_filter(
            'dgwt/jg/gallery/tile_atts/lightbox=swipebox',
            array( $this, 'add_figure_atts' ),
            10,
            2
        );
        add_filter(
            'dgwt/jg/gallery/link_atts/lightbox=swipebox',
            array( $this, 'add_link_atts' ),
            10,
            4
        );
        add_filter( 'plugins_loaded', array( $this, 'prepare_settings' ) );
        if ( is_admin() ) {
            new DGWT_JG_Swipebox_Admin( $this->assets_url );
        }
    }
    
    public function include_libs()
    {
        wp_enqueue_script(
            'dgwt-jg-swipebox',
            $this->assets_url . '/js/jquery.swipebox.min.js',
            array( 'jquery' ),
            DGWT_JG_VERSION,
            true
        );
        wp_enqueue_style(
            'dgwt-jg-swipebox',
            $this->assets_url . '/css/swipebox.min.css',
            array(),
            DGWT_JG_VERSION
        );
    }
    
    /**
     * Add an HTML attributes to the <figure> element
     *
     * @param string $atts
     * @param object $attachment
     */
    public function add_figure_atts( $atts, $attachment )
    {
        
        if ( DGWT_JG()->settings->get_opt( 'description' ) === 'show' ) {
            $title = DGWT_JG_Helpers::get_image_caption( $attachment );
            if ( !empty($title) ) {
                $atts['title'] = wp_strip_all_tags( $title );
            }
        }
        
        return $atts;
    }
    
    /**
     * Add an HTML attributes to the <a> element
     *
     * @param string $atts
     * @param object $attachment
     * @param array $gallery_atts
     * @param int $instance
     */
    public function add_link_atts(
        $atts,
        $attachment,
        $gallery_atts,
        $instance
    )
    {
        $atts['rel'] = 'dgwt-jg-swipebox-' . $instance;
        return $atts;
    }
    
    /**
     * Init Swipebox
     * @return null | echo JavaScript
     */
    public function gallery_js()
    {
        ?>
        <script type="text/javascript">
            ( function ($) {
                $(document).ready(function () {

                    var $gallery = $('.dgwt-jg-lightbox-swipebox'),
                        $item = $('.dgwt-jg-lightbox-swipebox .dgwt-jg-item > a');

                    if ($gallery.length > 0 && $item.length > 0) {

                        $item.swipebox({
                            <?php 
        // delay before hiding bars on desktop
        echo  'hideBarsDelay:' . $this->opt['hideBarsDelay'] . ',' ;
        echo  'loopAtEnd:' . $this->opt['loopAtEnd'] . ',' ;
        echo  'removeBarsOnMobile:' . $this->opt['removeBarsOnMobile'] . ',' ;
        echo  'hideCloseButtonOnMobile:' . $this->opt['hideCloseButtonOnMobile'] ;
        ?>
                        });

                    }

                });
            }(jQuery))
        </script>
        <?php 
    }
    
    /**
     * Prepare settings
     * null
     */
    public function prepare_settings()
    {
        
        if ( !dgwt_freemius()->is_premium() ) {
            $this->opt['hideBarsDelay'] = 3000;
            $this->opt['loopAtEnd'] = 'false';
            $this->opt['removeBarsOnMobile'] = 'true';
            $this->opt['hideCloseButtonOnMobile'] = 'false';
            $this->opt['caption'] = false;
        }
    
    }

}