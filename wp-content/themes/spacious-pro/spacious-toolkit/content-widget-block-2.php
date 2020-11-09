<?php
/**
 * The template for displaying Block Posts 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-block-1.php.
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
 * @var $instance SPT_BLOCK_1
 */

use Elementor\SPT_BLOCK_2;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$widget_title         = $instance->get_settings( 'widget_title' );
$display_option       = $instance->get_settings( 'display_option' );
$posts_number         = $instance->get_settings( 'posts_number' );
$offset_posts_number  = $instance->get_settings( 'offset_posts_number' );
$categories_selected  = $instance->get_settings( 'categories_selected' );
$post_slider_autoplay = $instance->get_settings( 'post_slider_autoplay' );
$post_slider_delay    = $instance->get_settings( 'post_slider_delay' ) ? $instance->get_settings( 'post_slider_delay' ) : 4000;
$post_slider_speed    = $instance->get_settings( 'post_slider_speed' ) ? $instance->get_settings( 'post_slider_speed' ) : 1000;
$slider_per_view      = $instance->get_settings( 'slider_per_view' ) ? $instance->get_settings( 'slider_per_view' ) : 3;

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => $posts_number,
);

// Offset the products
if ( ! empty( $offset_posts_number ) ) {
	$args['offset'] = $offset_posts_number;
}

if ( 'categories' == $display_option ) {
	$args['category__in'] = $categories_selected;
}

$featured_posts = new \WP_Query( $args ); ?>

<div class="tg-block-2 main-block-wrapper">
	<?php if ( ! empty( $widget_title ) ) : ?>
		<h4 class="block-title">
			<span><?php echo esc_html( $widget_title ); ?></span>
		</h4>
	<?php endif; ?>

	<!-- Post slider main container -->
	<div class="swiper-container post-carousel-container"
	     data-autoplay="<?php echo esc_attr( $post_slider_autoplay ); ?>"
	     data-delay="<?php echo esc_attr( $post_slider_delay ); ?>"
	     data-speed="<?php echo esc_attr( $post_slider_speed ); ?>"
	     data-columns="<?php echo esc_attr( $slider_per_view ); ?>"
	>
		<!-- Additional required wrapper -->
		<div class="swiper-wrapper swiper-carousel-wrapper">
			<?php
			while ( $featured_posts->have_posts() ) :
				$featured_posts->the_post(); ?>

				<div class="tg-block block-2-content-wrapper swiper-slide">
					<div class="tg-block-content">
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="tg-block-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'featured' ); ?>
								</a>
							</figure>
						<?php endif; ?>

						<h3 class="tg-block-title entry-title">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>

						<?php
						if ( function_exists( 'spacious_entry_meta' ) ) {
							spacious_entry_meta( false );
						}
						?>

						<div class="tg-expert entry-content">
							<?php the_excerpt(); ?>
						</div>

						<span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php echo spacious_options( 'spacious_read_more_text', esc_html__( 'Read more', 'spacious' ) ); ?></a></span>

					</div>
				</div>

			<?php endwhile;
			wp_reset_postdata(); ?>
		</div>

	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
</div>
