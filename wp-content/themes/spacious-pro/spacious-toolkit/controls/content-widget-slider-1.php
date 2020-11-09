<?php
/**
 * Slider 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-slider-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_TESTIMONIAL_1
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_TESTIMONIAL_1
 */

use Elementor\SPT_SLIDER_1;
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
				'title'        => esc_html__( 'Slider title #1', 'spacious' ),
				'description'  => esc_html__( 'Slider description #1', 'spacious' ),
				'image'        => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'button_text'  => esc_html__( 'Click here', 'spacious' ),
				'button_link'  => array(
					'url'         => esc_url( 'http://' ),
					'is_external' => '',
				),
				'button_text1' => '',
				'button_link1' => array(
					'url'         => '',
					'is_external' => '',
				),
			),
			array(
				'title'        => esc_html__( 'Slider title #2', 'spacious' ),
				'description'  => esc_html__( 'Slider description #2', 'spacious' ),
				'image'        => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'button_text'  => esc_html__( 'Click here', 'spacious' ),
				'button_link'  => array(
					'url'         => esc_url( 'http://' ),
					'is_external' => '',
				),
				'button_text1' => '',
				'button_link1' => array(
					'url'         => '',
					'is_external' => '',
				),
			),
		),
		'fields'      => array(
			array(
				'name'        => 'title',
				'label'       => esc_html__( 'Title', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Slider title', 'spacious' ),
				'label_block' => true,
			),
			array(
				'name'    => 'description',
				'label'   => esc_html__( 'Description', 'spacious' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Slider description', 'spacious' ),
			),
			array(
				'name'    => 'image',
				'label'   => esc_html__( 'Image', 'spacious' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			),
			array(
				'name'        => 'button_text',
				'label'       => esc_html__( 'Button Text', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Click here', 'spacious' ),
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
			array(
				'name'        => 'button_text1',
				'label'       => esc_html__( 'Button Text 1', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
			),
			array(
				'name'        => 'button_link1',
				'label'       => esc_html__( 'Button link 1', 'spacious' ),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url'         => '',
					'is_external' => '',
				),
				'label_block' => true,
			),
		),
		'title_field' => '{{{ title }}}',
	)
);

$instance->end_controls_section();

// Slider Control section
$instance->start_controls_section(
	'section_slider_controls',
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

$instance->start_controls_section(
	'section_slider_title_style',
	array(
		'label' => __( 'Slider Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'slider_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .caption-title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .slider-inner-part .caption-title',
	)
);

$instance->add_responsive_control(
	'slider_title_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .caption-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'slider_title_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .caption-title' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_slider_description_style',
	array(
		'label' => __( 'Slider Description', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'slider_description',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .caption-desc' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_description_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .slider-inner-part .caption-desc',
	)
);

$instance->add_responsive_control(
	'slider_description_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .caption-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'slider_description_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .caption-desc' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_slider_primary_button_style',
	array(
		'label' => __( 'Primary Button', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_responsive_control(
	'section_slider_primary_button_padding',
	array(
		'label'      => __( 'Padding', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .btn.btn--primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);


$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_primary_button_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--primary',
	)
);

$instance->start_controls_tabs(
	'button_style_primary_tabs'
);

$instance->start_controls_tab(
	'button_primary_normal_tab',
	array(
		'label' => __( 'Normal', 'spacious' ),
	)
);

$instance->add_control(
	'default_button_text_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--primary' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'default_button_background_color',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper .btn--primary' => 'background-color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'default_button_border',
		'selector'  => '{{WRAPPER}} .slider-inner-part .button-wrapper .btn--primary',
		'separator' => 'before',
	)
);

$instance->end_controls_tab();

$instance->start_controls_tab(
	'button_primary_hover_tab',
	array(
		'label' => __( 'Hover', 'spacious' ),
	)
);

$instance->add_control(
	'default_button_text_color_hover',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--primary:hover' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'default_button_background_color_hover',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper .btn--primary:hover' => 'background-color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'default_button_border_hover',
		'selector'  => '{{WRAPPER}} .slider-inner-part .button-wrapper .btn--primary:hover',
		'separator' => 'before',
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->end_controls_section();

$instance->start_controls_section(
	'section_slider_secondary_button_style',
	array(
		'label' => __( 'Secondary Button', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_responsive_control(
	'section_slider_secondary_button_padding',
	array(
		'label'      => __( 'Padding', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .btn.btn--secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'slider_secondary_button_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary',
	)
);

$instance->start_controls_tabs(
	'button_style_secondary_tabs'
);

$instance->start_controls_tab(
	'button_secondary_normal_tab',
	array(
		'label' => __( 'Normal', 'spacious' ),
	)
);

$instance->add_control(
	'secondary_button_text_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'secondary_button_background_color',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary' => 'background-color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'secondary_button_border',
		'selector'  => '{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary',
		'separator' => 'before',
	)
);

$instance->end_controls_tab();

$instance->start_controls_tab(
	'button_secondary_hover_tab',
	array(
		'label' => __( 'Hover', 'spacious' ),
	)
);

$instance->add_control(
	'secondary_button_text_color_hover',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary:hover' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'secondary_button_background_color_hover',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary:hover' => 'background-color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'secondary_button_border_hover',
		'selector'  => '{{WRAPPER}} .slider-inner-part .button-wrapper a.btn--secondary:hover',
		'separator' => 'before',
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->end_controls_section();

$instance->end_controls_section();
