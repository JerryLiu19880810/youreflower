<?php

/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if (!defined('ABSPATH')) {
    exit;
}
$allowed_html = array(
    'a' => array(
        'href' => array(),
    ),
);
$current_user = wp_get_current_user();
$user_id = get_current_user_id();
$user_member_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
$user_member_lv_img = (empty($user_member_lv))?'':('<img width="24" height="24" src="' . get_the_post_thumbnail_url($user_member_lv) . '" style="margin-top:-0.5rem;margin-left:1rem;" />');

do_action('woocommerce_before_account_navigation');
?>



<aside class="bg-white p-2 p-md-3 woocommerce-MyAccount-navigation">
    <h3 class="fs-20 text-uppercase text-muted mb-2">
        <?php
        printf(
            /* translators: 1: user display name 2: logout url */
            wp_kses(__('Welcome, %1$s', 'woocommerce'), $allowed_html),
            '<strong>' . esc_html($current_user->display_name) . '</strong>'
        );
        ?><?= $user_member_lv_img ?></h3>
    <div class="nav nav-menu flex-column lavalamp" id="sidebar-1" role="tablist">
        <div class="lavalamp-object ease" style="transition-duration: 0.2s; width: 356.65px; height: 87px; transform: translate(0px);"></div>
        <!-- <a class="nav-link active lavalamp-item" data-toggle="tab" href="#sidebar-1-1" role="tab" aria-controls="sidebar-1" aria-selected="true" style="z-index: 5; position: relative;"><i class="fs-24 icon-box"></i> Orders</a>
        <a class="nav-link lavalamp-item" data-toggle="tab" href="#sidebar-1-2" role="tab" aria-controls="sidebar-1-2" aria-selected="false" style="z-index: 5; position: relative;"><i class="fs-24 icon-heart"></i> Favorites</a>
        <a class="nav-link lavalamp-item" data-toggle="tab" href="#sidebar-1-3" role="tab" aria-controls="sidebar-1-3" aria-selected="false" style="z-index: 5; position: relative;"><i class="fs-24 icon-user"></i> Personal data </a>
        <a class="nav-link lavalamp-item" data-toggle="tab" href="#sidebar-1-4" role="tab" aria-controls="sidebar-1-4" aria-selected="false" style="z-index: 5; position: relative;"><i class="fs-24 icon-lock"></i> Change password</a>
        <a class="nav-link lavalamp-item" data-toggle="tab" href="#sidebar-1-5" role="tab" aria-controls="sidebar-1-5" aria-selected="false" style="z-index: 5; position: relative;"><i class="fs-24 icon-home"></i> Addresses</a> -->

        <?php foreach (wc_get_account_menu_items() as $endpoint => $label) :
            switch ($endpoint) {
                case 'dashboard':
                    $icon = 'icon-user';
                    break;
                case 'orders':
                    $icon = 'icon-box';
                    break;
                case 'edit-account':
                    $icon = 'fa-solid fa-file-user';
                    break;
                case 'customer-logout':
                    $icon = 'fa-solid fa-arrow-right-from-bracket';
                    break;


                default:
                    $icon = 'icon-box';
                    break;
            }
        ?>
            <a class="nav-link lavalamp-item <?php echo wc_get_account_menu_item_classes($endpoint); ?>" href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>" style="z-index: 5; position: relative;"><i class="fs-24 <?php echo $icon; ?>" style="width: 26px;text-align: center;"></i> <?php echo esc_html($label); ?></a>
        <?php endforeach; ?>
    </div>
</aside>




<?php do_action('woocommerce_after_account_navigation'); ?>