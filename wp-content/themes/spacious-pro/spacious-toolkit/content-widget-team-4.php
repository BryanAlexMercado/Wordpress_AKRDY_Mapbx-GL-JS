<?php
/**
 * The template for displaying Team 4 widget.
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/content-widget-team-4.php.
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
 * @var $instance SPT_TEAM_4
 */

use Elementor\SPT_TEAM_4;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$member_name        = $instance->get_settings( 'member_name' );
$member_designation = $instance->get_settings( 'member_designation' );
$member_image       = $instance->get_settings( 'member_image' );
$member_image_url   = $member_image['url'];

// Social links
$socials = array( 'facebook', 'twitter', 'instagram', 'pinterest_p' );


$instance->add_render_attribute( 'member_name', 'class', 'team-member__title' );
$instance->add_render_attribute( 'member_designation', 'class', 'team-member__position' );
?>

<div class="team-member team-style-four">
	<?php if ( ! empty( $member_image_url ) ): ?>
		<figure class="team-member__thumbnail">
			<img src="<?php echo esc_url( $member_image_url ); ?>" alt="">
		</figure>
	<?php endif;

	if ( ! empty( $member_designation ) ):
		echo '<p ' . $instance->get_render_attribute_string( "member_designation" ) . '>' . esc_html( $member_designation ) . '</p>';
	endif;

	if ( ! empty( $member_name ) ):
		echo '<h3 ' . $instance->get_render_attribute_string( "member_name" ) . '>' . esc_html( $member_name ) . '</h3>';
	endif; ?>

	<ul class="social-icons social-icons--border">
		<?php foreach ( $socials as $social ) :
			$social_link = $instance->get_settings( 'member_' . $social );
			$url         = $social . '_url';
			$$url        = $social_link['url'];

			$target  = $social . '_target';
			$$target = $social_link['is_external'] ? ' target="_blank"' : '';

			$nofollow  = $social . '_nofollow';
			$$nofollow = ( $social_link['nofollow'] === 'on' ) ? ' rel="nofollow"' : '';

			if ( ! empty( $$url ) ) : ?>
				<li><a href="<?php echo esc_url( $$url ); ?>" <?php echo $$target . $$nofollow; ?>><i
								class="fa fa-<?php echo esc_attr( str_replace( '_', '-', $social ) ); ?>"></i></a></li>
			<?php endif;
		endforeach; ?>
	</ul>
</div> <!-- .team-member -->