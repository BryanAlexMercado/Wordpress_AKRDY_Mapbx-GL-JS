<?php
/**
 * Testimonial 1 Widget controls
 *
 * This template can be overridden by copying it to
 * yourtheme/spacious-toolkit/controls/content-widget-testimonial-1.php.
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

use Elementor\SPT_TESTIMONIAL_1;
use Elementor\Controls_Manager;
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
	'section_testimonial_title',
	array(
		'label' => esc_html__( 'Testimonial', 'spacious' ),
	)
);

// Author
$instance->add_control(
	'author',
	array(
		'label'   => esc_html__( 'Author', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Author name', 'spacious' ),
	)
);

// Designation
$instance->add_control(
	'designation',
	array(
		'label'   => esc_html__( 'Designation', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Author designation', 'spacious' ),
	)
);

// Company
$instance->add_control(
	'company',
	array(
		'label'   => esc_html__( 'Company', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Company name', 'spacious' ),
	)
);

// Words
$instance->add_control(
	'words',
	array(
		'label'   => esc_html__( 'Words', 'spacious' ),
		'type'    => Controls_Manager::TEXTAREA,
		'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in nisl et metus dignissim interdum. Nunc tristique ullamcorper lectus nec tempus.', 'spacious' ),
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_testimonial_style',
	array(
		'label' => __( 'Author', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'testimonial_author_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#424143',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .testimonial .testimonial__author' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'Author_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .testimonial .testimonial__author',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'testimonial_author_designation_color',
	array(
		'label' => __( 'Designation', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'testimonial_designation_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#807f83',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .testimonial .testimonial__position' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'designation_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .testimonial .testimonial__position',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'testimonial_author_company_color',
	array(
		'label' => __( 'Company', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'testimonial_company_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#807f83',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .testimonial .testimonial__company' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'company_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .testimonial .testimonial__company',
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'testimonial_words_color',
	array(
		'label' => __( 'Words', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'testimonial_author_words_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#807f83',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .testimonial .testimonial__sayings' => 'color: {{VALUE}}',

		),
	)
);

$instance->add_group_control(
	Group_Control_Typography::get_type(),
	array(
		'name'     => 'words_typography',
		'label'    => __( 'Typography', 'spacious' ),
		'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
		'selector' => '{{WRAPPER}} .testimonial .testimonial__sayings',
		'fields_options' => array(
			'font_weight' => array(
				'default' => '400',
			),
		),
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'testimonial_border_color',
	array(
		'label' => __( 'Border Bottom', 'spacious' ),
		'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
	)
);

$instance->add_control(
	'testimonial_border_bottom_color',
	array(
		'label'     => esc_html__( 'Color', 'spacious' ),
		'type'      => Controls_Manager::COLOR,
		'default'   => '#78b865',
		'scheme'    => array(
			'type'  => Scheme_Color::get_type(),
			'value' => Scheme_Color::COLOR_1,
		),
		'selectors' => array(
			'{{WRAPPER}} .testimonial' => 'border-bottom-color: {{VALUE}}',

		),
	)
);

$instance->end_controls_section();
