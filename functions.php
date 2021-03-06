<?php
/**
 * mcintosh-18 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mcintosh-18
 */

if ( ! function_exists( 'mcintosh_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mcintosh_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'mcintosh' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mcintosh_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'mcintosh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mcintosh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mcintosh_content_width', 640 );
}
add_action( 'after_setup_theme', 'mcintosh_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mcintosh_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mcintosh' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mcintosh' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mcintosh_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mcintosh_scripts() {
	wp_enqueue_style( 'mcintosh-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mcintosh-navigation', get_template_directory_uri() . '/bundle.js', array('jquery'), 1, false );
	

	wp_enqueue_script( 'mcintosh-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/default/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mcintosh_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/lib/inc/custom-header.php';

/**
 * Import Google Fonts
 */
require get_template_directory() . '/lib/inc/google-fonts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/lib/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/lib/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/lib/inc/customizer.php';

require get_template_directory() . '/lib/inc/gallery-mod.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/lib/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/lib/inc/woocommerce.php';
}

include get_stylesheet_directory() . '/lib/inc/foundation-walker.php';

function scratch_embed_container( $html ) {
	return '<div class="responsive-embed widescreen">' . $html . '</div>';
 }
 add_filter( 'embed_oembed_html', 'scratch_embed_container', 10, 3 );
 add_filter( 'video_embed_html', 'scratch_embed_container' );

 function custom_excerpt_length( $length ) {
	return 140;
 }
 add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

 //* Include Flexible Content
 include get_stylesheet_directory() . '/lib/acf/flexible-content.php';

 //enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets(){
	wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/releases/v5.0.8/js/all.js'); 
}
add_action('wp_enqueue_scripts','enqueue_our_required_stylesheets');



// add_action( 'wp_enqueue_scripts', 'add_lightbox_assets' );

// function add_lightbox_assets() {
//  	wp_enqueue_script( 'lightbox2', get_template_directory_uri() . '/assets/js/vendor/lightbox.js' );
//  }

