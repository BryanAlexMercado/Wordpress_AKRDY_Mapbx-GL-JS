<?php
/**
 * Collect feedback from customers.
 */

namespace Nexcess\MAPPS\Integrations;

use Nexcess\MAPPS\AdminNotice;
use Nexcess\MAPPS\Concerns\HasAdminPages;
use Nexcess\MAPPS\Concerns\HasHooks;
use Nexcess\MAPPS\Integrations\Dashboard;

class Feedback extends Integration {
	use HasAdminPages;
	use HasHooks;

	/**
	 * Determine whether or not this integration should be loaded.
	 *
	 * @return bool Whether or not this integration be loaded in this environment.
	 */
	public function shouldLoadIntegration() {
		return $this->settings->is_mapps_site
			&& $this->settings->canny_board_token;
	}

	/**
	 * Retrieve all actions for the integration.
	 *
	 * @return array[]
	 */
	protected function getActions() {
		// phpcs:disable WordPress.Arrays
		return [
			[ 'admin_init', [ $this, 'registerFeedbackPage' ], 200 ],
		];
		// phpcs:enable WordPress.Arrays
	}

	/**
	 * Register the feedback page.
	 */
	public function registerFeedbackPage() {
		add_settings_section(
			'feedback',
			_x( 'Beta Feedback', 'settings section', 'nexcess-mapps' ),
			function () {
				$this->renderTemplate( 'feedback', [
					'settings' => $this->settings,
				] );
			},
			Dashboard::ADMIN_MENU_SLUG
		);
	}
}
