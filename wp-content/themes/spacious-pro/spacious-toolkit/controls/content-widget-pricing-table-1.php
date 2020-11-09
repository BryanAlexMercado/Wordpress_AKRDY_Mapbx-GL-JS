<?php
/**
 * Pricing Table 1 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-pricing-table-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_PRICING_TABLE_1
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_PRICING_TABLE_1
 */

use Elementor\SPT_PRICING_TABLE_1;
use Elementor\Controls_Manager;

// Exit if it is accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Widget title section
$instance->start_controls_section(
	'section_pricing_table_title',
	array(
		'label' => esc_html__( 'Pricing Table', 'spacious' ),
	)
);

// Title
$instance->add_control(
	'title',
	array(
		'label'   => esc_html__( 'Title', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Basic', 'spacious' ),
	)
);

// Currency
$instance->add_control(
	'currency',
	array(
		'label'   => esc_html__( 'Currency', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( '$', 'spacious' ),
	)
);

// Price
$instance->add_control(
	'price',
	array(
		'label'   => esc_html__( 'Price', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( '500', 'spacious' ),
	)
);

// Pricing duration
$instance->add_control(
	'pricing_duration',
	array(
		'label'   => esc_html__( 'Pricing duration', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Month', 'spacious' ),
	)
);

// Feature heading
$instance->add_control(
	'feature_heading',
	array(
		'label'   => esc_html__( 'Feature heading', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Details', 'spacious' ),
	)
);

// Features list
$instance->add_control(
	'features_list',
	array(
		'label'       => esc_html__( 'Features List', 'spacious' ),
		'type'        => Controls_Manager::REPEATER,
		'default'     => array(
			array(
				'feature_title' => esc_html__( 'Feature #1', 'spacious' ),
				'feature_title' => esc_html__( 'Feature #1', 'spacious' ),
			)
		),
		'fields'      => array(
			array(
				'name'        => 'feature_title',
				'label'       => esc_html__( 'Title', 'spacious' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		),
		'title_field' => '{{{ feature_title }}}',
	)
);

// Button text
$instance->add_control(
	'button_text',
	array(
		'label'   => esc_html__( 'Button text', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => esc_html__( 'Buy Now', 'spacious' ),
	)
);

// Button link
$instance->add_control(
	'button_link',
	array(
		'label'       => esc_html__( 'Button link', 'spacious' ),
		'type'        => Controls_Manager::URL,
		'placeholder' => esc_url( 'http://site-link.com' ),
	)
);

$instance->end_controls_section();