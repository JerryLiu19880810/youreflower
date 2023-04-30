<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/////////THEME TWEAKS FOR CUSTOMIZING ENTRY HEADER / FOOTER, POST NAVIGATION, ETC
customstrap_tweak_theme();
//add_action("template_redirect","customstrap_tweak_theme");

function customstrap_tweak_theme(){
	
	//HIDE POSTED ON / AUTHOR ENTRY META ON SINGLE POSTS 
	if (get_theme_mod("singlepost_disable_entry_meta") ) {
		
		if (!function_exists('understrap_posted_on')): function understrap_posted_on() {} endif;
	}
	//HIDE POSTED IN / CATS N TAGS ON SINGLE POSTS 
	if (get_theme_mod("singlepost_disable_entry_footer") ) {
		
		if (!function_exists('understrap_entry_footer')): function understrap_entry_footer() {}  endif;
	}
	
	//HIDE WP POST NAVIGATION LINKS 
	if (get_theme_mod("singlepost_disable_posts_nav") ) {
		
		if (!function_exists('understrap_post_nav')): function understrap_post_nav() {}  endif;
	}

}

// FIX WORDPRESS CATEGORY / ARCHIVE TITLES /////////
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $title;
});


//FOOTER TEXT CUSTOMIZATION
if(!function_exists('understrap_site_info')):
	function understrap_site_info(){
		$footer_text_setting = get_theme_mod("customstrap_footer_text");
		?>
			<div class="site-info small">
				<?php if (strlen($footer_text_setting) > 0) echo $footer_text_setting; else echo'<a href="http://wordpress.org/">Proudly powered by WordPress</a><span class="sep"> | </span>Theme: CustomStrap by <a href="http://livecanvas.com">livecanvas.com</a>.'; ?>
				<?php if (current_user_can("administrator") && strlen($footer_text_setting) <= 0): ?> You can edit this text using the WordPress Customizer.<?php endif ?>
			</div>
						
		<?php
	}
endif;

