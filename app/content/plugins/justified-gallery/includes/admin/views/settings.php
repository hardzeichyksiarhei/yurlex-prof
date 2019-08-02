<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap<?php echo !dgwt_freemius()->is_premium() ? ' dgora-jg-free-version' : 'dgora-jg-pro-version'; ?>">

    <h2><?php _e( 'Justified Gallery Settings', 'justified-gallery' ); ?></h2>

	<?php

	if (!dgwt_freemius()->is_premium()) {

		$install_date = get_option( 'dgwt_jg_activation_date' );
		$outdated     = empty( $install_date ) || absint( $install_date ) + ( 60 * 60 * 24 * 5 ) < time();

		if ( ! get_option( 'dgwt_jg_dismiss_how_to_use_notice' ) && ! $outdated ) {
			echo DGWT_JG_Helpers::how_to_use_html();
		}

	}
    ?>

	<?php $settings->show_navigation(); ?>
	<?php $settings->show_forms(); ?>

    <small class="dgora-jg-copy"><?php _e('All photos on previews are from Unsplash.com and licensed under Creative Commons Zero.', 'justified-gallery'); ?></small>
</div>