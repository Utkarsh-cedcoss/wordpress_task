<?php
/**
 * @package self made plugin
 * @version 1.7.2
 */
/*
Plugin Name: Demo Plugin
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is the description of this plugin.
Author: Utkarsh Saxena
Version: 1.7.2
Author URI: http://ma.tt/
*/

define("PLUGIN_DIRECTORY_PATH",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugins_url()); //this is used when we apply css and javascript. this also provide path but in url form.
define("PLUGIN_VERSION","1.0");

function custom_menu(){
	add_menu_page(
	"plugin_demo", //page title
	"plugin_demo", //menu title
	"manage_options", //admin level
	"demo-plugin", // page slug
	"new_function", // callback function
	"dashicons-visibility", // icon url
11); //position

add_submenu_page(
	"demo-plugin", //parent slug
	"Add New", // page title
	"Add New", // menu title
	"manage_options", // capability= user level access
	"demo-plugin",  // menu slug
	"new_function" // callback function
);

add_submenu_page(
	"demo-plugin", //parent slug
	"All Page", // page title
	"All Page", // menu title
	"manage_options", // capability= user level access
	"all-page",  // menu slug
	"add_all_pages" // callback function
);

add_submenu_page(
	"demo-plugin",  //parent slug
	"custom-form" , //page title
	"custom form",  //menu title
	"manage_options", // capability= user level access
	"custom-form",  //menu slug
	"a_callback" // callback function
);
    }
	add_action("admin_menu","custom_menu");
	
function new_function(){
	include_once PLUGIN_DIRECTORY_PATH."views/add_new.php";
	//echo "Here we will try our ajax things";
	//echo "</br>";
		

}

function add_all_pages(){
	echo "we are in add all pages";
	echo PLUGIN_URL;
	
$args = array(
    'post_type'      => 'wporg_product',
    'posts_per_page' => 10,
);
$loop = new WP_Query($args);
while ( $loop->have_posts() ) {
    $loop->the_post();
    ?>
    <div class="entry-content">
        <?php the_title(); ?>
        <?php the_content(); ?>
    </div>
    <?php
}

global $wpdb;
// simply we just pull some data from wp_posts table
$db_results=$wpdb->get_results(
	$wpdb->prepare(
		"SELECT * FROM wp_posts order by ID limit 5",''
	)
);
echo "<pre>";print_r($db_results); echo "</pre>";
}

function a_callback(){
	//echo "we are in this custom form";
	include_once PLUGIN_DIRECTORY_PATH."views/custom_form.php";
}

//-----------------------------------------------------------------------------------------------------------
function wporg_filter_feedback($content)
 {
     if(is_page('user feedback')){  // 'user feedback is the title of the page we made (post type->page).
		
		include_once PLUGIN_DIRECTORY_PATH."views/custom_form.php";  // including html form.
	 }
 }
 add_filter('the_content', 'wporg_filter_feedback');  // adding filter with 'the_content' hook.


//-------------------------------------------------------------------------------------------------------------------

// this following function registers and localizes the script.

function request_script()
{
	wp_enqueue_script('my_script',    // id of the script
	PLUGIN_URL.'/plugin_demo/js/script.js',  // path of that script file in url form
	'', //dependency
	PLUGIN_VERSION, // plugin version (constant)
	true); // true means script will be added in footer
	
	wp_localize_script('my_script',  // id of the script
	'ajax',  // object
	array(   // values of this object
		'ajax_url'=> admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
	));
	wp_enqueue_script("jquery"); // to support jquery in this script. this could also be written above in the place of dependency.
}
add_action('init','request_script');  // binding function with action hook.

function owt_include_scripts()
{
	wp_enqueue_script("jquery");  // could be written above
}
add_action("wp_enqueue_scripts","owt_include_scripts");



/////////////////////////////////////
//
//  this function handles the request coming from .js file.
function example_ajax_request(){
	$nonce=$_POST['nonce'];

	if ( ! wp_verify_nonce( $nonce, 'my-script' ) ) {
        die( 'Nonce value cannot be verified.' );
	}

	if(isset($_REQUEST)){
		$info=$_REQUEST['info'];

		print_r($info);
	}

	wp_die();
	

}
add_action( 'wp_ajax_example_ajax_request', 'example_ajax_request' );
 
// If you wanted to also use the function for non-logged in users (in a theme for example)
add_action( 'wp_ajax_nopriv_example_ajax_request', 'example_ajax_request' );





// add_action("wp_ajax_demo_aj","ajax_handler_function");
// add_action("wp_ajax_nopriv_demo_aj","ajax_handler_function");

// function ajax_handler_function(){
// 	if(isset($_REQUEST['data'])){
// 		$data=$_REQUEST['data'];

// 		echo json_encode($data);
// 	}
// 	wp_die();

	
// }

//--------------------------------------------------------------------------------------------------

add_shortcode("own-plugin","customPluginFunction");

function customPluginFunction(){
	//echo "Hello online web tutor";
	include_once PLUGIN_DIRECTORY_PATH."/views/shortcode_demo.php";
}

//---------------------------------------------------------------------------------------------------
// this function handles the request coming from .js file.
function feedback_ajax_function(){  
if ( isset($_REQUEST) ) {
     
	$information = $_REQUEST['info'];
	
	$page=array();
	$page['post_title']=$information[0];
	$page['post_content']=$information[2];
	$page['post_status']="publish";
	$page['post_slug']=$information[0].'-feedback';
	$page['post_type']="post_feedback";

$post_id=wp_insert_post($page);  // inserting data in wp_posts table. this function returns postid.
	
	

	//print_r($information);
	echo $post_id;
	 
	
 
}
 
// Always die in functions echoing ajax content
die();
}
add_action('wp_ajax_feedback_form','feedback_ajax_function');  // 'wp_ajax' is action hook and 'feedback_form' is the action we gave at the time of sending the request. We write it in this way only.
add_action('wp_ajax_nopriv_feedback_form','feedback_ajax_function');  // 'wp_ajax_nopriv' is action hook and 'feedback_form' is the action we gave at the time of sending the request. We write it in this way only.



