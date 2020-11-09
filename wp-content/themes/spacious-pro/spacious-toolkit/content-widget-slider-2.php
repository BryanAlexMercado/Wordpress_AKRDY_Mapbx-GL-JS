<?php
/**
 * The template for displaying Slider 2 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-slider-2.php.
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
 * @var $instance SPT_SLIDER_2
 */

use Elementor\SPT_SLIDER_2;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slider_style_two_autoplay = $instance->get_settings( 'slider_autoplay' );
$slider_style_two_delay    = $instance->get_settings( 'slider_delay' ) ? $instance->get_settings( 'slider_delay' ) : 4000;
$slider_style_two_speed    = $instance->get_settings( 'slider_speed' ) ? $instance->get_settings( 'slider_speed' ) : 1000;
$slider_per_view           = $instance->get_settings( 'slider_per_view' ) ? $instance->get_settings( 'slider_per_view' ) : 3;
$sliders                   = $instance->get_settings( 'slider' );
$alignment                 = $instance->get_settings( 'slider_alignment' );
$alignment_class           = ! empty( $alignment ) ? $alignment : 'none';
$pause_on_hover  = $instance->get_settings( 'pause_on_hover' );
?>

<div class="slider-style-two slider-style-two spacious-align-<?php echo esc_attr( $alignment ); ?>">
	<div class="swiper-container slider-style-two-container"
		data-autoplay="<?php echo esc_attr( $slider_style_two_autoplay ); ?>"
		data-delay="<?php echo esc_attr( $slider_style_two_delay ); ?>"
		data-speed="<?php echo esc_attr( $slider_style_two_speed ); ?>"
		data-columns="<?php echo esc_attr( $slider_per_view ); ?>"
		data-pause_on_hover="<?php echo esc_attr( $pause_on_hover ); ?>"
	>
		<div class="swiper-wrapper swiper-slider-style-two-wrapper">
			<?php foreach ( $sliders as $slider ) :
				$title = $slider['title'];
				$description = $slider['description'];
				$image = $slider['image'];
				$image_url = $image['url'];

				$button_text     = $slider['button_text'];
				$button_link     = $slider['button_link'];
				$button_url      = $button_link['url'];
				$button_target   = $button_link['is_external'] ? 'target="_blank"' : '';
				$button_nofollow = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : ''; ?>

				<?php if ( ! empty( $image_url ) ) : ?>
				<div class="swiper-slide">
					<figure class="slider-image">
						<img src="<?php echo esc_url( $image_url ); ?>" />
					</figure>
					<div class="slider-content slider-style-two-content">
						<div class="slider-text slider-style-two-text">
							<?php if ( ! empty( $title ) ) : ?>
							<div class="caption-title"><?php echo esc_html( $title ); ?></div>
							<?php endif; ?>

							<?php if ( ! empty( $description ) ) : ?>
							<div class="caption-desc"><?php echo esc_html( $description ); ?></div>
							<?php endif; ?>
						</div>
						<div class="button-wrapper slider-style-two-btn">
							<div class="btn-wrapper btn-default btn-slider-style-two">
								<?php if ( ! empty( $button_text ) ) : ?>
									<a href="<?php echo esc_url( $button_url ); ?>" class="btn btn--primary btn--medium btn-slider-style-two"
										<?php echo esc_attr( $button_target ); ?>
										<?php esc_attr( $button_nofollow ); ?>
									>
										<?php echo esc_html( $button_text ); ?>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php endforeach; ?>

		</div> <!-- /.swiper-wrapper -->
		<!-- Add Arrows -->
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div> <!-- /.swiper-container -->
</div>
