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
}

function request_script(){
	wp_enqueue_script('my_script',PLUGIN_URL.'/plugin_demo/js/script.js','',PLUGIN_VERSION,true);
	wp_localize_script('my_script','ajax',admin_url('admin-ajax.php'));
	wp_enqueue_script("jquery");
}
add_action('init','request_script');

function owt_include_scripts(){
	wp_enqueue_script("jquery");
}
add_action("wp_enqueue_scripts","owt_include_scripts");


