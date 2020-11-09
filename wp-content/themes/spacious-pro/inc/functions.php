<?php
/**
 * Spacious functions and definitions
 *
 * This file contains all the functions and it's defination that particularly can't be
 * in other files.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */

/****************************************************************************************/

// Spacious theme options
function spacious_options( $id, $default = false ) {
	// getting options value
	$spacious_options = get_option( 'spacious' );
	if ( isset( $spacious_options[ $id ] ) ) {
		return $spacious_options[ $id ];
	} else {
		return $default;
	}
}

/****************************************************************************************/

add_action( 'wp_enqueue_scripts', 'spacious_scripts_styles_method' );
/**
 * Register jquery scripts
 */
function spacious_scripts_styles_method() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	/**
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'spacious_style', get_stylesheet_uri() );
	wp_style_add_data( 'spacious_style', 'rtl', 'replace' );

	if ( spacious_options( 'spacious_color_skin', 'light' ) == 'dark' ) {
		wp_enqueue_style( 'spacious_dark_style', SPACIOUS_CSS_URL . '/dark' . $suffix . '.css' );
	}

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'spacious-genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	// Enqueue font-awesome style.
	wp_enqueue_style( 'spacious-font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome' . $suffix . '.css', array(), '4.6.3' );

	$spacious_googlefonts = array();
	array_push( $spacious_googlefonts, spacious_options( 'spacious_site_title_font', 'Lato' ) );
	array_push( $spacious_googlefonts, spacious_options( 'spacious_site_tagline_font', 'Lato' ) );
	array_push( $spacious_googlefonts, spacious_options( 'spacious_menu_font', 'Lato' ) );
	array_push( $spacious_googlefonts, spacious_options( 'spacious_titles_font', 'Lato' ) );
	array_push( $spacious_googlefonts, spacious_options( 'spacious_content_font', 'Lato' ) );

	// Assign required fonts from database in array and make it unique.
	$spacious_googlefonts          = array_unique( $spacious_googlefonts );
	$spacious_google_fonts         = spacious_google_fonts();
	$spacious_standard_fonts_array = spacious_standard_fonts_array();

	// Check for the Google Fonts arrays.
	foreach ( $spacious_googlefonts as $spacious_googlefont ) {

		// If the array_key_exists for currently selected fonts,
		// then only proceed to create new array to include,
		// only the required Google fonts.
		// For Standard fonts, no need for loading up the Google Fonts array.
		if ( array_key_exists( $spacious_googlefont, $spacious_google_fonts ) ) {
			$spacious_googlefont_lists[] = $spacious_googlefont;
		}

	}

	// Check for the Standard Fonts arrays.
	foreach ( $spacious_googlefonts as $spacious_standard_font ) {

		// If the array_key_exists for currently selected fonts,
		// then only proceed to create new array to include,
		// only the required Standard fonts,
		// in order to enqueue to Google Fonts only when,
		// no theme_mods data is altered.
		if ( array_key_exists( $spacious_standard_font, $spacious_standard_fonts_array ) ) {
			$spacious_standard_font_lists[] = $spacious_standard_font;
		}

	}

	// Proceed only if the Google Fonts array is available,
	// to enqueue the Google Fonts.
	if ( isset( $spacious_googlefont_lists ) ) :

		$spacious_googlefont_lists = implode( "|", $spacious_googlefont_lists );

		wp_register_style( 'spacious_googlefonts', '//fonts.googleapis.com/css?family=' . $spacious_googlefont_lists );
		wp_enqueue_style( 'spacious_googlefonts' );

	// Proceed only if the theme is installed first time,
	// or the theme_mods data for typography is not changed.
	elseif ( ! isset( $spacious_standard_font_lists ) ) :

		$spacious_googlefonts = implode( "|", $spacious_googlefonts );

		wp_register_style( 'spacious_googlefonts', '//fonts.googleapis.com/css?family=' . $spacious_googlefonts );
		wp_enqueue_style( 'spacious_googlefonts' );

	endif;

	/**
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Sticky menu.
	if ( spacious_options( 'spacious_sticky_menu', 0 ) == 1 ) {
		wp_enqueue_script( 'headroom', SPACIOUS_JS_URL . '/headroom' . $suffix . '.js', array(), false, true );
		wp_enqueue_script( 'jQuery-headroom', SPACIOUS_JS_URL . '/jQuery.headroom' . $suffix . '.js', array(), false, true );
	}

	/**
	 * Enqueue Slider setup js file.
	 */
	// Register jQuery Cycle 2 JS
	wp_register_script( 'jquery_cycle', SPACIOUS_JS_URL . '/jquery.cycle2' . $suffix . '.js', array( 'jquery' ), '2.1.6', true );
	wp_register_script( 'jquery-swipe', SPACIOUS_JS_URL . '/jquery.cycle2.swipe' . $suffix . '.js', array( 'jquery' ), false, true );
	wp_register_script( 'jquery-cycle2-carousel', SPACIOUS_JS_URL . '/jquery.cycle2.carousel' . $suffix . '.js', array( 'jquery' ), false, true );


	if ( spacious_options( 'spacious_activate_slider', '0' ) == '1' ) {

		$transition_effect   = spacious_options( 'spacious_slider_transition_effect', 'fade' );
		$transition_delay    = spacious_options( 'spacious_slider_transition_delay', 4 );
		$transition_duration = spacious_options( 'spacious_slider_transition_length', 1 );
		$pauseonhover        = spacious_options( 'spacious_slider_pause_on_hover_option', 1 );
		$random_order        = spacious_options( 'spacious_slider_random_order_option', false );

		$transition_delay    = intval( $transition_delay );
		$transition_duration = intval( $transition_duration );

		if ( $transition_delay != 0 ) {
			$transition_delay = $transition_delay * 1000;
		} else {
			$transition_delay = 4000;
		}

		if ( $transition_duration != 0 ) {
			$transition_duration = $transition_duration * 1000;
		} else {
			$transition_duration = 1000;
		}
		if ( ( spacious_options( 'spacious_slider_status', 'home_front_page' ) == 'all_page' ) || is_front_page() || ( is_home() && spacious_options( 'spacious_slider_status', 'home_front_page' ) == 'home_front_page' ) ) {
			wp_enqueue_script( 'jquery_cycle' );
			wp_enqueue_script( 'jquery-swipe' );
			wp_localize_script( 'jquery_cycle', 'spacious_slider_value',
				array(
					'transition_effect'   => $transition_effect,
					'transition_delay'    => $transition_delay,
					'transition_duration' => $transition_duration,
					'pauseonhover'        => $pauseonhover,
					'random_order'        => $random_order,
				)
			);
		}
	}

	// Waypoints Script Register
	wp_register_script( 'jquery-waypoints', SPACIOUS_JS_URL . '/waypoints' . $suffix . '.js', array( 'jquery' ), '2.0.3', true );

	// CounterUp Script Register
	wp_register_script( 'jquery-counterup', SPACIOUS_JS_URL . '/jquery.counterup' . $suffix . '.js', array( 'jquery' ), false, true );

	// Theia Sticky Sidebar enqueue
	if ( spacious_options( 'spacious_sticky_content_sidebar', '0' ) == '1' ) {
		wp_enqueue_script( 'theia-sticky-sidebar', SPACIOUS_JS_URL . '/theia-sticky-sidebar/theia-sticky-sidebar' . $suffix . '.js', array( 'jquery' ), '1.7.0', true );
		wp_enqueue_script( 'ResizeSensor', SPACIOUS_JS_URL . '/theia-sticky-sidebar/ResizeSensor' . $suffix . '.js', array( 'jquery' ), false, true );
	}

	wp_enqueue_script( 'spacious-navigation', SPACIOUS_JS_URL . '/navigation' . $suffix . '.js', array( 'jquery' ), false, true );

	// Skip link focus fix JS enqueue.
	wp_enqueue_script( 'spacious-skip-link-focus-fix', SPACIOUS_JS_URL . '/skip-link-focus-fix.js', array(), false, true );

	wp_enqueue_script( 'spacious-custom', SPACIOUS_JS_URL . '/spacious-custom' . $suffix . '.js', array( 'jquery' ), false, true );

	wp_enqueue_style( 'google_fonts' );

	// Masonry JS.
	if ( is_page_template( 'page-templates/blog-image-masonry.php' ) || ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_masonry_content' ) && ( is_home() || is_archive() || is_search() ) ) {
		wp_enqueue_script( 'masonry' );
	}

	// HTML5Shiv for Lower IE versions
	wp_enqueue_script( 'html5', SPACIOUS_JS_URL . '/html5shiv' . $suffix . '.js', true );
	wp_script_add_data( 'html5', 'conditional', 'lte IE 8' );
}

/**
 * Enqueue Google fonts and editor styles.
 */
function spacious_block_editor_styles() {
	wp_enqueue_style( 'spacious-editor-googlefonts', '//fonts.googleapis.com/css2?family=Lato' );
	wp_enqueue_style( 'spacious-block-editor-styles', get_template_directory_uri() . '/style-editor-block.css' );
}

add_action( 'enqueue_block_editor_assets', 'spacious_block_editor_styles', 1, 1 );

/****************************************************************************************/

/**
 * Add admin scripts and styles.
 */

function spacious_admin_scripts( $hook ) {
	global $post_type;

	if ( $hook == 'widgets.php' || $hook == 'customize.php' ) {

		//For image uploader
		wp_enqueue_media();

		//For color
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'spacious-color-picker', SPACIOUS_JS_URL . '/color-picker.js', array( 'jquery' ), false, true );

		// Load media uploader and admin js
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_media();
		wp_enqueue_script( 'spacious-admin-script', SPACIOUS_JS_URL . '/spacious-admin.js', array( 'jquery' ) );
	}
}

add_action( 'admin_enqueue_scripts', 'spacious_admin_scripts' );

/****************************************************************************************/

add_filter( 'excerpt_length', 'spacious_excerpt_length' );
/**
 * Sets the post excerpt length to 40 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function spacious_excerpt_length( $length ) {
	$excerpt_length = spacious_options( 'spacious_excerpt_length', '40' );

	return $excerpt_length;
}

add_filter( 'excerpt_more', 'spacious_continue_reading' );
/**
 * Returns a "Continue Reading" link for excerpts
 */
function spacious_continue_reading() {
	return '';
}

/****************************************************************************************/

/**
 * Removing the default style of wordpress gallery
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Filtering the size to be medium from thumbnail to be used in WordPress gallery as a default size
 */
function spacious_gallery_atts( $out, $pairs, $atts ) {
	$atts = shortcode_atts( array(
		'size' => 'medium',
	), $atts );

	$out['size'] = $atts['size'];

	return $out;

}

add_filter( 'shortcode_atts_gallery', 'spacious_gallery_atts', 10, 3 );

add_filter( 'post_class', 'spacious_post_class' );
/**4
 * Filter the body_class
 */
function spacious_post_class( $classes ) {
	$classes[] = '';

	if ( spacious_options( 'spacious_blog_column_option', '2' ) == '2' ) {
		$classes[] = 'tg-column-two';
	} elseif ( spacious_options( 'spacious_blog_column_option', '2' ) == '3' ) {
		$classes[] = 'tg-column-third';
	}

	return $classes;
}

/****************************************************************************************/

add_filter( 'body_class', 'spacious_body_class' );
/**
 * Filter the body_class
 *
 * Throwing different body class for the different layouts in the body tag
 */
function spacious_body_class( $classes ) {
	global $post;

	if ( $post ) {
		$layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true );
	}

	if ( is_home() ) {
		$queried_id  = get_option( 'page_for_posts' );
		$layout_meta = get_post_meta( $queried_id, 'spacious_page_layout', true );
	}

	if ( empty( $layout_meta ) || is_archive() || is_search() ) {
		$layout_meta = 'default_layout';
	}

	$spacious_default_layout      = spacious_options( 'spacious_default_layout', 'right_sidebar' );
	$spacious_default_page_layout = spacious_options( 'spacious_pages_default_layout', 'right_sidebar' );
	$spacious_default_post_layout = spacious_options( 'spacious_single_posts_default_layout', 'right_sidebar' );
	$spacious_woo_archive_layout  = spacious_options( 'spacious_woo_archive_layout', 'no_sidebar_full_width' );
	$spacious_woo_product_layout  = spacious_options( 'spacious_woo_product_layout', 'no_sidebar_full_width' );

	if ( $layout_meta == 'default_layout' ) {
		if ( is_page() ) {
			if ( $spacious_default_page_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_default_page_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_default_page_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_default_page_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $spacious_default_page_layout == 'no_sidebar_content_stretched' ) {
				$classes[] = 'no-sidebar-content-stretched';
			}
		} elseif ( function_exists( 'spacious_is_in_woocommerce_page' ) && is_product() ) {
			if ( $spacious_woo_product_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_woo_product_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_woo_product_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_woo_product_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( is_single() ) {
			if ( $spacious_default_post_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_default_post_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_default_post_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_default_post_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			} elseif ( $spacious_default_post_layout == 'no_sidebar_content_stretched' ) {
				$classes[] = 'no-sidebar-content-stretched';
			}
		} elseif ( function_exists( 'spacious_is_in_woocommerce_page' ) && spacious_is_in_woocommerce_page() ) {
			if ( $spacious_woo_archive_layout == 'right_sidebar' ) {
				$classes[] = '';
			} elseif ( $spacious_woo_archive_layout == 'left_sidebar' ) {
				$classes[] = 'left-sidebar';
			} elseif ( $spacious_woo_archive_layout == 'no_sidebar_full_width' ) {
				$classes[] = 'no-sidebar-full-width';
			} elseif ( $spacious_woo_archive_layout == 'no_sidebar_content_centered' ) {
				$classes[] = 'no-sidebar';
			}
		} elseif ( $spacious_default_layout == 'right_sidebar' ) {
			$classes[] = '';
		} elseif ( $spacious_default_layout == 'left_sidebar' ) {
			$classes[] = 'left-sidebar';
		} elseif ( $spacious_default_layout == 'no_sidebar_full_width' ) {
			$classes[] = 'no-sidebar-full-width';
		} elseif ( $spacious_default_layout == 'no_sidebar_content_centered' ) {
			$classes[] = 'no-sidebar';
		} elseif ( $spacious_default_layout == 'no_sidebar_content_stretched' ) {
			$classes[] = 'no-sidebar-content-stretched';
		}
	} elseif ( $layout_meta == 'right_sidebar' ) {
		$classes[] = '';
	} elseif ( $layout_meta == 'left_sidebar' ) {
		$classes[] = 'left-sidebar';
	} elseif ( $layout_meta == 'no_sidebar_full_width' ) {
		$classes[] = 'no-sidebar-full-width';
	} elseif ( $layout_meta == 'no_sidebar_content_centered' ) {
		$classes[] = 'no-sidebar';
	} elseif ( $layout_meta == 'no_sidebar_content_stretched' ) {
		$classes[] = 'no-sidebar-content-stretched';
	}

	if ( spacious_options( 'spacious_new_menu', '1' ) == '1' ) {
		$classes[] = 'better-responsive-menu';
	}

	if ( is_page_template( 'page-templates/blog-image-alternate-medium.php' ) || ( ( is_archive() || is_home() ) && spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) ) {
		$classes[] = 'blog-alternate-medium';
	}
	if ( is_page_template( 'page-templates/blog-image-medium.php' ) || ( ( is_archive() || is_home() ) && spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) ) {
		$classes[] = 'blog-medium';
	}
	if ( is_page_template( 'page-templates/blog-image-round-alternate-medium.php' ) || ( ( is_archive() || is_home() ) && spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_round_alternate' ) ) {
		$classes[] = 'blog-alternate-medium blog-round-alternate-medium';
	}
	if ( is_page_template( 'page-templates/blog-image-round-medium.php' ) || ( ( is_archive() || is_home() ) && spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_round' ) ) {
		$classes[] = 'blog-medium blog-round-medium';
	}
	if ( is_page_template( 'page-templates/blog-image-masonry.php' ) || ( ( is_archive() || is_home() ) && spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_masonry_content' ) ) {
		$classes[] = 'blog-image-masonry';
	}
	if ( is_page_template( 'page-templates/blog-image-grid.php' ) || ( ( is_archive() || is_home() ) && spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_grid_content' ) ) {
		$classes[] = 'blog-image-grid';
	}

	if ( 'wide_978px' === spacious_options( 'spacious_site_layout', 'box_1218px' ) ) {
		$classes[] = 'wide-978';
	} elseif ( 'box_978px' === spacious_options( 'spacious_site_layout', 'box_1218px' ) ) {
		$classes[] = 'narrow-978';
	} elseif ( 'wide_1218px' === spacious_options( 'spacious_site_layout', 'box_1218px' ) ) {
		$classes[] = 'wide-1218';
	} elseif ( 'box_1218px' === spacious_options( 'spacious_site_layout', 'box_1218px' ) ) {
		$classes[] = 'narrow-1218';
	} else {
		$classes[] = '';
	}

	$classes[] = spacious_options( 'spacious_woocommerce_sale_design_setting', 'woocommerce-sale-style-default' );

	$classes[] = spacious_options( 'spacious_woocommerce_add_to_cart_design_setting', 'woocommerce-add-to-cart-default' );

	// For header menu button enabled option.
	$header_button_link_1 = spacious_options( 'spacious_header_button_one_link' );
	$header_button_link_2 = spacious_options( 'spacious_header_button_two_link' );
	if ( $header_button_link_1 || $header_button_link_2 ) {
		$classes[] = 'spacious-menu-header-button-enabled';
	}

	// For background image clickable.
	$background_image_url_link = spacious_options( 'spacious_background_image_link' );
	if ( $background_image_url_link ) {
		$classes[] = 'clickable-background-image';
	}

	return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'spacious_sidebar_select' ) ) :
	/**
	 * Fucntion to select the sidebar
	 */
	function spacious_sidebar_select() {
		global $post;

		if ( $post ) {
			$layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true );
		}

		if ( is_home() ) {
			$queried_id  = get_option( 'page_for_posts' );
			$layout_meta = get_post_meta( $queried_id, 'spacious_page_layout', true );
		}

		if ( empty( $layout_meta ) || is_archive() || is_search() ) {
			$layout_meta = 'default_layout';
		}

		$spacious_default_layout      = spacious_options( 'spacious_default_layout', 'right_sidebar' );
		$spacious_default_page_layout = spacious_options( 'spacious_pages_default_layout', 'right_sidebar' );
		$spacious_default_post_layout = spacious_options( 'spacious_single_posts_default_layout', 'right_sidebar' );

		if ( $layout_meta == 'default_layout' ) {
			if ( is_page() ) {
				if ( $spacious_default_page_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $spacious_default_page_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( is_single() ) {
				if ( $spacious_default_post_layout == 'right_sidebar' ) {
					get_sidebar();
				} elseif ( $spacious_default_post_layout == 'left_sidebar' ) {
					get_sidebar( 'left' );
				}
			} elseif ( $spacious_default_layout == 'right_sidebar' ) {
				get_sidebar();
			} elseif ( $spacious_default_layout == 'left_sidebar' ) {
				get_sidebar( 'left' );
			}
		} elseif ( $layout_meta == 'right_sidebar' ) {
			get_sidebar();
		} elseif ( $layout_meta == 'left_sidebar' ) {
			get_sidebar( 'left' );
		}
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_posts_listing_display_type_select' ) ) :
	/**
	 * Function to select the posts listing display type
	 */
	function spacious_posts_listing_display_type_select() {
		if ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_large' ) {
			$format = 'blog-image-large';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium' ) {
			$format = 'blog-image-medium';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_alternate' ) {
			$format = 'blog-image-medium';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_round' ) {
			$format = 'blog-image-medium';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_medium_round_alternate' ) {
			$format = 'blog-image-medium';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_full_content' ) {
			$format = 'blog-full-content';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_masonry_content' ) {
			$format = 'blog-image-masonry';
		} elseif ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) == 'blog_grid_content' ) {
			$format = 'blog-image-grid';
		} else {
			$format = get_post_format();
		}

		return $format;
	}
endif;

/****************************************************************************************/

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
if ( ! function_exists( 'spacious_hex2rgb' ) ) :

	function spacious_hex2rgb( $hexstr ) {
		$int = hexdec( str_replace( '#', '', $hexstr ) );

		$rgb = array( "red" => 0xFF & ( $int >> 0x10 ), "green" => 0xFF & ( $int >> 0x8 ), "blue" => 0xFF & $int );
		$r   = $rgb['red'];
		$g   = $rgb['green'];
		$b   = $rgb['blue'];

		return "rgba($r,$g,$b, 0.85)";
	}

endif;

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function spacious_darkcolor( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( strlen( $hex ) == 3 ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color  = hexdec( $color ); // Convert to decimal
		$color  = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;
}

/****************************************************************************************/

add_action( 'wp_head', 'spacious_custom_css', 100 );
/**
 * Hooks the Custom Internal CSS to head section
 */
function spacious_custom_css() {
	$spacious_internal_css = '';

	if ( spacious_options( 'spacious_top_bar_display_type', 'one' ) == 'two' ) {
		$spacious_internal_css .= ' .social-links { float: right; padding: 0 0 0 15px; } .social-links ul li { float: left; padding: 5px 0 5px 10px; } .small-info-text { float: right; padding: 0 0 0 15px; } #masthead .small-menu { float: left; } #masthead .small-menu a { padding: 5px 16px 0 0; } @media screen and (max-width:767px){.social-links{text-align:center;float:none;padding-left:0;padding-top:10px}.small-info-text{text-align:center;float:none;padding-left:0}.social-links ul li,.social-links ul li a{float:none;display:inline}#header-meta .small-menu{text-align:center;float:none}#header-meta .small-menu li{float:none;display:inline}#header-meta .small-menu a{float:none;display:inline;padding:5px 5px 0}}' . "\n";
	} else {
		$spacious_internal_css .= '';
	}

	$primary_color = spacious_options( 'spacious_primary_color', '#0FBE7C' );
	$primary_dark  = spacious_darkcolor( $primary_color, -50 );

	if ( $primary_color != '#0FBE7C' && $primary_color != '#0fbe7c' ) {
		$spacious_internal_css .= ' blockquote { border-left: 3px solid ' . $primary_color . '; }
			.spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button,
			 .spacious-woocommerce-cart-views .cart-value { background-color: ' . $primary_color . '; }
			.previous a:hover, .next a:hover { color: ' . $primary_color . '; }
			a { color: ' . $primary_color . '; }
			#site-title a:hover,.widget_fun_facts .counter-icon,.team-title a:hover { color: ' . $primary_color . '; }
			.main-navigation ul li.current_page_item a, .main-navigation ul li:hover > a { color: ' . $primary_color . '; }
			.main-navigation ul li ul { border-top: 1px solid ' . $primary_color . '; }
			.main-navigation ul li ul li a:hover, .main-navigation ul li ul li:hover > a,
			.main-navigation ul li.current-menu-item ul li a:hover { color: ' . $primary_color . '; }
			.site-header .menu-toggle:hover.entry-meta a.read-more:hover,
			#featured-slider .slider-read-more-button:hover, .slider-cycle .cycle-prev:hover, .slider-cycle .cycle-next:hover,
			.call-to-action-button:hover,.entry-meta .read-more-link:hover,.spacious-button:hover, input[type="reset"]:hover,
			input[type="button"]:hover, input[type="submit"]:hover, button:hover { background: ' . $primary_dark . '; }
			.main-small-navigation li:hover { background: ' . $primary_color . '; }
			.main-small-navigation ul > .current_page_item, .main-small-navigation ul > .current-menu-item { background: ' . $primary_color . '; }
			.main-navigation a:hover, .main-navigation ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor a,
			.main-navigation ul li.current-menu-ancestor a, .main-navigation ul li.current_page_item a,
			.main-navigation ul li:hover > a  { color: ' . $primary_color . '; }
			.small-menu a:hover, .small-menu ul li.current-menu-item a, .small-menu ul li.current_page_ancestor a,
			.small-menu ul li.current-menu-ancestor a, .small-menu ul li.current_page_item a,
			.small-menu ul li:hover > a { color: ' . $primary_color . '; }
			#featured-slider .slider-read-more-button,
			.slider-cycle .cycle-prev, .slider-cycle .cycle-next, #progress,
			.widget_our_clients .clients-cycle-prev,
			.widget_our_clients .clients-cycle-next { background-color: ' . $primary_color . '; }
			#controllers a:hover, #controllers a.active { background-color: ' . $primary_color . '; color: ' . $primary_color . '; }
			.widget_service_block a.more-link:hover, .widget_featured_single_post a.read-more:hover,
			#secondary a:hover,logged-in-as:hover  a{ color: ' . $primary_dark . '; }
			.breadcrumb a:hover { color: ' . $primary_color . '; }
			.tg-one-half .widget-title a:hover, .tg-one-third .widget-title a:hover,
			.tg-one-fourth .widget-title a:hover { color: ' . $primary_color . '; }
			.pagination span,.site-header .menu-toggle:hover,#team-controllers a.active,
			#team-controllers a:hover { background-color: ' . $primary_color . '; }
			.pagination a span:hover { color: ' . $primary_color . '; border-color: ' . $primary_color . '; }
			.widget_testimonial .testimonial-post { border-color: ' . $primary_color . ' #EAEAEA #EAEAEA #EAEAEA; }
			.call-to-action-content-wrapper { border-color: #EAEAEA #EAEAEA #EAEAEA ' . $primary_color . '; }
			.call-to-action-button { background-color: ' . $primary_color . '; }
			#content .comments-area a.comment-permalink:hover { color: ' . $primary_color . '; }
			.comments-area .comment-author-link a:hover { color: ' . $primary_color . '; }
			.comments-area .comment-author-link spanm,.team-social-icon a:hover { background-color: ' . $primary_color . '; }
			.comment .comment-reply-link:hover { color: ' . $primary_color . '; }
			.team-social-icon a:hover{ border-color: ' . $primary_color . '; }
			.nav-previous a:hover, .nav-next a:hover { color: ' . $primary_color . '; }
			#wp-calendar #today { color: ' . $primary_color . '; }
			.widget-title span { border-bottom: 2px solid ' . $primary_color . '; }
			.footer-widgets-area a:hover { color: ' . $primary_color . ' !important; }
			.footer-socket-wrapper .copyright a:hover { color: ' . $primary_color . '; }
			a#back-top:before { background-color: ' . $primary_color . '; }
			.read-more, .more-link { color: ' . $primary_color . '; }
			.post .entry-title a:hover, .page .entry-title a:hover { color: ' . $primary_color . '; }
			.entry-meta .read-more-link { background-color: ' . $primary_color . '; }
			.entry-meta a:hover, .type-page .entry-meta a:hover { color: ' . $primary_color . '; }
			.single #content .tags a:hover { color: ' . $primary_color . '; }
			.widget_testimonial .testimonial-icon:before { color: ' . $primary_color . '; }
			a#scroll-up { background-color: ' . $primary_color . '; }
			#search-form span { background-color: ' . $primary_color . '; }
			.single #content .tags a:hover,.previous a:hover, .next a:hover{border-color: ' . $primary_color . ';}
			.widget_featured_posts .tg-one-half .entry-title a:hover,
			.main-small-navigation li:hover > .sub-toggle { color: ' . $primary_color . '; }
			.woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
			.woocommerce #respond input#submit, .woocommerce #content input.button,
			.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button,
			.woocommerce-page #respond input#submit, .woocommerce-page #content input.button { background-color: ' . $primary_color . '; }
			.woocommerce a.button:hover,.woocommerce button.button:hover,
			.woocommerce input.button:hover,.woocommerce #respond input#submit:hover,
			.woocommerce #content input.button:hover,.woocommerce-page a.button:hover,
			.woocommerce-page button.button:hover,.woocommerce-page input.button:hover,
			.woocommerce-page #respond input#submit:hover,
			.woocommerce-page #content input.button:hover { background-color: ' . $primary_color . '; }
			#content .wp-pagenavi .current, #content .wp-pagenavi a:hover,.main-small-navigation .sub-toggle { background-color: ' . $primary_color . '; } .main-navigation ul li.tg-header-button-wrap.button-one a { background-color:' . $primary_color . '} .main-navigation ul li.tg-header-button-wrap.button-one a:hover { background-color:' . $primary_dark . '} .main-navigation ul li.tg-header-button-wrap.button-two a{color:' . $primary_color . '}.main-navigation ul li.tg-header-button-wrap.button-two a:hover{color:' . $primary_dark . '}.main-navigation ul li.tg-header-button-wrap.button-one a{border-color:' . $primary_color . '}.main-navigation ul li.tg-header-button-wrap.button-two a{border-color:' . $primary_color . '}.woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button{border-color:' . $primary_color . '}.woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button{color:' . $primary_color . '}.header-action .search-wrapper:hover .fa{color:' . $primary_color . '}.elementor .team-five-carousel.team-style-five .swiper-button-next{background-color:' . $primary_color . '}.elementor .team-five-carousel.team-style-five .swiper-button-prev{background-color:' . $primary_color . '}.elementor .main-block-wrapper .swiper-button-next{background-color:' . $primary_color . '}.elementor .main-block-wrapper .swiper-button-prev{background-color:' . $primary_color . '}.widget_testimonial .testimonial-cycle-prev{background:' . $primary_color . ';}.widget_testimonial .testimonial-cycle-next{background:' . $primary_color . ';}.footer-search-form{background:' . spacious_hex2rgb( $primary_color ) . '}.header-toggle-wrapper .header-toggle{border-color:transparent ' . $primary_color . ' transparent transparent}.woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-wishlist:hover{background:' . $primary_color . '}.woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-wishlist{border:1px solid' . $primary_color . '}.woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-cart{border-color:' . $primary_color . '}.woocommerce-product .main-product-wrapper .product-wrapper .woocommerce-image-wrapper-two .hovered-cart-wishlist .add-to-cart:hover{background:' . $primary_color . '}.woocommerce-product .main-product-wrapper .product-wrapper .product-outer-wrapper .woocommerce-image-wrapper-one .add-to-cart a:hover{background:' . $primary_dark . '}.woocommerce .star-rating span::before{color:' . $primary_color . '}.woocommerce-product .main-product-wrapper .product-container .product-cycle-prev{background-color:' . $primary_color . '}.woocommerce-product .main-product-wrapper .product-container .product-cycle-next{background-color:' . $primary_color . '}';
	}

	// Base color option.
	if ( spacious_options( 'spacious_content_text_color', '#666666' ) != '#666666' ) {
		$spacious_internal_css .= ' body, button, input, select, textarea, p, dl, .spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .widget_testimonial .testimonial-author span, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget { color: ' . spacious_options( 'spacious_content_text_color', '#666666' ) . '; }';
	}

	// Content background color.
	if ( spacious_options( 'spacious_content_background_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #main { background-color: ' . spacious_options( 'spacious_content_background_color', '#FFFFFF' ) . '; }';
	}

	/* Typography */
	// Font family option
	if ( spacious_options( 'spacious_site_title_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' #site-title a { font-family: ' . spacious_options( 'spacious_site_title_font', 'Lato' ) . '; }';
	}
	if ( spacious_options( 'spacious_site_tagline_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' #site-description { font-family: ' . spacious_options( 'spacious_site_tagline_font', 'Lato' ) . '; }';
	}
	if ( spacious_options( 'spacious_menu_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' .main-navigation li, .small-menu li { font-family: ' . spacious_options( 'spacious_menu_font', 'Lato' ) . '; }';
	}
	if ( spacious_options( 'spacious_titles_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' h1, h2, h3, h4, h5, h6 { font-family: ' . spacious_options( 'spacious_titles_font', 'Lato' ) . '; }';
	}
	if ( spacious_options( 'spacious_content_font', 'Lato' ) != 'Lato' ) {
		$spacious_internal_css .= ' body, button, input, select, textarea, p, .entry-meta, .read-more, .more-link, .widget_testimonial .testimonial-author, #featured-slider .slider-read-more-button { font-family: ' . spacious_options( 'spacious_content_font', 'Lato' ) . '; }';
	}

	//Font size option
	if ( spacious_options( 'spacious_site_title_font_size', '36' ) != '36' ) {
		$spacious_internal_css .= ' #site-title a { font-size:' . spacious_options( 'spacious_site_title_font_size', '36' ) . 'px; }';
	}

	if ( spacious_options( 'spacious_tagline_font_size', '16' ) != '16' ) {
		$spacious_internal_css .= ' #site-description { font-size:' . spacious_options( 'spacious_tagline_font_size', '16' ) . 'px; }';
	}

	// Header top color option.
	if ( spacious_options( 'spacious_header_top_bar_background_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #header-meta { background-color: ' . spacious_options( 'spacious_header_top_bar_background_color', '#FFFFFF' ) . '; }';
	}

	// Header top bar info textcolor option.
	if ( spacious_options( 'spacious_header_info_text_color', '#555555' ) != '#555555' ) {
		$spacious_internal_css .= ' .small-info-text p { color:  ' . spacious_options( 'spacious_header_info_text_color', '#555555' ) . '; }';
	}

	// Header small menu text color option.
	if ( spacious_options( 'spacious_header_info_text_color', '#666666' ) != '#666666' ) {
		$spacious_internal_css .= ' .small-menu a { color:  ' . spacious_options( 'spacious_header_info_text_color', '#666666' ) . '; }';
	}

	// Header top info text font size option.
	if ( spacious_options( 'spacious_small_info_text_size', '12' ) != '12' ) {
		$spacious_internal_css .= ' .small-info-text p { font-size:  ' . spacious_options( 'spacious_small_info_text_size', '12' ) . 'px; }';
	}

	// Header small menu font size option.
	if ( spacious_options( 'spacious_small_header_menu_font_size', '12' ) != '12' ) {
		$spacious_internal_css .= ' .small-menu a { font-size:  ' . spacious_options( 'spacious_small_header_menu_font_size', '12' ) . 'px; }';
	}

	// Header Background color option.
	if ( spacious_options( 'spacious_header_background_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #header-text-nav-container { background-color:  ' . spacious_options( 'spacious_header_background_color', '#FFFFFF' ) . '; }';
	}

	//Primary header menu text color.
	if ( spacious_options( 'spacious_primary_menu_text_color', '#444444' ) != '#444444' ) {
		$spacious_internal_css .= ' .main-navigation a { color: ' . spacious_options( 'spacious_primary_menu_text_color', '#444444' ) . '; }';
	}

	//Primary sub menu text color.
	if ( spacious_options( 'spacious_primary_sub_menu_text_color', '#666666' ) != '#666666' ) {
		$spacious_internal_css .= ' .main-navigation ul li ul li a  { color: ' . spacious_options( 'spacious_primary_sub_menu_text_color', '#666666' ) . '; }';
	}

	//Primary menu font size option.
	if ( spacious_options( 'spacious_primary_menu_font_size', '16' ) != '16' ) {
		$spacious_internal_css .= '  .main-navigation ul li a { font-size:  ' . spacious_options( 'spacious_primary_menu_font_size', '16' ) . 'px; }';
	}

	//Primary sub menu font size option.
	if ( spacious_options( 'spacious_primary_sub_menu_font_size', '13' ) != '13' ) {
		$spacious_internal_css .= ' .main-navigation ul li ul li a, .main-navigation ul li ul li a, .main-navigation ul li.current-menu-item ul li a, .main-navigation ul li ul li.current-menu-item a, .main-navigation ul li.current_page_ancestor ul li a, .main-navigation ul li.current-menu-ancestor ul li a, .main-navigation ul li.current_page_item ul li a { font-size: ' . spacious_options( 'spacious_primary_sub_menu_font_size', '13' ) . 'px; }';
	}

	// Slider color options.
	if ( spacious_options( 'spacious_slider_title_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #featured-slider .entry-title span { color: ' . spacious_options( 'spacious_slider_title_color', '#FFFFFF' ) . '; }';
	}

	if ( spacious_options( 'spacious_slider_content_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #featured-slider .entry-content p { color: ' . spacious_options( 'spacious_slider_content_color', '#FFFFFF' ) . '; }';
	}

	if ( spacious_options( 'spacious_slider_button_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #featured-slider .slider-read-more-button { color: ' . spacious_options( 'spacious_slider_button_color', '#FFFFFF' ) . '; }';
	}

	if ( spacious_options( 'spacious_slider_button_background_color', '#0FBE7C' ) != '#0FBE7C' ) {
		$spacious_internal_css .= ' #featured-slider .slider-read-more-button { background-color: ' . spacious_options( 'spacious_slider_button_background_color', '#0FBE7C' ) . '; }';
	}

	if ( spacious_options( 'spacious_slider_content_background_color', 'rgba(0, 0, 0, 0.3)' ) != 'rgba(0, 0, 0, 0.3)' ) {
		$spacious_internal_css .= '  #featured-slider .slider-cycle .entry-container .entry-description-container { background-color: ' . spacious_options( 'spacious_slider_content_background_color', 'rgba(0, 0, 0, 0.3)' ) . '; }';
	}
	// end of slider color options.

	//Start of slider typography options.
	if ( spacious_options( 'spacious_slider_title_font_size', '26' ) != '26' ) {
		$spacious_internal_css .= ' #featured-slider .entry-title span { font-size:  ' . spacious_options( 'spacious_slider_title_font_size', '26' ) . 'px; }';
	}

	if ( spacious_options( 'spacious_slider_content_font_size', '16' ) != '16' ) {
		$spacious_internal_css .= ' #featured-slider .entry-content p { font-size:  ' . spacious_options( 'spacious_slider_content_font_size', '16' ) . 'px; }';
	}

	if ( spacious_options( 'spacious_slider_button_font_size', '20' ) != '20' ) {
		$spacious_internal_css .= ' #featured-slider .slider-read-more-button { font-size:  ' . spacious_options( 'spacious_slider_button_font_size', '20' ) . 'px; }';
	}

	// Header bar background color.
	if ( spacious_options( 'spacious_header_bar_background_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' .header-post-title-container { background-color: ' . spacious_options( 'spacious_header_bar_background_color', '#FFFFFF' ) . '; }';
	}

	// Header text color.
	if ( spacious_options( 'spacious_page_post_title_color', '#222222' ) != '#222222' ) {
		$spacious_internal_css .= ' .header-post-title-class { color: ' . spacious_options( 'spacious_page_post_title_color', '#222222' ) . '; }';
	}

	// Breadcrumb text color.
	if ( spacious_options( 'spacious_breadcrumb_text_color', '#666666' ) != '#666666' ) {
		$spacious_internal_css .= '  .breadcrumb, .breadcrumb a { color: ' . spacious_options( 'spacious_breadcrumb_text_color', '#666666' ) . '; }';
	}

	// Header text font size..
	if ( spacious_options( 'spacious_title_font_size', '22' ) != '22' ) {
		$spacious_internal_css .= ' .header-post-title-class { font-size : ' . spacious_options( 'spacious_title_font_size', '22' ) . 'px; }';
	}

	// breadcrumb text font size..
	if ( spacious_options( 'spacious_breadcrumb_text_font_size', '22' ) != '22' ) {
		$spacious_internal_css .= ' .breadcrumb { font-size : ' . spacious_options( 'spacious_breadcrumb_text_font_size', '22' ) . 'px; }';
	}

	// Post meta icon color.
	if ( spacious_options( 'spacious_post_meta_icon_color', '#999999' ) != '#999999' ) {
		$spacious_internal_css .= ' .entry-meta { color: ' . spacious_options( 'spacious_post_meta_icon_color', '#999999' ) . '; }';
	}

	// Post meta text color.
	if ( spacious_options( 'spacious_post_meta_color', '#999999' ) != '#999999' ) {
		$spacious_internal_css .= ' .entry-meta a, .type-page .entry-meta a  { color: ' . spacious_options( 'spacious_post_meta_color', '#999999' ) . '; }';
	}

	// Readmore text color.
	if ( spacious_options( 'spacious_post_meta_read_more_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' .entry-meta a, .type-page .entry-meta a  { color: ' . spacious_options( 'spacious_post_meta_read_more_color', '#FFFFFF' ) . '; }';
	}

	// Read more background color.
	if ( spacious_options( 'spacious_post_meta_read_more_background_color', '#0FBE7C' ) != '#0FBE7C' ) {
		$spacious_internal_css .= ' .entry-meta a, .type-page .entry-meta a  { color: ' . spacious_options( 'spacious_post_meta_read_more_background_color', '#0FBE7C' ) . '; }';
	}

	// Post meta font size option.
	if ( spacious_options( 'spacious_post_meta_font_size', '14' ) != '14' ) {
		$spacious_internal_css .= ' .entry-meta { font-size : ' . spacious_options( 'spacious_post_meta_font_size', '14' ) . 'px; }';
	}

	// Read more font size option.
	if ( spacious_options( 'spacious_read_more_font_size', '14' ) != '14' ) {
		$spacious_internal_css .= ' .read-more, .more-link { font-size : ' . spacious_options( 'spacious_read_more_font_size', '14' ) . 'px; }';
	}

	// Widget Title color.
	if ( spacious_options( 'spacious_widget_title_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #secondary h3.widget-title, .widget_service_block .widget-title a, .widget_featured_single_post .widget-title a, .widget_testimonial .widget-title, .widget_recent_work .tg-one-half .widget-title, .widget_recent_work .tg-one-third .widget-title, .widget_recent_work .tg-one-fourth .widget-title, .widget_our_clients .widget-title, .widget_featured_posts .widget-title { color: ' . spacious_options( 'spacious_widget_title_color', '#FFFFFF' ) . '; }';
	}

	// Widget title font size option.
	if ( spacious_options( 'spacious_widget_title_font_size', '14' ) != '14' ) {
		$spacious_internal_css .= ' #secondary h3.widget-title, .widget_service_block .widget-title, .widget_featured_single_post .widget-title, .widget_testimonial .widget-title, .widget_recent_work .tg-one-half .widget-title, .widget_recent_work .tg-one-third .widget-title, .widget_recent_work .tg-one-fourth .widget-title { font-size : ' . spacious_options( 'spacious_widget_title_font_size', '14' ) . 'px; }';
	}

	// Comment color options.
	if ( spacious_options( 'spacious_comment_part_background_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' #comments { background-color: ' . spacious_options( 'spacious_comment_part_background_color', '#FFFFFF' ) . '; }';
	}

	// Comments title color.
	if ( spacious_options( 'spacious_comment_title_color', '#222222' ) != '#222222' ) {
		$spacious_internal_css .= ' #comments { background-color: ' . spacious_options( 'spacious_comment_title_color', '#222222' ) . '; }';
	}

	// comments meta color.
	if ( spacious_options( 'spacious_comment_meta_color', '#999999' ) != '#999999' ) {
		$spacious_internal_css .= ' .comments-area .comment-edit-link, .comments-area .comment-permalink, .comments-area .comment-date-time, .comments-area .comment-author-link { color: ' . spacious_options( 'spacious_comment_meta_color', '#999999' ) . '; }';
	}

	// comments single background color.
	if ( spacious_options( 'spacious_single_comment_background_color', '#F8F8F8' ) != '#F8F8F8' ) {
		$spacious_internal_css .= ' .comment-content { background-color: ' . spacious_options( 'spacious_single_comment_background_color', '#F8F8F8' ) . '; }';
	}

	// comments field background color.
	if ( spacious_options( 'spacious_commenting_field_background_color', '#F8F8F8' ) != '#F8F8F8' ) {
		$spacious_internal_css .= ' input[type="text"], input[type="email"], input[type="password"], textarea { background-color: ' . spacious_options( 'spacious_commenting_field_background_color', '#F8F8F8' ) . '; }';
	}

	// Comment Font size.
	if ( spacious_options( 'spacious_comment_title_font_size', '26' ) != '26' ) {
		$spacious_internal_css .= ' .comments-title, .comment-reply-title { font-size : ' . spacious_options( 'spacious_comment_title_font_size', '26' ) . 'px; }';
	}

	// Comment content Font size.
	if ( spacious_options( 'spacious_content_font_size', '16' ) != '16' ) {
		$spacious_internal_css .= ' body, button, input, select, textarea, p, dl, .spacious-button, input[type="reset"], input[type="button"], input[type="submit"], button, .previous a, .next a, .widget_testimonial .testimonial-author span, .nav-previous a, .nav-next a, #respond h3#reply-title #cancel-comment-reply-link, #respond form input[type="text"], #respond form textarea, #secondary .widget, .error-404 .widget { font-size : ' . spacious_options( 'spacious_content_font_size', '16' ) . 'px; }';
	}

	// Footer Widget title color.
	if ( spacious_options( 'spacious_footer_widget_title_color', '#D5D5D5' ) != '#D5D5D5' ) {
		$spacious_internal_css .= ' #colophon .widget-title { color: ' . spacious_options( 'spacious_footer_widget_title_color', '#D5D5D5' ) . '; }';
	}

	// Footer Widget content color.
	if ( spacious_options( 'spacious_footer_widget_content_color', '#999999' ) != '#999999' ) {
		$spacious_internal_css .= ' .footer-widgets-area, .footer-widgets-area .tg-one-fourth p { color: ' . spacious_options( 'spacious_footer_widget_content_color', '#999999' ) . '; }';
	}

	//  Footer Widget background color color.
	if ( spacious_options( 'spacious_footer_widget_background_color', '#333333' ) != '#333333' ) {
		$spacious_internal_css .= ' .footer-widgets-wrapper { background-color: ' . spacious_options( 'spacious_footer_widget_background_color', '#333333' ) . '; }';
	}

	// footer widget Font size.
	if ( spacious_options( 'spacious_footer_widget_title_font_size', '22' ) != '22' ) {
		$spacious_internal_css .= ' #colophon .widget-title { font-size : ' . spacious_options( 'spacious_footer_widget_title_font_size', '22' ) . 'px; }';
	}

	// footer widget content Font size.
	if ( spacious_options( 'spacious_footer_widget_content_font_size', '22' ) != '22' ) {
		$spacious_internal_css .= ' #colophon, #colophon p { font-size : ' . spacious_options( 'spacious_footer_widget_content_font_size', '22' ) . 'px; }';
	}

	//Footer copyright text color.
	if ( spacious_options( 'spacious_footer_copyright_text_color', '#666666' ) != '#666666' ) {
		$spacious_internal_css .= ' .footer-socket-wrapper .copyright, .footer-socket-wrapper .copyright a { color: ' . spacious_options( 'spacious_footer_copyright_text_color', '#666666' ) . '; }';
	}

	//Footer small menu text color.
	if ( spacious_options( 'spacious_footer_small_menu_color', '#666666' ) != '#666666' ) {
		$spacious_internal_css .= ' #colophon .small-menu a { color: ' . spacious_options( 'spacious_footer_small_menu_color', '#666666' ) . '; }';
	}

	//Footer copyright background color.
	if ( spacious_options( 'spacious_footer_copyright_part_background_color', '#F8F8F8' ) != '#F8F8F8' ) {
		$spacious_internal_css .= ' .footer-socket-wrapper { background-color: ' . spacious_options( 'spacious_footer_copyright_part_background_color', '#F8F8F8' ) . '; }';
	}

	// footer copyright Font size.
	if ( spacious_options( 'spacious_footer_copyright_text_font_size', '12' ) != '12' ) {
		$spacious_internal_css .= ' #colophon .footer-socket-wrapper .copyright, #colophon .footer-socket-wrapper .copyright p { font-size : ' . spacious_options( 'spacious_footer_copyright_text_font_size', '12' ) . 'px; }';
	}

	// footer small menu Font size.
	if ( spacious_options( 'spacious_small_footer_menu_font_size', '12' ) != '12' ) {
		$spacious_internal_css .= ' #colophon .small-menu a { font-size : ' . spacious_options( 'spacious_small_footer_menu_font_size', '12' ) . 'px; }';
	}

	//Tg: Call to Action Color.
	if ( spacious_options( 'spacious_call_to_action_background_color', '#F8F8F8' ) != '#F8F8F8' ) {
		$spacious_internal_css .= ' .call-to-action-content-wrapper { background-color: ' . spacious_options( 'spacious_call_to_action_background_color', '#F8F8F8' ) . '; }';
	}

	if ( spacious_options( 'spacious_call_to_action_title_color', '#222222' ) != '#222222' ) {
		$spacious_internal_css .= ' .call-to-action-content h3 { color: ' . spacious_options( 'spacious_call_to_action_title_color', '#222222' ) . '; }';
	}

	if ( spacious_options( 'spacious_call_to_action_button_color', '#FFFFFF' ) != '#FFFFFF' ) {
		$spacious_internal_css .= ' .call-to-action-content { color: ' . spacious_options( 'spacious_call_to_action_button_color', '#FFFFFF' ) . '; }';
	}

	if ( spacious_options( 'spacious_call_to_action_button_background_color', '#0FBE7C' ) != '#0FBE7C' ) {
		$spacious_internal_css .= ' .call-to-action-content { background-color: ' . spacious_options( 'spacious_call_to_action_button_background_color', '#0FBE7C' ) . '; }';
	}

	if ( spacious_options( 'spacious_call_to_action_title_font_size', '12' ) != '12' ) {
		$spacious_internal_css .= ' .call-to-action-content h3 { font-size : ' . spacious_options( 'spacious_call_to_action_title_font_size', '12' ) . 'px; }';
	}

	if ( spacious_options( 'spacious_call_to_action_button_font_size', '12' ) != '12' ) {
		$spacious_internal_css .= ' .call-to-action-button { font-size : ' . spacious_options( 'spacious_call_to_action_button_font_size', '12' ) . 'px; }';
	}

	// Tg: Featured Post.
	if ( spacious_options( 'spacious_archive_title_font_size', '26' ) != '26' ) {
		$spacious_internal_css .= ' .post .entry-title, .page .entry-title, .widget_featured_posts .tg-one-half .entry-title { font-size : ' . spacious_options( 'spacious_archive_title_font_size', '26' ) . 'px; }';
	}

	if ( spacious_options( 'spacious_client_widget_title_font_size', '30' ) != '30' ) {
		$spacious_internal_css .= ' .widget_our_clients .widget-title, .widget_featured_posts .widget-title { font-size : ' . spacious_options( 'spacious_client_widget_title_font_size', '30' ) . 'px; }';
	}

	if ( spacious_options( 'spacious_posts_title_color', '#222222' ) != '#222222' ) {
		$spacious_internal_css .= ' .post .entry-title a, .page .entry-title a, .widget_featured_posts .tg-one-half .entry-title a { color: ' . spacious_options( 'spacious_posts_title_color', '#222222' ) . '; }';
	}

	if ( spacious_options( 'spacious_tg_widget_read_more_color', '#0FBE7C' ) != '#0FBE7C' ) {
		$spacious_internal_css .= ' a.read-more, a.more-link { color: ' . spacious_options( 'spacious_tg_widget_read_more_color', '#0FBE7C' ) . '; }';
	}

	if ( spacious_options( 'spacious_border_lines_color', '#EAEAEA' ) != '#EAEAEA' ) {
		$border_color          = spacious_options( 'spacious_border_lines_color', '#EAEAEA' );
		$primary_color         = spacious_options( 'spacious_primary_color', '#0FBE7C' );
		$spacious_internal_css .= ' th, td { border: 1px solid ' . $border_color . '; } hr { border-color: ' . $border_color . '; } blockquote,input.s,input[type=email],input[type=email]:focus,input[type=password],input[type=password]:focus,input[type=search]:focus,input[type=text],input[type=text]:focus,pre,textarea,textarea:focus{border:1px solid ' . $border_color . '}input.s:focus{border-color:' . $border_color . '}.next a,.previous a{border:1px solid ' . $border_color . '}#featured-slider,#header-meta,#header-text-nav-container,.header-image,.header-post-title-container,.main-navigation ul li ul li{border-bottom:1px solid ' . $border_color . '}.meta{border-bottom:1px dashed ' . $border_color . ';border-top:1px dashed ' . $border_color . '}.meta li{border-left:1px solid ' . $border_color . '}.pagination span{border:1px solid ' . $border_color . '}.widget_testimonial .testimonial-post{border-color:' . $primary_color . ' ' . $border_color . ' ' . $border_color . '}.call-to-action-content-wrapper{border-color:' . $border_color . ' ' . $border_color . ' ' . $border_color . ' ' . $primary_color . '}.comment-content,.nav-next a,.nav-previous a{border:1px solid ' . $border_color . '}#colophon .widget ul li,#secondary .widget ul li{border-bottom:1px solid ' . $border_color . '}.footer-socket-wrapper,.footer-widgets-wrapper{border-top:1px solid ' . $border_color . '}.entry-meta,.single #content .tags a{border:1px solid ' . $border_color . '};';
	} // End of Color Options

	// entry meta for author remove
	if ( spacious_options( 'spacious_post_meta_author', 0 ) == 1 ) {
		$spacious_internal_css .= '.entry-meta .by-author{display:none;}';
	}

	// entry meta for date remove
	if ( spacious_options( 'spacious_post_meta_date', 0 ) == 1 ) {
		$spacious_internal_css .= '.entry-meta .date{display:none;}';
	}

	// entry meta bar full disable
	if ( spacious_options( 'spacious_post_meta_full', 0 ) == 1 ) {
		$spacious_internal_css .= '.entry-meta-bar{display:none;}';
	}

	// Header button text color.
	if ( spacious_options( 'spacious_header_button_one_text_color', '#ffffff' ) != '#ffffff' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a{color:' . spacious_options( 'spacious_header_button_one_text_color', '#ffffff' ) . '}';
	}

	// Header button text hover color.
	if ( spacious_options( 'spacious_header_button_one_text_hover_color', '#ffffff' ) != '#ffffff' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a:hover{color:' . spacious_options( 'spacious_header_button_one_text_hover_color', '#ffffff' ) . '}';
	}

	// Header button background color.
	if ( spacious_options( 'spacious_header_button_one_background_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a{background-color:' . spacious_options( 'spacious_header_button_one_background_color', '#0fbe7c' ) . '}';
	}

	// Header button background hover color.
	if ( spacious_options( 'spacious_header_button_one_background_hover_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a:hover{background-color:' . spacious_options( 'spacious_header_button_one_background_hover_color', '#ffffff' ) . '}';
	}

	// Header button border width.
	if ( spacious_options( 'spacious_header_button_one_border_width', '2' ) != '2' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a{border-width:' . spacious_options( 'spacious_header_button_one_border_width', '2' ) . 'px}';
	}

	// Header button border width color.
	if ( spacious_options( 'spacious_header_button_one_border_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a{border-color:' . spacious_options( 'spacious_header_button_one_border_color', '#0fbe7c' ) . '}';
	}

	// Header button border width hover color.
	if ( spacious_options( 'spacious_header_button_one_border_hover_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a:hover{border-color:' . spacious_options( 'spacious_header_button_one_border_hover_color', '#0fbe7c' ) . '}';
	}

	// Header button border radius.
	if ( spacious_options( 'spacious_header_button_one_border_radius', '5px' ) != '5px' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-one a{border-radius:' . spacious_options( 'spacious_header_button_one_border_radius', '5px' ) . '}';
	}

	// Header button two text color.
	if ( spacious_options( 'spacious_header_button_two_text_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a{color:' . spacious_options( 'spacious_header_button_two_text_color', '#0fbe7c' ) . '}';
	}

	// Header button text two hover color.
	if ( spacious_options( 'spacious_header_button_two_text_hover_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a:hover{color:' . spacious_options( 'spacious_header_button_two_text_hover_color', '#0fbe7c' ) . '}';
	}

	// Header button two background color.
	if ( spacious_options( 'spacious_header_button_two_background_color', '' ) != '' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a{background-color:' . spacious_options( 'spacious_header_button_two_background_color', '' ) . '}';
	}

	// Header button two background hover color.
	if ( spacious_options( 'spacious_header_button_two_background_hover_color', '' ) != '' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a:hover{background-color:' . spacious_options( 'spacious_header_button_two_background_hover_color', '' ) . '}';
	}

	// Header button two border width.
	if ( spacious_options( 'spacious_header_button_two_border_width', '2' ) != '2' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a{border-width:' . spacious_options( 'spacious_header_button_two_border_width', '2' ) . 'px}';
	}

	// Header button two border width color.
	if ( spacious_options( 'spacious_header_button_two_border_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a{border-color:' . spacious_options( 'spacious_header_button_two_border_color', '#0fbe7c' ) . '}';
	}

	// Header button two border width hover color.
	if ( spacious_options( 'spacious_header_button_two_border_hover_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a:hover{border-color:' . spacious_options( 'spacious_header_button_two_border_hover_color', '#0fbe7c' ) . '}';
	}

	// Header button two border radius.
	if ( spacious_options( 'spacious_header_button_two_border_radius', '5px' ) != '5px' ) {
		$spacious_internal_css .= '.main-navigation ul li.tg-header-button-wrap.button-two a{border-radius:' . spacious_options( 'spacious_header_button_two_border_radius', '5px' ) . '}';
	}

	// Header border width option
	if ( spacious_options( 'spacious_header_border_width_setting', '1' ) != '1' ) {
		$spacious_internal_css .= '#header-text-nav-container{border-bottom-width:' . spacious_options( 'spacious_header_border_width_setting', '1' ) . 'px}';
	}

	// Header border color option
	if ( spacious_options( 'spacious_header_border_color_setting', '#EAEAEA' ) != '#EAEAEA' ) {
		$spacious_internal_css .= '#header-text-nav-container{border-bottom-color:' . spacious_options( 'spacious_header_border_color_setting', '#EAEAEA' ) . '}';
	}

	// Header title background color.
	if ( spacious_options( 'spacious_header_tile_background_color', '#ffffff' ) != '#ffffff' ) {
		$spacious_internal_css .= '.header-post-title-container{background-color:' . spacious_options( 'spacious_header_tile_background_color', '#ffffff' ) . '}';
	}
	// Header title background image option
	if ( spacious_options( 'spacious_header_title_background_image' ) ) {
		$spacious_internal_css .= ' .header-post-title-container { background-image: url(' . spacious_options( 'spacious_header_title_background_image' ) . ') }';
	}

	// Header title background image position setting
	$header_title_background_image_position_setting = spacious_options( 'spacious_header_title_background_image_position', 'center-center' );
	if ( $header_title_background_image_position_setting == 'left-top' ) { // For `left-top`
		$spacious_internal_css .= '.header-post-title-container { background-position: left top; }';
	} elseif ( $header_title_background_image_position_setting == 'center-top' ) { // For `center-top`
		$spacious_internal_css .= '.header-post-title-container { background-position: center top; }';
	} elseif ( $header_title_background_image_position_setting == 'right-top' ) { // For `right-top`
		$spacious_internal_css .= '.header-post-title-container { background-position: right top; }';
	} elseif ( $header_title_background_image_position_setting == 'left-center' ) { // For `left-center`
		$spacious_internal_css .= '.header-post-title-container { background-position: left center; }';
	} elseif ( $header_title_background_image_position_setting == 'right-center' ) { // For `right-center`
		$spacious_internal_css .= '.header-post-title-container { background-position: right center; }';
	} elseif ( $header_title_background_image_position_setting == 'left-bottom' ) { // For `left-bottom`
		$spacious_internal_css .= '.header-post-title-container { background-position: left bottom; }';
	} elseif ( $header_title_background_image_position_setting == 'center-bottom' ) { // For `center-bottom`
		$spacious_internal_css .= '.header-post-title-container { background-position: center bottom; }';
	} elseif ( $header_title_background_image_position_setting == 'right-bottom' ) { // For `right-bottom`
		$spacious_internal_css .= '.header-post-title-container { background-position: right bottom; }';
	} else { // For `center-center`
		$spacious_internal_css .= '.header-post-title-container { background-position: center center; }';
	}
	// Header title background size setting
	$header_title_background_size_setting = spacious_options( 'spacious_header_title_background_image_size', 'auto' );
	if ( $header_title_background_size_setting == 'cover' ) { // For `cover`
		$spacious_internal_css .= '.header-post-title-container { background-size: cover; }';
	} elseif ( $header_title_background_size_setting == 'contain' ) { // For `contain`
		$spacious_internal_css .= '.header-post-title-container { background-size: contain; }';
	} else { // for `auto`
		$spacious_internal_css .= '.header-post-title-container { background-size: auto; }';
	}
	// Header title background attachment setting
	$header_title_background_attachment_setting = spacious_options( 'spacious_header_title_background_image_attachment', 'scroll' );
	if ( $header_title_background_attachment_setting == 'fixed' ) { // For `fixed`
		$spacious_internal_css .= '.header-post-title-container { background-attachment: fixed; }';
	} else { // for `scroll`
		$spacious_internal_css .= '.header-post-title-container { background-attachment: scroll; }';
	}
	// Header title background repeat setting
	$header_title_background_repeat_setting = spacious_options( 'spacious_header_title_background_image_repeat', 'scroll' );
	if ( $header_title_background_repeat_setting == 'no-repeat' ) { // For `no-repeat`
		$spacious_internal_css .= '.header-post-title-container { background-repeat: no-repeat; }';
	} elseif ( $header_title_background_repeat_setting == 'repeat-x' ) { // for `repeat-x`
		$spacious_internal_css .= '.header-post-title-container { background-repeat: repeat-x; }';
	} elseif ( $header_title_background_repeat_setting == 'repeat-y' ) { // for `repeat-y`
		$spacious_internal_css .= '.header-post-title-container { background-repeat: repeat-y; }';
	} else { // for `repeat`
		$spacious_internal_css .= '.header-post-title-container { background-repeat: repeat; }';
	}

	// Footer border width option
	if ( spacious_options( 'spacious_footer_border_width_setting', '1' ) != '1' ) {
		$spacious_internal_css .= '.footer-widgets-wrapper{border-top-width:' . spacious_options( 'spacious_footer_border_width_setting', '1' ) . 'px}';
	}

	// Footer border color option
	if ( spacious_options( 'spacious_footer_border_color_setting', '#EAEAEA' ) != '#EAEAEA' ) {
		$spacious_internal_css .= '.footer-widgets-wrapper{border-top-color:' . spacious_options( 'spacious_footer_border_color_setting', '#EAEAEA' ) . '}';
	}

	// Add to cart button text color.
	if ( spacious_options( 'spacious_add_to_cart_text_color', '#ffffff' ) != '#ffffff' ) {
		$spacious_internal_css .= '.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #content input.button,.product-details .add-to-cart a,.woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button, .button.woocommerce-page.woocommerce-add-to-cart-style-1 ul.products li.product .button, .elementor .product-carousel-container .swiper-carousel-wrapper .product-carousel-slide .product-details .add-to-cart .add_to_cart_button{color:' . spacious_options( 'spacious_add_to_cart_text_color', '#ffffff' ) . '}';
	}

	// Add to cart button text hover color.
	if ( spacious_options( 'spacious_add_to_cart_text_hover_color', '#515151' ) != '#515151' ) {
		$spacious_internal_css .= '.woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #content input.button:hover,.woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button:hover, .product-details .add-to-cart a:hover, .button.woocommerce-page.woocommerce-add-to-cart-style-1 ul.products li.product .button:hover, .elementor .product-carousel-container .swiper-carousel-wrapper .product-carousel-slide .product-details .add-to-cart .add_to_cart_button:hover{color:' . spacious_options( 'spacious_add_to_cart_text_hover_color', '#515151' ) . '}';
	}

	// Add to cart button background color.
	if ( spacious_options( 'spacious_add_to_cart_background_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #content input.button, .woocommerce-add-to-cart-default .product-details .add-to-cart a, .woocommerce-add-to-cart-style-1 .product-details .add-to-cart a, .woocommerce-add-to-cart-style-2 .product-details .add-to-cart a, .elementor .product-carousel-container .swiper-carousel-wrapper .product-carousel-slide .product-details .add-to-cart{background-color:' . spacious_options( 'spacious_add_to_cart_background_color', '#0fbe7c' ) . '}';
	}

	// Add to cart button background hover color.
	if ( spacious_options( 'spacious_add_to_cart_background_hover_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-add-to-cart-default .product-details .add-to-cart a:hover, .woocommerce-add-to-cart-style-1 .product-details .add-to-cart a:hover, .elementor .product-carousel-container .swiper-carousel-wrapper .product-carousel-slide .product-details .add-to-cart:hover{background-color:' . spacious_options( 'spacious_add_to_cart_background_hover_color', '#0fbe7c' ) . '}';
	}

	// Add to cart button border color.
	if ( spacious_options( 'spacious_add_to_cart_border_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button,  .button.woocommerce-page.woocommerce-add-to-cart-style-1 ul.products li.product .button, .woocommerce-add-to-cart-style-1 .product-details .add-to-cart a, .woocommerce-add-to-cart-style-2 .product-details .add-to-cart a, .elementor .product-carousel-container .swiper-carousel-wrapper .product-carousel-slide .product-details .add-to-cart{border-color:' . spacious_options( 'spacious_add_to_cart_border_color', '#0fbe7c' ) . '}';
	}

	// Add to cart button border hover color.
	if ( spacious_options( 'spacious_add_to_cart_border_hover_color', '#0fbe7c' ) != '#0fbe7c' ) {
		$spacious_internal_css .= '.woocommerce.woocommerce-add-to-cart-style-2 ul.products li.product .button:hover, .button.woocommerce-page.woocommerce-add-to-cart-style-1 ul.products li.product .button:hover, .woocommerce-add-to-cart-style-2 .product-details .add-to-cart a:hover, .woocommerce-add-to-cart-style-1 .product-details .add-to-cart a:hover, .elementor .product-carousel-container .swiper-carousel-wrapper .product-carousel-slide .product-details .add-to-cart:hover{border-color:' . spacious_options( 'spacious_add_to_cart_border_hover_color', '#0fbe7c' ) . '}';
	}

	// Footer background image option
	if ( spacious_options( 'spacious_footer_background_image' ) ) {
		$spacious_internal_css .= '#colophon { background-image: url(' . spacious_options( 'spacious_footer_background_image' ) . ') } #colophon .footer-widgets-wrapper{background-color: transparent}';
	}

	// Footer background image position setting
	$footer_background_image_position_setting = spacious_options( 'spacious_footer_background_image_position', 'center-center' );
	if ( $footer_background_image_position_setting == 'left-top' ) { // For `left-top`
		$spacious_internal_css .= '#colophon { background-position: left top; }';
	} elseif ( $footer_background_image_position_setting == 'center-top' ) { // For `center-top`
		$spacious_internal_css .= '#colophon { background-position: center top; }';
	} elseif ( $footer_background_image_position_setting == 'right-top' ) { // For `right-top`
		$spacious_internal_css .= '#colophon { background-position: right top; }';
	} elseif ( $footer_background_image_position_setting == 'left-center' ) { // For `left-center`
		$spacious_internal_css .= '#colophon { background-position: left center; }';
	} elseif ( $footer_background_image_position_setting == 'right-center' ) { // For `right-center`
		$spacious_internal_css .= '#colophon { background-position: right center; }';
	} elseif ( $footer_background_image_position_setting == 'left-bottom' ) { // For `left-bottom`
		$spacious_internal_css .= '#colophon { background-position: left bottom; }';
	} elseif ( $footer_background_image_position_setting == 'center-bottom' ) { // For `center-bottom`
		$spacious_internal_css .= '#colophon { background-position: center bottom; }';
	} elseif ( $footer_background_image_position_setting == 'right-bottom' ) { // For `right-bottom`
		$spacious_internal_css .= '#colophon { background-position: right bottom; }';
	} else { // For `center-center`
		$spacious_internal_css .= '#colophon { background-position: center center; }';
	}
	// Footer background size setting
	$footer_background_size_setting = spacious_options( 'spacious_footer_background_image_size', 'auto' );
	if ( $footer_background_size_setting == 'cover' ) { // For `cover`
		$spacious_internal_css .= '#colophon { background-size: cover; }';
	} elseif ( $footer_background_size_setting == 'contain' ) { // For `contain`
		$spacious_internal_css .= '#colophon { background-size: contain; }';
	} else { // for `auto`
		$spacious_internal_css .= '#colophon { background-size: auto; }';
	}
	// Footer background attachment setting
	$footer_background_attachment_setting = spacious_options( 'spacious_footer_background_image_attachment', 'scroll' );
	if ( $footer_background_attachment_setting == 'fixed' ) { // For `fixed`
		$spacious_internal_css .= '#colophon { background-attachment: fixed; }';
	} else { // for `scroll`
		$spacious_internal_css .= '#colophon { background-attachment: scroll; }';
	}
	// Footer background repeat setting
	$footer_background_repeat_setting = spacious_options( 'spacious_footer_background_image_repeat', 'scroll' );
	if ( $footer_background_repeat_setting == 'no-repeat' ) { // For `no-repeat`
		$spacious_internal_css .= '#colophon { background-repeat: no-repeat; }';
	} elseif ( $footer_background_repeat_setting == 'repeat-x' ) { // for `repeat-x`
		$spacious_internal_css .= '#colophon { background-repeat: repeat-x; }';
	} elseif ( $footer_background_repeat_setting == 'repeat-y' ) { // for `repeat-y`
		$spacious_internal_css .= '#colophon { background-repeat: repeat-y; }';
	} else { // for `repeat`
		$spacious_internal_css .= '#colophon { background-repeat: repeat; }';
	}

	if ( ! empty( $spacious_internal_css ) ) {
		?>
		<style type="text/css"><?php echo $spacious_internal_css; ?></style>
		<?php
	}

}

/**************************************************************************************/

/*
 * Adding the Custom Generated User Field
 */
add_action( 'show_user_profile', 'spacious_extra_user_field' );
add_action( 'edit_user_profile', 'spacious_extra_user_field' );

function spacious_extra_user_field( $user ) {
	?>
	<h3><?php _e( 'User Social Links', 'spacious' ); ?></h3>
	<table class="form-table">
		<tr>
			<th><label for="spacious_twitter"><?php _e( 'Twitter', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_twitter" id="spacious_twitter"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_twitter', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_facebook"><?php _e( 'Facebook', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_facebook" id="spacious_facebook"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_facebook', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_google_plus"><?php _e( 'Google Plus', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_google_plus" id="spacious_google_plus"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_google_plus', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_flickr"><?php _e( 'Flickr', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_flickr" id="spacious_flickr"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_flickr', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_linkedin"><?php _e( 'LinkedIn', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_linkedin" id="spacious_linkedin"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_linkedin', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_instagram"><?php _e( 'Instagram', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_instagram" id="spacious_instagram"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_instagram', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_tumblr"><?php _e( 'Tumblr', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_tumblr" id="spacious_tumblr"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_tumblr', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
		<tr>
			<th><label for="spacious_youtube"><?php _e( 'Youtube', 'spacious' ); ?></label></th>
			<td>
				<input type="text" name="spacious_youtube" id="spacious_youtube"
				       value="<?php echo esc_attr( get_the_author_meta( 'spacious_youtube', $user->ID ) ); ?>"
				       class="regular-text"/>
			</td>
		</tr>
	</table>
	<?php
}

// Saving the user field used above
add_action( 'personal_options_update', 'spacious_extra_user_field_save_option' );
add_action( 'edit_user_profile_update', 'spacious_extra_user_field_save_option' );

function spacious_extra_user_field_save_option( $user_id ) {

	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	update_user_meta( $user_id, 'spacious_twitter', wp_filter_nohtml_kses( $_POST['spacious_twitter'] ) );
	update_user_meta( $user_id, 'spacious_facebook', wp_filter_nohtml_kses( $_POST['spacious_facebook'] ) );
	update_user_meta( $user_id, 'spacious_google_plus', wp_filter_nohtml_kses( $_POST['spacious_google_plus'] ) );
	update_user_meta( $user_id, 'spacious_flickr', wp_filter_nohtml_kses( $_POST['spacious_flickr'] ) );
	update_user_meta( $user_id, 'spacious_linkedin', wp_filter_nohtml_kses( $_POST['spacious_linkedin'] ) );
	update_user_meta( $user_id, 'spacious_instagram', wp_filter_nohtml_kses( $_POST['spacious_instagram'] ) );
	update_user_meta( $user_id, 'spacious_tumblr', wp_filter_nohtml_kses( $_POST['spacious_tumblr'] ) );
	update_user_meta( $user_id, 'spacious_youtube', wp_filter_nohtml_kses( $_POST['spacious_youtube'] ) );
}

// fucntion to show the profile field data
function spacious_author_social_link() {
	?>
	<ul class="author-social-sites clearfix">
	<?php if ( get_the_author_meta( 'spacious_twitter' ) ) { ?>
		<li class="twitter-link">
			<a href="https://twitter.com/<?php the_author_meta( 'spacious_twitter' ); ?>"><i
					class="fa fa-twitter"></i></a>
		</li>
	<?php } // End check for twitter ?>
	<?php if ( get_the_author_meta( 'spacious_facebook' ) ) { ?>
		<li class="facebook-link">
			<a href="https://facebook.com/<?php the_author_meta( 'spacious_facebook' ); ?>"><i
					class="fa fa-facebook"></i></a>
		</li>
	<?php } // End check for facebook ?>
	<?php if ( get_the_author_meta( 'spacious_google_plus' ) ) { ?>
		<li class="google_plus-link">
			<a href="https://plus.google.com/<?php the_author_meta( 'spacious_google_plus' ); ?>"><i
					class="fa fa-google-plus"></i></a>
		</li>
	<?php } // End check for google_plus ?>
	<?php if ( get_the_author_meta( 'spacious_flickr' ) ) { ?>
		<li class="flickr-link">
			<a href="https://flickr.com/<?php the_author_meta( 'spacious_flickr' ); ?>"><i class="fa fa-flickr"></i></a>
		</li>
	<?php } // End check for flickr ?>
	<?php if ( get_the_author_meta( 'spacious_linkedin' ) ) { ?>
		<li class="linkedin-link">
			<a href="https://linkedin.com/<?php the_author_meta( 'spacious_linkedin' ); ?>"><i
					class="fa fa-linkedin"></i></a>
		</li>
	<?php } // End check for linkedin ?>
	<?php if ( get_the_author_meta( 'spacious_instagram' ) ) { ?>
		<li class="instagram-link">
			<a href="https://instagram.com/<?php the_author_meta( 'spacious_instagram' ); ?>"><i
					class="fa fa-instagram"></i></a>
		</li>
	<?php } // End check for instagram ?>
	<?php if ( get_the_author_meta( 'spacious_tumblr' ) ) { ?>
		<li class="tumblr-link">
			<a href="https://tumblr.com/<?php the_author_meta( 'spacious_tumblr' ); ?>"><i class="fa fa-tumblr"></i></a>
		</li>
	<?php } // End check for tumblr ?>
	<?php if ( get_the_author_meta( 'spacious_youtube' ) ) { ?>
		<li class="youtube-link">
			<a href="https://youtube.com/<?php the_author_meta( 'spacious_youtube' ); ?>"><i
					class="fa fa-youtube"></i></a>
		</li>
	<?php } // End check for youtube ?>
	</ul><?php
}

/**************************************************************************************/

if ( ! function_exists( 'spacious_content_nav' ) ) :
	/**
	 * Display navigation to next/previous pages when applicable
	 */
	function spacious_content_nav( $nav_id ) {
		global $wp_query, $post;

		// Don't print empty markup on single pages if there's nowhere to navigate.
		if ( is_single() ) {
			$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
			$next     = get_adjacent_post( false, '', false );

			if ( ! $next && ! $previous ) {
				return;
			}
		}

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

		?>
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
			<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'spacious' ); ?></h3>

			<?php if ( is_single() ) : // navigation links for single posts ?>

				<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'spacious' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'spacious' ) . '</span>' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

				<?php if ( get_next_posts_link() ) : ?>
					<div
						class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'spacious' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<div
						class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'spacious' ) ); ?></div>
				<?php endif; ?>

			<?php endif; ?>

		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
		<?php
	}
endif; // spacious_content_nav

/**************************************************************************************/

/*
 * Display the related posts.
 */
if ( ! function_exists( 'spacious_related_posts_function' ) ) {

	function spacious_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'         => spacious_options( 'spacious_related_post_number_display', '3' ),
		);

		// Related by categories.
		if ( spacious_options( 'spacious_related_posts', 'categories' ) == 'categories' ) {
			$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
			$args['category__in'] = $cats;
		}

		// Related by tags.
		if ( spacious_options( 'spacious_related_posts', 'categories' ) == 'tags' ) {
			$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
			$args['tag__in'] = $tags;

			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}
}

/**************************************************************************************/

if ( ! function_exists( 'spacious_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 */
	function spacious_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'spacious' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'spacious' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				// Proceed with normal comments.
				global $post;
				?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					<header class="comment-meta comment-author vcard">
						<?php
						echo get_avatar( $comment, 74 );
						printf( '<div class="comment-author-link">%1$s%2$s</div>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'spacious' ) . '</span>' : ''
						);
						printf( '<div class="comment-date-time">%1$s</div>',
							sprintf( __( '%1$s at %2$s', 'spacious' ), get_comment_date(), get_comment_time() )
						);
						printf( __( '<a class="comment-permalink" href="%1$s">Permalink</a>', 'spacious' ), esc_url( get_comment_link( $comment->comment_ID ) ) );
						edit_comment_link();
						?>
					</header><!-- .comment-meta -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'spacious' ); ?></p>
					<?php endif; ?>

					<section class="comment-content comment">
						<?php comment_text(); ?>

						<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => __( 'Reply', 'spacious' ),
							'after'      => '',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
						) ) ); ?>

					</section><!-- .comment-content -->

				</article><!-- #comment-## -->
				<?php
				break;
		endswitch; // end comment_type check
	}
endif;

/**************************************************************************************/

/* Register shortcodes. */
add_action( 'init', 'spacious_add_shortcodes' );
/**
 * Creates new shortcodes for use in any shortcode-ready area.  This function uses the add_shortcode()
 * function to register new shortcodes with WordPress.
 *
 * @uses add_shortcode() to create new shortcodes.
 */
function spacious_add_shortcodes() {
	/* Add theme-specific shortcodes. */
	add_shortcode( 'the-year', 'spacious_the_year_shortcode' );
	add_shortcode( 'site-link', 'spacious_site_link_shortcode' );
	add_shortcode( 'wp-link', 'spacious_wp_link_shortcode' );
	add_shortcode( 'tg-link', 'spacious_themegrill_link_shortcode' );
}

/**
 * Shortcode to display the current year.
 *
 * @return string
 * @uses date() Gets the current year.
 */
function spacious_the_year_shortcode() {
	return date( 'Y' );
}

/**
 * Shortcode to display a link back to the site.
 *
 * @return string
 * @uses get_bloginfo() Gets the site link
 */
function spacious_site_link_shortcode() {
	return '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ><span>' . get_bloginfo( 'name', 'display' ) . '</span></a>';
}

/**
 * Shortcode to display a link to WordPress.org.
 *
 * @return string
 */
function spacious_wp_link_shortcode() {
	return '<a href="' . esc_url( 'https://wordpress.org' ) . '" target="_blank" title="' . esc_attr__( 'WordPress', 'spacious' ) . '"><span>' . __( 'WordPress', 'spacious' ) . '</span></a>';
}

/**
 * Shortcode to display a link to spacious.com.
 *
 * @return string
 */
function spacious_themegrill_link_shortcode() {
	return '<a href="' . esc_url( 'https://themegrill.com/wordpress-themes/' ) . '" target="_blank" title="' . esc_attr__( 'ThemeGrill', 'spacious' ) . '" ><span>' . __( 'ThemeGrill', 'spacious' ) . '</span></a>';
}

if ( ! function_exists( 'spacious_footer_copyright' ) ) :

	/**
	 * Function to show the footer info, copyright information
	 */
	function spacious_footer_copyright() {

		$default_footer_value = spacious_options( 'spacious_footer_editor', __( 'Copyright &copy; ', 'spacious' ) . '[the-year] [site-link] ' . __( 'Theme by: ', 'spacious' ) . '[tg-link] ' . __( 'Powered by: ', 'spacious' ) . '[wp-link]' );

		$spacious_footer_copyright = '<div class="copyright">' . $default_footer_value . '</div>';

		echo do_shortcode( $spacious_footer_copyright );
	}

endif;

add_action( 'spacious_footer_copyright', 'spacious_footer_copyright', 10 );

/**************************************************************************************/

/**
 * Making the theme Woocommrece compatible
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action( 'woocommerce_before_main_content', 'spacious_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'spacious_wrapper_end', 10 );

function spacious_wrapper_start() {
	echo '<div id="primary">';
}

function spacious_wrapper_end() {
	echo '</div>';
}

function spacious_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'spacious_woocommerce_support' );

if ( ! function_exists( 'spacious_woo_related_products_limit' ) ) {

	/**
	 * WooCommerce Extra Feature
	 * --------------------------
	 *
	 * Change number of related products on product page
	 * Set your own value for 'posts_per_page'
	 *
	 */
	function spacious_woo_related_products_limit() {
		global $product;
		$args = array(
			'posts_per_page' => 4,
			'columns'        => 4,
			'orderby'        => 'rand',
		);

		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'spacious_woo_related_products_limit' );

if ( class_exists( 'woocommerce' ) && ! function_exists( 'spacious_is_in_woocommerce_page' ) ):
	/*
	 * woocommerce - conditional to check if woocommerce related page showed
	 */
	function spacious_is_in_woocommerce_page() {
		return ( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ) ? true : false;
	}
endif;

/****************************************************************************************/

if ( ! function_exists( 'spacious_entry_meta' ) ) :
	/**
	 * Shows meta information of post.
	 */
	function spacious_entry_meta( $spacious_show_readmore = true ) {
		if ( 'post' == get_post_type() ) :
			echo '<footer class="entry-meta-bar clearfix">';
			echo '<div class="entry-meta clearfix">';
			?>

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
			); ?>

			<?php if ( spacious_options( 'spacious_post_meta_category', 0 ) == 0 ) { ?>
			<?php if ( has_category() ) { ?>
				<span class="category"><?php the_category( ', ' ); ?></span>
			<?php } ?>
		<?php } ?>

			<?php if ( spacious_options( 'spacious_post_meta_comments', 0 ) == 0 ) { ?>
			<?php if ( comments_open() ) { ?>
				<span
					class="comments"><?php comments_popup_link( __( 'No Comments', 'spacious' ), __( '1 Comment', 'spacious' ), __( '% Comments', 'spacious' ), '', __( 'Comments Off', 'spacious' ) ); ?></span>
			<?php } ?>
		<?php } ?>

			<?php if ( spacious_options( 'spacious_post_meta_edit_button', 0 ) == 0 ) { ?>
			<?php edit_post_link( __( 'Edit', 'spacious' ), '<span class="edit-link">', '</span>' ); ?>
		<?php } ?>

			<?php if ( $spacious_show_readmore ) { ?>
			<span class="read-more-link"><a class="read-more"
			                                href="<?php the_permalink(); ?>"><?php echo spacious_options( 'spacious_read_more_text', __( 'Read more', 'spacious' ) ); ?></a></span>
		<?php } ?>

			<?php
			echo '</div>';
			echo '</footer>';
		endif;
	}
endif;

/**
 * function to add the social links in the Author Bio section
 */
if ( ! function_exists( 'spacious_author_bio_links' ) ) :

	function spacious_author_bio_links() {
		$author_name = get_the_author_meta( 'display_name' );

		// pulling the author social links url which are provided through WordPress SEO and All In One SEO Pack plugin
		$author_facebook_link   = get_the_author_meta( 'facebook' );
		$author_twitter_link    = get_the_author_meta( 'twitter' );
		$author_googleplus_link = get_the_author_meta( 'googleplus' );

		if ( $author_twitter_link || $author_googleplus_link || $author_facebook_link ) {
			echo '<div class="author-social-links">';
			printf( __( '<span>Follow %s on:</span>', 'spacious' ), $author_name );
			if ( $author_facebook_link ) {
				echo '<a href="' . esc_url( $author_facebook_link ) . '" title="' . esc_html__( 'Facebook', 'spacious' ) . '" target="_blank"><i class="fa fa-facebook"></i><span class="screen-reader-text">' . esc_html__( 'Facebook', 'spacious' ) . '</span></a>';
			}
			if ( $author_twitter_link ) {
				echo '<a href="https://twitter.com/' . esc_attr( $author_twitter_link ) . '" title="' . esc_html__( 'Twitter', 'spacious' ) . '" target="_blank"><i class="fa fa-twitter"></i><span class="screen-reader-text">' . esc_html__( 'Twitter', 'spacious' ) . '</span></a>';
			}
			if ( $author_googleplus_link ) {
				echo '<a href="' . esc_url( $author_googleplus_link ) . '" title="' . esc_html__( 'Google Plus', 'spacious' ) . '" rel="author" target="_blank"><i class="fa fa-google-plus"></i><span class="screen-reader-text">' . esc_html__( 'Google Plus', 'spacious' ) . '</span></a>';
			}
			echo '</div>';
		}
	}

endif;

/**
 * Migrate any existing theme CSS codes added in Additional CSS from free to pro version
 */
function spacious_custom_css_free_pro_migrate() {
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		if ( get_option( 'spacious_custom_css_transfer' ) ) {
			return;
		}

		$theme_options = get_option( 'theme_mods_spacious' );
		if ( $theme_options ) {
			$core_css        = wp_get_custom_css(); // Preserve any CSS already added to the core option.
			$free_custom_css = wp_get_custom_css( 'spacious' );
			$return          = wp_update_custom_css_post( $core_css . $free_custom_css );

			if ( ! is_wp_error( $return ) ) {
				// Set the transfer as true
				update_option( 'spacious_custom_css_transfer', 1 );
			}
		}
	}
}

add_action( 'after_switch_theme', 'spacious_custom_css_free_pro_migrate' );

// Displays the site logo
if ( ! function_exists( 'spacious_the_custom_logo' ) ) {
	/**
	 * Displays the optional custom logo.
	 */
	function spacious_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
}

/**
 * Transfer header designs options to header display type.
 */
function spacious_site_header_migrate() {

	if ( get_option( 'spacious_site_header_migrate' ) ) {
		return;
	}

	$spacious_header_design = spacious_options( 'spacious_header_design', 'style_one' );

	// Get theme options.
	$theme_options = get_option( 'spacious' );

	if ( 'style_two' === $spacious_header_design || 'style_four' === $spacious_header_design ) {

		// Set header display type to 4
		$theme_options['spacious_header_display_type'] = 'four';

	}

	// Remove header designs from database.
	unset( $theme_options['spacious_header_design'] );

	// Finally, update spacious theme options.
	update_option( 'spacious', $theme_options );

	update_option( 'spacious_site_header_migrate', 1 );


}

add_action( 'after_setup_theme', 'spacious_site_header_migrate' );

/**
 * Remove footer designs options
 */
function spacious_site_footer_designs_eliminate() {

	if ( get_option( 'spacious_site_footer_eliminate' ) ) {
		return;
	}

	$spacious_footer_design = spacious_options( 'spacious_footer_design', 'style_one' );

	if ( $spacious_footer_design ) {

		// Get theme options.
		$theme_options = get_option( 'spacious' );

		// Remove footer designs data from db.
		unset( $theme_options['spacious_footer_design'] );

		// Finally, update spacious theme options.
		update_option( 'spacious', $theme_options );

		// Set a flag.
		update_option( 'spacious_site_footer_eliminate', 1 );

	}

}

add_action( 'after_setup_theme', 'spacious_site_footer_designs_eliminate' );

/**
 * List of allowed social protocols in HTML attributes.
 *
 * @param array $protocols Array of allowed protocols.
 *
 * @return array
 */
function spacious_allowed_social_protocols( $protocols ) {
	$social_protocols = array(
		'skype',
	);

	return array_merge( $protocols, $social_protocols );
}

add_filter( 'kses_allowed_protocols', 'spacious_allowed_social_protocols' );


if ( ! function_exists( 'spacious_insert_mod_hatom_data' ) ) :

	/**
	 * Adding the support for the entry-title tag for Google Rich Snippets.
	 *
	 * @param $content The post content.
	 *
	 * @return string hatom data.
	 */
	function spacious_insert_mod_hatom_data( $content ) {

		$title = get_the_title();

		if ( is_single() && ! spacious_options( 'spacious_header_title_hide', 0 ) ) {
			$content .= '<div class="extra-hatom"><span class="entry-title">' . $title . '</span></div>';
		}

		return $content;

	}

	add_filter( 'the_content', 'spacious_insert_mod_hatom_data' );

endif;

if ( ! function_exists( 'spacious_entry_title' ) ) :

	/**
	 *
	 */
	function spacious_entry_title() {

		if ( spacious_options( 'spacious_header_title_hide', 0 ) ) {

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			elseif ( is_archive() ) :
				the_archive_title( '<h1 class="page-title">', '</h1>' );
			elseif ( is_404() ) :
				?>
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'spacious' ); ?></h1>
			<?php
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

		}
	}

endif;

if ( spacious_options( 'spacious_content_read_more_tag_display', 0 ) == 1 ) {
	add_filter( 'the_content_more_link', 'spacious_remove_more_jump_link' );
}


/**
 * Removing the more link jumping to middle of content
 */
function spacious_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) {
		$end = strpos( $link, '"', $offset );
	}
	if ( $end ) {
		$link = substr_replace( $link, '', $offset, $end - $offset );
	}

	return $link;
}

if ( ! function_exists( 'spacious_pingback_header' ) ) :

	/**
	 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
	 */
	function spacious_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

endif;

add_action( 'wp_head', 'spacious_pingback_header' );

function spacious_header_menu_button( $items, $args ) {
	$button_text_1   = spacious_options( 'spacious_header_button_one_setting' );
	$button_link_1   = spacious_options( 'spacious_header_button_one_link' );
	$button_target_1 = spacious_options( 'spacious_header_button_one_tab' );
	$button_target_1 = $button_target_1 ? ' target="_blank"' : '';

	$button_text_2   = spacious_options( 'spacious_header_button_two_setting' );
	$button_link_2   = spacious_options( 'spacious_header_button_two_link' );
	$button_target_2 = spacious_options( 'spacious_header_button_two_tab' );
	$button_target_2 = $button_target_2 ? ' target="_blank"' : '';

	if ( 'primary' === $args->theme_location ) {

		if ( $button_link_1 ) {
			$items .= '<li class="menu-item tg-header-button-wrap button-one">';
			$items .= '<a href="' . esc_url( $button_link_1 ) . '"' . esc_attr( $button_target_1 ) . '>';
			$items .= $button_text_1;
			$items .= '</a>';
			$items .= '</li>';
		}

		if ( $button_link_2 ) {
			$items .= '<li class="menu-item tg-header-button-wrap button-two">';
			$items .= '<a href="' . esc_url( $button_link_2 ) . '"' . esc_attr( $button_target_2 ) . '>';
			$items .= $button_text_2;
			$items .= '</a>';
			$items .= '</li>';
		}

	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'spacious_header_menu_button', 10, 2 );

if ( ! function_exists( 'spacious_shift_extra_menu' ) ) :
	/**
	 * Keep menu items on one line.
	 *
	 * @param string $items The HTML list content for the menu items.
	 * @param stdClass $args An object containing wp_nav_menu() arguments.
	 *
	 * @return string HTML for more button.
	 */
	function spacious_shift_extra_menu( $items, $args ) {

		if ( 'primary' === $args->theme_location && spacious_options( 'spacious_one_line_menu_setting', 0 ) ) :

			$items .= '<li class="menu-item menu-item-has-children tg-menu-extras-wrap">';
			$items .= '<span class="submenu-expand">';
			$items .= '<i class="fa fa-ellipsis-v"></i>';
			$items .= '</span>';
			$items .= '<ul class="sub-menu" id="tg-menu-extras">';
			$items .= '</ul>';
			$items .= '</li>';

		endif;

		return $items;
	}
endif;
add_filter( 'wp_nav_menu_items', 'spacious_shift_extra_menu', 12, 2 );

/**
 * Displays the `WooCommerce Add To Cart` button.
 *
 * @param $product
 */
function spacious_woocommerce_add_to_cart_link( $product ) {

	global $product;

	echo sprintf( '<a href="%s" data-quantity="1" class="add-to-cart %s" %s><i class="fa fa fa-shopping-cart"></i></a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( implode( ' ', array_filter( array(
			'product_type_' . $product->get_type(),
			$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
			$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
		) ) ) ),
		wc_implode_html_attributes( array(
			'data-product_id'  => $product->get_id(),
			'data-product_sku' => $product->get_sku(),
			'aria-label'       => $product->add_to_cart_description(),
			'rel'              => 'nofollow',
		) )
	);

}

/**
 * Update image attributes for retina logo.
 *
 * @see spacious_change_logo_attr()
 */
if ( ! function_exists( 'spacious_change_logo_attr' ) ) :
	function spacious_change_logo_attr( $attr, $attachment, $size ) {
		$custom_logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
		if ( $custom_logo ) {
			$custom_logo = $custom_logo[0];
		}

		if ( isset( $attr['class'] ) && 'custom-logo' === $attr['class'] ) {
			if ( 1 == spacious_options( 'spacious_different_retina_logo', 0 ) ) {
				$retina_logo = spacious_options( 'spacious_retina_logo_upload', '' );

				$attr['srcset'] = '';

				if ( $retina_logo ) {
					$attr['srcset'] = $custom_logo . ' 1x,' . $retina_logo . ' 2x';
				}
			}
		}

		return $attr;
	}

endif;

add_filter( 'wp_get_attachment_image_attributes', 'spacious_change_logo_attr', 10, 3 );

/**
 * Plugin check.
 */
if ( ! function_exists( 'spacious_plugin_version_compare' ) ) {
	function spacious_plugin_version_compare( $plugin_slug, $version_to_compare ) {
		$installed_plugins = get_plugins();

		// Plugin not installed.
		if ( ! isset( $installed_plugins[ $plugin_slug ] ) ) {
			return false;
		}

		$tdi_user_version = $installed_plugins[ $plugin_slug ]['Version'];

		return version_compare( $tdi_user_version, $version_to_compare, '<' );
	}
}
