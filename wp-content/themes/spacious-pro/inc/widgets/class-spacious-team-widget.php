<?php

/**
 * Class spacious_team_widget.
 */
class spacious_team_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_team_block',
			'description'                 => esc_html__( 'Display some pages as team. Best for Business Top or Bottom sidebar.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Team', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$background_color_value = ( spacious_options( 'spacious_color_skin', 'light' ) == 'light' ) ? '#f9f9f9' : '#3e3e3e';

		$defaults                            = array();
		$defaults['title']                   = '';
		$defaults['text']                    = '';
		$defaults['image_link']              = '';
		$defaults['title_link']              = '';
		$defaults['read_more_button_enable'] = '';
		$defaults['select_column']           = 'teams-column-layout-3';
		$defaults['open_in_new_tab']         = '';
		$defaults['background_color']        = $background_color_value;
		$defaults['team_layout']             = 'default';

		for ( $i = 0; $i < 12; $i++ ) {
			$defaults[ 'page_' . $i ]        = '';
			$defaults[ 'designation_' . $i ] = '';
			$defaults[ 'fbook_' . $i ]       = '';
			$defaults[ 'twitter_' . $i ]     = '';
			$defaults[ 'gplus_' . $i ]       = '';
			$defaults[ 'linkedin_' . $i ]    = '';
			$defaults[ 'instagram_' . $i ]   = '';
		}

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title                   = $instance['title'];
		$text                    = $instance['text'];
		$image_link              = $instance['image_link'] ? 'checked="checked"' : '';
		$title_link              = $instance['title_link'] ? 'checked="checked"' : '';
		$read_more_button_enable = $instance['read_more_button_enable'] ? 'checked="checked"' : '';
		$open_in_new_tab         = $instance['open_in_new_tab'] ? 'checked="checked"' : '';
		$select_column           = $instance['select_column'];
		$background_color        = esc_attr( $instance['background_color'] );
		$team_layout             = $instance['team_layout'];

		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<?php esc_html_e( 'Description', 'spacious' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'text' ); ?>"
		          name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo esc_textarea( $text ); ?></textarea>

		<?php
		for ( $i = 0; $i < 12; $i++ ) : ?>
			<p>
				<label
					for="<?php echo $this->get_field_id( 'page_' . $i ); ?>"><?php esc_html_e( 'Page:', 'spacious' ); ?></label>
				<?php
				$arg = array(
					'class'            => 'widefat',
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( 'page_' . $i ),
					'id'               => $this->get_field_id( 'page_' . $i ),
					'selected'         => absint( $instance[ 'page_' . $i ] ),
				);
				wp_dropdown_pages( $arg ); ?>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'designation_' . $i ); ?>"><?php esc_html_e( 'Designation:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'designation_' . $i ); ?>" class="widefat"
				       name="<?php echo $this->get_field_name( 'designation_' . $i ); ?>" type="text"
				       value="<?php if ( isset ( $instance[ 'designation_' . $i ] ) ) {
					       echo esc_attr( $instance[ 'designation_' . $i ] );
				       } ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'fbook_' . $i ); ?>"><?php esc_html_e( 'Facebook:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'fbook_' . $i ); ?>" class="widefat"
				       name="<?php echo $this->get_field_name( 'fbook_' . $i ); ?>" type="text"
				       value="<?php if ( isset ( $instance[ 'fbook_' . $i ] ) ) {
					       echo esc_url( $instance[ 'fbook_' . $i ] );
				       } ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'twitter_' . $i ); ?>"><?php esc_html_e( 'Twitter:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'twitter_' . $i ); ?>" class="widefat"
				       name="<?php echo $this->get_field_name( 'twitter_' . $i ); ?>" type="text"
				       value="<?php if ( isset ( $instance[ 'twitter_' . $i ] ) ) {
					       echo esc_url( $instance[ 'twitter_' . $i ] );
				       } ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'gplus_' . $i ); ?>"><?php esc_html_e( 'Google Plus:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'gplus_' . $i ); ?>" class="widefat"
				       name="<?php echo $this->get_field_name( 'gplus_' . $i ); ?>" type="text"
				       value="<?php if ( isset ( $instance[ 'gplus_' . $i ] ) ) {
					       echo esc_url( $instance[ 'gplus_' . $i ] );
				       } ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'linkedin_' . $i ); ?>"><?php esc_html_e( 'LinkedIn:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'linkedin_' . $i ); ?>" class="widefat"
				       name="<?php echo $this->get_field_name( 'linkedin_' . $i ); ?>" type="text"
				       value="<?php if ( isset ( $instance[ 'linkedin_' . $i ] ) ) {
					       echo esc_url( $instance[ 'linkedin_' . $i ] );
				       } ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'instagram_' . $i ); ?>"><?php esc_html_e( 'Instagram:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( 'instagram_' . $i ); ?>" class="widefat"
				       name="<?php echo $this->get_field_name( 'instagram_' . $i ); ?>" type="text"
				       value="<?php if ( isset ( $instance[ 'instagram_' . $i ] ) ) {
					       echo esc_url( $instance[ 'instagram_' . $i ] );
				       } ?>"/>
			</p>

			<hr/>

		<?php endfor; ?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php esc_html_e( 'Background Color:', 'spacious' ); ?></label><br/>
			<input id="<?php echo $this->get_field_id( 'background_color' ); ?>" class="widefat tg-color-picker"
			       name="<?php echo $this->get_field_name( 'background_color' ); ?>" type="text"
			       value="<?php echo esc_attr( $instance['background_color'] ); ?>"
			       data-default-color="<?php echo esc_attr( $background_color_value ); ?>"/>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $image_link; ?>
			       id="<?php echo $this->get_field_id( 'image_link' ); ?>"
			       name="<?php echo $this->get_field_name( 'image_link' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'image_link' ); ?>"><?php esc_html_e( 'Link featured image to their respective page', 'spacious' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $title_link; ?>
			       id="<?php echo $this->get_field_id( 'title_link' ); ?>"
			       name="<?php echo $this->get_field_name( 'title_link' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'title_link' ); ?>"><?php esc_html_e( 'Link title to their respective page', 'spacious' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $read_more_button_enable; ?>
			       id="<?php echo $this->get_field_id( 'read_more_button_enable' ); ?>"
			       name="<?php echo $this->get_field_name( 'read_more_button_enable' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'read_more_button_enable' ); ?>"><?php esc_html_e( 'Enable the read more button.', 'spacious' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $open_in_new_tab; ?>
			       id="<?php echo $this->get_field_id( 'open_in_new_tab' ); ?>"
			       name="<?php echo $this->get_field_name( 'open_in_new_tab' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'open_in_new_tab' ); ?>"><?php esc_html_e( 'Check to open in new tab.', 'spacious' ); ?></label>
		</p>

		<?php esc_html_e( 'Select the teams column', 'spacious' ); ?>

		<p>
			<select id="<?php echo $this->get_field_id( 'select_column' ); ?>"
			        name="<?php echo $this->get_field_name( 'select_column' ); ?>">
				<option value="teams-column-layout-2" <?php if ( $select_column == 'teams-column-layout-2' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Two Column', 'spacious' ); ?></option>
				<option value="teams-column-layout-3" <?php if ( $select_column == 'teams-column-layout-3' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Three Column', 'spacious' ); ?></option>
				<option value="teams-column-layout-4" <?php if ( $select_column == 'teams-column-layout-4' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Four Column', 'spacious' ); ?></option>
			</select>
		</p>
		</p>
		<?php esc_html_e( 'Select Layout', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'team_layout' ); ?>"
			        name="<?php echo $this->get_field_name( 'team_layout' ); ?>">
				<option value="default" <?php if ( $team_layout == 'default' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Default', 'spacious' ); ?></option>
				<option value="1" <?php if ( $team_layout == '1' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Layout One', 'spacious' ); ?></option>
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
		$instance['background_color'] = strtolower( $new_instance['background_color'] );

		for ( $i = 0; $i < 12; $i++ ) {
			$instance[ 'page_' . $i ]        = absint( $new_instance[ 'page_' . $i ] );
			$instance[ 'designation_' . $i ] = sanitize_text_field( $new_instance[ 'designation_' . $i ] );
			$instance[ 'fbook_' . $i ]       = esc_url_raw( $new_instance[ 'fbook_' . $i ] );
			$instance[ 'twitter_' . $i ]     = esc_url_raw( $new_instance[ 'twitter_' . $i ] );
			$instance[ 'gplus_' . $i ]       = esc_url_raw( $new_instance[ 'gplus_' . $i ] );
			$instance[ 'linkedin_' . $i ]    = esc_url_raw( $new_instance[ 'linkedin_' . $i ] );
			$instance[ 'instagram_' . $i ]   = esc_url_raw( $new_instance[ 'instagram_' . $i ] );
		}
		$instance['image_link']              = isset( $new_instance['image_link'] ) ? 1 : 0;
		$instance['title_link']              = isset( $new_instance['title_link'] ) ? 1 : 0;
		$instance['read_more_button_enable'] = isset( $new_instance['read_more_button_enable'] ) ? 1 : 0;
		$instance['select_column']           = sanitize_key( $new_instance['select_column'] );
		$instance['open_in_new_tab']         = isset( $new_instance['open_in_new_tab'] ) ? 1 : 0;
		$instance['team_layout']             = $new_instance['team_layout'];

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$background_color_value  = ( spacious_options( 'spacious_color_skin', 'light' ) == 'light' ) ? '#f9f9f9' : '#3e3e3e';
		$title                   = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$text                    = isset( $instance['text'] ) ? $instance['text'] : '';
		$image_link              = ! empty( $instance['image_link'] ) ? 'true' : 'false';
		$title_link              = ! empty( $instance['title_link'] ) ? 'true' : 'false';
		$read_more_button_enable = ! empty( $instance['read_more_button_enable'] ) ? 'true' : 'false';
		$open_in_new_tab         = ! empty( $instance['open_in_new_tab'] ) ? 'true' : 'false';
		$select_column           = isset( $instance['select_column'] ) ? $instance['select_column'] : 'teams-column-layout-3';
		$background_color        = isset( $instance['background_color'] ) ? $instance['background_color'] : $background_color_value;
		$team_layout             = isset( $instance['team_layout'] ) ? $instance['team_layout'] : 'default';

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) && ! empty( $text ) ) {
			icl_register_string( 'Spacious Pro', 'TG: Team widget description text' . $this->id, $text );
		}

		$page        = array();
		$designation = array();
		$fbook       = array();
		$twitter     = array();
		$gplus       = array();
		$linkedin    = array();
		$instagram   = array();
		for ( $i = 0; $i < 12; $i++ ) {
			$page[]        = isset( $instance[ 'page_' . $i ] ) ? $instance[ 'page_' . $i ] : '';
			$designation[] = isset( $instance[ 'designation_' . $i ] ) ? $instance[ 'designation_' . $i ] : '';
			$fbook[]       = isset( $instance[ 'fbook_' . $i ] ) ? $instance[ 'fbook_' . $i ] : '';
			$twitter[]     = isset( $instance[ 'twitter_' . $i ] ) ? $instance[ 'twitter_' . $i ] : '';
			$gplus[]       = isset( $instance[ 'gplus_' . $i ] ) ? $instance[ 'gplus_' . $i ] : '';
			$linkedin[]    = isset( $instance[ 'linkedin_' . $i ] ) ? $instance[ 'linkedin_' . $i ] : '';
			$instagram[]   = isset( $instance[ 'instagram_' . $i ] ) ? $instance[ 'instagram_' . $i ] : '';

			// For WPML plugin compatibility
			if ( function_exists( 'icl_register_string' ) ) {
				if ( ! empty ( $designation ) ) {
					icl_register_string( 'Spacious Pro', 'TG: Team widget team member designation' . $this->id . $i, $designation[ $i ] );
				}
			}
		}

		if ( ! empty( $page ) ) {
			$get_featured_pages = new WP_Query( array(
				'posts_per_page' => count( $page ),
				'post_type'      => array( 'page' ),
				'post__in'       => $page,
				'orderby'        => 'post__in',
			) );

			echo $before_widget;

			if ( ! empty( $title ) ) {
				echo $before_title . esc_html( $title ) . $after_title;
			} ?>
			<p class="widget-desc"><?php
				// For WPML plugin compatibility
				if ( function_exists( 'icl_t' ) ) {
					$text = icl_t( 'Spacious Pro', 'TG: Team widget description text' . $this->id, $text );
				}
				echo esc_textarea( $text );
				?></p>
			<div
				class="team-member-wrapper clearfix <?php echo esc_attr( $select_column ); ?>">
				<?php if ( $background_color != $background_color_value ) : ?>
					<style type="text/css">
						<?php
						echo '#' . $this->id;
						echo ', #' . $this->id . '::before';
						echo ', #' . $this->id . '::after';
						?>
						{
							background:
						<?php echo esc_attr( $background_color ); ?>
						}
					</style>
				<?php endif; ?>
				<?php
				$key = 0;
				while ( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
					$post_count = $key + 1;
					$team_class = '';
					$col_num    = '';
					if ( $select_column == 'teams-column-layout-2' ) :
						if ( $post_count % 2 == 0 ) {
							$team_class = 'tg-one-half tg-one-half-last team-member';
						} else {
							$team_class = 'tg-one-half team-member';
						}
						$col_num = 2;
					elseif ( $select_column == 'teams-column-layout-3' ) :
						if ( $post_count % 3 == 0 ) {
							$team_class = "tg-one-third tg-one-third-last team-member";
						} else {
							$team_class = "tg-one-third team-member";
						}
						$col_num = 3;
					elseif ( $select_column == 'teams-column-layout-4' ) :
						if ( $post_count % 4 == 0 ) {
							$team_class = 'tg-one-fourth tg-one-fourth-last team-member';
						} else {
							$team_class = 'tg-one-fourth team-member';
						}
						$col_num = 4;
					endif;
					$team_layout_class = '';
					if ( $team_layout == '1' ) {
						$team_layout_class = 'team-layout-one';
					}
					?>
					<div class="<?php echo esc_attr( $team_class ); ?> <?php echo esc_attr( $team_layout_class ); ?>">
						<div class="team-main-wrapper">
							<?php
							$new_tab = '';
							if ( $open_in_new_tab == "true" ) {
								$new_tab = 'target="_blank"';
							}
							?>
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
								if ( $image_link == 'true' ) {
									echo '<div class="team-image"><a title="' . esc_attr( get_the_title() ) . '" href="' . esc_url( get_permalink() ) . '"' . esc_attr( $new_tab ) . '>' . get_the_post_thumbnail( $post->ID, 'featured-blog-medium', $post_thumbnail_attr ) . '</a></div>';
								} else {
									echo '<div class="team-image">' . get_the_post_thumbnail( $post->ID, 'featured-blog-medium' ) . '</div>';
								}
							}
							?>
							<div class="team-info-outer-wrapper">
								<div class="team-info-wrapper">
									<h3 class="team-title">
										<?php if ( $title_link == 'true' ) : ?>
											<a title="<?php the_title_attribute(); ?>"
											   href="<?php the_permalink(); ?>" <?php echo esc_attr( $new_tab ); ?>><?php the_title(); ?></a>
										<?php else : ?>
											<?php the_title(); ?>
										<?php endif; ?>

									</h3><!-- .team-title -->
									<?php if ( ! empty( $designation[ $key ] ) ) :
										// For WPML plugin compatibility
										if ( function_exists( 'icl_t' ) ) {
											$designation[ $key ] = icl_t( 'Spacious Pro', 'TG: Team widget team member designation' . $this->id . $key, $designation[ $key ] );
										} ?>
										<span
											class="team-designation"><?php echo esc_html( $designation[ $key ] ); ?></span>
									<?php endif; ?>

									<?php if ( ! empty( $fbook ) || ! empty( $twitter ) || ! empty( $gplus ) || ! empty( $linkedin ) || ! empty( $instagram ) ) : ?>
										<div class="team-social-icon">
											<ul>
												<?php if ( $fbook[ $key ] != '' ) : ?>
													<li>
														<a href="<?php echo esc_url( $fbook[ $key ] ); ?>"><i
																class="fa fa-facebook"
																aria-hidden="true"></i></a>
													</li>
												<?php endif; ?>

												<?php if ( $twitter[ $key ] != '' ) : ?>
													<li>
														<a href="<?php echo esc_url( $twitter[ $key ] ); ?>"><i
																class="fa fa-twitter" aria-hidden="true"></i></a>
													</li>
												<?php endif; ?>
												<?php if ( $gplus[ $key ] != '' ) : ?>
													<li>
														<a href="<?php echo esc_url( $gplus[ $key ] ); ?>"><i
																class="fa fa-google-plus" aria-hidden="true"></i></a>
													</li>
												<?php endif; ?>
												<?php if ( $linkedin[ $key ] != '' ) : ?>
													<li>
														<a href="<?php echo esc_url( $linkedin[ $key ] ); ?>"><i
																class="fa fa-linkedin" aria-hidden="true"></i></a>
													</li>
												<?php endif; ?>
												<?php if ( $instagram[ $key ] != '' ) : ?>
													<li>
														<a href="<?php echo esc_url( $instagram[ $key ] ); ?>"><i
																class="fa fa-instagram" aria-hidden="true"></i></a>
													</li>
												<?php endif; ?>
											</ul>
										</div><!-- .team-social-icon -->
									<?php endif; ?>
								</div>
							</div>

							<?php if ( $team_layout == 'default' ) { ?>
								<div class="team-description">
									<?php the_excerpt(); ?>
								</div><!-- .team-description -->
								<?php if ( $read_more_button_enable == "true" ) { ?>
									<div class="more-link-wrap">
										<a class="more-link" title="<?php the_title_attribute(); ?>"
										   href="<?php the_permalink(); ?>" <?php echo esc_attr( $new_tab ); ?>><?php echo spacious_options( 'spacious_read_more_text', esc_html__( 'Read more', 'spacious' ) ); ?></a>
									</div><!-- .more-link-wrap -->
								<?php } ?>
							<?php } ?>
						</div>
						<?php if ( $post_count % $col_num == 0 ) {
							echo '<div class="clearfix"></div>';
						} ?>
					</div>
					<?php $key++; ?>
				<?php endwhile;
				// Reset Post Data
				wp_reset_postdata();
				?>
			</div>
			<?php
			echo $after_widget;
		}
	}
}
