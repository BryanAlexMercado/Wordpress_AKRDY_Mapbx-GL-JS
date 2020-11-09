<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'spacious_before_post_content' ); ?>

	<?php
	if( !is_single() ) {
	?>
	<header class="entry-header">
	<h2 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
	</h2><!-- .entry-title -->
	</header>
	<?php
	}
	?>

	<div class="entry-content clearfix">
		<?php
			the_excerpt();
		?>
	</div>

	<?php spacious_entry_meta(); ?>

	<?php
	do_action( 'spacious_after_post_content' );
   ?>
</article>

