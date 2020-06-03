<?php
/****************************
*
* Reservoir v1.1.1 - A Fluida Child Theme
* (c) 2019 Cryout Creations
* www.cryoutcreations.eu
*
*****************************/

/**
 * Load additional theme files
 */
require_once( get_stylesheet_directory() . '/includes/admin.php' );
require_once( get_stylesheet_directory() . '/includes/options.php' );
require_once( get_stylesheet_directory() . '/includes/notices.php' );
require_once( get_stylesheet_directory() . "/includes/custom-styles.php" );

/**
 * Enqueue parent styling
 */
function reservoir_child_styling(){
	wp_enqueue_style( 'fluida-main', get_template_directory_uri() . '/style.css', array(), _CRYOUT_THEME_VERSION );  // restore correct parent stylesheet
	wp_enqueue_style( 'reservoir', get_stylesheet_directory_uri() . '/style.css', array( 'fluida-main' ), _CRYOUT_THEME_VERSION  ); 		// enqueue child stylesheet
}
add_action( 'wp_enqueue_scripts', 'reservoir_child_styling' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function reservoir_setup() {

	// Add support for flexible headers
	add_theme_support( 'custom-header', array(
		'default-image'	=> get_stylesheet_directory_uri() . '/resources/images/headers/mountain-lake.jpg',
	));

	// Default custom headers packaged with the theme.
	register_default_headers( array(
		'mountain-lake' => array(
			'url' => '%2$s/resources/images/headers/mountain-lake.jpg',
			'thumbnail_url' => '%2$s/resources/images/headers/mountain-lake.jpg',
			'description' => __( 'Mountain Lake', 'reservoir' )
		),
	) );

	// Filters
	add_filter( 'fluida_custom_styles', 'reservoir_custom_styles' );
	add_filter( 'cryout_theme_description', 'reservoir_custom_description' );
	add_filter( 'cryout_admin_version', 'reservoir_admin_version_output' );

	// Initialize first time notice
	new Cryout_Notice( array(
		'slug' => 'reservoir',
		'strings' => array(
			// translators: %1 is theme name, %2 is next string
			1 => esc_html__( 'It appears that you might have already configured %1$s. For best results it is recommended to %2$s upon child theme activation.', 'reservoir' ),
			2 => esc_html__( 'reset the theme settings', 'reservoir' ),
			3 => esc_html__( 'If you have already reset the options it is safe to dismiss this message.', 'reservoir' ),
			4 => esc_html__( 'Do not display again', 'reservoir' ),
		),
	) );

} // reservoir_setup()
add_action( 'after_setup_theme', 'reservoir_setup' );


/* FIN */
