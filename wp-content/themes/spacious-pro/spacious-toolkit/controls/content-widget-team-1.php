<?php
/**
 * Team 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-team-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_TEAM_1
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_TEAM_1
 */

use Elementor\SPT_TEAM_1;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use ELementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Group_Control_Box_Shadow;

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

// Member name
$instance->add_control(
	'member_name',
	array(
		'label'   => esc_html__( 'Name', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Member name', 'spacious' ),
	)
);

// Member designation
$instance->add_control(
	'member_designation',
	array(
		'label'   => esc_html__( 'Designation', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Member designation', 'spacious' ),
	)
);

// Member image
$instance->add_control(
	'member_image',
	array(
		'label'   => esc_html__( 'Choose Image', 'spacious' ),
		'type'    => Controls_Manager::MEDIA,
		'default' => array(
			'url' => Utils::get_placeholder_image_src(),
		),
	)
);

// Member description
$instance->add_control(
	'member_description',
	array(
		'label'   => esc_html__( 'Description', 'spacious' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Description of the member goes here.', 'spacious' ),
	)
);

// Member facebook
$instance->add_control(
	'member_facebook',
	array(
		'label'   => esc_html__( 'Facebook link', 'spacious' ),
		'type'    => Controls_Manager::URL,
		'default' => array(
			'url' => esc_url( 'http://facebook.com' ),
		),
	)
);

// Member twitter
$instance->add_control(
	'member_twitter',
	array(
		'label'   => esc_html__( 'Twitter link', 'spacious' ),
		'type'    => Controls_Manager::URL,
		'default' => array(
			'url' => esc_url( 'http://twitter.com' ),
		),
	)
);

// Member google plus
$instance->add_control(
	'member_google_plus',
	array(
		'label'   => esc_html__( 'Google Plus link', 'spacious' ),
		'type'    => Controls_Manager::URL,
		'default' => array(
			'url' => esc_url( 'http://plus.google.com' ),
		),
	)
);

// Member linkedin
$instance->add_control(
	'member_linkedin',
	array(
		'label'   => esc_html__( 'LinkedIn link', 'spacious' ),
		'type'    => Controls_Manager::URL,
		'default' => array(
			'url' => esc_url( 'http://linkedin.com' ),
		),
	)
);

$instance->end_controls_section();

// Team description.
$instance->start_controls_section(
	'section_team_content_style',
	array(
		'label' => __( 'Team Content', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'team_content_alignment',
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
	)
);

$instance->add_group_control(
	Group_Control_Background::get_type(),
	array(
		'name' => 'team_content_background',
		'label' => __( 'Background', 'spacious' ),
		'types' => array( 'classic', 'gradient' ),
		'selector' => '{{WRAPPER}} .team-member__info',
	)
);

$instance->add_responsive_control(
	'team_content_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'team_content_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Team Name.
$instance->start_controls_section(
	'section_team_name_style',
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
		'default'   => '#1e1e1f',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-member__title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'team_name_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .team-member__title',
	)
);

$instance->add_responsive_control(
	'team_name_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'team_name_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Team Designation.
$instance->start_controls_section(
	'section_team_designation_style',
	array(
		'label' => __( 'Designation', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'team_designation_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#67666a',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-member__position' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'team_designation_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .team-member__position',
	)
);

$instance->add_responsive_control(
	'team_designation_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'team_designation_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Team Description.
$instance->start_controls_section(
	'section_team_description_style',
	array(
		'label' => __( 'Description', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'team_description_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#67666a',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-member__description' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'team_description_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .team-member__description',
	)
);

$instance->add_responsive_control(
	'team_description_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'team_description_margin',
	array(
		'label' => __( 'Margin', 'spacious' ),
		'type' => \Elementor\Controls_Manager::DIMENSIONS,
		'size_units' => array( 'px', 'em', '%' ),
		'selectors' => array(
			'{{WRAPPER}} .team-member__description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		),
	)
);

$instance->end_controls_section();

// Team Social Links.
$instance->start_controls_section(
	'section_team_social_style',
	array(
		'label' => __( 'Social Links', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->start_controls_tabs(
			'style_tabs'
		);
$instance->start_controls_tab(
	'icon_normal_tab',
	array(
		'label' => __( 'Normal', 'spacious' ),
	)
);

$instance->add_control(
	'social_icon_color',
	array(
		'label'     => esc_html__( 'Primary', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#67666a',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .social-icons li a' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'social_icon_background_color',
	array(
		'label'     => esc_html__( 'Secondary', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .social-icons li a' => 'Background: {{VALUE}}',

		),
	)
);

$instance->end_controls_tab();

$instance->start_controls_tab(
	'icon_hover_tab',
	array(
		'label' => __( 'Hover', 'spacious' ),
	)
);

$instance->add_control(
	'social_icon_hover_color',
	array(
		'label'     => esc_html__( 'Primary', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#ffffff',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .social-icons li a:hover' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_control(
	'social_icon_background_hover_color',
	array(
		'label'     => esc_html__( 'Secondary', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .social-icons li a:hover' => 'Background: {{VALUE}}',

		),
	)
);

$instance->end_controls_tab();

$instance->end_controls_tabs();

$instance->add_responsive_control(
	'social_icon_size',
	array(
		'label' => __( 'Size', 'spacious' ),
		'type' => Controls_Manager::SLIDER,
		'size_units' => array( 'px', '%' ),
		'range' => array(
			'px' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'%' => array(
				'min' => 0,
				'max' => 100,
			),
		),
		'default' => array(
			'unit' => 'px',
			'size' => 16,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'social_icon_padding',
	array(
		'label' => __( 'Padding', 'spacious' ),
		'type' => Controls_Manager::SLIDER,
		'size_units' => array( 'px', '%' ),
		'range' => array(
			'px' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'%' => array(
				'min' => 0,
				'max' => 100,
			),
		),
		'default' => array(
			'unit' => 'px',
			'size' => 16,
		),
		'selectors' => array(
			'{{WRAPPER}} .team-social-icon' => 'padding: {{SIZE}}{{UNIT}};',
		),
	)
);

$instance->add_responsive_control(
	'social_icon_spacing',
	array(
		'label' => __( 'Spacing', 'spacious' ),
		'type' => Controls_Manager::SLIDER,
		'size_units' => array( 'px', '%' ),
		'range' => array(
			'px' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			'%' => array(
				'min' => 0,
				'max' => 100,
			),
		),
		'default' => array(
			'unit' => 'px',
			'size' => 16,
		),
		'selectors' => array(
			'{{WRAPPER}} .social-icons li'            => 'margin-right: {{SIZE}}{{UNIT}};',
			'{{WRAPPER}} .social-icons li:last-child' => 'margin-right: 0',
		),
	)
);

$instance->add_group_control(
	Group_Control_Box_Shadow::get_type(),
	array(
		'name' => 'social_icon_box_shadow',
		'label' => __( 'Box Shadow', 'spacious' ),
		'selector' => '{{WRAPPER}} .social-icons li a',
	)
);

$instance->end_controls_section();
