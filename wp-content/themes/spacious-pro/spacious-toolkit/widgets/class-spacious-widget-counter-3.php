<?php
/**
 * Spacious_Toolkit Elementor Counter 3 Element
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

class SPT_COUNTER_3 extends Widget_Base {

	/**
	 * Retrieve SPT_COUNTER_3 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'SPT-COUNTER-3';
	}

	/**
	 * Retrieve SPT_COUNTER_3 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Counter 3', 'spacious' );
	}

	/**
	 * Retrieve SPT_COUNTER_3 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'spacious-econs-counter-3';
	}

	/**
	 * Retrieve the list of categories the SPT_COUNTER_3 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spacious-toolkit-counter-widgets' );
	}

	/**
	 * Retrieve the list of scripts the SPT_COUNTER_2 widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'jquery-waypoints', 'jquery-countTo' );
	}

	/**
	 * Register SPT_COUNTER_3 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->add_inline_editing_attributes( 'title' );
		spacious_get_controls_template( 'content-widget-counter-3.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_COUNTER_3 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		spacious_get_template( 'content-widget-counter-3.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_COUNTER_3 widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {
		spacious_get_preview_template( 'content-widget-counter-3.php', $args = array( 'instance' => $this ) );
	}
}