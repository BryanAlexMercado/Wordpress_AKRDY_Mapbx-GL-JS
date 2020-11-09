<?php
/**
 * TEAM 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-team-2.php.
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

<div class="team-member team-style-two">
	<# if( settings.member_image.url ) { #>
	<div class="team-member__thumbnail">
		<img src="{{{ settings.member_image.url }}}">
	</div> <!-- team-member__thumbnail -->
	<# } #>

	<div class="team-member__info">
		<# if( settings.member_name ) { #>
		<h3 class="team-member__title elementor-inline-editing" data-elementor-setting-key="member_name">
			{{{ settings.member_name }}}
		</h3>
		<# }

		if( settings.member_designation ) { #>
		<p class="team-member__position elementor-inline-editing" data-elementor-setting-key="member_designation">
			{{{ settings.member_designation }}}
		</p>
		<# }

		if( settings.member_description ) { #>
		<p class="team-member__description elementor-inline-editing" data-elementor-setting-key="member_description">
			{{{ settings.member_description }}}
		</p>
		<# } #>

		<div class="team-member__social">
			<ul class="social-icons">
				<#
				var socials = [ 'facebook', 'twitter', 'google_plus', 'linkedin' ];

				_.each( socials, function( social ) {
				var social_key = 'member_' + social;

				var social_link = settings[ social_key ];
				var social_url = social_link.url;

				var target = social_link.is_external ? 'target="_blank"' : '';
				var nofollow = social_link.nofollow === 'on' ? 'rel="nofollow"' : '';

				if ( social_url ) { #>
				<li><a href="{{ social_link.url }}" {{ target }} {{ nofollow }}>
						<i class="fa fa-{{ social.replace( '_', '-' ) }}"></i>
					</a></li>
				<# } #>
				<# }); #>
			</ul>
		</div> <!-- team-member__social -->

	</div> <!-- team-member__info -->
</div> <!-- team-member -->