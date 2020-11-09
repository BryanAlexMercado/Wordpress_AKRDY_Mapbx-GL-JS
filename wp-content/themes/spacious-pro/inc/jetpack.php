<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function spacious_jetpack_setup() {
   // Add theme support for Infinite Scroll.
   add_theme_support( 'infinite-scroll', array(
      'container' => 'content',
      'render'    => 'spacious_infinite_scroll_render',
      'footer'    => 'page',
   ) );

   // Add theme support for Responsive Videos.
   add_theme_support( 'jetpack-responsive-videos' );

   // Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'spacious_style',
			'date'       => '.date',
			'categories' => '.category',
			'tags'       => '.tags',
			'author'     => '.author',
			'comment'    => '.comments',
		),
	) );
}
add_action( 'after_setup_theme', 'spacious_jetpack_setup' );
/**
 * Custom render function for Infinite Scroll.
 */
function spacious_infinite_scroll_render() {
   while ( have_posts() ) {
      the_post();
      if ( is_search() ) :
         get_template_part( 'content', get_post_format() );
      else :
         $format = spacious_posts_listing_display_type_select();
         get_template_part( 'content', $format );
      endif;
   }
}

/**
 * Enables Jetpack's Infinite Scroll in search pages, archive pages and blog pages and disables it in WooCommerce product archive pages
 * @return bool
 */
function spacious_jetpack_infinite_scroll_supported() {
   return current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() || is_search() ) && ! is_post_type_archive( 'product' );
}
add_filter( 'infinite_scroll_archive_supported', 'spacious_jetpack_infinite_scroll_supported' );
