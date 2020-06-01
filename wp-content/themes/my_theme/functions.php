<?php
/**
 * This is comment
 *
 * @package WordPress
 */

/**
 * This is comment
 *
 * @package WordPress
 */
function themeslug_enqueue_style() {
	wp_enqueue_style( 'main_style', get_stylesheet_uri(), array(), '1.1', 'all' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css', array(), '1.1', 'all' );
	wp_enqueue_style( 'blog-home', get_template_directory_uri() . '/css/blog-home.css', array(), '1.1', 'all' ); }

/**
 * This is comment
 *
 * @package WordPress
 */
function themeslug_enqueue_script() {
	wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/vendor/jquery/jquery.min.js', array(), '1.1', true );
	wp_enqueue_script( 'bootstrap.bundle.min.js', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array(), '1.1', true );
}

add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_script' );

/**
 * This is comment
 *
 * @package WordPress
 */
function register_menu() {
	// menu register code.
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'footer-menu'  => __( 'Footer Menu' ),
			'sidebar-menu' => __( 'Sidebar Menu' ),
		)
	);
}
	// attach with action hook.

add_action( 'init', 'register_menu' );

/**
 * This is comment
 *
 * @package WordPress
 */
function themename_custom_logo_setup() {
	$defaults = array(
		'height' => 50,
		'width'  => 177,
	);
	add_theme_support( 'custom-logo', $defaults );
	// 'custom logo' will be the id.
}
// after_setup_theme is the action hook.
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)

    // additional image sizes
    // delete the next line if you do not need additional image sizes
    add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
}
