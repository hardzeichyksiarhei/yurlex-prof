<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
class DGWT_JG_Gallery
{
    /**
     * Store array with options
     * @var array
     */
    public  $options ;
    public  $active_lightboxes = array() ;
    public  $active_hovers = array() ;
    function __construct()
    {
        $this->set_options();
        add_action( 'template_redirect', array( $this, 'maybe_run_gallery' ), 5 );
        add_action( 'admin_init', array( $this, 'maybe_run_gallery' ) );
    }
    
    public function maybe_run_gallery()
    {
        add_filter(
            'post_gallery',
            array( $this, 'post_gallery' ),
            15,
            3
        );
        add_action( 'wp_footer', array( $this, 'init_gallery' ), 90 );
        add_action( 'admin_footer', array( $this, 'init_gallery' ), 90 );
    }
    
    /**
     * Set options
     *
     * @return null
     */
    public function set_options()
    {
        $this->options = array(
            'show_desc'      => ( DGWT_JG()->settings->get_opt( 'description' ) === 'hide' ? false : true ),
            'last_row'       => $this->get_last_row_behaviour(),
            'margin'         => absint( DGWT_JG()->settings->get_opt( 'margin' ) ),
            'row_height'     => intval( DGWT_JG()->settings->get_opt( 'row_height' ) ),
            'max_row_height' => intval( DGWT_JG()->settings->get_opt( 'max_row_height' ) ),
        );
    }
    
    /**
     * Get the last row behaviour
     * @parram string last_row option
     * @return string | by default: nojustify
     */
    private function get_last_row_behaviour( $last_row = '' )
    {
        $white_list = array(
            'justify',
            'nojustify',
            'hide',
            'right',
            'center'
        );
        
        if ( !empty($last_row) ) {
            $opt = $last_row;
        } else {
            $opt = DGWT_JG()->settings->get_opt( 'last_row' );
        }
        
        
        if ( empty($opt) || !in_array( $opt, $white_list ) ) {
            $last_row = 'nojustify';
        } else {
            $last_row = $opt;
        }
        
        return $last_row;
    }
    
    /**
     * List lightboxes to load
     * @return array
     */
    public function get_lightboxes_to_load()
    {
        return $this->active_lightboxes;
    }
    
    /**
     * List hover effects to load
     * @return array
     */
    public function get_hovers_to_load()
    {
        return $this->active_hovers;
    }
    
    /**
     * Remodel the default gallery shortcode output to compatible with the Justified Gallery.
     *
     * This code will be used instead of generating
     * the default gallery template.
     *
     * @see gallery_shortcode()
     *      wp-includes/media.php
     *
     * @param string $output The gallery output. Default empty.
     * @param array $attr Attributes of the gallery shortcode.
     * @param int $instance Unique numeric ID of this gallery shortcode instance.
     */
    public function post_gallery( $output, $attr, $instance = 0 )
    {
        global  $dgwt_jg_progress, $dgwt_jg_lightboxes, $dgwt_jg_hovers ;
        $dgwt_jg_progress = true;
        // Use bypass
        if ( isset( $attr['bypass'] ) ) {
            return $output;
        }
        $output = '';
        $lightbox = ( !empty($attr['lightbox']) ? strtolower( sanitize_text_field( $attr['lightbox'] ) ) : strtolower( DGWT_JG()->settings->get_opt( 'lightbox', 'none' ) ) );
        $hover_effect = ( !empty($attr['hover']) ? strtolower( sanitize_text_field( $attr['hover'] ) ) : strtolower( DGWT_JG()->settings->get_opt( 'tiles_style', 'none' ) ) );
        $hover_effect = ( $hover_effect === 'JGStandard' || $hover_effect === 'jg_standard' ? 'standard' : $hover_effect );
        if ( !empty($attr['link']) && $attr['link'] === 'none' ) {
            $lightbox = 'none';
        }
        $is_lightbox = !empty($lightbox) && $lightbox !== 'none';
        $is_hover = !empty($hover_effect) && $hover_effect !== 'none';
        $post = get_post();
        do_action( 'dgwt/jg/gallery/shortcode/start', $attr, $instance );
        $attr = apply_filters( 'dgwt/jg/gallery/attr', $attr );
        
        if ( $is_lightbox ) {
            do_action( 'dgwt/jg/gallery/shortcode/start/lightbox=' . $lightbox, $attr, $instance );
            $attr = apply_filters( 'dgwt/jg/gallery/attr/lightbox=' . $lightbox, $attr );
            if ( !in_array( $lightbox, $this->active_lightboxes ) ) {
                $this->active_lightboxes[] = $lightbox;
            }
        }
        
        
        if ( $is_hover ) {
            do_action( 'dgwt/jg/gallery/shortcode/start/hover=' . $hover_effect, $attr, $instance );
            $attr = apply_filters( 'dgwt/jg/gallery/attr/hover=' . $hover_effect, $attr );
            if ( !in_array( $hover_effect, $this->active_hovers ) ) {
                $this->active_hovers[] = $hover_effect;
            }
        }
        
        $atts = shortcode_atts( array(
            'order'        => 'ASC',
            'orderby'      => 'menu_order ID',
            'id'           => ( $post ? $post->ID : 0 ),
            'size'         => 'medium',
            'include'      => '',
            'exclude'      => '',
            'link'         => '',
            'lastrow'      => '',
            'margin'       => 0,
            'rowheight'    => 0,
            'maxrowheight' => 0,
            'demo'         => 0,
            'lightbox'     => $lightbox,
            'hover'        => $hover_effect,
        ), $attr, 'gallery' );
        $id = intval( $atts['id'] );
        
        if ( !empty($atts['include']) ) {
            $_attachments = get_posts( array(
                'include'        => $atts['include'],
                'post_status'    => 'inherit',
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'order'          => $atts['order'],
                'orderby'        => $atts['orderby'],
            ) );
            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($atts['exclude']) ) {
            $attachments = get_children( array(
                'post_parent'    => $id,
                'exclude'        => $atts['exclude'],
                'post_status'    => 'inherit',
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'order'          => $atts['order'],
                'orderby'        => $atts['orderby'],
            ) );
        } else {
            $attachments = get_children( array(
                'post_parent'    => $id,
                'post_status'    => 'inherit',
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'order'          => $atts['order'],
                'orderby'        => $atts['orderby'],
            ) );
        }
        
        // There are no a attachments, return empty value
        if ( empty($attachments) && empty($atts['demo']) ) {
            return $output;
        }
        
        if ( !empty($atts['demo']) ) {
            $attachments = array();
            for ( $i = 0 ;  $i < 3 ;  $i++ ) {
                $attachments[$i] = new stdClass();
                $attachments[$i]->ID = 0;
            }
        }
        
        
        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment ) {
                $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
            }
            return $output;
        }
        
        $selector = 'dgwt-jg-' . absint( $instance );
        $fancybox_class = ( !empty($lightbox) ? ' dgwt-jg-lightbox-' . $lightbox : '' );
        $hover_class = ( !empty($lightbox) ? ' dgwt-jg-effect-' . $hover_effect : '' );
        $gallery_atts = array(
            'class'               => 'dgwt-jg-gallery ' . $selector . $fancybox_class . $hover_class,
            'data-last_row'       => $this->get_last_row_behaviour( $atts['lastrow'] ),
            'data-margin'         => ( !empty($atts['margin']) ? absint( $atts['margin'] ) : $this->options['margin'] ),
            'data-row_height'     => ( !empty($atts['rowheight']) ? intval( $atts['rowheight'] ) : $this->options['row_height'] ),
            'data-max_row_height' => ( !empty($atts['maxrowheight']) ? absint( $atts['maxrowheight'] ) : $this->options['max_row_height'] ),
        );
        $gallery_atts = apply_filters( 'dgwt/jg/gallery/atts', $gallery_atts, $instance );
        if ( $is_lightbox ) {
            $gallery_atts = apply_filters( 'dgwt/jg/gallery/atts/lightbox=' . $lightbox, $gallery_atts, $instance );
        }
        if ( $is_hover ) {
            $gallery_atts = apply_filters( 'dgwt/jg/gallery/atts/hover=' . $hover_effect, $gallery_atts, $instance );
        }
        $output = '<div id="' . $selector . '"' . DGWT_JG_Helpers::get_html_atts( $gallery_atts ) . '>';
        $image_counter = 1;
        foreach ( $attachments as $img_id => $attachment ) {
            $figure_atts = array(
                'class' => 'dgwt-jg-item',
            );
            // data-size attr
            $meta = wp_get_attachment_metadata( $attachment->ID );
            
            if ( !empty($meta['width']) ) {
                $size = $meta['width'] . 'x' . $meta['height'];
                $figure_atts['data-size'] = $size;
            }
            
            $image_link = get_permalink( $attachment->ID );
            
            if ( !empty($atts['link']) ) {
                if ( $atts['link'] === 'file' ) {
                    $image_link = wp_get_attachment_url( $attachment->ID );
                }
                if ( $atts['link'] === 'none' ) {
                    $image_link = '';
                }
            } else {
                if ( $is_lightbox ) {
                    $image_link = wp_get_attachment_url( $attachment->ID );
                }
            }
            
            $figure_atts = apply_filters(
                'dgwt/jg/gallery/tile_atts',
                $figure_atts,
                $attachment,
                $atts,
                $instance,
                $image_counter
            );
            if ( $is_lightbox ) {
                $figure_atts = apply_filters(
                    'dgwt/jg/gallery/tile_atts/lightbox=' . $lightbox,
                    $figure_atts,
                    $attachment,
                    $atts,
                    $instance,
                    $image_counter
                );
            }
            if ( $is_hover ) {
                $figure_atts = apply_filters(
                    'dgwt/jg/gallery/tile_atts/hover=' . $hover_effect,
                    $figure_atts,
                    $attachment,
                    $atts,
                    $instance,
                    $image_counter
                );
            }
            $output .= '<figure ' . DGWT_JG_Helpers::get_html_atts( $figure_atts ) . '>';
            // Link <a>
            $link_atts = array(
                'href' => $image_link,
            );
            if ( $is_lightbox ) {
                $link_atts = apply_filters(
                    'dgwt/jg/gallery/link_atts/lightbox=' . $lightbox,
                    $link_atts,
                    $attachment,
                    $atts,
                    $instance,
                    $image_counter
                );
            }
            if ( !empty($link_atts['href']) ) {
                $output .= '<a ' . DGWT_JG_Helpers::get_html_atts( $link_atts ) . '>';
            }
            $html_img = '';
            $meta = wp_get_attachment_metadata( $attachment->ID, true );
            if ( !empty($meta['width']) && !empty($meta['height']) ) {
                $html_img = self::wp_get_attachment_image(
                    $img_id,
                    $atts['size'],
                    $meta['width'],
                    $meta['height']
                );
            }
            $html_img = apply_filters(
                'dgwt/jg/gallery/html_img',
                $html_img,
                $attachment,
                $atts,
                $instance,
                $image_counter
            );
            if ( $is_lightbox ) {
                $html_img = apply_filters(
                    'dgwt/jg/gallery/html_img/lightbox=' . $lightbox,
                    $html_img,
                    $attachment,
                    $atts,
                    $instance,
                    $image_counter
                );
            }
            if ( $is_hover ) {
                $html_img = apply_filters(
                    'dgwt/jg/gallery/html_img/hover=' . $hover_effect,
                    $html_img,
                    $attachment,
                    $atts,
                    $instance,
                    $image_counter
                );
            }
            $output .= $html_img;
            $tile_caption = apply_filters(
                'dgwt/jg/gallery/tile_caption',
                '',
                $attachment,
                $instance
            );
            if ( $is_hover ) {
                $tile_caption = apply_filters(
                    'dgwt/jg/gallery/tile_caption/hover=' . $hover_effect,
                    $tile_caption,
                    $attachment,
                    $instance
                );
            }
            $output .= $tile_caption;
            if ( !empty($image_link) ) {
                $output .= '</a>';
            }
            $output .= '</figure>';
            $image_counter++;
        }
        $output .= "</div>\n";
        do_action( 'dgwt/jg/gallery/shortcode/end', $attr, $instance );
        if ( $is_lightbox ) {
            do_action( 'dgwt/jg/gallery/shortcode/end/lightbox=' . $lightbox, $attr, $instance );
        }
        if ( $is_hover ) {
            do_action( 'dgwt/jg/gallery/shortcode/end/hover=' . $hover_effect, $attr, $instance );
        }
        $dgwt_jg_progress = false;
        return $output;
    }
    
    static function wp_get_attachment_image(
        $attachment_id,
        $size = array(),
        $img_width,
        $img_height,
        $attr = array()
    )
    {
        $html = '';
        $image = wp_get_attachment_image_src( $attachment_id, $size );
        
        if ( $image ) {
            list( $src, $width, $height ) = $image;
            $img_tag_open = '<img';
            $default_attr = array(
                'src' => $src,
                'alt' => trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) ),
            );
            $attr = wp_parse_args( $attr, $default_attr );
            // Generate 'srcset' and 'sizes' if not already present.
            
            if ( empty($attr['srcset']) ) {
                $image_meta = wp_get_attachment_metadata( $attachment_id );
                
                if ( is_array( $image_meta ) ) {
                    $size_array = array( absint( $width ), absint( $height ) );
                    $srcset = wp_calculate_image_srcset(
                        $size_array,
                        $src,
                        $image_meta,
                        $attachment_id
                    );
                    $sizes = wp_calculate_image_sizes(
                        $size_array,
                        $src,
                        $image_meta,
                        $attachment_id
                    );
                    
                    if ( $srcset && ($sizes || !empty($attr['sizes'])) ) {
                        $attr['srcset'] = $srcset;
                        if ( empty($attr['sizes']) ) {
                            $attr['sizes'] = $sizes;
                        }
                    }
                
                }
            
            }
            
            $attr = array_map( 'esc_attr', $attr );
            $html = $img_tag_open;
            foreach ( $attr as $name => $value ) {
                if ( $name == 'srcset' ) {
                    $name = 'data-jg-srcset';
                }
                // Srcset is not available? Try to use full size.
                
                if ( (empty($attr['srcset']) || empty($attr['sizes'])) && $name === 'src' ) {
                    $image = wp_get_attachment_image_src( $attachment_id, 'full' );
                    if ( !empty($image[0]) ) {
                        $value = $image[0];
                    }
                }
                
                if ( !empty($value) ) {
                    $html .= " {$name}=" . '"' . $value . '"';
                }
            }
            $html .= ' />';
        }
        
        if ( !empty($html) && !defined( 'DGWT_JG_DISPLAYED' ) ) {
            define( 'DGWT_JG_DISPLAYED', true );
        }
        return $html;
    }
    
    /**
     * Inject JavaScript code to init Justified Gallery
     *
     * @return null | echo minified JS code
     */
    public function init_gallery()
    {
        if ( !DGWT_JG_Helpers::can_display_jg() ) {
            return;
        }
        ob_start();
        ?>
        <script type="text/javascript">

            ( function ($) {
                    $(document).ready(function () {


                        var $gallery = $('.dgwt-jg-gallery'),
                            $item = $('.dgwt-jg-item');

                        if ($gallery.length > 0 && $item.length > 0) {

                            $gallery.each(function () {
                                $(this).justifiedGallery({
                                    lastRow: $(this).attr('data-last_row'),
                                    captions: false,
                                    selector: 'figure, div:not(.spinner)',
                                    margins: $(this).attr('data-margin'),
                                    rowHeight: $(this).attr('data-row_height'),
                                    maxRowHeight: $(this).attr('data-max_row_height'),
                                    <?php 
        ?>
                                    thumbnailPath: function (currentPath, width, height, image) {

                                        if (typeof $(image).data('jg-srcset') === 'undefined') {
                                            return currentPath;
                                        }

                                        var srcset = $(image).data('jg-srcset');

                                        if ($(image).length > 0 && srcset.length > 0) {
                                            var newPath,
                                                sizes = [],
                                                sizesTemp = [],
                                                urls = srcset.split(",");

                                            if (urls.length > 0) {
                                                for (i = 0; i < urls.length; i++) {
                                                    var url, sizeW,
                                                        item = urls[i].trim().split(" ");

                                                    if (typeof item[0] != 'undefined' && typeof item[1] != 'undefined') {
                                                        var sizeW = item[1].replace('w', '');
                                                        sizesTemp[sizeW] = {
                                                            'width': item[1].replace('w', ''),
                                                            'url': item[0]
                                                        };
                                                    }
                                                }

                                                for (i = 0; i < sizesTemp.length; i++) {
                                                    if (sizesTemp[i]) {
                                                        sizes.push(sizesTemp[i])
                                                    }
                                                }
                                            }

                                            newPath = sizes[sizes.length - 1].url;

                                            for (i = 0; i < sizes.length; i++) {

                                                if (sizes[i].width >= width) {

                                                    newPath = sizes[i].url
                                                    break;
                                                }

                                            }

                                            return newPath;

                                        } else {
                                            return currentPath;
                                        }
                                    }
                                })
                                    .on('jg.complete', function (e) {

                                        <?php 
        do_action( 'dgwt/jg/js/gallery/complete' );
        ?>

                                    }); // END .on method

                            });

                        }

                    });

                }(jQuery)
            )
        </script>
        <?php 
        $js = DGWT_JG_Helpers::minify_js( ob_get_clean() );
        echo  $js ;
    }

}