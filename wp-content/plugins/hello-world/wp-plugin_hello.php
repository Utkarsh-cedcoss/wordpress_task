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
        'section_setting'
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
    <input type="text" name="setting_options" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

