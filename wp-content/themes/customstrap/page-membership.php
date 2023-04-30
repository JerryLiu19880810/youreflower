<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$title = get_the_title();
$banner = rwmb_meta('banner_image')["full_url"] ?? IMG_URL . '/brand-story.jpg';
$banner_rwd = rwmb_meta('banner_image_rwd')["full_url"] ?? $banner;

$member_lvs = get_posts([
    'post_type' => 'member_lv',
    'post_per_page' => -1,
    'orderby' => 'id',
    'order' => 'ASC'
]);

$html = rwmb_meta('html');

?>



<!-- hero -->
<section style="padding:0rem;position:relative;">
    <img rwd_src="<?= $banner_rwd; ?>" src="<?= $banner; ?>" class="w-100 rwd_img banner_bg">
    <div class="w-100" style="position:absolute;top:50%;">
        <!-- <div class="container">
            <h1 class="text-center" style="margin-top:-0.75em;"><?= $title ?></h1>
        </div> -->
    </div>
</section>

<section class="membership" style="background-image:url('<?= IMG_URL ?>/membership_bg.jpg');background-size:cover;">
    <div class="container">
        <div class="row">
            <div class="col-12 separate_line text-center" style="margin-bottom:5rem">
                <span>會</span>
                <span>員</span>
                <span>升</span>
                <span>級</span>
                <span>資</span>
                <span>格</span>
            </div>
            <div class="col-md-10 offset-md-1 text-center">
                <p class="mb-0">會員消費達升級門檻且完成訂單交易，即享升等優惠資格，為期一年 (以升等日起算)，</p>
                <p>效期過後系統將重新核算資格並自動更新。</p>
            </div>
        </div>
        <div class="row col-border-right justify-content-center row-1">
            <?php foreach ($member_lvs as $key => $member_lv) :
                if ($key < 3) :
            ?>
                    <div class="col-lg-4 px-2">
                        <div class="card text-center d-block bg-transparent">
                            <img src="<?= get_the_post_thumbnail_url($member_lv->ID, 'full') ?>" class="rounded-pill mb-4" style="" width="150" height="150">
                            <h3 class="mb-3"><?= $member_lv->post_title ?>會員</h3>
                            <?= wpautop($member_lv->post_content); ?>
                        </div>
                    </div>
            <?php
                endif;
            endforeach; ?>
        </div>

        <div class="row col-border-right justify-content-center" style="margin-bottom:11.8125rem">
            <?php foreach ($member_lvs as $key => $member_lv) :
                if ($key >= 3 && $key < 6) :
            ?>
                    <div class="col-lg-4 px-2">
                        <div class="card text-center d-block bg-transparent">
                            <img src="<?= get_the_post_thumbnail_url($member_lv->ID, 'full') ?>" class="rounded-pill mb-4" style="" width="150" height="150">
                            <h3 class="mb-3"><?= $member_lv->post_title ?>會員</h3>
                            <?= wpautop($member_lv->post_content); ?>
                        </div>
                    </div>
            <?php
                endif;
            endforeach; ?>
        </div>

        <div class="row">
            <div class="col-12 separate_line text-center" style="margin-bottom:6.5625rem">
                <span>會</span>
                <span>員</span>
                <span>制</span>
                <span>度</span>
                <span>注</span>
                <span>意</span>
                <span>事</span>
                <span>項</span>
            </div>
            <div class="col-md-10 offset-md-1">
                <?= wpautop($html) ?>
            </div>
        </div>
    </div>
</section>




<?php
get_footer();
