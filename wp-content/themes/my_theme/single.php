<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();?> 

<?php if( is_single() ){
	echo "this is coming bcoz of is_single() function and we can also provide post id in this function as an parameter";
	}?>
<h3>This is single.php page</h3>
<?php checkfront();?></br>
<!-- post type:<?php //echo get_post_type();?> -->


<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">

<h1 class="my-4">Page Heading
<small>Secondary Text</small>
</h1>

<?php

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>

<!-- Blog Post -->
<div class="card mb-4">
	<?php echo get_post_type();?>
	<!-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
	<?php the_post_thumbnail( 'banner-image' ); ?>
	<div class="card-body">
		<a href="<?php the_permalink(); ?>"><h2 class="card-title">Single.php<?php the_title(); ?></h2></a>
		<p class="card-text"><?php the_content(); ?></p>
		<a href="#" class="btn btn-primary">Read More &rarr;</a>
	</div>
	<div class="card-footer text-muted">
		Posted on January 1, 2017 by
		<a href="#"><?php the_author(); ?></a>
	</div>
</div>

		<?php
	}
}
?>

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
<li class="page-item">
<a class="page-link" href="#">&larr; Older</a>
</li>
<li class="page-item disabled">
<a class="page-link" href="#">Newer &rarr;</a>
</li>
</ul>

</div>

<?php get_sidebar(); ?>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

<?php get_footer(); ?>
