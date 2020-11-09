<?php
/**
 * Product Carousel 1 Widget controls
 *
 * This template can be overridden by copying it to
 * yourtheme/spacious-toolkit/controls/content-widget-product-carousel-1.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_PRODUCT_CAROUSEL_1
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_PRODUCT_CAROUSEL_1
 */

use Elementor\SPT_PRODUCT_CAUROSEL_1;
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
	'section_product',
	array(
		'label' => esc_html__( 'Product', 'spacious' ),
	)
);

$instance->add_control(
	'products_number',
	array(
		'label'   => esc_html__( 'Number of products to display:', 'spacious' ),
		'type'    => Controls_Manager::TEXT,
		'default' => 3,
	)
);

$instance->add_control(
	'offset_products_number',
	array(
		'label' => esc_html__( 'Offset Products:', 'spacious' ),
		'type'  => Controls_Manager::TEXT,
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_spacious_featured_posts_block_2_filter_manage',
	array(
		'label' => esc_html__( 'Filter', 'spacious' ),
	)
);

$instance->add_control(
	'display_type',
	array(
		'label'   => esc_html__( 'Display the products from:', 'spacious' ),
		'type'    => Controls_Manager::SELECT,
		'default' => 'latest',
		'options' => array(
			'latest'     => esc_html__( 'Latest Products', 'spacious' ),
			'categories' => esc_html__( 'Categories', 'spacious' ),
		),
	)
);

$instance->add_control(
	'categories_selected',
	array(
		'label'     => esc_html__( 'Select categories:', 'spacious' ),
		'type'      => Controls_Manager::SELECT2,
		'multiple'  => 1,
		'options'   => Spacious_Elementor_Addons::spacious_woocommerce_category(),
		'condition' => array(
			'display_type' => 'categories',
		),
	)
);

$instance->end_controls_section();

$instance->start_controls_section(
	'section_product_slider',
	array(
		'label' => esc_html__( 'Slider Controls', 'spacious' ),
	)
);

//Slider controls.
$instance->add_control(
	'product_slider_autoplay',
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
	'product_slider_delay',
	array(
		'label'     => __( 'Delay', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 4000,
		'condition' => array(
			'product_slider_autoplay' => 'yes',
		),
	)
);

$instance->add_control(
	'product_slider_speed',
	array(
		'label'     => __( 'Speed', 'spacious' ),
		'type'      => \Elementor\Controls_Manager::NUMBER,
		'min'       => 100,
		'max'       => 100000,
		'step'      => 100,
		'default'   => 1000,
		'condition' => array(
			'product_slider_autoplay' => 'yes',
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
			'5' => __( '5', 'spacious' ),
			'6' => __( '6', 'spacious' ),
		],
	]
);

$instance->end_controls_section();
