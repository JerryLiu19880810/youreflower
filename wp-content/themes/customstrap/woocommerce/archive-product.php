<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');


$args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'parent'     => 0,
    'exclude'  => 15
);


 $product_cats = get_terms($args);


?>



<!-- listing -->
<section class="pt-6">
    <div class="container">
        <div class="row gutter-1 align-items-end">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <div class="col-md-6">
                    <p class="h1"><?php woocommerce_page_title(); ?></p>
                    <?php
                    /**
                     * Hook: woocommerce_archive_description.
                     *
                     * @hooked woocommerce_taxonomy_archive_description - 10
                     * @hooked woocommerce_product_archive_description - 10
                     */
                    do_action('woocommerce_archive_description');
                    ?>
                </div>
            <?php endif; ?>

            <div class="col-md-6 text-md-right">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked woocommerce_output_all_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action('woocommerce_before_shop_loop');
                ?>
                <!-- <ul class="list list--horizontal list--separated text-muted fs-14">
                    <li>
                        <span class="text-primary">15 from <?php echo $count_all_product; ?> items</span>
                    </li>
                    <li>
                        <span>Sort by
                            <span class="dropdown">
                                <a class="dropdown-toggle underline" href="#!" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Most popular
                                </a>

                                <span class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#!">Action</a>
                                    <a class="dropdown-item" href="#!">Another action</a>
                                    <a class="dropdown-item" href="#!">Something else here</a>
                                </span>
                            </span>
                        </span>
                    </li>
                </ul> -->
            </div>
        </div>




        <!-- products -->
        <div class="row gutter-1">
            <!-- sidebar -->
            <aside class="col-lg-3 sidebar">
                <div class="widget">
                    <span class="widget-title">產品分類</span>
                    <ul id="page-nav" class="nav flex-column nav-accordion">

                    <?php foreach ($product_cats as $product_cat) :
                        $cat_link = 'href="' . get_term_link($product_cat->term_id, 'product_cat') . '"';

                        //level2 product_cats
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'parent' => $product_cat->term_id,
                        );
                         $product_cats_2 = get_terms($args);
                         if(!empty($product_cats_2)){
                            $product_cats_2_loop = '';
                            foreach ($product_cats_2 as $product_cat_2) {
                                $cat_2_link = get_term_link($product_cat_2->term_id, 'product_cat');
                                $product_cats_2_loop .= '<li class="nav-item">
                                <a class="nav-link" href="' . $cat_2_link . '">' . $product_cat_2->name . '</a>
                            </li>';
                            }
                            $attr = 'data-toggle="collapse" href="#menu-' . $product_cat->slug . '" role="button" aria-expanded="true" aria-controls="menu-' . $product_cat->slug . '"';
                            $html = '<div class="collapse show" id="menu-' . $product_cat->slug . '" data-parent="#page-nav">
                            <div>
                                <ul class="nav flex-column">' .
                                    $product_cats_2_loop
                                . '</ul>
                            </div>
                        </div>';
                            $cat_link = '';
                         }else{
                            $attr = '';
                            $html = '';
                         }

                        ?>
                        <li class="nav-item">
                            <a class="nav-link" <?= $cat_link ?> <?= $attr ?>><?= $product_cat->name ?></a>
                            <?= $html ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </aside>

            <div class="col-lg-9 pl-lg-5">
                <div class="row">
                    <?php
                    if (woocommerce_product_loop()) {



                        //woocommerce_product_loop_start();

                        if (wc_get_loop_prop('total')) {
                            while (have_posts()) {
                                the_post();

                                /**
                                 * Hook: woocommerce_shop_loop.
                                 */
                                do_action('woocommerce_shop_loop');

                                wc_get_template_part('content', 'product');
                            }
                        }



                        /**
                         * Hook: woocommerce_after_shop_loop.
                         *
                         * @hooked woocommerce_pagination - 10
                         */
                        do_action('woocommerce_after_shop_loop');
                    } else {
                        /**
                         * Hook: woocommerce_no_products_found.
                         *
                         * @hooked wc_no_products_found - 10
                         */
                        do_action('woocommerce_no_products_found');
                    }

                    woocommerce_product_loop_end();
                    ?>
                </div>
            </div>
        </div>


    </div>
</section>





<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
//do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action('woocommerce_sidebar');

get_footer('shop');
