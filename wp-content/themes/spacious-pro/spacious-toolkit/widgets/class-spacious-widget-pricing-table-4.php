<?php
/**
 * Spacious_Toolkit Elementor Pricing Table 4 Element
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

class SPT_PRICING_TABLE_4 extends Widget_Base {

	/**
	 * Retrieve SPT_PRICING_TABLE_4 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'SPT-PRICING-TABLE-4';
	}

	/**
	 * Retrieve SPT_PRICING_TABLE_4 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Pricing Table 4', 'spacious' );
	}

	/**
	 * Retrieve SPT_PRICING_TABLE_4 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'spacious-econs-pricing-table-4';
	}

	/**
	 * Retrieve the list of categories the SPT_PRICING_TABLE_4 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spacious-toolkit-pricing-table-widgets' );
	}

	/**
	 * Register SPT_PRICING_TABLE_4 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->add_inline_editing_attributes( 'title' );
		$this->add_inline_editing_attributes( 'currency' );
		$this->add_inline_editing_attributes( 'price' );
		$this->add_inline_editing_attributes( 'pricing_duration' );
		$this->add_inline_editing_attributes( 'feature_heading' );
		$this->add_inline_editing_attributes( 'button_text' );

		spacious_get_controls_template( 'content-widget-pricing-table-4.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_PRICING_TABLE_4 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		spacious_get_template( 'content-widget-pricing-table-4.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_PRICING_TABLE_4 widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {
		spacious_get_preview_template( 'content-widget-pricing-table-4.php', $args = array( 'instance' => $this ) );
	}
}