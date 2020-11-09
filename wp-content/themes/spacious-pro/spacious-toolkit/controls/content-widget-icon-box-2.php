<?php
/**
 * Icon Box 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-icon-box-2.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_ICON_BOX_2
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_ICON_BOX_2
 */

use Elementor\SPT_ICON_BOX_2;
use Elementor\Controls_Manager;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_icon_box_title',
	array(
		'label' => esc_html__( 'Icon Box', 'spacious' ),
	)
);

// Icon
$instance->add_control(
	'icon',
	array(
		'label'   => esc_html__( 'Icon', 'spacious' ),
		'type'    => Controls_Manager::ICON,
		'default' => esc_attr( 'fa fa-wordpress' ),
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Icon box title', 'spacious' ),
	)
);

// Link
$instance->add_control(
	'link',
	array(
		'label'       => esc_html__( 'Title link', 'spacious' ),
		'type'        => Controls_Manager::URL,
		'placeholder' => esc_url( 'http://site-link.com' ),
	)
);

// Content
$instance->add_control(
	'content',
	array(
		'label'   => esc_html__( 'Content', 'spacious' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Icon box content', 'spacious' ),
	)
);

$instance->end_controls_section();