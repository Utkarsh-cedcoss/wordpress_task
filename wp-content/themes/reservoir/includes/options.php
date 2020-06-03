<?php

/**
 * Defaults
 */
function reservoir_defaults( $defaults = array() ) {

	$reservoir_defaults = array(

		"fluida_lpsliderimage"		=> esc_url( get_stylesheet_directory_uri() . '/resources/images/slider/reservoir.jpg' ),
		"fluida_menuheight"			=> 80,
		"fluida_headerheight"		=> 400,

		"fluida_fheight"			=> 300,

		"fluida_sitebackground" 	=> "#f4f6f5",
		"fluida_sitetext" 			=> "#555555",
		"fluida_headingstext"		=> "#0a0908",
		"fluida_contentbackground"	=> "#FFFFFF",
		"fluida_accent1" 			=> "#0a0908",
		"fluida_accent2" 			=> "#d81e5b",
		"fluida_menubackground"		=> "#FFFFFF",
		"fluida_menutext" 			=> "#0a0908",
		"fluida_submenutext" 		=> "#555555",

		"fluida_footerbackground" 	=> "#FFF",
		"fluida_footertext" 		=> "#555",

		// "fluida_fgeneral" 	=> '',
		"fluida_fgeneralgoogle" 	=> 'Roboto',
		"fluida_fgeneralsize" 		=> '16',
		"fluida_fgeneralweight" 	=> '400',

		//"fluida_fsitetitle" 	=> '',
		"fluida_fsitetitlegoogle"	=> 'Poppins',
		"fluida_fsitetitlesize" 	=> '150%',
		"fluida_fsitetitleweight"	=> '700',

		//"fluida_fmenu" 			=> '',
		"fluida_fmenugoogle"		=> 'Roboto',
		"fluida_fmenusize" 			=> 90,
		"fluida_fmenuweight"		=> '700',

		//"fluida_ftitles" 	=> '',
		"fluida_ftitlesgoogle"	=> 'Poppins',
		"fluida_ftitlessize" 	=> 300,
		"fluida_ftitlesweight"	=> '700',

		//"fluida_fheadings" 	=> '',
		"fluida_fheadingsgoogle"	=> 'Poppins',
		"fluida_fheadingssize" 		=> '130%',
		"fluida_fheadingsweight"	=> '700',
		"fluida_fheadingsvariant"	=> '',

		//"fluida_fwtitle" 		=> '',
		"fluida_fwtitlegoogle"	=> 'Poppins',
		"fluida_fwtitlesize" 	=> '100%',
		"fluida_fwtitleweight"	=> '700',

		//"fluida_fwcontent" 	=> '',
		"fluida_fwcontentgoogle"	=> 'Roboto',
		"fluida_fwcontentsize" 		=> 1,
		"fluida_fwcontentweight"	=> '400',

		"fluida_excerptlength"	=> 35,
		"fluida_excerptcont"	=> __( 'Read more', 'reservoir')
	); // reservoir_defaults array

	$result = array_merge( $defaults, $reservoir_defaults );

	return $result;

} // reservoir_defaults()
add_filter( 'fluida_option_defaults_array', 'reservoir_defaults' );

// needed? for the .org preview
function reservoir_filter_defaults(){
	add_filter( 'fluida_option_defaults_array', 'reservoir_defaults' );
} // reservoir_filter_defaults()
add_action( 'customize_register', 'reservoir_filter_defaults' );


/**
 * Handle theme labels in customize panels
 */
function reservoir_about_theme_name( $initial ) {
	return __( 'About Reservoir', 'reservoir' );
} // reservoir_about_theme_name()
add_filter( 'cryout_about_theme_name', 'reservoir_about_theme_name' );

function reservoir_about_theme_plus_desc( $initial ) {
	$theme = wp_get_theme();
	// translators: %1$s is the name of the child theme, %2$s is the name of the parent theme
	return '<h3>' . sprintf( esc_html__( '%1$s is a child theme of %2$s', 'reservoir' ), esc_html( $theme->get( 'Name' ) ), ucwords( esc_html( $theme->get( 'Template' ) ) ) ) . '</h3>' . $initial;
} // reservoir_about_theme_plus_desc()
add_filter( 'cryout_about_theme_plus_desc', 'reservoir_about_theme_plus_desc' );

function reservoir_about_theme_slug_swap( $initial ){
	return str_replace( array( 'fluida', 'Fluida' ), array( 'reservoir', 'Reservoir' ), $initial );
} // reservoir_about_theme_slug_swap()
add_filter( 'cryout_about_theme_review_link', 'reservoir_about_theme_slug_swap' );
add_filter( 'cryout_about_theme_manage_link', 'reservoir_about_theme_slug_swap' );

// FIN
