<?php
/**
 * hany-dark functions and definitions
 *
 * @package hany-dark
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600; /* pixels */
}

if ( ! function_exists( 'hany_dark_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hany_dark_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hany-dark, use a find and replace
	 * to change 'hany-dark' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hany-dark', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hany-dark' ),
//                'social' => __( 'Social Menu', 'hany-dark' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('aside') );

	// Set up the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'hany_dark_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );
}
endif; // hany_dark_setup
add_action( 'after_setup_theme', 'hany_dark_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function hany_dark_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'hany-dark' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
        
        register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'hany-dark' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Footer widgets area appears in the footer of the site.', 'hany-dark' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'hany_dark_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hany_dark_scripts() {
	wp_enqueue_style( 'hany-dark-style', get_stylesheet_uri() );
        
        wp_enqueue_style( 'hany-dark-content-sidebar', get_template_directory_uri() . '/layouts/sidebar-content.css' );
        
//        wp_enqueue_style( 'hany-dark-google-fonts', 'http://fonts.useso.com/css?family=Lato:100,400,700,900,400italic,900italic|PT+Serif:400,700,400italic,700italic' );
        
        wp_enqueue_style( 'hany-dark-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

        wp_enqueue_script( 'hany-dark-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20150122', true );
        
        wp_enqueue_script( 'hany-dark-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('hany-dark-superfish'), '20150122', true );
        
        wp_enqueue_script( 'hanu-dark-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20140404', true );
        
	wp_enqueue_script( 'hany-dark-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'hany-dark-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

        wp_enqueue_script( 'hany-dark-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20150122', true );
        
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'hany_dark_scripts' );

function get_ssl_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
add_filter('get_avatar', 'get_ssl_avatar');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
