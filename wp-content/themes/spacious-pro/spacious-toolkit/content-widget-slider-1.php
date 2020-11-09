<?php
/**
 * The template for displaying Counter 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-counter-1.php.
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
 * @var $instance SPT_COUNTER_1
 */

use Elementor\SPT_COUNTER_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$sliders         = $instance->get_settings( 'slider' );
$slider_autoplay = $instance->get_settings( 'slider_autoplay' );
$slider_delay    = $instance->get_settings( 'slider_delay' ) ? $instance->get_settings( 'slider_delay' ) : 4000;
$slider_speed    = $instance->get_settings( 'slider_speed' ) ? $instance->get_settings( 'slider_speed' ) : 1000;
$pause_on_hover  = $instance->get_settings( 'pause_on_hover' );
?>

<?php if ( $sliders ) : ?>
	<div class="spacious-slider">
		<div class="swiper-container"
		     data-autoplay="<?php echo esc_attr( $slider_autoplay ); ?>"
		     data-delay="<?php echo esc_attr( $slider_delay ); ?>"
		     data-speed="<?php echo esc_attr( $slider_speed ); ?>"
		     data-pause_on_hover="<?php echo esc_attr( $pause_on_hover ); ?>"
		>
			<div class="swiper-wrapper">
				<?php foreach ( $sliders as $slider ) :
					$title = $slider['title'];
					$description = $slider['description'];
					$image = $slider['image'];
					$image_url = $image['url'];

					$button_text     = $slider['button_text'];
					$button_link     = $slider['button_link'];
					$button_url      = $button_link['url'];
					$button_target   = $button_link['is_external'] ? 'target="_blank"' : '';
					$button_nofollow = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';

					$button_text1     = $slider['button_text1'];
					$button_link1     = $slider['button_link1'];
					$button_url1      = $button_link['url'];
					$button_target1   = $button_link['is_external'] ? 'target="_blank"' : '';
					$button_nofollow1 = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : ''; ?>

					<?php if ( ! empty( $image_url ) ) : ?>
					<div class="swiper-slide">
						<figure class="slider-image">
							<img src="<?php echo esc_url( $image_url ); ?>" />
						</figure>
						<div class="slider-content">
							<div class="slider-inner-part">
								<div class="slider-text">
									<?php if ( ! empty( $title ) ) : ?>
										<div class="caption-title"><?php echo esc_html( $title ); ?></div>
									<?php endif; ?>

									<?php if ( ! empty( $description ) ) : ?>
										<div class="caption-desc"><?php echo esc_html( $description ); ?></div>
									<?php endif; ?>
								</div>
								<div class="button-wrapper">
									<div class="btn-wrapper btn-default">
										<?php if ( ! empty( $button_text ) ) : ?>
											<a href="<?php echo esc_url( $button_url ); ?>"
											   class="btn btn--primary btn--rectangular-rounded btn--medium"
												<?php echo esc_attr( $button_target ) . ' ' . esc_attr( $button_nofollow ); ?>>
												<?php echo esc_html( $button_text ); ?>
											</a>
										<?php endif; ?>
									</div>
									<?php if ( ! empty( $button_text1 ) ) : ?>
										<div class="btn-wrapper btn-secondary">
											<a href="<?php echo esc_url( $button_url1 ); ?>"
											   class="btn btn--secondary btn--rectangular-rounded btn--medium"
												<?php echo esc_attr( $button_target1 ) . ' ' . esc_attr( $button_nofollow1 ); ?>>
												<?php echo esc_html( $button_text1 ); ?>
											</a>
										</div>
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
<?php endif; ?>
