<?php
/**
 * CTA 3 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-cta-3.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_CTA_3
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_CTA_3
 */

use Elementor\SPT_CTA_3;
use Elementor\Scheme_Color;
use Elementor\Controls_Manager;
use ELementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use ELementor\Group_Control_Border;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_cta_title',
	array(
		'label' => esc_html__( 'Call to Action', 'spacious' ),
	)
);

// Before Title.
$instance->add_control(
	'before_title',
	array(
		'label'   => esc_html__( 'Before Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => '',
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Call to Action title', 'spacious' ),
	)
);

// After Title.
$instance->add_control(
	'after_title',
	array(
		'label'   => esc_html__( 'After Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => '',
	)
);

// Content
$instance->add_control(
	'content',
	array(
		'label'   => esc_html__( 'Content', 'spacious' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Content goes here.', 'spacious' ),
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

// Button Text 2
$instance->add_control(
	'button_text2',
	array(
		'label'   => esc_html__( 'Button Text 2', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => '',
	)
);

// Button Link 2
$instance->add_control(
	'button_link2',
	array(
		'label'       => esc_html__( 'Button Link 2', 'spacious' ),
		'type'        => Controls_Manager::URL,
		'placeholder' => esc_url( 'http://site-link.com' ),
	)
);

$instance->end_controls_section();

// Alignment.
$instance->start_controls_section(
	'section_cta_alignment',
	array(
		'label' => __( 'Alignment', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'call_to_cation_alignment',
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

// Before title style.
$instance->start_controls_section(
	'section_before_title_style',
	array(
		'label' => __( 'Before Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'before_title_tag',
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
	'cta_before_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__before-title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'cta_before_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .call-to-action__before-title',
	)
);

$instance->add_responsive_control(
	'cta_before_title_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__before-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'cta_before_title_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__before-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

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
		'default' => 'h3',
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
	'cta_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#222222',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'cta_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .call-to-action__title',
	)
);

$instance->add_responsive_control(
	'cta_title_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'cta_title_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_after_title_style',
	array(
		'label' => __( 'After Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'after_title_tag',
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
	'cta_after_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__after-title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'cta_after_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .call-to-action__after-title',
	)
);

$instance->add_responsive_control(
	'cta_after_title_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__after-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'cta_after_title_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__after-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Content
$instance->start_controls_section(
	'section_content_style',
	array(
		'label' => __( 'Content', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'cta_content_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__content p' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'cta_content_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .call-to-action__content p',
	)
);
$instance->add_responsive_control(
	'cta_content_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'cta_content_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action__content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Button
$instance->start_controls_section(
	'section_icon_style_5_primary_button',
	array(
		'label' => __( 'Primary Button', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_responsive_control(
	'primary_button_padding',
	array(
		'label'      => __( 'Padding', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .call-to-action.cta-style-three .btn--black' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'primary_button_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .call-to-action.cta-style-three .btn--black' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);


$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'primary_button_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .cta-style-three .btn--black',
	)
);

$instance->start_controls_tabs(
	'primary_button_style_tabs'
);

$instance->start_controls_tab(
	'primary_button_normal_tab',
	array(
		'label' => __( 'Normal', 'spacious' ),
	)
);

$instance->add_control(
	'primary_button_text_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three .btn--black' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_control(
	'primary_button_background_color',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#1e1e1f',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three .btn--black' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'primary_button_border',
		'selector'  => '{{WRAPPER}} .cta-style-three .btn--black',
		'separator' => 'before',
	)
);

$instance->add_responsive_control(
	'primary_button_radius',
	array(
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .cta-style-three .btn--black' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_tab();

// For button hover.
$instance->start_controls_tab(
	'primary_button_hover_tab',
	array(
		'label' => __( 'Hover', 'spacious' ),
	)
);

$instance->add_control(
	'primary_button_text_color_hover',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#1e1e1f',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three .btn--black:hover' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_control(
	'primary_button_background_color_hover',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three .btn--black:hover' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'primary_button_border_hover',
		'selector'  => '{{WRAPPER}} .cta-style-three .btn--black:hover',
		'separator' => 'before',
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->end_controls_section();

// Secondary Button.
$instance->start_controls_section(
	'section_icon_style_5_secondary_button',
	array(
		'label' => __( 'secondary Button', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_responsive_control(
	'secondary_button_padding',
	array(
		'label'      => __( 'Padding', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .cta-style-three a.btn--ghost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'secondary_button_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three a.btn--ghost' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);


$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'secondary_button_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .cta-style-three a.btn--ghost',
	)
);

$instance->start_controls_tabs(
	'secondary_button_style_tabs'
);

$instance->start_controls_tab(
	'secondary_button_normal_tab',
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
			'{{WRAPPER}} .cta-style-three a.btn--ghost' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_control(
	'secondary_button_background_color',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#1e1e1f',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three a.btn--ghost' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'secondary_button_border',
		'selector'  => '{{WRAPPER}} .cta-style-three a.btn--ghost',
		'separator' => 'before',
	)
);

$instance->add_responsive_control(
	'Secondary_button_radius',
	array(
		'label'      => __( 'Border Radius', 'spacious' ),
		'type'       => Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', '%', 'em' ),
		'selectors'  => array(
			'{{WRAPPER}} .cta-style-three a.btn--ghost' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_tab();

// For button hover.
$instance->start_controls_tab(
	'secondary_button_hover_tab',
	array(
		'label' => __( 'Hover', 'spacious' ),
	)
);

$instance->add_control(
	'secondary_button_text_color_hover',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#1e1e1f',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three a.btn--ghost:hover' => 'color: {{VALUE}}',
		),
	)
);

$instance->add_control(
	'secondary_button_background_color_hover',
	array(
		'label'     => esc_html__( 'Background', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .cta-style-three a.btn--ghost:hover' => 'background-color: {{VALUE}}',
		),
	)
);

$instance->add_group_control(
	Group_Control_Border::get_type(),
	array(
		'name'      => 'secondary_button_border_hover',
		'selector'  => '{{WRAPPER}} .cta-style-three a.btn--ghost:hover',
		'separator' => 'before',
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->end_controls_section();
