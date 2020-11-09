<?php
/**
 * The template for displaying CTA 3 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-cta-3.php.
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
 * @var $instance SPT_CTA_3
 */

use Elementor\SPT_CTA_3;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$before_title_tag = $instance->get_settings('before_title_tag');
$title_tag        = $instance->get_settings('title_tag');
$after_title_tag  = $instance->get_settings('after_title_tag');
$before_title     = $instance->get_settings( 'before_title' );
$title            = $instance->get_settings( 'title' );
$after_title      = $instance->get_settings( 'after_title' );
$content          = $instance->get_settings( 'content' );
$button_text      = $instance->get_settings( 'button_text' );
$button_text2     = $instance->get_settings( 'button_text2' );

$button_link      = $instance->get_settings( 'button_link' );
$button_link2     = $instance->get_settings( 'button_link2' );
$button_url       = $button_link['url'];
$button_url2      = $button_link2['url2'];
$button_target    = $button_link['is_external'] ? 'target="_blank"' : '';
$button_target2   = $button_link2['is_external'] ? 'target="_blank"' : '';
$button_nofollow  = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';
$button_nofollow2 = ( $button_link2['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';
$alignment       = $instance->get_settings( 'call_to_cation_alignment' );
$alignment_class = ! empty( $alignment ) ? $alignment : 'none';

$instance->add_render_attribute( 'content', 'class', 'call-to-action__content' );
$instance->add_render_attribute( 'button_text', 'class', 'btn btn--black' );
$instance->add_render_attribute( 'button_text2', 'class', 'btn btn--ghost' );
?>
<div class="call-to-action cta-style-three spacious-align-<?php echo esc_attr( $alignment ); ?>">
	<?php if (!empty( $before_title ) ) : ?>
		<<?php echo ( $before_title_tag ); ?> class="call-to-action__before-title">
			<?php echo esc_html( $before_title ); ?>
		</<?php echo ( $before_title_tag ); ?>>
	<?php endif; ?>

	<?php if (!empty( $title ) ) : ?>
		<<?php echo ( $title_tag ); ?> class="call-to-action__title">
			<?php echo esc_html($title); ?>
		</<?php echo ( $title_tag ); ?>>
	<?php endif; ?>

	<?php if (!empty( $after_title ) ) : ?>
		<<?php echo ( $after_title_tag ); ?> class="call-to-action__after-title">
			<?php echo esc_html($after_title ); ?>
		</<?php echo ( $after_title_tag ); ?>>
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

	<?php if ( ! empty( $button_text2 ) ) : ?>
		<a href="<?php echo esc_url( $button_url2 ); ?>"
			<?php echo esc_attr( $button_target2 ) . ' ' . esc_attr( $button_nofollow2 ); ?>
			<?php echo $instance->get_render_attribute_string( 'button_text2' ) ?>>
			<?php echo esc_html( $button_text2 ) ?>
		</a>
	<?php endif; ?>
</div>    <!-- .call-to-action--background -->
