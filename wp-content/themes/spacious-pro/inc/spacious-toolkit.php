<?php
/**
 * Adds new widgets and compatibility for the Elementor plugin in Spacious theme.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Spacious_Elementor_Addons {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * Get suffix for library files
	 *
	 * @var string
	 */
	private $suffix;

	/**
	 * Returns an instance of this class.
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new Spacious_Elementor_Addons();
		}

		return self::$instance;

	}

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	public function __construct() {

		// Assign suffix for library files
		$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// Adding Elementor widgets
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'spacious_add_elementor_widgets' ) );

		// Enqueue style for Elementor front-end
		add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'spacious_elementor_styles' ) );

		// Enqueue scripts for Elementor front-end
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'spacious_elementor_enqueue_scripts' ) );

		// Register scripts for Elementor front-end
		add_action( 'elementor/frontend/before_register_scripts', array(
			$this,
			'spacious_elementor_register_scripts',
		) );

		// Add elementor category.
		add_action( 'elementor/init', array( $this, 'spacious_elementor_category' ) );

	}

	/**
	 * Require and instantiate Elementor Widgets.
	 *
	 * @param $widgets_manager
	 */
	public function spacious_add_elementor_widgets( $widgets_manager ) {
		// Add elementor widgets files
		$this->spacious_add_elementor_widget();

		// Add elementor widget classes
		$this->spacious_add_elementor_class( $widgets_manager );
	}

	/**
	 * Add the list of files for elementor widgets
	 */
	public function spacious_add_elementor_widget() {

		// List of files of the elementor widgets
		// CTA 2
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-cta-2.php';
		// CTA 3
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-cta-3.php';

		// COUNTER 2
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-counter-2.php';
		// COUNTER 3
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-counter-3.php';

		// ICON BOX 1
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-icon-box-1.php';
		// ICON BOX 2
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-icon-box-2.php';
		// ICON BOX 3
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-icon-box-3.php';
		// ICON BOX 4
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-icon-box-4.php';
		// ICON BOX 5
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-icon-box-5.php';

		// PRICING TABLE 1
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-pricing-table-1.php';
		// PRICING TABLE 2
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-pricing-table-2.php';
		// PRICING TABLE 3
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-pricing-table-3.php';
		// PRICING TABLE 4
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-pricing-table-4.php';

		// TEAM 3
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-team-3.php';
		// TEAM 4
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-team-4.php';
		// OUR TEAM 5
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-team-5.php';

		// TESTIMONIAL 1
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-testimonial-1.php';
		// TESTIMONIAL 2
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-testimonial-2.php';
		// TESTIMONIAL 3
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-testimonial-3.php';
		// TESTIMONIAL 4
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-testimonial-4.php';

		// SLIDER 1
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-slider-1.php';

		// SLIDER 2
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-slider-2.php';

		// Block Post 2.
		require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-block-2.php';

		if ( class_exists( 'woocommerce' ) ) {
			// PRODUCT CAROUSEL 1
			require SPACIOUS_TOOLKIT_WIDGETS_DIR . '/class-spacious-widget-product-carousel-1.php';
		}
	}

	/**
	 * Add the list of classes for elementor widgets
	 */
	public function spacious_add_elementor_class( $widgets_manager ) {

		// List of class of the elementor widgets
		// CTA 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_CTA_2() );
		// CTA 3
		$widgets_manager->register_widget_type( new \Elementor\SPT_CTA_3() );

		// COUNTER 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_COUNTER_2() );
		// COUNTER 3
		$widgets_manager->register_widget_type( new \Elementor\SPT_COUNTER_3() );

		// ICON BOX 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_ICON_BOX_1() );
		// ICON BOX 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_ICON_BOX_2() );
		// ICON BOX 3
		$widgets_manager->register_widget_type( new \Elementor\SPT_ICON_BOX_3() );
		// ICON BOX 4
		$widgets_manager->register_widget_type( new \Elementor\SPT_ICON_BOX_4() );
		// ICON BOX 5
		$widgets_manager->register_widget_type( new \Elementor\SPT_ICON_BOX_5() );

		// PRICING TABLE 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_PRICING_TABLE_1() );
		// PRICING TABLE 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_PRICING_TABLE_2() );
		// PRICING TABLE 3
		$widgets_manager->register_widget_type( new \Elementor\SPT_PRICING_TABLE_3() );
		// PRICING TABLE 4
		$widgets_manager->register_widget_type( new \Elementor\SPT_PRICING_TABLE_4() );

		// TEAM 3
		$widgets_manager->register_widget_type( new \Elementor\SPT_TEAM_3() );
		// TEAM 4
		$widgets_manager->register_widget_type( new \Elementor\SPT_TEAM_4() );
		// TEAM 5
		$widgets_manager->register_widget_type( new \Elementor\SPT_TEAM_5() );

		// TESTIMONIAL 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_TESTIMONIAL_1() );
		// TESTIMONIAL 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_TESTIMONIAL_2() );
		// TESTIMONIAL 3
		$widgets_manager->register_widget_type( new \Elementor\SPT_TESTIMONIAL_3() );
		// TESTIMONIAL 4
		$widgets_manager->register_widget_type( new \Elementor\SPT_TESTIMONIAL_4() );

		// SLIDER 1
		$widgets_manager->register_widget_type( new \Elementor\SPT_SLIDER_1() );

		// SLIDER 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_SLIDER_2() );

		//BLOCK POST 2
		$widgets_manager->register_widget_type( new \Elementor\SPT_BLOCK_2() );

		if ( class_exists( 'woocommerce' ) ) {
			// PRODUCT CAROUSEL 1
			$widgets_manager->register_widget_type( new \Elementor\SPT_PRODUCT_CAUROSEL_1() );
		}
	}

	/**
	 * Enqueue styles for Elementor frontends
	 */
	public function spacious_elementor_styles() {
		// Enqueue the main Elementor CSS file for use with Elementor.
		wp_enqueue_style( 'spacious-elementor', get_template_directory_uri() . '/inc/elementor/assets/css/elementor.css' );
	}

	/**
	 * Enqueue scripts for Elementor frontends
	 */
	public function spacious_elementor_enqueue_scripts() {
		/**
		 * Register scripts for elementor widgets
		 */
		wp_enqueue_script( 'elementor-custom', SPACIOUS_JS_URL . '/elementor-custom' . $this->suffix . '.js', array( 'jquery' ), false, true );
	}

	/**
	 * Enqueue styles for Elementor editor
	 */
	public function spacious_elementor_register_scripts() {
		wp_register_script( 'jquery-countTo', SPACIOUS_JS_URL . '/jquery.countTo' . $this->suffix . '.js', array( 'jquery' ), false, true );
	}

	/**
	 * Register spacious toolkit blocks.
	 */
	public function spacious_elementor_category() {

		// Register Spacious WooCommerce block category for Elementor section
		\Elementor\Plugin::instance()->elements_manager->add_category( 'spacious-woocommerce-blocks', array(
			'title' => esc_html__( 'Spacious WooCommerce', 'spacious' ),
		), 1 );

	}

	public static function spacious_woocommerce_category() {

		$output     = array();
		$categories = get_categories(
			array(
				'taxonomy' => 'product_cat',
			)
		);

		foreach ( $categories as $category ) {
			$output[ $category->term_id ] = $category->name;
		}

		return $output;

	}

}

new Spacious_Elementor_Addons();
