<?php
/**
 * Master generated style function
 *
 * @package Reservoir
 */

/**
 * Add body classes to identify the child theme
 */
function reservoir_body_classes( $classes ) {
	$classes[] = strtolower( wp_get_theme() ) . '-child';
	return $classes;
}
add_filter( 'body_class', 'reservoir_body_classes', 15 );

/**
 * Dynamic styles for the frontend
 */
function reservoir_custom_styling() {
    $options = cryout_get_option();
    extract($options);

    ob_start(); ?>

    /* Reservoir custom style */

	#sheader a::before {
		color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	#sheader a:hover::before {
		color: <?php echo esc_html( $fluida_accent1 ) ?>;
	}

	.lp-block i::before {
		background-color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	.lp-block:hover i::before {
		background-color: <?php echo esc_html( $fluida_accent1 ) ?>;
	}

	.lp-boxes-static .lp-box-link i {
		color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	.lp-box-readmore ,
	.lp-boxes-animated .lp-box-readmore {
		color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	.post-thumbnail-container {
			padding-left: <?php echo esc_html( $fluida_elementpadding ) ?>%;
			padding-top: <?php echo esc_html( $fluida_elementpadding ) ?>%;
			padding-right: <?php echo esc_html( $fluida_elementpadding ) ?>%;
	}

	.entry-title,
	.entry-title a,
	.lp-block-title,
	.lp-text-title,
	.lp-boxes-static .lp-box-title {
		color: <?php echo esc_html( $fluida_headingstext ) ?>;
	}

	.widget-title,
	#comments-title,
	#reply-title,
	#author-link a,
	.logged-in-as a {
		color: <?php echo esc_html( $fluida_accent1 ) ?>;
	}

	#author-info #author-link a {
		color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	nav#mobile-menu a {
		font-family: <?php echo cryout_font_select( $fluida_fmenu, $fluida_fmenugoogle ) ?>;
	}

	#footer a {
		color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	#footer a:hover {
		color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	.lp-staticslider .staticslider-caption-text,
	.seriousslider.seriousslider-theme .seriousslider-caption-text {
		font-family: <?php echo cryout_font_select( $fluida_ftitles, $fluida_ftitlesgoogle ) ?>;
	}

	#site-title span a span:nth-child(<?php echo (int)$fluida_titleaccent ?>) {
		background-color: <?php echo esc_html( $fluida_accent2 ) ?>;
	}

	#site-title span a:hover span:nth-child(<?php echo (int)$fluida_titleaccent ?>)	{
		background-color: <?php echo esc_html( $fluida_accent1 ) ?>;
	}

	#site-title span a span:nth-child(<?php echo (int)$fluida_titleaccent ?>) {
		 margin-right: .1em;
		 margin-left: .1em;
		 font-weight: 300;
	 }

	 <?php if ( (int)$fluida_titleaccent === 1 ) { ?>
		 body #site-title span > a {
		     padding-left: 0;
		 }
	 <?php } ?>

    /* end Reservoir custom style */
    <?php
    return preg_replace( '/((background-)?color:\s*?)[;}]/i', '', ob_get_clean() );

} // reservoir_custom_styling()


/**
 * Load custom styles
 */
function reservoir_custom_styles( $style = '' ) {

	return $style . reservoir_custom_styling();

} // reservoir_custom_styles()
// this filer is applied in reservoir_setup()


/* FIN */
