<?php
/**
 * Slider 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-slider-2.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_SLIDER_2
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_SLIDER_2
 */

use Elementor\SPT_SLIDER_2;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use ELementor\Group_Control_Typography;
use ELementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\ANIMATION;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_slider_title',
	array(
		'label' => esc_html__( 'Slider', 'spacious' ),
	)
);

// Features list
$instance->add_control(
	'slider',
	array(
		'label'       => esc_html__( 'Sliders', 'spacious' ),
		'type'        => Controls_Manager::REPEATER,
		'default'     => array(
			array(
				'title'        => esc_html__( 'Title #1', 'spacious' ),
				'description'  => esc_html__( 'Description #1', 'spacious' ),
				'image'        => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'button_text'  => '',
				'button_link'  => array(
					'url'         => esc_url( 'http://' ),
					'is_external' => '',
				),
			),
			array(
				'title'        => esc_html__( 'Title #2', 'spacious' ),
				'description'  => esc_html__( 'Description #2', 'spacious' ),
				'image'        => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'button_text'  => '',
				'button_link'  => array(
					'url'         => esc_url( 'http://' ),
					'is_external' => '',
				),
			),
		),
		'fields'      => array(
			array(
				'name'    => 'image',
				'label'   => esc_html__( 'Image', 'spacious' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			),
			array(
				'name'        => 'title',
				'label'       => esc_html__( 'Title', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Title', 'spacious' ),
				'label_block' => true,
			),
			array(
				'name'    => 'description',
				'label'   => esc_html__( 'Description', 'spacious' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Description', 'spacious' ),
			),
			array(
				'name'        => 'button_text',
				'label'       => esc_html__( 'Button Text', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
			),
			array(
				'name'        => 'button_link',
				'label'       => esc_html__( 'Button link', 'spacious' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url'         => esc_url( 'http://' ),
					'is_external' => '',
				),
				'label_block' => true,
			),
		),
		'title_field' => '{{{ title }}}',
	)
);

$instance->end_controls_section();

// Slider  Control section
$instance->start_controls_section(
	'section_slider_2_controls',
	array(
		'label' => esc_html__( 'Slider Controls', 'spacious' ),
	)
);

//Slider controls.
$instance->add_control(
	'slider_autoplay',
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
	'slider_delay',
	array(
		'label'     => __( 'Delay', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 4000,
		'condition' => array(
			'slider_autoplay' => 'yes',
		),
	)
);

$instance->add_control(
	'slider_speed',
	array(
		'label'     => __( 'Speed', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 1000,
		'condition' => array(
			'slider_autoplay' => 'yes',
		),
	)
);

$instance->add_control(
	'slider_per_view',
	array(
		'label'   => __( 'Slides to show', 'spacious' ),
		'type'    => \Elementor\Controls_Manager::SELECT,
		'default' => '3',
		'options' => array(
			'1' => __( '1', 'spacious' ),
			'2' => __( '2', 'spacious' ),
			'3' => __( '3', 'spacious' ),
			'4' => __( '4', 'spacious' ),
			'5' => __( '5', 'spacious' ),
			'6' => __( '6', 'spacious' ),
		),
	)
);

$instance->add_control(
	'pause_on_hover',
	array(
		'label'        => __( 'Pause on hover', 'spacious' ),
		'type'         => \Elementor\Controls_Manager::SWITCHER,
		'label_on'     => __( 'Enable', 'spacious' ),
		'label_off'    => __( 'Disable', 'spacious' ),
		'return_value' => 'yes',
		'default'      => 'no',
		'condition' => array(
			'slider_autoplay' => 'yes',
		),
	)
);

$instance->end_controls_section();

// Alignment  Control section
$instance->start_controls_section(
	'section_slider_2_alignment_controls',
	array(
		'label' => esc_html__( 'Alignment', 'spacious' ),
	)
);

// Alignment.
$instance->add_control(
	'slider_alignment',
	array(
		'label' => __( 'Alignment', 'spacious' ),
		'type' => \Elementor\Controls_Manager::CHOOSE,
		'options' => array(
			'left' => array(
				'title' => __( 'Left', 'spacious' ),
				'icon' => 'fa fa-align-left',
			),
			'center' => array(
				'title' => __( 'Center', 'spacious' ),
				'icon' => 'fa fa-align-center',
			),
			'right' => array(
				'title' => __( 'Right', 'spacious' ),
				'icon' => 'fa fa-align-right',
			),
		),
		'default' => 'left',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_slider_title_style',
	array(
		'label' => __( 'Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'slider_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#444444',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-style-two-text .caption-title' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .slider-style-two-text .caption-title',
	)
);

$instance->end_controls_section();

// Description
$instance->start_controls_section(
	'section_slider_description_style',
	array(
		'label' => __( 'Description', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'slider_description',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-style-two-text .caption-desc' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_description_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .slider-style-two-text .caption-desc',
	)
);

$instance->end_controls_section();

// Button
$instance->start_controls_section(
	'section_slider_primary_button_style',
	array(
		'label' => __( 'Button', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_responsive_control(
	'section_slider_button_padding',
	array(
		'label'      => __( 'Padding', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .btn-slider-style-two a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);


$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_button_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .btn-slider-style-two a',
	)
);

$instance->start_controls_tabs(
	'button_style_tabs'
);

$instance->start_controls_tab(
	'button_normal_tab',
	array(
		'label' => __( 'Normal', 'spacious' ),
	)
);

$instance->add_control(
	'button_text_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .btn-slider-style-two a' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_control(
	'button_background_color',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .btn-slider-style-two a' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'button_border',
		'selector'  => '{{WRAPPER}} .btn-slider-style-two a',
		'separator' => 'before',
	)
);

$instance->add_responsive_control(
	'section_slider_button_radius',
	array(
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .btn-slider-style-two a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_tab();

// For button hover.
$instance->start_controls_tab(
	'button_hover_tab',
	array(
		'label' => __( 'Hover', 'spacious' ),
	)
);

$instance->add_control(
	'button_text_color_hover',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .btn-slider-style-two a:hover' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_control(
	'button_background_color_hover',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .btn-slider-style-two a:hover' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'button_border_hover',
		'selector'  => '{{WRAPPER}} .btn-slider-style-two a:hover',
		'separator' => 'before',
	)
);

$instance->add_responsive_control(
	'section_slider_button_hover_radius',
	array(
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .btn-slider-style-two a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->end_controls_section();
