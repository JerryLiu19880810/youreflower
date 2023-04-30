<?php
function yc_login_logic()
{
    if (!is_user_logged_in()) {

        //如果未登入
        //就顯示登入頁面
        //get_header();
        echo '<div class="woocommerce">';
        wc_get_template('myaccount/form-login.php');
        echo '</div>';
        //登入後跳轉
        add_filter('woocommerce_login_redirect', function () {
            return get_permalink();
        }, 200);
        add_filter('et_builder_inner_content_class', function ($classes) {
            array_push($classes, 'hide_main');
            return $classes;
        }, 200);
        //get_footer();
        //exit();
    } else {
        //如果已登入，就判斷使用者腳色
        $current_user = wp_get_current_user();
        $current_user_role = $current_user->roles[0];
        $available_roles = ['administrator', 'desinger', 'shop_manager', 'shop_manager_super', 'sh_vendor_a', 'sh_vendor_b'];
        if (!in_array($current_user_role, $available_roles)) :
            //如果不在許可名單內，轉到申請成為經銷商頁面
            wp_redirect(site_url() . '/be-a-vendor');
            exit;
        else :
            //如果在許可名單內，繼續，並加上body class
            add_filter('body_class', function ($classes) {
                array_push($classes, 'vendor_only');
                return $classes;
            }, 200);
        endif;
    }
}