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

get_header();
?> 

<h3>This is page-44.php(about us page)</h3>

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
	<img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
	<div class="card-body">
		<a href="<?php the_permalink(); ?>"><h2 class="card-title"><?php the_title(); ?></h2></a>
		<p class="card-text"><?php the_content(); ?></p>
		<a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More &rarr;</a>
	</div>
	<div class="card-footer text-muted">
		Posted on <a href="#"><?php the_date(); ?></a> by
		<a href="#"><?php the_author(); ?></a>
		<a href="#"><?php the_category(); ?></a>

	</div>
</div>

		<?php
		$our_current_page = get_query_var( 'paged' );

		$aboutposts = new WP_Query(
			array(
				'category_name'  => 'aboutus',
				'posts_per_page' => 1,
				'paged'          => $our_current_page,
				// note that when we use pagination on any static page then instead of 'paged' use 'page'.
			)
		);
		if ( $aboutposts->have_posts() ) {
			while ( $aboutposts->have_posts() ) {
				$aboutposts->the_post();
				?>
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				<?php
			}
			previous_posts_link();
			next_posts_link( 'Next Page', $aboutposts->max_num_pages );
			echo '<br>';

			echo paginate_links(
				array(
					'total' => $aboutposts->max_num_pages,
				)
			);
		}
		?>

		<?php
	}
	echo paginate_links();
	// previous_posts_link();.
	// next_posts_link();.
}
?>
<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
	<li class="page-item">
		<a class="page-link" href="#">&larr; Older</a>
	</li>
	<li class="page-item disabled">
		<a class="page-link" href="#">&rarr; Newer</a>
	</li>
</ul>

	</div>

<?php get_sidebar(); ?>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

<?php get_footer(); ?>
