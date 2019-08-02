<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Class DGWT_JG_Lightbox
 */
abstract class DGWT_JG_Lightbox
{
    /**
     * A implementation ID
     * Should be overwritten in the implementation
     * @var string
     */
    protected  $slug = '' ;
    /**
     * Absolute server path to a implementation root.
     * @var string
     */
    protected  $dir = '' ;
    /**
     * Absolute URL to assets for a implementation
     * @var string
     */
    protected  $assets_url = '' ;
    public function __construct()
    {
        $this->dir = dirname( __FILE__ ) . '/' . $this->slug;
        $this->assets_url = DGWT_JG_URL . 'includes/Lightbox/' . $this->slug . '/assets';
        $this->load();
    }
    
    /**
     * Add actions or filters
     *
     * @return null
     */
    private function load()
    {
        add_action( 'wp_footer', array( $this, 'include_libs' ), 5 );
        add_action( 'wp_footer', array( $this, 'gallery_init' ), 90 );
        add_action( 'admin_footer', array( $this, 'include_libs' ), 5 );
        add_action( 'admin_footer', array( $this, 'gallery_init' ), 90 );
    }
    
    /**
     * Place to write raw JS which initiates Lightbox
     * Should be overwritten in the implementation
     *
     * @return null | echo JS body
     */
    public function gallery_js()
    {
    }
    
    /**
     * Include CSS and JS libraries
     * Should be overwritten in the implementation
     */
    public function include_libs()
    {
    }
    
    /**
     * Print JS
     *
     * @return null | echo minified JS code to footer
     */
    public function gallery_init()
    {
        if ( !$this->can_load() ) {
            return false;
        }
        ob_start();
        if ( !dgwt_freemius()->is_premium() ) {
            $this->gallery_js();
        }
        $js = DGWT_JG_Helpers::minify_js( ob_get_clean() );
        echo  $js ;
    }
    
    /**
     * Check if can load resources
     * @return bool
     */
    protected function can_load()
    {
        $load_on_frontend = in_array( strtolower( $this->slug ), DGWT_JG()->gallery->get_lightboxes_to_load() );
        $load_on_backend = DGWT_JG_Helpers::is_settings_page();
        return $load_on_frontend || $load_on_backend;
    }

}