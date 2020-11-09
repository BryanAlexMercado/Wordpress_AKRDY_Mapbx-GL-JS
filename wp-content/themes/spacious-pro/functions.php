<?php

/**
 * Spacious functions related to defining constants, adding files and WordPress core functionality.
 *
 * Defining some constants, loading all the required files and Adding some core functionality.
 *
 * @uses       add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses       register_nav_menu() To add support for navigation menu.
 * @uses       set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package    ThemeGrill
 * @subpackage Spacious
 * @since      Spacious 1.0
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) ) {
    $content_width = 750;
}
/**
 * $content_width global variable adjustment as per layout option.
 */
function spacious_content_width()
{
    global  $post ;
    global  $content_width ;
    if ( $post ) {
        $layout_meta = get_post_meta( $post->ID, 'spacious_page_layout', true );
    }
    if ( empty($layout_meta) || is_archive() || is_search() ) {
        $layout_meta = 'default_layout';
    }
    $spacious_default_layout = spacious_options( 'default_layout', 'right_sidebar' );
    
    if ( $layout_meta == 'default_layout' ) {
        
        if ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' || spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
            
            if ( $spacious_default_layout == 'no_sidebar_full_width' ) {
                $content_width = 978;
                /* pixels */
            } else {
                $content_width = 642;
                /* pixels */
            }
        
        } else {
            
            if ( $spacious_default_layout == 'no_sidebar_full_width' ) {
                $content_width = 1218;
                /* pixels */
            } else {
                $content_width = 750;
                /* pixels */
            }
        
        }
    
    } else {
        
        if ( spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'box_978px' || spacious_options( 'spacious_site_layout', 'box_1218px' ) == 'wide_978px' ) {
            
            if ( $layout_meta == 'no_sidebar_full_width' ) {
                $content_width = 978;
                /* pixels */
            } else {
                $content_width = 642;
                /* pixels */
            }
        
        } else {
            
            if ( $layout_meta == 'no_sidebar_full_width' ) {
                $content_width = 1218;
                /* pixels */
            } else {
                $content_width = 750;
                /* pixels */
            }
        
        }
    
    }

}

add_action( 'template_redirect', 'spacious_content_width' );
add_action( 'after_setup_theme', 'spacious_setup' );
/**
 * All setup functionalities.
 *
 * @since 1.0
 */
if ( !function_exists( 'spacious_setup' ) ) {
    function spacious_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'spacious', get_template_directory() . '/languages' );
        // Add default posts and comments RSS feed links to head
        add_theme_support( 'automatic-feed-links' );
        // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page.
        add_theme_support( 'post-thumbnails' );
        // Supporting title tag via add_theme_support (since WordPress 4.1)
        add_theme_support( 'title-tag' );
        // Gutenberg align wide support.
        add_theme_support( 'align-wide' );
        // Gutenberg block styles support.
        add_theme_support( 'wp-block-styles' );
        // Gutenberg responsive embeds support.
        add_theme_support( 'responsive-embeds' );
        // Registering navigation menus.
        register_nav_menus( array(
            'header'  => esc_html__( 'Header Menu', 'spacious' ),
            'primary' => esc_html__( 'Primary Menu', 'spacious' ),
            'footer'  => esc_html__( 'Footer Menu', 'spacious' ),
        ) );
        // Cropping the images to different sizes to be used in the theme
        add_image_size(
            'featured-blog-large',
            750,
            350,
            true
        );
        add_image_size(
            'featured-blog-medium',
            270,
            270,
            true
        );
        add_image_size(
            'featured',
            642,
            300,
            true
        );
        add_image_size(
            'featured-blog-medium-small',
            230,
            230,
            true
        );
        // Setup the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'spacious_custom_background_args', array(
            'default-color' => 'eaeaea',
        ) ) );
        // Adding excerpt option box for pages as well
        add_post_type_support( 'page', 'excerpt' );
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ) );
        // Adds the support for the Custom Logo introduced in WordPress 4.5
        add_theme_support( 'custom-logo', array(
            'height'      => 100,
            'width'       => 100,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        // Support for selective refresh widgets in Customizer
        add_theme_support( 'customize-selective-refresh-widgets' );
    }

}
/**
 * Load Spacious Pro Demo Importer compatibility file.
 */
require get_template_directory() . '/inc/demo-importer/class-demo-importer.php';
/**
 * Define Directory Location Constants
 */
define( 'SPACIOUS_PARENT_DIR', get_template_directory() );
define( 'SPACIOUS_CHILD_DIR', get_stylesheet_directory() );
define( 'SPACIOUS_IMAGES_DIR', SPACIOUS_PARENT_DIR . '/images' );
define( 'SPACIOUS_INCLUDES_DIR', SPACIOUS_PARENT_DIR . '/inc' );
define( 'SPACIOUS_CSS_DIR', SPACIOUS_PARENT_DIR . '/css' );
define( 'SPACIOUS_JS_DIR', SPACIOUS_PARENT_DIR . '/js' );
define( 'SPACIOUS_LANGUAGES_DIR', SPACIOUS_PARENT_DIR . '/languages' );
define( 'SPACIOUS_TOOLKIT_DIR', SPACIOUS_PARENT_DIR . '/spacious-toolkit' );
define( 'SPACIOUS_TOOLKIT_WIDGETS_DIR', SPACIOUS_TOOLKIT_DIR . '/widgets' );
define( 'SPACIOUS_ADMIN_DIR', SPACIOUS_INCLUDES_DIR . '/admin' );
define( 'SPACIOUS_WIDGETS_DIR', SPACIOUS_INCLUDES_DIR . '/widgets' );
define( 'SPACIOUS_ADMIN_IMAGES_DIR', SPACIOUS_ADMIN_DIR . '/images' );
define( 'SPACIOUS_ADMIN_JS_DIR', SPACIOUS_ADMIN_DIR . '/js' );
define( 'SPACIOUS_ADMIN_CSS_DIR', SPACIOUS_ADMIN_DIR . '/css' );
/**
 * Define URL Location Constants
 */
define( 'SPACIOUS_PARENT_URL', get_template_directory_uri() );
define( 'SPACIOUS_CHILD_URL', get_stylesheet_directory_uri() );
define( 'SPACIOUS_IMAGES_URL', SPACIOUS_PARENT_URL . '/images' );
define( 'SPACIOUS_INCLUDES_URL', SPACIOUS_PARENT_URL . '/inc' );
define( 'SPACIOUS_CSS_URL', SPACIOUS_PARENT_URL . '/css' );
define( 'SPACIOUS_JS_URL', SPACIOUS_PARENT_URL . '/js' );
define( 'SPACIOUS_LANGUAGES_URL', SPACIOUS_PARENT_URL . '/languages' );
define( 'SPACIOUS_ADMIN_URL', SPACIOUS_INCLUDES_URL . '/admin' );
define( 'SPACIOUS_WIDGETS_URL', SPACIOUS_INCLUDES_URL . '/widgets' );
define( 'SPACIOUS_ADMIN_IMAGES_URL', SPACIOUS_ADMIN_URL . '/images' );
define( 'SPACIOUS_ADMIN_JS_URL', SPACIOUS_ADMIN_URL . '/js' );
define( 'SPACIOUS_ADMIN_CSS_URL', SPACIOUS_ADMIN_URL . '/css' );
/** Load functions */
require_once SPACIOUS_INCLUDES_DIR . '/custom-header.php';
require_once SPACIOUS_INCLUDES_DIR . '/functions.php';
require_once SPACIOUS_INCLUDES_DIR . '/header-functions.php';
require_once SPACIOUS_INCLUDES_DIR . '/customizer.php';
require_once SPACIOUS_ADMIN_DIR . '/meta-boxes.php';
/**
 * Admin.
 */
if ( is_admin() ) {
    require SPACIOUS_ADMIN_DIR . '/admin-notice.php';
}
/** Load Widgets and Widgetized Area */
require_once SPACIOUS_WIDGETS_DIR . '/widgets.php';
/**
 * Load the Spacious Toolkit file.
 */
if ( class_exists( 'Spacious_Toolkit' ) ) {
    include_once SPACIOUS_INCLUDES_DIR . '/spacious-toolkit.php';
}
/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require_once SPACIOUS_INCLUDES_DIR . '/jetpack.php';
}
/**
 * Detect plugin. For use on Front End only.
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';
/**
 * Add the Elementor compatibility file
 */
if ( defined( 'ELEMENTOR_VERSION' ) ) {
    require_once SPACIOUS_INCLUDES_DIR . '/elementor/elementor.php';
}
#--------------------------------------------------------------------------------
#region Freemius
#--------------------------------------------------------------------------------
class FS_ThemeGrill
{
    /**
     * @var Freemius
     */
    private static  $fs ;
    /**
     * @return Freemius
     */
    public static function freemius()
    {
        return self::$fs;
    }
    
    private function __construct()
    {
    }
    
    /**
     * @param string $id
     * @param string $slug
     * @param string $public_key
     * @param string $name
     *
     * @return \Freemius
     */
    public static function init(
        $id,
        $slug,
        $public_key,
        $name = ''
    )
    {
        
        if ( !isset( self::$fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            self::$fs = fs_dynamic_init( array(
                'id'              => $id,
                'slug'            => $slug,
                'premium_slug'    => "{$slug}-pro",
                'type'            => 'theme',
                'public_key'      => $public_key,
                'is_premium'      => true,
                'is_premium_only' => true,
                'premium_suffix'  => 'Pro',
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'menu'            => array(
                'slug'    => 'themegrill_submenu',
                'support' => false,
                'parent'  => array(
                'slug' => 'options-general.php',
            ),
            ),
                'is_live'         => true,
            ) );
            // Signal that SDK was initiated.
            do_action( "{$slug}_fs_loaded" );
            require_once dirname( __FILE__ ) . '/inc/freemius-migration.php';
            if ( empty($name) ) {
                $name = ucwords( str_replace( '-', ' ', $slug ) );
            }
            new FS_ThemeGrill_License_Menu( $name, $slug );
            new FS_ThemeGrill_License_Migration( self::$fs, "api_manager_theme_{$slug}", $slug );
        }
        
        return self::$fs;
    }

}
FS_ThemeGrill::init(
    '4217',
    'spacious',
    'pk_38fe5c4b7d4937b449e2899a2f8fd',
    'Spacious'
);
#endregion