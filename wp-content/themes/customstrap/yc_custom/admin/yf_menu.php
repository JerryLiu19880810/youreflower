<?php

if(!class_exists('YC_TECH')) return;
add_action('admin_menu', 'yf_amp', 200);

function yf_amp(){
    //global $submenu;
    //YC_TECH::DEBUG($submenu);
    if( YC_TECH::$current_user_level > 0){
        remove_menu_page( 'th_email_customizer_templates' );
        remove_menu_page( 'gamipress_ranks' );

        add_submenu_page(
            'users.php',
            __('會員等級', 'YC_TECH'),
            __('會員等級', 'YC_TECH'),
            'edit_users',
            'edit.php?post_type=member_lv',
            '',
            200
        );
        add_submenu_page(
            'users.php',
            __('購物金LOG', 'YC_TECH'),
            __('購物金LOG', 'YC_TECH'),
            'edit_users',
            'admin.php?page=gamipress_logs',
            '',
            200
        );
        remove_submenu_page( 'users.php', 'profile.php' );
    }

}

add_action('admin_menu', 'yf_admin_menu_rename', 201);

function yf_admin_menu_rename(){
    global $menu; // Global to get menu array

        foreach ($menu as $key => $menu_array) {

            switch ($menu_array[2]) {
                case 'gamipress_ranks':
                    $menu[$key][0] = __('會員等級', 'YC_TECH');
                    break;
                default:
                    # code...
                    break;
            }
        }
}



add_action('admin_head', 'remove_metabox', 200);
function remove_metabox()
{
    if( YC_TECH::$current_user_level > 0){
    remove_meta_box('rank-details', 'member_lv', 'side');
    remove_meta_box('rank-data', 'member_lv', 'advanced');

    remove_meta_box('gamipress-wc-product-points', 'product', 'side');



    }
}


//columns
add_filter("manage_member_lv_posts_columns", function ($columns) {
   var_dump($columns);
   $columns['thumbnail'] = 'ICON';
   $columns['title'] = '會員等級名稱';
   $columns['priority'] = '等級';
   unset($columns['unlock_with_points']);

     return $columns;
 }, 200, 1);