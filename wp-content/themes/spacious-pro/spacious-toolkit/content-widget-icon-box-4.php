<?php
/**
 * The template for displaying Icon Box 3 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-icon-box-3.php.
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
 * @var $instance SPT_ICON_BOX_3
 */

use Elementor\SPT_ICON_BOX_3;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$icon  = $instance->get_settings( 'icon' );
$title = $instance->get_settings( 'title' );

$link     = $instance->get_settings( 'link' );
$url      = $link['url'];
$target   = $link['is_external'] ? 'target="_blank"' : '';
$nofollow = ( $link['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';

$content = $instance->get_settings( 'content' );

$instance->add_render_attribute( 'content' );
$instance->add_render_attribute( 'title' );
?>

<div class="icon-box icon-box-style-four">
	<?php if ( ! empty( $icon ) ) : ?>
		<div class="icon-box__icon">
			<div class="<?php echo esc_attr( $icon ); ?>"></div>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $title ) ) : ?>
		<h3 class="icon-box__title">
			<a href="<?php echo esc_url( $url ); ?>"
				<?php echo $target; ?>
				<?php echo $nofollow; ?>
				<?php echo $instance->get_render_attribute_string( 'title' ); ?>>
				<?php echo esc_html( $title ); ?>
			</a>
		</h3>
	<?php endif; ?>

	<?php if ( ! empty( $content ) ) : ?>
		<div class="icon-box__content">
			<p <?php echo $instance->get_render_attribute_string( 'content' ); ?>><?php echo esc_html( $content ); ?></p>
		</div>
	<?php endif; ?>
</div> <!-- .icon-box -->