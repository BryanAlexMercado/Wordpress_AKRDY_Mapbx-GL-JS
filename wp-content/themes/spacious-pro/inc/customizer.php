<?php
/**
 * Spacious Pro Theme Customizer
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.2.1
 */
function spacious_customize_register( $wp_customize ) {

	// Include control classes.
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-editor-custom-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-additional-social-icons-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-image-radio-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-important-links.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-text-area-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-typography-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-color-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-heading-control.php';
	require_once SPACIOUS_INCLUDES_DIR . '/customizer/class-spacious-divider-control.php';

	$wp_customize->register_control_type( 'Spacious_Color_Control' );
	$wp_customize->register_control_type( 'Spacious_Heading_Control' );
	$wp_customize->register_control_type( 'Spacious_Divider_Control' );

	// Transport postMessage variable set.
	$customizer_selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '#site-title a',
				'render_callback' => 'spacious_customize_partial_blogname',
			)
		);

		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '#site-description',
				'render_callback' => 'spacious_customize_partial_blogdescription',
			)
		);
	}

	// Theme important links started.
	$wp_customize->add_section(
		'spacious_important_links',
		array(
			'priority' => 700,
			'title'    => esc_html__( 'Spacious Pro', 'spacious' ),
		)
	);

	/**
	 * This setting has the dummy Sanitization function as it contains no value to be sanitized.
	 */
	$wp_customize->add_setting(
		'spacious_important_links',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_links_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Important_Links(
			$wp_customize,
			'important_links',
			array(
				'section'  => 'spacious_important_links',
				'settings' => 'spacious_important_links',
			)
		)
	);

	// Theme Important Links Ended.
	/****************************************Start of the Global Options****************************************/
	$wp_customize->add_panel(
		'spacious_global_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 50,
			'title'      => esc_html__( 'Global', 'spacious' ),
		)
	);

	// Site primary color option
	$wp_customize->add_section(
		'spacious_global_color_setting',
		array(
			'panel'    => 'spacious_global_options',
			'priority' => 7,
			'title'    => esc_html__( 'Colors', 'spacious' ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_primary_color]',
		array(
			'default'              => '#0FBE7C',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_primary_color]',
			array(
				'label'    => esc_html__( 'Primary Color', 'spacious' ),
				'section'  => 'spacious_global_color_setting',
				'settings' => 'spacious[spacious_primary_color]',
			)
		)
	);

	// Base Color option.
	$wp_customize->add_setting(
		'spacious[spacious_content_text_color]',
		array(
			'default'              => '#666666',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_content_text_color]',
			array(
				'label'    => esc_html__( 'Base Color', 'spacious' ),
				'section'  => 'spacious_global_color_setting',
				'settings' => 'spacious[spacious_content_text_color]',
			)
		)
	);

	// Site dark light skin option.
	$wp_customize->add_setting(
		'spacious[spacious_color_skin]',
		array(
			'default'           => 'light',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_color_skin]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Color Skin', 'spacious' ),
				'section'  => 'spacious_global_color_setting',
				'settings' => 'spacious[spacious_color_skin]',
				'choices'  => array(
					'light' => SPACIOUS_ADMIN_IMAGES_URL . '/light-color.jpg',
					'dark'  => SPACIOUS_ADMIN_IMAGES_URL . '/dark-color.jpg',
				),
			)
		)
	);

	// Global typography options.
	$wp_customize->add_section(
		'spacious_global_typography_section',
		array(
			'panel'    => 'spacious_global_options',
			'priority' => 7,
			'title'    => esc_html__( 'Typography', 'spacious' ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_content_font]',
		array(
			'default'           => 'Lato',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_font_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Typography_Control(
			$wp_customize,
			'spacious[spacious_content_font]',
			array(
				'priority' => 8,
				'label'    => esc_html__( 'Body', 'spacious' ),
				'section'  => 'spacious_global_typography_section',
				'settings' => 'spacious[spacious_content_font]',
			)
		)
	);

	// Heading Typography option.
	$wp_customize->add_setting(
		'spacious[spacious_titles_font]',
		array(
			'default'           => 'Lato',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_font_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Typography_Control(
			$wp_customize,
			'spacious[spacious_titles_font]',
			array(
				'priority' => 8,
				'label'    => esc_html__( 'Headings', 'spacious' ),
				'section'  => 'spacious_global_typography_section',
				'settings' => 'spacious[spacious_titles_font]',
			)
		)
	);

	// Global Background options.
	$wp_customize->add_section(
		'spacious_global_background_section',
		array(
			'panel'    => 'spacious_global_options',
			'priority' => 7,
			'title'    => esc_html__( 'Background', 'spacious' ),
		)
	);

	$wp_customize->add_setting(
		'spacious[global_background_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'global_background_heading',
			array(
				'label'    => esc_html__( 'Outside Container', 'spacious' ),
				'section'  => 'spacious_global_background_section',
				'settings' => 'spacious[global_background_heading]',
				'priority' => 10,
			)
		)
	);

	$wp_customize->get_control( 'background_color' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_color' )->priority = 20;

	$wp_customize->get_control( 'background_image' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_image' )->priority = 20;

	$wp_customize->get_control( 'background_preset' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_preset' )->priority = 20;

	$wp_customize->get_control( 'background_position' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_position' )->priority = 20;

	$wp_customize->get_control( 'background_size' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_size' )->priority = 20;

	$wp_customize->get_control( 'background_repeat' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_repeat' )->priority = 20;

	$wp_customize->get_control( 'background_attachment' )->section  = 'spacious_global_background_section';
	$wp_customize->get_control( 'background_attachment' )->priority = 20;

	// Start of the WordPress default options.
	// Background image clickable.
	$wp_customize->add_setting(
		'spacious[spacious_background_image_link]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_background_image_link]',
		array(
			'priority'        => 20,
			'label'           => esc_html__( 'Add the background link url.', 'spacious' ),
			'section'         => 'spacious_global_background_section',
			'setting'         => 'spacious[spacious_background_image_link]',
			'active_callback' => 'spacious_background_image',
		)
	);
	// End of the WordPress default options.

	$wp_customize->add_setting(
		'spacious[global_content_background_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'global_content_background_heading',
			array(
				'label'    => esc_html__( 'Content Area', 'spacious' ),
				'section'  => 'spacious_global_background_section',
				'settings' => 'spacious[global_content_background_heading]',
				'priority' => 25,
			)
		)
	);

	// Content background color option.
	$wp_customize->add_setting(
		'spacious[spacious_content_background_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_content_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Content part background color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_global_background_section',
				'settings' => 'spacious[spacious_content_background_color]',
			)
		)
	);

	// Layout option.
	$wp_customize->add_section(
		'spacious_global_layout_section',
		array(
			'panel'    => 'spacious_global_options',
			'priority' => 7,
			'title'    => esc_html__( 'Layout', 'spacious' ),
		)
	);

	// Site layout heading
	$wp_customize->add_setting(
		'spacious[global_site_layout_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'global_site_layout_heading',
			array(
				'label'    => esc_html__( 'Site Layout', 'spacious' ),
				'section'  => 'spacious_global_layout_section',
				'settings' => 'spacious[global_site_layout_heading]',
			)
		)
	);

	// site layout option.
	$wp_customize->add_setting(
		'spacious[spacious_site_layout]',
		array(
			'default'           => 'box_1218px',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_site_layout]',
		array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Choose your site layout. The change is reflected in whole site.', 'spacious' ),
			'choices'  => array(
				'box_1218px'  => esc_html__( 'Boxed layout with content width of 1218px', 'spacious' ),
				'box_978px'   => esc_html__( 'Boxed layout with content width of 978px', 'spacious' ),
				'wide_1218px' => esc_html__( 'Wide layout with content width of 1218px', 'spacious' ),
				'wide_978px'  => esc_html__( 'Wide layout with content width of 978px', 'spacious' ),
			),
			'section'  => 'spacious_global_layout_section',
			'settings' => 'spacious[spacious_site_layout]',
		)
	);

	// Site layout heading
	$wp_customize->add_setting(
		'spacious[global_sidebar_layout_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'global_sidebar_layout_heading',
			array(
				'label'    => esc_html__( 'Sidebar Layout', 'spacious' ),
				'section'  => 'spacious_global_layout_section',
				'settings' => 'spacious[global_sidebar_layout_heading]',
			)
		)
	);

	//Default layout option.
	$wp_customize->add_setting(
		'spacious[spacious_default_layout]',
		array(
			'default'           => 'right_sidebar',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_default_layout]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Default layout', 'spacious' ),
				'section'  => 'spacious_global_layout_section',
				'settings' => 'spacious[spacious_default_layout]',
				'choices'  => array(
					'right_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					'left_sidebar'                 => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					'no_sidebar_full_width'        => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					'no_sidebar_content_centered'  => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					'no_sidebar_content_stretched' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
				),
			)
		)
	);

	// Default layout for pages.
	$wp_customize->add_setting(
		'spacious[spacious_pages_default_layout]',
		array(
			'default'           => 'right_sidebar',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_pages_default_layout]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Default layout for pages only', 'spacious' ),
				'section'  => 'spacious_global_layout_section',
				'settings' => 'spacious[spacious_pages_default_layout]',
				'choices'  => array(
					'right_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					'left_sidebar'                 => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					'no_sidebar_full_width'        => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					'no_sidebar_content_centered'  => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					'no_sidebar_content_stretched' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
				),
			)
		)
	);

	// Default layout for single posts only.
	$wp_customize->add_setting(
		'spacious[spacious_single_posts_default_layout]',
		array(
			'default'           => 'right_sidebar',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_single_posts_default_layout]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Default layout for single posts only', 'spacious' ),
				'section'  => 'spacious_global_layout_section',
				'settings' => 'spacious[spacious_single_posts_default_layout]',
				'choices'  => array(
					'right_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
					'left_sidebar'                 => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
					'no_sidebar_full_width'        => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
					'no_sidebar_content_centered'  => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					'no_sidebar_content_stretched' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-stretched-layout.png',
				),
			)
		)
	);

	/****************************************Start of the Header Options****************************************/
	// Header options.
	$wp_customize->add_panel(
		'spacious_header_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 50,
			'title'      => esc_html__( 'Header', 'spacious' ),
		)
	);

	$wp_customize->get_section( 'title_tagline' )->panel    = 'spacious_header_options';
	$wp_customize->get_section( 'title_tagline' )->priority = 2;

	$wp_customize->add_setting(
		'spacious[site_logo_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'site_logo_heading',
			array(
				'label'    => esc_html__( 'Site Logo', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[site_logo_heading]',
				'priority' => 1,
			)
		)
	);

	// Retina Logo Option.
	$wp_customize->add_setting(
		'spacious[spacious_different_retina_logo]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_different_retina_logo]',
		array(
			'type'     => 'checkbox',
			'priority' => 8,
			'label'    => esc_html__( 'Different Logo for Retina Devices?', 'spacious' ),
			'section'  => 'title_tagline',
		)
	);

	// Retina Logo Upload.
	$wp_customize->add_setting(
		'spacious[spacious_retina_logo_upload]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spacious[spacious_retina_logo_upload]',
			array(
				'label'           => esc_html__( 'Retina Logo', 'spacious' ),
				'priority'        => 8,
				'setting'         => 'spacious[spacious_retina_logo_upload]',
				'section'         => 'title_tagline',
				'active_callback' => 'spacious_retina_logo_option',
			)
		)
	);

	// Heading for Site Icon.
	$wp_customize->add_setting(
		'spacious[site_icon_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'site_icon_heading',
			array(
				'label'    => esc_html__( 'Site icon', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[site_icon_heading]',
				'priority' => 8,
			)
		)
	);

	$wp_customize->get_control( 'site_icon' )->priority = 9;

	// Heading for Site Title.
	$wp_customize->add_setting(
		'spacious[site_title_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'site_title_heading',
			array(
				'label'    => esc_html__( 'Site Title', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[site_title_heading]',
				'priority' => 9,
			)
		)
	);

	$wp_customize->get_control( 'blogname' )->priority = 10;

	// Heading for Site Tagline.
	$wp_customize->add_setting(
		'spacious[site_tagline_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'site_tagline_heading',
			array(
				'label'    => esc_html__( 'Site Tagline', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[site_tagline_heading]',
				'priority' => 10,
			)
		)
	);

	$wp_customize->get_control( 'blogdescription' )->priority = 11;

	// Heading for logo and header text Visibility.
	$wp_customize->add_setting(
		'spacious[logo_text_visibility_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'logo_text_visibility_heading',
			array(
				'label'    => esc_html__( 'Visibility', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[logo_text_visibility_heading]',
				'priority' => 14,
			)
		)
	);
	$wp_customize->get_control( 'display_header_text' )->section  = 'title_tagline';
	$wp_customize->get_control( 'display_header_text' )->priority = 15;

	$wp_customize->add_setting(
		'spacious[spacious_show_header_logo_text]',
		array(
			'default'           => 'text_only',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_show_header_logo_text]',
		array(
			'type'     => 'radio',
			'priority' => 16,
			'label'    => esc_html__( 'Choose the option that you want.', 'spacious' ),
			'section'  => 'title_tagline',
			'choices'  => array(
				'logo_only' => esc_html__( 'Header Logo Only', 'spacious' ),
				'text_only' => esc_html__( 'Header Text Only', 'spacious' ),
				'both'      => esc_html__( 'Show Both', 'spacious' ),
				'none'      => esc_html__( 'Disable', 'spacious' ),
			),
		)
	);

	// Heading for header text color.
	$wp_customize->add_setting(
		'spacious[header_text_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_text_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[header_text_color_heading]',
				'priority' => 16,
			)
		)
	);

	$wp_customize->get_control( 'header_textcolor' )->section  = 'title_tagline';
	$wp_customize->get_control( 'header_textcolor' )->priority = 20;

	// Heading for header text typography.
	$wp_customize->add_setting(
		'spacious[header_text_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_text_typography_heading',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[header_text_typography_heading]',
				'priority' => 20,
			)
		)
	);

	// Header text typography option.
	$wp_customize->add_setting(
		'spacious[spacious_site_title_font]',
		array(
			'default'           => 'Lato',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_font_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Typography_Control(
			$wp_customize,
			'spacious[spacious_site_title_font]',
			array(
				'priority' => 22,
				'label'    => esc_html__( 'Site title font. Default is "Lato".', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[spacious_site_title_font]',
			)
		)
	);

	// Site title and tagline font size.
	$wp_customize->add_setting(
		'spacious[spacious_site_title_font_size]',
		array(
			'default'           => '36',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_site_title_font_size]',
		array(
			'type'     => 'select',
			'priority' => 22,
			'label'    => esc_html__( 'Site title font size. Default is 36px.', 'spacious' ),
			'section'  => 'title_tagline',
			'settings' => 'spacious[spacious_site_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 26, 46 ),
		)
	);

	// Header text typography option.
	$wp_customize->add_setting(
		'spacious[spacious_site_tagline_font]',
		array(
			'default'           => 'Lato',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_font_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Typography_Control(
			$wp_customize,
			'spacious[spacious_site_tagline_font]',
			array(
				'priority' => 24,
				'label'    => esc_html__( 'Site tagline font. Default is "Lato".', 'spacious' ),
				'section'  => 'title_tagline',
				'settings' => 'spacious[spacious_site_tagline_font]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_tagline_font_size]',
		array(
			'default'           => '16',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_tagline_font_size]',
		array(
			'type'     => 'select',
			'priority' => 25,
			'label'    => esc_html__( 'Site tagline font size. Default is 16px.', 'spacious' ),
			'section'  => 'title_tagline',
			'settings' => 'spacious[spacious_tagline_font_size]',
			'choices'  => spacious_font_size_range_generator( 12, 20 ),
		)
	);

	// Header media options.
	$wp_customize->get_section( 'header_image' )->panel    = 'spacious_header_options';
	$wp_customize->get_section( 'header_image' )->priority = 2;

	// Header image position title.
	// Heading for header text typography.
	$wp_customize->add_setting(
		'spacious[header_image_position_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_image_position_heading',
			array(
				'label'    => esc_html__( 'Header Image Position', 'spacious' ),
				'section'  => 'header_image',
				'settings' => 'spacious[header_image_position_heading]',
				'priority' => 20,
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_header_image_position]',
		array(
			'default'           => 'above',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_image_position]',
		array(
			'priority' => 20,
			'type'     => 'radio',
			'label'    => esc_html__( 'Choose top header image display position.', 'spacious' ),
			'section'  => 'header_image',
			'settings' => 'spacious[spacious_header_image_position]',
			'choices'  => array(
				'above' => esc_html__( 'Position Above (Default): Display the Header image just above the site title and main menu part.', 'spacious' ),
				'below' => esc_html__( 'Position Below: Display the Header image just below the site title and main menu part.', 'spacious' ),
			),
		)
	);

	// Make header image link to homepage.
	$wp_customize->add_setting(
		'spacious[spacious_header_image_link]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_image_link]',
		array(
			'priority' => 20,
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to make header image link back to home page.', 'spacious' ),
			'section'  => 'header_image',
			'settings' => 'spacious[spacious_header_image_link]',
		)
	);

	// Make header image as link option.
	$wp_customize->add_setting(
		'spacious[spacious_header_image_link_to_other_sites]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_image_link_to_other_sites]',
		array(
			'priority' => 20,
			'label'    => esc_html__( 'Add the url here for the header image to link it to the other pages.', 'spacious' ),
			'section'  => 'header_image',
			'settings' => 'spacious[spacious_header_image_link_to_other_sites]',
		)
	);

	// Header top bar options.
	$wp_customize->add_section(
		'spacious_header_top_bar',
		array(
			'priority' => 2,
			'title'    => esc_html__( 'Top Bar', 'spacious' ),
			'panel'    => 'spacious_header_options',
		)
	);

	// Heading for Activate top bar.
	$wp_customize->add_setting(
		'spacious[header_top_bar_active_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_top_bar_active_heading',
			array(
				'label'    => esc_html__( 'Activate Header Top Bar', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[header_top_bar_active_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_activate_top_header_bar]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_activate_top_header_bar]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to show top header bar. The top header bar includes social icons area, small text area and menu area.', 'spacious' ),
			'section'  => 'spacious_header_top_bar',
			'settings' => 'spacious[spacious_activate_top_header_bar]',
		)
	);

	// Heading for header info text.
	$wp_customize->add_setting(
		'spacious[header_info_text_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_info_text_heading',
			array(
				'label'    => esc_html__( 'Header Info Text', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[header_info_text_heading]',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_header_info_text]',
		array(
			'default'           => '',
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_editor_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Editor_Custom_Control(
			$wp_customize,
			'spacious[spacious_header_info_text]',
			array(
				'label'   => esc_html__( 'You can add phone numbers, other contact info here as you like. This box also accepts shortcodes.', 'spacious' ),
				'section' => 'spacious_header_top_bar',
				'setting' => 'spacious[spacious_header_info_text]',
			)
		)
	);

	// Heading for header top display type.
	$wp_customize->add_setting(
		'spacious[header_top_bar_display_type]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_top_bar_display_type',
			array(
				'label'    => esc_html__( 'Header Top Bar Display Type', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[header_top_bar_display_type]',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_top_bar_display_type]',
		array(
			'default'           => 'one',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_top_bar_display_type]',
		array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Choose top bar display type.', 'spacious' ),
			'section'  => 'spacious_header_top_bar',
			'settings' => 'spacious[spacious_top_bar_display_type]',
			'choices'  => array(
				'one' => esc_html__( 'Type 1 (Default): Social icons & small text area on left, menu area on right', 'spacious' ),
				'two' => esc_html__( 'Type 2: Social icons & small text area on right, menu area on left', 'spacious' ),
			),
		)
	);

	// Selective refresh for header information text.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh
			->add_partial(
				'spacious[spacious_header_info_text]',
				array(
					'selector'        => '.small-info-text p',
					'render_callback' => 'spacious_header_info_text',
				)
			);
	}

	// Heading for colors.
	$wp_customize->add_setting(
		'spacious[header_top_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_top_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[header_top_color_heading]',
				'priority' => 10,
			)
		)
	);

	// Header top background color.
	$wp_customize->add_setting(
		'spacious[spacious_header_top_bar_background_color]',
		array(
			'default'              => '#F8F8F8',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_top_bar_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Header top bar background color. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[spacious_header_top_bar_background_color]',
			)
		)
	);

	// Header top bar info text color.
	$wp_customize->add_setting(
		'spacious[spacious_header_info_text_color]',
		array(
			'default'              => '#555555',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_info_text_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Header top bar info text color. Default is #555555.', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[spacious_header_info_text_color]',
			)
		)
	);

	// Header small menu text color.
	$wp_customize->add_setting(
		'spacious[spacious_header_small_menu_text_color]',
		array(
			'default'              => '#666666',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_small_menu_text_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Header small menu text color. Default is #666666.', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[spacious_header_small_menu_text_color]',
			)
		)
	);

	// Heading for typography for header top bar.
	$wp_customize->add_setting(
		'spacious[header_top_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_top_typography_heading',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_header_top_bar',
				'settings' => 'spacious[header_top_typography_heading]',
				'priority' => 32,
			)
		)
	);

	// Header top bar small menu text typography option.
	$wp_customize->add_setting(
		'spacious[spacious_small_info_text_size]',
		array(
			'default'           => '12',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_small_info_text_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Header top bar small info text. Default is 12px.', 'spacious' ),
			'section'  => 'spacious_header_top_bar',
			'settings' => 'spacious[spacious_small_info_text_size]',
			'choices'  => spacious_font_size_range_generator( 10, 16 ),
		)
	);

	// Header top bar small menu text typography option.
	$wp_customize->add_setting(
		'spacious[spacious_small_header_menu_font_size]',
		array(
			'default'           => '12',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_small_header_menu_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Header small menu. Default is 12px.', 'spacious' ),
			'section'  => 'spacious_header_top_bar',
			'settings' => 'spacious[spacious_small_header_menu_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 16 ),
		)
	);

	// Header section.
	$wp_customize->add_section(
		'spacious_header_main',
		array(
			'priority' => 2,
			'title'    => esc_html__( 'Primary Header', 'spacious' ),
			'panel'    => 'spacious_header_options',
		)
	);

	// Heading for header display.
	$wp_customize->add_setting(
		'spacious[header_display_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_display_heading',
			array(
				'label'    => esc_html__( 'Header Display Type', 'spacious' ),
				'section'  => 'spacious_header_main',
				'settings' => 'spacious[header_display_heading]',
			)
		)
	);

	// Heading for typography for header top bar.
	$wp_customize->add_setting(
		'spacious[header_primary_menu_display_type]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_primary_menu_display_type',
			array(
				'label'    => esc_html__( 'Header Display Type', 'spacious' ),
				'section'  => 'spacious_header_main',
				'settings' => 'spacious[header_primary_menu_display_type]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_header_display_type]',
		array(
			'default'           => 'one',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_header_display_type]',
			array(
				'type'     => 'radio',
				'label'    => esc_html__( 'Choose the header display type that you want.', 'spacious' ),
				'section'  => 'spacious_header_main',
				'settings' => 'spacious[spacious_header_display_type]',
				'choices'  => array(
					'one'   => SPACIOUS_ADMIN_IMAGES_URL . '/header-left.png',
					'two'   => SPACIOUS_ADMIN_IMAGES_URL . '/header-right.png',
					'three' => SPACIOUS_ADMIN_IMAGES_URL . '/header-center.png',
					'four'  => SPACIOUS_ADMIN_IMAGES_URL . '/menu-bottom.png',
				),
			)
		)
	);

	// Heading for header border option.
	$wp_customize->add_setting(
		'spacious[header_border_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_border_heading',
			array(
				'label'    => esc_html__( 'Header Border', 'spacious' ),
				'section'  => 'spacious_header_main',
				'settings' => 'spacious[header_border_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_header_border_color_setting]',
		array(
			'default'              => '#eaeaea',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_border_color_setting]',
			array(
				'label'   => esc_html__( 'Border Color', 'spacious' ),
				'section' => 'spacious_header_main',
				'setting' => 'spacious[spacious_header_border_color_setting]',
			)
		)
	);

	// Header Border width.
	$wp_customize->add_setting(
		'spacious[spacious_header_border_width_setting]',
		array(
			'default'           => '1',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_border_width_setting]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Border Width', 'spacious' ),
			'choices' => array(
				'1' => esc_html__( '1px', 'spacious' ),
				'2' => esc_html__( '2px', 'spacious' ),
				'3' => esc_html__( '3px', 'spacious' ),
				'4' => esc_html__( '4px', 'spacious' ),
				'5' => esc_html__( '5px', 'spacious' ),
			),
			'section' => 'spacious_header_main',
			'setting' => 'spacious[spacious_header_border_width_setting]',
		)
	);

	// Heading for header background color option.
	$wp_customize->add_setting(
		'spacious[header_background_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_background_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_header_main',
				'settings' => 'spacious[header_background_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_header_background_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_background_color]',
			array(
				'label'   => esc_html__( 'Header background color. Default is #FFFFFF.', 'spacious' ),
				'section' => 'spacious_header_main',
				'setting' => 'spacious[spacious_header_background_color]',
			)
		)
	);

	// Primary menu section.
	$wp_customize->add_section(
		'spacious_header_primary_menu',
		array(
			'priority' => 2,
			'title'    => esc_html__( 'Primary Menu', 'spacious' ),
			'panel'    => 'spacious_header_options',
		)
	);

	// Heading for search icon.
	$wp_customize->add_setting(
		'spacious[header_primary_menu_search]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_primary_menu_display_type',
			array(
				'label'    => esc_html__( 'Search Icon', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'settings' => 'spacious[header_primary_menu_search]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_header_search_icon]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_search_icon]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Show search icon in header.', 'spacious' ),
			'section'  => 'spacious_header_primary_menu',
			'settings' => 'spacious[spacious_header_search_icon]',
		)
	);

	// Search toggle layout.
	$wp_customize->add_setting(
		'spacious[spacious_header_search_layout]',
		array(
			'default'           => 'default',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_header_search_layout]',
			array(
				'label'           => esc_html__( 'Select the search layout', 'spacious' ),
				'section'         => 'spacious_header_primary_menu',
				'settings'        => 'spacious[spacious_header_search_layout]',
				'choices'         => array(
					'default'   => SPACIOUS_ADMIN_IMAGES_URL . '/search-icon-style-1.png',
					'style_one' => SPACIOUS_ADMIN_IMAGES_URL . '/search-icon-style-2.png',
				),
				'active_callback' => 'spacious_search_toggle_option',
			)
		)
	);

	// Heading for menu display.
	$wp_customize->add_setting(
		'spacious[header_primary_menu_display]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_primary_menu_display',
			array(
				'label'    => esc_html__( 'Menu Display', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'settings' => 'spacious[header_primary_menu_display]',
			)
		)
	);


	$wp_customize->add_setting(
		'spacious[spacious_one_line_menu_setting]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_one_line_menu_setting]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display menu in one line', 'spacious' ),
			'section' => 'spacious_header_primary_menu',
			'setting' => 'spacious[spacious_one_line_menu_setting]',
		)
	);

	// Heading for responsive menu.
	$wp_customize->add_setting(
		'spacious[header_primary_menu_responsive_style]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_primary_menu_responsive_style',
			array(
				'label'    => esc_html__( 'Responsive Menu Style', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'settings' => 'spacious[header_primary_menu_responsive_style]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_new_menu]',
		array(
			'default'           => '1',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_new_menu]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Switch to new responsive menu.', 'spacious' ),
			'section'  => 'spacious_header_primary_menu',
			'settings' => 'spacious[spacious_new_menu]'
		)
	);

	// Heading for primary menu color.
	$wp_customize->add_setting(
		'spacious[header_primary_menu_color]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_primary_menu_color',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'settings' => 'spacious[header_primary_menu_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_primary_menu_text_color]',
		array(
			'default'              => '#444444',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_primary_menu_text_color]',
			array(
				'label'   => esc_html__( 'Primary menu text color. Default is #444444.', 'spacious' ),
				'section' => 'spacious_header_primary_menu',
				'setting' => 'spacious[spacious_primary_menu_text_color]',
			)
		)
	);

	// Primary submenu text color.
	$wp_customize->add_setting(
		'spacious[spacious_primary_sub_menu_text_color]',
		array(
			'default'              => '#666666',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_primary_sub_menu_text_color]',
			array(
				'label'   => esc_html__( 'Primary sub menu text color. Default is #666666.', 'spacious' ),
				'section' => 'spacious_header_primary_menu',
				'setting' => 'spacious[spacious_primary_sub_menu_text_color]',
			)
		)
	);

	// Heading for primary menu typography.
	$wp_customize->add_setting(
		'spacious[header_primary_menu_typography]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_primary_menu_typography',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'settings' => 'spacious[header_primary_menu_typography]',
			)
		)
	);

	// Header text typography option.
	$wp_customize->add_setting(
		'spacious[spacious_menu_font]',
		array(
			'default'           => 'Lato',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_font_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Typography_Control(
			$wp_customize,
			'spacious[spacious_menu_font]',
			array(
				'priority' => 22,
				'label'    => esc_html__( 'Menu font. Default is "Lato".', 'spacious' ),
				'section'  => 'spacious_header_primary_menu',
				'settings' => 'spacious[spacious_menu_font]',
			)
		)
	);

	// Menu font size option.
	$wp_customize->add_setting(
		'spacious[spacious_primary_menu_font_size]',
		array(
			'default'           => '16',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_primary_menu_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Primary menu. Default is 16px.', 'spacious' ),
			'section'  => 'spacious_header_primary_menu',
			'settings' => 'spacious[spacious_primary_menu_font_size]',
			'choices'  => spacious_font_size_range_generator( 12, 20 ),
		)
	);

	// Menu font size option.
	$wp_customize->add_setting(
		'spacious[spacious_primary_sub_menu_font_size]',
		array(
			'default'           => '13',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_primary_sub_menu_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Primary sub menu. Default is 13px.', 'spacious' ),
			'section'  => 'spacious_header_primary_menu',
			'settings' => 'spacious[spacious_primary_sub_menu_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 18 ),
		)
	);

	// Header Button section.
	$wp_customize->add_section(
		'spacious_header_button',
		array(
			'priority' => 2,
			'title'    => esc_html__( 'Header Button', 'spacious' ),
			'panel'    => 'spacious_header_options',
		)
	);

	// Heading for header button one.
	$wp_customize->add_setting(
		'spacious[header_button_one_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_button_one_heading',
			array(
				'label'    => esc_html__( 'Header Button One', 'spacious' ),
				'section'  => 'spacious_header_button',
				'settings' => 'spacious[header_button_one_heading]',
			)
		)
	);

	// Button text.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_setting]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_one_setting]',
		array(
			'label'    => esc_html__( 'Button Text', 'spacious' ),
			'section'  => 'spacious_header_button',
			'settings' => 'spacious[spacious_header_button_one_setting]',
		)
	);

	// Button Link.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_link]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_one_link]',
		array(
			'label'    => esc_html__( 'Button Link', 'spacious' ),
			'section'  => 'spacious_header_button',
			'settings' => 'spacious[spacious_header_button_one_link]',
		)
	);

	// New tab.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_tab]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_one_tab]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Check to show in new tab', 'spacious' ),
			'section' => 'spacious_header_button',
			'setting' => 'spacious[spacious_header_button_one_tab]',
		)
	);

	// Header button one text color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_text_color]',
		array(
			'default'              => '#ffffff',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_one_text_color]',
			array(
				'label'   => esc_html__( 'Text Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_one_text_color]',
			)
		)
	);

	// Header button one text hover color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_text_hover_color]',
		array(
			'default'              => '#ffffff',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_one_text_hover_color]',
			array(
				'label'   => esc_html__( 'Text Hover Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_one_text_hover_color]',
			)
		)
	);

	// Header button one background color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_background_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_one_background_color]',
			array(
				'label'   => esc_html__( 'Background Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_one_background_color]',
			)
		)
	);

	// Header button one background hover color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_background_hover_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_one_background_hover_color]',
			array(
				'label'   => esc_html__( 'Background Hover Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_one_background_hover_color]',
			)
		)
	);

	// Header button one Border radius.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_border_radius]',
		array(
			'default'           => '5px',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_one_border_radius]',
		array(
			'label'    => esc_html__( 'Border Radius', 'spacious' ),
			'section'  => 'spacious_header_button',
			'settings' => 'spacious[spacious_header_button_one_border_radius]',
		)
	);

	// Header button one Border width.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_border_width]',
		array(
			'default'           => '2',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_one_border_width]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Border Width', 'spacious' ),
			'choices' => array(
				'1' => esc_html__( '1px', 'spacious' ),
				'2' => esc_html__( '2px', 'spacious' ),
				'3' => esc_html__( '3px', 'spacious' ),
				'4' => esc_html__( '4px', 'spacious' ),
				'5' => esc_html__( '5px', 'spacious' ),
			),
			'section' => 'spacious_header_button',
		)
	);

	// Border color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_border_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_one_border_color]',
			array(
				'label'   => esc_html__( 'Border Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_one_border_color]',
			)
		)
	);

	// Border hover color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_one_border_hover_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_one_border_hover_color]',
			array(
				'label'   => esc_html__( 'Border Hover Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_one_border_hover_color]',
			)
		)
	);

	// Heading for header button two.
	$wp_customize->add_setting(
		'spacious[header_button_two_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_button_two_heading',
			array(
				'label'    => esc_html__( 'Header Button Two', 'spacious' ),
				'section'  => 'spacious_header_button',
				'settings' => 'spacious[header_button_two_heading]',
			)
		)
	);

	// Button text.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_setting]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_two_setting]',
		array(
			'label'    => esc_html__( 'Button Text', 'spacious' ),
			'section'  => 'spacious_header_button',
			'settings' => 'spacious[spacious_header_button_two_setting]',
		)
	);

	// Button Link.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_link]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_two_link]',
		array(
			'label'    => esc_html__( 'Button Link', 'spacious' ),
			'section'  => 'spacious_header_button',
			'settings' => 'spacious[spacious_header_button_two_link]',
		)
	);

	// New tab.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_tab]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_two_tab]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Check to show in new tab', 'spacious' ),
			'section' => 'spacious_header_button',
			'setting' => 'spacious[spacious_header_button_two_tab]',
		)
	);

	// Header button two text color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_text_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_two_text_color]',
			array(
				'label'   => esc_html__( 'Text Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_two_text_color]',
			)
		)
	);

	// Header button two text hover color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_text_hover_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_two_text_hover_color]',
			array(
				'label'   => esc_html__( 'Text Hover Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_two_text_hover_color]',
			)
		)
	);

	// Header button two background color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_background_color]',
		array(
			'default'              => '',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_two_background_color]',
			array(
				'label'   => esc_html__( 'Background Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_two_background_color]',
			)
		)
	);

	// Header button two background hover color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_background_hover_color]',
		array(
			'default'              => '',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_two_background_hover_color]',
			array(
				'label'   => esc_html__( 'Background Hover Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_two_background_hover_color]',
			)
		)
	);

	// Header button two Border radius.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_border_radius]',
		array(
			'default'           => '5px',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_two_border_radius]',
		array(
			'label'    => esc_html__( 'Border Radius', 'spacious' ),
			'section'  => 'spacious_header_button',
			'settings' => 'spacious[spacious_header_button_two_border_radius]',
		)
	);

	// Header button two Border width.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_border_width]',
		array(
			'default'           => '2',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_button_two_border_width]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Border Width', 'spacious' ),
			'choices' => array(
				'1' => esc_html__( '1px', 'spacious' ),
				'2' => esc_html__( '2px', 'spacious' ),
				'3' => esc_html__( '3px', 'spacious' ),
				'4' => esc_html__( '4px', 'spacious' ),
				'5' => esc_html__( '5px', 'spacious' ),
			),
			'section' => 'spacious_header_button',
		)
	);

	// Border color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_border_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_two_border_color]',
			array(
				'label'   => esc_html__( 'Border Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_two_border_color]',
			)
		)
	);

	// Border hover color.
	$wp_customize->add_setting(
		'spacious[spacious_header_button_two_border_hover_color]',
		array(
			'default'              => '#0fbe7c',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_button_two_border_hover_color]',
			array(
				'label'   => esc_html__( 'Border Hover Color', 'spacious' ),
				'section' => 'spacious_header_button',
				'setting' => 'spacious[spacious_header_button_two_border_hover_color]',
			)
		)
	);

	// Sticky header section.
	$wp_customize->add_section(
		'spacious_sticky_menu_setting',
		array(
			'priority' => 2,
			'title'    => esc_html__( 'Sticky Menu', 'spacious' ),
			'panel'    => 'spacious_header_options',
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_sticky_menu]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_sticky_menu]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( ' Check to enable the sticky behavior of the primary menu.', 'spacious' ),
			'section'  => 'spacious_sticky_menu_setting',
			'settings' => 'spacious[spacious_sticky_menu]',
		)
	);

	// Togglable Header Sidebar.
	$wp_customize->add_section(
		'spacious_togglable_header_sidebar',
		array(
			'priority' => 2,
			'title'    => esc_html__( 'Togglable Header Sidebar', 'spacious' ),
			'panel'    => 'spacious_header_options',
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_togglable_header_sidebar_setting]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_togglable_header_sidebar_setting]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Enable Togglable Header Sidebar', 'spacious' ),
			'section' => 'spacious_togglable_header_sidebar',
			'setting' => 'spacious[spacious_togglable_header_sidebar_setting]',
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_togglable_header_sidebar_column]',
		array(
			'default'           => 'three-style-2',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_togglable_header_sidebar_column]',
			array(
				'label'           => esc_html__( 'Choose the number of column for the header widgetized areas.', 'spacious' ),
				'choices'         => array(
					'one'           => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
					'two'           => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
					'three'         => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-third-column.png',
					'four'          => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
					'two-style-1'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style1.png',
					'two-style-2'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style2.png',
					'three-style-1' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style1.png',
					'three-style-2' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style2.png',
					'three-style-3' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style3.png',
					'four-style-1'  => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style1.png',
					'four-style-2'  => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style2.png',
				),
				'section'         => 'spacious_togglable_header_sidebar',
				'active_callback' => 'spacious_header_sidebar_toggle_option',
			)
		)
	);

	/****************************************Start of the Slider Options****************************************/
	$wp_customize->add_section(
		'spacious_slider_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 55,
			'title'      => esc_html__( 'Slider', 'spacious' ),
		)
	);

	// Heading for slider activation.
	$wp_customize->add_setting(
		'spacious[slider_activate_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'slider_activate_heading',
			array(
				'label'    => esc_html__( 'Activate slider', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[slider_activate_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_activate_slider]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_activate_slider]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to activate slider.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_activate_slider]',
		)
	);

	// Selective refresh for slider activate.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_activate_slider]',
			array(
				'selector'        => '#featured-slider',
				'render_callback' => '',
			)
		);
	}

	// Heading for slider status.
	$wp_customize->add_setting(
		'spacious[slider_status_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'slider_status_heading',
			array(
				'label'    => esc_html__( 'Slider Status', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[slider_status_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_status]',
		array(
			'default'           => 'home_front_page',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_status]',
		array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Choose the slider status that you want.', 'spacious' ),
			'choices'  => array(
				'home_front_page' => esc_html__( 'Slider on Front and blog page', 'spacious' ),
				'front_only'      => esc_html__( 'Slider on Front page only', 'spacious' ),
				'all_page'        => esc_html__( 'Slider on all pages', 'spacious' ),
			),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_status]',
		)
	);

	// Heading for slider setting.
	$wp_customize->add_setting(
		'spacious[slider_setting_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'slider_setting_heading',
			array(
				'label'    => esc_html__( 'Slider Settings', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[slider_setting_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_transition_effect]',
		array(
			'default'           => 'fade',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_slider_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_transition_effect]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Slider transition effect', 'spacious' ) . '  ' . esc_html__( 'Choose the transition effect that you like. Default is "fade".', 'spacious' ),
			'setting' => 'spacious[spacious_slider_transition_effect]',
			'section' => 'spacious_slider_options',
			'choices' => array(
				'fade'       => esc_html__( 'Fade', 'spacious' ),
				'fadeout'    => esc_html__( 'FadeOut', 'spacious' ),
				'none'       => esc_html__( 'None', 'spacious' ),
				'scrollHorz' => esc_html__( 'ScrollHorz', 'spacious' ),
				'flipHorz'   => esc_html__( 'FlipHorz', 'spacious' ),
				'flipVert'   => esc_html__( 'FlipVert', 'spacious' ),
				'tileBlind'  => esc_html__( 'TileBlind', 'spacious' ),
				'shuffle'    => esc_html__( 'Shuffle', 'spacious' ),
			),
		)
	);

	// Slider transition delay time.
	$wp_customize->add_setting(
		'spacious[spacious_slider_transition_delay]',
		array(
			'default'           => 4,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_slider_transition_delay_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_transition_delay]',
		array(
			'label'   => esc_html__( 'Slider transition delay time', 'spacious' ) . '  ' . esc_html__( 'Add number in seconds. Default is 4.', 'spacious' ),
			'setting' => 'spacious[spacious_slider_transition_delay]',
			'section' => 'spacious_slider_options',
		)
	);

	// Slider transition length time.
	$wp_customize->add_setting(
		'spacious[spacious_slider_transition_length]',
		array(
			'default'           => 1,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_slider_transition_length_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_transition_length]',
		array(
			'label'   => esc_html__( 'Slider transition length time', 'spacious' ) . '  ' . esc_html__( 'Add number in seconds. Default is 1.', 'spacious' ),
			'setting' => 'spacious[spacious_slider_transition_length]',
			'section' => 'spacious_slider_options',
		)
	);

	// slider number sanitize.
	$wp_customize->add_setting(
		'spacious[spacious_slider_number]',
		array(
			'default'           => 5,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_slider_number_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_number]',
		array(
			'label'   => esc_html__( 'Number of slides', 'spacious' ) . '  ' . esc_html__( 'Enter the number of slides you want then click save.', 'spacious' ),
			'setting' => 'spacious[spacious_slider_number]',
			'section' => 'spacious_slider_options',
		)
	);

	// Slider image as link option.
	$wp_customize->add_setting(
		'spacious[spacious_slider_image_link_option]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_image_link_option]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to make the slider images link back to respective links.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_image_link_option]',
		)
	);

	// Enable next/prev option.
	$wp_customize->add_setting(
		'spacious[spacious_slider_next_prev_option]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_next_prev_option]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to enable next/prev option.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_next_prev_option]',
		)
	);

	// Enable pause on hover.
	$wp_customize->add_setting(
		'spacious[spacious_slider_pause_on_hover_option]',
		array(
			'default'           => 1,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_pause_on_hover_option]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to enable pause on hover.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_pause_on_hover_option]',
		)
	);

	// Enable progressbar.
	$wp_customize->add_setting(
		'spacious[spacious_slider_progressbar_option]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_progressbar_option]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to enable progressbar.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_progressbar_option]',
		)
	);

	// Slides random order.
	$wp_customize->add_setting(
		'spacious[spacious_slider_random_order_option]',
		array(
			'default'           => false,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_random_order_option]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to display slides in random order.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_random_order_option]',
		)
	);

	/**
	 * Image upload options.
	 */
	$num_of_slides = spacious_options( 'spacious_slider_number', '5' );

	for ( $i = 1; $i <= $num_of_slides; $i++ ) {

		// Heading for Image upload.
		$wp_customize->add_setting(
			'spacious[slider_image_upload_heading' . $i . ' ]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Heading_Control(
				$wp_customize,
				'spacious[slider_image_upload_heading' . $i . ' ]',
				array(
					'label'   => sprintf( esc_html__( 'Slider Content #%1$s', 'spacious' ), $i ),
					'section' => 'spacious_slider_options',
					'setting' => 'spacious[slider_image_upload_heading' . $i . ']',
				)
			)
		);

		// adding slider image url.
		$wp_customize->add_setting(
			'spacious[spacious_slider_image' . $i . ']',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'spacious[spacious_slider_image' . $i . ']',
				array(
					'label'   => esc_html__( 'Upload slider image.', 'spacious' ),
					'section' => 'spacious_slider_options',
					'setting' => 'spacious[spacious_slider_image' . $i . ']',
				)
			)
		);

		// adding slider title.
		$wp_customize->add_setting(
			'spacious[spacious_slider_title' . $i . ']',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_slider_title' . $i . ']',
			array(
				'label'   => esc_html__( 'Enter title for your slider.', 'spacious' ),
				'section' => 'spacious_slider_options',
				'setting' => 'spacious[spacious_slider_title' . $i . ']',
			)
		);

		// adding slider description.
		$wp_customize->add_setting(
			'spacious[spacious_slider_text' . $i . ']',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_text_sanitize',
			)
		);

		$wp_customize->add_control(
			new Spacious_Text_Area_Control(
				$wp_customize,
				'spacious[spacious_slider_text' . $i . ']',
				array(
					'label'   => esc_html__( 'Enter your slider description.', 'spacious' ),
					'section' => 'spacious_slider_options',
					'setting' => 'spacious[spacious_slider_text' . $i . ']',
				)
			)
		);

		// adding slider text position.
		$wp_customize->add_setting(
			'spacious[spacious_slide_text_position' . $i . ']',
			array(
				'default'           => 'left',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_radio_sanitize',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_slide_text_position' . $i . ']',
			array(
				'type'    => 'radio',
				'label'   => esc_html__( 'Slider text position.', 'spacious' ),
				'choices' => array(
					'right'  => esc_html__( 'Right side', 'spacious' ),
					'left'   => esc_html__( 'Left side', 'spacious' ),
					'center' => esc_html__( 'Center', 'spacious' ),
				),
				'section' => 'spacious_slider_options',
			)
		);

		// adding slider button text.
		$wp_customize->add_setting(
			'spacious[spacious_slider_button_text' . $i . ']',
			array(
				'default'           => esc_html__( 'Read more', 'spacious' ),
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_slider_button_text' . $i . ']',
			array(
				'label'   => esc_html__( 'Enter the button text. Default is "Read more"', 'spacious' ),
				'section' => 'spacious_slider_options',
				'setting' => 'spacious[spacious_slider_button_text' . $i . ']',
			)
		);

		// adding button url.
		$wp_customize->add_setting(
			'spacious[spacious_slider_link' . $i . ']',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_slider_link' . $i . ']',
			array(
				'label'   => esc_html__( 'Enter link to redirect slider when clicked', 'spacious' ),
				'section' => 'spacious_slider_options',
				'setting' => 'spacious[spacious_slider_link' . $i . ']',
			)
		);
	}

	// Heading for slider color.
	$wp_customize->add_setting(
		'spacious[slider_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'slider_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[slider_color_heading]',
			)
		)
	);

	// Slider color options.
	$wp_customize->add_setting(
		'spacious[spacious_slider_title_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_slider_title_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Slider title. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[spacious_slider_title_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_content_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_slider_content_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Slider content. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[spacious_slider_content_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_button_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_slider_button_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Slider button text color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[spacious_slider_button_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_button_background_color]',
		array(
			'default'              => '#0FBE7C',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_slider_button_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Slider button background color. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[spacious_slider_button_background_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_content_background_color]',
		array(
			'default'              => 'rgba(0, 0, 0, 0.3)',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new Spacious_Color_Control(
			$wp_customize,
			'spacious[spacious_slider_content_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Slider content background color.', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[spacious_slider_content_background_color]',
			)
		)
	);

	// Heading for slider typography.
	$wp_customize->add_setting(
		'spacious[slider_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'slider_typography_heading',
			array(
				'priority' => 35,
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_slider_options',
				'settings' => 'spacious[slider_typography_heading]',
			)
		)
	);

	// slider title typography option.
	$wp_customize->add_setting(
		'spacious[spacious_slider_title_font_size]',
		array(
			'default'           => '26',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_title_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Slider title. Default is 26px.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 20, 40 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_content_font_size]',
		array(
			'default'           => '12',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_content_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Slider content. Default is 16px.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_content_font_size]',
			'choices'  => spacious_font_size_range_generator( 12, 20 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_slider_button_font_size]',
		array(
			'default'           => '20',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_slider_button_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Slider button text. Default is 20px.', 'spacious' ),
			'section'  => 'spacious_slider_options',
			'settings' => 'spacious[spacious_slider_button_font_size]',
			'choices'  => spacious_font_size_range_generator( 16, 30 ),
		)
	);
	// End of Slider Options.

	// Content Options.
	$wp_customize->add_panel(
		'spacious_content_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 60,
			'title'      => esc_html__( 'Content', 'spacious' ),
		)
	);

	$wp_customize->add_section(
		'spacious_post_page_content_options',
		array(
			'title' => esc_html__( 'Page Header', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for header title
	$wp_customize->add_setting(
		'spacious[header_title_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'header_title_heading',
			array(
				'label'    => esc_html__( 'Header Title', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[header_title_heading]',
			)
		)
	);

	/**
	 * Title header options.
	 */
	$wp_customize->add_setting(
		'spacious[spacious_header_title_hide]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_title_hide]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide page/post header title', 'spacious' ),
			'section' => 'spacious_post_page_content_options',
		)
	);

	// Header title background color option.
	$wp_customize->add_setting(
		'spacious[spacious_header_tile_background_color]',
		array(
			'default'              => '#ffffff',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_tile_background_color]',
			array(
				'label'   => esc_html__( 'Background Color', 'spacious' ),
				'section' => 'spacious_post_page_content_options',
				'setting' => 'spacious[spacious_header_tile_background_color]',
			)
		)
	);

	// Header title background image upload setting.
	$wp_customize->add_setting(
		'spacious[spacious_header_title_background_image]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spacious[spacious_header_title_background_image]',
			array(
				'label'   => esc_html__( 'Background Image', 'spacious' ),
				'setting' => 'spacious[spacious_header_title_background_image]',
				'section' => 'spacious_post_page_content_options',
			)
		)
	);

	// Header_title background image position setting.
	$wp_customize->add_setting(
		'spacious[spacious_header_title_background_image_position]',
		array(
			'default'           => 'center-center',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_title_background_image_position]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Position', 'spacious' ),
			'setting' => 'spacious[spacious_header_title_background_image_position]',
			'section' => 'spacious_post_page_content_options',
			'choices' => array(
				'left-top'      => esc_html__( 'Top Left', 'spacious' ),
				'center-top'    => esc_html__( 'Top Center', 'spacious' ),
				'right-top'     => esc_html__( 'Top Right', 'spacious' ),
				'left-center'   => esc_html__( 'Center Left', 'spacious' ),
				'center-center' => esc_html__( 'Center Center', 'spacious' ),
				'right-center'  => esc_html__( 'Center Right', 'spacious' ),
				'left-bottom'   => esc_html__( 'Bottom Left', 'spacious' ),
				'center-bottom' => esc_html__( 'Bottom Center', 'spacious' ),
				'right-bottom'  => esc_html__( 'Bottom Right', 'spacious' ),
			),
		)
	);

	// Header title background size setting.
	$wp_customize->add_setting(
		'spacious[spacious_header_title_background_image_size]',
		array(
			'default'           => 'auto',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_title_background_image_size]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Size', 'spacious' ),
			'setting' => 'spacious[spacious_header_title_background_image_size]',
			'section' => 'spacious_post_page_content_options',
			'choices' => array(
				'cover'   => esc_html__( 'Cover', 'spacious' ),
				'contain' => esc_html__( 'Contain', 'spacious' ),
				'auto'    => esc_html__( 'Auto', 'spacious' ),
			),
		)
	);

	// Header title background attachment setting.
	$wp_customize->add_setting(
		'spacious[spacious_header_title_background_image_attachment]',
		array(
			'default'           => 'scroll',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_title_background_image_attachment]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Attachment', 'spacious' ),
			'setting' => 'spacious[spacious_header_title_background_image_attachment]',
			'section' => 'spacious_post_page_content_options',
			'choices' => array(
				'scroll' => esc_html__( 'Scroll', 'spacious' ),
				'fixed'  => esc_html__( 'Fixed', 'spacious' ),
			),
		)
	);

	// Header title background repeat setting.
	$wp_customize->add_setting(
		'spacious[spacious_header_title_background_image_repeat]',
		array(
			'default'           => 'repeat',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_header_title_background_image_repeat]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Repeat', 'spacious' ),
			'setting' => 'spacious[spacious_header_title_background_image_repeat]',
			'section' => 'spacious_post_page_content_options',
			'choices' => array(
				'no-repeat' => esc_html__( 'No Repeat', 'spacious' ),
				'repeat'    => esc_html__( 'Repeat', 'spacious' ),
				'repeat-x'  => esc_html__( 'Repeat Horizontally', 'spacious' ),
				'repeat-y'  => esc_html__( 'Repeat Vertically', 'spacious' ),
			),
		)
	);

	// Heading for breadcrumb custom text.
	$wp_customize->add_setting(
		'spacious[breadcrumb_custom_text_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'breadcrumb_custom_text_heading',
			array(
				'label'    => esc_html__( 'Breadcrumb Custom Text', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[breadcrumb_custom_text_heading]',
			)
		)
	);

	// BreadCrumb custom text option.
	$wp_customize->add_setting(
		'spacious[spacious_custom_breadcrumb_text]',
		array(
			'default'           => esc_html__( 'You are here:', 'spacious' ),
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_custom_breadcrumb_text]',
		array(
			'label'    => esc_html__( 'Change the BreadCrumb text as your requirement.', 'spacious' ),
			'section'  => 'spacious_post_page_content_options',
			'settings' => 'spacious[spacious_custom_breadcrumb_text]',
		)
	);

	// Selective refresh for BreadCrumb custom text.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_custom_breadcrumb_text]',
			array(
				'selector'        => '.breadcrumb',
				'render_callback' => 'spacious_breadcrumb',
			)
		);
	}

	// Heading for color of page/post/blog.
	$wp_customize->add_setting(
		'spacious[page_post_content_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'page_post_content_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[page_post_content_color_heading]',
			)
		)
	);

	// Header bar background color.
	$wp_customize->add_setting(
		'spacious[spacious_header_bar_background_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_header_bar_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Header bar background color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[spacious_header_bar_background_color]',
			)
		)
	);

	// Header text color.
	$wp_customize->add_setting(
		'spacious[spacious_page_post_title_color]',
		array(
			'default'              => '#222222',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_page_post_title_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Page title and post title in single view. Default is #222222', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[spacious_page_post_title_color]',
			)
		)
	);

	// Breadcrumb text color.
	$wp_customize->add_setting(
		'spacious[spacious_breadcrumb_text_color]',
		array(
			'default'              => '#666666',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_breadcrumb_text_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Breadcrumb text color. Default is #666666.', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[spacious_breadcrumb_text_color]',
			)
		)
	);

	// Heading for typography of page/post/blog.
	$wp_customize->add_setting(
		'spacious[page_post_content_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'page_post_content_typography_heading',
			array(
				'priority' => 35,
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_post_page_content_options',
				'settings' => 'spacious[page_post_content_typography_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_title_font_size]',
		array(
			'default'           => '22',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_title_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Page title and post title in single view. Default is 22px. Appears in header bar just before content.', 'spacious' ),
			'section'  => 'spacious_post_page_content_options',
			'settings' => 'spacious[spacious_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 18, 30 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_breadcrumb_text_font_size]',
		array(
			'default'           => '12',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_breadcrumb_text_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Breadcrumb Text. Default is 12px. Breadcrumb appears in header bar right side after installing Breadcrumb NavXT', 'spacious' ),
			'section'  => 'spacious_post_page_content_options',
			'settings' => 'spacious[spacious_breadcrumb_text_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 16 ),
		)
	);

	$wp_customize->add_section(
		'spacious_blog_content_options',
		array(
			'title' => esc_html__( 'Blog/Archive', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for blog display.
	$wp_customize->add_setting(
		'spacious[blog_post_display_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'blog_post_display_heading',
			array(
				'label'    => esc_html__( 'Blog Posts display type', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'settings' => 'spacious[blog_post_display_heading]',
			)
		)
	);

	// blog posts display type settings.
	$wp_customize->add_setting(
		'spacious[spacious_archive_display_type]',
		array(
			'default'           => 'blog_large',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_archive_display_type]',
		array(
			'type'    => 'radio',
			'label'   => esc_html__( 'Choose the display type for the archive/category view.', 'spacious' ),
			'choices' => array(
				'blog_large'                  => esc_html__( 'Blog Image Large', 'spacious' ),
				'blog_medium'                 => esc_html__( 'Blog Image Medium', 'spacious' ),
				'blog_medium_alternate'       => esc_html__( 'Blog Image Alternate Medium', 'spacious' ),
				'blog_medium_round'           => esc_html__( 'Blog Image Round Medium', 'spacious' ),
				'blog_medium_round_alternate' => esc_html__( 'Blog Image Round Alternate Medium', 'spacious' ),
				'blog_full_content'           => esc_html__( 'Blog Full Content', 'spacious' ),
				'blog_masonry_content'        => esc_html__( 'Masonry', 'spacious' ),
				'blog_grid_content'           => esc_html__( 'Grid', 'spacious' ),
			),
			'section' => 'spacious_blog_content_options',
		)
	);

	// Column Option.
	$wp_customize->add_setting(
		'spacious[spacious_blog_column_option]',
		array(
			'default'           => '2',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_blog_column_option]',
		array(
			'type'            => 'select',
			'label'           => esc_html__( 'Column', 'spacious' ),
			'choices'         => array(
				'2' => esc_html__( 'Two', 'spacious' ),
				'3' => esc_html__( 'Three', 'spacious' ),
			),
			'section'         => 'spacious_blog_content_options',
			'active_callback' => 'spacious_blog_column_option',
		)
	);

	// Heading for excerpt length.
	$wp_customize->add_setting(
		'spacious[excerpt_length_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'excerpt_length_heading',
			array(
				'label'    => esc_html__( 'Excerpt Length', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'settings' => 'spacious[excerpt_length_heading]',
			)
		)
	);

	// Excerpt Options.
	$wp_customize->add_setting(
		'spacious[spacious_excerpt_length]',
		array(
			'default'           => 40,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_excerpt_length_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_excerpt_length]',
		array(
			'label'   => esc_html__( 'Enter the number of Words you wish to show on excerpt. Default value is 40 words.', 'spacious' ),
			'setting' => 'spacious[spacious_excerpt_length]',
			'section' => 'spacious_blog_content_options',
		)
	);

	// Heading for excerpt readmore text.
	$wp_customize->add_setting(
		'spacious[excerpt_readmore_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'excerpt_readmore_heading_search',
			array(
				'label'    => esc_html__( 'Excerpt Read More Text', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'settings' => 'spacious[excerpt_readmore_heading]',
			)
		)
	);

	// excerpt text setting.
	$wp_customize->add_setting(
		'spacious[spacious_read_more_text]',
		array(
			'default'           => esc_html__( 'Read more', 'spacious' ),
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_filter_nohtml_kses',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_read_more_text]',
		array(
			'label'   => esc_html__( 'Replace the default Read more text with your own words', 'spacious' ),
			'setting' => 'spacious[spacious_read_more_text]',
			'section' => 'spacious_blog_content_options',
		)
	);

	// Selective refresh for read more text text.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_read_more_text]',
			array(
				'selector'        => '.read-more',
				'render_callback' => 'spacious_read_more_text_render',
			)
		);
	}

	// Heading for content readmore tag.
	$wp_customize->add_setting(
		'spacious[content_readmore_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'content_readmore_heading',
			array(
				'label'    => esc_html__( 'Content Read More Tag', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'settings' => 'spacious[content_readmore_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_content_read_more_tag_display]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_content_read_more_tag_display]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to display content read more tag from beginning.', 'spacious' ),
			'section'  => 'spacious_blog_content_options',
			'settings' => 'spacious[spacious_content_read_more_tag_display]',
		)
	);

	// Heading for category description.
	$wp_customize->add_setting(
		'spacious[category_description_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'category_description_heading',
			array(
				'label'    => esc_html__( 'Category Options', 'spacious' ),
				'section'  => 'spacious_blog_content_options',
				'settings' => 'spacious[category_description_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_term_description]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_term_description]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Activate term description', 'spacious' ),
			'settings' => 'spacious[spacious_term_description]',
			'section'  => 'spacious_blog_content_options',
		)
	);

	// Selective refresh for taxonomy description.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_term_description]',
			array(
				'selector'        => '.taxonomy-description',
				'render_callback' => 'spacious_taxonomy_description',
			)
		);
	}

	// Single Post section.
	$wp_customize->add_section(
		'spacious_single_post_section',
		array(
			'title' => esc_html__( 'Single Post', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for Author bio.
	$wp_customize->add_setting(
		'spacious[author_bio_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'author_bio_heading',
			array(
				'label'    => esc_html__( 'Author Bio', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'settings' => 'spacious[author_bio_heading]',
			)
		)
	);

	// Author Bio activate option.
	$wp_customize->add_setting(
		'spacious[spacious_author_bio]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_author_bio]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to enable the author bio section just below the post.', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_author_bio]',
		)
	);

	// Selective refresh for author bio.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_author_bio]',
			array(
				'selector'        => '.author-box',
				'render_callback' => '',
			)
		);
	}

	// author link.
	$wp_customize->add_setting(
		'spacious[spacious_author_bio_link]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_author_bio_link]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to add the all post link of author url in the author box.', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_author_bio_link]',
		)
	);

	// Author social link meta.
	$wp_customize->add_setting(
		'spacious[spacious_author_bio_social_link_setting]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_author_bio_social_link_setting]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to show the Social Profiles in the Author Bio.', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_author_bio_social_link_setting]',
		)
	);

	// author social links.
	$wp_customize->add_setting(
		'spacious[spacious_author_bio_social_link]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_author_bio_social_link]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to add the social links in the author bio section. Note: it suppots only the social icons provided by All In One SEO Pack or WordPress SEO plugin.', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_author_bio_social_link]',
		)
	);

	// Heading for single post featured image.
	$wp_customize->add_setting(
		'spacious[featured_image_single_post_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'featured_image_single_post_heading',
			array(
				'label'    => esc_html__( 'Featured Image In Single Post Page', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'settings' => 'spacious[featured_image_single_post_heading]',
			)
		)
	);

	// Featured image in single post page activate option.
	$wp_customize->add_setting(
		'spacious[spacious_featured_image_single_post_page]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_featured_image_single_post_page]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to enable the featured image in single post page.', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_featured_image_single_post_page]',
		)
	);

	// Heading for related post.
	$wp_customize->add_setting(
		'spacious[related_post_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'related_post_heading',
			array(
				'label'    => esc_html__( 'Related Posts', 'spacious' ),
				'section'  => 'spacious_single_post_section',
				'settings' => 'spacious[related_post_heading]',
			)
		)
	);

	//Related post.
	$wp_customize->add_setting(
		'spacious[spacious_related_posts_activate]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_related_posts_activate]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to activate the related posts', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_related_posts_activate]',
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_related_posts]',
		array(
			'default'           => 'categories',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_related_posts]',
		array(
			'type'     => 'radio',
			'label'    => esc_html__( 'Related Posts Must Be Shown As:', 'spacious' ),
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_related_posts]',
			'choices'  => array(
				'categories' => esc_html__( 'Related Posts By Categories', 'spacious' ),
				'tags'       => esc_html__( 'Related Posts By Tags', 'spacious' ),
			),
		)
	);

	// Select option to display number of posts.
	$wp_customize->add_setting(
		'spacious[spacious_related_post_number_display]',
		array(
			'default'           => '3',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_related_post_number_display]',
		array(
			'type'     => 'select',
			'section'  => 'spacious_single_post_section',
			'settings' => 'spacious[spacious_related_post_number_display]',
			'label'    => esc_html__( 'Number of post to display', 'spacious' ),
			'choices'  => array(
				'3' => esc_html__( '3', 'spacious' ),
				'6' => esc_html__( '6', 'spacious' ),
			),
		)
	);

	// Post meta section.
	$wp_customize->add_section(
		'spacious_post_meta_section',
		array(
			'title' => esc_html__( 'Post Meta', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for post meta.
	$wp_customize->add_setting(
		'spacious[post_meta_display_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'post_meta_display_heading',
			array(
				'label'    => esc_html__( 'Post Meta Display', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[post_meta_display_heading]',
			)
		)
	);

	// post meta full enable/disable.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_full]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_full]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the post meta for the post totally, ie, remove all of the meta data.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_full]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// author display in post meta.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_author]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_author]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the author only in the post meta section.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_author]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// date display in post meta.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_date]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_date]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the date only in the post meta section.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_date]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// category display in post meta.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_category]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_category]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the category only in the post meta section.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_category]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// comments display in post meta.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_comments]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_comments]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the comments only in the post meta section.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_comments]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// edit button display in post meta.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_edit_button]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_edit_button]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the edit button only in the post meta section.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_edit_button]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// tags display in just below the post.
	$wp_customize->add_setting(
		'spacious[spacious_post_meta_tags]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_tags]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable the tags display just below the post.', 'spacious' ),
			'setting' => 'spacious[spacious_post_meta_tags]',
			'section' => 'spacious_post_meta_section',
		)
	);

	// Heading for post meta color.
	$wp_customize->add_setting(
		'spacious[post_meta_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'post_meta_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[post_meta_color_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_post_meta_icon_color]',
		array(
			'default'              => '#999999',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_post_meta_icon_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Post meta icon color. Post meta includes date, author, category etc. information of post. Default is #999999.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[spacious_post_meta_icon_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_post_meta_color]',
		array(
			'default'              => '#999999',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_post_meta_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Post meta text color. Post meta includes date, author, category etc. information of post. Default is #999999.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[spacious_post_meta_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_post_meta_read_more_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_post_meta_read_more_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Read more text in post meta. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[spacious_post_meta_read_more_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_post_meta_read_more_background_color]',
		array(
			'default'              => '#0FBE7C',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_post_meta_read_more_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Read more text background color. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[spacious_post_meta_read_more_background_color]',
			)
		)
	);

	// Heading for post meta typography.
	$wp_customize->add_setting(
		'spacious[post_meta_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'post_meta_typography_heading',
			array(
				'priority' => 35,
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_post_meta_section',
				'settings' => 'spacious[post_meta_typography_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_post_meta_font_size]',
		array(
			'default'           => '14',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_post_meta_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Post meta font size. Default is 14px. Post meta includes date, author, category etc. information of post.', 'spacious' ),
			'section'  => 'spacious_post_meta_section',
			'settings' => 'spacious[spacious_post_meta_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 18 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_read_more_font_size]',
		array(
			'default'           => '14',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_read_more_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Read more link font size. Default is 14px. Read more in post meta, TG: Featured Single Page widget and TG: Services widget.', 'spacious' ),
			'section'  => 'spacious_post_meta_section',
			'settings' => 'spacious[spacious_read_more_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 18 ),
		)
	);

	// Page section.
	$wp_customize->add_section(
		'spacious_page_section',
		array(
			'title' => esc_html__( 'Page', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for featured image in page.
	$wp_customize->add_setting(
		'spacious[featured_image_page_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'featured_image_page_heading',
			array(
				'label'    => esc_html__( 'Featured Image in Single Page', 'spacious' ),
				'section'  => 'spacious_page_section',
				'settings' => 'spacious[featured_image_page_heading]',
			)
		)
	);

	// Featured image in single page activate option.
	$wp_customize->add_setting(
		'spacious[spacious_featured_image_single_page]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_featured_image_single_page]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to enable the featured image in single page.', 'spacious' ),
			'section'  => 'spacious_page_section',
			'settings' => 'spacious[spacious_featured_image_single_page]',
		)
	);

	// Sidebar section.
	$wp_customize->add_section(
		'spacious_sidebar_section',
		array(
			'title' => esc_html__( 'Sidebar', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for sticky content and sidebar.
	$wp_customize->add_setting(
		'spacious[sticky_content_sidebar_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'sticky_content_sidebar_heading',
			array(
				'label'    => esc_html__( 'Sticky Content And Sidebar', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'settings' => 'spacious[sticky_content_sidebar_heading]',
			)
		)
	);

	// Sticky post and sidebar section.
	$wp_customize->add_setting(
		'spacious[spacious_sticky_content_sidebar]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_sticky_content_sidebar]',
		array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Check to activate the sticky options for content and sidebar areas.', 'spacious' ),
			'setting' => 'spacious[spacious_sticky_content_sidebar]',
			'section' => 'spacious_sidebar_section',
		)
	);

	// Heading for sticky content and sidebar color.
	$wp_customize->add_setting(
		'spacious[sticky_content_sidebar_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'sticky_content_sidebar_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'settings' => 'spacious[sticky_content_sidebar_color_heading]',
			)
		)
	);

	// sticky content and sidebar widget title color.
	$wp_customize->add_setting(
		'spacious[spacious_widget_title_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_widget_title_color]',
			array(
				'label'    => esc_html__( 'Widget title color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'settings' => 'spacious[spacious_widget_title_color]',
			)
		)
	);

	// Heading for sticky content and sidebar typography.
	$wp_customize->add_setting(
		'spacious[sticky_content_sidebar_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'sticky_content_sidebar_typography_heading',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_sidebar_section',
				'settings' => 'spacious[sticky_content_sidebar_typography_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_widget_title_font_size]',
		array(
			'default'           => '22',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_widget_title_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Widget title font size. Default is 22px.', 'spacious' ),
			'section'  => 'spacious_sidebar_section',
			'settings' => 'spacious[spacious_widget_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 18, 40 ),
		)
	);

	// Comments section.
	$wp_customize->add_section(
		'spacious_comment_section',
		array(
			'title' => esc_html__( 'Comments', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for comments color.
	$wp_customize->add_setting(
		'spacious[comment_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'comment_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[comment_color_heading]',
			)
		)
	);

	// comments color.
	$wp_customize->add_setting(
		'spacious[spacious_comment_part_background_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_comment_part_background_color]',
			array(
				'label'    => esc_html__( 'Comment part background color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[spacious_comment_part_background_color]',
			)
		)
	);

	// comments title color.
	$wp_customize->add_setting(
		'spacious[spacious_comment_title_color]',
		array(
			'default'              => '#222222',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_comment_title_color]',
			array(
				'label'    => esc_html__( 'Comment title color. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[spacious_comment_title_color]',
			)
		)
	);

	// comments meta color.
	$wp_customize->add_setting(
		'spacious[spacious_comment_meta_color]',
		array(
			'default'              => '#999999',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_comment_meta_color]',
			array(
				'label'    => esc_html__( 'Comment meta color. Like name, date etc. Default is #999999.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[spacious_comment_meta_color]',
			)
		)
	);

	// comments single background color.
	$wp_customize->add_setting(
		'spacious[spacious_single_comment_background_color]',
		array(
			'default'              => '#F8F8F8',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_single_comment_background_color]',
			array(
				'label'    => esc_html__( 'Single comment background color. Like name, date etc. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[spacious_single_comment_background_color]',
			)
		)
	);

	// comments field background color.
	$wp_customize->add_setting(
		'spacious[spacious_commenting_field_background_color]',
		array(
			'default'              => '#F8F8F8',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_commenting_field_background_color]',
			array(
				'label'    => esc_html__( 'Commenting field background color. Like name, date etc. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[spacious_commenting_field_background_color]',
			)
		)
	);

	// Heading for comment typography.
	$wp_customize->add_setting(
		'spacious[comment_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'comment_typography_heading',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_comment_section',
				'settings' => 'spacious[comment_typography_heading]',
			)
		)
	);

	// Comment title font size.
	$wp_customize->add_setting(
		'spacious[spacious_comment_title_font_size]',
		array(
			'default'           => '26',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_comment_title_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Comment Title. Default is 26px.', 'spacious' ),
			'section'  => 'spacious_comment_section',
			'settings' => 'spacious[spacious_comment_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 20, 34 ),
		)
	);

	// Comment content font size.
	$wp_customize->add_setting(
		'spacious[spacious_content_font_size]',
		array(
			'default'           => '16',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_content_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Content font size, also applies to other text like in search fields, post comment button etc. Default is 16px.', 'spacious' ),
			'section'  => 'spacious_comment_section',
			'settings' => 'spacious[spacious_content_font_size]',
			'choices'  => spacious_font_size_range_generator( 12, 20 ),
		)
	);

	// Start to 404 page options.
	$wp_customize->add_section(
		'spacious_404page_options_section',
		array(
			'title' => esc_html__( '404 Page', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for 404 page.
	$wp_customize->add_setting(
		'spacious[404_page_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'404_page_heading',
			array(
				'label'    => esc_html__( '404 Page Text', 'spacious' ),
				'section'  => 'spacious_404page_options_section',
				'settings' => 'spacious[404_page_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_404page_options_setting]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_editor_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Editor_Custom_Control(
			$wp_customize,
			'spacious[spacious_404page_options_setting]',
			array(
				'label'   => esc_html__( 'Add the text you want to display in 404 Page.', 'spacious' ),
				'section' => 'spacious_404page_options_section',
				'setting' => 'spacious[spacious_404page_options_setting]',
			)
		)
	);

	// Selective refresh for 404 page information text.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_404page_options_setting]',
			array(
				'selector'        => '.page-content p',
				'render_callback' => 'spacious_404page_options_setting',
			)
		);
	}

	// Start to widget options.
	$wp_customize->add_section(
		'spacious_widget_options',
		array(
			'title' => esc_html__( 'Widgets', 'spacious' ),
			'panel' => 'spacious_content_options',
		)
	);

	// Heading for widget color.
	$wp_customize->add_setting(
		'spacious[call_to_action_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'call_to_action_heading',
			array(
				'label'    => esc_html__( 'TG:Call to action widget color options', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[call_to_action_heading]',
			)
		)
	);

	// Tg: Call to Action color.
	$wp_customize->add_setting(
		'spacious[spacious_call_to_action_background_color]',
		array(
			'default'              => '#F8F8F8',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_call_to_action_background_color]',
			array(
				'label'    => esc_html__( 'Background color. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[spacious_call_to_action_background_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_call_to_action_title_color]',
		array(
			'default'              => '#222222',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_call_to_action_title_color]',
			array(
				'label'    => esc_html__( 'Title color. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[spacious_call_to_action_title_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_call_to_action_button_color]',
		array(
			'default'              => '#FFFFFF',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_call_to_action_button_color]',
			array(
				'label'    => esc_html__( 'Button text color. Default is #FFFFFF.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[spacious_call_to_action_button_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_call_to_action_button_background_color]',
		array(
			'default'              => '#0FBE7C',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_call_to_action_button_background_color]',
			array(
				'label'    => esc_html__( 'Button background color. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[spacious_call_to_action_button_background_color]',
			)
		)
	);

	// Heading for widget color.
	$wp_customize->add_setting(
		'spacious[widget_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'widget_color_heading',
			array(
				'label'    => esc_html__( 'Color', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[widget_color_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_posts_title_color]',
		array(
			'default'              => '#222222',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_posts_title_color]',
			array(
				'label'    => esc_html__( 'Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts widget. Default is #222222.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[spacious_posts_title_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_tg_widget_read_more_color]',
		array(
			'default'              => '#0FBE7C',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_tg_widget_read_more_color]',
			array(
				'label'    => esc_html__( 'Read more link color for TG: Featured Single Page widget and TG: Services widget. Default is #0FBE7C.', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[spacious_tg_widget_read_more_color]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_border_lines_color]',
		array(
			'default'              => '#EAEAEA',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_border_lines_color]',
			array(
				'label'    => esc_html__( 'Border lines. These lines are used in various parts as seperator and as borders. Default is #EAEAEA.', 'spacious' ),
				'settings' => 'spacious[spacious_border_lines_color]',
				'section'  => 'spacious_widget_options',
			)
		)
	);

	// Heading for widget typography.
	$wp_customize->add_setting(
		'spacious[widget_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'widget_typography_heading',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_widget_options',
				'settings' => 'spacious[widget_typography_heading]',
			)
		)
	);

	// Call to action typography option.
	$wp_customize->add_setting(
		'spacious[spacious_call_to_action_title_font_size]',
		array(
			'default'           => '24',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_call_to_action_title_font_size]',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Title of TG: Call To Action widget. Default is 24px.', 'spacious' ),
			'section'  => 'spacious_widget_options',
			'settings' => 'spacious[spacious_call_to_action_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 20, 34 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_call_to_action_button_font_size]',
		array(
			'default'           => '22',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_call_to_action_button_font_size]',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Button text of TG: Call To Action widget. Default is 22px.', 'spacious' ),
			'section'  => 'spacious_widget_options',
			'settings' => 'spacious[spacious_call_to_action_button_font_size]',
			'choices'  => spacious_font_size_range_generator( 18, 30 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_archive_title_font_size]',
		array(
			'default'           => '26',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_archive_title_font_size]',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Title in posts listing or blog/category view. Also for posts titles in TG:Featured Posts widget. Default is 26px.', 'spacious' ),
			'section'  => 'spacious_widget_options',
			'settings' => 'spacious[spacious_archive_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 20, 34 ),
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_client_widget_title_font_size]',
		array(
			'default'           => '30',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_client_widget_title_font_size]',
		array(
			'type'     => 'select',
			'label'    => esc_html__( 'Main title of TG: Featured Posts widget and TG: Our Clients widget. Default is 30px.', 'spacious' ),
			'section'  => 'spacious_widget_options',
			'settings' => 'spacious[spacious_client_widget_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 20, 34 ),
		)
	);

	/****************************************Start of the Footer Options****************************************/

	$wp_customize->add_panel(
		'spacious_footer_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 75,
			'title'      => esc_html__( 'Footer', 'spacious' ),
		)
	);

	// Footer bottom border option.
	$wp_customize->add_section(
		'spacious_general_section',
		array(
			'priority' => 3,
			'title'    => esc_html__( 'General', 'spacious' ),
			'panel'    => 'spacious_footer_options',
		)
	);

	// Heading for footer general options.
	$wp_customize->add_setting(
		'spacious[general_footer_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'general_footer_heading',
			array(
				'label'    => esc_html__( 'Footer Border Option', 'spacious' ),
				'section'  => 'spacious_general_section',
				'settings' => 'spacious[general_footer_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_footer_border_color_setting]',
		array(
			'default'              => '#EAEAEA',
			'type'                 => 'option',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_border_color_setting]',
			array(
				'label'   => esc_html__( 'Border Color', 'spacious' ),
				'section' => 'spacious_general_section',
				'setting' => 'spacious[spacious_footer_border_color_setting]',
			)
		)
	);

	//Footer Border width.
	$wp_customize->add_setting(
		'spacious[spacious_footer_border_width_setting]',
		array(
			'default'           => '1',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_border_width_setting]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Border Width', 'spacious' ),
			'choices' => array(
				'1' => esc_html__( '1px', 'spacious' ),
				'2' => esc_html__( '2px', 'spacious' ),
				'3' => esc_html__( '3px', 'spacious' ),
				'4' => esc_html__( '4px', 'spacious' ),
				'5' => esc_html__( '5px', 'spacious' ),
			),
			'section' => 'spacious_general_section',
			'setting' => 'spacious[spacious_footer_border_width_setting]',
		)
	);

	// Heading for footer background options.
	$wp_customize->add_setting(
		'spacious[background_image_footer_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'background_image_footer_heading',
			array(
				'label'    => esc_html__( 'Background Image', 'spacious' ),
				'section'  => 'spacious_general_section',
				'settings' => 'spacious[background_image_footer_heading]',
			)
		)
	);

	// Footer background image upload setting.
	$wp_customize->add_setting(
		'spacious[spacious_footer_background_image]',
		array(
			'default'           => '',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'spacious[spacious_footer_background_image]',
			array(
				'label'   => esc_html__( 'Background Image', 'spacious' ),
				'setting' => 'spacious[spacious_footer_background_image]',
				'section' => 'spacious_general_section',
			)
		)
	);

	// Footer background image position setting.
	$wp_customize->add_setting(
		'spacious[spacious_footer_background_image_position]',
		array(
			'default'           => 'center-center',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_background_image_position]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Position', 'spacious' ),
			'setting' => 'spacious[spacious_footer_background_image_position]',
			'section' => 'spacious_general_section',
			'choices' => array(
				'left-top'      => esc_html__( 'Top Left', 'spacious' ),
				'center-top'    => esc_html__( 'Top Center', 'spacious' ),
				'right-top'     => esc_html__( 'Top Right', 'spacious' ),
				'left-center'   => esc_html__( 'Center Left', 'spacious' ),
				'center-center' => esc_html__( 'Center Center', 'spacious' ),
				'right-center'  => esc_html__( 'Center Right', 'spacious' ),
				'left-bottom'   => esc_html__( 'Bottom Left', 'spacious' ),
				'center-bottom' => esc_html__( 'Bottom Center', 'spacious' ),
				'right-bottom'  => esc_html__( 'Bottom Right', 'spacious' ),
			),
		)
	);

	// Footer background size setting.
	$wp_customize->add_setting(
		'spacious[spacious_footer_background_image_size]',
		array(
			'default'           => 'auto',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_background_image_size]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Size', 'spacious' ),
			'setting' => 'spacious[spacious_footer_background_image_size]',
			'section' => 'spacious_general_section',
			'choices' => array(
				'cover'   => esc_html__( 'Cover', 'spacious' ),
				'contain' => esc_html__( 'Contain', 'spacious' ),
				'auto'    => esc_html__( 'Auto', 'spacious' ),
			),
		)
	);

	// Footer background attachment setting.
	$wp_customize->add_setting(
		'spacious[spacious_footer_background_image_attachment]',
		array(
			'default'           => 'scroll',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_background_image_attachment]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Attachment', 'spacious' ),
			'setting' => 'spacious[spacious_footer_background_image_attachment]',
			'section' => 'spacious_general_section',
			'choices' => array(
				'scroll' => esc_html__( 'Scroll', 'spacious' ),
				'fixed'  => esc_html__( 'Fixed', 'spacious' ),
			),
		)
	);

	// Footer background repeat setting.
	$wp_customize->add_setting(
		'spacious[spacious_footer_background_image_repeat]',
		array(
			'default'           => 'repeat',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_background_image_repeat]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Background Image Repeat', 'spacious' ),
			'setting' => 'spacious[spacious_footer_background_image_repeat]',
			'section' => 'spacious_general_section',
			'choices' => array(
				'no-repeat' => esc_html__( 'No Repeat', 'spacious' ),
				'repeat'    => esc_html__( 'Repeat', 'spacious' ),
				'repeat-x'  => esc_html__( 'Repeat Horizontally', 'spacious' ),
				'repeat-y'  => esc_html__( 'Repeat Vertically', 'spacious' ),
			),
		)
	);

	// Footer widgets select type.
	$wp_customize->add_section(
		'spacious_footer_widgets_area_section',
		array(
			'priority' => 5,
			'title'    => esc_html__( 'Footer Widgets Area', 'spacious' ),
			'panel'    => 'spacious_footer_options',
		)
	);

	// Heading for footer widget column options.
	$wp_customize->add_setting(
		'spacious[footer_widget_column_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_widget_column_heading',
			array(
				'label'    => esc_html__( 'Footer Widgets Column', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'settings' => 'spacious[footer_widget_column_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_footer_widget_column_select_type]',
		array(
			'default'           => 'four',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		new Spacious_Image_Radio_Control(
			$wp_customize,
			'spacious[spacious_footer_widget_column_select_type]',
			array(
				'label'   => esc_html__( 'Choose the number of column for the footer widgetized areas.', 'spacious' ),
				'choices' => array(
					'one'           => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-full-column.png',
					'two'           => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-column.png',
					'three'         => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-third-column.png',
					'four'          => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-fourth-column.png',
					'two-style-1'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style1.png',
					'two-style-2'   => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-two-style2.png',
					'three-style-1' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style1.png',
					'three-style-2' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style2.png',
					'three-style-3' => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-three-style3.png',
					'four-style-1'  => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style1.png',
					'four-style-2'  => SPACIOUS_ADMIN_IMAGES_URL . '/sidebar-layout-four-style2.png',
				),
				'section' => 'spacious_footer_widgets_area_section',
			)
		)
	);

	// Heading for footer widget color options.
	$wp_customize->add_setting(
		'spacious[footer_widget_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_widget_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'settings' => 'spacious[footer_widget_color_heading]',
			)
		)
	);

	// Footer widget title color
	$wp_customize->add_setting(
		'spacious[spacious_footer_widget_title_color]',
		array(
			'default'              => '#D5D5D5',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_widget_title_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Widget title color. Default is #D5D5D5.', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'settings' => 'spacious[spacious_footer_widget_title_color]',
			)
		)
	);

	// Footer widget content color
	$wp_customize->add_setting(
		'spacious[spacious_footer_widget_content_color]',
		array(
			'default'              => '#999999',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_widget_content_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Widget content color. Default is #999999.', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'settings' => 'spacious[spacious_footer_widget_content_color]',
			)
		)
	);

	// Footer widget background color
	$wp_customize->add_setting(
		'spacious[spacious_footer_widget_background_color]',
		array(
			'default'              => '#333333',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_widget_background_color]',
			array(
				'priority' => 30,
				'label'    => esc_html__( 'Widget background color. Default is #333333.', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'settings' => 'spacious[spacious_footer_widget_background_color]',
			)
		)
	);

	// Heading for footer widget typography options.
	$wp_customize->add_setting(
		'spacious[footer_widget_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_widget_typography_heading',
			array(
				'priority' => 35,
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_footer_widgets_area_section',
				'settings' => 'spacious[footer_widget_typography_heading]',
			)
		)
	);

	// Footer widget title font size
	$wp_customize->add_setting(
		'spacious[spacious_footer_widget_title_font_size]',
		array(
			'default'           => '22',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_widget_title_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Footer widget title font size. Default is 22px.', 'spacious' ),
			'section'  => 'spacious_footer_widgets_area_section',
			'settings' => 'spacious[spacious_footer_widget_title_font_size]',
			'choices'  => spacious_font_size_range_generator( 18, 30 ),
		)
	);

	// Footer widget content font size
	$wp_customize->add_setting(
		'spacious[spacious_footer_widget_content_font_size]',
		array(
			'default'           => '14',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_widget_content_font_size]',
		array(
			'type'     => 'select',
			'priority' => 35,
			'label'    => esc_html__( 'Footer widget content font size. Default is 14px.', 'spacious' ),
			'section'  => 'spacious_footer_widgets_area_section',
			'settings' => 'spacious[spacious_footer_widget_content_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 18 ),
		)
	);

	// botton Footer widgets options.
	$wp_customize->add_section(
		'spacious_footer_bottom_area_section',
		array(
			'priority' => 5,
			'title'    => esc_html__( 'Footer Bottom Bar', 'spacious' ),
			'panel'    => 'spacious_footer_options',
		)
	);

	// Heading for footer botton column options.
	$wp_customize->add_setting(
		'spacious[footer_buttom_copyright_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_buttom_copyright_heading',
			array(
				'label'    => esc_html__( 'Footer Copyright Editor', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[footer_buttom_copyright_heading]',
			)
		)
	);

	// Footer editor option.
	$default_footer_value = esc_html__( 'Copyright &copy; ', 'spacious' ) . '[the-year] [site-link] ' . esc_html__( 'Theme by: ', 'spacious' ) . '[tg-link] ' . esc_html__( 'Powered by: ', 'spacious' ) . '[wp-link]';

	$wp_customize->add_setting(
		'spacious[spacious_footer_editor]',
		array(
			'default'           => $default_footer_value,
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_footer_editor_sanitize',
		)
	);

	$wp_customize->add_control(
		new spacious_Editor_Custom_Control(
			$wp_customize,
			'spacious[spacious_footer_editor]',
			array(
				'label'   => esc_html__( 'Edit the Copyright information in your footer. You can also use shortcodes [the-year], [site-link], [wp-link], [tg-link] for current year, your site link, WordPress site link and ThemeGrill site link respectively.', 'spacious' ),
				'section' => 'spacious_footer_bottom_area_section',
				'setting' => 'spacious[spacious_footer_editor]',
			)
		)
	);

	// Selective refresh for footer copyright information.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_footer_editor]',
			array(
				'selector'        => '.copyright',
				'render_callback' => 'spacious_footer_copyright',
			)
		);
	}

	// Heading for footer botton copyright options.
	$wp_customize->add_setting(
		'spacious[footer_buttom_copyright_alignment_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_buttom_copyright_alignment_heading',
			array(
				'label'    => esc_html__( 'Copyright Alignment', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[footer_buttom_copyright_alignment_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_copyright_layout]',
		array(
			'default'           => 'left',
			'type'              => 'option',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_copyright_layout]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Display Copyright and Footer Menu either on left/right or on center Position.', 'spacious' ),
			'choices' => array(
				'left'   => esc_html__( 'Left/Right', 'spacious' ),
				'right'  => esc_html__( 'Right/Left', 'spacious' ),
				'center' => esc_html__( 'Center', 'spacious' ),
			),
			'section' => 'spacious_footer_bottom_area_section',
		)
	);

	// Heading for footer menu options.
	$wp_customize->add_setting(
		'spacious[footer_buttom_menu_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_buttom_menu_heading',
			array(
				'label'    => esc_html__( 'Footer Menu', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[footer_buttom_menu_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_footer_social]',
		array(
			'default'           => 'footer_menu',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_social]',
		array(
			'type'    => 'select',
			'label'   => esc_html__( 'Display Footer Menu or Social Menu.', 'spacious' ),
			'choices' => array(
				'footer_menu' => esc_html__( 'Footer Menu', 'spacious' ),
				'social_menu' => esc_html__( 'Social Menu', 'spacious' ),
			),
			'section' => 'spacious_footer_bottom_area_section',
		)
	);

	// Heading for footer bottom bar color option.
	$wp_customize->add_setting(
		'spacious[footer_bottom_bar_color_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_bottom_bar_color_heading',
			array(
				'label'    => esc_html__( 'Colors', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[footer_bottom_bar_color_heading]',
			)
		)
	);

	// Footer copyright text color.
	$wp_customize->add_setting(
		'spacious[spacious_footer_copyright_text_color]',
		array(
			'default'              => '#666666',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_copyright_text_color]',
			array(
				'label'    => esc_html__( 'Footer copyright text color. Default is #666666.', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[spacious_footer_copyright_text_color]',
			)
		)
	);

	// Footer small menu text color.
	$wp_customize->add_setting(
		'spacious[spacious_footer_small_menu_color]',
		array(
			'default'              => '#666666',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_small_menu_color]',
			array(
				'label'    => esc_html__( 'Footer small menu text color. Default is #666666.', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[spacious_footer_small_menu_color]',
			)
		)
	);

	// Footer copyright background color.
	$wp_customize->add_setting(
		'spacious[spacious_footer_copyright_part_background_color]',
		array(
			'default'              => '#F8F8F8',
			'type'                 => 'option',
			'transport'            => 'postMessage',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
			'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',

		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'spacious[spacious_footer_copyright_part_background_color]',
			array(
				'label'    => esc_html__( 'Footer copyright part background color. Default is #F8F8F8.', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[spacious_footer_copyright_part_background_color]',
			)
		)
	);

	// Heading for footer bottom bar typography option.
	$wp_customize->add_setting(
		'spacious[footer_bottom_bar_typography_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'footer_bottom_bar_typography_heading',
			array(
				'label'    => esc_html__( 'Typography', 'spacious' ),
				'section'  => 'spacious_footer_bottom_area_section',
				'settings' => 'spacious[footer_bottom_bar_typography_heading]',
			)
		)
	);

	// footer copyright typography option.
	$wp_customize->add_setting(
		'spacious[spacious_footer_copyright_text_font_size]',
		array(
			'default'           => '12',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_footer_copyright_text_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Footer copyright text font size. Default is 12px.', 'spacious' ),
			'section'  => 'spacious_footer_bottom_area_section',
			'settings' => 'spacious[spacious_footer_copyright_text_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 16 ),
		)
	);

	// footer small menu typography option.
	$wp_customize->add_setting(
		'spacious[spacious_small_footer_menu_font_size]',
		array(
			'default'           => '12',
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_radio_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_small_footer_menu_font_size]',
		array(
			'type'     => 'select',
			'priority' => 32,
			'label'    => esc_html__( 'Footer small menu. Default is 12px.', 'spacious' ),
			'section'  => 'spacious_footer_bottom_area_section',
			'settings' => 'spacious[spacious_small_footer_menu_font_size]',
			'choices'  => spacious_font_size_range_generator( 10, 16 ),
		)
	);

	// Scroll to top feature activate option.
	$wp_customize->add_section(
		'spacious_scroll_to_top_feature_section',
		array(
			'priority' => 6,
			'title'    => esc_html__( 'Scroll To Top Button', 'spacious' ),
			'panel'    => 'spacious_footer_options',
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_scroll_to_top_feature]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_scroll_to_top_feature]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to disable the scroll to top button.', 'spacious' ),
			'section'  => 'spacious_scroll_to_top_feature_section',
			'settings' => 'spacious[spacious_scroll_to_top_feature]',
		)
	);
	// End of Footer Options.

	/*************************************Start of the Social Links Options*************************************/

	$wp_customize->add_section(
		'spacious_social_links_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 75,
			'title'      => esc_html__( 'Social Links', 'spacious' ),
		)
	);

	// Heading for social link activation.
	$wp_customize->add_setting(
		'spacious[social_link_activation_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'social_link_activation_heading',
			array(
				'label'    => esc_html__( 'Activate social links area', 'spacious' ),
				'section'  => 'spacious_social_links_options',
				'settings' => 'spacious[social_link_activation_heading]',
			)
		)
	);

	$wp_customize->add_setting(
		'spacious[spacious_activate_social_links]',
		array(
			'default'           => 0,
			'type'              => 'option',
			'transport'         => $customizer_selective_refresh,
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'spacious_checkbox_sanitize',
		)
	);

	$wp_customize->add_control(
		'spacious[spacious_activate_social_links]',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Check to activate social links area. You also need to activate the header top bar section in Header options to show this social links area', 'spacious' ),
			'section'  => 'spacious_social_links_options',
			'settings' => 'spacious[spacious_activate_social_links]',
		)
	);

	// Selective refresh for social links enable.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'spacious[spacious_activate_social_links]',
			array(
				'selector'        => '.social-links',
				'render_callback' => '',
			)
		);
	}

	// Heading for social icon.
	$wp_customize->add_setting(
		'spacious[social_icon_heading]',
		array(
			'sanitize_callback' => false,
		)
	);

	$wp_customize->add_control(
		new Spacious_Heading_Control(
			$wp_customize,
			'social_icon_heading',
			array(
				'label'    => esc_html__( 'Social Icon', 'spacious' ),
				'section'  => 'spacious_social_links_options',
				'settings' => 'spacious[social_icon_heading]',
			)
		)
	);

	$spacious_social_links = array(
		'spacious_social_facebook'    => esc_html__( 'Facebook', 'spacious' ),
		'spacious_social_twitter'     => esc_html__( 'Twitter', 'spacious' ),
		'spacious_social_googleplus'  => esc_html__( 'GooglePlus', 'spacious' ),
		'spacious_social_instagram'   => esc_html__( 'Instagram', 'spacious' ),
		'spacious_social_codepen'     => esc_html__( 'CodePen', 'spacious' ),
		'spacious_social_digg'        => esc_html__( 'Digg', 'spacious' ),
		'spacious_social_dribbble'    => esc_html__( 'Dribbble', 'spacious' ),
		'spacious_social_flickr'      => esc_html__( 'Flickr', 'spacious' ),
		'spacious_social_github'      => esc_html__( 'GitHub', 'spacious' ),
		'spacious_social_linkedin'    => esc_html__( 'LinkedIn', 'spacious' ),
		'spacious_social_pinterest'   => esc_html__( 'Pinterest', 'spacious' ),
		'spacious_social_polldaddy'   => esc_html__( 'Polldaddy', 'spacious' ),
		'spacious_social_pocket'      => esc_html__( 'Pocket', 'spacious' ),
		'spacious_social_reddit'      => esc_html__( 'Reddit', 'spacious' ),
		'spacious_social_skype'       => esc_html__( 'Skype', 'spacious' ),
		'spacious_social_stumbleupon' => esc_html__( 'StumbleUpon', 'spacious' ),
		'spacious_social_tumblr'      => esc_html__( 'Tumblr', 'spacious' ),
		'spacious_social_vimeo'       => esc_html__( 'Vimeo', 'spacious' ),
		'spacious_social_wordpress'   => esc_html__( 'WordPress', 'spacious' ),
		'spacious_social_youtube'     => esc_html__( 'YouTube', 'spacious' ),
		'spacious_social_rss'         => esc_html__( 'RSS', 'spacious' ),
		'spacious_social_mail'        => esc_html__( 'Mail', 'spacious' ),
	);

	$i = 1;
	foreach ( $spacious_social_links as $key => $value ) {

		// adding social sites link.
		$wp_customize->add_setting(
			'spacious[' . $key . ']',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'spacious[' . $key . ']',
			array(
				/* translators: %s: Social Sites */
				'label'   => sprintf( 'Add link for %1$s', $value ),
				'section' => 'spacious_social_links_options',
				'setting' => 'spacious[' . $key . ']',
			)
		);

		// adding social open in new page tab setting.
		$wp_customize->add_setting(
			'spacious[' . $key . 'new_tab]',
			array(
				'default'           => 0,
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_checkbox_sanitize',
			)
		);

		$wp_customize->add_control(
			'spacious[' . $key . 'new_tab]',
			array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section' => 'spacious_social_links_options',
				'setting' => 'spacious[' . $key . 'new_tab]',
			)
		);

		// divider for social link activation.
		$wp_customize->add_setting(
			'spacious[' . $key . '_additional]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Divider_Control(
				$wp_customize,
				'spacious[' . $key . '_additional]',
				array(
					'section'  => 'spacious_social_links_options',
					'settings' => 'spacious[' . $key . '_additional]',
				)
			)
		);

		$i++;

	}

	// Adding additional custom social links.
	$spacious_social_links_additional_icons = array(
		'spacious_social_additional_icon_one'   => esc_html__( 'Additional Social Icon One', 'spacious' ),
		'spacious_social_additional_icon_two'   => esc_html__( 'Additional Social Icon Two', 'spacious' ),
		'spacious_social_additional_icon_three' => esc_html__( 'Additional Social Icon Three', 'spacious' ),
		'spacious_social_additional_icon_four'  => esc_html__( 'Additional Social Icon Four', 'spacious' ),
		'spacious_social_additional_icon_five'  => esc_html__( 'Additional Social Icon Five', 'spacious' ),
	);

	$i = 1;
	foreach ( $spacious_social_links_additional_icons as $key => $value ) {
	// divider for social link activation.
		$wp_customize->add_setting(
			'spacious[' . $key . '_additional]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Divider_Control(
				$wp_customize,
				'spacious[' . $key . '_additional]',
				array(
					'section'  => 'spacious_social_links_options',
					'settings' => 'spacious[' . $key . '_additional]',
				)
			)
		);
		// adding social sites link.
		$wp_customize->add_setting(
			'spacious[' . $key . ']',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'spacious[' . $key . ']',
			array(
				/* translators: %s: Additional Social Site */
				'label'   => sprintf( esc_html__( 'Add link for %1$s', 'spacious' ), $value ),
				'section' => 'spacious_social_links_options',
				'setting' => 'spacious[' . $key . ']',
			)
		);

		// font-awesome call.
		$wp_customize->add_setting(
			'spacious[' . $key . '_fontawesome]',
			array(
				'default'           => '',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			new Spacious_Additional_Social_Icons_Control(
				$wp_customize,
				'spacious[' . $key . '_fontawesome]',
				array(
					'section' => 'spacious_social_links_options',
					'setting' => 'spacious[' . $key . '_fontawesome]',
				)
			)
		);

		// icons color.
		$wp_customize->add_setting(
			'spacious[' . $key . '_color]',
			array(
				'default'              => '',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[' . $key . '_color]',
				array(
					'label'   => esc_html__( 'Add color for icon.', 'spacious' ),
					'section' => 'spacious_social_links_options',
					'setting' => 'spacious[' . $key . '_color]',
				)
			)
		);

		// adding social open in new page tab setting.
		$wp_customize->add_setting(
			'spacious[' . $key . 'new_tab]',
			array(
				'default'           => 0,
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_checkbox_sanitize',
			)
		);

		$wp_customize->add_control(
			'spacious[' . $key . 'new_tab]',
			array(
				'type'    => 'checkbox',
				'label'   => esc_html__( 'Check to show in new tab', 'spacious' ),
				'section' => 'spacious_social_links_options',
				'setting' => 'spacious[' . $key . 'new_tab]',
			)
		);

		$i++;

	}
	// End of Social Links Options.

	/**************************************Start of the Additional Options**************************************/

	$wp_customize->add_panel(
		'spacious_additional_options',
		array(
			'capabitity' => 'edit_theme_options',
			'priority'   => 540,
			'title'      => esc_html__( 'Additional', 'spacious' ),
		)
	);

	// End of Additional Options.
	/***************************************Start of the Typography Option**************************************/

	$wp_customize->add_panel(
		'spacious_typography_options',
		array(
			'priority'   => 550,
			'title'      => esc_html__( 'Typography', 'spacious' ),
			'capability' => 'edit_theme_options',
		)
	);

	// Font family options.
	$wp_customize->add_section(
		'spacious_google_fonts_settings',
		array(
			'priority' => 1,
			'title'    => esc_html__( 'Google Font Options', 'spacious' ),
			'panel'    => 'spacious_typography_options',
		)
	);

	// End of the Typography Options.

	/**************************************Start of the WooCommerce Options*************************************/

	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {

		// woocommerce archive page layout.
		$wp_customize->add_section(
			'spacious_woocommerce_page_layout_setting',
			array(
				'priority' => 1,
				'title'    => esc_html__( 'Sidebar', 'spacious' ),
				'panel'    => 'woocommerce',
			)
		);

		// Heading for Woocommerce sidebar layout.
		$wp_customize->add_setting(
			'spacious[woocommerce_sidebar_layout_heading]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Heading_Control(
				$wp_customize,
				'woocommerce_sidebar_layout_heading',
				array(
					'label'    => esc_html__( 'Archive Page Layout', 'spacious' ),
					'section'  => 'spacious_woocommerce_page_layout_setting',
					'settings' => 'spacious[woocommerce_sidebar_layout_heading]',
				)
			)
		);

		$wp_customize->add_setting(
			'spacious[spacious_woo_archive_layout]',
			array(
				'default'           => 'no_sidebar_full_width',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_radio_sanitize',
			)
		);

		$wp_customize->add_control(
			new Spacious_Image_Radio_Control(
				$wp_customize,
				'spacious[spacious_woo_archive_layout]',
				array(
					'type'     => 'radio',
					'label'    => esc_html__( 'This layout will be reflected in woocommerce archive page only.', 'spacious' ),
					'section'  => 'spacious_woocommerce_page_layout_setting',
					'settings' => 'spacious[spacious_woo_archive_layout]',
					'choices'  => array(
						'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
						'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
						'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
						'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				)
			)
		);

		// Heading for Woocommerce product page layout.
		$wp_customize->add_setting(
			'spacious[woocommerce_product_sidebar_layout_heading]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Heading_Control(
				$wp_customize,
				'woocommerce_product_sidebar_layout_heading',
				array(
					'label'    => esc_html__( 'Product Page Layout', 'spacious' ),
					'section'  => 'spacious_woocommerce_page_layout_setting',
					'settings' => 'spacious[woocommerce_product_sidebar_layout_heading]',
				)
			)
		);

		$wp_customize->add_setting(
			'spacious[spacious_woo_product_layout]',
			array(
				'default'           => 'no_sidebar_full_width',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_radio_sanitize',
			)
		);

		$wp_customize->add_control(
			new Spacious_Image_Radio_Control(
				$wp_customize,
				'spacious[spacious_woo_product_layout]',
				array(
					'type'     => 'radio',
					'label'    => esc_html__( 'This layout will be reflected in woocommerce Product page.', 'spacious' ),
					'section'  => 'spacious_woocommerce_page_layout_setting',
					'settings' => 'spacious[spacious_woo_product_layout]',
					'choices'  => array(
						'right_sidebar'               => SPACIOUS_ADMIN_IMAGES_URL . '/right-sidebar.png',
						'left_sidebar'                => SPACIOUS_ADMIN_IMAGES_URL . '/left-sidebar.png',
						'no_sidebar_full_width'       => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-full-width-layout.png',
						'no_sidebar_content_centered' => SPACIOUS_ADMIN_IMAGES_URL . '/no-sidebar-content-centered-layout.png',
					),
				)
			)
		);

		// Woocommerce sale design.
		$wp_customize->add_section(
			'spacious_woocommerce_button_design',
			array(
				'priority' => 2,
				'title'    => esc_html__( 'Design', 'spacious' ),
				'panel'    => 'woocommerce',
			)
		);

		// Heading for Woocommerce cart icon.
		$wp_customize->add_setting(
			'spacious[woocommerce_cart_icon_heading]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Heading_Control(
				$wp_customize,
				'woocommerce_cart_icon_heading',
				array(
					'label'    => esc_html__( 'Cart Icon', 'spacious' ),
					'section'  => 'spacious_woocommerce_button_design',
					'settings' => 'spacious[woocommerce_cart_icon_heading]',
				)
			)
		);

		// Setting: WooCommerce cart icon.
		$wp_customize->add_setting(
			'spacious[spacious_cart_icon]',
			array(
				'default'           => 0,
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_checkbox_sanitize',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_cart_icon]',
			array(
				'type'     => 'checkbox',
				'label'    => esc_html__( 'Check to show WooCommerce cart icon on menu bar', 'spacious' ),
				'section'  => 'spacious_woocommerce_button_design',
				'settings' => 'spacious[spacious_cart_icon]',
			)
		);

		// Heading for Woocommerce sale design.
		$wp_customize->add_setting(
			'spacious[woocommerce_sale_heading]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Heading_Control(
				$wp_customize,
				'woocommerce_sale_heading',
				array(
					'label'    => esc_html__( 'Sale Design', 'spacious' ),
					'section'  => 'spacious_woocommerce_button_design',
					'settings' => 'spacious[woocommerce_sale_heading]',
				)
			)
		);

		$wp_customize->add_setting(
			'spacious[spacious_woocommerce_sale_design_setting]',
			array(
				'default'           => 'woocommerce-sale-style-default',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_radio_sanitize',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_woocommerce_sale_design_setting]',
			array(
				'type'    => 'select',
				'label'   => esc_html__( 'Choose the WooCommerce sale batch design.', 'spacious' ),
				'setting' => 'spacious[spacious_woocommerce_sale_design_setting]',
				'section' => 'spacious_woocommerce_button_design',
				'choices' => array(
					'woocommerce-sale-style-default' => esc_html__( 'Default', 'spacious' ),
					'woocommerce-sale-style-1'       => esc_html__( 'Style 1', 'spacious' ),
					'woocommerce-sale-style-2'       => esc_html__( 'Style 2', 'spacious' ),
					'woocommerce-sale-style-3'       => esc_html__( 'Style 3', 'spacious' ),
				),
			)
		);

		// Heading for Woocommerce sale design.
		$wp_customize->add_setting(
			'spacious[woocommerce_add_to_cart_heading]',
			array(
				'sanitize_callback' => false,
			)
		);

		$wp_customize->add_control(
			new Spacious_Heading_Control(
				$wp_customize,
				'woocommerce_add_to_cart_heading',
				array(
					'label'    => esc_html__( 'Add To Cart Design', 'spacious' ),
					'section'  => 'spacious_woocommerce_button_design',
					'settings' => 'spacious[woocommerce_add_to_cart_heading]',
				)
			)
		);


		$wp_customize->add_setting(
			'spacious[spacious_woocommerce_add_to_cart_design_setting]',
			array(
				'default'           => 'woocommerce-add-to-cart-default',
				'type'              => 'option',
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'spacious_radio_sanitize',
			)
		);

		$wp_customize->add_control(
			'spacious[spacious_woocommerce_add_to_cart_design_setting]',
			array(
				'type'    => 'select',
				'label'   => esc_html__( 'Choose the WooCommerce Add to Cart button design.', 'spacious' ),
				'setting' => 'spacious[spacious_woocommerce_add_to_cart_design_setting]',
				'section' => 'spacious_woocommerce_button_design',
				'choices' => array(
					'woocommerce-add-to-cart-default' => esc_html__( 'Default', 'spacious' ),
					'woocommerce-add-to-cart-style-1' => esc_html__( 'Style 1', 'spacious' ),
					'woocommerce-add-to-cart-style-2' => esc_html__( 'Style 2', 'spacious' ),
				),
			)
		);

		// Add to cart text color.
		$wp_customize->add_setting(
			'spacious[spacious_add_to_cart_text_color]',
			array(
				'default'              => '#ffffff',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[spacious_add_to_cart_text_color]',
				array(
					'label'   => esc_html__( 'Text Color', 'spacious' ),
					'section' => 'spacious_woocommerce_button_design',
					'setting' => 'spacious[spacious_add_to_cart_text_color]',
				)
			)
		);

		// Add to cart text hover color.
		$wp_customize->add_setting(
			'spacious[spacious_add_to_cart_text_hover_color]',
			array(
				'default'              => '#515151',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[spacious_add_to_cart_text_hover_color]',
				array(
					'label'   => esc_html__( 'Text Hover Color', 'spacious' ),
					'section' => 'spacious_woocommerce_button_design',
					'setting' => 'spacious[spacious_add_to_cart_text_hover_color]',
				)
			)
		);

		// Add to cart background color.
		$wp_customize->add_setting(
			'spacious[spacious_add_to_cart_background_color]',
			array(
				'default'              => '#0fbe7c',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[spacious_add_to_cart_background_color]',
				array(
					'label'           => esc_html__( 'Background Color', 'spacious' ),
					'section'         => 'spacious_woocommerce_button_design',
					'setting'         => 'spacious[spacious_add_to_cart_background_color]',
					'active_callback' => 'spacious_add_to_cart_layout',
				)
			)
		);

		// Add to cart background hover color.
		$wp_customize->add_setting(
			'spacious[spacious_add_to_cart_background_hover_color]',
			array(
				'default'              => '#0fbe7c',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[spacious_add_to_cart_background_hover_color]',
				array(
					'label'           => esc_html__( 'Background Hover Color', 'spacious' ),
					'section'         => 'spacious_woocommerce_button_design',
					'setting'         => 'spacious[spacious_add_to_cart_background_hover_color]',
					'active_callback' => 'spacious_add_to_cart_layout',
				)
			)
		);

		// Add to cart border color.
		$wp_customize->add_setting(
			'spacious[spacious_add_to_cart_border_color]',
			array(
				'default'              => '#0fbe7c',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[spacious_add_to_cart_border_color]',
				array(
					'label'           => esc_html__( 'Border Color', 'spacious' ),
					'section'         => 'spacious_woocommerce_button_design',
					'setting'         => 'spacious[spacious_add_to_cart_border_color]',
					'active_callback' => 'spacious_add_to_cart_layout',
				)
			)
		);

		// Add to cart border hover color.
		$wp_customize->add_setting(
			'spacious[spacious_add_to_cart_border_hover_color]',
			array(
				'default'              => '#0fbe7c',
				'type'                 => 'option',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'spacious_color_option_hex_sanitize',
				'sanitize_js_callback' => 'spacious_color_escaping_option_sanitize',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'spacious[spacious_add_to_cart_border_hover_color]',
				array(
					'label'           => esc_html__( 'Border Hover Color', 'spacious' ),
					'section'         => 'spacious_woocommerce_button_design',
					'setting'         => 'spacious[spacious_add_to_cart_border_hover_color]',
					'active_callback' => 'spacious_add_to_cart_layout',
				)
			)
		);

	}
	// End of the WooCommerce Options.

	// Google Font Sanitization.
	function spacious_font_sanitize( $input ) {
		$spacious_standard_fonts_array = spacious_standard_fonts_array();
		$spacious_google_fonts         = spacious_google_fonts();
		$valid_keys                    = array_merge( $spacious_standard_fonts_array, $spacious_google_fonts );

		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	// active callback for add to cart button.
	function spacious_add_to_cart_layout() {
		if ( spacious_options( 'spacious_woocommerce_add_to_cart_design_setting', 'woocommerce-add-to-cart-default' ) === 'woocommerce-add-to-cart-style-2' ) {
			return false;
		}

		return true;
	}

	// Active CallBack for column option.
	function spacious_blog_column_option() {
		if ( ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) === 'blog_masonry_content' ) || ( spacious_options( 'spacious_archive_display_type', 'blog_large' ) === 'blog_grid_content' ) ) {
			return true;
		}

		return false;
	}

	// Active CallBack for header sidebar toggle.
	function spacious_header_sidebar_toggle_option() {
		if ( spacious_options( 'spacious_togglable_header_sidebar_setting', 0 ) == 1 ) {
			return true;
		}

		return false;
	}

	// Active CallBack for search toggle.
	function spacious_search_toggle_option() {
		if ( spacious_options( 'spacious_header_search_icon', 0 ) == 1 ) {
			return true;
		}

		return false;
	}

	// Active Callback for Retina Logo.
	function spacious_retina_logo_option() {
		if ( spacious_options( 'spacious_different_retina_logo', 0 ) == 1 ) {
			return true;
		}

		return false;
	}

	// Radio and Select Sanitization
	function spacious_radio_sanitize( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// Slider radio sanitize.
	function spacious_slider_radio_sanitize( $input, $setting ) {
		// Ensuring that the input is a slug.
		$input = sanitize_text_field( $input );
		// Get the list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it, else, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	// checkbox sanitize.
	function spacious_checkbox_sanitize( $input ) {

		return ( ( isset( $input ) && $input == 1 ) ? 1 : '' );

	}

	// editor sanitization.
	function spacious_editor_sanitize( $input ) {
		if ( isset( $input ) ) {
			$input = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
		}

		return $input;
	}

	// Color sanitization.
	function spacious_color_option_hex_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
			return '#' . $unhashed;
		}

		return $color;
	}

	function spacious_color_escaping_option_sanitize( $input ) {
		$input = esc_attr( $input );

		return $input;
	}

	// text-area sanitize.
	function spacious_text_sanitize( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
	}

	// excerpt length sanitize.
	function spacious_excerpt_length_sanitize( $input, $setting ) {
		return ( is_numeric( $input ) ? intval( $input ) : $setting->default );
	}

	// slider transition delay time sanitize.
	function spacious_slider_transition_delay_sanitize( $input, $setting ) {
		return ( is_numeric( $input ) ? intval( $input ) : $setting->default );
	}

	// slider transition length sanitize.
	function spacious_slider_transition_length_sanitize( $input, $setting ) {
		return ( is_numeric( $input ) ? intval( $input ) : $setting->default );
	}

	// slider number sanitize.
	function spacious_slider_number_sanitize( $input, $setting ) {
		return ( is_numeric( $input ) ? intval( $input ) : $setting->default );
	}

	/**
	 * Check if the background image is set or not.
	 *
	 * @return bool
	 */
	function spacious_background_image() {
		$background_image = get_background_image();
		if ( $background_image ) {
			return true;
		}

		return false;
	}

	// footer section sanitization.
	function spacious_footer_editor_sanitize( $input ) {
		if ( isset( $input ) ) {
			$input = stripslashes( wp_filter_post_kses( addslashes( $input ) ) );
		}

		return $input;
	}

	// sanitization of links.
	function spacious_links_sanitize() {
		return false;
	}

	function spacious_sanitize_alpha_color( $color ) {

		if ( '' === $color ) {
			return '';
		}

		// Hex sanitize if no rgba color option is chosen.
		if ( false === strpos( $color, 'rgba' ) ) {
			return sanitize_hex_color( $color );
		}

		// Sanitize the rgba color provided via customize option.
		$color = str_replace( ' ', '', $color );
		sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';

	}
}

add_action( 'customize_register', 'spacious_customize_register' );

/*****************************************************************************************/

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function spacious_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function spacious_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render callback function for Read More text.
 */
function spacious_read_more_text_render() { ?>
	<a class="read-more"
	   href="<?php the_permalink(); ?>"><?php echo esc_html( spacious_options( 'spacious_read_more_text', __( 'Read more', 'spacious' ) ) ); ?></a>
<?php }

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Spacious 2.1.6
 */
function spacious_customize_preview_js() {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script(
		'spacious-customizer',
		get_template_directory_uri() . '/js/customizer' . $suffix . '.js',
		array( 'customize-preview' ),
		false,
		true
	);
}

add_action( 'customize_preview_init', 'spacious_customize_preview_js' );

/**
 * Enqueue customize controls scripts.
 */
function spacious_enqueue_customize_controls() {

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	/**
	 * Enqueue required Customize Controls CSS files.
	 */
	// Main CSS file.
	wp_enqueue_style(
		'spacious-customize-controls',
		get_template_directory_uri() . '/css/customize-controls' . $suffix . '.css',
		array(),
		false
	);

	/**
	 * Enqueue required Customize Controls JS files.
	 */
	// WP Color Picker Alpha JS library file.
	wp_enqueue_script(
		'wp-color-picker-alpha',
		get_template_directory_uri() . '/js/wp-color-picker-alpha' . $suffix . '.js',
		array(
			'wp-color-picker',
		),
		false,
		true
	);

	/**
	 * Color picker strings from WordPress.
	 *
	 * Added since WordPress 5.5 has removed them causing alpha color not appearing issue.
	 *
	 * @since 2.4.0
	 */
	if ( version_compare( $GLOBALS['wp_version'], '5.5', '>=' ) ) {
		wp_localize_script(
			'wp-color-picker',
			'wpColorPickerL10n',
			array(
				'clear'            => esc_html__( 'Clear', 'spacious' ),
				'clearAriaLabel'   => esc_html__( 'Clear color', 'spacious' ),
				'defaultString'    => esc_html__( 'Default', 'spacious' ),
				'defaultAriaLabel' => esc_html__( 'Select default color', 'spacious' ),
				'pick'             => esc_html__( 'Select Color', 'spacious' ),
				'defaultLabel'     => esc_html__( 'Color value', 'spacious' ),
			)
		);
	}

	wp_enqueue_script(
		'spacious-customize-controls',
		get_template_directory_uri() . '/js/customize-controls' . $suffix . '.js',
		array(
			'wp-color-picker',
		),
		false,
		true
	);
}

add_action( 'customize_controls_enqueue_scripts', 'spacious_enqueue_customize_controls' );

/**************************************************************************************/

if ( ! function_exists( 'spacious_font_size_range_generator' ) ) :
	/**
	 * Function to generate font size range for font size options.
	 */
	function spacious_font_size_range_generator( $start_range, $end_range ) {
		$range_string = array();
		for ( $i = $start_range; $i <= $end_range; $i++ ) {
			$range_string[ $i ] = $i;
		}

		return $range_string;
	}
endif;

if ( ! function_exists( 'spacious_standard_fonts_array' ) ) :

	/**
	 * Standard Fonts array.
	 *
	 * @return array of Standarad Fonts.
	 */
	function spacious_standard_fonts_array() {
		$spacious_standard_fonts = array(
			'Georgia,Times,"Times New Roman",serif'                                                                                                 => 'serif',
			'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif' => 'sans-serif',
			'Monaco,"Lucida Sans Typewriter","Lucida Typewriter","Courier New",Courier,monospace'                                                   => 'monospace',
		);

		return $spacious_standard_fonts;
	}

endif;

if ( ! function_exists( 'spacious_google_fonts' ) ) :

	/**
	 * Google Fonts array.
	 *
	 * @return array of Google Fonts.
	 */
	function spacious_google_fonts() {
		$spacious_google_font = array(
			'ABeeZee'                   => 'ABeeZee',
			'Abel'                      => 'Abel',
			'Abhaya Libre'              => 'Abhaya Libre',
			'Abril Fatface'             => 'Abril Fatface',
			'Aclonica'                  => 'Aclonica',
			'Acme'                      => 'Acme',
			'Actor'                     => 'Actor',
			'Adamina'                   => 'Adamina',
			'Advent Pro'                => 'Advent Pro',
			'Aguafina Script'           => 'Aguafina Script',
			'Akronim'                   => 'Akronim',
			'Aladin'                    => 'Aladin',
			'Aldrich'                   => 'Aldrich',
			'Alef'                      => 'Alef',
			'Alegreya'                  => 'Alegreya',
			'Alegreya SC'               => 'Alegreya SC',
			'Alegreya Sans'             => 'Alegreya Sans',
			'Alegreya Sans SC'          => 'Alegreya Sans SC',
			'Alex Brush'                => 'Alex Brush',
			'Alfa Slab One'             => 'Alfa Slab One',
			'Alice'                     => 'Alice',
			'Alike'                     => 'Alike',
			'Alike Angular'             => 'Alike Angular',
			'Allan'                     => 'Allan',
			'Allerta'                   => 'Allerta',
			'Allerta Stencil'           => 'Allerta Stencil',
			'Allura'                    => 'Allura',
			'Almendra'                  => 'Almendra',
			'Almendra Display'          => 'Almendra Display',
			'Almendra SC'               => 'Almendra SC',
			'Amarante'                  => 'Amarante',
			'Amaranth'                  => 'Amaranth',
			'Amatic SC'                 => 'Amatic SC',
			'Amatica SC'                => 'Amatica SC',
			'Amethysta'                 => 'Amethysta',
			'Amiko'                     => 'Amiko',
			'Amiri'                     => 'Amiri',
			'Amita'                     => 'Amita',
			'Anaheim'                   => 'Anaheim',
			'Andada'                    => 'Andada',
			'Andika'                    => 'Andika',
			'Angkor'                    => 'Angkor',
			'Annie Use Your Telescope'  => 'Annie Use Your Telescope',
			'Anonymous Pro'             => 'Anonymous Pro',
			'Antic'                     => 'Antic',
			'Antic Didone'              => 'Antic Didone',
			'Antic Slab'                => 'Antic Slab',
			'Anton'                     => 'Anton',
			'Arapey'                    => 'Arapey',
			'Arbutus'                   => 'Arbutus',
			'Arbutus Slab'              => 'Arbutus Slab',
			'Architects Daughter'       => 'Architects Daughter',
			'Archivo Black'             => 'Archivo Black',
			'Archivo Narrow'            => 'Archivo Narrow',
			'Aref Ruqaa'                => 'Aref Ruqaa',
			'Arima Madurai'             => 'Arima Madurai',
			'Arimo'                     => 'Arimo',
			'Arizonia'                  => 'Arizonia',
			'Armata'                    => 'Armata',
			'Arsenal'                   => 'Arsenal',
			'Artifika'                  => 'Artifika',
			'Arvo'                      => 'Arvo',
			'Arya'                      => 'Arya',
			'Asap'                      => 'Asap',
			'Asar'                      => 'Asar',
			'Asset'                     => 'Asset',
			'Assistant'                 => 'Assistant',
			'Astloch'                   => 'Astloch',
			'Asul'                      => 'Asul',
			'Athiti'                    => 'Athiti',
			'Atma'                      => 'Atma',
			'Atomic Age'                => 'Atomic Age',
			'Aubrey'                    => 'Aubrey',
			'Audiowide'                 => 'Audiowide',
			'Autour One'                => 'Autour One',
			'Average'                   => 'Average',
			'Average Sans'              => 'Average Sans',
			'Averia Gruesa Libre'       => 'Averia Gruesa Libre',
			'Averia Libre'              => 'Averia Libre',
			'Averia Sans Libre'         => 'Averia Sans Libre',
			'Averia Serif Libre'        => 'Averia Serif Libre',
			'Bad Script'                => 'Bad Script',
			'Bahiana'                   => 'Bahiana',
			'Baloo'                     => 'Baloo',
			'Baloo Bhai'                => 'Baloo Bhai',
			'Baloo Bhaina'              => 'Baloo Bhaina',
			'Baloo Chettan'             => 'Baloo Chettan',
			'Baloo Da'                  => 'Baloo Da',
			'Baloo Paaji'               => 'Baloo Paaji',
			'Baloo Tamma'               => 'Baloo Tamma',
			'Baloo Thambi'              => 'Baloo Thambi',
			'Balthazar'                 => 'Balthazar',
			'Bangers'                   => 'Bangers',
			'Barrio'                    => 'Barrio',
			'Basic'                     => 'Basic',
			'Battambang'                => 'Battambang',
			'Baumans'                   => 'Baumans',
			'Bayon'                     => 'Bayon',
			'Belgrano'                  => 'Belgrano',
			'Belleza'                   => 'Belleza',
			'BenchNine'                 => 'BenchNine',
			'Bentham'                   => 'Bentham',
			'Berkshire Swash'           => 'Berkshire Swash',
			'Bevan'                     => 'Bevan',
			'Bigelow Rules'             => 'Bigelow Rules',
			'Bigshot One'               => 'Bigshot One',
			'Bilbo'                     => 'Bilbo',
			'Bilbo Swash Caps'          => 'Bilbo Swash Caps',
			'BioRhyme'                  => 'BioRhyme',
			'BioRhyme Expanded'         => 'BioRhyme Expanded',
			'Biryani'                   => 'Biryani',
			'Bitter'                    => 'Bitter',
			'Black Ops One'             => 'Black Ops One',
			'Bokor'                     => 'Bokor',
			'Bonbon'                    => 'Bonbon',
			'Boogaloo'                  => 'Boogaloo',
			'Bowlby One'                => 'Bowlby One',
			'Bowlby One SC'             => 'Bowlby One SC',
			'Brawler'                   => 'Brawler',
			'Bree Serif'                => 'Bree Serif',
			'Bubblegum Sans'            => 'Bubblegum Sans',
			'Bubbler One'               => 'Bubbler One',
			'Buda'                      => 'Buda',
			'Buenard'                   => 'Buenard',
			'Bungee'                    => 'Bungee',
			'Bungee Hairline'           => 'Bungee Hairline',
			'Bungee Inline'             => 'Bungee Inline',
			'Bungee Outline'            => 'Bungee Outline',
			'Bungee Shade'              => 'Bungee Shade',
			'Butcherman'                => 'Butcherman',
			'Butterfly Kids'            => 'Butterfly Kids',
			'Cabin'                     => 'Cabin',
			'Cabin Condensed'           => 'Cabin Condensed',
			'Cabin Sketch'              => 'Cabin Sketch',
			'Caesar Dressing'           => 'Caesar Dressing',
			'Cagliostro'                => 'Cagliostro',
			'Cairo'                     => 'Cairo',
			'Calligraffitti'            => 'Calligraffitti',
			'Cambay'                    => 'Cambay',
			'Cambo'                     => 'Cambo',
			'Candal'                    => 'Candal',
			'Cantarell'                 => 'Cantarell',
			'Cantata One'               => 'Cantata One',
			'Cantora One'               => 'Cantora One',
			'Capriola'                  => 'Capriola',
			'Cardo'                     => 'Cardo',
			'Carme'                     => 'Carme',
			'Carrois Gothic'            => 'Carrois Gothic',
			'Carrois Gothic SC'         => 'Carrois Gothic SC',
			'Carter One'                => 'Carter One',
			'Catamaran'                 => 'Catamaran',
			'Caudex'                    => 'Caudex',
			'Caveat'                    => 'Caveat',
			'Caveat Brush'              => 'Caveat Brush',
			'Cedarville Cursive'        => 'Cedarville Cursive',
			'Ceviche One'               => 'Ceviche One',
			'Changa'                    => 'Changa',
			'Changa One'                => 'Changa One',
			'Chango'                    => 'Chango',
			'Chathura'                  => 'Chathura',
			'Chau Philomene One'        => 'Chau Philomene One',
			'Chela One'                 => 'Chela One',
			'Chelsea Market'            => 'Chelsea Market',
			'Chenla'                    => 'Chenla',
			'Cherry Cream Soda'         => 'Cherry Cream Soda',
			'Cherry Swash'              => 'Cherry Swash',
			'Chewy'                     => 'Chewy',
			'Chicle'                    => 'Chicle',
			'Chivo'                     => 'Chivo',
			'Chonburi'                  => 'Chonburi',
			'Cinzel'                    => 'Cinzel',
			'Cinzel Decorative'         => 'Cinzel Decorative',
			'Clicker Script'            => 'Clicker Script',
			'Coda'                      => 'Coda',
			'Coda Caption'              => 'Coda Caption',
			'Codystar'                  => 'Codystar',
			'Coiny'                     => 'Coiny',
			'Combo'                     => 'Combo',
			'Comfortaa'                 => 'Comfortaa',
			'Coming Soon'               => 'Coming Soon',
			'Concert One'               => 'Concert One',
			'Condiment'                 => 'Condiment',
			'Content'                   => 'Content',
			'Contrail One'              => 'Contrail One',
			'Convergence'               => 'Convergence',
			'Cookie'                    => 'Cookie',
			'Copse'                     => 'Copse',
			'Corben'                    => 'Corben',
			'Cormorant'                 => 'Cormorant',
			'Cormorant Garamond'        => 'Cormorant Garamond',
			'Cormorant Infant'          => 'Cormorant Infant',
			'Cormorant SC'              => 'Cormorant SC',
			'Cormorant Unicase'         => 'Cormorant Unicase',
			'Cormorant Upright'         => 'Cormorant Upright',
			'Courgette'                 => 'Courgette',
			'Cousine'                   => 'Cousine',
			'Coustard'                  => 'Coustard',
			'Covered By Your Grace'     => 'Covered By Your Grace',
			'Crafty Girls'              => 'Crafty Girls',
			'Creepster'                 => 'Creepster',
			'Crete Round'               => 'Crete Round',
			'Crimson Text'              => 'Crimson Text',
			'Croissant One'             => 'Croissant One',
			'Crushed'                   => 'Crushed',
			'Cuprum'                    => 'Cuprum',
			'Cutive'                    => 'Cutive',
			'Cutive Mono'               => 'Cutive Mono',
			'Damion'                    => 'Damion',
			'Dancing Script'            => 'Dancing Script',
			'Dangrek'                   => 'Dangrek',
			'David Libre'               => 'David Libre',
			'Dawning of a New Day'      => 'Dawning of a New Day',
			'Days One'                  => 'Days One',
			'Dekko'                     => 'Dekko',
			'Delius'                    => 'Delius',
			'Delius Swash Caps'         => 'Delius Swash Caps',
			'Delius Unicase'            => 'Delius Unicase',
			'Della Respira'             => 'Della Respira',
			'Denk One'                  => 'Denk One',
			'Devonshire'                => 'Devonshire',
			'Dhurjati'                  => 'Dhurjati',
			'Didact Gothic'             => 'Didact Gothic',
			'Diplomata'                 => 'Diplomata',
			'Diplomata SC'              => 'Diplomata SC',
			'Domine'                    => 'Domine',
			'Donegal One'               => 'Donegal One',
			'Doppio One'                => 'Doppio One',
			'Dorsa'                     => 'Dorsa',
			'Dosis'                     => 'Dosis',
			'Dr Sugiyama'               => 'Dr Sugiyama',
			'Droid Sans'                => 'Droid Sans',
			'Droid Sans Mono'           => 'Droid Sans Mono',
			'Droid Serif'               => 'Droid Serif',
			'Duru Sans'                 => 'Duru Sans',
			'Dynalight'                 => 'Dynalight',
			'EB Garamond'               => 'EB Garamond',
			'Eagle Lake'                => 'Eagle Lake',
			'Eater'                     => 'Eater',
			'Economica'                 => 'Economica',
			'Eczar'                     => 'Eczar',
			'Ek Mukta'                  => 'Ek Mukta',
			'El Messiri'                => 'El Messiri',
			'Electrolize'               => 'Electrolize',
			'Elsie'                     => 'Elsie',
			'Elsie Swash Caps'          => 'Elsie Swash Caps',
			'Emblema One'               => 'Emblema One',
			'Emilys Candy'              => 'Emilys Candy',
			'Engagement'                => 'Engagement',
			'Englebert'                 => 'Englebert',
			'Enriqueta'                 => 'Enriqueta',
			'Erica One'                 => 'Erica One',
			'Esteban'                   => 'Esteban',
			'Euphoria Script'           => 'Euphoria Script',
			'Ewert'                     => 'Ewert',
			'Exo'                       => 'Exo',
			'Exo 2'                     => 'Exo 2',
			'Expletus Sans'             => 'Expletus Sans',
			'Fanwood Text'              => 'Fanwood Text',
			'Farsan'                    => 'Farsan',
			'Fascinate'                 => 'Fascinate',
			'Fascinate Inline'          => 'Fascinate Inline',
			'Faster One'                => 'Faster One',
			'Fasthand'                  => 'Fasthand',
			'Fauna One'                 => 'Fauna One',
			'Federant'                  => 'Federant',
			'Federo'                    => 'Federo',
			'Felipa'                    => 'Felipa',
			'Fenix'                     => 'Fenix',
			'Finger Paint'              => 'Finger Paint',
			'Fira Mono'                 => 'Fira Mono',
			'Fira Sans'                 => 'Fira Sans',
			'Fira Sans Condensed'       => 'Fira Sans Condensed',
			'Fira Sans Extra Condensed' => 'Fira Sans Extra Condensed',
			'Fjalla One'                => 'Fjalla One',
			'Fjord One'                 => 'Fjord One',
			'Flamenco'                  => 'Flamenco',
			'Flavors'                   => 'Flavors',
			'Fondamento'                => 'Fondamento',
			'Fontdiner Swanky'          => 'Fontdiner Swanky',
			'Forum'                     => 'Forum',
			'Francois One'              => 'Francois One',
			'Frank Ruhl Libre'          => 'Frank Ruhl Libre',
			'Freckle Face'              => 'Freckle Face',
			'Fredericka the Great'      => 'Fredericka the Great',
			'Fredoka One'               => 'Fredoka One',
			'Freehand'                  => 'Freehand',
			'Fresca'                    => 'Fresca',
			'Frijole'                   => 'Frijole',
			'Fruktur'                   => 'Fruktur',
			'Fugaz One'                 => 'Fugaz One',
			'GFS Didot'                 => 'GFS Didot',
			'GFS Neohellenic'           => 'GFS Neohellenic',
			'Gabriela'                  => 'Gabriela',
			'Gafata'                    => 'Gafata',
			'Galada'                    => 'Galada',
			'Galdeano'                  => 'Galdeano',
			'Galindo'                   => 'Galindo',
			'Gentium Basic'             => 'Gentium Basic',
			'Gentium Book Basic'        => 'Gentium Book Basic',
			'Geo'                       => 'Geo',
			'Geostar'                   => 'Geostar',
			'Geostar Fill'              => 'Geostar Fill',
			'Germania One'              => 'Germania One',
			'Gidugu'                    => 'Gidugu',
			'Gilda Display'             => 'Gilda Display',
			'Give You Glory'            => 'Give You Glory',
			'Glass Antiqua'             => 'Glass Antiqua',
			'Glegoo'                    => 'Glegoo',
			'Gloria Hallelujah'         => 'Gloria Hallelujah',
			'Goblin One'                => 'Goblin One',
			'Gochi Hand'                => 'Gochi Hand',
			'Gorditas'                  => 'Gorditas',
			'Goudy Bookletter 1911'     => 'Goudy Bookletter 1911',
			'Graduate'                  => 'Graduate',
			'Grand Hotel'               => 'Grand Hotel',
			'Gravitas One'              => 'Gravitas One',
			'Great Vibes'               => 'Great Vibes',
			'Griffy'                    => 'Griffy',
			'Gruppo'                    => 'Gruppo',
			'Gudea'                     => 'Gudea',
			'Gurajada'                  => 'Gurajada',
			'Habibi'                    => 'Habibi',
			'Halant'                    => 'Halant',
			'Hammersmith One'           => 'Hammersmith One',
			'Hanalei'                   => 'Hanalei',
			'Hanalei Fill'              => 'Hanalei Fill',
			'Handlee'                   => 'Handlee',
			'Hanuman'                   => 'Hanuman',
			'Happy Monkey'              => 'Happy Monkey',
			'Harmattan'                 => 'Harmattan',
			'Headland One'              => 'Headland One',
			'Heebo'                     => 'Heebo',
			'Henny Penny'               => 'Henny Penny',
			'Herr Von Muellerhoff'      => 'Herr Von Muellerhoff',
			'Hind'                      => 'Hind',
			'Hind Guntur'               => 'Hind Guntur',
			'Hind Madurai'              => 'Hind Madurai',
			'Hind Siliguri'             => 'Hind Siliguri',
			'Hind Vadodara'             => 'Hind Vadodara',
			'Holtwood One SC'           => 'Holtwood One SC',
			'Homemade Apple'            => 'Homemade Apple',
			'Homenaje'                  => 'Homenaje',
			'IM Fell DW Pica'           => 'IM Fell DW Pica',
			'IM Fell DW Pica SC'        => 'IM Fell DW Pica SC',
			'IM Fell Double Pica'       => 'IM Fell Double Pica',
			'IM Fell Double Pica SC'    => 'IM Fell Double Pica SC',
			'IM Fell English'           => 'IM Fell English',
			'IM Fell English SC'        => 'IM Fell English SC',
			'IM Fell French Canon'      => 'IM Fell French Canon',
			'IM Fell French Canon SC'   => 'IM Fell French Canon SC',
			'IM Fell Great Primer'      => 'IM Fell Great Primer',
			'IM Fell Great Primer SC'   => 'IM Fell Great Primer SC',
			'Iceberg'                   => 'Iceberg',
			'Iceland'                   => 'Iceland',
			'Imprima'                   => 'Imprima',
			'Inconsolata'               => 'Inconsolata',
			'Inder'                     => 'Inder',
			'Indie Flower'              => 'Indie Flower',
			'Inika'                     => 'Inika',
			'Inknut Antiqua'            => 'Inknut Antiqua',
			'Irish Grover'              => 'Irish Grover',
			'Istok Web'                 => 'Istok Web',
			'Italiana'                  => 'Italiana',
			'Italianno'                 => 'Italianno',
			'Itim'                      => 'Itim',
			'Jacques Francois'          => 'Jacques Francois',
			'Jacques Francois Shadow'   => 'Jacques Francois Shadow',
			'Jaldi'                     => 'Jaldi',
			'Jim Nightshade'            => 'Jim Nightshade',
			'Jockey One'                => 'Jockey One',
			'Jolly Lodger'              => 'Jolly Lodger',
			'Jomhuria'                  => 'Jomhuria',
			'Josefin Sans'              => 'Josefin Sans',
			'Josefin Slab'              => 'Josefin Slab',
			'Joti One'                  => 'Joti One',
			'Judson'                    => 'Judson',
			'Julee'                     => 'Julee',
			'Julius Sans One'           => 'Julius Sans One',
			'Junge'                     => 'Junge',
			'Jura'                      => 'Jura',
			'Just Another Hand'         => 'Just Another Hand',
			'Just Me Again Down Here'   => 'Just Me Again Down Here',
			'Kadwa'                     => 'Kadwa',
			'Kalam'                     => 'Kalam',
			'Kameron'                   => 'Kameron',
			'Kanit'                     => 'Kanit',
			'Kantumruy'                 => 'Kantumruy',
			'Karla'                     => 'Karla',
			'Karma'                     => 'Karma',
			'Katibeh'                   => 'Katibeh',
			'Kaushan Script'            => 'Kaushan Script',
			'Kavivanar'                 => 'Kavivanar',
			'Kavoon'                    => 'Kavoon',
			'Kdam Thmor'                => 'Kdam Thmor',
			'Keania One'                => 'Keania One',
			'Kelly Slab'                => 'Kelly Slab',
			'Kenia'                     => 'Kenia',
			'Khand'                     => 'Khand',
			'Khmer'                     => 'Khmer',
			'Khula'                     => 'Khula',
			'Kite One'                  => 'Kite One',
			'Knewave'                   => 'Knewave',
			'Kotta One'                 => 'Kotta One',
			'Koulen'                    => 'Koulen',
			'Kranky'                    => 'Kranky',
			'Kreon'                     => 'Kreon',
			'Kristi'                    => 'Kristi',
			'Krona One'                 => 'Krona One',
			'Kumar One'                 => 'Kumar One',
			'Kumar One Outline'         => 'Kumar One Outline',
			'Kurale'                    => 'Kurale',
			'La Belle Aurore'           => 'La Belle Aurore',
			'Laila'                     => 'Laila',
			'Lakki Reddy'               => 'Lakki Reddy',
			'Lalezar'                   => 'Lalezar',
			'Lancelot'                  => 'Lancelot',
			'Lateef'                    => 'Lateef',
			'Lato'                      => 'Lato',
			'League Script'             => 'League Script',
			'Leckerli One'              => 'Leckerli One',
			'Ledger'                    => 'Ledger',
			'Lekton'                    => 'Lekton',
			'Lemon'                     => 'Lemon',
			'Lemonada'                  => 'Lemonada',
			'Libre Baskerville'         => 'Libre Baskerville',
			'Libre Franklin'            => 'Libre Franklin',
			'Life Savers'               => 'Life Savers',
			'Lilita One'                => 'Lilita One',
			'Lily Script One'           => 'Lily Script One',
			'Limelight'                 => 'Limelight',
			'Linden Hill'               => 'Linden Hill',
			'Lobster'                   => 'Lobster',
			'Lobster Two'               => 'Lobster Two',
			'Londrina Outline'          => 'Londrina Outline',
			'Londrina Shadow'           => 'Londrina Shadow',
			'Londrina Sketch'           => 'Londrina Sketch',
			'Londrina Solid'            => 'Londrina Solid',
			'Lora'                      => 'Lora',
			'Love Ya Like A Sister'     => 'Love Ya Like A Sister',
			'Loved by the King'         => 'Loved by the King',
			'Lovers Quarrel'            => 'Lovers Quarrel',
			'Luckiest Guy'              => 'Luckiest Guy',
			'Lusitana'                  => 'Lusitana',
			'Lustria'                   => 'Lustria',
			'Macondo'                   => 'Macondo',
			'Macondo Swash Caps'        => 'Macondo Swash Caps',
			'Mada'                      => 'Mada',
			'Magra'                     => 'Magra',
			'Maiden Orange'             => 'Maiden Orange',
			'Maitree'                   => 'Maitree',
			'Mako'                      => 'Mako',
			'Mallanna'                  => 'Mallanna',
			'Mandali'                   => 'Mandali',
			'Marcellus'                 => 'Marcellus',
			'Marcellus SC'              => 'Marcellus SC',
			'Marck Script'              => 'Marck Script',
			'Margarine'                 => 'Margarine',
			'Marko One'                 => 'Marko One',
			'Marmelad'                  => 'Marmelad',
			'Martel'                    => 'Martel',
			'Martel Sans'               => 'Martel Sans',
			'Marvel'                    => 'Marvel',
			'Mate'                      => 'Mate',
			'Mate SC'                   => 'Mate SC',
			'Maven Pro'                 => 'Maven Pro',
			'McLaren'                   => 'McLaren',
			'Meddon'                    => 'Meddon',
			'MedievalSharp'             => 'MedievalSharp',
			'Medula One'                => 'Medula One',
			'Meera Inimai'              => 'Meera Inimai',
			'Megrim'                    => 'Megrim',
			'Meie Script'               => 'Meie Script',
			'Merienda'                  => 'Merienda',
			'Merienda One'              => 'Merienda One',
			'Merriweather'              => 'Merriweather',
			'Merriweather Sans'         => 'Merriweather Sans',
			'Metal'                     => 'Metal',
			'Metal Mania'               => 'Metal Mania',
			'Metamorphous'              => 'Metamorphous',
			'Metrophobic'               => 'Metrophobic',
			'Michroma'                  => 'Michroma',
			'Milonga'                   => 'Milonga',
			'Miltonian'                 => 'Miltonian',
			'Miltonian Tattoo'          => 'Miltonian Tattoo',
			'Miniver'                   => 'Miniver',
			'Miriam Libre'              => 'Miriam Libre',
			'Mirza'                     => 'Mirza',
			'Miss Fajardose'            => 'Miss Fajardose',
			'Mitr'                      => 'Mitr',
			'Modak'                     => 'Modak',
			'Modern Antiqua'            => 'Modern Antiqua',
			'Mogra'                     => 'Mogra',
			'Molengo'                   => 'Molengo',
			'Molle'                     => 'Molle',
			'Monda'                     => 'Monda',
			'Monofett'                  => 'Monofett',
			'Monoton'                   => 'Monoton',
			'Monsieur La Doulaise'      => 'Monsieur La Doulaise',
			'Montaga'                   => 'Montaga',
			'Montez'                    => 'Montez',
			'Montserrat'                => 'Montserrat',
			'Montserrat Alternates'     => 'Montserrat Alternates',
			'Montserrat Subrayada'      => 'Montserrat Subrayada',
			'Moul'                      => 'Moul',
			'Moulpali'                  => 'Moulpali',
			'Mountains of Christmas'    => 'Mountains of Christmas',
			'Mouse Memoirs'             => 'Mouse Memoirs',
			'Mr Bedfort'                => 'Mr Bedfort',
			'Mr Dafoe'                  => 'Mr Dafoe',
			'Mr De Haviland'            => 'Mr De Haviland',
			'Mrs Saint Delafield'       => 'Mrs Saint Delafield',
			'Mrs Sheppards'             => 'Mrs Sheppards',
			'Mukta Vaani'               => 'Mukta Vaani',
			'Muli'                      => 'Muli',
			'Mystery Quest'             => 'Mystery Quest',
			'NTR'                       => 'NTR',
			'Neucha'                    => 'Neucha',
			'Neuton'                    => 'Neuton',
			'New Rocker'                => 'New Rocker',
			'News Cycle'                => 'News Cycle',
			'Niconne'                   => 'Niconne',
			'Nixie One'                 => 'Nixie One',
			'Nobile'                    => 'Nobile',
			'Nokora'                    => 'Nokora',
			'Norican'                   => 'Norican',
			'Nosifer'                   => 'Nosifer',
			'Nothing You Could Do'      => 'Nothing You Could Do',
			'Noticia Text'              => 'Noticia Text',
			'Noto Sans'                 => 'Noto Sans',
			'Noto Serif'                => 'Noto Serif',
			'Nova Cut'                  => 'Nova Cut',
			'Nova Flat'                 => 'Nova Flat',
			'Nova Mono'                 => 'Nova Mono',
			'Nova Oval'                 => 'Nova Oval',
			'Nova Round'                => 'Nova Round',
			'Nova Script'               => 'Nova Script',
			'Nova Slim'                 => 'Nova Slim',
			'Nova Square'               => 'Nova Square',
			'Numans'                    => 'Numans',
			'Nunito'                    => 'Nunito',
			'Nunito Sans'               => 'Nunito Sans',
			'Odor Mean Chey'            => 'Odor Mean Chey',
			'Offside'                   => 'Offside',
			'Old Standard TT'           => 'Old Standard TT',
			'Oldenburg'                 => 'Oldenburg',
			'Oleo Script'               => 'Oleo Script',
			'Oleo Script Swash Caps'    => 'Oleo Script Swash Caps',
			'Open Sans'                 => 'Open Sans',
			'Open Sans Condensed'       => 'Open Sans Condensed',
			'Oranienbaum'               => 'Oranienbaum',
			'Orbitron'                  => 'Orbitron',
			'Oregano'                   => 'Oregano',
			'Orienta'                   => 'Orienta',
			'Original Surfer'           => 'Original Surfer',
			'Oswald'                    => 'Oswald',
			'Over the Rainbow'          => 'Over the Rainbow',
			'Overlock'                  => 'Overlock',
			'Overlock SC'               => 'Overlock SC',
			'Overpass'                  => 'Overpass',
			'Overpass Mono'             => 'Overpass Mono',
			'Ovo'                       => 'Ovo',
			'Oxygen'                    => 'Oxygen',
			'Oxygen Mono'               => 'Oxygen Mono',
			'PT Mono'                   => 'PT Mono',
			'PT Sans'                   => 'PT Sans',
			'PT Sans Caption'           => 'PT Sans Caption',
			'PT Sans Narrow'            => 'PT Sans Narrow',
			'PT Serif'                  => 'PT Serif',
			'PT Serif Caption'          => 'PT Serif Caption',
			'Pacifico'                  => 'Pacifico',
			'Padauk'                    => 'Padauk',
			'Palanquin'                 => 'Palanquin',
			'Palanquin Dark'            => 'Palanquin Dark',
			'Pangolin'                  => 'Pangolin',
			'Paprika'                   => 'Paprika',
			'Parisienne'                => 'Parisienne',
			'Passero One'               => 'Passero One',
			'Passion One'               => 'Passion One',
			'Pathway Gothic One'        => 'Pathway Gothic One',
			'Patrick Hand'              => 'Patrick Hand',
			'Patrick Hand SC'           => 'Patrick Hand SC',
			'Pattaya'                   => 'Pattaya',
			'Patua One'                 => 'Patua One',
			'Pavanam'                   => 'Pavanam',
			'Paytone One'               => 'Paytone One',
			'Peddana'                   => 'Peddana',
			'Peralta'                   => 'Peralta',
			'Permanent Marker'          => 'Permanent Marker',
			'Petit Formal Script'       => 'Petit Formal Script',
			'Petrona'                   => 'Petrona',
			'Philosopher'               => 'Philosopher',
			'Piedra'                    => 'Piedra',
			'Pinyon Script'             => 'Pinyon Script',
			'Pirata One'                => 'Pirata One',
			'Plaster'                   => 'Plaster',
			'Play'                      => 'Play',
			'Playball'                  => 'Playball',
			'Playfair Display'          => 'Playfair Display',
			'Playfair Display SC'       => 'Playfair Display SC',
			'Podkova'                   => 'Podkova',
			'Poiret One'                => 'Poiret One',
			'Poller One'                => 'Poller One',
			'Poly'                      => 'Poly',
			'Pompiere'                  => 'Pompiere',
			'Pontano Sans'              => 'Pontano Sans',
			'Poppins'                   => 'Poppins',
			'Port Lligat Sans'          => 'Port Lligat Sans',
			'Port Lligat Slab'          => 'Port Lligat Slab',
			'Pragati Narrow'            => 'Pragati Narrow',
			'Prata'                     => 'Prata',
			'Preahvihear'               => 'Preahvihear',
			'Press Start 2P'            => 'Press Start 2P',
			'Pridi'                     => 'Pridi',
			'Princess Sofia'            => 'Princess Sofia',
			'Prociono'                  => 'Prociono',
			'Prompt'                    => 'Prompt',
			'Prosto One'                => 'Prosto One',
			'Proza Libre'               => 'Proza Libre',
			'Puritan'                   => 'Puritan',
			'Purple Purse'              => 'Purple Purse',
			'Quando'                    => 'Quando',
			'Quantico'                  => 'Quantico',
			'Quattrocento'              => 'Quattrocento',
			'Quattrocento Sans'         => 'Quattrocento Sans',
			'Questrial'                 => 'Questrial',
			'Quicksand'                 => 'Quicksand',
			'Quintessential'            => 'Quintessential',
			'Qwigley'                   => 'Qwigley',
			'Racing Sans One'           => 'Racing Sans One',
			'Radley'                    => 'Radley',
			'Rajdhani'                  => 'Rajdhani',
			'Rakkas'                    => 'Rakkas',
			'Raleway'                   => 'Raleway',
			'Raleway Dots'              => 'Raleway Dots',
			'Ramabhadra'                => 'Ramabhadra',
			'Ramaraja'                  => 'Ramaraja',
			'Rambla'                    => 'Rambla',
			'Rammetto One'              => 'Rammetto One',
			'Ranchers'                  => 'Ranchers',
			'Rancho'                    => 'Rancho',
			'Ranga'                     => 'Ranga',
			'Rasa'                      => 'Rasa',
			'Rationale'                 => 'Rationale',
			'Ravi Prakash'              => 'Ravi Prakash',
			'Redressed'                 => 'Redressed',
			'Reem Kufi'                 => 'Reem Kufi',
			'Reenie Beanie'             => 'Reenie Beanie',
			'Revalia'                   => 'Revalia',
			'Rhodium Libre'             => 'Rhodium Libre',
			'Ribeye'                    => 'Ribeye',
			'Ribeye Marrow'             => 'Ribeye Marrow',
			'Righteous'                 => 'Righteous',
			'Risque'                    => 'Risque',
			'Roboto'                    => 'Roboto',
			'Roboto Condensed'          => 'Roboto Condensed',
			'Roboto Mono'               => 'Roboto Mono',
			'Roboto Slab'               => 'Roboto Slab',
			'Rochester'                 => 'Rochester',
			'Rock Salt'                 => 'Rock Salt',
			'Rokkitt'                   => 'Rokkitt',
			'Romanesco'                 => 'Romanesco',
			'Ropa Sans'                 => 'Ropa Sans',
			'Rosario'                   => 'Rosario',
			'Rosarivo'                  => 'Rosarivo',
			'Rouge Script'              => 'Rouge Script',
			'Rozha One'                 => 'Rozha One',
			'Rubik'                     => 'Rubik',
			'Rubik Mono One'            => 'Rubik Mono One',
			'Ruda'                      => 'Ruda',
			'Rufina'                    => 'Rufina',
			'Ruge Boogie'               => 'Ruge Boogie',
			'Ruluko'                    => 'Ruluko',
			'Rum Raisin'                => 'Rum Raisin',
			'Ruslan Display'            => 'Ruslan Display',
			'Russo One'                 => 'Russo One',
			'Ruthie'                    => 'Ruthie',
			'Rye'                       => 'Rye',
			'Sacramento'                => 'Sacramento',
			'Sahitya'                   => 'Sahitya',
			'Sail'                      => 'Sail',
			'Salsa'                     => 'Salsa',
			'Sanchez'                   => 'Sanchez',
			'Sancreek'                  => 'Sancreek',
			'Sansita'                   => 'Sansita',
			'Sarala'                    => 'Sarala',
			'Sarina'                    => 'Sarina',
			'Sarpanch'                  => 'Sarpanch',
			'Satisfy'                   => 'Satisfy',
			'Scada'                     => 'Scada',
			'Scheherazade'              => 'Scheherazade',
			'Schoolbell'                => 'Schoolbell',
			'Scope One'                 => 'Scope One',
			'Seaweed Script'            => 'Seaweed Script',
			'Secular One'               => 'Secular One',
			'Sevillana'                 => 'Sevillana',
			'Seymour One'               => 'Seymour One',
			'Shadows Into Light'        => 'Shadows Into Light',
			'Shadows Into Light Two'    => 'Shadows Into Light Two',
			'Shanti'                    => 'Shanti',
			'Share'                     => 'Share',
			'Share Tech'                => 'Share Tech',
			'Share Tech Mono'           => 'Share Tech Mono',
			'Shojumaru'                 => 'Shojumaru',
			'Short Stack'               => 'Short Stack',
			'Shrikhand'                 => 'Shrikhand',
			'Siemreap'                  => 'Siemreap',
			'Sigmar One'                => 'Sigmar One',
			'Signika'                   => 'Signika',
			'Signika Negative'          => 'Signika Negative',
			'Simonetta'                 => 'Simonetta',
			'Sintony'                   => 'Sintony',
			'Sirin Stencil'             => 'Sirin Stencil',
			'Six Caps'                  => 'Six Caps',
			'Skranji'                   => 'Skranji',
			'Slabo 13px'                => 'Slabo 13px',
			'Slabo 27px'                => 'Slabo 27px',
			'Slackey'                   => 'Slackey',
			'Smokum'                    => 'Smokum',
			'Smythe'                    => 'Smythe',
			'Sniglet'                   => 'Sniglet',
			'Snippet'                   => 'Snippet',
			'Snowburst One'             => 'Snowburst One',
			'Sofadi One'                => 'Sofadi One',
			'Sofia'                     => 'Sofia',
			'Sonsie One'                => 'Sonsie One',
			'Sorts Mill Goudy'          => 'Sorts Mill Goudy',
			'Source Code Pro'           => 'Source Code Pro',
			'Source Sans Pro'           => 'Source Sans Pro',
			'Source Serif Pro'          => 'Source Serif Pro',
			'Space Mono'                => 'Space Mono',
			'Special Elite'             => 'Special Elite',
			'Spicy Rice'                => 'Spicy Rice',
			'Spinnaker'                 => 'Spinnaker',
			'Spirax'                    => 'Spirax',
			'Squada One'                => 'Squada One',
			'Sree Krushnadevaraya'      => 'Sree Krushnadevaraya',
			'Sriracha'                  => 'Sriracha',
			'Stalemate'                 => 'Stalemate',
			'Stalinist One'             => 'Stalinist One',
			'Stardos Stencil'           => 'Stardos Stencil',
			'Stint Ultra Condensed'     => 'Stint Ultra Condensed',
			'Stint Ultra Expanded'      => 'Stint Ultra Expanded',
			'Stoke'                     => 'Stoke',
			'Strait'                    => 'Strait',
			'Sue Ellen Francisco'       => 'Sue Ellen Francisco',
			'Suez One'                  => 'Suez One',
			'Sumana'                    => 'Sumana',
			'Sunshiney'                 => 'Sunshiney',
			'Supermercado One'          => 'Supermercado One',
			'Sura'                      => 'Sura',
			'Suranna'                   => 'Suranna',
			'Suravaram'                 => 'Suravaram',
			'Suwannaphum'               => 'Suwannaphum',
			'Swanky and Moo Moo'        => 'Swanky and Moo Moo',
			'Syncopate'                 => 'Syncopate',
			'Tangerine'                 => 'Tangerine',
			'Taprom'                    => 'Taprom',
			'Tauri'                     => 'Tauri',
			'Taviraj'                   => 'Taviraj',
			'Teko'                      => 'Teko',
			'Telex'                     => 'Telex',
			'Tenali Ramakrishna'        => 'Tenali Ramakrishna',
			'Tenor Sans'                => 'Tenor Sans',
			'Text Me One'               => 'Text Me One',
			'The Girl Next Door'        => 'The Girl Next Door',
			'Tienne'                    => 'Tienne',
			'Tillana'                   => 'Tillana',
			'Timmana'                   => 'Timmana',
			'Tinos'                     => 'Tinos',
			'Titan One'                 => 'Titan One',
			'Titillium Web'             => 'Titillium Web',
			'Trade Winds'               => 'Trade Winds',
			'Trirong'                   => 'Trirong',
			'Trocchi'                   => 'Trocchi',
			'Trochut'                   => 'Trochut',
			'Trykker'                   => 'Trykker',
			'Tulpen One'                => 'Tulpen One',
			'Ubuntu'                    => 'Ubuntu',
			'Ubuntu Condensed'          => 'Ubuntu Condensed',
			'Ubuntu Mono'               => 'Ubuntu Mono',
			'Ultra'                     => 'Ultra',
			'Uncial Antiqua'            => 'Uncial Antiqua',
			'Underdog'                  => 'Underdog',
			'Unica One'                 => 'Unica One',
			'UnifrakturCook'            => 'UnifrakturCook',
			'UnifrakturMaguntia'        => 'UnifrakturMaguntia',
			'Unkempt'                   => 'Unkempt',
			'Unlock'                    => 'Unlock',
			'Unna'                      => 'Unna',
			'VT323'                     => 'VT323',
			'Vampiro One'               => 'Vampiro One',
			'Varela'                    => 'Varela',
			'Varela Round'              => 'Varela Round',
			'Vast Shadow'               => 'Vast Shadow',
			'Vesper Libre'              => 'Vesper Libre',
			'Vibur'                     => 'Vibur',
			'Vidaloka'                  => 'Vidaloka',
			'Viga'                      => 'Viga',
			'Voces'                     => 'Voces',
			'Volkhov'                   => 'Volkhov',
			'Vollkorn'                  => 'Vollkorn',
			'Voltaire'                  => 'Voltaire',
			'Waiting for the Sunrise'   => 'Waiting for the Sunrise',
			'Wallpoet'                  => 'Wallpoet',
			'Walter Turncoat'           => 'Walter Turncoat',
			'Warnes'                    => 'Warnes',
			'Wellfleet'                 => 'Wellfleet',
			'Wendy One'                 => 'Wendy One',
			'Wire One'                  => 'Wire One',
			'Work Sans'                 => 'Work Sans',
			'Yanone Kaffeesatz'         => 'Yanone Kaffeesatz',
			'Yantramanav'               => 'Yantramanav',
			'Yatra One'                 => 'Yatra One',
			'Yellowtail'                => 'Yellowtail',
			'Yeseva One'                => 'Yeseva One',
			'Yesteryear'                => 'Yesteryear',
			'Yrsa'                      => 'Yrsa',
			'Zeyada'                    => 'Zeyada',
		);

		return $spacious_google_font;
	}

endif;
