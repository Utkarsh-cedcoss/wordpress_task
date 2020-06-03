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
* @package mytheme
*/

get_header();

?>

<!-- Page Content -->
<div class="container">
<div class="row">
<!-- Blog Entries Column -->
<div class="col-md-8">
<h1 class="my-4">DISPLAY
<small>404 PAGE</small></h1>
<div class="alert alert-danger">
PAGE NOT FOUND<br><br>
<a href="<?php echo esc_html( home_url( '/' ) ); ?>" class="btn btn-info">Go to home page</a>

</div>



</div>

<?php get_sidebar(); ?>
</div>
<!-- /.row -->
</div>
<!-- /.container -->
<?php get_footer(); ?>