<?php
/**
 * PRICING TABLE 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-pricing-table-2.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<#
var target = settings.button_link.is_external ? 'target="_blank"' : '';
var nofollow = settings.button_link.nofollow === 'on' ? 'rel="nofollow"' : '';
#>

<div class="pricing-table pricing-table-style-two">
	<header class="pricing-table__header">
		<# if( settings.title ) { #>
		<h3 class="pricing-table__title elementor-inline-editing" data-elementor-setting-key="title">
			{{{ settings.title }}}
		</h3>
		<# } #>

		<div class="pricing-table-price">
			<# if( settings.currency ) { #>
			<span class="pricing-table__currency elementor-inline-editing" data-elementor-setting-key="currency">
				{{{ settings.currency }}}
			</span>
			<# }

			if( settings.price ) { #>
			<span class="pricing-table__amount elementor-inline-editing" data-elementor-setting-key="price">
				{{{ settings.price }}}
			</span>
			<# }

			if( settings.pricing_duration ) { #>
			<span class="pricing-table__time elementor-inline-editing" data-elementor-setting-key="pricing_duration">
				{{{ settings.pricing_duration }}}
			</span>
			<# } #>
		</div> <!-- .pricing-table-price -->
	</header> <!-- .pricing-table__header -->

	<# if( settings.feature_heading ) { #>
	<p class="pricing-table__sentence elementor-inline-editing" data-elementor-setting-key="feature_heading">
		{{{ settings.feature_heading }}}
	</p>
	<# }

	if( settings.features_list ) { #>
	<ul class="pricing-table__feature-list">
		<# _.each( settings.features_list, function( feature ) { #>
		<li>{{ feature.feature_title }}</li>
		<# }); #>
	</ul>
	<# }

	if( settings.button_text ) { #>
	<footer class="pricing-table__footer">
		<a href="{{{ settings.button_link.url }}}" {{{ target }}} {{{ nofollow }}}
		   class="btn btn--rectangular-rounded btn--primary elementor-inline-editing"
		   data-elementor-setting-key="button_text">{{{ settings.button_text }}}</a>
	</footer>
	<# } #>
</div>