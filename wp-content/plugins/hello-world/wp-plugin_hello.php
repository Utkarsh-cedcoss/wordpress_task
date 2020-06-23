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

define("THIS_PLUGIN",plugins_url());
define("THE_PATH",plugin_dir_path(__FILE__));
define("THE_VERSION","2.0");


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
     echo '</br>';
     $word_count = str_word_count( strip_tags( $content ));
     echo 'This article contains '.$word_count.' characters';
     return $content;$word_count;
     
     
    
     }
     else{
         return $content;
     }
 }
 add_filter('the_content', 'wporg_filter_title');

//--------------------------------------------------------------------------------------------------------------------------------------


/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */
 
/**
 * custom option and settings
 */
function wporg_settings_init() {
 // register a new setting for "wporg" page
 register_setting( 'wporg', 'wporg_options' ); // 'wporg' is page slug. 'wporg_options' is The name of an option to sanitize and save.
 
 // register a new section in the "wporg" page
 add_settings_section(
 'wporg_section_developers', //id
 __( 'The Matrix has you.', 'wporg' ), // title of the section
 'wporg_section_developers_cb', // callback function
 'wporg' // page slug. that page slug that we gived when we registered the menu.
 );
 
 // register a new field in the "wporg_section_developers" section, inside the "wporg" page
 add_settings_field(
 'wporg_field_pill', // as of WP 4.6 this value is used only internally    //id
 // use $args' label_for to populate the id inside the callback
 __( 'Pill', 'wporg' ),  // title
 'wporg_field_pill_cb',  // callback function
 'wporg',  //page slug
 'wporg_section_developers',  // section id
 [                                                // args (optional)
 'label_for' => 'wporg_field_pill',
 'class' => 'wporg_row',
 'wporg_custom_data' => 'custom',
 ]
 );
}
 
/**
 * register our wporg_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'wporg_settings_init' );
 
/**
 * custom option and settings:
 * callback functions
 */
 
// developers section cb
 
// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function wporg_section_developers_cb( $args ) {
 ?>
 <p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
 <?php
}
 
// pill field cb
 
// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: label_for, class.
// the "label_for" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function wporg_field_pill_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'wporg_options' );
 // output the field
 ?>
 <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
 name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
 >
 <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'red pill', 'wporg' ); ?>
 </option>
 <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'blue pill', 'wporg' ); ?>
 </option>
 </select>
 <p class="description">
 <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
 </p>
 <p class="description">
 <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
 </p>
 <?php
}
 
/**
 * top level menu
 */
function wporg_options_page() {
 // add top level menu page
 add_menu_page(
 'WPOrg',  //page title
 'WPOrg Options', //menu title
 'manage_options', //admin level
 'wporg', // page slug
 'wporg_options_page_html' //callback function
 );
}
 
/**
 * register our wporg_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'wporg_options_page' );
 
/**
 * top level menu:
 * callback functions
 */
function wporg_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 // add error/update messages
 
 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {

    
 // add settings saved message with the class of "updated"
 add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
 }
 
 // show error/update messages
	settings_errors( 'wporg_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wporg"
 settings_fields( 'wporg' );


 // output setting sections and their fields
 // (sections are registered for "wporg", each field is registered to a specific section)
 do_settings_sections( 'wporg' );


 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}

//-----------------------------------------------------------------------------------------------------------------------------
// another example of custom setting.

function custom_menu_page(){
    add_menu_page('custom_settings',  //page title
    'own_custom_settings',  //menu title
    'manage_options',  //admin level
    'own-custom-settings',  //page slug
    'callback_first'  //callback function
);
}
add_action('admin_menu','custom_menu_page');

function callback_first(){
    echo "welcome to my settings";
    ?>
    <h1><?php echo esc_html(get_admin_page_title());?></h1>
    <form action="options.php" method="post">
    <?php
    settings_fields( 'own-custom-settings' );
    do_settings_sections( 'own-custom-settings' );
    submit_button( 'Save Settings' );
    ?>
    </form>
    <?php
}


function setting_init(){
    register_setting('own-custom-settings','setting_options');

    add_settings_section(
        'section_setting',  //id
        'section setting',  //title
        'callback_second',  // callback function
        'own-custom-settings' // page slug

    );

    add_settings_field(
        'setting_field',
        'setting_field Title',
        'callback_third',
        'own-custom-settings',
        'section_setting',
        [
            'label_for'=>'setting_field',
            'class'=>'first_class',
        ]
    );
}
add_action('admin_init','setting_init');

function callback_second(){
    echo "this text is due to second callback function";
}

function callback_third(){
    // echo "this text is due to third callback function";
    $setting=get_option('setting_options');
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="setting_options" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}



////////////////////////////////////////////////////////////////////////



function setting_init1(){
    register_setting('own-custom-settings','setting_options1');

    add_settings_section(
        'section_setting1',  //id
        'section setting1',  //title
        'callback_second1',  // callback function
        'own-custom-settings' // page slug

    );

    add_settings_field(
        'setting_field1',
        'setting_field Title1',
        'callback_third1',
        'own-custom-settings',
        'section_setting1',
        [
            'label_for'=>'setting_field',
            'class'=>'first_class',
        ]
    );
}
add_action('admin_init','setting_init1');

function callback_second1(){
    echo "this text is due to second callback function";
}

function callback_third1(){
    // echo "this text is due to third callback function";
    $setting1=get_option('setting_options1');
    ?>
    <input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="setting_options1" value="<?php echo isset( $setting1 ) ? esc_attr( $setting1 ) : ''; ?>">
    <?php
}

//--------------------------------------------------------------------------------------------------------------------
// this function is to register custom post type.
function wporg_custom_post_type() {
    register_post_type('wporg_product',  // id or key  // when we will make any new post using this custom post type then in wp_post the post type will be 'wporg_product'.
        array(
            'labels'      => array(
                'name'          => __( 'Products', 'textdomain' ), // name that will be shown on label.
                'singular_name' => __( 'Product', 'textdomain' ),
            ),
            'public'      => true,  // related to visibility.
            'show_in_nav_menus'=>true, // if we want our post of this custom post type to be shown in nav menu the set it true.
            'has_archive' => true,  
            'rewrite'     => array( 'slug' => 'products' ), // my custom slug
            'supports' => array('title','editor','excerpt','author','comments','revisions','custom-fields'),  // to add some more features.
        )
    );
}
add_action('init', 'wporg_custom_post_type');

//------------------------------------------------------------------------------------------------------------------------------------
// this function is to register custom taxonomy.
// by default wordpress provide two taxonomies categories and tags.

function wporg_register_taxonomy_course()
{
    $labels = [
        'name'              => _x('Courses', 'taxonomy general name'),
'singular_name'     => _x('Course', 'taxonomy singular name'),
'search_items'      => __('Search Courses'),
'all_items'         => __('All Courses'),
'parent_item'       => __('Parent Course'),
'parent_item_colon' => __('Parent Course:'),
'edit_item'         => __('Edit Course'),
'update_item'       => __('Update Course'),
'add_new_item'      => __('Add New Course'),
'new_item_name'     => __('New Course Name'),
'menu_name'         => __('Course'),
];
$args = [
'hierarchical'      => true, // make it hierarchical (like categories)
'labels'            => $labels,
'show_ui'           => true,
'show_admin_column' => true,
'query_var'         => true,
'rewrite'           => ['slug' => 'course'],
];
register_taxonomy('course', ['post'], $args);
}
add_action('init', 'wporg_register_taxonomy_course');

//----------------------------------------------------------------------------------------------------------------------------
function menu_maker(){
    add_menu_page(
        "AJAX_MENU", //page title
        "AJAX DEMO", //menu title
        "manage_options", //admin level
        "demo-ajax", // page slug
        "ajax_function", // callback function
        "dashicons-visibility", // icon url
    11); //position
}
add_action("admin_menu","menu_maker");

function ajax_function(){
    include_once THE_PATH."/hello-world_addnew.php";
}

function making_script(){
    wp_enqueue_script('hello-world-script',
    THIS_PLUGIN.'/hello-world/hello-world_script.js',
    array('jquery')
);

wp_localize_script(
    'hello-world-script',
    'object',
    array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('ajax-nonce')
    )
);
}
add_action('init','making_script');



function example_ajax(){
    $nonce=$_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'hello-world-script' ) ) {
        die( 'Nonce value cannot be verified.' );
    }

    if ( isset($_REQUEST) ) {
     
        $fruit = $_REQUEST['fruit'];
         
        // Let's take the data that was sent and do something with it
        if ( $fruit == 'grapes' ) {
            $fruit = 'Apple';
        }
     
        // Now we'll return it to the javascript function
        // Anything outputted will be returned in the response
        echo $fruit;
         
        // If you're debugging, it might be useful to see what was sent in the $_REQUEST
        // print_r($_REQUEST);
     
    }
     
    // Always die in functions echoing ajax content
   die();
}
add_action('wp_ajax_ajax_request','example_ajax');
add_action('wp_ajax_nopriv_ajax_request','example_ajax');