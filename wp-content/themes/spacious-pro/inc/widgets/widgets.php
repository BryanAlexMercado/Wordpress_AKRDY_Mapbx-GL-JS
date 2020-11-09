<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */

add_action( 'widgets_init', 'spacious_widgets_init' );
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function spacious_widgets_init() {

	// Registering main right sidebar
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'spacious' ),
		'id'            => 'spacious_right_sidebar',
		'description'   => __( 'Shows widgets at Right side.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering main left sidebar
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'spacious' ),
		'id'            => 'spacious_left_sidebar',
		'description'   => __( 'Shows widgets at Left side.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering Header sidebar
	register_sidebar( array(
		'name'          => __( 'Header Sidebar', 'spacious' ),
		'id'            => 'spacious_header_sidebar',
		'description'   => __( 'Shows widgets in header section just above the main navigation menu.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template top section sidebar
	register_sidebar( array(
		'name'          => __( 'Business Top Sidebar', 'spacious' ),
		'id'            => 'spacious_business_page_top_section_sidebar',
		'description'   => __( 'Shows widgets on Business Page Template Top Section.', 'spacious' ) . ' ' . __( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Posts, TG: Featured Widget, TG: Our Clients', 'spacious' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template middle section left half sidebar
	register_sidebar( array(
		'name'          => __( 'Business Middle Left Sidebar', 'spacious' ),
		'id'            => 'spacious_business_page_middle_section_left_half_sidebar',
		'description'   => __( 'Shows widgets on Business Page Template Middle Section Left Half.', 'spacious' ) . ' ' . __( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'spacious' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering Business Page template middle section right half sidebar
	register_sidebar( array(
		'name'          => __( 'Business Middle Right Sidebar', 'spacious' ),
		'id'            => 'spacious_business_page_middle_section_right_half_sidebar',
		'description'   => __( 'Shows widgets on Business Page Template Middle Section Right Half.', 'spacious' ) . ' ' . __( 'Suitable widget: TG: Testimonial, TG: Featured Single Page', 'spacious' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


	// Registering Business Page template bottom section sidebar
	register_sidebar( array(
		'name'          => __( 'Business Bottom Sidebar', 'spacious' ),
		'id'            => 'spacious_business_page_bottom_section_sidebar',
		'description'   => __( 'Shows widgets on Business Page Template Bottom Section.', 'spacious' ) . ' ' . __( 'Suitable widget: TG: Services, TG: Call To Action Widget, TG: Featured Posts, TG: Featured Widget, TG: Our Clients', 'spacious' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Registering contact Page sidebar
	register_sidebar( array(
		'name'          => __( 'Contact Page Sidebar', 'spacious' ),
		'id'            => 'spacious_contact_page_sidebar',
		'description'   => __( 'Shows widgets on Contact Page Template.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering woocommerce sidebar
	if ( class_exists( 'woocommerce' ) ) {
		register_sidebar( array(
			'name'          => __( 'Shop Sidebar', 'spacious' ),
			'id'            => 'spacious_woocommerce_sidebar',
			'description'   => __( 'Widget area for WooCommerce Pages.', 'spacious' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Registering Error 404 Page sidebar
	register_sidebar( array(
		'name'          => __( 'Error 404 Page Sidebar', 'spacious' ),
		'id'            => 'spacious_error_404_page_sidebar',
		'description'   => __( 'Shows widgets on Error 404 page.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// Registering footer sidebar one
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar One', 'spacious' ),
		'id'            => 'spacious_footer_sidebar_one',
		'description'   => __( 'Shows widgets at footer sidebar one.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	// custom footer sidebar column select
	$sidebar_num = '';
	$sidebar_num = spacious_options( 'spacious_footer_widget_column_select_type', 'four' );
	if ( $sidebar_num == 'four' || $sidebar_num == 'three' || $sidebar_num == 'two' || $sidebar_num == 'two-style-1' || $sidebar_num == 'two-style-2' || $sidebar_num == 'three-style-1' || $sidebar_num == 'three-style-2' || $sidebar_num == 'three-style-3' || $sidebar_num == 'four-style-1' || $sidebar_num == 'four-style-2' ) {
		// Registering footer sidebar two
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar Two', 'spacious' ),
			'id'            => 'spacious_footer_sidebar_two',
			'description'   => __( 'Shows widgets at footer sidebar two.', 'spacious' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( $sidebar_num == 'four' || $sidebar_num == 'three' || $sidebar_num == 'three-style-1' || $sidebar_num == 'three-style-2' || $sidebar_num == 'three-style-3' || $sidebar_num == 'four-style-1' || $sidebar_num == 'four-style-2' ) {
		// Registering footer sidebar three
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar Three', 'spacious' ),
			'id'            => 'spacious_footer_sidebar_three',
			'description'   => __( 'Shows widgets at footer sidebar three.', 'spacious' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( $sidebar_num == 'four' || $sidebar_num == 'four-style-1' || $sidebar_num == 'four-style-2' ) {
		// Registering footer sidebar four
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar Four', 'spacious' ),
			'id'            => 'spacious_footer_sidebar_four',
			'description'   => __( 'Shows widgets at footer sidebar four.', 'spacious' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Full width footer sidebar.
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar Full Width', 'spacious' ),
		'id'            => 'spacious_footer_sidebar_full_width',
		'description'   => esc_html__( 'Shows widgets just above footer copyright area.', 'spacious' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	if ( spacious_options( 'spacious_togglable_header_sidebar_setting', 0 ) == 1 ) {
		// Registering Header sidebar one
		register_sidebar( array(
			'name'          => __( 'Toggable Header Sidebar One', 'spacious' ),
			'id'            => 'spacious_header_toggle_sidebar_one',
			'description'   => __( 'Shows widgets in header section one.', 'spacious' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>'
		) );

		// custom Toggable Header sidebar column select
		$headersidebar_num = spacious_options( 'spacious_togglable_header_sidebar_column', 'four' );
		if ( $headersidebar_num == 'four' || $headersidebar_num == 'three' || $headersidebar_num == 'two' || $headersidebar_num == 'two-style-1' || $headersidebar_num == 'two-style-2' || $headersidebar_num == 'three-style-1' || $headersidebar_num == 'three-style-2' || $headersidebar_num == 'three-style-3' || $headersidebar_num == 'four-style-1' || $headersidebar_num == 'four-style-2' ) {

			// Registering Header sidebar two.
			register_sidebar( array(
				'name'          => __( 'Toggable Header Sidebar Two', 'spacious' ),
				'id'            => 'spacious_header_toggle_sidebar_two',
				'description'   => __( 'Shows widgets in header section two.', 'spacious' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>'
			) );
		}

		if ( $headersidebar_num == 'four' || $headersidebar_num == 'three' || $headersidebar_num == 'three-style-1' || $headersidebar_num == 'three-style-2' || $headersidebar_num == 'three-style-3' || $headersidebar_num == 'four-style-1' || $headersidebar_num == 'four-style-2' ) {
			// Registering Header sidebar three
			register_sidebar( array(
				'name'          => __( 'Toggable Header Sidebar Three', 'spacious' ),
				'id'            => 'spacious_header_toggle_sidebar_three',
				'description'   => __( 'Shows widgets in header section three.', 'spacious' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>'
			) );
		}

		if ( $headersidebar_num == 'four' || $headersidebar_num == 'four-style-1' || $headersidebar_num == 'four-style-2' ) {
			// Registering Header sidebar four
			register_sidebar( array(
				'name'          => __( 'Toggable Header Sidebar Four', 'spacious' ),
				'id'            => 'spacious_header_toggle_sidebar_four',
				'description'   => __( 'Shows widgets in header section four.', 'spacious' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>'
			) );
		}

		// Full width header sidebar.
		register_sidebar( array(
			'name'          => __( 'Toggable Header Sidebar Full Width', 'spacious' ),
			'id'            => 'spacious_header_sidebar_full_width',
			'description'   => esc_html__( 'Shows widgets in Header sidebar .', 'spacious' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	// Registering widgets
	register_widget( "spacious_featured_single_page_widget" );
	register_widget( "spacious_service_widget" );
	register_widget( "spacious_call_to_action_widget" );
	register_widget( "spacious_testimonial_widget" );
	register_widget( "spacious_recent_work_widget" );
	register_widget( "spacious_featured_posts_widget" );
	register_widget( "spacious_our_clients_widget" );
	register_widget( "spacious_team_widget" );
	register_widget( "spacious_fun_facts_widget" );
	register_widget( "spacious_pricing_table_widget" );
	register_widget( "spacious_accordian_widget" );
	register_widget( "spacious_woocommerce_product" );
}

/****************************************************************************************/
/**
 * Include Spacious widgets class.
 */
// Class: TG: Accordian.
require_once get_template_directory() . '/inc/widgets/class-spacious-accordian-widget.php';

// Class: TG: Call to Action Widget.
require_once get_template_directory() . '/inc/widgets/class-spacious-call-to-action-widget.php';

// Class: TG: Featured Posts.
require_once get_template_directory() . '/inc/widgets/class-spacious-featured-posts-widget.php';

// Class: TG: Featured Single Page.
require_once get_template_directory() . '/inc/widgets/class-spacious-featured-single-page-widget.php';

// Class: TG: Featured Widget.
require_once get_template_directory() . '/inc/widgets/class-spacious-recent-work-widget.php';

// Class: TG: Fun Facts.
require_once get_template_directory() . '/inc/widgets/class-spacious-fun-facts-widget.php';

// Class: TG: Our Clients.
require_once get_template_directory() . '/inc/widgets/class-spacious-our-clients-widget.php';

// Class: TG: Pricing Table.
require_once get_template_directory() . '/inc/widgets/class-spacious-pricing-table-widget.php';

// Class: TG: Services.
require_once get_template_directory() . '/inc/widgets/class-spacious-service-widget.php';

// Class: TG: Team.
require_once get_template_directory() . '/inc/widgets/class-spacious-team-widget.php';

// Class: TG: Testimonial.
require_once get_template_directory() . '/inc/widgets/class-spacious-testimonial-widget.php';

// Class: TG: Product.
require_once get_template_directory() . '/inc/widgets/class-spacious-product-widget.php';
