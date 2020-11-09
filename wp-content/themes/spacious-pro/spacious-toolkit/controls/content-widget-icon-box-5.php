<?php
/**
 * Icon box 5 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-icon-box-5.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_ICON_BOX_5
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_ICON_BOX_5
 */

use Elementor\SPT_ICON_BOX_5;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use ELementor\Group_Control_Typography;
use ELementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

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

// Caption
$instance->add_control(
	'caption',
	array(
		'label'   => esc_html__( 'Caption', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Caption', 'spacious' ),
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Title', 'spacious' ),
	)
);

// Content
$instance->add_control(
	'content',
	array(
		'label'   => esc_html__( 'Content', 'spacious' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Content', 'spacious' ),
	)
);

// Button Text
$instance->add_control(
	'button_text',
	array(
		'label'   => esc_html__( 'Button Text', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Click here', 'spacious' ),
	)
);

// Button Link
$instance->add_control(
	'button_link',
	array(
		'label'       => esc_html__( 'Button Link', 'spacious' ),
		'type'        => Controls_Manager::URL,
		'placeholder' => esc_url( 'http://site-link.com' ),
	)
);

$instance->end_controls_section();

// Icon Box Style.
$instance->start_controls_section(
	'section_icon_box_style',
	array(
		'label' => __( 'Icon Box Style', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'icon_box_alignment',
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
		'default' => 'center',
		'condition' => array(
					'icon_position' => 'above',
		),
	)
);

$instance->add_group_control(
	Group_Control_Background::get_type(),
	array(
		'name' => 'icon_box_background',
		'label' => __( 'Background', 'spacious' ),
		'types' => array( 'classic', 'gradient' ),
		'selector' => '{{WRAPPER}} .icon-box.icon-box-style-five',
	)
);

$instance->add_responsive_control(
	'icon_box_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box.icon-box-style-five' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'icon_box_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box.icon-box-style-five' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name' => 'border',
		'label' => __( 'Border', 'spacious' ),
		'selector' => '{{WRAPPER}} .icon-box.icon-box-style-five',
	)
);

$instance->add_group_control(
	Group_Control_Box_Shadow::get_type(),
	array(
		'name' => 'icon_box_shadow',
		'label' => __( 'Box Shadow', 'spacious' ),
		'selector' => '{{WRAPPER}} .icon-box.icon-box-style-five',
	)
);

$instance->end_controls_section();

//Icon Style.
$instance->start_controls_section(
	'section_icon_style',
	array(
		'label' => __( 'Icon', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'Icon_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-icon i' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'icon_position',
	array(
		'label'   => esc_html__( 'Position', 'spacious' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'above',
		'options' => array(
			'above'   => esc_html__( 'Above', 'spacious' ),
			'left'   => esc_html__( 'Left', 'spacious' ),
			'right'   => esc_html__( 'Right', 'spacious' ),
		),
	)
);

$instance->add_responsive_control(
	'icon_size',
	[
		'label' => __( 'Size', 'spacious' ),
		'type' => Controls_Manager::SLIDER,
		'size_units' => [ 'px', '%' ],
		'range' => [
			'px' => [
				'min' => 0,
				'max' => 100,
				'step' => 1,
			],
			'%' => [
				'min' => 0,
				'max' => 100,
			],
		],
		'default' => [
			'unit' => 'px',
			'size' => 50,
		],
		'selectors' => [
			'{{WRAPPER}} .icon-box-style-five .icon-box-icon i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
		],
	]
);


$instance->add_group_control(
	Group_Control_Background::get_type(),
	array(
		'name' => 'icon_background',
		'label' => __( 'Background', 'spacious' ),
		'types' => array( 'classic', 'gradient' ),
		'selector' => '{{WRAPPER}} .icon-box-style-five:not(.spacious-icon-align-above) .icon-box-icon, {{WRAPPER}} .icon-box-style-five.spacious-icon-align-above .icon-box-icon i',
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name' => 'icon_border',
		'label' => __( 'Border', 'spacious' ),
		'selector' => '{{WRAPPER}} .icon-box-style-five:not(.spacious-icon-align-above) .icon-box-icon, {{WRAPPER}} .icon-box-style-five.spacious-icon-align-above .icon-box-icon i',
	)
);

$instance->add_responsive_control(
	'icon_border_radius',
	array(
		'label' => __( 'Border Radius', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five:not(.spacious-icon-align-above) .icon-box-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			'{{WRAPPER}} .icon-box-style-five.spacious-icon-align-above .icon-box-icon i' =>'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'icon_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five:not(.spacious-icon-align-above) .icon-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			'{{WRAPPER}} .icon-box-style-five.spacious-icon-align-above .icon-box-icon i' =>'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'icon_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
		),
	)
);

$instance->add_group_control(
	Group_Control_Box_Shadow::get_type(),
	array(
		'name' => 'icon_shadow',
		'label' => __( 'Box Shadow', 'spacious' ),
		'selector' => '{{WRAPPER}} .icon-box-style-five:not(.spacious-icon-align-above) .icon-box-icon , {{WRAPPER}} .icon-box-style-five.spacious-icon-align-above .icon-box-icon i',
	)
);

$instance->end_controls_section();

// Caption style.
$instance->start_controls_section(
	'section_caption_style',
	array(
		'label' => __( 'Caption', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'caption_tag',
	array(
		'label'   => esc_html__( 'HTML Tag', 'spacious' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'span',
		'options' => array(
			'h1'   => esc_html__( 'H1', 'spacious' ),
			'h2'   => esc_html__( 'H2', 'spacious' ),
			'h3'   => esc_html__( 'H3', 'spacious' ),
			'h4'   => esc_html__( 'H4', 'spacious' ),
			'h5'   => esc_html__( 'H5', 'spacious' ),
			'h6'   => esc_html__( 'H6', 'spacious' ),
			'div'  => esc_html__( 'div', 'spacious' ),
			'span' => esc_html__( 'span', 'spacious' ),
			'p'    => esc_html__( 'p', 'spacious' ),
		),
	)
);

$instance->add_control(
	'caption_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-caption' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'caption_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .icon-box-style-five .icon-box-caption',
	)
);

$instance->add_group_control(
	Group_Control_Background::get_type(),
	array(
		'name' => 'caption_background',
		'label' => __( 'Background', 'spacious' ),
		'types' => array( 'classic', 'gradient' ),
		'selector' => '{{WRAPPER}} .icon-box-style-five .icon-box-caption',
	)
);

$instance->add_responsive_control(
	'caption_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-details .icon-box-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'caption_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Title Style.
$instance->start_controls_section(
	'section_title_style',
	array(
		'label' => __( 'Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'title_tag',
	array(
		'label'   => esc_html__( 'HTML Tag', 'spacious' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'h2',
		'options' => array(
			'h1'   => esc_html__( 'H1', 'spacious' ),
			'h2'   => esc_html__( 'H2', 'spacious' ),
			'h3'   => esc_html__( 'H3', 'spacious' ),
			'h4'   => esc_html__( 'H4', 'spacious' ),
			'h5'   => esc_html__( 'H5', 'spacious' ),
			'h6'   => esc_html__( 'H6', 'spacious' ),
			'div'  => esc_html__( 'div', 'spacious' ),
			'span' => esc_html__( 'span', 'spacious' ),
			'p'    => esc_html__( 'p', 'spacious' ),
		),
	)
);

$instance->add_control(
	'title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#222222',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .icon-box-style-five .icon-box-title',
	)
);

$instance->add_group_control(
	Group_Control_Background::get_type(),
	array(
		'name' => 'title_background',
		'label' => __( 'Background', 'spacious' ),
		'types' => array( 'classic', 'gradient' ),
		'selector' => '{{WRAPPER}} .icon-box-style-five .icon-box-title',
	)
);

$instance->add_responsive_control(
	'title_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'title_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Content Style.
$instance->start_controls_section(
	'section_content_style',
	array(
		'label' => __( 'Content', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'content_tag',
	array(
		'label'   => esc_html__( 'HTML Tag', 'spacious' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'p',
		'options' => array(
			'h1'   => esc_html__( 'H1', 'spacious' ),
			'h2'   => esc_html__( 'H2', 'spacious' ),
			'h3'   => esc_html__( 'H3', 'spacious' ),
			'h4'   => esc_html__( 'H4', 'spacious' ),
			'h5'   => esc_html__( 'H5', 'spacious' ),
			'h6'   => esc_html__( 'H6', 'spacious' ),
			'div'  => esc_html__( 'div', 'spacious' ),
			'span' => esc_html__( 'span', 'spacious' ),
			'p'    => esc_html__( 'p', 'spacious' ),
		),
	)
);

$instance->add_control(
	'content_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-content' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'content_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .icon-box-content',
	)
);

$instance->add_group_control(
	Group_Control_Background::get_type(),
	array(
		'name' => 'content_background',
		'label' => __( 'Background', 'spacious' ),
		'types' => array( 'classic', 'gradient' ),
		'selector' => '{{WRAPPER}} .icon-box-content',
	)
);

$instance->add_responsive_control(
	'content_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'content_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Button
$instance->start_controls_section(
	'section_icon_style_5_primary_button',
	array(
		'label' => __( 'Button', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_responsive_control(
	'button_padding',
	array(
		'label'      => __( 'Padding', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .icon-box-five-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'button_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .icon-box-style-five .icon-box-five-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);


$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'button_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .icon-box-five-btn a',
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
			'{{WRAPPER}} .icon-box-five-btn a' => 'color: {{VALUE}}',
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
			'{{WRAPPER}} .icon-box-five-btn a' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'button_border',
		'selector'  => '{{WRAPPER}} .icon-box-five-btn a',
		'separator' => 'before',
	)
);

$instance->add_responsive_control(
	'button_radius',
	array(
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .icon-box-five-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'{{WRAPPER}} .icon-box-five-btn a:hover' => 'color: {{VALUE}}',
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
			'{{WRAPPER}} .icon-box-five-btn a:hover' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'button_border_hover',
		'selector'  => '{{WRAPPER}} .icon-box-five-btn a:hover',
		'separator' => 'before',
	)
);

$instance->add_responsive_control(
	'button_hover_radius',
	array(
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .icon-box-five-btn a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->end_controls_section();
