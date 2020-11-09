<?php
/**
 * Team 3 Widget controls
 *
 * This template can be overridden by copying it to yourtheme/spacious-toolkit/controls/content-widget-team-3.php.
 *
 * HOWEVER, on occasion Spacious Toolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      http://docs.themegrill.com/spacious-toolkit/template-structure/
 * @extends  SPT_TEAM_3
 * @extends  Scheme_Color
 * @version  1.0.0
 * @package  Spacious_Toolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 *
 * @var $instance SPT_TEAM_3
 */

use Elementor\SPT_TEAM_3;
use Elementor\Controls_Manager;
use Elementor\Utils;

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