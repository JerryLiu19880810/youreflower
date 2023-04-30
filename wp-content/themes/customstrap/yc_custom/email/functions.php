<?php
if(!class_exists('THWEC_Admin_Settings_General')) return;




function yf_send_mail($content, $data = array()){
    //$to (string|string[]) (Required) Array or comma-separated list of email addresses to send message.
    //$to = sanitize_email( $_POST['email_id'] );
    $to = $data['to'];
    $subject = $data['subject'];
    $from_email = apply_filters('thwec_testmail_from_address', get_option('admin_email'));
    $headers = THWEC_Admin_Settings_General::setup_test_mail_variables( $from_email );

    $send_mail = wp_mail( $to, $subject, $content, $headers );
    return $send_mail;
}

function yf_get_email_template_path($t_name){
    $tpath = false;
    if(!defined('THWEC_CUSTOM_TEMPLATE_PATH')) defined('THWEC_CUSTOM_TEMPLATE_PATH', get_home_path() . 'wp-content/uploads/thwec_templates/');
    $email_template_path = THWEC_CUSTOM_TEMPLATE_PATH.$t_name.'.php';
    if(file_exists($email_template_path)){
        // $this->remove_default_hooks();
           $tpath = $email_template_path;
    }
    return $tpath;
}
//		$file = THWEC_CUSTOM_TEMPLATE_PATH.$template_name.'.php';


function yf_get_email_template_html($t_name){
    $template = yf_get_email_template_path($t_name);
    ob_start();
	include $template;
	return ob_get_clean();
}

function yf_send_mail_with_template($t_name, $data){
    $content = yf_get_email_template_html($t_name);
    $send_mail = yf_send_mail( $content, $data );
    return $send_mail ? 'success' : 'failure';
}

//載入後台JS
function enqueue_js_users( $hook ) {
    if ( 'users.php' != $hook ) {
        return;
    }
    wp_enqueue_script( 'choose_template',  get_stylesheet_directory_uri() . '/yc_custom/email/choose_template.js', array(), '1.0', true );

$templates = array();
foreach(glob( THWEC_CUSTOM_TEMPLATE_PATH . '*.php') as $template){
    $template = array(
        'name' => str_replace('.php', '',basename($template)),
        'path' => $template
    );
    array_push($templates, $template);
}

    wp_localize_script( 'choose_template', 'ajax_obj',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nounce' => wp_create_nonce( 'choose_template' ),
            'templates' => $templates,
        )
    );
}
add_action( 'admin_enqueue_scripts', 'enqueue_js_users' );


// save_template_to_db
function save_template_to_db()
{
    $template = $_POST['template'];
    $subject = $_POST['subject'];
    update_option( 'bulk_send_email_template', $template );
    update_option( 'bulk_send_email_template_subject', $subject );

    wp_die();
}

add_action('wp_ajax_save_template_to_db', 'save_template_to_db');


// function test_mail(){
//     //yf_send_mail_with_template('test_mail');
//     var_dump(glob( THWEC_CUSTOM_TEMPLATE_PATH . '*.php'));
// }
// add_action( 'admin_head', 'test_mail', 200);