<?php
/**
 * Short-circuit the Fremius class to prevent it from taking over WP-Admin.
 */

namespace Nexcess\MAPPS\Stubs;

class Fremius {
	public function add_filter() {
		// no-op.
	}

	public function is_free_plan() {
		return true;
	}
}
