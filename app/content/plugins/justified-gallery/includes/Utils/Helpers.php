<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class DGWT_JG_Helpers {

	/*
	 * Minify JS
	 *
	 * @see https://gist.github.com/tovic/d7b310dea3b33e4732c0
	 *
	 * @param string
	 * @return string
	 */

	public static function minify_js( $input ) {

		if ( defined( 'DGWT_JG_DEBUG' ) && DGWT_JG_DEBUG ) {
			return $input;
		}

		if ( trim( $input ) === "" ) {
			return $input;
		}

		return preg_replace(
			array(
				// Remove comment(s)
				'#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
				// Remove white-space(s) outside the string and regex
				'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
				// Remove the last semicolon
				'#;+\}#',
				// Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
				'#([\{,])([\'])(\d+|[a-z_]\w*)\2(?=\:)#i',
				// --ibid. From `foo['bar']` to `foo.bar`
				'#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i',
				// Replace `true` with `!0`
				'#(?<=return |[=:,\(\[])true\b#',
				// Replace `false` with `!1`
				'#(?<=return |[=:,\(\[])false\b#',
				// Clean up ...
				'#\s*(\/\*|\*\/)\s*#'
			), array(
			'$1',
			'$1$2',
			'}',
			'$1$3',
			'$1.$3',
			'!0',
			'!1',
			'$1'
		), $input );
	}

	/*
	 * Minify CSS
	 *
	 * @see https://gist.github.com/tovic/d7b310dea3b33e4732c0
	 *
	 * @param string
	 * @return string
	 */

	public static function minify_css( $input ) {

		if ( defined( 'DGWT_JG_DEBUG' ) && DGWT_JG_DEBUG ) {
			return $input;
		}

		if ( trim( $input ) === "" ) {
			return $input;
		}
		// Force white-space(s) in `calc()`
		if ( strpos( $input, 'calc(' ) !== false ) {
			$input = preg_replace_callback( '#(?<=[\s:])calc\(\s*(.*?)\s*\)#', function ( $matches ) {
				return 'calc(' . preg_replace( '#\s+#', "\x1A", $matches[1] ) . ')';
			}, $input );
		}

		return preg_replace(
			array(
				// Remove comment(s)
				'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')|\/\*(?!\!)(?>.*?\*\/)|^\s*|\s*$#s',
				// Remove unused white-space(s)
				'#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~+]|\s*+-(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si',
				// Replace `0(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)` with `0`
				'#(?<=[\s:])(0)(cm|em|ex|in|mm|pc|pt|px|vh|vw|%)#si',
				// Replace `:0 0 0 0` with `:0`
				'#:(0\s+0|0\s+0\s+0\s+0)(?=[;\}]|\!important)#i',
				// Replace `background-position:0` with `background-position:0 0`
				'#(background-position):0(?=[;\}])#si',
				// Replace `0.6` with `.6`, but only when preceded by a white-space or `=`, `:`, `,`, `(`, `-`
				'#(?<=[\s=:,\(\-]|&\#32;)0+\.(\d+)#s',
				// Minify string value
				'#(\/\*(?>.*?\*\/))|(?<!content\:)([\'"])([a-z_][-\w]*?)\2(?=[\s\{\}\];,])#si',
				'#(\/\*(?>.*?\*\/))|(\burl\()([\'"])([^\s]+?)\3(\))#si',
				// Minify HEX color code
				'#(?<=[\s=:,\(]\#)([a-f0-6]+)\1([a-f0-6]+)\2([a-f0-6]+)\3#i',
				// Replace `(border|outline):none` with `(border|outline):0`
				'#(?<=[\{;])(border|outline):none(?=[;\}\!])#',
				// Remove empty selector(s)
				'#(\/\*(?>.*?\*\/))|(^|[\{\}])(?:[^\s\{\}]+)\{\}#s',
				'#\x1A#'
			), array(
			'$1',
			'$1$2$3$4$5$6$7',
			'$1',
			':0',
			'$1:0 0',
			'.$1',
			'$1$3',
			'$1$2$4$5',
			'$1$2$3',
			'$1:0',
			'$1$2',
			' '
		), $input );
	}

	/**
	 * Return HTML for the setting section "How to use?"
	 *
	 * @return string HTML
	 */

	public static function how_to_use_html() {

		$html = '';

		ob_start();

		include DGWT_JG_DIR . 'includes/admin/views/how-to-use.php';

		$html .= ob_get_clean();

		return $html;
	}

	/*
	 * Return loupe SVG icon source
	 *
	 * @return string
	 */

	public static function get_loupe_svg() {

		$svg = '<svg version="1.1" class="dgwt-rwpgg-ico-loupe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" fill="#FFFFFF" width="28px" height="28px" viewBox="0 0 51 51" xml:space="preserve">';
		$svg .= '<path d="M51.539,49.356L37.247,35.065c3.273-3.74,5.272-8.623,5.272-13.983c0-11.742-9.518-21.26-21.26-21.26 S0,9.339,0,21.082s9.518,21.26,21.26,21.26c5.361,0,10.244-1.999,13.983-5.272l14.292,14.292L51.539,49.356z M2.835,21.082 c0-10.176,8.249-18.425,18.425-18.425s18.425,8.249,18.425,18.425S31.436,39.507,21.26,39.507S2.835,31.258,2.835,21.082z"/>';
		$svg .= '</svg>';

		return $svg;
	}

	/**
	 * Prepare array to HTML attributes
	 *
	 * @param array
	 *
	 * @return string
	 */
	public static function get_html_atts( $atts ) {

		$output = '';

		if ( ! empty( $atts ) && is_array( $atts ) ) {
			foreach ( $atts as $key => $value ) {
				$output .= ' ' . $key . '=\'' . $value . '\'';
			}
		}

		return $output;
	}

	/**
	 * Get image title
	 *
	 * @param mixed $attachment Attachment ID or object.
	 */
	public static function get_image_title( $attachment ) {
		$caption = '';
		$props   = wp_prepare_attachment_for_js( $attachment );

		if ( ! empty( $props['title'] ) ) {
			$caption = $props['title'];
		}

		return $caption;
	}

	/**
	 * Get image caption
	 *
	 * @param mixed $attachment Attachment ID or object.
	 */
	public static function get_image_caption( $attachment ) {
		$caption = '';
		$props   = wp_prepare_attachment_for_js( $attachment );

		if ( ! empty( $props['caption'] ) ) {
			$caption = $props['caption'];
		}

		return $caption;
	}

	/**
	 * Get image description
	 *
	 * @param mixed $attachment Attachment ID or object.
	 */
	public static function get_image_description( $attachment ) {
		$caption = '';
		$props   = wp_prepare_attachment_for_js( $attachment );

		if ( ! empty( $props['description'] ) ) {
			$caption = $props['description'];
		}

		return $caption;
	}

    /**
     * Get pro icon/label
     */
    public static function get_pro_label($label, $type = 'header')
    {
        $html = '';

        switch ($type) {
            case 'header':
                $html .= '<div class="dgwt-jg-row dgwt-jg-pro-header"><span class="dgwt-jg-pro-label">' . $label . '</span><span class="dgwt-jg-pro-suffix">' . __('Pro', 'justified-gallery') . '</span></div>';
                break;
            case 'option-label':
                $html .= '<div class="dgwt-jg-row dgwt-jg-pro-field"><span class="dgwt-jg-pro-label">' . $label . '</span><span class="dgwt-jg-pro-suffix">' . __('Pro', 'justified-gallery') . '</span></div>';
                break;
        }

        return $html;
    }

    /**
     * Check if is settings page
     * @return bool
     */
    public static function is_settings_page(){
        if(is_admin() && !empty($_GET['page']) && $_GET['page'] === 'dgwt_jg_settings'){
            return true;
        }
        return false;
    }

    /**
     * Check if can display jg
     */
    public static function can_display_jg(){
        $run_jg = false;


        if (!is_admin() && defined('DGWT_JG_DISPLAYED') && DGWT_JG_DISPLAYED === true) {
                $run_jg = true;
        }

        if (self::is_settings_page()) {
            $run_jg = true;
        }

        return $run_jg;

    }

}