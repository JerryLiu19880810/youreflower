<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}

global $product;
?>

<!-- product -->
<section id="product-<?php the_ID(); ?>" <?php wc_product_class('hero', $product); ?>>
    <div class="container">
        <?php
        /**
         * Hook: woocommerce_before_single_product.
         *
         * @hooked woocommerce_output_all_notices - 10
         */
        do_action('woocommerce_before_single_product');
        ?>
        <div class="row gutter-2 gutter-md-4 justify-content-between">


            <!-- carousel -->
            <div class="col-lg-7">
                <?php
                /**
                 * Hook: woocommerce_before_single_product_summary.
                 *
                 * @hooked woocommerce_show_product_sale_flash - 10
                 * @hooked woocommerce_show_product_images - 20
                 */
                do_action('woocommerce_before_single_product_summary');
                ?>
            </div>

            <div class="col-lg-4 mb-5 mb-lg-0">

                <!-- description -->
                <div class="row">
                    <div class="col-12">
                        <?php
                        /**
                         * Hook: woocommerce_single_product_summary.
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_rating - 10
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         * @hooked WC_Structured_Data::generate_product_data() - 60
                         */
                        do_action('woocommerce_single_product_summary');
                        ?>
                    </div>
                </div>


                <!--@todo  <div class="row gutter-2">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Size</label>
                            <div class="btn-group-toggle btn-group-square" data-toggle="buttons">
                                <label class="btn active">
                                    <input type="radio" name="customRadio" id="option-1"> xs
                                </label>
                                <label class="btn">
                                    <input type="radio" name="customRadio" id="option-2"> s
                                </label>
                                <label class="btn">
                                    <input type="radio" name="customRadio" id="option-3"> m
                                </label>
                                <label class="btn">
                                    <input type="radio" name="customRadio" id="option-4"> l
                                </label>
                                <label class="btn">
                                    <input type="radio" name="customRadio" id="option-5"> xl
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Color</label>
                            <div class="btn-group-toggle btn-group-square btn-group-colors" data-toggle="buttons">
                                <label class="btn active text-red">
                                    <input type="radio" name="color-select" id="option-2-1" checked>
                                </label>
                                <label class="btn text-blue">
                                    <input type="radio" name="color-select" id="option-2-2">
                                </label>
                                <label class="btn text-yellow">
                                    <input type="radio" name="color-select" id="option-2-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- accordion -->
                <div class="row">
                    <div class="col-12">

                        <?php
                        /**
                         * Hook: woocommerce_after_single_product_summary.
                         *
                         * @hooked woocommerce_output_product_data_tabs - 10
                         * @hooked woocommerce_upsell_display - 15
                         * @hooked woocommerce_output_related_products - 20
                         */
                        do_action('woocommerce_after_single_product_summary');
                        ?>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php the_content(); ?>

            </div>
        </div>
        <?php do_action('woocommerce_after_single_product'); ?>
    </div><!-- end container -->
</section>





