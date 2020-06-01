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


function shape_custom_header_setup() {
    $args = array(
        'default-image'          => '',
        'default-text-color'     => 'e9e0e1',
        'width'                  => 1050,
        'height'                 => 250,
        'flex-height'            => true,
        'wp-head-callback'       => 'shape_header_style',
        'admin-head-callback'    => 'shape_admin_header_style',
        'admin-preview-callback' => 'shape_admin_header_image',
    );
 
    $args = apply_filters( 'shape_custom_header_args', $args );
 
    if ( function_exists( 'wp_get_theme' ) ) {
        add_theme_support( 'custom-header', $args );
    } else {
        // Compat: Versions of WordPress prior to 3.4.
        define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
        define( 'HEADER_IMAGE',        $args['default-image'] );
        define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
        define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
        add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
    }
}
add_action( 'after_setup_theme', 'shape_custom_header_setup' );
 
/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @todo Remove this function when WordPress 3.6 is released.
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package Shape
 * @since Shape 1.1
 */
 
if ( ! function_exists( 'get_custom_header' ) ) {
    function get_custom_header() {
        return (object) array(
            'url'           => get_header_image(),
            'thumbnail_url' => get_header_image(),
            'width'         => HEADER_IMAGE_WIDTH,
            'height'        => HEADER_IMAGE_HEIGHT,
        );
    }
}
 
if ( ! function_exists( 'shape_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see shape_custom_header_setup().
 *
 * @since Shape 1.0
 */
function shape_header_style() {
 
    // If no custom options for text are set, let's bail
    // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
    if ( HEADER_TEXTCOLOR == get_header_textcolor() && '' == get_header_image() )
        return;
    // If we get this far, we have custom styles. Let's do this.
    ?>
    <style type="text/css">
    <?php
        // Do we have a custom header image?
        if ( '' != get_header_image() ) :
    ?>
        .site-header img {
            display: block;
            margin: 1.5em auto 0;
        }
    <?php endif;
 
        // Has the text been hidden?
        if ( 'blank' == get_header_textcolor() ) :
    ?>
        .site-title,
        .site-description {
            position: absolute !important;
            clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
            clip: rect(1px, 1px, 1px, 1px);
        }
        .site-header hgroup {
            background: none;
            padding: 0;
        }
    <?php
        // If the user has set a custom color for the text use that
        else :
    ?>
        .site-title a,
        .site-description {
            color: #<?php echo get_header_textcolor(); ?> !important;
        }
    <?php endif; ?>
    </style>
    <?php
}
endif; // shape_header_style
 
if ( ! function_exists( 'shape_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see shape_custom_header_setup().
 *
 * @since Shape 1.0
 */
function shape_admin_header_style() {
?>
    <style type="text/css">
    .appearance_page_custom-header #headimg { /* This is the container for the Custom Header preview. */
        background: #33605a;
        border: none;
        min-height: 0 !important
    }
    #headimg h1 { /* This is the site title displayed in the preview */
        font-size: 45px;
        font-family: Georgia, 'Times New Roman', serif;
        font-style: italic;
        font-weight: normal;
        padding: 0.8em 0.5em 0;
    }
    #desc { /* This is the site description (tagline) displayed in the preview */
        padding: 0 2em 2em;
    }
    #headimg h1 a,
    #desc {
        color: #e9e0d1;
        text-decoration: none;
    }
    </style>
<?php
}
endif; // shape_admin_header_style
 
if ( ! function_exists( 'shape_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see shape_custom_header_setup().
 *
 * @since Shape 1.0
 */
function shape_admin_header_image() { ?>
    <div id="headimg">
        <?php
        if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
            $style = ' style="display:none;"';
        else
            $style = ' style="color:#' . get_header_textcolor() . ';"';
        ?>
        <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
        <?php $header_image = get_header_image();
        if ( ! empty( $header_image ) ) : ?>
            <img src="<?php echo esc_url( $header_image ); ?>" alt="" />
        <?php endif; ?>
    </div>
<?php }
endif; // shape_admin_header_image
