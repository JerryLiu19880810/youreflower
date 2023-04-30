<?php

/**
 * 新增批次動作
 * 勾選用戶 > 發送 Email
 *
 * @see https://make.wordpress.org/core/2016/10/04/custom-bulk-actions/
 */


add_filter( 'bulk_actions-users', 'register_send_email_bulk_actions' );

function register_send_email_bulk_actions($bulk_actions) {
  $bulk_actions['send_email'] = '發送 E-mail';
  return $bulk_actions;
}


add_filter( 'handle_bulk_actions-users', 'send_email_bulk_action_handler', 10, 3 );

function send_email_bulk_action_handler( $redirect_to, $doaction, $user_ids ) {
  if ( $doaction !== 'send_email' ) {
    return $redirect_to;
  }
  $email_to = [];
  foreach ( $user_ids as $user_id ) {
    //跳出視窗選擇要發送的 E-mail
    $bulk_send_email_template = get_option( 'bulk_send_email_template' );
    $bulk_send_email_template_subject = get_option( 'bulk_send_email_template_subject' );


    // 取得用戶Email
    $user_info = get_userdata($user_id);
    array_push($email_to, $user_info->user_email);


    //寄送 E-mail
    $data = array();
    $data['to'] = $email_to;
    $data['subject'] = $bulk_send_email_template_subject;
    yf_send_mail_with_template($bulk_send_email_template, $data);
  }
  $redirect_to = add_query_arg( 'bulk_send_email_users', count( $user_ids ), $redirect_to );
  return $redirect_to;
}



add_action( 'admin_notices', 'my_bulk_action_admin_notice' );

function my_bulk_action_admin_notice() {
  if ( ! empty( $_REQUEST['bulk_send_email_users'] ) ) {
    $emailed_count = intval( $_REQUEST['bulk_send_email_users'] );
    echo '<div id="message" class="updated fade">已送出 ' . $emailed_count . ' 個 E-mail</div>';
  }
}
