<?php

/**
 * Class spacious_recent_work_widget.
 */
class spacious_recent_work_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_recent_work',
			'description'                 => esc_html__( 'Show your some pages as recent work. Best for Business Top or Bottom sidebar.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Featured Widget', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		for ( $i = 0; $i < 11; $i ++ ) {
			$var              = 'page_id' . $i;
			$defaults[ $var ] = '';
		}
		$att_defaults           = $defaults;
		$att_defaults['title']  = '';
		$att_defaults['text']   = '';
		$att_defaults['column'] = '4';
		$instance               = wp_parse_args( (array) $instance, $att_defaults );
		for ( $i = 0; $i < 11; $i ++ ) {
			$var = 'page_id' . $i;
			$var = absint( $instance[ $var ] );
		}
		$title  = esc_attr( $instance['title'] );
		$text   = esc_textarea( $instance['text'] );
		$column = $instance['column'];
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>
		<?php _e( 'Description', 'spacious' ); ?>
		<textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo $text; ?></textarea>
		<?php
		for ( $i = 0; $i < 11; $i ++ ) {
			?>
			<p>
				<label for="<?php echo $this->get_field_id( key( $defaults ) ); ?>"><?php _e( 'Page', 'spacious' ); ?>
					:</label>
				<?php wp_dropdown_pages( array(
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( key( $defaults ) ),
					'selected'         => $instance[ key( $defaults ) ],
				) ); ?>
			</p>
			<?php
			next( $defaults );// forwards the key of $defaults array
		} ?>

		</p>
		<?php esc_html_e( 'Select Column', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'column' ); ?>"
			        name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="2" <?php if ( $column == '2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Two Column', 'spacious' ); ?></option>
				<option value="4" <?php if ( $column == '4' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Four Column', 'spacious' ); ?></option>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		for ( $i = 0; $i < 11; $i ++ ) {
			$var              = 'page_id' . $i;
			$instance[ $var ] = absint( $new_instance[ $var ] );
		}
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] = $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		} // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset( $new_instance['filter'] );
		$instance['column'] = $new_instance['column'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title  = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text   = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$column = isset( $instance['column'] ) ? $instance['column'] : '4';

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Spacious Pro', 'TG: Featured Widget text' . $this->id, $text );
		}

		$page_array = array();
		for ( $i = 0; $i < 11; $i ++ ) {
			$var     = 'page_id' . $i;
			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

			if ( ! empty( $page_id ) ) {
				array_push( $page_array, $page_id );
			}// Push the page id in the array
		}
		$get_featured_pages = new WP_Query( array(
			'posts_per_page' => - 1,
			'post_type'      => array( 'page' ),
			'post__in'       => $page_array,
			'orderby'        => 'post__in',
		) );
		echo $before_widget;

		$featured_class      = ( $column == '4' ) ? 'tg-one-fourth' : 'tg-one-half';
		$featured_image_size = ( $column == '4' ) ? 'featured-blog-medium' : 'featured-blog-large';
		?>
		<div class="<?php echo esc_attr( $featured_class ); ?> tg-column-1">
			<?php
			if ( ! empty( $title ) ) {
				echo $before_title . esc_html( $title ) . $after_title;
			} ?>
			<p><?php
				// For WPML plugin compatibility
				if ( function_exists( 'icl_t' ) ) {
					$text = icl_t( 'Spacious Pro', 'TG: Featured Widget text' . $this->id, $text );
				}
				echo esc_textarea( $text ); ?></p>
		</div>
		<?php
		$i = 2;
		while ( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();

			if ( $column == '4' ) {
				if ( $i % 4 == 0 ) {
					$class = 'tg-one-fourth tg-one-fourth-last' . ' tg-column-' . $i;
				} elseif ( $i % 3 == 0 ) {
					$class = 'tg-one-fourth tg-after-two-blocks-clearfix' . ' tg-column-' . $i;
				} else {
					$class = 'tg-one-fourth' . ' tg-column-' . $i;
				}
			} else if ( $column == '2' ) {
				if ( $i % 2 == 0 ) {
					$class = 'tg-one-half tg-one-half-last' . ' tg-column-' . $i;
				} else {
					$class = 'tg-one-half tg-after-three-blocks-clearfix' . ' tg-column-' . $i;
				}
			}
			$page_title = get_the_title();
			?>
			<div class="<?php echo $class; ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$title_attribute     = get_the_title( $post->ID );
					$thumb_id            = get_post_thumbnail_id( get_the_ID() );
					$img_altr            = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
					$img_alt             = ! empty( $img_altr ) ? $img_altr : $title_attribute;
					$post_thumbnail_attr = array(
						'alt'   => esc_attr( $img_alt ),
						'title' => esc_attr( $title_attribute ),
					);
					echo '<div class="service-image"><a title="' . get_the_title() . '"href="' . get_permalink() . '">' . get_the_post_thumbnail( $post->ID, $featured_image_size, $post_thumbnail_attr ) . '</a></div>';
				}
				?>
			</div>
			<?php
			$i ++;
		endwhile;
		// Reset Post Data
		wp_reset_query();
		?>
		<?php echo $after_widget;
	}
}
