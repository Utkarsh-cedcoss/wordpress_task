<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>
<?php
/**
 * This is comment
 *
 * @package WordPress
 */

bloginfo('name') ?>|<?php bloginfo( 'description' ); ?></title>

<?php
//bloginfo('name') displays title of the page.
// bloginfo('description') displays description of the page
// echo bloginfo( 'stylesheet_directory' ).
// echo bloginfo( 'template_url' ).
// echo get_stylesheet_uri().
// echo get_template_directory_uri().
?>

<?php
wp_head();
?>
</head>

<body <?php body_class();?>>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
<!-- <a class="navbar-brand" href="#">Start Bootstrap</a> -->
<?php
if ( function_exists( 'themename_custom_logo_setup' ) ) {
	the_custom_logo();
}
?>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">

<?php
	wp_nav_menu(
		array(
			'menu'       => 'primary-menu',
			'container'  => '',
			'items_wrap' => '<ul class="nav navbar-nav navbar-right headerMenu">%3$s</ul>',
		)
	);
	?>
</div>
<p>button</p>
</div>
</nav>
<!-- <p>this colour of button changes due to customizer API</p></br> -->
<button type="button" style="background-color: <?php echo get_option('owt_color_picker_id');?>;">Book Now</button></br>
<!-- <img alt="" src="<?php //header_image(); ?>" width="<?php //echo absint( get_custom_header()->width ); ?>" height="<?php //echo absint( get_custom_header()->height ); ?>"> -->
<?php if(get_header_image()){ ?>
	<img alt="" src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>">
<?php } else { ?>
	<img alt="" src = "<?php echo get_template_directory_uri().'/image/slider.jpg'; ?>" width="100%">
<?php }
?>
<h1 style="text-align: centre; color:red"><?php echo get_option('owt_first_txtbox_setting');?></h1>

<?php $pageid=get_option('owt_setting_header_link');
echo get_the_permalink($pageid); ?>

<a style="text-align:center" href="<?php echo get_the_permalink($pageid);?>"><?php echo get_option('owt_first_header_link');?></a></br>
<hr>
