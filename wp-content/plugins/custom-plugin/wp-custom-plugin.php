<?php
/**
 * @package Hello_Dolly
 * @version 1.7.2
 */
/*
Plugin Name: Custom Plugin
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is the description of this plugin.
Author: Utkarsh Saxena
Version: 1.7.2
Author URI: http://ma.tt/
*/

// thes are constants which we have defined to use them later in our code.
define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__)); //this gives a path to this file in directory form, which is in this constant variable.
define("PLUGIN_URL",plugins_url()); //this is used when we apply css and javascript. this also provide path but in url form.
define("PLUGIN_VERSION","1.0");

// this function will add menu and submenu of plugin.
function add_my_custom_menu(){
	add_menu_page(
	"customplugin", //page title
	"Custom Plugin", //menu title
	"manage_options", //admin level
	"custom-plugin", // page slug
	"add_new_function", // callback function
	"dashicons-buddicons-replies", // icon url
11); //position

add_submenu_page(
	"custom-plugin", //parent slug
	"Add New", // page title
	"Add New", // menu title
	"manage_options", // capability= user level access
	"custom-plugin",  // menu slug
	"add_new_function" // callback function
);

add_submenu_page(
	"custom-plugin", //parent slug
	"All Pages", // page title
	"All Pages", // menu title
	"manage_options", // capability= user level access
	"all-pages",  // menu slug
	"all_pages" // callback function
);

}
add_action("admin_menu","add_my_custom_menu");

function add_new_function(){
	include_once PLUGIN_DIR_PATH."/views/add-new.php";
}

// function add_new_function(){
// 	echo "this is my first sub menu";
// }

function all_pages(){
	include_once PLUGIN_DIR_PATH."/views/all-page.php";
}
//---------------------------------------------------------------------------------------------------------------
// this function is here to include css and js files.
function custom_plugin_assets(){
	// to attach css and js files.
		wp_enqueue_style(
			"cpl_style", // unique name or id for css file.
			PLUGIN_URL.'/custom-plugin/assets/css/style.css',  // css file path.
			'', // dependency on other files.
			PLUGIN_VERSION //plugin version number.
		);

		wp_enqueue_script(
			"cpl_script",  // unique name or id for js file.
			PLUGIN_URL.'/custom-plugin/assets/js/script.js',
			'',  //dependency on other files.
			PLUGIN_VERSION, // plugin version number.
			false
		);

		// this part is to add custom javascript. we can add custom javascript file.
		
		wp_localize_script("cpl_script", // id of the script which will handle the data.
		"ajaxurl", // name of the object or can also say object key.
		admin_url('admin-ajax.php') // the data  or can also say object value or. Here Retrieves the URL to the admin area for the current site.
		);

}
add_action("init","custom_plugin_assets");

// handling ajax request
if(isset($_REQUEST['action'])){  // it checks action parameter is set or not.
	switch($_REQUEST['action']){  // if set pass to switch method to match cases.
		case "custom_plugin_library" : add_action("admin_init","add_custom_plugin_library");  // match case.

		function add_custom_plugin_library(){  // function attached with the action hook.
			global $wpdb;
			include_once PLUGIN_DIR_PATH."/library/custom-plugin-lib.php";  // ajax handler file within /library folder.
		}
	break;
	}
}

//-------------------------------------------------------------------------------------------------------------------
// code to generate table
function custom_plugin_tables(){
	global $wpdb;  // we have to use this global object to run any query in wordpress.
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // we have included this file because we are using dbDelta() which is defined in this file.

	if(count($wpdb->get_var('SHOW TABLES LIKE "wp_custom_plugin"'))==0){  // get_var() returns result in string format.
		$sql_query_to_create_table="CREATE TABLE `wp_custom_plugin` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(50) NOT NULL,
			`email` varchar(50) NOT NULL,
			`phone` varchar(10) NOT NULL,
			`created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
			PRIMARY KEY (`id`)
		  ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

		dbDelta($sql_query_to_create_table);  // this function Modifies the database based on specified SQL statements or we can also say Useful for creating new tables and updating existing tables to a new structure.
	}
}
register_activation_hook(__FILE__,'custom_plugin_tables');  // Set the activation hook for a plugin. we can also say that it will run this 'custom_plugin_tables' function when plugin will be activated.

//-------------------------------------------------------------------------------------------------------------------------------------------------------
// code to drop table on deactivation of plugin
// NOTE:- register_uninstall_hook() will delete table when we delete the plugin and
// register_deactivate_hook() will delete table when we deactivate the plugin.
// register_uninstall_hook() will delete when we delete our plugin.
function deactivate_table(){
	global $wpdb;
	$wpdb->query("DROP table IF Exists wp_custom_plugin");

	// deleting page on deactivation of plugin that we made dynamically on activation of plugin:
	// step1. we get the id of post i.e. page.
	// step2. delete the post from table.

	$the_post_id=get_option('custom_plugin_page_id'); // this function will return the value of the name 'custom_plugin_page_id' from wp_options table.
	if(!empty($the_post_id)){
		wp_delete_post($the_post_id,true); // this function will delete the post from wp_options table. it takes post id as parameter. we pass 'true' if we want to delete table forcefully. 
	}   // Remember:- here we have used 'register_deactivation_hook' so, here page will be deleted only from wp_post table but not from wp_options table. To do that we have to use 'register_uninstall_hook' in place of 'register_deactivation_hook'.

	delete_option('custom_plugin_page_id');  // this function will delete the page data from wp_options table.
	
}
register_deactivation_hook(__FILE__,'deactivate_table');

//--------------------------------------------------------------------------------------------------------------------------------------------------------------

// this function is to create a page dynamically when we activate our plugin.
// to create a page we have to pass these parameters in arrays.
// Remember- while making pages this way, 'post_title' and 'post_slug' should be same.

function create_page(){
	$page=array();
	$page['post_title']="Custom Plugin Online Web Tutor";
	$page['post_content']="Learning Platform for Wordpress Customization for theme,Plugin and widgets";
	$page['post_status']="publish";
	$page['post_slug']="custom-plugin-online";
	$page['post_type']="page";

	$post_id=wp_insert_post($page); // this function inserts the page info. in wp_posts table and also return the page id which we will use to insert page info. in wp_options table
	add_option("custom_plugin_page_id",$post_id);  // this function will add data in wp_option table. option_name= 'custom_plugin_page_id' and option_value=$post_id. 
}
register_activation_hook(__FILE__,'create_page');