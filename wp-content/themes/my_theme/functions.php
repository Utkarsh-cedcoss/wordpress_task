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
$args = array(
    'default-color' => '#FFFFFF',
    'default-image' => get_template_directory_uri() . '/image/slider.jpg',
);
add_theme_support( 'custom-background', $args );
// function shape_register_custom_background() {
// 	$args = array(
// 		'default-color' => 'e9e0d1',
// 	);

// 	$args = apply_filters( 'shape_custom_background_args', $args );

// 	if ( function_exists( 'wp_get_theme' ) ) {
// 		add_theme_support( 'custom-background', $args );
// 	} else {
// 		define( 'BACKGROUND_COLOR', $args['default-color'] );
// 		define( 'BACKGROUND_IMAGE', $args['default-image'] );
// 		add_custom_background();
// 	}
// }
// add_action( 'after_setup_theme', 'shape_register_custom_background' );

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
	add_theme_support('custom-header', $defaults);
}
add_action( 'after_setup_theme', 'themename_custom_header_setup' );

//add_theme_support( 'custom-header' );

// --------------------------------------------------------------------------------------------------

/**
 *
 * This function is for dynamic sidebar.In this sidebar we can add widgets
 * 
 */
function profotech_register_sidebar() {
	// register_sidebar is a function used to register our dynamic sidebar it takes array of parameter.
	register_sidebar(array(
		'name'          => ( 'Primary Sidebar'), // 'Primary Sidebar' is the name of the sidebar, when we will open the widgets in Appearance there we will see the sidebar with this name.
		'id'=>'sidebar-1',  // 'sidebar-1' is the id of this sidebar.This id will be used to fetch widgets from this sidebar.
		'before_widget'=>'<aside id="%1$s" class="widget %2$s"', // Our widgets will be in this tag.
		'after_widget'=>'</aside>', 
		'before_title' => '<h1 class="widget-title">', // Our widgets'title will be in this tag.
		'after_title'=>'</h1>',
	));

	register_sidebar(array(
		'name'          => ( 'Primary Sidebar 2'), // 'Primary Sidebar' is the name of the sidebar, when we will open the widgets in Appearance there we will see the sidebar with this name.
		'id'=>'sidebar-2',  // 'sidebar-1' is the id of this sidebar.This id will be used to fetch widgets from this sidebar.
		'before_widget'=>'<aside id="%1$s" class="widget %2$s"', // Our widgets will be in this tag.
		'after_widget'=>'</aside>', 
		'before_title' => '<h1 class="widget-title">', // Our widgets'title will be in this tag.
		'after_title'=>'</h1>',
	));

}
add_action("widgets_init","profotech_register_sidebar");


// --------------------------------------------------------------------------------------------------
add_theme_support('title-tag');
// --------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );
//---------------------------------------------------------------------------------------------------
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
//---------------------------------------------------------------------------------------------------------
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

// -----------------------------------------------------------------------------------------------------------------

//theme customizer panel function
function owt_custom_theme_customize_register($wp_customize){ // $wp customizer is the global object.
	$wp_customize->add_section('owt_main_section', array(    // add_section() is a function which adds a section in customizer. here 'owt_main_section' is the unique id of the section. this function takes some parameter in arrays.
        'title'    => "Online Web Tutor Section",
        'description' => '',
        'priority' => 120,
	));
	
	//  =============================
    //  = Text Input at header               =
    //  =============================
    $wp_customize->add_setting('owt_first_txtbox_setting', array(  // this function is use to add setting in any section.
        'default'        => 'this is my sample textbox text',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('owt_first_control', array(  //this function is used to add control. for eg. using this function we can fetch the data from text box setup by the add_setting().
        'label'      => "Enter your text",
        'section'    => 'owt_main_section',
        'settings'   => 'owt_first_txtbox_setting',
	));
	

	//  =============================
    //  = Link of page in header                =
    //  =============================
    $wp_customize->add_setting('owt_first_header_link', array(  // this function is use to add setting in any section.
        'default'        => 'online web tutor',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('owt_first_link_control', array(  //this function is used to add control. for eg. using this function we can fetch the data from text box setup by the add_setting().
        'label'      => "Header link",
        'section'    => 'owt_main_section',
        'settings'   => 'owt_first_header_link',
	));
	

	//  =============================
    //  = Page Dropdown             =
    //  =============================
    $wp_customize->add_setting('owt_setting_header_link', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('themename_page_test', array(
        'label'      => 'Header link',
        'section'    => 'owt_main_section',
        'type'    => 'dropdown-pages',
        'settings'   => 'owt_setting_header_link',
	));
	
	//  =============================
    //  = Image Upload              =
    //  =============================
    $wp_customize->add_setting('owt_image_uploader', array(
        'default'           => get_bloginfo('template_url').'/image/photo_yellow.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
	));
	
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(  // 'image_upload_test' is the unique id here.
        'label'    => 'Choose Image',
        'section'  => 'owt_main_section',
        'settings' => 'owt_image_uploader',
	)));
	

	//  =============================
    //  = Color Picker              =
    //  =============================
    $wp_customize->add_setting('owt_color_picker_id', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(  // 'link_color' is the unique id here.
        'label'    => 'Book now background',
        'section'  => 'owt_main_section',
        'settings' => 'owt_color_picker_id',
    )));

}
add_action('customize_register','owt_custom_theme_customize_register');