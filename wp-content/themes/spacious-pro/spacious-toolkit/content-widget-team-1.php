<?php
/**
 * The template for displaying Team 1 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-team-1.php.
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
 * @var $instance SPT_TEAM_1
 */

use Elementor\SPT_TEAM_1;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$member_name        = $instance->get_settings( 'member_name' );
$member_designation = $instance->get_settings( 'member_designation' );
$member_image       = $instance->get_settings( 'member_image' );
$member_image_url   = $member_image['url'];
$member_description = $instance->get_settings( 'member_description' );

$alignment       = $instance->get_settings( 'team_content_alignment' );
$alignment_class = ! empty( $alignment ) ? $alignment : 'none';

// Social links
$socials = array( 'facebook', 'twitter', 'google_plus', 'linkedin' );

$instance->add_render_attribute( 'member_name', 'class', 'team-member__title' );
$instance->add_render_attribute( 'member_designation', 'class', 'team-member__position' );
$instance->add_render_attribute( 'member_description', 'class', 'team-member__description' );
?>

<div class="team-member">
	<?php if ( ! empty( $member_image_url ) ): ?>
		<div class="team-member__thumbnail">
			<img src="<?php echo esc_url( $member_image_url ); ?>" alt="">
		</div> <!-- team-member__thumbnail -->
	<?php endif; ?>

	<div class="team-member__info spacious-align-<?php echo esc_attr( $alignment ); ?>">
		<?php if ( ! empty( $member_name ) ):
			echo '<h3 ' . $instance->get_render_attribute_string( "member_name" ) . '>' . esc_html( $member_name ) . '</h3>';
		endif;

		if ( ! empty( $member_designation ) ):
			echo '<p ' . $instance->get_render_attribute_string( "member_designation" ) . '>' . esc_html( $member_designation ) . '</p>';
		endif;

		if ( ! empty( $member_description ) ):
			echo '<p ' . $instance->get_render_attribute_string( "member_description" ) . '>' . esc_html( $member_description ) . '</p>';
		endif; ?>

		<div class="team-member__social">
			<ul class="social-icons">
				<?php foreach ( $socials as $social ) :
					$social_link = $instance->get_settings( 'member_' . $social );
					$url         = $social . '_url';
					$$url        = $social_link['url'];

					$target  = $social . '_target';
					$$target = $social_link['is_external'] ? ' target="_blank"' : '';

					$nofollow  = $social . '_nofollow';
					$$nofollow = ( $social_link['nofollow'] === 'on' ) ? ' rel="nofollow"' : '';

					if ( ! empty( $$url ) ) : ?>
						<li><a class="team-social-icon" href="<?php echo esc_url( $$url ); ?>" <?php echo $$target . $$nofollow; ?>><i
										class="fa fa-<?php echo esc_attr( str_replace( '_', '-', $social ) ); ?>"></i></a>
						</li>
					<?php endif;
				endforeach; ?>
			</ul>
		</div> <!-- team-member__social -->

	</div> <!-- team-member__info -->
</div> <!-- team-member -->
