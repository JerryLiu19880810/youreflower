<?php


//讓last name 不需要必填
add_filter('woocommerce_save_account_details_required_fields', 'yc_hide_last_name');
function yc_hide_last_name($required_fields)
{
    unset($required_fields["account_last_name"]);
    return $required_fields;
}


//儲存欄位
function yc_save_field($user_id)
{
    update_user_meta($user_id, 'gender', sanitize_text_field($_POST['gender']));
    update_user_meta($user_id, 'birthday', sanitize_text_field($_POST['birthday']));
    update_user_meta($user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    update_user_meta($user_id, 'billing_address_1', sanitize_text_field($_POST['billing_address_1']));
}
add_action( 'woocommerce_save_account_details', 'yc_save_field', 200 );

//移除原本套件勾子
global $ycwc_override;
remove_filter('woocommerce_account_menu_items', array($ycwc_override, 'yc_custom_my_account'), 99);
remove_action('init', array($ycwc_override, 'yc_myAccount_redirect'), 99);

//修改my account
add_filter('woocommerce_account_menu_items', 'yf_custom_my_account', 200);
function yf_custom_my_account($items)
{
    $items['dashboard'] = '會員中心';
    unset($items['edit-address']);
    unset($items['downloads']);
    return $items;
}
