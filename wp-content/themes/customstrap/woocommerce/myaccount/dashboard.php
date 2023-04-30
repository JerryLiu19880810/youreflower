<?php

/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$allowed_html = array(
    'a' => array(
        'href' => array(),
    ),
);


$user_id = get_current_user_id();
$user = get_user_by( 'id', $user_id );
$user_member_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
$user_member_lv_img = (empty($user_member_lv)) ? '' : ('<img width="48" height="48" src="' . get_the_post_thumbnail_url($user_member_lv) . '" style="margin-top:-1rem;margin-right:1rem;" />');
$user_member_lv_title = (empty($user_member_lv)) ? '非一般會員' : (get_the_title($user_member_lv) . '會員');
$user_member_lv_content = (wpautop(get_the_content(null, false, $user_member_lv))) ?: '';

$yf_reward_point = (get_user_meta($user_id, '_gamipress_yf_reward_points', true)) ?: '0';


//判斷 一年前的時間與用戶註冊時間，如果用戶註冊不到一年就用顧客註冊時間
$register_time = $user->user_registered;
$period_start = (strtotime($register_time) > strtotime("-1 year"))?strtotime($register_time):strtotime("-1 year");
$period_start_text = (strtotime($register_time) > strtotime("-1 year"))?'(註冊)':'';
$period = date("Y/m/d", $period_start) . $period_start_text . ' ~ ' . date("Y/m/d") . '(今天)';


$period_sales = do_shortcode('[get_dates_sales StartDay="' . date("Y/m/d", strtotime("-1 year")) . '" EndDay="' . date("Y/m/d") . '"]');
$orderdata_last_year = get_orderdata_lastyear_by_user($user_id);

$next_rank_id = (gamipress_get_next_rank_id($user_member_lv)) ?: '';
$next_rank_title = (get_the_title($next_rank_id)) ?: '-';
$next_rank_threshold = get_next_rank_threhold($user_member_lv);
$difference_to_next_rank = get_difference_to_next_rank_by_user($user_id);

$user_points = gamipress_get_user_points($user_id, 'yf_reward');
$user_points_img = '<img width="21" height="21" src="' . get_the_post_thumbnail_url(701) . '" />';


$time_MemberLVexpire_date = get_user_meta($user_id, 'time_MemberLVexpire_date', true);
$time_MemberLVchanged_last_time = get_user_meta($user_id, 'time_MemberLVchanged_last_time', true)?:$user->user_registered;

$reward_date = ($user_member_lv == 713)?'註冊時發放':'每月1號';

switch ($user_member_lv) {
    case '713':
        $time_MemberLVexpire_date = '沒有期限';
        break;
    default:
        $time_MemberLVexpire_date = "一年，至 ${time_MemberLVexpire_date}";
        break;
}



/* echo '<pre>';
var_dump($time_MemberLVexpire_date);
echo '<h1>-------------</h1>';
var_dump($amount);
echo '<h1>-------------</h1>';
var_dump($date);
echo '</pre>'; */



?>





<div class="row">
    <div class="col-12">

        <h2>會員中心</h2>



        <div class="jumbotron mt-3">
            <h1 class="display-4"><?= $user_member_lv_img . $user_member_lv_title ?></h1>
            <p>會員有效期限：<?= $time_MemberLVexpire_date ?></p>
            <hr class="my-4">
            <p class="lead"><?= $user_member_lv_content ?></p>
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">購物金</span>
            </div>
            <input type="text" class="form-control text-right" value="<?= $user_points ?>" readonly>
            <div class="input-group-append">
                <span class="input-group-text"><?= $user_points_img ?></span>
            </div>
        </div>


        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>會員等級：</th>
                    <td><?= $user_member_lv_title ?></td>
                </tr>
                <tr>
                    <th>上次升級時間：</th>
                    <td><?= $time_MemberLVchanged_last_time ?></td>
                </tr>
                <tr>
                    <th>會員有效期：</th>
                    <td><?= $time_MemberLVexpire_date ?></td>
                </tr>
                <tr>
                    <th>目前累積消費金額：</th>
                    <td><?= get_woocommerce_currency_symbol() . ' ' . $orderdata_last_year['total'] ?><br>下一等級為 [<?= $next_rank_title ?>] ，還差 <?= get_woocommerce_currency_symbol() . ' ' . $difference_to_next_rank ?> 元即可升級</td>
                </tr>
                <tr>
                    <th>消費金額的計算區間：</th>
                    <td><?= $period; ?></td>
                </tr>
                <tr>
                    <th>目前購物金：</th>
                    <td><?= get_woocommerce_currency_symbol() . ' ' . $yf_reward_point ?></td>
                </tr>
                <tr>
                    <th>購物金發放日：</th>
                    <td><?= $reward_date ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_before_my_account');

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action('woocommerce_after_my_account');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
