<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

function customstrap_enqueue_styles() {

    ////// IF  RECOMPILED STYLE IS PRESENT, DISABLE THE ORDINARY STYLE AND ENQUEUE THE RECOMPILED ///
    //$compiled_style_url=customstrap_get_compiled_css_url();
    //die($compiled_style_url);
    if(@$compiled_style_url) {
        wp_dequeue_style( 'understrap-styles' );
        wp_enqueue_style( 'understrap-styles',  $compiled_style_url);
    } //end if

}
add_action( 'wp_enqueue_scripts', 'customstrap_enqueue_styles' );



//ADD THE CUSTOM HEADER CODE (SET IN CUSTOMIZER)
add_action( 'wp_head', 'customstrap_add_header_code' );
function customstrap_add_header_code() {
      if(! get_theme_mod("customstrap_fonts_header_code_disable")) echo get_theme_mod("customstrap_fonts_header_code")." ";
	  echo get_theme_mod("customstrap_header_code");
}

//ADD THE CUSTOM FOOTER CODE (SET IN CUSTOMIZER)
add_action( 'wp_footer', 'customstrap_add_footer_code' );
function customstrap_add_footer_code() {
	  //if (!current_user_can('administrator'))
      echo get_theme_mod("customstrap_footer_code");
}

//ADD THE CUSTOM CHROME COLOR TAG (SET IN CUSTOMIZER)
add_action( 'wp_head', 'customstrap_add_header_chrome_color' );
function customstrap_add_header_chrome_color() {
	 if (get_theme_mod('customstrap_header_chrome_color')!=""):
        ?><meta name="theme-color" content="<?php echo get_theme_mod('customstrap_header_chrome_color'); ?>" />
	<?php endif;
}
