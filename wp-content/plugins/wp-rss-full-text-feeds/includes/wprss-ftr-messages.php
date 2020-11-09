<?php


/**
 * Message for WordPress version not being suitable
 *
 * @since 1.0
 */
function wprss_ftr_min_wp_msg() {
    $msg = sprintf(
			__("The <b>WP RSS Aggregator - Full Text RSS</b> add-on requires WordPress version <b>%s</b> or higher", 'wprss'),
			WPRSS_FTR_WP_MIN_VERSION
		);

    echo "<div class='notice notice-error'><p>" . $msg . "</p></div>";
}


/**
 * Message for WP RSS Aggregator core not present, or version too low.
 *
 * @since 1.0
 */
function wprss_ftr_min_core_msg() {
	$msg = sprintf(
			__("The <b>WP RSS Aggregator - Full Text RSS</b> add-on requires the <b>WP RSS Aggregator</b> plugin to be installed and activated, at version <b>%s</b> or higher.", 'wprss'),
			WPRSS_FTR_CORE_MIN_VERSION
		);

	echo "<div class='notice notice-error'><p>" . $msg . "</p></div>";
}


/**
 * Message for WP RSS Aggregator Feed to Post not present, or version too low.
 *
 * @since 1.0
 */
function wprss_ftr_min_ftp_msg() {
	$msg = sprintf(
			__("The <b>WP RSS Aggregator - Full Text RSS</b> add-on requires the <b>WP RSS Aggregator - Feed to Post</b> plugin to be installed and activated, at version <b>%s</b> or higher.", 'wprss'),
			WPRSS_FTR_FTP_MIN_VERSION
		);

	echo "<div class='notice notice-error'><p>" . $msg . "</p></div>";
}

/**
 * Message for license key not active when Full Text RSS add-on is selected as the Full Text RSS service to be used.
 *
 * @since 1.0
 */
function wprss_ftr_license_msg() {
	$msg = __("The license key for the <b>WP RSS Aggregator - Full Text RSS</b> add-on is not activated. Without an activated license, the add-on will not be able to import full content for your RSS feeds. ", 'wprss');
	$link = "<a href='" . esc_attr(admin_url( 'edit.php?post_type=wprss_feed&page=wprss-aggregator-settings&tab=licenses_settings' )) . "'>" .
		__("Activate your license key", 'wprss') .
		"</a>";

	echo "<div class='notice notice-error'><p>" . $msg . $link . "</p></div>";
}
