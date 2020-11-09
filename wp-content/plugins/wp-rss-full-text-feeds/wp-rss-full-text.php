<?php

/**
 * Plugin Name: WP RSS Aggregator - Full Text RSS Feeds
 * Plugin URI: https://www.wprssaggregator.com/#utm_source=wpadmin&utm_medium=plugin&utm_campaign=wpraplugin
 * Description: Adds a premium, unlimited full text RSS service, provided by WP RSS Aggregator, to Feed to Post.
 * Version: 1.3.2
 * Author: RebelCode
 * Author URI: https://www.wprssaggregator.com
 * Text Domain: wprss
 * Domain Path: /languages/
 * License: GPLv3
 */

/**
 * Copyright (C) 2012-2016 RebelCode Ltd.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// Plugin Version
if (!defined('WPRSS_FTR_VERSION')) {
    define('WPRSS_FTR_VERSION', '1.3.2');
}

// EDD Licensing Item Name
if (!defined('WPRSS_FTR_SL_ITEM_NAME')) {
    define('WPRSS_FTR_SL_ITEM_NAME', 'Full Text RSS Feeds');
}
// EDD Licensing Server
if (!defined('WPRSS_FTR_SL_STORE_URL')) {
    define('WPRSS_FTR_SL_STORE_URL', 'https://www.wprssaggregator.com/edd-sl-api/');
}

// WordPress Minimum Required Version
if (!defined('WPRSS_FTR_WP_MIN_VERSION')) {
    define('WPRSS_FTR_WP_MIN_VERSION', '3.7');
}
// WP RSS Aggregator Core Minimum Required Version
if (!defined('WPRSS_FTR_CORE_MIN_VERSION')) {
    define('WPRSS_FTR_CORE_MIN_VERSION', '4.8');
}
// Feed to Post Minimum Required Version
if (!defined('WPRSS_FTR_FTP_MIN_VERSION')) {
    define('WPRSS_FTR_FTP_MIN_VERSION', '2.9.4');
}

// Plugin File
if (!defined('WPRSS_FTR_PATH')) {
    define('WPRSS_FTR_PATH', __FILE__);
}
// Set constant path to the plugin directory.
if (!defined('WPRSS_FTR_DIR')) {
    define('WPRSS_FTR_DIR', plugin_dir_path(__FILE__));
}
// Set constant URI to the plugin URL.
if (!defined('WPRSS_FTR_URI')) {
    define('WPRSS_FTR_URI', plugin_dir_url(__FILE__));
}

// Includes Directory
if (!defined('WPRSS_FTR_INC')) {
    define('WPRSS_FTR_INC', WPRSS_FTR_DIR . trailingslashit('includes'));
}

// Full Text RSS
if (!defined('WPRSS_FTR_FULL_TEXT_URL')) {
    define('WPRSS_FTR_FULL_TEXT_URL',
        'http://fulltext-premium.wprssaggregator.com/makefulltextfeed.php?url={{url}}&license={{license}}&site={{site}}');
}



// Adding autoload paths
add_action('plugins_loaded', function () {
    // Admin Messages & Notices
    require WPRSS_FTR_INC . 'wprss-ftr-messages.php';

    // Check WordPress Minimum Version
    if (version_compare(get_bloginfo('version'), WPRSS_FTR_WP_MIN_VERSION, '<')) {
        // Show the message
        add_action('admin_notices', 'wprss_ftr_min_wp_msg');

        return;
    }

    $coreActive = defined('WPRSS_VERSION');
    $f2pActive = defined('WPRSS_FTP_VERSION');

    if (!$coreActive || version_compare(WPRSS_VERSION, WPRSS_FTR_CORE_MIN_VERSION, '<')) {
        add_action('admin_notices', 'wprss_ftr_min_core_msg');
        return;
    }

    if (!$f2pActive || version_compare(WPRSS_FTP_VERSION, WPRSS_FTR_FTP_MIN_VERSION, '<')) {
        add_action('admin_notices', 'wprss_ftr_min_ftp_msg');
        return;
    }

    // Set the "active" constant based on whether core is loaded
    define('WPRSS_FTR_ACTIVE', true);

    // Load licensing loader file
    require WPRSS_FTR_INC . 'wprss-ftr-main.php';

    // Load licensing loader file
    require WPRSS_FTR_INC . 'licensing.php';

    // Create the singleton instance
    $wprss_ftr = WPRSS_FTR::instance();

    wprss_autoloader()->add('Aventura\\Wprss\\FullTextFeeds', WPRSS_FTR_INC);

    $wprss_ftr->init();
    $wprss_ftr->load_textdomain();

    $activation_transient = get_transient('wprss_ftr_just_activated');
    if ($activation_transient === 'true') {
        // Delete it
        delete_transient('wprss_ftr_just_activated');
        // Update the full text option
        $wprss_ftr->update_full_text_option();
    }

    // Check license key
    add_action('admin_init', array($wprss_ftr, 'check_license'), 15);

    // Full Text RSS URL Changer
    add_filter('wprss_ftp_service_before_full_text_feed_url', array($wprss_ftr, 'before_full_text_url'));
    add_filter('wprss_ftp_misc_full_text_url', array($wprss_ftr, 'full_text_url'), 10, 3);
});

// Activation action
register_activation_hook(__FILE__, 'wprss_ftr_activate');
function wprss_ftr_activate() {
    // Set a transient to signal for activation
    set_transient('wprss_ftr_just_activated', 'true', 30);
}
