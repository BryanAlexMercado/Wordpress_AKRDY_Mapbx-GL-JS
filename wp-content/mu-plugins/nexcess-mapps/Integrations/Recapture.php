<?php
/**
 * Customizations related to Recapture plugins.
 *
 * @link https://recapture.io/
 */

namespace Nexcess\MAPPS\Integrations;

use Nexcess\MAPPS\Concerns\HasHooks;

class Recapture extends Integration {
	use HasHooks;

	/**
	 * The Nexcess discount code.
	 */
	const DISCOUNT_CODE = 'ZJUFKSOXUX';

	/**
	 * The option key that holds discount information.
	 */
	const DISCOUNT_CODE_OPTION = 'recapture_discount_code';

	/**
	 * Determine whether or not this integration should be loaded.
	 *
	 * @return bool Whether or not this integration be loaded in this environment.
	 */
	public function shouldLoadIntegration() {
		return $this->settings->is_mapps_site;
	}

	/**
	 * Retrieve all filters for the integration.
	 *
	 * @return array[]
	 */
	protected function getFilters() {
		// phpcs:disable WordPress.Arrays
		return [
			[ 'activate_recapture-for-edd/recapture.php',                  [ $this, 'applyPromo' ] ],
			[ 'activate_recapture-for-restrict-content-pro/recapture.php', [ $this, 'applyPromo' ] ],
			[ 'activate_recapture-for-woocommerce/recapture.php',          [ $this, 'applyPromo' ] ],
		];
		// phpcs:enable WordPress.Arrays
	}

	/**
	 * Apply the Nexcess promo code to Recapture plugins.
	 *
	 * The code will only be applied if there isn't an existing discount code applied.
	 */
	public function applyPromo() {
		add_option( self::DISCOUNT_CODE_OPTION, [
			'code'        => self::DISCOUNT_CODE,
			'description' => 'Special deal for Nexcess customers -- your first 3 months with Recapture are 30% off the regular price!',
		] );
	}
}
