<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined('ABSPATH') || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if (!function_exists('wc_get_gallery_image_html')) {
    return;
}

global $product;
global $post;
//縮圖
$attachment_ids = $product->get_gallery_image_ids();
$product_gallery = array();
/* array_push($product_gallery, get_the_post_thumbnail_url()); */
foreach ($attachment_ids as $attachment_id) {
    //array_push($product_gallery, wp_get_attachment_url($attachment_id));
    $product_gallery[$attachment_id] = wp_get_attachment_url($attachment_id);
}

?>
<div class="row gutter-1 justify-content-between">
<div class="col-lg-10 order-lg-2">
<?php wpfp_link(); ?>
    <div class="owl-carousel owl-carousel--alt gallery" data-margin="0" data-slider-id="1" data-thumbs="true" data-nav="true">
        <?php foreach ($product_gallery as $key => $product_img) : ?>
            <figure>
                <a href="<?php echo $product_img ?>"><img src="<?php echo $product_img ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>"></a>
            </figure>
        <?php endforeach; ?>
    </div>
</div>

<div class="col-lg-2 text-center text-lg-left order-lg-1">
    <div class="owl-thumbs" data-slider-id="1">
        <?php foreach ($product_gallery as $key => $product_img) : ?>
            <span class="owl-thumb-item"><img attachment-id="<?= $key ?>" src="<?php echo $product_img ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>"></span>
        <?php endforeach; ?>
    </div>
</div>
</div>