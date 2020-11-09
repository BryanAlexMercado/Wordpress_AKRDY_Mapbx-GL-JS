<?php
/**
 * The template for displaying Product Carousel 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-product-carousel-1.php.
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
 * @var $instance SPT_PRODUCT_CAUROSEL_1
 */

use Elementor\SPT_PRODUCT_CAUROSEL_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

$products_number         = $instance->get_settings( 'products_number' );
$offset_products_number  = $instance->get_settings( 'offset_products_number' );
$categories_selected     = $instance->get_settings( 'categories_selected' );
$product_slider_autoplay = $instance->get_settings( 'product_slider_autoplay' );
$product_slider_delay    = $instance->get_settings( 'product_slider_delay' ) ? $instance->get_settings( 'product_slider_delay' ) : 4000;
$product_slider_speed    = $instance->get_settings( 'product_slider_speed' ) ? $instance->get_settings( 'product_slider_speed' ) : 1000;
$slider_per_view         = $instance->get_settings( 'slider_per_view' ) ? $instance->get_settings( 'slider_per_view' ) : 3;

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => $products_number,
);

// Offset the products
if ( ! empty( $offset_products_number ) ) {
	$args['offset'] = $offset_products_number;
}

// Display from selected categories.
if ( ! empty( $categories_selected ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'terms'    => $categories_selected,
		),
	);
}

$featured_products = new \WP_Query( $args );
?>

<!-- Slider main container -->
<div class="swiper-container product-carousel-container"
     data-autoplay="<?php echo esc_attr( $product_slider_autoplay ); ?>"
     data-delay="<?php echo esc_attr( $product_slider_delay ); ?>"
     data-speed="<?php echo esc_attr( $product_slider_speed ); ?>"
     data-columns="<?php echo esc_attr( $slider_per_view ); ?>"
>
	<!-- Additional required wrapper -->
	<div class="swiper-wrapper swiper-carousel-wrapper">
		<?php
		while ( $featured_products->have_posts() ) :
			$featured_products->the_post();

			$product = wc_get_product( $featured_products->post->ID );
			?>

			<div class="swiper-slide product-carousel-slide">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="featured-image">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'woocommerce_single' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="product-details">
					<div class="entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</div>

					<?php if ( $price_html = $product->get_price_html() ) : ?>
						<span class="price"><span class="price-text"><?php esc_html_e( 'Price:', 'spacious' ); ?></span><?php echo $price_html; ?></span>
					<?php endif; ?>

					<div class="add-to-cart">
						<?php woocommerce_template_loop_add_to_cart( $product ); ?>
					</div>
				</div>
			</div>

		<?php
		wp_reset_postdata();
		endwhile;
		?>
	</div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
</div>
