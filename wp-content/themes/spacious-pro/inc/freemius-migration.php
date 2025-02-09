<?php
    /**
     * @package     Freemius
     * @copyright   Copyright (c) 2019, Freemius, Inc.
     * @license     https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
     * @author      Vova Feldman
     *
     * Class FS_ThemeGrill_License_Migration
     */
    class FS_ThemeGrill_License_Migration {
        /**
         * @var Freemius
         */
        private $_fs;
        /**
         * @var string
         */
        private $_unique_prefix;
        /**
         * @var string
         */
        private $_license_option_name;

        /**
         * FS_ThemeGrill_License_Migration constructor.
         *
         * @param \Freemius $fs
         * @param string    $license_option_name
         * @param string    $unique_prefix
         */
        public function __construct( Freemius $fs, $license_option_name, $unique_prefix = 'my_fs' ) {
            $this->_fs                  = $fs;
            $this->_license_option_name = $license_option_name;
            $this->_unique_prefix       = $unique_prefix;

            if ( $this->should_try_migrate() ) {
                add_action( 'admin_init', array( &$this, 'license_key_migration' ) );
            }
        }

        private function get_license_key_from_prev_platform_storage() {
            $options = get_option( $this->_license_option_name );

            if ( ! is_array( $options ) ) {
                return null;
            }

            if ( empty( $options['api_key'] ) ) {
                return null;
            }

            return $options['api_key'];
        }

        public function license_key_migration() {
            if ( ! $this->should_try_migrate() ) {
                return;
            }

            // Get the license key from the previous eCommerce platform's storage.
            $license_key = $this->get_license_key_from_prev_platform_storage();

            if ( empty( $license_key ) ) {
                // No key to migrate.
                return;
            }

            // Get the first 32 characters.
            $license_key = substr( $license_key, 0, 32 );

            $option_name = $this->get_migration_status_option_name();

            try {
                $next_page = $this->_fs->activate_migrated_license( $license_key );
            } catch ( Exception $e ) {
                update_option( $option_name, 'unexpected_error' );

                return;
            }

            if ( $this->_fs->can_use_premium_code() ) {
                update_option( $option_name, 'done' );

                if ( is_string( $next_page ) ) {
                    fs_redirect( $next_page );
                }
            } else {
                update_option( $option_name, 'failed' );
            }
        }

        /**
         * @return bool
         */
        private function should_try_migrate() {
            if ( ! $this->_fs->has_api_connectivity() || $this->_fs->is_registered() ) {
                // No connectivity OR the user already opted-in to Freemius.
                return false;
            }

            $option_name = $this->get_migration_status_option_name();

            if ( 'pending' != get_option( $option_name, 'pending' ) ) {
                return false;
            }

            return true;
        }

        private function get_migration_status_option_name() {
            return "{$this->_unique_prefix}_migrated2fs";
        }
    }

    /**
     * Class FS_ThemeGrill_License_Menu
     */
    class FS_ThemeGrill_License_Menu {
        /**
         * @var string
         */
        private $_name;
        /**
         * @var string
         */
        private $_slug;

        function __construct( $name, $slug ) {
            $this->_name = $name;
            $this->_slug = $slug;

            add_action( 'admin_menu', array( &$this, 'add_menu' ) );
        }

        function redirect_to_account_when_registered() {
            $fs = FS_ThemeGrill::freemius();

            if ( ! $fs->is_activation_mode() ) {
                $pages = array( 'account', 'contact', 'pricing' );

                foreach ( $pages as $page ) {
                    if ( $fs->is_page_visible( $page ) ) {
                        fs_redirect( $fs->_get_admin_page_url( $page ) );
                    }
                }
            }
        }

        function get_empty_html() {
            return '';
        }

        function add_menu() {
            $hook = add_options_page(
                $this->_name . ' ' . __( 'License Manager', $this->_slug ),
                $this->_name . ' ' . __( 'License Manager', $this->_slug ),
                'manage_options',
                'themegrill_submenu',
                array( &$this, 'get_empty_html' )
            );

            add_action( "load-{$hook}", array( &$this, 'redirect_to_account_when_registered' ) );
        }
    }
