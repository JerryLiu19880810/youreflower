<?php
/* Template Name: 會員頁面 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$title = get_the_title();
$banner = rwmb_meta('banner_image')["full_url"] ?? IMG_URL . '/brand-story.jpg';
$banner_rwd = rwmb_meta('banner_image_rwd')["full_url"] ?? $banner;
?>




    <!-- article -->
      <div class="container mt-0 mb-10">
                <?php the_content(); ?>
      </div>



<?php
get_footer();