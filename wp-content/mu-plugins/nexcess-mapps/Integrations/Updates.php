<?php
/**
 * Control how we handle WordPress core updates.
 */

namespace Nexcess\MAPPS\Integrations;

use Nexcess\MAPPS\Concerns\HasHooks;

class Updates extends Integration {
	use HasHooks;

	/**
	 * Determine whether or not this integration should be loaded.
	 *
	 * @return bool Whether or not this integration be loaded in this environment.
	 */
	public function shouldLoadIntegration() {
		return $this->settings->is_mapps_site;
	}

	/**
	 * Perform any necessary setup for the integration.
	 *
	 * This method is automatically called as part of Plugin::registerIntegration(), and is the
	 * entry-point for all integrations.
	 */
	public function setup() {
		$this->addHooks();

		// Disable the "Try Gutenberg" dashboard widget (WP < 5.x only).
		remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
	}

	/**
	 * Retrieve all actions for the integration.
	 *
	 * @return array[]
	 */
	protected function getActions() {
		return [
			[ 'admin_init', [ $this, 'removeUpdateNag' ] ],
		];
	}

	/**
	 * Retrieve all filters for the integration.
	 *
	 * @return array[]
	 */
	protected function getFilters() {
		// phpcs:disable WordPress.Arrays
		$filters = [
			// Control which automatic updates are permitted by default.
			[ 'allow_dev_auto_core_updates',   '__return_false', 1 ],
			[ 'allow_minor_auto_core_updates', '__return_true' , 1 ],
			[ 'allow_major_auto_core_updates', '__return_false', 1 ],
		];

		// Change behavior based on whether or not MAPPS is responsible for core updates.
		if ( $this->settings->mapps_core_updates_enabled ) {
			$filters = array_merge( $filters, [
				// Don't email site owners about core updates.
				[ 'auto_core_update_send_email',         '__return_false', 1 ],
				[ 'send_core_update_notification_email', '__return_false', 1 ],
			] );
		}

		// Disable auto plugin updates if handled by MAPPS.
		if ( $this->settings->mapps_plugin_updates_enabled ) {
			$filters[] = [ 'auto_update_plugin',          '__return_false', 1 ];
			$filters[] = [ 'plugins_auto_update_enabled', '__return_false', 1 ];
		}

		// phpcs:enable WordPress.Arrays
		return $filters;
	}

	/**
	 * Remove the "WordPress X.X is available! Please notify the site administrator" nags.
	 *
	 * @see update_nag()
	 */
	public function removeUpdateNag() {
		if ( $this->settings->mapps_core_updates_enabled ) {
			remove_action( 'admin_notices', 'update_nag', 3 );
		}
	}
}
