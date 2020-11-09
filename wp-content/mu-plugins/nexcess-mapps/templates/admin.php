<?php

/**
 * The main admin page for Nexcess MAPPS customers.
 *
 * @global \Nexcess\MAPPS\Settings $settings The current settings object.
 */

use Nexcess\MAPPS\Integrations\Dashboard;

$page_title = $settings->is_mwch_site
	? __( 'Managed WooCommerce, powered by Nexcess', 'nexcess-mapps' )
	: __( 'Managed WordPress, powered by Nexcess', 'nexcess-mapps' );
?>

<div class="wrap mapps-wrap">
	<h1 class="nexcess-page-title"><?php echo esc_html( $page_title ); ?></h1>
	<?php do_tabbed_settings_sections( Dashboard::ADMIN_MENU_SLUG ); ?>
</div>
