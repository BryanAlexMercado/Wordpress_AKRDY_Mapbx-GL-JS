<?php

namespace Nexcess\MAPPS\Concerns;

use Nexcess\MAPPS\AdminNotice;

trait HasDashboardNotices {

	/**
	 * Add a notice to the top of the MAPPS dashboard.
	 *
	 * @param \Nexcess\MAPPS\AdminNotice $notice   The AdminNotice to render.
	 * @param int                        $priority Optional. The priority at which to render the
	 *                                             notice. Default is 10.
	 */
	protected function addDashboardNotice( AdminNotice $notice, $priority = 10 ) {
		$notice->setInline( true );

		add_action( 'Nexcess\\MAPPS\\dashboard_notices', [ $notice, 'output' ], $priority );
	}
}
