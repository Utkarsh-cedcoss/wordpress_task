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
	wp_enqueue_style( 'blog-home', get_template_directory_uri() . '/css/blog-home.css', array(), '1.1', 'all' );
}

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
// -----------------------------------------------------------------------------------------------------------------------

/**
 * This is comment
 *
 * @package WordPress
 * this function is for dynamic menu
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
// ------------------------------------------------------------------------------------------------------------------

/**
 * This is comment
 *
 * @package WordPress
 *  this function is for custom logo
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

// ------------------------------------------------------------------------------------------------------------------------------


/**
 *
 * This function is used to add featured image or thumbnail image.
 */
function owt_theme_supports() {
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'small-thumbnail', 200, 110, true ); // 120 wide 90 tall
	add_image_size( 'banner-image', 700, 350, true );
}
add_action( 'after_setup_theme', 'owt_theme_supports' );

// -------------------------------------------------------------------------------------------------------------------------------------------

// this is for different post format.
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link' ) );

// ------------------------------------------------------------------------------------------------------------------------------------------------

/**
 *
 * This function is to change background image i.e custom background.
 */
function shape_register_custom_background() {
	$args = array(
		'default-color' => 'e9e0d1',
	);

	$args = apply_filters( 'shape_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'shape_register_custom_background' );

// -----------------------------------------------------------------------------------------------------------------------------

/**
 *
 * This function is to change header image i.e custom header.
 */
function themename_custom_header_setup() {
	$defaults = array(
		// Default Header Image to display.
		'default-image' => get_template_directory_uri() . '/image/slider.jpg',
		// Display the header text along with the image.
		'header-text'   => false,
	);
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );

add_theme_support( 'custom-header' );

// --------------------------------------------------------------------------------------------------


/**
 * Undocumented function
 *
 * @return void
 */
function checkfront() {
	if ( is_front_page() ) {
		echo 'This is the main page';
	} else {
		echo 'This is not the main page';
	}
}
/**
 * Undocumented function
 *
 * @return void
 */
function checkhome() {
	if ( is_home() ) {
		echo 'this is home page';
	} else {
		echo 'this is not home page';
	}
}

/**
 * This function checks role and page.
 *
 * @return void
 */
function checkpage() {
	$user     = wp_get_current_user();
	$my_array = json_decode( json_encode( $user ), true );
	$role     = $my_array['roles'][0];
	if ( empty( $role ) ) {
		$role = 'guest';
	}

	if ( is_page( '92' ) && $role === 'subscriber' ) {
		$redirect = true;
	}
	if ( is_page( '92' ) && $role === 'guest' ) {
		$redirect = true;
	}

	if ( is_page( '95' ) && $role === 'guest' ) {
		$redirect = true;
	}
	if ( $redirect ) {
		wp_redirect( esc_url( home_url() ) );
	}
}
add_action( 'template_redirect', 'checkpage' );
