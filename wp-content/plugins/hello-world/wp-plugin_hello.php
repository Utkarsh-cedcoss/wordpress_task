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
function add_time(){
    $current_time=date("h:i:sa");
    add_option("date",$current_time);
}
register_activation_hook(__FILE__,'add_time');


function delete_time(){
    delete_option('date');
}
register_deactivation_hook(__FILE__,'delete_time');

// if(is_single()){
//     echo "this is dingle.php";
// }

 function wporg_filter_title($content)
 {
     if(is_single()){
     //return 'The ' . $content . ' was filtered';
     // $content='the' . $content
     ?>
     <a href="https://twitter.com/intent/tweet?url=<?php the_permalink();?>">Click here to post on twitter</a>
     <?php
     return $content;
     
     
    
     }
     else{
         return $content;
     }
 }
 add_filter('the_content', 'wporg_filter_title');