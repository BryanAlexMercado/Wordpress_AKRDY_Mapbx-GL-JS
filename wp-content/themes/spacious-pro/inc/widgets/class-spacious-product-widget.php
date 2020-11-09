<?php
/**
 * Class spacious_woocommerce_product.
 */

class spacious_woocommerce_product extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget-wc-product woocommerce-product woocommerce clearfix',
			'description' => esc_html__( 'Display WooCommerce Product.', 'spacious' ),
		);

		$control_ops = array(
			'width'  => 200,
			'height' => 250
		);

		parent::__construct( false, $name = esc_html__( 'TG: Product Widget', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$tg_defaults['title']                      = '';
		$tg_defaults['description']                = '';
		$tg_defaults['number']                     = 4;
		$tg_defaults['type']                       = 'latest';
		$tg_defaults['category']                   = '';
		$tg_defaults['column']                     = '4';
		$tg_defaults['layout']                     = 'default';
		$tg_defaults['productSlider_enable']       = '0';
		$tg_defaults['productSlider_speed']        = 1500;
		$tg_defaults['productSlider_delay']        = 4000;
		$tg_defaults['product_per_view']           = 4;
		$tg_defaults['productSlider_pauseOnhover'] = '0';

		$instance = wp_parse_args( (array) $instance, $tg_defaults );

		$title                      = esc_attr( $instance['title'] );
		$description                = esc_textarea( $instance['description'] );
		$number                     = $instance['number'];
		$type                       = $instance['type'];
		$category                   = $instance['category'];
		$column                     = $instance['column'];
		$layout                     = $instance['layout'];
		$productSlider_enable       = $instance['productSlider_enable'] ? 'checked="checked"' : '';
		$productSlider_pauseOnhover = $instance['productSlider_pauseOnhover'] ? 'checked="checked"' : '';
		$productSlider_speed        = $instance['productSlider_speed'];
		$productSlider_delay        = $instance['productSlider_delay'];
		$product_per_view           = $instance['product_per_view'];

		?>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<?php esc_html_e( 'Description:', 'spacious' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'description' ); ?>"
		          name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo $description; ?></textarea>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of products to display:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>"
			       name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>"
			       size="3"/>
		</p>

		<p>
			<input type="radio" <?php checked( $type, 'latest' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
			       name="<?php echo $this->get_field_name( 'type' ); ?>"
			       value="latest"/><?php _e( 'Show latest Products', 'spacious' ); ?>
			<br/>
			<input type="radio" <?php checked( $type, 'category' ) ?> id="<?php echo $this->get_field_id( 'type' ); ?>"
			       name="<?php echo $this->get_field_name( 'type' ); ?>"
			       value="category"/><?php _e( 'Show Products from a category', 'spacious' ); ?>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Select Category', 'spacious' ); ?>
				:</label>
			<?php
			wp_dropdown_categories(
				array(
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( 'category' ),
					'selected'         => $instance['category'],
					'taxonomy'         => 'product_cat'
				)
			);
			?>
		</p>

		<?php _e( 'Select Column', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'column' ); ?>"
			        name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="3" <?php if ( $column == '3' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Three Column', 'spacious' ); ?></option>
				<option value="4" <?php if ( $column == '4' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Four Column', 'spacious' ); ?></option>
			</select>
		</p>

		<?php _e( 'Select Layout', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>"
			        name="<?php echo $this->get_field_name( 'layout' ); ?>">
				<option value="default" <?php if ( $layout == 'default' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Default', 'spacious' ); ?></option>
				<option value="1" <?php if ( $layout == '1' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Layout One', 'spacious' ); ?></option>
				<option value="2" <?php if ( $layout == '2' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Layout Two', 'spacious' ); ?></option>
			</select>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $productSlider_enable; ?>
			       id="<?php echo $this->get_field_id( 'productSlider_enable' ); ?>"
			       name="<?php echo $this->get_field_name( 'productSlider_enable' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'productSlider_enable' ); ?>"><?php esc_html_e( 'Enable Slider', 'spacious' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $productSlider_pauseOnhover; ?>
			       id="<?php echo $this->get_field_id( 'productSlider_pauseOnhover' ); ?>"
			       name="<?php echo $this->get_field_name( 'productSlider_pauseOnhover' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'productSlider_pauseOnhover' ); ?>"><?php esc_html_e( 'Enable Pause on Hover', 'spacious' ); ?></label>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'productSlider_speed' ); ?>"><?php esc_html_e( 'Transition Speed Time (in ms):', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'productSlider_speed' ); ?>"
			       name="<?php echo $this->get_field_name( 'productSlider_speed' ); ?>" type="text"
			       value="<?php echo esc_attr( $productSlider_speed ); ?>" size="3"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'productSlider_delay' ); ?>"><?php esc_html_e( 'Transition delay Time (in ms):', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'productSlider_delay' ); ?>"
			       name="<?php echo $this->get_field_name( 'productSlider_delay' ); ?>" type="text"
			       value="<?php echo esc_attr( $productSlider_delay ); ?>" size="3"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'product_per_view' ); ?>"
			       class="widefat"><?php esc_html_e( 'Slides Per View:', 'spacious' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'product_per_view' ); ?>"
			        name="<?php echo $this->get_field_name( 'product_per_view' ); ?>">
				<option
					value="1" <?php echo esc_attr( '1' == $product_per_view ? 'selected="selected"' : '' ); ?> ><?php esc_html_e( 'One', 'spacious' ); ?></option>
				<option
					value="2" <?php echo esc_attr( '2' == $product_per_view ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'Two', 'spacious' ); ?></option>
				<option
					value="3" <?php echo esc_attr( '3' == $product_per_view ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'Three', 'spacious' ); ?></option>
				<option
					value="4" <?php echo esc_attr( '4' == $product_per_view ? 'selected="selected"' : '' ); ?> ><?php esc_html_e( 'Four', 'spacious' ); ?></option>
			</select>
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['description'] = $new_instance['description'];
		} else {
			$instance['description'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['description'] ) ) );
		}
		$instance['number']                     = absint( $new_instance['number'] );
		$instance['type']                       = $new_instance['type'];
		$instance['category']                   = $new_instance['category'];
		$instance['column']                     = $new_instance['column'];
		$instance['layout']                     = $new_instance['layout'];
		$instance['productSlider_enable']       = isset( $new_instance['productSlider_enable'] ) ? 1 : 0;
		$instance['productSlider_pauseOnhover'] = isset( $new_instance['productSlider_pauseOnhover'] ) ? 1 : 0;
		$instance['productSlider_speed']        = absint( $new_instance['productSlider_speed'] );
		$instance['productSlider_delay']        = absint( $new_instance['productSlider_delay'] );
		$instance['product_per_view']           = absint( $new_instance['product_per_view'] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$title                      = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$description                = apply_filters( 'widget_text', isset( $instance['description'] ) ? $instance['description'] : '' );
		$number                     = empty( $instance['number'] ) ? 4 : $instance['number'];
		$type                       = isset( $instance['type'] ) ? $instance['type'] : 'latest';
		$category                   = isset( $instance['category'] ) ? $instance['category'] : '';
		$column                     = isset( $instance['column'] ) ? $instance['column'] : '4';
		$layout                     = isset( $instance['layout'] ) ? $instance['layout'] : 'default';
		$productSlider_enable       = ! empty( $instance['productSlider_enable'] ) ? 'true' : 'false';
		$productSlider_pauseOnhover = ! empty( $instance['productSlider_pauseOnhover'] ) ? 'true' : 'false';
		$productSlider_speed        = empty( $instance['productSlider_speed'] ) ? 1500 : $instance['productSlider_speed'];
		$productSlider_delay        = empty( $instance['productSlider_delay'] ) ? 4000 : $instance['productSlider_delay'];
		$product_per_view           = empty( $instance['product_per_view'] ) ? 1 : $instance['product_per_view'];

		$args = array(
			'posts_per_page'      => $number,
			'post_type'           => 'product',
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				'relation' => 'OR',
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'exclude-from-catalog' ),
					'operator' => 'NOT IN',
				),
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'exclude-from-search' ),
					'operator' => 'NOT IN',
				)
			),
			'meta_key'            => '_thumbnail_id',
		);

		if ( $type == 'category' ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'id',
					'terms'    => $category
				),
				array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => array( 'exclude-from-catalog' ),
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_visibility',
						'field'    => 'name',
						'terms'    => array( 'exclude-from-search' ),
						'operator' => 'NOT IN',
					)
				)
			);
		}

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		} ?>
		<p class="widget-desc"><?php
			echo esc_textarea( $description ); ?></p>

		<?php
		$featured_products = new WP_Query( $args );
		$i                 = 1;
		$product_class     = 'tg-col-4';
		if ( $column == '3' ) {
			$product_class = 'tg-col-3';
		}

		$layout_class   = "";
		$layout_wrapper = "";
		if ( $layout == '1' ) {
			$layout_class   = 'layout-one';
			$layout_wrapper = 'woocommerce-image-wrapper-one';
		} else if ( $layout == '2' ) {
			$layout_class   = 'layout-two';
			$layout_wrapper = 'woocommerce-image-wrapper-two';
		}
		?>

		<div class="main-product-wrapper">
			<div class="product-container">
				<?php if ( $productSlider_enable == 'true' ) : ?>
					<div id="<?php echo esc_attr( $this->id ); ?>-cycle-prev" class="product-cycle-prev"></div>
					<div id="<?php echo esc_attr( $this->id ); ?>-cycle-next" class="product-cycle-next"></div>
				<?php endif; ?>

				<div
					class="product-wrapper products <?php echo ( $productSlider_enable == 'true' ) ? 'slider-enable' : ''; ?> <?php echo esc_attr( $layout_class ); ?>"
					<?php if ( $productSlider_enable == 'true' ) : ?>
						data-enable="<?php echo esc_attr( $productSlider_enable ); ?>"
						data-speed="<?php echo esc_attr( $productSlider_speed ); ?>"
						data-delay="<?php echo esc_attr( $productSlider_delay ); ?>"
						data-productSlider_pauseOnhover="<?php echo esc_attr( $productSlider_pauseOnhover ); ?>"
						data-product_per_view="<?php echo esc_attr( $product_per_view ); ?>"
						data-cycle-prev="#<?php echo esc_attr( $this->id ); ?>-cycle-prev"
						data-cycle-next="#<?php echo esc_attr( $this->id ); ?>-cycle-next"
					<?php endif; ?>
				>
					<?php
					while ( $featured_products->have_posts() ) :
						$featured_products->the_post();

						$product = wc_get_product( $featured_products->post->ID );
						?>

						<div class="<?php echo esc_html( $product_class ); ?> product">
							<?php echo ( $layout == '1' ) ? '<div class="product-outer-wrapper">' : ''; ?>
							<div class="woocommerce-image <?php echo esc_attr( $layout_wrapper ); ?>">
								<div class="woocommerce-featured-image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'woocommerce_thumbnail' ); ?>
									</a>
								</div>

								<?php if ( $product->is_on_sale() ) : ?>
									<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="on-sale">' . esc_html__( 'Sale!', 'spacious' ) . '</span>', $post, $product ); ?>
								<?php endif; ?>

								<?php if ( $layout == "1" ) { ?>
									<div class="add-to-cart">
										<?php woocommerce_template_loop_add_to_cart( $product ); ?>
									</div>
								<?php } ?>

								<?php if ( $layout == "2" ) { ?>
									<div class="hovered-cart-wishlist">
										<?php
										if ( function_exists( 'YITH_WCWL' ) ) {
											$url = add_query_arg( 'add_to_wishlist', $product->get_id() ); ?>
											<a href="<?php echo esc_url( $url ); ?>" class="add-to-wishlist">
												<i class="fa fa-heart"></i></a>
										<?php }

										echo spacious_woocommerce_add_to_cart_link( $product ); ?>
									</div>
								<?php } ?>
							</div>

							<div class="product-details">
								<div class="entry-title">
									<a href="<?php the_permalink(); ?>">
										<?php the_title(); ?>
									</a>
								</div>
								<?php if ( $layout == "1" ) { ?>
									<div class="woocommerce-product-rating woocommerce">
										<?php
										if ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) { ?>
											<?php echo $rating_html;
										} else {
											echo '<div class="star-rating"></div>';
										}
										?>
									</div>
								<?php } ?>

								<?php if ( $price_html = $product->get_price_html() ) : ?>
									<span class="price"><?php echo $price_html; ?></span>
								<?php endif; ?>

								<?php if ( $layout == "default" ) { ?>
									<div class="add-to-cart">
										<?php woocommerce_template_loop_add_to_cart( $product ); ?>
									</div>
								<?php } ?>
							</div>
							<?php echo ( $layout == '1' ) ? '</div>' : ''; ?>
						</div>

						<?php
						wp_reset_postdata();
					endwhile;
					?>
				</div>

			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
