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

define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__));
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
		echo "Here we will try our ajax things";
		echo "</br>";
		?>
		<button class="btn">click here</button>
		<?php

	}

	function add_all_pages(){
		echo "we are in add all pages";
		echo PLUGIN_URL;
	}


