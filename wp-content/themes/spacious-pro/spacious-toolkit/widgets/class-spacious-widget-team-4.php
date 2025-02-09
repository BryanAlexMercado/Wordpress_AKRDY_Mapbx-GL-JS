<?php
/**
 * Spacious_Toolkit Elementor Team 4 Element
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

class SPT_TEAM_4 extends Widget_Base {

	/**
	 * Retrieve SPT_TEAM_4 widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'SPT-TEAM-4';
	}

	/**
	 * Retrieve SPT_TEAM_4 widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Team 4', 'spacious' );
	}

	/**
	 * Retrieve SPT_TEAM_4 widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'spacious-econs-team-4';
	}

	/**
	 * Retrieve the list of categories the SPT_TEAM_4 widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'spacious-toolkit-team-widgets' );
	}

	/**
	 * Register SPT_TEAM_4 widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->add_inline_editing_attributes( 'member_name' );
		$this->add_inline_editing_attributes( 'member_designation' );

		spacious_get_controls_template( 'content-widget-team-4.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_TEAM_4 widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		spacious_get_template( 'content-widget-team-4.php', $args = array( 'instance' => $this ) );
	}

	/**
	 * Render SPT_TEAM_4 widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function _content_template() {
		spacious_get_preview_template( 'content-widget-team-4.php', $args = array( 'instance' => $this ) );
	}
}