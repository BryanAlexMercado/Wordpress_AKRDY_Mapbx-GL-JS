<?php

/**
 * Class spacious_featured_posts_widget.
 */
class spacious_featured_posts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_featured_posts',
			'description'                 => esc_html__( 'Display latest posts or posts of specific category', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Featured Posts', 'spacious' ), $widget_ops );
	}

	function form( $instance ) {
		$tg_defaults['title']      = '';
		$tg_defaults['text']       = '';
		$tg_defaults['number']     = 4;
		$tg_defaults['image_size'] = 'featured-blog-medium';
		$tg_defaults['type']       = 'latest';
		$tg_defaults['category']   = '';
		$tg_defaults['tag']        = '';
		$tg_defaults['author']     = '';
		$tg_defaults['column']     = 'featured-post-column-layout-2';
		$instance                  = wp_parse_args( (array) $instance, $tg_defaults );
		$title                     = esc_attr( $instance['title'] );
		$text                      = esc_textarea( $instance['text'] );
		$number                    = $instance['number'];
		$type                      = $instance['type'];
		$category                  = $instance['category'];
		$tag                       = $instance['tag'];
		$author                    = $instance['author'];
		$image_size                = $instance['image_size'];
		$column                    = $instance['column'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<?php _e( 'Description', 'spacious' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to display:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input type="radio" <?php checked( $image_size, 'featured' ) ?> id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>" value="featured" /><?php _e( 'Large Featured Image', 'spacious' ); ?>
			<br />
			<input type="radio" <?php checked( $image_size, 'featured-blog-medium' ) ?> id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>" value="featured-blog-medium" /><?php _e( 'Medium Featured Image', 'spacious' ); ?>
			<br /></p>

		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest" /><?php _e( 'Show latest Posts', 'spacious' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category" /><?php _e( 'Show posts from a category', 'spacious' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'tag' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="tag" /><?php _e( 'Show posts from a tag', 'spacious' ); ?>
			<br />
			<input type="radio" <?php checked( $type, 'author' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="author" /><?php _e( 'Show posts from an author', 'spacious' ); ?>
			<br />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'spacious' ); ?>
				:</label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'category' ),
				'selected'         => $category,
			) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tag' ) ); ?>"><?php esc_html_e( 'Select tag', 'spacious' ); ?></label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'tag' ),
				'selected'         => $tag,
				'taxonomy'         => 'post_tag',
			) ); ?>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php esc_html_e( 'Select author', 'spacious' ); ?></label>
			<?php
			wp_dropdown_users( array(
				'show_option_none' => ' ',
				'name'             => $this->get_field_name( 'author' ),
				'selected'         => $author,
				'orderby'          => 'name',
				'order'            => 'ASC',
				'who'              => 'authors'
			) );
			?>
		</p>
		<?php esc_html_e( 'Select the featured post column', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'column' ); ?>" name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="featured-post-column-layout-1" <?php if ( $column == 'featured-post-column-layout-1' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'One Column', 'spacious' ); ?></option>
				<option value="featured-post-column-layout-2" <?php if ( $column == 'featured-post-column-layout-2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Two Column', 'spacious' ); ?></option>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		}
		$instance['number']     = absint( $new_instance['number'] );
		$instance['image_size'] = $new_instance['image_size'];
		$instance['type']       = $new_instance['type'];
		$instance['category']   = $new_instance['category'];
		$instance['tag']        = $new_instance['tag'];
		$instance['author']     = $new_instance['author'];
		$instance['column']     = $new_instance['column'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title      = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text       = isset( $instance['text'] ) ? $instance['text'] : '';
		$number     = empty( $instance['number'] ) ? 4 : $instance['number'];
		$image_size = isset( $instance['image_size'] ) ? $instance['image_size'] : 'featured-blog-medium';
		$type       = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category   = isset( $instance['category'] ) ? $instance['category'] : '';
		$tag        = isset( $instance['tag'] ) ? $instance['tag'] : '';
		$author     = isset( $instance['author'] ) ? $instance['author'] : '';
		$column     = isset( $instance['column'] ) ? $instance['column'] : 'featured-post-column-layout-2';

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Spacious Pro', 'TG: Featured posts widget description text' . $this->id, $text );
		}

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);

		// Displays from category chosen.
		if ( $type == 'category' ) {
			$args['category__in'] = $category;
		}

		// Displays from tag chosen.
		if ( $type == 'tag' ) {
			$args['tag__in'] = $tag;
		}

		// Displays from author choosen.
		if ( $type == 'author' ) {
			$args['author__in'] = $author;
		}

		echo $before_widget;
		?>
		<?php
		if ( $image_size == 'featured-blog-medium' ) {
			$featured    = 'featured-blog-medium';
			$image_class = 'post-featured-image';
		} else {
			$featured    = 'featured';
			$image_class = 'post-featured-iamge-large';
		}

		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		} ?>
		<p class="widget-desc"><?php
			// For WPML plugin compatibility
			if ( function_exists( 'icl_t' ) ) {
				$text = icl_t( 'Spacious Pro', 'TG: Featured posts widget description text' . $this->id, $text );
			}
			echo esc_textarea( $text ); ?></p>
		<?php
		$i = 1;
		$get_featured_posts = new WP_Query( $args );
		while ( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
			if ( $column == 'featured-post-column-layout-2') {
				if ( $i % 2 == 0 ) {
					$class = 'tg-one-half tg-one-half-last';
				} else {
					$class = 'tg-one-half';
				}
				if ( $i % 2 == 1 && $i > 1 ) {
					$class .= ' tg-featured-posts-clearfix';
				}
			} else if ( $column == 'featured-post-column-layout-1') {
				$class = 'tg-column-full';
			}
			?>
			<div class="<?php echo $class; ?>">
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2><!-- .entry-title -->
				</header>
				<?php
				if ( has_post_thumbnail() ) {
					$image           = '';
					$title_attribute = get_the_title( $post->ID );
					$thumb_id        = get_post_thumbnail_id( get_the_ID() );
					$img_altr        = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
					$img_alt         = ! empty( $img_altr ) ? $img_altr : $title_attribute;
					$image           .= '<figure class="' . $image_class . '">';
					$image           .= '<a href="' . get_permalink() . '" title="' . the_title( '', '', false ) . '">';
					$image           .= get_the_post_thumbnail( $post->ID, $featured, array(
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

				<footer class="entry-meta-bar clearfix">
					<div class="entry-meta clearfix">
						<span class="by-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
						<span class="date"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( get_the_time() ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
						<?php if ( spacious_options( 'spacious_post_meta_category', 0 ) == 0 ) { ?>
							<?php if ( has_category() ) { ?>
								<span class="category"><?php the_category( ', ' ); ?></span>
							<?php } ?>
						<?php } ?>
						<?php if ( spacious_options( 'spacious_post_meta_comments', 0 ) == 0 ) { ?>
							<?php if ( comments_open() ) { ?>
								<span class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
							<?php } ?>
						<?php } ?>
						<?php if ( spacious_options( 'spacious_post_meta_edit_button', 0 ) == 0 ) { ?>
							<?php edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' ); ?>
						<?php } ?>
						<span class="read-more-link"><a class="read-more" href="<?php the_permalink(); ?>"><?php echo spacious_options( 'spacious_read_more_text', __( 'Read more', 'spacious' ) ); ?></a></span>
					</div>
				</footer>

			</div>
			<?php
			$i++;
		endwhile;
		// Reset Post Data
		wp_reset_query();
		?>
		<?php echo $after_widget;
	}

}
