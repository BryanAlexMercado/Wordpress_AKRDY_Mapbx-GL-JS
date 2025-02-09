<?php
/**
 * Spacious_Toolkit Elementor Slider 1 Element
 *
 * @author   ThemeGrill
 * @category Elements
 * @package  Spacious_Toolkit/Elements
 * @version  1.0.0
 */

namespace Elementor;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

class SPT_PRODUCT_CAUROSEL_1 extends Widget_Base {

	/**
	 * Retrieve SPT_PRODUCT_CAUROSEL_1 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'SPT-PRODUCT-CAUROSEL-1';
	}

	/**
	 * Retrieve SPT_PRODUCT_CAUROSEL_1 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product Carousel 1', 'spacious' );
	}

	/**
	 * Retrieve SPT_PRODUCT_CAUROSEL_1 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	/**
	 * Retrieve the list of categories the SPT_PRODUCT_CAUROSEL_1 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spacious-woocommerce-blocks' );
	}

	/**
	 * Retrieve the list of scripts the SPT_PRODUCT_CAUROSEL_1 widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'jquery-swiper' );
	}

	/**
	 * Register SPT_PRODUCT_CAUROSEL_1 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		spacious_get_controls_template( 'content-widget-product-carousel-1.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_PRODUCT_CAUROSEL_1 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		spacious_get_template( 'content-widget-product-carousel-1.php', $args = array( 'instance' => $this ) );
	}

}
