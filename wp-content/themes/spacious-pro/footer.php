<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #main div.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */
?>

</div><!-- .inner-wrap -->
</div><!-- #main -->
<?php do_action( 'spacious_before_footer' ); ?>

<footer id="colophon" class="clearfix">
	<?php get_sidebar( 'footer' );
	$spacious_copyright = '';
	if ( spacious_options( 'spacious_copyright_layout', 'left' ) == 'center' ) {
		$spacious_copyright = ' copyright-center';
	}else if (spacious_options( 'spacious_copyright_layout', 'left' ) == 'right' ) {
		$spacious_copyright = ' copyright-right';
	} ?>
	<div class="footer-socket-wrapper clearfix<?php echo $spacious_copyright; ?>">
		<div class="inner-wrap">
			<div class="footer-socket-area">
				<?php do_action( 'spacious_footer_copyright' ); ?>
				<nav class="small-menu clearfix">
					<?php
					if ( ( spacious_options( 'spacious_footer_social', 'footer_menu' ) == 'footer_menu' ) && has_nav_menu( 'footer' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'depth'          => -1,
						) );
					} elseif ( ( spacious_options( 'spacious_footer_social', 'footer_menu' ) == 'social_menu' ) && spacious_options( 'spacious_activate_social_links', 0 ) == 1 ) {
						spacious_social_links();
					}
					?>
				</nav>
			</div>
		</div>
	</div>
</footer>

<?php if ( spacious_options( 'spacious_scroll_to_top_feature', 0 ) == 0 ) { ?>
	<a href="#masthead" id="scroll-up"></a>
<?php } ?>

<?php if ( spacious_options( 'spacious_header_search_layout', 'default' ) == 'style_one' ) : ?>
	<div class="footer-search-wrapper">
		<div class="footer-search-form">
			<div class="close"> &times;</div>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
