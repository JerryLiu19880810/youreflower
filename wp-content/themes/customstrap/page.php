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
defined( 'ABSPATH' ) || exit;

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
    <!-- <section class="py-0 no-overflow vh-75 d-flex align-items-center" style="background-image:url(<?= $bg_img ?>);background-size: cover;background-position: center;background-repeat:no-repeat;background-attachment: fixed;">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 align-self-center text-dark text-center">
            <h1 class="text-uppercase"><?= $title ?></h1>
          </div>
        </div>
      </div>
    </section> -->

    <!-- article -->
    <article>
      <div class="container my-10">
        <div class="row justify-content-center gutter-1">
          <!-- post -->
          <div class="col-lg-8">
                <?php the_content(); ?>
          </div>
        </div>
      </div>
    </article>



<?php
get_footer();
