<?php
/**
 * Template Name: Special Layout
 * This is short description
 *
 * @package WordPress
 */

get_header();?> 
<h3>This is page.php from special-template.php</h3>
<?php echo get_page_template_slug();?></br>
<?php  $a=wp_get_theme()->get_page_templates();
	print_r($a);?> </br>

<?php checkfront(); ?>

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
<div class="card mb-4 content" >
<img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
<div class="card-body">
<a href="<?php the_permalink(); ?>"><h2 class="card-title"><?php the_title(); ?></h2></a>
<p class="card-text"><?php the_content(); ?></p>
<a href="#" class="btn btn-primary">Read More &rarr;</a>
</div>
<div class="card-footer text-muted">
Posted on January 1, 2017 by
<a href="#">Start Bootstrap</a>
</div>
</div>

		<?php
	}
}
checkpage();
?>
<div class="info-box">
<h3>text goes here. this text is coming by changing the template of this page in the page attribute in dashboard . this is the way of changing template of more then one page.</h3>
</div>
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

<?php get_footer();
?>
