<?php
/**
 * The template for displaying Team 5 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-icon-box-5.php.
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
 * @var $instance SPT_ICON_BOX_5
 */

use Elementor\SPT_ICON_BOX_5;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$caption_tag     = $instance->get_settings('caption_tag');
$title_tag       = $instance->get_settings('title_tag');
$content_tag     = $instance->get_settings('content_tag');

$icon        = $instance->get_settings('icon');
$caption     = $instance->get_settings('caption');
$title       = $instance->get_settings('title');
$content     = $instance->get_settings('content');
$button_text = $instance->get_settings('button_text');
$button_link = $instance->get_settings('button_link');
$button_url  = $button_link['url'];
$button_target    = $button_link['is_external'] ? 'target="_blank"' : '';
$button_nofollow  = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';
$alignment       = $instance->get_settings( 'icon_box_alignment' );
$alignment_class = ! empty( $alignment ) ? $alignment : 'none';
$position = $instance->get_settings('icon_position');
$position_class = ! empty( $position ) ? $instance->get_settings($position) : 'above';
?>

<div class="icon-box icon-box-style-five spacious-align-<?php echo esc_attr( $alignment ); ?> spacious-icon-align-<?php echo esc_attr( $position ); ?>">
	<?php if ( ! empty( $icon ) ) : ?>
		<div class="icon-wrapper">
			<div class="icon-box-icon">
				<i class="<?php echo esc_attr( $icon ); ?>"></i>
			</div>
		</div>
	<?php endif; ?>

	<div class="icon-box-details">
		<?php if ( ! empty( $caption ) ) : ?>
			<<?php echo( $caption_tag ); ?> class="icon-box-caption">
				<?php echo esc_html( $caption ); ?>
			</<?php echo ( $caption_tag ); ?>>
		<?php endif; ?>

		<?php if ( ! empty( $title ) ) : ?>
			<<?php echo( $title_tag ); ?> class="icon-box-title">
				<?php echo esc_html( $title ); ?>
			</<?php echo ( $title_tag ); ?>>
		<?php endif; ?>

		<?php if ( ! empty( $content ) ) : ?>
			<<?php echo( $content_tag ); ?> class="icon-box-content">
				<?php echo esc_html( $content ); ?>
			</<?php echo ( $content_tag ); ?>>
		<?php endif; ?>

		<div class="icon-btn-wrapper icon-box-five-btn">
			<?php if ( ! empty( $button_text ) ) : ?>
				<a href="<?php echo esc_url( $button_url ); ?>" class="btn btn--primary btn--medium"
					<?php echo esc_attr( $button_target ); ?>
					<?php esc_attr( $button_nofollow ); ?>
				>
					<?php echo esc_html( $button_text ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div> <!-- .icon-box -->
