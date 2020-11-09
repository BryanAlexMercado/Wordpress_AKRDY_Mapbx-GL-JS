<?php
/**
 * The template for displaying CTA 2 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-cta-2.php.
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
 * @var $instance SPT_CTA_2
 */

use Elementor\SPT_CTA_2;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title       = $instance->get_settings( 'title' );
$content     = $instance->get_settings( 'content' );
$button_text = $instance->get_settings( 'button_text' );

$button_link     = $instance->get_settings( 'button_link' );
$button_url      = $button_link['url'];
$button_target   = $button_link['is_external'] ? 'target="_blank"' : '';
$button_nofollow = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';

$instance->add_render_attribute( 'title', 'class', 'call-to-action__title' );
$instance->add_render_attribute( 'content', 'class', 'call-to-action__content' );
$instance->add_render_attribute( 'button_text', 'class', 'btn btn--border' );
?>

<div class="call-to-action cta-style-two">
	<div class="call-to-action--center">
		<?php if ( ! empty( $title ) ) : ?>
			<h3 <?php echo $instance->get_render_attribute_string( 'title' ) ?>>
				<?php echo esc_html( $title ); ?>
			</h3>
		<?php endif; ?>

		<?php if ( ! empty( $content ) ) : ?>
			<div <?php echo $instance->get_render_attribute_string( 'content' ) ?>>
				<p><?php echo esc_html( $content ); ?></p>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $button_text ) ) : ?>
			<a href="<?php echo esc_url( $button_url ); ?>"
				<?php echo esc_attr( $button_target ) . ' ' . esc_attr( $button_nofollow ); ?>
				<?php echo $instance->get_render_attribute_string( 'button_text' ) ?>>
				<?php echo esc_html( $button_text ) ?>
			</a>
		<?php endif; ?>
	</div><!-- .call-to-action--center -->
</div>    <!-- .call-to-action--background -->