<!-- Footer -->
<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
	</div>
	<?php 
	 $data=get_option('setting_options');
	 $data1=get_option('setting_options1');
	 
	?>
	<a href=http://<?php echo $data; ?>>Facebook</a></br>
	<a href=http://<?php echo $data1; ?>>Twitter</a>
	<!-- /.container -->
	
</footer>

<!-- Bootstrap core JavaScript -->
<!-- <script src=" //echo bloginfo('template_url');?>/vendor/jquery/jquery.min.js"></script>
<script src=" //echo bloginfo('template_url');?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->

<?php
/**
 * This is comment
 *
 * @package WordPress
 */

wp_footer(); ?>

</body>

</html>

