<?php

/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) : ?>


    <div class="accordion" id="accordion-1">
        <?php foreach ($product_tabs as $key => $product_tab) :
            if($key == 'excerpt'){
                $active = 'active';
                $collapse = '';
                $expanded = 'true';
                $show = 'show';
            }else{
                $active = '';
                $collapse = 'collapsed';
                $expanded = 'false';
                $show = '';
            }
            ?>
            <div class="card <?php echo $active . ' tab-' . $key; ?>">
                <div class="card-header" id="heading-1-<?php echo $key; ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link <?php echo $collapse; ?>" type="button" data-toggle="collapse" data-target="#collapse-1-<?php echo $key; ?>" aria-expanded="<?php echo $expanded; ?>" aria-controls="collapse-1-<?php echo $key; ?>">
                            <?php echo $product_tab['title']; ?>
                        </button>
                    </h5>
                </div>
                <div id="collapse-1-<?php echo $key; ?>" class="collapse <?php echo $show; ?>" aria-labelledby="heading-1-<?php echo $key; ?>" data-parent="#accordion-1">
                    <div class="card-body">
                        <?php
                        if (isset($product_tab['callback'])) {
                            call_user_func($product_tab['callback'], $key, $product_tab);
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>





<?php endif; ?>