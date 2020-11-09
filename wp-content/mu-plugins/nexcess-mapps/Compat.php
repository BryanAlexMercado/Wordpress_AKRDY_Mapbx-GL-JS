<?php
/**
 * Add useful functions that have yet to ship in WordPress core.
 */

/**
 * DateTime improvements shipping in WordPress 5.3.
 *
 * @link https://make.wordpress.org/core/2019/09/23/date-time-improvements-wp-5-3/
 */
if ( ! function_exists( 'current_datetime' ) ) {
	/**
	 * Retrieves the current time as an object with the timezone from settings.
	 *
	 * @since 5.3.0
	 *
	 * @return DateTimeImmutable Date and time object.
	 */
	function current_datetime() {
		return new DateTimeImmutable( 'now', wp_timezone() );
	}
}

if ( ! function_exists( 'wp_timezone' ) ) {
	/**
	 * Retrieves the timezone from site settings as a `DateTimeZone` object.
	 *
	 * Timezone can be based on a PHP timezone string or a ±HH:MM offset.
	 *
	 * @since 5.3.0
	 *
	 * @return DateTimeZone Timezone object.
	 */
	function wp_timezone() {
		return new DateTimeZone( wp_timezone_string() );
	}
}

if ( ! function_exists( 'wp_timezone_string' ) ) {
	/**
	 * Retrieves the timezone from site settings as a string.
	 *
	 * Uses the `timezone_string` option to get a proper timezone if available,
	 * otherwise falls back to an offset.
	 *
	 * @since 5.3.0
	 *
	 * @return string PHP timezone string or a ±HH:MM offset.
	 */
	function wp_timezone_string() {
		$timezone_string = get_option( 'timezone_string' );

		if ( $timezone_string ) {
			return $timezone_string;
		}

		$offset  = (float) get_option( 'gmt_offset' );
		$hours   = (int) $offset;
		$minutes = ( $offset - $hours );

		$sign      = ( $offset < 0 ) ? '-' : '+';
		$abs_hour  = abs( $hours );
		$abs_mins  = abs( $minutes * 60 );
		$tz_offset = sprintf( '%s%02d:%02d', $sign, $abs_hour, $abs_mins );

		return $tz_offset;
	}
}

/**
 * WordPress may never define time constants based in minutes, but this makes expressing time
 * much cleaner.
 *
 * Borrowed from https://github.com/stevegrunwell/time-constants
 */
if ( ! defined( 'HOUR_IN_MINUTES' ) ) {
	define( 'HOUR_IN_MINUTES', 60 );
}

if ( ! defined( 'DAY_IN_MINUTES' ) ) {
	define( 'DAY_IN_MINUTES', 24 * HOUR_IN_MINUTES );
}
