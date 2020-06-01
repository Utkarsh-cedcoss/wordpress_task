<?php
/**
 * This is comment
 *
 * @package WordPress
 */

?>
<!-- Sidebar Widgets Column -->
<div class="col-md-4">
<h3><?php echo home_url( '/' ); ?></h3>
<?php
wp_nav_menu(
	array(
		'menu'       => 'sidebar-menu',
		'container'  => '',
		'items_wrap' => '<ul class="nav navbar-nav navbar-right headerMenu">%3$s</ul>',
	)
);
?>

	<!-- Search Widget -->
		<div class="card my-4">
		<h5 class="card-header">Search</h5>
			<div class="card-body">
				<div class="input-group">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>

	<!-- Categories Widget -->
	<div class="card my-4">
		<h5 class="card-header">Categories</h5>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-6">
					<ul class="list-unstyled mb-0">
						<li>
							<a href="#">Web Design</a>
						</li>
						<li>
							<a href="#">HTML</a>
						</li>
						<li>
							<a href="#">Freebies</a>
						</li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul class="list-unstyled mb-0">
						<li>
							<a href="#">JavaScript</a>
						</li>
						<li>
							<a href="#">CSS</a>
						</li>
						<li>
							<a href="#">Tutorials</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Side Widget -->
	<div class="card my-4">
		<h5 class="card-header">Side Widget</h5>
		<div class="card-body">
			You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
		</div>
	</div>

</div>
