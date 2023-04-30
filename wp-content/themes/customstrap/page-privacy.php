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

$banner = rwmb_meta('banner_image')["full_url"] ?? IMG_URL . '/brand-story.jpg';
$banner_rwd = rwmb_meta('banner_image_rwd')["full_url"] ?? $banner;

?>



<!-- hero -->
<section style="padding:0rem;">
    <img rwd_src="<?= $banner_rwd; ?>" src="<?= $banner; ?>" class="w-100 rwd_img banner_bg">
</section>

<!-- article -->
<article style="background-image:url('<?php echo IMG_URL; ?>/privacy_bg.jpg');background-repeat:no-repeat;background-size:cover;padding:2rem 0rem;">
    <div class="container page_body">
        <?php the_content(); ?>
    </div>
</article>



<?php
get_footer();
