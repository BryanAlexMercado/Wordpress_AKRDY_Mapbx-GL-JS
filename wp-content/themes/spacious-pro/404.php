<?php
/**
 * The template for displaying 404 pages (Page Not Found).
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

<?php do_action( 'spacious_before_body_content' ); ?>

<div id="primary">
	<div id="content" class="clearfix">
		<section class="error-404 not-found">
			<div class="page-content">

				<?php if ( ! dynamic_sidebar( 'spacious_error_404_page_sidebar' ) ) : ?>
					<header class="page-header">
						<?php spacious_entry_title(); ?>
					</header>
					<p>
						<?php $text = spacious_options( 'spacious_404page_options_setting' );

						if ( ! empty ( $text ) ) {
							echo wp_kses_post( $text );
						} else {
							_e( 'It looks like nothing was found at this location. Try the search below.', 'spacious' );
							get_search_form();
						}
						?>
					</p>
				<?php endif; ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</div><!-- #content -->
</div><!-- #primary -->

<?php spacious_sidebar_select(); ?>

<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>
