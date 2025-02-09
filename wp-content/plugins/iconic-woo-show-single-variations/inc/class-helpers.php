<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Iconic_WSSV_Helpers.
 *
 * @class    Iconic_WSSV_Helpers
 * @version  1.0.0
 * @author   Iconic
 */
class Iconic_WSSV_Helpers {
	/**
	 * Converts a string (e.g. yes or no) to a bool.
	 *
	 * @since 3.0.0
	 *
	 * @param string $string
	 *
	 * @return bool
	 */
	public static function string_to_bool( $string ) {
		return is_bool( $string ) ? $string : ( 'yes' === $string || 1 === $string || 'true' === $string || '1' === $string );
	}

	/**
	 * Get allowed HTML for title fields.
	 *
	 * @return array
	 */
	public static function wp_kses_allowed_html_title() {
		$allowed_html = wp_kses_allowed_html();
		$allowed_html['br'] = array();
		$allowed_html['span'] = array();

		return $allowed_html;
	}
}