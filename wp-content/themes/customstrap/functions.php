<?php
//NO DIRECT ACCESS TO FILE
defined('ABSPATH') || exit;





include_once('yc_custom/functions.php');

//DEFINE THE MODULES
$customstrap_includes = array(
    '/clean-head.php',    // Eliminates useless meta tags, emojis, etc
    '/enqueues.php',     // Enqueue scripts and styles.
    '/understrap-tweaks.php', // Overrides theme tags
    '/customizer-assets/google-fonts.php', //loads an array for the fonts list in Customizer
    '/customizer-assets/customizer.php',    //Defines Customizer options
    //'/customizer-assets/scss-compiler.php', //To interface the Customizer with the SCSS php compiler
);
//INCLUDE THE FILES
foreach ($customstrap_includes as $file) {
    $filepath = locate_template('functions' . $file);
    if (!$filepath) {
        trigger_error(sprintf('Error locating /inc%s for inclusion', $file), E_USER_ERROR);
    }
    require_once $filepath;
}

//OPTIONAL: DISABLE WORDPRESS COMMENTS
if (get_theme_mod("singlepost_disable_comments")) require_once locate_template('/functions/optin/disable-comments.php');

//OPTIONAL: LIGHTBOX WORDPRESS COMMENTS
if (get_theme_mod("enable_lightbox")) require_once locate_template('/functions/optin/lightbox.php');

//OPTIONAL: SHARING BUTTONS
if (get_theme_mod("enable_sharing_buttons")) require_once locate_template('/functions/optin/sharing-buttons.php');

//OPTIONAL: BACK TO TOP
if (get_theme_mod("enable_back_to_top")) require_once locate_template('/functions/optin/back-to-top.php');


// LOAD CHILD THEME TEXTDOMAIN
add_action('after_setup_theme', function () {
    load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');
});

// CUSTOM ADDITIONAL CSS
//add_action( 'wp_enqueue_scripts', 'cs_enqueue_child_theme_styles' );
//function cs_enqueue_child_theme_styles() {	wp_enqueue_style( 'custom', get_stylesheet_directory_uri().'/custom.css' ); }

// CUSTOM ADDITIONAL JS
//add_action( 'wp_enqueue_scripts', 'cs_custom_script_load' );
//function cs_custom_script_load() {wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/custom.js', array('jquery'), null, true); }


