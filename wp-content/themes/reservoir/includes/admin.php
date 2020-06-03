<?php

/**
 * Replace parent theme admin page with child theme page to use appropriate theme labelling
 */
function reservoir_replace_admin_page() {
	remove_action( 'admin_menu', 'fluida_add_page_fn' );
} // reservoir_replace_admin_page()
add_action( 'init', 'reservoir_replace_admin_page', 11 );

function reservoir_add_page_fn() {
	global $fluida_page;
	$fluida_page = add_theme_page( __( 'Reservoir Theme', 'reservoir' ), __( 'Reservoir Theme', 'reservoir' ), 'edit_theme_options', 'about-reservoir-theme', 'fluida_page_fn' );
	add_action( 'admin_enqueue_scripts', 'fluida_admin_scripts' );
} // reservoir_add_page_fn()
add_action( 'admin_menu', 'reservoir_add_page_fn' );

/**
 * Add child theme version to admin page
 */
function reservoir_admin_version_output( $parent ) {
	$theme = wp_get_theme();
	$name = $theme->get( 'Name' );
	$version = $theme->get( 'Version' );

	// translators: %1$s is the child theme name; %2$s is the child theme version; %3$s is the parent theme name
	return sprintf( __( '<em>%1$s v%2$s</em> &ndash; a child theme of %3$s', 'reservoir' ), $theme, $version, $parent );
} // reservoir_admin_version_output()
// this filter is applied in reservoir_setup()

/**
 * Extend description to reference the use of the child theme
 */
function reservoir_custom_description( $description ) {
	// Child theme
	$theme = wp_get_theme();
	$template = esc_html( $theme->get( 'Template' ) );
	$name = esc_html( $theme->get( 'Name' ) );

	// Parent theme
	$template_theme = wp_get_theme( $template );
	$template_desc = $template_theme->get( 'Description');

	// translators: %1$s is the name of the child theme; %2$s is the name of the parent theme
	$output = '<h3>' . sprintf( esc_html__( '%1$s is a child theme of %2$s', 'reservoir' ), $name,  ucfirst( $template ) ) . '</h3>';

	return  $output . $description . '<br><br><hr><br><em>' . $template_desc . '</em>';
} // reservoir_custom_description()
// this filter is added in reservoir_setup()


// FIN
