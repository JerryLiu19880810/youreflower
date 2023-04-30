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

$args = array(
    'header_class' => 'header-absolute',
);

get_header('', $args);



if ($args['header_class'] == 'header-absolute') {
    echo '<div class="d-block" style="height:126px;"></div>';
}

//custom fields
$slider = rwmb_meta('slide');
$_2col = rwmb_meta('2col');
$product_cats = rwmb_meta('product_cat');
$posts_per_page = rwmb_meta('posts_per_page');
$collect_products = rwmb_meta('product_select');
$banners = rwmb_meta('banner');

?>





<!-- swiper -->
<div class="swiper-container" style="aspect-ratio: 1860/750;">
    <div class="swiper-wrapper">
        <?php
        foreach ($slider as $slide) :
            $img_url = wp_get_attachment_url($slide['slide_image']);
            $link_html = empty($slide['slide_link']) ? '' : '<a href="' . $slide['slide_link'] . '">';
            $link_html_end = empty($slide['slide_link']) ? '' : '</a>';
        ?>
            <div class="swiper-slide">
                <?= $link_html ?>
                <div class="image" style="background-image:url(<?= $img_url ?>);"></div>
                <?= $link_html_end ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-footer">
        <div class="container">
            <div class="row justify-content-end align-items-center">
                <div class="col-lg-6 text-right">
                    <div class="swiper-navigation">
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- categories -->
<section class="py-1">
    <div class="container-full">
        <div class="row gutter-1">
            <?php foreach ($_2col as $col) :
                $left_image_url = wp_get_attachment_url($col['left_image']);
                $left_link_html = empty($col['left_link']) ? '' : '<a href="' . $col['left_link'] . '">';
                $left_link_html_end = empty($col['left_link']) ? '' : '</a>';
                $right_image_url = wp_get_attachment_url($col['right_image']);
                $right_link_html = empty($col['right_link']) ? '' : '<a href="' . $col['right_link'] . '">';
                $right_link_html_end = empty($col['right_link']) ? '' : '</a>';
            ?>

                <div class="col-md-6">
                    <div class="card card-tile">
                        <figure class="card-image equal" style="aspect-ratio: 920/653;">
                            <?= $left_link_html ?>
                            <span class="image" style="background-image: url(<?= $left_image_url ?>);"></span>
                            <?= $left_link_html_end ?>
                        </figure>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-tile">
                        <figure class="card-image equal" style="aspect-ratio: 920/653;">
                            <?= $right_link_html ?>
                            <span class="image" style="background-image: url(<?= $right_image_url ?>);"></span>
                            <?= $right_link_html_end ?>
                        </figure>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- carousel -->
<section class="py-lg-0 no-overflow">
    <div class="container">
        <div class="row align-items-center gutter-1">
            <div class="col-lg-3">
                <div class="pr-lg-5">
                    <div class="level-1">
                        <span class="eyebrow text-muted">Hot Products</span>
                        <h2>Top Sellers</h2>
                        <div class="nav nav-tabs flex-lg-column mt-md-3 lavalamp">
                            <?php foreach ($product_cats as $key => $product_cat) :
                                $active = $key == 0 ? 'active' : '';
                            ?>
                                <a class="nav-item nav-link <?= $active ?>" data-filter="<?= $key + 1 ?>"><?= $product_cat->name ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row gutter-2 filtr-container imagesloaded">

                    <?php foreach ($product_cats as $key => $product_cat) :
                        $active = $key == 0 ? 'active' : '';
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => $posts_per_page,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => $product_cat->term_id,
                                ),
                            ),
                        );
                        $products = new WP_Query($args);
                    ?>

                        <div class="col-12 filtr-item" data-category="<?= $key + 1 ?>" data-sort="value">
                            <div class="owl-carousel owl-carousel--mask visible" data-items="[2,2,2,1]" data-loop="true" data-margin="10" data-nav="true">
                                <?php
                                while ($products->have_posts()) : $products->the_post();
                                    global $product;
                                    $attachment_ids = $product->get_gallery_image_ids();
                                    $product_img_1 = empty($attachment_ids[0]) ? '' : '<img src="' . wp_get_attachment_url($attachment_ids[0]) . '">';
                                    $product_img_2 = empty($attachment_ids[1]) ? '' : '<img src="' . wp_get_attachment_url($attachment_ids[1]) . '">';
                                ?>
                                    <div class="card card-product">
                                        <figure class="card-image">
                                            <a href="#!" class="action"><i class="icon-heart"></i></a>
                                            <a href="<?= get_the_permalink(); ?>">
                                                <?= $product_img_1 ?>
                                                <?= $product_img_2 ?>
                                            </a>
                                        </figure>
                                        <a href="" class="card-body">
                                            <h3 class="card-title"><?= get_the_title(); ?></h3>
                                            <span class="price"><?php echo $product->get_price_html(); ?></span>
                                        </a>
                                    </div>

                                <?php endwhile;
                                wp_reset_query();
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- categories -->
<section>
    <div class="container">
        <div class="row align-items-end">
            <div class="col-12">
                <!-- <span class="eyebrow text-muted">Shop by category</span> -->
                <h2 class="text-center">COLLECTION</h2>
            </div>
            <div class="col-12 text-right">
                <a href="<?= site_url('shop'); ?>" class="text-dark">看更多 》</a>
            </div>
        </div>
        <div class="row gutter-1">
            <?php
            $_pf = new WC_Product_Factory();
            foreach ($collect_products as $collect_product_id) :
                //$product = wc_get_product($collect_product_id);
                $product = wc_get_product( $collect_product_id );
                $attachment_ids = $product->get_gallery_image_ids();
                 $product_image = empty($attachment_ids[0]) ? '' : wp_get_attachment_url($attachment_ids[0]);
                //$product_image = wp_get_attachment_url(get_post_thumbnail_id($collect_product_id));
                $product_title = get_the_title($collect_product_id);
                $product_url = get_the_permalink($collect_product_id)
            ?>

                <div class="col-6 col-lg-3">
                    <a href="<?= $product_url; ?>">
                        <figure class="category category--alt">
                            <div class="equal"><span class="image" style="background-image: url(<?= $product_image; ?>)"></span></div>
                            <figcaption><?= $product_title; ?></figcaption>
                        </figure>
                    </a>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>


<section class="pt-0">
    <div class="container">
        <?php foreach ($banners as $banner) :
            $img_url = wp_get_attachment_url($banner['banner_image']);
            $link_html = empty($banner['banner_link']) ? '' : '<a href="' . $banner['banner_link'] . '">';
            $link_html_end = empty($banner['banner_link']) ? '' : '</a>';
        ?>
            <?= $link_html; ?>
            <img class="w-100" src="<?= $img_url; ?>" alt="">
            <?= $link_html_end; ?>
        <?php endforeach; ?>
    </div>
</section>




<?php
get_footer();
