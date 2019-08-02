<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="how-to-use">
    <div class="dgwt-jg-review-notice">
        <div class="dgwt-jg-review-notice-logo"></div>
        <h3><?php _e( 'A few words after the first installation.', 'justified-gallery'); ?></h3>
        <p><?php printf(__( 'Justified Gallery uses <a target="_blank" href="%s">native WordPress galleries</a>. It means that the plugin works out of the box.', 'ajax-search-for-woocommerce' ), 'https://codex.wordpress.org/The_WordPress_Gallery'); ?></p>
        <p><?php _e(' This plugin does exactly two things:', 'justified-gallery'); ?></p>
        <p>
            &nbsp; 1. <?php _e('Turns obsolete and ugly native WordPress galleries into the <b>responsive and high quality galleries with justified image grid', 'justified-gallery'); ?></b></li>
            <br/>
            &nbsp; 2. <?php _e('Adds modern lightboxes for them', 'justified-gallery'); ?></li>
        </p>
        <br>
        <p><?php printf(__('Furthermore, if you are eg a <b>photographer</b> and publish <b>large galleries</b> (+50 photos per page), you may be interested in the optimizing the loading time of galleries. With <a href="%s">the premium version</a>, inter alia, you speed up galleries load time even up to <b>20 times</b>.', 'justified-gallery'), admin_url('admin.php?page=dgwt_jg_settings-pricing')); ?></p>
        <br>
        <div class="button-container">
            <a href="#" class="button-secondary dgwt-how-it-works-dismiss">
                <span class="dashicons dashicons-yes"></span>
				<?php _e("I know how it works. Hide this notice", 'justified-gallery'); ?>
            </a>
        </div>
        <span class="how-to-use-close dgwt-how-it-works-dismiss"><span class="dashicons dashicons-no-alt"></span></span>
    </div>

    <script>
        (function ($) {

            $( document ).on( 'click', '.dgwt-how-it-works-dismiss', function () {
                var $box = $( this ).closest( '.how-to-use' );

                $box.fadeOut( 700 );

                $.ajax( {
                    url: ajaxurl,
                    data: {
                        action: 'dgwt_jg_dismiss_how_to_use',
                    }
                } ).done( function ( data ) {

                    setTimeout(function(){
                        $box.remove();
                    }, 700);

                } );
            } );

        }(jQuery));
    </script>

</div>