<?php
if ( ! defined( 'WPINC' ) ) {
	wp_die();
}

/**
 * Class Iconic_WLV_Settings
 */
class Iconic_WLV_Settings {
	/**
	 * Run.
	 */
	public static function run() {
		add_filter( 'wpsf_show_save_changes_button_iconic_wlv', '__return_false' );
		add_filter( 'wpsf_show_tab_links_iconic_wlv', '__return_false' );
	}
}