<?php

// Settings
require __DIR__ . '/wprss-ftr-settings.php';

/**
 * WPRSS Full Text RSS Plugin Class.
 * The class is meant to be used as a singleton instance. The singleton is
 * instantiated automatically, and can be retrieved using the ::instance()
 * method.
 *
 * @since      1.0
 * @package    WP RSS Aggregator
 * @subpackage Full Text RSS
 */
class WPRSS_FTR
{
    /**
     * The singleton instance
     *
     * @type WPRSS_FTR
     */
    protected static $instance = null;

    /**
     * The settings singleton instance
     *
     * @type WPRSS_FTR_Settings
     */
    protected static $settings = null;

    /**
     * Constructor
     *
     * @since 1.0
     */
    public function __construct()
    {
        // Check the singleton instance
        if (self::$instance !== null) {
            wp_die(__('WPRSS_FTR class is singleton class, and cannot be instantiated more than once!',
                'wprss'));
        }
    }

    // Initialize other classes
    public function init()
    {
        self::$settings = WPRSS_FTR_Settings::instance();
    }

    /**
     * Returns the singleton instance
     *
     * @since 1.0
     * @return WPRSS_FTR The singleton instance
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new WPRSS_FTR();
        }

        return self::$instance;
    }

    /**
     * Updates the full text option in Feed to Post.
     */
    public function update_full_text_option()
    {
        $f2p_options = get_option(WPRSS_FTP_Settings::OPTIONS_NAME,
            WPRSS_FTP_Settings::get_instance()->get_defaults(), true);

        // Set the full text rss service to use the premium service, and update the option
        $f2p_options['full_text_rss_service'] = 'ftpr';

        update_option(WPRSS_FTP_Settings::OPTIONS_NAME, $f2p_options);
    }

    /**
     * Loads the plugin's translated strings.
     *
     * @since  1.2.3
     * @return void
     */
    public function load_textdomain()
    {
        load_plugin_textdomain(WPRSS_TEXT_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Checks if the license is saved and activated and if the add-on is selected as the full text
     * service to be used.
     *
     * @since 1.2.3
     */
    public function check_license()
    {
        // If class does not exist, then Feed to Post is not activated
        if (!class_exists('WPRSS_FTP_Settings')) {
            // Show the message and exit
            add_action('admin_notices', 'wprss_ftr_min_ftp_msg');

            return;
        }
        $service = WPRSS_FTP_Settings::get_instance()->get('full_text_rss_service');
        $license = wprss_licensing_get_manager()->getLicense('ftr');
        if ($service === 'ftpr' && (!$license || $license->getStatus() !== 'valid')) {
            add_action('admin_notices', 'wprss_ftr_license_msg');
        }
    }

    /**
     * This function is called to filter the full text rss service, before the
     * service is used.
     *
     * If using the premium service, but the license is not active, then the service
     * is temporarily changed to the free services.
     */
    public function before_full_text_url($service)
    {
        $service = WPRSS_FTP_Settings::get_instance()->get('full_text_rss_service');
        $status = wprss_licensing_get_manager()->getLicense('ftr')->getStatus();
        if ($service === 'ftpr' && $status !== 'valid') {
            wprss_log('Full Text RSS Feeds license key is not active! Temporarily ssing the free services instead.',
                null, WPRSS_LOG_LEVEL_DEFAULT);

            return 'free';
        }

        return $service;
    }

    /**
     * Changes the given URL into the full text URL
     *
     * @since 1.0
     *
     * @param string     $feed_url The URL of the feed to fetch
     * @param int|string $feed_ID  The ID of the feed source
     *
     * @return string The URL of the full text RSS feed
     */
    public function full_text_url($feed_url, $feed_ID, $service)
    {
        if ($service !== 'ftpr') {
            return $feed_url;
        }

        // Encode the feed URL
        $encoded_url = urlencode($feed_url);
        // Get this license key
        $license_key = $this->get_license_key();
        // Get this site's URL and encode it
        $site_url = urlencode(network_site_url());

        // Generate the URL to the full text rss feed
        $full_text_url = WPRSS_FTP_Utils::template(
            WPRSS_FTR_FULL_TEXT_URL,
            array(
                'url' => $encoded_url,
                'license' => $license_key,
                'site' => $site_url,
            )
        );

        // Attempt to fetch the feed
        $feed = wprss_fetch_feed($full_text_url, $feed_ID);

        // If an error was encountered
        if (is_wp_error($feed) || $feed->error()) {
            // Request the error message and log it
            $error1 = is_wp_error($feed) ? 'WP_Error: ' . $feed->get_error_message() : $feed->error();
            wprss_log("Failed to fetch feed: $full_text_url\n\"{$error1}\"");

            $response = wp_remote_get($full_text_url);
            $error2 = is_wp_error($response) ? 'WP_Error: ' . $response->get_error_message() : $response['body'];
            wprss_log("Full Text RSS Service Error: $full_text_url\n\"{$error2}\"");

            // Return the original parameter url
            return $feed_url;
        }

        // If successful, return the full text RSS feed URL
        return $full_text_url;
    }

    /**
     * Returns an array of the default license settings. Used for plugin activation.
     *
     * @since 1.0
     */
    public function get_default_license_settings()
    {
        // Set up the default license settings
        $settings = apply_filters(
            'wprss_ftr_get_default_settings_licenses',
            array(
                'ftr_license_key' => '',
                'ftr_license_status' => 'invalid',
            )
        );

        // Return the default settings
        return $settings;
    }

    /**
     * Returns the saved license code.
     *
     * @since 1.0
     */
    public function get_license_key()
    {
        return wprss_licensing_get_manager()->getLicense('ftr')->getKey();
    }

    /**
     * Returns the saved license code.
     *
     * @since 1.0
     */
    public function get_license_status_from_db()
    {
        return wprss_licensing_get_manager()->getLicense('ftr')->getStatus();
    }

    /**
     * Returns the license status. Also updates the status in the DB.
     *
     * @since 1.0
     */
    public function get_license_status()
    {
        // Get the license key
        $license_key = $this->get_license_key();
        // Get the license status from the DB
        $license_status = $this->get_license_status_from_db();
        // Get all license statuses
        $license_statuses = get_option('wprss_settings_license_statuses');
        if (!is_array($license_statuses)) {
            $license_statuses = array();
        }

        // data to send in our API request
        $api_params = array(
            'edd_action' => 'check_license',
            'license' => $license_key,
            'item_name' => urlencode(WPRSS_FTR_SL_ITEM_NAME),
        );

        // Call the custom API.
        $response = wp_remote_get(add_query_arg($api_params, WPRSS_FTR_SL_STORE_URL));

        // If the response is an error, return the value in the DB
        if (is_wp_error($response)) {
            return $license_status;
        }

        // decode the license data
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // Update the DB option
        $license_statuses['ftr_license_status'] = $license_data->license;
        update_option('wprss_settings_license_statuses', $license_statuses);

        // Return TRUE if it is 'active', FALSE otherwise
        return $license_data->license;
    }
}
