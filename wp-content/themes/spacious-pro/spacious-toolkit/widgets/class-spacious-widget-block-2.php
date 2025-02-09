<?php
/**
 * Spacious_Toolkit Elementor Block 2 Element
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

class SPT_BLOCK_2 extends Widget_Base {

	/**
	 * Retrieve SPT_BLOCK_1 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'SPT-BLOCK-2';
	}

	/**
	 * Retrieve SPT_BLOCK_2 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Block Posts 2', 'spacious-toolkit' );
	}

	/**
	 * Retrieve SPT_BLOCK_1 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'spacious-econs-block-2';
	}

	/**
	 * Retrieve the list of categories the SPT_BLOCK_1 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spacious-toolkit-block-widgets' );
	}

	/**
	 * Register SPT_BLOCK_1 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		spacious_get_controls_template( 'content-widget-block-2.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_BLOCK_2 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		spacious_get_template( 'content-widget-block-2.php', $args = array( 'instance' => $this ) );
	}

}
