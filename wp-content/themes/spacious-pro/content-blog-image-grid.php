<?php
/**
 * The template used for displaying blog image grid post.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 2.3.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'spacious_before_post_content' ); ?>

		<div class="grid-container">
			<header class="entry-header">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a>
				</h2><!-- .entry-title -->
			</header>

			<div class="post-image-content-wrap clearfix">
				<?php
				if( has_post_thumbnail() ) {
					$image           = '';
					$title_attribute = get_the_title( $post->ID );
					$thumb_id        = get_post_thumbnail_id( get_the_ID() );
					$img_altr        = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
					$img_alt         = ! empty( $img_altr ) ? $img_altr : $title_attribute;
					$image           .= '<figure class="post-featured-image">';
					$image           .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
					$image           .= get_the_post_thumbnail( $post->ID, 'featured', array(
							'title' => esc_attr( $title_attribute ),
							'alt'   => esc_attr( $img_alt ),
						) ) . '</a>';
					$image           .= '</figure>';

					echo $image;
				}
					?>

				<div class="entry-content clearfix">
					<?php
						the_excerpt();
					?>
				</div>
			</div>

			<div class="entry-meta clearfix">
				<span class="by-author author vcard"><a class="url fn n"
					                                        href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
					<?php
					$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
					if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
						$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
					}
					$time_string = sprintf( $time_string,
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() ),
						esc_attr( get_the_modified_date( 'c' ) ),
						esc_html( get_the_modified_date() )
					);
					printf( __( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></span>', 'spacious' ),
						esc_url( get_permalink() ),
						esc_attr( get_the_time() ),
						$time_string
					);
					?>
			</div>
		</div>

	<?php do_action( 'spacious_after_post_content' ); ?>
</article>
