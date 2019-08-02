<?php

/**
 * Setup theme
 */
function urlex_setup() {

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );

	// Remove Admin Bar 
	add_filter('show_admin_bar', '__return_false'); 

	// Remove Emoji 
	remove_action('wp_head', 'print_emoji_detection_script', 7); 
	remove_action('wp_print_styles', 'print_emoji_styles');
  
  /**
	 * Register Nav Menu
	 */
  register_nav_menu( 'primary', 'Primary Menu' );
  register_nav_menu( 'footer_main', 'Footer Main Menu' );
  register_nav_menu( 'footer_second', 'Footer Second Menu' );

}

add_action( 'after_setup_theme', 'urlex_setup' );

// Удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'urlex_navigation_template', 10, 2 );

function urlex_navigation_template( $template, $class ){
	return '
    <nav class="navigation %1$s" role="navigation">
      <div class="nav-links">%3$s</div>
    </nav>    
	';
}

/**
 * Is search page (Mark text)
 */
function urlex_mark_results($text){
	if(is_search()){
		$keys = implode('|', explode(' ', get_search_query()));
		$text = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $text);
	}
	return $text;
}
add_filter('get_the_excerpt', 'urlex_mark_results');
add_filter('the_title', 'urlex_mark_results');

add_filter('style_loader_tag', 'urlex_remove_type_attr', 10, 2); 
add_filter('script_loader_tag', 'urlex_remove_type_attr', 10, 2); 

function urlex_remove_type_attr($tag, $handle) { 
	return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag ); 
}