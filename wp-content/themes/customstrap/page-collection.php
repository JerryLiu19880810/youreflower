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

if(!is_user_logged_in()):
    wc_get_template( 'myaccount/form-login.php' );
else:

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
            <?php
            $current_user = wp_get_current_user();
            ?>
            <h4 class="project_page_name text-center">Hi, <?php echo $current_user->data->display_name; ?></h4>
        </div>
    </div>
</section>
<section class="page-collection">
    <div class="container my-5">
        <div class="row justify-content-center gutter-1">
            <!-- post -->
            <div class="col-lg-8">
                <?php
                echo do_shortcode('[wp-favorite-posts]');

                //the_content();
                ?>
            </div>
        </div>
    </div>
</section>



<?php
endif;
get_footer();
