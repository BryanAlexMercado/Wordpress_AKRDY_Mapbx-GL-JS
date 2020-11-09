<?php
/**
 * The template for displaying Pricing table 2 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-pricing-table-2.php.
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
 * @var $instance SPT_PRICING_TABLE_2
 */

use Elementor\SPT_PRICING_TABLE_2;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title            = $instance->get_settings( 'title' );
$currency         = $instance->get_settings( 'currency' );
$price            = $instance->get_settings( 'price' );
$pricing_duration = $instance->get_settings( 'pricing_duration' );
$feature_heading  = $instance->get_settings( 'feature_heading' );
$button_text      = $instance->get_settings( 'button_text' );
$button_link      = $instance->get_settings( 'button_link' );
$button_url       = $button_link['url'];
$button_target    = $button_link['is_external'] ? 'target="_blank"' : '';
$button_nofollow  = ( $button_link['nofollow'] === 'on' ) ? 'rel="nofollow"' : '';
$features_list    = $instance->get_settings( 'features_list' );

$instance->add_render_attribute( 'title', 'class', 'pricing-table__title' );
$instance->add_render_attribute( 'currency', 'class', 'pricing-table__currency' );
$instance->add_render_attribute( 'price', 'class', 'pricing-table__amount' );
$instance->add_render_attribute( 'pricing_duration', 'class', 'pricing-table__time' );
$instance->add_render_attribute( 'feature_heading', 'class', 'pricing-table__sentence' );
$instance->add_render_attribute( 'button_text', 'class', 'btn btn--rectangular-rounded btn--primary' );
?>
<div class="pricing-table pricing-table-style-two">
	<header class="pricing-table__header">
		<?php if ( ! empty( $title ) ) : ?>
			<h3 <?php echo $instance->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>

		<div class="pricing-table-price">
			<?php if ( ! empty( $currency ) ) : ?>
				<span <?php echo $instance->get_render_attribute_string( 'currency' ); ?>><?php echo esc_html( $currency ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $price ) ) : ?>
				<span <?php echo $instance->get_render_attribute_string( 'price' ); ?>><?php echo esc_html( $price ); ?></span>
			<?php endif; ?>

			<?php if ( ! empty( $pricing_duration ) ) : ?>
				<span <?php echo $instance->get_render_attribute_string( 'pricing_duration' ); ?>><?php echo esc_html( $pricing_duration ); ?></span>
			<?php endif; ?>
		</div> <!-- .pricing-table-price -->
	</header> <!-- .pricing-table__header -->

	<?php if ( ! empty( $feature_heading ) ) : ?>
		<p <?php echo $instance->get_render_attribute_string( 'feature_heading' ); ?>><?php echo esc_html( $feature_heading ); ?></p>
	<?php endif; ?>

	<?php if ( $features_list ) : ?>
		<ul class="pricing-table__feature-list">
			<?php foreach ( $features_list as $feature ) : ?>
				<li><?php echo esc_html( $feature['feature_title'] ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?php if ( ! empty( $button_text ) ) : ?>
		<footer class="pricing-table__footer">
			<a href="<?php echo esc_url( $button_url ); ?>" <?php echo esc_attr( $button_target ) . ' ' . esc_attr( $button_nofollow ); ?>
				<?php echo $instance->get_render_attribute_string( 'button_text' ); ?>>
				<?php echo esc_html( $button_text ) ?>
			</a>
		</footer>
	<?php endif; ?>
</div>