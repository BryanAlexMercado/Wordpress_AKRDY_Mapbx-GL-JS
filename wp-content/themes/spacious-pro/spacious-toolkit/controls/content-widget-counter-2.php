<?php
/**
 * COUNTER 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-counter-2.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_COUNTER_2
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_COUNTER_2
 */

use Elementor\SPT_COUNTER_2;
use Elementor\Controls_Manager;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_counter_title',
	array(
		'label' => esc_html__( 'Counter', 'spacious' ),
	)
);

// Icon
$instance->add_control(
	'icon',
	array(
		'label'   => esc_html__( 'Icon', 'spacious' ),
		'type'    => Controls_Manager::ICON,
		'default' => 'fa fa-folder',
	)
);

// Starting number
$instance->add_control(
	'starting_number',
	array(
		'label'   => esc_html__( 'Starting number', 'spacious' ),
		'type'    => Controls_Manager::NUMBER,
		'default' => 10,
	)
);

// Ending number
$instance->add_control(
	'ending_number',
	array(
		'label'   => esc_html__( 'Ending number', 'spacious' ),
		'type'    => Controls_Manager::NUMBER,
		'default' => 100,
	)
);

// Animation speed
$instance->add_control(
	'speed',
	array(
		'label'   => esc_html__( 'Animation speed', 'spacious' ),
		'type'    => Controls_Manager::NUMBER,
		'default' => 3000,
		'min'     => 100,
		'step'    => 100,
	)
);

// Animation interval
$instance->add_control(
	'interval',
	array(
		'label'   => esc_html__( 'Animation interval', 'spacious' ),
		'type'    => Controls_Manager::NUMBER,
		'default' => 500,
		'min'     => 1,
		'step'    => 100,
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Projects', 'spacious' ),
	)
);

$instance->end_controls_section();