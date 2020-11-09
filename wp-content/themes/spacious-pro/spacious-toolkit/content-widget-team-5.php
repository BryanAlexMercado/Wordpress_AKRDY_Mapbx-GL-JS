<?php
/**
 * The template for displaying Team 5 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-team-5.php.
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
 * @var $instance SPT_TEAM_5
 */

use Elementor\SPT_TEAM_5;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$teams           = $instance->get_settings( 'team' );
$team_autoplay   = $instance->get_settings( 'team_autoplay' );
$team_delay      = $instance->get_settings( 'team_delay' ) ? $instance->get_settings( 'team_delay' ) : 4000;
$team_speed      = $instance->get_settings( 'team_speed' ) ? $instance->get_settings( 'team_speed' ) : 1000;
$team_per_view   = $instance->get_settings( 'team_per_view' ) ? $instance->get_settings( 'team_per_view' ) : 4;
$alignment       = $instance->get_settings( 'team_alignment' );
$alignment_class = ! empty( $alignment ) ? $alignment : 'none';
?>

<?php if ( $teams ): ?>
	<div class="team-five-carousel team-style-five spacious-align-<?php echo esc_attr( $alignment ); ?>">
		<div class="swiper-container team-container"
		     data-autoplay="<?php echo esc_attr( $team_autoplay ); ?>"
		     data-delay="<?php echo esc_attr( $team_delay ); ?>"
		     data-speed="<?php echo esc_attr( $team_speed ); ?>"
		     data-columns="<?php echo esc_attr( $team_per_view ); ?>"
		>
			<div class="swiper-wrapper team-wrapper">
				<?php foreach ( $teams as $team ) :
					$member_name = $team['member_name'];
					$member_designation = $team['member_designation'];
					$image = $team['image'];
					$image_url = $image['url'];
					?>

					<?php if ( ! empty( $image_url ) ) : ?>
					<div class="swiper-slide team-slide">
						<figure class="team-image">
							<img src="<?php echo esc_url( $image_url ); ?>" />
						</figure>
						<div class="team-content">
							<div class="team-text">
								<?php if ( ! empty( $member_name ) ) : ?>
									<div class="team-title"><?php echo esc_html( $member_name ); ?></div>
								<?php endif; ?>

								<?php if ( ! empty( $member_designation ) ) : ?>
									<div class="team-desc"><?php echo esc_html( $member_designation ); ?></div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
<?php endif;
