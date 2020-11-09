<?php
/**
 * Modify site behavior for staging sites.
 */

namespace Nexcess\MAPPS\Integrations;

use Nexcess\MAPPS\AdminNotice;
use Nexcess\MAPPS\Concerns\HasDashboardNotices;
use Nexcess\MAPPS\Concerns\HasHooks;

class StagingSites extends Integration {
	use HasDashboardNotices;
	use HasHooks;

	/**
	 * Determine whether or not this integration should be loaded.
	 *
	 * @return bool Whether or not this integration be loaded in this environment.
	 */
	public function shouldLoadIntegration() {
		return $this->settings->is_staging_site;
	}

	/**
	 * Perform any necessary setup for the integration.
	 *
	 * This method is automatically called as part of Plugin::registerIntegration(), and is the
	 * entry-point for all integrations.
	 */
	public function setup() {
		$this->addHooks();

		$this->addDashboardNotice( new AdminNotice(
			__( 'You are currently in a staging environment.', 'nexcess-mapps' ),
			'warning',
			false,
			'staging-notice'
		), 1 );
	}

	/**
	 * Retrieve all filters for the integration.
	 *
	 * @return array[]
	 */
	protected function getFilters() {
		return [
			// Block robots, regardless of the blog_public option.
			[ 'pre_option_blog_public', '__return_zero' ],

			// Don't send an email when the admin email changes.
			[ 'send_email_change_email', '__return_false' ],
		];
	}
}
