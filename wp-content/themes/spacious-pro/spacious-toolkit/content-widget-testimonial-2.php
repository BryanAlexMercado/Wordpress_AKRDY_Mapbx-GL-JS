<?php
/**
 * The template for displaying Testimonial 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-testimonial-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @author  ThemeGrill
 * @package Spacious_Toolkit/Templates
 * @version 1.0.0
 *
 * @var $instance SPT_TESTIMONIAL_1
 */

use Elementor\SPT_TESTIMONIAL_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image       = $instance->get_settings( 'image' );
$image_url   = $image['url'];
$author      = $instance->get_settings( 'author' );
$designation = $instance->get_settings( 'designation' );
$words       = $instance->get_settings( 'words' );
$company     = $instance->get_settings( 'company' );

$instance->add_render_attribute( 'author', 'class', 'testimonial__author' );
$instance->add_render_attribute( 'designation', 'class', 'testimonial__position' );
$instance->add_render_attribute( 'company', 'class', 'testimonial__company' );
$instance->add_render_attribute( 'words', 'class', 'testimonial__sayings' );
?>

<div class="testimonial testimonial-style-two">
	<?php if ( ! empty( $image_url ) ) :
		echo ' <figure class="testimonial__thumbnail"><img src="' . esc_url( $image_url ) . '"></figure>';
	endif;

	if ( ! empty( $words ) ) :
		echo '<p ' . $instance->get_render_attribute_string( "words" ) . '>' . esc_html( $words ) . '</p>';
	endif;

	if ( ! empty( $author ) ) :
		echo '<h3 ' . $instance->get_render_attribute_string( "author" ) . '>' . esc_html( $author ) . '</h3>';
	endif;

	if ( ! empty( $designation ) ) :
		echo '<span ' . $instance->get_render_attribute_string( "designation" ) . '>' . esc_html( $designation ) . '</span>';
	endif;

	if ( ! empty( $company ) ) :
		echo '<span ' . $instance->get_render_attribute_string( "company" ) . '>' . esc_html( $company ) . '</span>';
	endif; ?>
</div> <!-- .testimonial -->
