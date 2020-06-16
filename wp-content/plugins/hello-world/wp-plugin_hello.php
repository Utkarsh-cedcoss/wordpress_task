<?php
/**
 * @package self made plugin
 * @version 1.7.2
 */
/*
Plugin Name: Hello World
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: This is the description of this plugin.
Author: Utkarsh Saxena
Version: 1.7.2
Author URI: http://ma.tt/
*/


function add_my_menu(){
    add_menu_page(
    "helloworld",
    "HelloWorld",
    "manage_options",
    "hello-world",
    "add_function",
    "dashicons-buddicons-replies",
    );
    }
    add_action("admin_menu","add_my_menu");
    
    function add_function(){
    echo "here we will display time";
    $date=date("h:i:sa");
    echo $date;
    }


