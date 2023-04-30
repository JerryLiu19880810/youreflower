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
?>



<!-- hero -->
<section style="padding:0rem;position:relative;">
    <img rwd_src="<?= $banner_rwd; ?>" src="<?= $banner; ?>" class="w-100 rwd_img banner_bg">
    <div class="w-100" style="position:absolute;top:50%;">
        <div class="container">
            <h1 class="text-center" style="margin-top:-0.75em;"><?= $title ?></h1>
        </div>
    </div>
</section>

<!-- article -->
<article style="background-image:url('<?php echo IMG_URL; ?>/privacy_bg.jpg');background-repeat:no-repeat;background-size:cover;padding:10rem 0rem;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 px-lg-2 mb-3">
                <h2 class="font-weight-bold">聯絡我們</h2>
                <p class="text-gray">請填寫表單或參考常見問題，亦可利用下方聯絡資訊，我們將竭誠為您服務！謝謝</p>
                <div class="contact_form">
                    <?php echo do_shortcode('[contact-form-7 id="296" title="聯絡表單 1"]'); ?>
                </div>
            </div>
            <div class="col-lg-6 px-lg-2">
                <img src="<?php echo IMG_URL; ?>/contact-1.jpg" class="w-100 mb-3" alt="">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <table class="contact_table">
                            <tr>
                                <td><img src="<?php echo IMG_URL; ?>/phone_icon.png" width="36" alt=""></td>
                                <td>
                                    <p>0905-303-001</p>
                                    <p>b0905303001@icloud.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="<?php echo IMG_URL; ?>/customer-service.png" width="36" alt=""></td>
                                <td>
                                    <p>0905-303-001</p>
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="col-lg-3 col-6">
                        <img src="<?php echo IMG_URL; ?>/qr-1.jpg" style="width:140px;" alt="">
                    </div>
                    <div class="col-lg-3 col-6">
                        <img src="<?php echo IMG_URL; ?>/qr-2.jpg" style="width:140px;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>




<?php
get_footer();
