<?php

/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
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

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $product;

if (!wc_review_ratings_enabled()) {
    return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ($rating_count > 0) : ?>



    <div class="woocommerce-product-rating mb-3">
        <?php if (comments_open()) : ?>
            <p class="stars selected">
                <span class="mr-2 text-gray"><?= round($average, 1) . '/5'; ?></span>
                <span>
                    <?php
                    for ($i = 1; $i <= 5; $i++) :

                        $next = $i + 1;
                        if($average >= ( $i - 0.2 ) && $average <= ( $i + 0.2 ) ) {
                            $active = 'active';
                            $half_star = '';
                        } elseif($average > ( $i + 0.2 ) && $average < ( $next - 0.2 ) ) {
                            $active = 'active';
                            $half_star = 'half_star';
                        }else{
                            $active = '';
                            $half_star = '';
                        }

                    ?>
                        <a class="pe-none star-<?= $i . ' ' . $active . ' ' . $half_star; ?>" href="#"><?= $i ?></a>
                    <?php endfor; ?>
                </span>
                <span class="ml-2 text-gray"><a class="pure-text" href="#reviews"><?= $review_count ?> 則評論</a></span>
            </p>
        <?php endif ?>
    </div>

<?php endif; ?>