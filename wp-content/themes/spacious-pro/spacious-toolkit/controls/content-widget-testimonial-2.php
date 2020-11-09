<?php
/**
 * Testimonial 2 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-testimonial-2.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_TESTIMONIAL_2
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_TESTIMONIAL_2
 */

use Elementor\SPT_TESTIMONIAL_2;
use Elementor\Controls_Manager;
use Elementor\Utils;

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

// image
$instance->add_control(
	'image',
	array(
		'label'   => esc_html__( 'Choose Image', 'spacious' ),
		'type'    => Controls_Manager::MEDIA,
		'default' => array(
			'url' => Utils::get_placeholder_image_src(),
		),
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
