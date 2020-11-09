<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

<?php do_action( 'spacious_before_body_content' ); ?>
<?php $blog_display = spacious_options( 'spacious_archive_display_type', 'blog_large' ); ?>

<div id="primary">
	<div id="content" class="clearfix">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

			<?php endwhile; ?>

			<?php if ( ( $blog_display == 'blog_large' ) || ( $blog_display == 'blog_medium' ) || ( $blog_display == 'blog_medium_alternate' ) || ( $blog_display == 'blog_medium_round' ) || ( $blog_display == 'blog_full_content' ) || ( $blog_display == 'blog_medium_round_alternate' ) ) { ?>
				<?php get_template_part( 'navigation', 'search' ); ?>
			<?php } ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

	</div><!-- #content -->

	<?php if ( ( $blog_display == 'blog_masonry_content' ) || ( $blog_display == 'blog_grid_content' ) ) { ?>
		<?php get_template_part( 'navigation', 'search' ); ?>
	<?php } ?>

</div><!-- #primary -->

<?php spacious_sidebar_select(); ?>

<?php do_action( 'spacious_after_body_content' ); ?>

<?php get_footer(); ?>
