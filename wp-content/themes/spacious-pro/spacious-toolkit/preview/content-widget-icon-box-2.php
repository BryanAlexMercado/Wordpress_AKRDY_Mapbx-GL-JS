<?php
/**
 * ICON BOX 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-icon-box-2.php.
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
var target = settings.link.is_external ? 'target="_blank"' : '';
var nofollow = settings.link.nofollow === 'on' ? 'rel="nofollow"' : '';
#>

<div class="icon-box icon-box-style-two">
	<# if( settings.icon.length != 0 ) { #>
	<div class="icon-box__icon">
		<div class="{{{ settings.icon }}}"></div>
	</div>
	<# }

	if( settings.title ) { #>
	<h3 class="icon-box__title">
		<a href="{{{ settings.link.url }}}"
		   {{{ target }}} {{{ nofollow }}} class="elementor-inline-editing" data-elementor-setting-key="title">
			{{{ settings.title }}}
		</a>
	</h3>
	<# }

	if( settings.content ) { #>
	<div class="icon-box__content">
		<p class="elementor-inline-editing" data-elementor-setting-key="content">{{{ settings.content }}}</p>
	</div>
	<# } #>
</div> <!-- .icon-box -->