<?php

function woo_remove_product_tabs($tabs)
{
    global $post;
    unset($tabs['description']);// Remove the description tab
    unset($tabs['reviews']);


    $short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);
    if (empty($short_description)) return;

    $tabs['excerpt'] = array(
        'title'     => '商品簡介',
        'priority'  => 10,
        'callback'  => 'woo_get_the_excerpt'
    );




    return $tabs;
}

add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_get_the_excerpt()
{
    wc_get_template('single-product/short-description.php');
}

// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function woocommerce_get_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0)
{
    global $product;

    $attachment_ids = $product->get_gallery_image_ids();

    /* var_dump($attachment_ids); */
    $html = '';
    /* $image_size = apply_filters('single_product_archive_thumbnail_size', $size);
    $html .= $product->get_image($image_size); */
    if (!empty($attachment_ids)) {
        $html .= '<img src="' . wp_get_attachment_url($attachment_ids[0]) . '" alt="' . get_the_title() . '" />';

        if (count($attachment_ids) >= 2) {
            $html .= '<img src="' . wp_get_attachment_url($attachment_ids[1]) . '" alt="' . get_the_title() . '" />';
        }
    }
    return $html;
}

if (!function_exists('woocommerce_template_cats')) {
    function woocommerce_template_cats()
    {
        wc_get_template('single-product/cats.php');
    }
}

function share_single_product()
{
    $URL = get_permalink();
?>
    <div class="form-group mt-2">
        <label>Share this product</label>
        <div>
            <ul class="list list--horizontal share-btn">

                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $URL; ?>" target="_blank" class="text-hover-facebook"><i class="fs-28 icon-facebook-square-brands"></i></a></li>
                <li>
                <a href="https://social-plugins.line.me/lineit/share?url=<?= $URL; ?>" target="_blank"><i class="fa-brands fa-line"></i></a>
                </li>

                <!-- <li><a href="#!" class="text-hover-instagram"><i class="fs-28 icon-instagram-square-brands"></i></a></li> -->
                <!--@todo  <li><a href="#!" class="text-hover-twitter"><i class="fs-28 icon-twitter-square-brands"></i></a></li>
                <li><a href="#!" class="text-hover-pinterest"><i class="fs-28 icon-pinterest-square-brands"></i></a></li> -->
            </ul>
        </div>
    </div>
    <script type="text/javascript" async="async" defer="defer">LineIt.loadButton();</script>

    <script>
        //FB分享按鈕
        document.querySelector('.text-hover-facebook').addEventListener('click', function(e) {
            e.preventDefault();
            FB.ui({
                method: 'share',
                href: location.href,//當前網址
            }, function(response) {});
        });

    </script>
<?php
}

function change_breadcrumb_class($args)
{
    $args['wrap_before'] = '<nav class="woocommerce-breadcrumb bg-light"><div class="container">';
    $args['wrap_after'] = '</div></nav>';

    return $args;
}


remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

/* remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 ); */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product', 'woocommerce_upsell_display', 20);


remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product_summary', 'share_single_product', 20);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25);
add_action('woocommerce_single_product_summary', 'woocommerce_template_cats', 4);

/* remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 ); */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('yc_after_header', 'woocommerce_breadcrumb');

add_filter('woocommerce_breadcrumb_defaults', 'change_breadcrumb_class');
