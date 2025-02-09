<?php
/**
 * Contains all the fucntions and components related to header part.
 *
 * @package           ThemeGrill
 * @subpackage        Spacious
 * @since             Spacious 1.0
 */
/* * ************************************************************************************* */

if ( ! function_exists( 'spacious_social_links' ) ) :

	/**
	 * This function is for social links display on header
	 *
	 * Get links through Theme Options
	 */
	function spacious_social_links() {

		$spacious_social_links = array(
			'spacious_social_facebook'    => 'Facebook',
			'spacious_social_twitter'     => 'Twitter',
			'spacious_social_googleplus'  => 'GooglePlus',
			'spacious_social_instagram'   => 'Instagram',
			'spacious_social_codepen'     => 'CodePen',
			'spacious_social_digg'        => 'Digg',
			'spacious_social_dribbble'    => 'Dribbble',
			'spacious_social_flickr'      => 'Flickr',
			'spacious_social_github'      => 'GitHub',
			'spacious_social_linkedin'    => 'LinkedIn',
			'spacious_social_pinterest'   => 'Pinterest',
			'spacious_social_polldaddy'   => 'Polldaddy',
			'spacious_social_pocket'      => 'Pocket',
			'spacious_social_reddit'      => 'Reddit',
			'spacious_social_skype'       => 'Skype',
			'spacious_social_stumbleupon' => 'StumbleUpon',
			'spacious_social_tumblr'      => 'Tumblr',
			'spacious_social_vimeo'       => 'Vimeo',
			'spacious_social_wordpress'   => 'WordPress',
			'spacious_social_youtube'     => 'YouTube',
			'spacious_social_rss'         => 'RSS',
			'spacious_social_mail'        => 'Mail',
		);
		?>

		<?php
		// Adding additional custom social links
		$spacious_additional_social_link = array(
			'spacious_social_additional_icon_one'   => __( 'Additional Social Icon One', 'spacious' ),
			'spacious_social_additional_icon_two'   => __( 'Additional Social Icon Two', 'spacious' ),
			'spacious_social_additional_icon_three' => __( 'Additional Social Icon Three', 'spacious' ),
			'spacious_social_additional_icon_four'  => __( 'Additional Social Icon Four', 'spacious' ),
			'spacious_social_additional_icon_five'  => __( 'Additional Social Icon Five', 'spacious' ),
		);
		?>

		<div class="social-links clearfix">
			<ul>
				<?php
				$spacious_links_output = '';

				foreach ( $spacious_social_links as $key => $value ) {
					$link = spacious_options( $key, '' );
					if ( ! empty( $link ) ) {
						if ( spacious_options( $key . 'new_tab', '0' ) == '1' ) {
							$new_tab = 'target="_blank"';
						} else {
							$new_tab = '';
						}

						$spacious_links_output .= '<li class="spacious-' . strtolower( $value ) . '"><a href="' . esc_url( $link ) . '" ' . $new_tab . '></a></li>';
					}
				}

				echo $spacious_links_output;
				?>

				<?php
				$spacious_additional_links_output = '';

				foreach ( $spacious_additional_social_link as $key => $value ) {
					$link  = spacious_options( $key, '' );
					$color = spacious_options( $key . '_color' );

					if ( ! empty( $link ) ) {
						if ( spacious_options( $key . 'new_tab', 0 ) == 1 ) {
							$new_tab = 'target="_blank"';
						} else {
							$new_tab = '';
						}

						if ( ! empty( $color ) ) {
							$color_code = ' style="color:' . $color . '"';
						} else {
							$color_code = '';
						}

						$spacious_additional_links_output .= '<li><a href="' . esc_url( $link ) . '" ' . $new_tab . '><i class="fa fa-' . strtolower( spacious_options( $key . '_fontawesome' ) ) . '"' . $color_code . '></i></a></li>';
					}
				}

				echo $spacious_additional_links_output;
				?>
			</ul>
		</div><!-- .social-links -->
		<?php
	}

endif;

/* * ************************************************************************************* */

if ( ! function_exists( 'spacious_header_info_text' ) ) :

	/**
	 * Shows the small info text on top header part
	 */
	function spacious_header_info_text() {
		if ( spacious_options( 'spacious_header_info_text', '' ) == '' ) {
			return;
		}

		$spacious_header_info_text = '<div class="small-info-text"><p>' . spacious_options( 'spacious_header_info_text', '' ) . '</p></div>';

		echo do_shortcode( $spacious_header_info_text );
	}

endif;

/* * ************************************************************************************* */

// Filter the get_header_image_tag() for supporting the older way of displaying the header image and linking it to the required url be it home page or custom url
function spacious_header_image_markup( $html, $header, $attr ) {
	$output       = '';
	$header_image = get_header_image();

	if ( ! empty( $header_image ) ) {
		if ( spacious_options( 'spacious_header_image_link', 0 ) == 1 ) {
			if ( spacious_options( 'spacious_header_image_link_to_other_sites' ) != '' ) {
				$output .= '<a href="' . esc_url( spacious_options( 'spacious_header_image_link_to_other_sites' ) ) . '">';
			} else {
				$output .= '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">';
			}
		}

		$output .= '<img src="' . esc_url( $header_image ) . '" class="header-image" width="' . get_custom_header()->width . '" height="' . get_custom_header()->height . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">';

		if ( spacious_options( 'spacious_header_image_link', 0 ) == 1 ) {
			$output .= '</a>';
		}
	}

	return $output;
}

function spacious_header_image_markup_filter() {
	add_filter( 'get_header_image_tag', 'spacious_header_image_markup', 10, 3 );
}

add_action( 'spacious_header_image_markup_render', 'spacious_header_image_markup_filter' );

if ( ! function_exists( 'spacious_featured_image_slider' ) ) :

	/**
	 * display featured post slider
	 */
	function spacious_featured_image_slider() {
		global $post;
		?>

		<section id="featured-slider">
			<div class="slider-cycle">
				<?php
				$num_of_slides = spacious_options( 'spacious_slider_number', '5' );

				for ( $i = 1; $i <= $num_of_slides; $i ++ ) {
					$spacious_slider_title        = spacious_options( 'spacious_slider_title' . $i, '' );
					$spacious_slider_text         = spacious_options( 'spacious_slider_text' . $i, '' );
					$spacious_slider_image        = spacious_options( 'spacious_slider_image' . $i, '' );
					$spacious_slide_text_position = spacious_options( 'spacious_slide_text_position' . $i, 'left' );
					$spacious_slider_button_text  = spacious_options( 'spacious_slider_button_text' . $i, __( 'Read more', 'spacious' ) );
					$spacious_slider_link         = spacious_options( 'spacious_slider_link' . $i, '#' );
					$attachment_post_id           = attachment_url_to_postid( $spacious_slider_image );
					$image_attributes             = wp_get_attachment_image_src( $attachment_post_id, 'full');

					// For WPML plugin compatibility
					if ( function_exists( 'icl_register_string' ) ) {
						icl_register_string( 'Spacious Pro', 'Slider Title ' . $i, $spacious_slider_title );
						icl_register_string( 'Spacious Pro', 'Slider Description ' . $i, $spacious_slider_text );
						icl_register_string( 'Spacious Pro', 'Slider Button Text ' . $i, $spacious_slider_button_text );
						icl_register_string( 'Spacious Pro', 'Slider Button Link ' . $i, $spacious_slider_link );
						icl_register_string( 'Spacious Pro', 'Slider Image Link ' . $i, $spacious_slider_image );
					}

					if ( ! empty( $spacious_header_title ) || ! empty( $spacious_slider_text ) || ! empty( $spacious_slider_image ) ) {
						if ( $i == 1 ) {
							$classes = "slides displayblock";
						} else {
							$classes = "slides displaynone";
						}

						if ( $spacious_slide_text_position == 'right' ) {
							$classes2 = "entry-container entry-container-right";
						} else if ( $spacious_slide_text_position == 'center' ) {
							$classes2 = "entry-container entry-container-center";
						} else {
							$classes2 = "entry-container";
						}
						?>

						<div class="<?php echo $classes; ?>">

							<?php
							// For WPML plugin compatibility
							if ( function_exists( 'icl_t' ) ) {
								$spacious_slider_title       = icl_t( 'Spacious Pro', 'Slider Title ' . $i, $spacious_slider_title );
								$spacious_slider_text        = icl_t( 'Spacious Pro', 'Slider Description ' . $i, $spacious_slider_text );
								$spacious_slider_button_text = icl_t( 'Spacious Pro', 'Slider Button Text ' . $i, $spacious_slider_button_text );
								$spacious_slider_link        = icl_t( 'Spacious Pro', 'Slider Button Link ' . $i, $spacious_slider_link );
								$spacious_slider_image       = icl_t( 'Spacious Pro', 'Slider Image Link ' . $i, $spacious_slider_image );
							}
							?>

							<figure>
								<?php if ( spacious_options( 'spacious_slider_image_link_option', 0 ) == 1 ) { ?>
								<a href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>">
									<?php } ?>
									<?php $img_altr = get_post_meta( $attachment_post_id, '_wp_attachment_image_alt', true );
									$img_alt  = ! empty( $img_altr ) ? $img_altr : $spacious_slider_title; ?>

									<?php if ( ! empty ( $image_attributes ) ) { ?>
										<img width="<?php echo esc_attr($image_attributes[1]); ?>" height="<?php echo esc_attr($image_attributes[2]); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" src="<?php echo esc_url( $spacious_slider_image ); ?>">
									<?php } else { ?>
										<img alt="<?php echo esc_attr( $img_alt ); ?>" src="<?php echo esc_url( $spacious_slider_image ); ?>">
									<?php } ?>
									<?php if ( spacious_options( 'spacious_slider_image_link_option', 0 ) == 1 ) { ?>
								</a>
							<?php } ?>
							</figure>

							<div class="<?php echo $classes2; ?>">
								<?php if ( ! empty( $spacious_slider_title ) || ! empty( $spacious_slider_text ) ) { ?>
									<div class="entry-description-container">
										<div class="slider-title-head"><h3 class="entry-title">
												<a href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><span><?php echo $spacious_slider_title; ?></span></a>
											</h3></div>
										<div class="entry-content"><p><?php echo $spacious_slider_text; ?></p></div>
									</div>
								<?php } ?>

								<div class="clearfix"></div>

								<?php if ( ! empty( $spacious_slider_button_text ) ) { ?>
									<a class="slider-read-more-button" href="<?php echo esc_url( $spacious_slider_link ); ?>" title="<?php echo esc_attr( $spacious_slider_title ); ?>"><?php echo $spacious_slider_button_text; ?></a>
								<?php } ?>
							</div>
						</div>
						<?php
					}
				}
				?>

				<?php if ( $num_of_slides > 1 ) : ?>

					<nav id="controllers" class="clearfix"></nav>

					<?php if ( spacious_options( 'spacious_slider_next_prev_option', 0 ) === 1 ) { ?>
						<span class="cycle-prev"></span>
						<span class="cycle-next"></span>
					<?php } ?>

					<?php if ( spacious_options( 'spacious_slider_progressbar_option', 0 ) === 1 ) { ?>
						<span id="progress"></span>
					<?php } ?>

				<?php endif; ?>
			</div>
		</section>

		<?php
	}

endif;

if ( ! function_exists( 'spacious_header_title' ) ) :

	/**
	 * Show the title in header
	 */
	function spacious_header_title() {
		if ( is_archive() ) {
			if ( is_category() ) :
				$spacious_header_title = single_cat_title( '', false );

			elseif ( is_tag() ) :
				$spacious_header_title = single_tag_title( '', false );

			elseif ( is_author() ) :
				/**
				 * Queue the first post, that way we know
				 * what author we're dealing with (if that is the case).
				 */
				the_post();
				$spacious_header_title = sprintf( __( 'Author: %s', 'spacious' ), '<span class="vcard">' . get_the_author() . '</span>' );
				/**
				 * Since we called the_post() above, we need to
				 * rewind the loop back to the beginning that way
				 * we can run the loop properly, in full.
				 */
				rewind_posts();

			elseif ( is_day() ) :
				$spacious_header_title = sprintf( __( 'Day: %s', 'spacious' ), '<span>' . get_the_date() . '</span>' );

			elseif ( is_month() ) :
				$spacious_header_title = sprintf( __( 'Month: %s', 'spacious' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			elseif ( is_year() ) :
				$spacious_header_title = sprintf( __( 'Year: %s', 'spacious' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
				$spacious_header_title = __( 'Asides', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
				$spacious_header_title = __( 'Images', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
				$spacious_header_title = __( 'Videos', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
				$spacious_header_title = __( 'Quotes', 'spacious' );

			elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
				$spacious_header_title = __( 'Links', 'spacious' );

			elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) && function_exists( 'is_woocommerce' ) && is_woocommerce() ) :
				$spacious_header_title = woocommerce_page_title( false );

			else :
				$spacious_header_title = __( 'Archives', 'spacious' );

			endif;
		} else if ( is_404() ) {
			$spacious_header_title = __( 'Page NOT Found', 'spacious' );
		} else if ( is_search() ) {
			$spacious_header_title = __( 'Search Results', 'spacious' );
		} else if ( is_page() ) {
			$spacious_header_title = get_the_title();
		} else if ( is_single() ) {
			$spacious_header_title = get_the_title();
		} else if ( is_home() ) {
			$queried_id            = get_option( 'page_for_posts' );
			$spacious_header_title = get_the_title( $queried_id );
		} else {
			$spacious_header_title = '';
		}

		return $spacious_header_title;
	}

endif;

/*	 * ************************************************************************************* */

if ( ! function_exists( 'spacious_breadcrumb' ) ) :

	/**
	 * Display breadcrumb on header.
	 *
	 * If the page is home or front page, slider is displayed.
	 * In other pages, breadcrumb will display if breadcrumb NavXT plugin exists.
	 */
	function spacious_breadcrumb() {

		// NavXT
		if ( function_exists( 'bcn_display' ) ) {

			echo '<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">';
			echo '<span class="breadcrumb-title">' . wp_kses_post( spacious_options( 'spacious_custom_breadcrumb_text', __( 'You are here: ', 'spacious' ) ) ) . '</span>';
			bcn_display();
			echo '</div> <!-- .breadcrumb : NavXT -->';

		} else if ( function_exists( 'yoast_breadcrumb' ) ) { // SEO by Yoast

			yoast_breadcrumb(
		'<div class="breadcrumb">' . '<span class="breadcrumb-title">' . wp_kses_post( spacious_options( 'spacious_custom_breadcrumb_text', __( 'You are here: ', 'spacious' ) ) ) . '</span>',
	'</div> <!-- .breadcrumb : Yoast -->'
			);

		}
	}

endif;

if ( ! function_exists( 'spacious_taxonomy_description' ) ) :

	/**
	* Displays the taxonomy description
	 */
	function spacious_taxonomy_description() {
		?>

		<div class="taxonomy-description">
			<?php
			if ( spacious_options( 'spacious_term_description', 0 ) == 1 ) :
				// Show term description for category.
				$term_description = term_description();

				if ( ! empty( $term_description ) ) :
					printf( '%s', $term_description );
				endif;

			endif;
			?>
		</div>

		<?php
	}

endif;

/*	 * ************************************* WooCommerce cart icon ************************************** */
if ( ! function_exists( 'spacious_cart_icon' ) ) :

	/**
	 * Display cart icon on menu bar.
	 *
	 * show cart icon if activated from customizer
	 */
	function spacious_cart_icon() {
		if ( ( spacious_options( 'spacious_cart_icon', 0 ) == 1 ) && class_exists( 'woocommerce' ) ) :
			?>
			<div class="cart-wrapper">
				<div class="spacious-woocommerce-cart-views">

					<!-- Show cart icon with total cart item -->
					<?php $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url(); ?>

					<a href="<?php echo esc_url( $cart_url ); ?>" class="wcmenucart-contents">
						<i class="fa fa-shopping-cart"></i>
						<span class="cart-value"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
					</a>

					<!-- Show total cart price -->
					<div class="spacious-woocommerce-cart-wrap">
						<div class="spacious-woocommerce-cart"><?php esc_html_e( 'Total', 'spacious' ); ?></div>
						<div class="cart-total"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></div>
					</div>
				</div>

				<!-- WooCommerce Cart Widget -->
				<?php the_widget( 'WC_Widget_Cart', '' ); ?>

			</div> <!-- /.cart-wrapper -->
			<?php
		endif;
	}

endif;

/* * ************************************************************************************* */

if ( ! function_exists( 'spacious_render_header_image' ) ) :

	/**
	 * Shows the small info text on top header part
	 */
	function spacious_render_header_image() {

		if ( function_exists( 'the_custom_header_markup' ) ) {

			do_action( 'spacious_header_image_markup_render' );
			the_custom_header_markup();

		} else {

			$header_image = get_header_image();
			if ( ! empty( $header_image ) ) {
				if ( spacious_options( 'spacious_header_image_link', 0 ) == 1 ) {
					?>
					<?php if ( spacious_options( 'spacious_header_image_link_to_other_sites' ) != '' ) { ?>
						<a href="<?php echo esc_url( spacious_options( 'spacious_header_image_link_to_other_sites' ) ); ?>">
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<?php } ?>
						<?php }
						?>
						<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if ( spacious_options( 'spacious_header_image_link', 0 ) == 1 ) { ?>
						</a>
						<?php
					}
				}

			}
		}

	endif;

/*	 * ************************************************************************************* */
if ( ! function_exists( 'spacious_main_nav' ) ) :
	function spacious_main_nav() {
		// For header menu button enabled option.
		$class                = '';
		$header_button_link_1 = spacious_options( 'spacious_header_button_one_link' );
		$header_button_link_2 = spacious_options( 'spacious_header_button_two_link' );
		if ( $header_button_link_1 || $header_button_link_2 ) {
			$class = 'spacious-header-button-enabled';
		}
		?>

		<nav id="site-navigation" class="main-navigation clearfix <?php echo esc_attr( $class ); ?> <?php echo spacious_options( 'spacious_one_line_menu_setting' ) ? 'tg-extra-menus' : ''; ?>" role="navigation">
			<p class="menu-toggle"><?php esc_html_e( 'Menu', 'spacious' ); ?></p>
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu( array(
					'theme_location'  => 'primary',
					'container_class' => 'menu-primary-container',
					'menu_class'      => 'nav-menu',
				) );
			} else {
				wp_page_menu();
			}
			?>
		</nav>

		<?php
	}
endif;
