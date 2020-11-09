<?php
/**
 * Team 5 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-team-5.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_TEAM_5
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_TEAM_5
 */

use Elementor\SPT_TEAM_5;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use ELementor\Group_Control_Typography;
use ELementor\Group_Control_Border;
use Elementor\Scheme_Typography;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_team_title',
	array(
		'label' => esc_html__( 'Team', 'spacious' ),
	)
);

// Our team Details
$instance->add_control(
	'team',
	array(
		'label'       => esc_html__( 'Our Team', 'spacious' ),
		'type'        => Controls_Manager::REPEATER,
		'default'     => array(
			array(
				'member_name'        => esc_html__( 'Member #1', 'spacious' ),
				'member_designation' => esc_html__( 'Designation #1', 'spacious' ),
				'image'              => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			),
			array(
				'member_name'        => esc_html__( 'Member #2', 'spacious' ),
				'member_designation' => esc_html__( 'Designation #2', 'spacious' ),
				'image'              => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			),
		),
		'fields'      => array(
			array(
				'name'        => 'member_name',
				'label'       => esc_html__( 'Name', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Name', 'spacious' ),
				'label_block' => true,
			),
			array(
				'name'    => 'member_designation',
				'label'   => esc_html__( 'Designation', 'spacious' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Designation', 'spacious' ),
			),
			array(
				'name'    => 'image',
				'label'   => esc_html__( 'Image', 'spacious' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			),
		),
		'title_field' => '{{{ member_name }}}',
	)
);

$instance->end_controls_section();

// Slider Control section
$instance->start_controls_section(
	'section_team_controls',
	array(
		'label' => esc_html__( 'Team Controls', 'spacious' ),
	)
);

//Team slider controls.
$instance->add_control(
	'team_autoplay',
	array(
		'label'        => __( 'Enable AutoPlay', 'spacious' ),
		'type'         => \Elementor\Controls_Manager::SWITCHER,
		'label_on'     => __( 'Enable', 'spacious' ),
		'label_off'    => __( 'Disable', 'spacious' ),
		'return_value' => 'yes',
		'default'      => 'no',
	)
);

$instance->add_control(
	'team_delay',
	array(
		'label'     => __( 'Delay', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 4000,
		'condition' => array(
			'team_autoplay' => 'yes',
		),
	)
);

$instance->add_control(
	'team_speed',
	array(
		'label'     => __( 'Speed', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 1000,
		'condition' => array(
			'team_autoplay' => 'yes',
		),
	)
);
$instance->add_control(
	'team_per_view',
	[
		'label'   => __( 'Team to show', 'spacious' ),
		'type'    => \Elementor\Controls_Manager::SELECT,
		'default' => '4',
		'options' => [
			'2' => __( '2', 'spacious' ),
			'3' => __( '3', 'spacious' ),
			'4' => __( '4', 'spacious' ),
		],
	]
);

$instance->end_controls_section();

// Team Widget Alignment.
$instance->start_controls_section(
	'section_team_alignment',
	array(
		'label' => esc_html__( 'Alignment', 'spacious' ),
	)
);

$instance->add_responsive_control(
	'team_alignment',
	[
		'label'   => __( 'Alignment', 'spacious' ),
		'type'    => \Elementor\Controls_Manager::CHOOSE,
		'options' => [
			'left'   => [
				'title' => __( 'Left', 'spacious' ),
				'icon'  => 'fa fa-align-left',
			],
			'center' => [
				'title' => __( 'Center', 'spacious' ),
				'icon'  => 'fa fa-align-center',
			],
			'right'  => [
				'title' => __( 'Right', 'spacious' ),
				'icon'  => 'fa fa-align-right',
			],
		],
		'default' => 'center',
	]
);

$instance->end_controls_section();

$instance->start_controls_section(
	'team_image_section',
	[
		'label' => __( 'Image', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
	]
);

$instance->add_responsive_control(
	'border-radius',
	[
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%' ],
		'selectors'  => [
			'{{WRAPPER}} .swiper-container .swiper-slide figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_team_name_controls_style',
	array(
		'label' => __( 'Name', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'team_name_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#252525',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'name_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .team-title',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_team_designation_controls_style',
	array(
		'label' => __( 'Designation', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'designation_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#67666a',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-desc' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'designation_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .team-desc',
	)
);

$instance->end_controls_section();
