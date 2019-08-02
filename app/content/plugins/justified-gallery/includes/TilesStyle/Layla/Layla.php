<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Tiles style: Layla
 */
class DGWT_JG_TilesStyle_Layla extends DGWT_JG_TilesStyle
{
    public  $slug = 'Layla' ;
    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    private function init()
    {
        
        if ( !DGWT_JG()->detector->isMobile() && !DGWT_JG()->detector->isTablet() ) {
            add_filter(
                'dgwt/jg/gallery/tile_caption/hover=layla',
                array( $this, 'get_caption_html' ),
                10,
                2
            );
            
            if ( !dgwt_freemius()->is_premium() ) {
                add_action( 'wp_footer', array( $this, 'add_css_style' ), 95 );
                add_action( 'admin_footer', array( $this, 'add_css_style' ), 95 );
            }
        
        }
        
        if ( is_admin() ) {
            new DGWT_JG_Layla_Admin( $this->assets_url );
        }
    }
    
    /**
     * Prepare caption html
     *
     * @param string $caption
     * @param object $attachment
     *
     * @return null
     */
    public function get_caption_html( $caption, $attachment )
    {
        $label = trim( DGWT_JG_Helpers::get_image_caption( $attachment ) );
        if ( !dgwt_freemius()->is_premium() ) {
            
            if ( empty($label) ) {
                $label = file_get_contents( DGWT_JG_DIR . 'assets/img/plus-29.svg' );
                $caption_class = 'dgwt-jg-caption__icon';
            } else {
                $caption_class = 'dgwt-jg-caption__font--10';
            }
        
        }
        $caption = '';
        $caption .= '<figcaption class="dgwt-jg-caption">';
        $caption .= '<span class="' . $caption_class . '">' . $label . '</span>';
        $caption .= '</figcaption>';
        return $caption;
    }
    
    public function add_css_style()
    {
        if ( !$this->can_load() ) {
            return;
        }
        ob_start();
        ?>
        <style>
            .dgwt-jg-gallery.dgwt-jg-effect-layla .entry-visible.dgwt-jg-item {
                background-color: #000000;
            }

            .dgwt-jg-effect-layla .dgwt-jg-item:hover img {
                opacity: 0.4;
            }

            .dgwt-jg-effect-layla .dgwt-jg-item .dgwt-jg-caption > span {
                color: #FFFFFF;
            }

            .dgwt-jg-caption__icon svg line {
                stroke: #FFFFFF;
            }

            .dgwt-jg-effect-layla .dgwt-jg-item figcaption::before,
            .dgwt-jg-effect-layla .dgwt-jg-item figcaption::after {
                border-color: #FFFFFF;
            }
        </style>
		<?php 
        $css = DGWT_JG_Helpers::minify_css( ob_get_clean() );
        echo  $css ;
    }
    
    /**
     * @inheritdoc
     */
    public function css_style()
    {
        if ( !$this->can_load() ) {
            return;
        }
        wp_enqueue_style(
            'dgwt-tiles-layla',
            $this->assets_url . '/style.css',
            array(),
            DGWT_JG_VERSION
        );
    }

}