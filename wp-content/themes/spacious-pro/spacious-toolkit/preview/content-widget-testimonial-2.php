<?php
/**
 * TESTIMONIAL 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/preview/content-widget-testimonial-2.php.
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

<div class="testimonial testimonial-style-two">
	<# if( settings.image.url ) { #>
	<figure class="testimonial__thumbnail"><img src="{{{ settings.image.url }}}"></figure>
	<# } #>
	<# if( settings.words ) { #>
	<p class="testimonial__sayings elementor-inline-editing" data-elementor-setting-key="words">
		{{{ settings.words }}}
	</p>
	<# } #>
	<# if( settings.author ) { #>
	<h3 class="testimonial__author elementor-inline-editing" data-elementor-setting-key="author">
		{{{ settings.author }}}
	</h3>
	<# } #>
	<# if( settings.designation ) { #>
	<span class="testimonial__position elementor-inline-editing" data-elementor-setting-key="designation">
		{{{ settings.designation }}}
	</span>
	<# } #>
	<# if( settings.company ) { #>
	<span class="testimonial__company elementor-inline-editing" data-elementor-setting-key="company">
		{{{ settings.company }}}
	</span>
	<# } #>
</div> <!-- .testimonial -->