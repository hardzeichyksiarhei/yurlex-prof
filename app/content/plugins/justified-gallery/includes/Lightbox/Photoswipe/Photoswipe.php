<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * PhotoSwipe integration
 */
class DGWT_JG_Photoswipe extends DGWT_JG_Lightbox
{
    /**
     * @var array
     */
    private  $opt = array() ;
    /**
     * Unique slug for the instance
     * @var string
     */
    public  $slug = 'Photoswipe' ;
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    private function init()
    {
        add_action( 'wp_footer', array( $this, 'include_modal' ), 90 );
        add_action( 'admin_footer', array( $this, 'include_modal' ), 90 );
        add_filter(
            'dgwt/jg/gallery/tile_atts/lightbox=photoswipe',
            array( $this, 'add_caption' ),
            10,
            2
        );
        add_filter( 'plugins_loaded', array( $this, 'prepare_settings' ) );
        if ( is_admin() ) {
            new DGWT_JG_Photoswipe_Admin( $this->assets_url );
        }
    }
    
    /**
     * @inheritdoc
     */
    public function include_libs()
    {
        if ( !$this->can_load() ) {
            return false;
        }
        $min = '';
        if ( DGWT_JG_DEBUG === false ) {
            $min = '.min';
        }
        // JS
        wp_enqueue_script(
            'jquery-mousewheel',
            $this->assets_url . '/jquery.mousewheel.min.js',
            array( 'jquery' ),
            DGWT_JG_VERSION,
            true
        );
        wp_enqueue_script(
            'dgwt-jg-photoswipe-ui',
            $this->assets_url . '/photoswipe-ui-default' . $min . '.js',
            array( 'jquery', 'jquery-mousewheel' ),
            DGWT_JG_VERSION,
            true
        );
        wp_enqueue_script(
            'dgwt-jg-photoswipe',
            $this->assets_url . '/photoswipe' . $min . '.js',
            array( 'dgwt-jg-photoswipe-ui' ),
            DGWT_JG_VERSION,
            true
        );
        wp_enqueue_script(
            'dgwt-jg-jquery-photoswipe',
            $this->assets_url . '/jquery.photoswipe' . $min . '.js',
            array( 'dgwt-jg-photoswipe' ),
            DGWT_JG_VERSION,
            true
        );
        // CSS
        wp_enqueue_style(
            'dgwt-jg-photoswipe',
            $this->assets_url . '/photoswipe.css',
            array(),
            DGWT_JG_VERSION
        );
        if ( !dgwt_freemius()->is_premium() ) {
            wp_enqueue_style(
                'dgwt-jg-photoswipe-skin',
                $this->assets_url . '/default-skin/default-skin.css',
                array(),
                DGWT_JG_VERSION
            );
        }
    }
    
    /**
     * Add HTML Attributes to images link to view description etc.
     *
     * @param string $atts
     * @param object $attachment
     */
    public function add_caption( $atts, $attachment )
    {
        if ( 'attachment' !== get_post_type( $attachment ) ) {
            return $atts;
        }
        $label = ( trim( $attachment->post_excerpt ) ? wp_strip_all_tags( wptexturize( $attachment->post_excerpt ) ) : '' );
        $desc = ( trim( $attachment->post_content ) ? wp_kses_post( wptexturize( $attachment->post_content ) ) : '' );
        $desc = str_replace( '"', '\\"', $desc );
        $sub_html = "<h4>{$label}</h4><div class=\"dgwt-jg-item-desc\">{$desc}</div>";
        $atts['data-sub-html'] = $sub_html;
        return $atts;
    }
    
    /**
     * Include photoshwipe modal HTML
     * @return null | echo HTML
     */
    public function include_modal()
    {
        if ( !$this->can_load() ) {
            return false;
        }
        include_once $this->dir . '/photoswipe-modal.php';
    }
    
    /**
     * Init PhotoSwipe
     * @return null | echo JavaScript
     */
    public function gallery_js()
    {
        ?>
        <script type="text/javascript">
            ( function ($) {
                $(document).ready(function () {

                    var $gallery = $('.dgwt-jg-lightbox-photoswipe'),
                        $item = $('.dgwt-jg-item');

                    if ($gallery.length > 0 && $item.length > 0) {
                        $gallery.photoswipe({
                            loop: false,
                            shareButtons: [
                                {
                                    id: 'facebook',
                                    label: 'Share on Facebook',
                                    url: 'https://www.facebook.com/sharer/sharer.php?u={{image_url}}'
                                },
                                {
                                    id: 'twitter',
                                    label: 'Tweet',
                                    url: 'https://twitter.com/intent/tweet?&url={{url}}'
                                },
                                {
                                    id: 'pinterest',
                                    label: 'Pin it',
                                    url: 'http://www.pinterest.com/pin/create/button/?url={{url}}&media={{image_url}}'
                                },
                                {
                                    id: 'download',
                                    label: 'Download image',
                                    url: '{{raw_image_url}}',
                                    download: true
                                }
                            ]
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
        $this->opt = apply_filters( 'dgwt/jg/photoswipe/options', $this->opt );
    }

}