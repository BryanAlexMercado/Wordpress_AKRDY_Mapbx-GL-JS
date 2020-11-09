<?php
/**
 * Block Post 2 Widget controls
 *
 * This template can be overridden by copying it to
 * yourtheme/spacious-toolkit/controls/content-widget-block-widget-2.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_BLOCK_2
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_BLOCK_2
 */

use Elementor\SPT_BLOCK_2;
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

/**
 * Widget title section
 */
$instance->start_controls_section(
	'section_block_2_title',
	array(
		'label' => esc_html__( 'Block Title', 'spacious' ),
	)
);

// Icon
$instance->add_control(
	'widget_title',
	array(
		'label'   => esc_html__( 'Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Block posts 2' ),
	)
);
$instance->end_controls_section();

/**
 * Widget posts section
 */
$instance->start_controls_section(
	'section_block_2_posts',
	array(
		'label' => esc_html__( 'Posts', 'spacious' ),
	)
);

// Number of posts
$instance->add_control(
	'posts_number',
	array(
		'label'   => esc_html__( 'Number of posts:', 'spacious' ),
		'type'    => Controls_Manager::NUMBER,
		'default' => 3,
		'min'     => 0,
	)
);

// Offset Posts
$instance->add_control(
	'offset_posts_number',
	array(
		'label' => esc_html__( 'Offset Posts:', 'spacious' ),
		'type'  => Controls_Manager::NUMBER,
		'min'   => 0,
	)
);
$instance->end_controls_section();


/**
 * Widget posts filter section.
 */
$instance->start_controls_section(
	'section_block_2_filter',
	array(
		'label' => esc_html__( 'Filter', 'spacious-toolkit' ),
	)
);

$instance->add_control(
	'display_option',
	array(
		'label'   => esc_html__( 'Display the posts from:', 'spacious-toolkit' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'latest',
		'options' => array(
			'latest'     => esc_html__( 'Latest Posts', 'spacious-toolkit' ),
			'categories' => esc_html__( 'Categories', 'spacious-toolkit' ),
		),
	)
);

$instance->add_control(
	'categories_selected',
	array(
		'label'     => esc_html__( 'Select categories:', 'spacious-toolkit' ),
		'type'      => Controls_Manager::SELECT,
		'options'   => spacious_toolkit_elementor_categories(),
		'condition' => array(
			'display_option' => 'categories',
		),
	)
);

$instance->end_controls_section();

// Slider Control section
$instance->start_controls_section(
	'section_block_2_slider_controls',
	array(
		'label' => esc_html__( 'Slider Controls', 'spacious' ),
	)
);

//Slider controls.
$instance->add_control(
	'post_slider_autoplay',
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
	'post_slider_delay',
	array(
		'label'     => __( 'Delay', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 3000,
		'condition' => array(
			'post_slider_autoplay' => 'yes',
		),
	)
);

$instance->add_control(
	'post_slider_speed',
	array(
		'label'     => __( 'Speed', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 1000,
		'condition' => array(
			'post_slider_autoplay' => 'yes',
		),
	)
);

$instance->add_control(
	'slider_per_view',
	[
		'label'   => __( 'Slides to show', 'spacious' ),
		'type'    => \Elementor\Controls_Manager::SELECT,
		'default' => '3',
		'options' => [
			'1' => __( '1', 'spacious' ),
			'2' => __( '2', 'spacious' ),
			'3' => __( '3', 'spacious' ),
			'4' => __( '4', 'spacious' ),
		],
	]
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_block_2_title_style',
	array(
		'label' => __( 'Widget Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'widget_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#222222',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .main-block-wrapper h4.block-title' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'widget_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .main-block-wrapper h4.block-title',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_block_2_post_title_style',
	array(
		'label' => __( 'Post Title', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'post_title_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#222222',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} h3.tg-block-title.entry-title a' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'post_title_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} h3.tg-block-title.entry-title a',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_block_2_post_meta_style',
	array(
		'label' => __( 'Post Meta', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'post_meta_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#424143',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .entry-meta span a' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'post_meta_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .entry-meta span a',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_block_2_post_content_style',
	array(
		'label' => __( 'Post Content', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'post_content_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#666666',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .entry-content p' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'post_content_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .entry-content p',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_block_2_read_more_style',
	array(
		'label' => __( 'Read More', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'read_more_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#67666a',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .read-more' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'read_more_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .read-more',
	)
);

$instance->end_controls_section();
