<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// ADD CUSTOM JS & CSS TO CUSTOMIZER //////////////////////////////////////////////////////////////////////////////////////////////////////////
function customstrap_customize_enqueue() {
	wp_enqueue_script( 'custom-customize', get_stylesheet_directory_uri() . '/functions/customizer-assets/customizer.js', array( 'jquery', 'customize-controls' ), '2.63', true );
	wp_enqueue_script( 'custom-customize-lib', get_stylesheet_directory_uri() . '/functions/customizer-assets/customizer-vars.js', array( 'jquery', 'customize-controls' ), '2.61', true );
	wp_enqueue_style( 'custom-customize', get_stylesheet_directory_uri() . '/functions/customizer-assets/customizer.css'  );
	
	//fontpicker
	wp_enqueue_script( 'fontpicker', get_stylesheet_directory_uri() . '/functions/customizer-assets/fontpicker/jquery.fontpicker.min.js', array( 'jquery', 'customize-controls' ), '2.61', true );
	wp_enqueue_style( 'fontpicker', get_stylesheet_directory_uri() . '/functions/customizer-assets/fontpicker/jquery.fontpicker.min.css', array(), '2.61' );
}
add_action( 'customize_controls_enqueue_scripts', 'customstrap_customize_enqueue' );


//ADD BODY CLASSES  //////////////////////////////////////////////////////////////////////////////////////////////////////////
add_filter( 'body_class', 'customstrap_config_body_classes' );
function customstrap_config_body_classes( $classes ) {
	$classes[]="customstrap_header_navbar_position_".get_theme_mod('customstrap_header_navbar_position');
	return $classes;
}

//REMOVE BODY MARGIN-TOP GIVEN BY WORDPRESS ADMIN BAR //////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action('get_header', 'customstrap_filter_head');
function customstrap_filter_head() {
	if (get_theme_mod('customstrap_header_navbar_position')=="fixed-top") remove_action('wp_head', '_admin_bar_bump_cb');
}



///MAIN SETTING: DECLARE ALL SCSS VARIABLES TO HANDLE IN THE CUSTOMIZER
function customstrap_get_scss_variables_array(){
	return array(
		"colors" => array( //  $variable_name => $variable_props
			'$body-bg' => array('type' => 'color'),
			'$body-color' => array('type' => 'color'),
			'$link-color' => array('type' => 'color'),
			//'$link-decoration' => array('type' => 'text'),
			'$link-hover-color' => array('type' => 'color'),
			//'$link-hover-decoration' => array('type' => 'text'),
			// STATUS COLORS
			'$primary'=> array('type' => 'color','newgroup' => 'Bootstrap Colors'),
			'$secondary' => array('type' => 'color'),
			'$success' => array('type' => 'color'),
			'$info' => array('type' => 'color'),
			'$warning' => array('type' => 'color'),
			'$danger' => array('type' => 'color'),
			'$light' => array('type' => 'color'),
			'$dark' => array('type' => 'color'),
			),
		

		//add another section
		"options" => array( // $variable_name => $variable_props
						    
			'$enable-rounded' => array('type' => 'boolean', 'default' => 'true'),
			'$enable-shadows' => array('type' => 'boolean'),
			'$enable-gradients'=> array('type' => 'boolean'),
			
			'$spacer' => array('type' => 'text','placeholder' => '1rem'),
			
			'$border-width' => array('type' => 'text','placeholder' => '1px'),
			'$border-color' => array('type' => 'color' ),
			'$border-radius' => array('type' => 'text','placeholder' => '.25rem'),
			'$border-radius-lg' => array('type' => 'text','placeholder' => '.3rem'),
			'$border-radius-sm' => array('type' => 'text','placeholder' => '.2rem'),
			'$rounded-pill' => array('type' => 'text','placeholder' => '50rem'),
			 

			),
		
		
		
		//add another section
		"typography" => array( // $variable_name => $variable_props
			 
			'$enable-responsive-font-sizes' => array('type' => 'boolean'),
						 
			'$font-family-base' => array('type' => 'text', 'placeholder' => '$font-family-sans-serif ', 'newgroup' => 'Font Families', ), 
			'$font-family-sans-serif' => array('type' => 'text', 'placeholder' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" '),
			'$font-family-monospace' => array('type' => 'text', 'placeholder' => 'SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace '),
			
			'$font-size-base' => array('newgroup' => 'Font Sizes', 'type' => 'text', 'placeholder' => '1rem'),
			'$font-size-lg' => array('type' => 'text', 'placeholder' => '1.25rem'),
			'$font-size-sm' => array('type' => 'text', 'placeholder' => '.875rem '),
			
			'$font-weight-lighter' => array('newgroup' => 'Font Weights', 'type' => 'text', 'placeholder' => 'lighter '),
			'$font-weight-light' => array('type' => 'text', 'placeholder' => '300'),
			'$font-weight-normal' => array('type' => 'text', 'placeholder' => '400'),
			'$font-weight-bold' => array('type' => 'text', 'placeholder' => '700'),
			'$font-weight-bolder' => array('type' => 'text', 'placeholder' => 'bolder'),
			
			'$font-weight-base' => array('type' => 'text', 'placeholder' => '400'),
			'$line-height-base' => array('type' => 'text', 'placeholder' => '1.5'),
		
			'$headings-font-family' => array('type' => 'text', 'placeholder' => 'null','newgroup' => 'Headings', ),
			'$headings-font-weight' => array('type' => 'text', 'placeholder' => '500 '),
			'$headings-line-height' => array('type' => 'text', 'placeholder' => '1.2'),
			'$headings-color' => array('type' => 'color'),
			
			'$headings-margin-bottom' => array('type' => 'text', 'placeholder' => '$spacer / 2 '),
			'$h1-font-size' => array('type' => 'text', 'placeholder' => '2.5rem'),
			'$h2-font-size' => array('type' => 'text', 'placeholder' => '2rem'),
			'$h3-font-size' => array('type' => 'text', 'placeholder' => '1.75rem'),
			'$h4-font-size' => array('type' => 'text', 'placeholder' => '1.5rem'),
			'$h5-font-size' => array('type' => 'text', 'placeholder' => '1.25rem'),
			'$h6-font-size' => array('type' => 'text', 'placeholder' => '1rem'),
			
			
			'$display1-size' => array('newgroup' => 'Display Classes', 'type' => 'text', 'placeholder' => '6rem'),
			'$display2-size' => array('type' => 'text', 'placeholder' => '5.5rem'),
			'$display3-size' => array('type' => 'text', 'placeholder' => '4.5rem'),
			'$display4-size' => array('type' => 'text', 'placeholder' => '3.5rem'),
			
			'$display1-weight' => array('type' => 'text', 'placeholder' => '300'),
			'$display2-weight' => array('type' => 'text', 'placeholder' => '300'),
			'$display3-weight' => array('type' => 'text', 'placeholder' => '300'),
			'$display4-weight' => array('type' => 'text', 'placeholder' => '300'),
			'$display-line-height' => array('type' => 'text', 'placeholder' => ' $headings-line-height '),
			
			'$lead-font-size' => array('newgroup' => 'Lead, Small and Muted', 'type' => 'text', 'placeholder' => '1.25rem'),
			'$lead-font-weight' => array('type' => 'text', 'placeholder' => '300'),
			
			'$small-font-size' => array('type' => 'text', 'placeholder' => '80%'),
			
			'$text-muted' => array('type' => 'color',  ),
			
			
			'$blockquote-small-font-size' => array('newgroup' => 'Blockquotes', 'type' => 'text', 'placeholder' => '$small-font-size '),
			'$blockquote-font-size' => array('type' => 'text', 'placeholder' => '1.25rem '),
			'$blockquote-small-color' => array('type' => 'color' ),
			
			
			'$hr-border-width' => array('newgroup' => 'HRs', 'type' => 'text', 'placeholder' => '1px '),
			'$hr-border-color' => array( 'type' => 'color'),
			
			'$mark-padding' => array('newgroup' => 'Miscellanea',  'type' => 'text', 'placeholder' => '.2em'),
			
			'$dt-font-weight' => array('type' => 'text', 'placeholder' => '700'),
			
			'$kbd-box-shadow' => array('type' => 'text', 'placeholder' => 'inset 0 -.1rem 0 rgba($black, .25) '),
			'$nested-kbd-font-weight' => array('type' => 'text', 'placeholder' => '700'),
			
			'$list-inline-padding' => array('type' => 'text', 'placeholder' => '.5rem'),
			
			'$mark-bg' => array('type' => 'color', 'placeholder' => '#fcf8e3'),
			
			'$hr-margin-y' => array('type' => 'text', 'placeholder' => '$spacer'),
			
			
			'$paragraph-margin-bottom' => array('type' => 'text'),
			
			),
		
		
		
		
		//add another section
		"buttons+forms" => array( // $variable_name => $variable_props
			
						
			'$input-btn-padding-y' => array('type' => 'text','placeholder' => '.375rem'),
			'$input-btn-padding-x' => array('type' => 'text','placeholder' => '.75rem'),
			'$input-btn-font-family' => array('type' => 'text','placeholder' => 'null'),
			'$input-btn-font-size' => array('type' => 'text','placeholder' => '$font-size-base'),
			'$input-btn-line-height' => array('type' => 'text','placeholder' => '$line-height-base'),
			
			'$input-btn-focus-width' => array('type' => 'text','placeholder' => '.2rem'),
			'$input-btn-focus-color' => array('type' => 'color','placeholder' => 'rgba($component-active-bg, .25)'),
			'$input-btn-focus-box-shadow' => array('type' => 'text','placeholder' => '0 0 0 $input-btn-focus-width $input-btn-focus-color'),
			
			'$input-btn-padding-y-sm' => array('type' => 'text','placeholder' => '.25rem'),
			'$input-btn-padding-x-sm' => array('type' => 'text','placeholder' => '.5rem'),
			'$input-btn-font-size-sm' => array('type' => 'text','placeholder' => '$font-size-sm'),
			'$input-btn-line-height-sm' => array('type' => 'text','placeholder' => '    $line-height-sm'),
			
			'$input-btn-padding-y-lg' => array('type' => 'text','placeholder' => '.5rem'),
			'$input-btn-padding-x-lg' => array('type' => 'text','placeholder' => '1rem'),
			'$input-btn-font-size-lg' => array('type' => 'text','placeholder' => '$font-size-lg'),
			'$input-btn-line-height-lg' => array('type' => 'text','placeholder' => '    $line-height-lg'),
			
			'$input-btn-border-width' => array('type' => 'text','placeholder' => '$border-width'),
			

			),
		
		
		//add another section
		
		
		
		
	);	 
}
 
//ENABLE SELECTIVE REFRESH 
add_theme_support( 'customize-selective-refresh-widgets' );

//ADD HELPER ICONS
function customstrap_register_main_partials( WP_Customize_Manager $wp_customize ) {
 
    // Abort if selective refresh is not available.
    if ( ! isset( $wp_customize->selective_refresh ) ) { return;}
 
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//blogname
    $wp_customize->selective_refresh->add_partial( 'header_site_title', array(
        'selector' => 'a.navbar-brand',
        'settings' => array( 'blogname' ),
        'render_callback' => function() { return get_bloginfo( 'name', 'display' );  },
    ));
	
	//blog description
    $wp_customize->selective_refresh->add_partial( 'header_site_desc', array(
        'selector' => '#top-description',
        'settings' => array( 'blogdescription' ),
        'render_callback' => function() { return get_bloginfo( 'description', 'display' ); },
    ));
	
	//hide tagline
	$wp_customize->selective_refresh->add_partial( 'header_disable_tagline', array(
        'selector' => '#top-description',
        'settings' => array( 'header_disable_tagline' ),
        'render_callback' => function() {if (!get_theme_mod('header_disable_tagline')) return get_bloginfo( 'description', 'display' ); else return "";},
    ));
	
	//MENUS
	$wp_customize->selective_refresh->add_partial( 'header_menu_left', array(
        'selector' => '#navbar .menuwrap-left',
        'settings' => array( 'nav_menu_locations[navbar-left]' ),
          
    ) );
	
	/*
	$wp_customize->selective_refresh->add_partial( 'header_menu_right', array(
        'selector' => '#navbar .menuwrap-right',
        'settings' => array( 'nav_menu_locations[navbar-right]' ),     
    ));
	*/
	//topbar content
	$wp_customize->selective_refresh->add_partial( 'topbar_html_content', array(
        'selector' => '#topbar-content',
        'settings' => array( 'topbar_content' ),
		'render_callback' => function() {
             return get_theme_mod('topbar_content'); 
        },     
    )); 
	//footer text
	$wp_customize->selective_refresh->add_partial( 'footer_ending_text', array(
        'selector' => 'footer.site-footer',
        'settings' => array( 'customstrap_footer_text' ),
		'render_callback' => function() {
             return understrap_site_info();
        },     
    ));
	/*
	//inline css
	$wp_customize->selective_refresh->add_partial( 'customstrap_inline_css', array(
        'selector' => '#customstrap-inline-style',
        'settings' => array( 'customstrap_footer_bgcolor','customstrap_menubar_bgcolor' , 'customstrap_links_color','customstrap_hover_links_color','customstrap_headings_font','customstrap_body_font'  ),
		'render_callback' => function() {
             return customstrap_footer_add_inline_css();
        },
    ));
	*/
	////even if those dont do partial refresh, following code shows the contextual editing pencils 
	//SINGLE: posted on 
	$wp_customize->selective_refresh->add_partial( 'singlepost_entry_meta', array(
        'selector' => '.entry-header .entry-meta',
        'settings' => array( 'singlepost_disable_entry_meta' ),
		'render_callback' => '__return_false'    
    ));
	
	//SINGLE: posted in cats
	$wp_customize->selective_refresh->add_partial( 'singlepost_entry_footer', array(
        'selector' => 'footer.entry-footer',
        'settings' => array( 'singlepost_disable_entry_footer' ),
		'render_callback' => '__return_false'    
    ));
	
	//SINGLE: postnavi
	$wp_customize->selective_refresh->add_partial( 'singlepost_posts_nav', array(
        'selector' => 'nav.post-navigation',
        'settings' => array( 'singlepost_disable_posts_nav' ),
		'render_callback' => '__return_false' 
    ));
	
	//SINGLE: comments
	$wp_customize->selective_refresh->add_partial( 'singlepost_comments', array(
        'selector' => '#comments',
        'settings' => array( 'singlepost_disable_comments' ),
		'render_callback' => '__return_false'    
    ));
     
}
add_action( 'customize_register', 'customstrap_register_main_partials' );

 
//CUSTOM BACKGROUND
//$defaults_bg = array(
//	'default-color'          => '',	'default-image'          => '',	'default-repeat'         => '',	'default-position-x'     => '',	'default-attachment'     => '',
//	'wp-head-callback'       => '_custom_background_cb',	'admin-head-callback'    => '',	'admin-preview-callback' => '');
//add_theme_support( 'custom-background' );


//CUSTOM BACKGROUND SIZING OPTIONS

function custom_background_size( $wp_customize ) {
 
	// Add your setting.
	$wp_customize->add_setting( 'background-image-size', array(
		'default' => 'cover',
	) );

	// Add your control box.
	$wp_customize->add_control( 'background-image-size', array(
		'label'      => __( 'Background Image Size',"customstrap" ),
		'section'    => 'background_image', 
		'priority'   => 200,
		'type' => 'radio',
		'choices' => array(
			'cover' => __( 'Cover',"customstrap" ),
			'contain' => __( 'Contain' ,"customstrap"),
			'inherit' => __( 'Inherit' ,"customstrap"),
		)
	) );
}

add_action( 'customize_register', 'custom_background_size' );

function custom_background_size_css() {
	if ( ! get_theme_mod( 'background_image' ) )  return;
	$background_size = get_theme_mod( 'background-image-size', 'inherit' );
	echo '<style> body.custom-background { background-size: '.$background_size.'; } </style>';
}

add_action( 'wp_head', 'custom_background_size_css', 999 );


//END CUSTOM BACKGROUND SIZING OPTIONS


	
////////DECLARE ALL THE WIDGETS WE NEED	FOR THE SCSS OPTIONS////////////////////////////////////////////////

add_action("customize_register","customstrap_theme_customize_register_extras");
	
function customstrap_theme_customize_register_extras($wp_customize) {
	
	///ADDD SECTIONS:
	//COLORS is already default
	
	//BOOTSTRAP TYPE  OPTIONS
	$wp_customize->add_section("typography", array(
        "title" => __("Typography", "customstrap"),
        "priority" => 50,
    ));
	
	//BOOTSTRAP BORDER OPTIONS
	$wp_customize->add_section("options", array(
        "title" => __("Components", "customstrap"),
        "priority" => 50,
    ));
	
	//BOOTSTRAP BORDER OPTIONS
	$wp_customize->add_section("buttons+forms", array(
        "title" => __("Buttons + Forms", "customstrap"),
        "priority" => 50,
    ));
	
	
	
	
	//istantiate  all controls needed for controlling the SCSS variables
	foreach(customstrap_get_scss_variables_array() as $section_slug => $section_data):
	
		foreach($section_data as $variable_name => $variable_props):
			 
			$variable_slug=str_replace("$","SCSSvar_",$variable_name);
			$variable_pretty_format_name=ucwords(str_replace("-",' ',str_replace("$","",$variable_name)));		
			$variable_type=$variable_props['type'];
			if (array_key_exists('default',$variable_props)) $default=$variable_props['default']; else $default="";
			
			
			if($variable_type=="color"):
			
				$wp_customize->add_setting(  $variable_slug,  array(
					'default' => $default,
					'sanitize_callback' => 'sanitize_hex_color',
					"transport" => "postMessage",
					));
				$wp_customize->add_control(
					new WP_Customize_Color_Control(
					$wp_customize,
					$variable_slug, //give it an ID
					array(
						'label' => __( $variable_pretty_format_name, 'customstrap' ), //set the label to appear in the Customizer
						'description' =>  "(".$variable_name.")",
						'section' => $section_slug, //select the section for it to appear under  
						)
					));	
			endif;
			
			if($variable_type=="boolean"):
 
				$wp_customize->add_setting($variable_slug, array(
					"default" => $default,
					"transport" => "postMessage",
				));
				$wp_customize->add_control(new WP_Customize_Control(
					$wp_customize,
					$variable_slug,
					array(
						'label' => __( $variable_pretty_format_name, 'customstrap' ), //set the label to appear in the Customizer
						'description' =>  "(".$variable_name.")",
						'section' => $section_slug, //select the section for it to appear under
						'type' => 'checkbox'
						)
				));
			endif;
			
			if($variable_type=="text"):
			
				if(array_key_exists('placeholder',$variable_props)) $placeholder_html="<b>Default:</b> ".$variable_props['placeholder']; else $placeholder_html="";
				if (array_key_exists('newgroup',$variable_props)) $optional_grouptitle=" <span hidden class='cs-option-group-title'>".$variable_props['newgroup']."</span>"; else $optional_grouptitle="";
			
				$wp_customize->add_setting($variable_slug, array(
					"default" => $default,
					"transport" => "postMessage",
					//"default" => "1rem",
					//'sanitize_callback' => 'customstrap_sanitize_rem'
				));
				$wp_customize->add_control(new WP_Customize_Control(
					$wp_customize,
					$variable_slug,
					array(
						'label' => __( $variable_pretty_format_name, 'customstrap' ), //set the label to appear in the Customizer
						'description' => $optional_grouptitle. " <!-- (".$variable_name.") -->".$placeholder_html, //ADD COMMENT HERE IF NECESSARY
						'section' => $section_slug, //select the section for it to appear under
						'type' => 'text', 
						)
				));
			endif;
			
		endforeach;
	endforeach;

	//SANITIZE CHECKBOX
	function customstrap_sanitize_checkbox( $input ) {		return ( ( isset( $input ) && true == $input ) ? true : false ); }

	//COLORS: ANDROID CHROME HEADER COLOR
	$wp_customize->add_setting(  'customstrap_header_chrome_color',  array(
	 'default' => '', // Give it a default
	 'transport" => "postMessage',
	 ));
	 $wp_customize->add_control(
	 new WP_Customize_Color_Control(
	 $wp_customize,
	 'customstrap_header_chrome_color', //give it an ID
	 array(
	 'label' => __( 'Header Color in Android Chrome', 'customstrap' ), //set the label to appear in the Customizer
	 'section' => 'colors', //select the section for it to appear under 
		)
	 ));
 
    //TAGLINE: SHOW / HIDE SWITCH
	$wp_customize->add_setting('header_disable_tagline', array(
        'default' => '',
        'transport' => 'postMessage',
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'header_disable_tagline',
        array(
            'label' => __('Hide Tagline', 'customstrap'),
            'section' => 'title_tagline',  
            'type'     => 'checkbox',
			)
    ));
	
    //   NAVBAR SECTION //////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section("nav", array(
        "title" => __("Main Navigation", "customstrap"),
        "priority" => 60,
    ));

	// HEADER NAVBAR CHOICE
	$wp_customize->add_setting("customstrap_header_navbar_position", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_header_navbar_position",
        array(
            'label' => __('Navbar Position', 'customstrap'),
            'section' => 'nav',
            'type'     => 'radio',
			'choices'  => array(
				''  => 'Standard Static Top',
				'fixed-top' => 'Fixed on Top',
				'fixed-bottom'  => 'Fixed on Bottom',
				'd-none'  => 'No Navbar', 
				)
        )
    ));
	
	//HEADERNAVBAR COLOR CHOICE
	$wp_customize->add_setting("customstrap_header_navbar_color_choice", array(
        'default' => 'bg-dark',
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_header_navbar_color_choice",
        array(
            'label' => __('Navbar Background Color', 'customstrap'),
            'section' => 'nav',
            'type'     => 'radio',
			'choices'  => array(
				'bg-primary'	=> 'Primary',	
				'bg-secondary'	=> 'Secondary',	
				'bg-success' 	=> 'Success', 	
				'bg-info' 		=> 'Info', 		
				'bg-warning' 	=> 'Warning', 	
				'bg-danger' 	=> 'Danger', 	
				'bg-light' 	=> 'Light', 	
				'bg-dark' 		=> 'Dark', 		
				'bg-transparent' 		=> 'Transparent' 
				
				
				)
        )
    ));
	
	//HEADERNAVBAR COLOR SCHEME
	$wp_customize->add_setting("customstrap_header_navbar_color_scheme", array(
        'default' => 'navbar-dark',
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_header_navbar_color_scheme",
        array(
            'label' => __('Color Scheme (Menubar links)', 'customstrap'),
            'section' => 'nav',
			'type'     => 'radio',
			'choices'  => array(
				''  => 'Default',
				'navbar-light' => 'Light (Dark links)',
				'navbar-dark' => 'Dark (Light links)', 
				)
        )
    ));
	
	//  TOPBAR SECTION //////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section("topbar", array(
        "title" => __("Optional Topbar", "customstrap"),
        "priority" => 60,
    ));
	
	//ENABLE TOPBAR
	$wp_customize->add_setting("enable_topbar", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "enable_topbar",
        array(
            "label" => __("Enable Topbar", "customstrap"),
			"description" => __("Adds before all, at body start", "customstrap"),
            "section" => "topbar", 
            'type'     => 'checkbox',
			)
    ));
	
	//TOPBAR TEXT
	$wp_customize->add_setting("topbar_content", array(
        "default" => "",
        "transport" => "postMessage",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "topbar_content",
        array(
            "label" => __("Topbar Text / HTML", "customstrap"),
            "section" => "topbar",
            'type'     => 'textarea',
        )
    ));
	
	//TOPBAR BG COLOR CHOICE
	$wp_customize->add_setting("topbar_bg_color_choice", array(
        'default' => 'bg-light',
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "topbar_bg_color_choice",
        array(
            'label' => __('Topbar Background Color', 'customstrap'),
            'section' => 'topbar',
            'type'     => 'radio',
			'choices'  => array(
				'bg-primary'	=> 'Primary',	
				'bg-secondary'	=> 'Secondary',	
				'bg-success' 	=> 'Success', 	
				'bg-info' 		=> 'Info', 		
				'bg-warning' 	=> 'Warning', 	
				'bg-danger' 	=> 'Danger', 	
				'bg-light' 	=> 'Light', 	
				'bg-dark' 		=> 'Dark', 		
				'bg-transparent' 		=> 'Transparent'
				)
        )
    ));
	
	//TOPBAR TEXT COLOR CHOICE
	$wp_customize->add_setting("topbar_text_color_choice", array(
        'default' => 'text-dark',
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "topbar_text_color_choice",
        array(
            'label' => __('Topbar Text Color', 'customstrap'),
            'section' => 'topbar',
            'type'     => 'radio',
			'choices'  => array(
				'text-primary'	=> 'Primary',	
				'text-secondary'	=> 'Secondary',	
				'text-success' 	=> 'Success', 	
				'text-info' 		=> 'Info', 		
				'text-warning' 	=> 'Warning', 	
				'text-danger' 	=> 'Danger', 	
				'text-light' 	=> 'Light', 	
				'text-dark' 		=> 'Dark', 		
				)
        )
    ));
	
	
	//LEGACY FONTS SECTION ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if (0 OR get_theme_mod('customstrap_body_font')!="" OR get_theme_mod('customstrap_headings_font')!=""): //shown only if old settings are there
	
		$wp_customize->add_section("fonts", array(
			"title" => __("Fonts (LEGACY)", "customstrap"),
			"priority" => 50,
		));
		
		 
		//HEADING FONTS
		$wp_customize->add_setting("customstrap_headings_font", array(
			"default" => "",
			"transport" => "postMessage",
		));
		global $customstrap_google_fonts_array;
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"customstrap_headings_font",
			array(
				"label" => __(" Headings Font ", "customstrap"),
				'description' => __( '<h1>Important notice </h1>. <h2>Please take some time to improve Google Font loading performance on your site: </h2> <h3>1. Take note of the fonts you\'re using in this panel</h3>
									<h3>2. Set both font selections below to "default".</h3><h3>3. Open the brand new Typography panel and set again your fonts from there. </h3><p>Publish. Your SCSS will be of course rebuilt. Your site speed will be improved!</p>
									<p>After doing this, this legacy panel will be hidden from the Customizer interface.</p><label   class="customize-control-title" style="font-style:normal;"> Headings Font </label><span   class="description customize-control-description">Legacy support.</span>', 'customstrap' ),
				"section" => "fonts",
				'type'     => 'select',
				'choices'  => $customstrap_google_fonts_array,
			)
		));
		
		//BODY FONTS
		$wp_customize->add_setting("customstrap_body_font", array(
			"default" => "",
			"transport" => "postMessage",
		));
		global $customstrap_google_fonts_array;
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"customstrap_body_font",
			array(
				"label" => __(" Body Font ", "customstrap"),
				'description' => __( 'Legacy support.', 'customstrap' ),
				"section" => "fonts",
				'type'     => 'select',
				'choices'  => $customstrap_google_fonts_array,
			)
		));
		
	endif;
	
	//ADD SECTION FOR FOOTER  //////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section("footer", array(
        "title" => __("Footer", "customstrap"),
        "priority" => 100,
    ));
	
	//FOOTER TEXT
	$wp_customize->add_setting("customstrap_footer_text", array(
        "default" => "",
        "transport" => "postMessage",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_footer_text",
        array(
            "label" => __("Footer Text / HTML", "customstrap"),
            "section" => "footer",
            'type'     => 'textarea',
			 
        )
    ));
	
		
	// ADD A SECTION FOR HEADER & FOOTER CODE -- to fix
	$wp_customize->add_section("addcode", array(
        "title" => __("Add Code to Header / Footer", "customstrap"),
        "priority" => 180,
    ));
	
	//ADD HEADER CODE  
	$wp_customize->add_setting("customstrap_header_code", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_header_code",
        array(
            "label" => __("Add code to Header", "customstrap"),
            "section" => "addcode",
            'type'     => 'textarea',
			'description' =>'Placed inside the HEAD of the page'
			)
    ));
	
	//ADD FOOTER CODE 
	$wp_customize->add_setting("customstrap_footer_code", array(
        "default" => "",
        "transport" => "refresh",
    ));


	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_footer_code",
        array(
            "label" => __("Add code to Footer", "customstrap"),
            "section" => "addcode",
            'type'     => 'textarea',
			'description' =>'Placed before closing the BODY of the page'
			)
    ));

	//ADD FONTLOADING HEADER CODE  
	$wp_customize->add_setting("customstrap_fonts_header_code", array(
        "default" => "",
		"transport" => "refresh",
        //"transport" => "postMessage", // and no custom js is added: so no live page update is done, how it should be - but causes unstable behavoiur
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_fonts_header_code",
        array(
            "label" => __("Fonts Loading Header code", "customstrap"),
            "section" => "addcode",
            'type'     => 'textarea',
			'description' =>'<b>Do not touch</b> - this hidden field is automatically generated upon publishing'
			)
    ));
	
	
	
	// ADD A SECTION FOR EXTRAS
	$wp_customize->add_section("extras", array(
        "title" => __("Global Options & Utilities", "customstrap"),
        "priority" => 190,
    ));
	
	//DISABLE COMMENTS
	$wp_customize->add_setting("singlepost_disable_comments", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "singlepost_disable_comments",
        array(
            "label" => __("Disable the WordPress comments system", "customstrap"),
			"description" => __("Will completely disable the entire WP comments feature. Publish and exit the Customizer to see the effect", "customstrap"),
            "section" => "extras", 
            'type'     => 'checkbox',
			)
    ));

	//DISABLE FONTLOADING HEADER CODE  
	$wp_customize->add_setting("customstrap_fonts_header_code_disable", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_fonts_header_code_disable",
        array(
            "label" => __("Disable the Font Loading in Header", "customstrap"),
			"description" =>  __("<b>Keep this unchecked, unless you really know what you're doing.</b>").__("This will prevent the Theme from auto-enqueueing the necessary Google Fonts when they are chosen. Can be relevant if you want to self-host Google Fonts. Refer to this <a target='_blank' href='https://google-webfonts-helper.herokuapp.com/fonts/abeezee?subsets=latin'>tool</a> to get started. ", "customstrap"),
            "section" => "extras", 
            'type'     => 'checkbox',
			)
    ));
	
	//DISABLE FONTAWESOME
	$wp_customize->add_setting("customstrap_fontawesome_disable", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "customstrap_fontawesome_disable",
        array(
            "label" => __("Disable FontAwesome", "customstrap"),
			"description" => __("<b>Keep this unchecked, unless you really know what you're doing.</b>").__("This will prevent the compiler to pick the FontAwesome icon font from the UnderStrap folder and add it to the CSS bundle.", "customstrap"),
            "section" => "extras", 
            'type'     => 'checkbox',
			)
    ));
	

	//BACK TO TOP
	$wp_customize->add_setting("enable_back_to_top", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "enable_back_to_top",
        array(
            "label" => __("Add a 'Back to Top' button to site", "customstrap"),
			"description" => __("Very light implementation. To see the button, you will also need to Publish, exit the Customizer, and scroll down a long page", "customstrap"),
            "section" => "extras", 
            'type'     => 'checkbox',
			)
    ));
	
	
	
	
	//LIGHTBOX
	$wp_customize->add_setting("enable_lightbox", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "enable_lightbox",
        array(
            "label" => __("Enable Lightbox", "customstrap"),
			"description" => __("Will add a JS and a CSS file from cdn.jsdelivr.net before closing the BODY of the page, to use   <a target='_blank' href='https://github.com/biati-digital/glightbox'>gLightBox</a>: a very lightweight lightbox implementation.", "customstrap"),
            "section" => "extras", 
            'type'     => 'checkbox',
			)
    ));
 
	
	// SINGLE POST & ARCHIVES SECTION //////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section("singleposts", array(
        "title" => __("Single Post & Archives", "customstrap"),
        "priority" => 160,
    ));
	
	//ENTRY META: POSTED ON / BY 
	$wp_customize->add_setting("singlepost_disable_entry_meta", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "singlepost_disable_entry_meta",
        array(
            "label" => __("Hide Post Date and Author (Posted on)", "customstrap"),
			"description" => __("Publish and exit the Customizer to see the effect", "customstrap"),
            "section" => "singleposts", 
            'type'     => 'checkbox',
			)
    ));
	
	//ENTRY FOOTER: CATEGORIES / TAGS
	$wp_customize->add_setting("singlepost_disable_entry_footer", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "singlepost_disable_entry_footer",
        array(
            "label" => __("Hide Categories and Tags (Posted in)", "customstrap"),
			"description" => __("Publish and exit the Customizer to see the effect", "customstrap"),
            "section" => "singleposts", 
            'type'     => 'checkbox',
			)
    ));
	
	//PAGES NAVIGATION: NEXT / PREV ARTICLE
	$wp_customize->add_setting("singlepost_disable_posts_nav", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "singlepost_disable_posts_nav",
        array(
            "label" => __("Hide Next and Prev Post Links (Single Post Template)", "customstrap"),
			"description" => __("Publish and exit the Customizer to see the effect", "customstrap"),
            "section" => "singleposts", 
            'type'     => 'checkbox',
			)
    ));
	
 	//SHARING BUTTONS
	$wp_customize->add_setting("enable_sharing_buttons", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "enable_sharing_buttons",
        array(
            "label" => __("Enable Sharing Buttons", "customstrap"),
			"description" => __("Pure HTML only, zero bloat", "customstrap"),
            "section" => "singleposts", 
            'type'     => 'checkbox',
			)
    ));
	//end single posts ////////////////////////////////////

	/*  .php
	// ADD A SECTION FOR ARCHIVES ///////////////////////////////
	$wp_customize->add_section("archives", array(
        "title" => __("Archive Templates", "customstrap"),
        "priority" => 160,
    ));
	
	//FIELDS
	
	//ARCHIVES_TEMPLATE
	$wp_customize->add_setting("archives_template", array(
        "default" => "",
        "transport" => "refresh",
    ));
	$wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "archives_template",
        array(
            "label" => __("Template", "customstrap"),
            "section" => "archives",
            "settings" => "archives_template",
            'type'     => 'select',
			'choices'  => array(
				''  => 'Standard Blog: List With Sidebar',
				'v2' => 'v2 : Horizontal split with Featured Image',
				'v3' => 'v3 : Simple 3 Columns Grid ',
				'v4' => 'v4 : Masonry Grid',
				 				)
			)
    ));
	
	*/
	
}
 
