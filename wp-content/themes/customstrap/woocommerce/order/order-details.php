<?php

/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (!$order) {
    return;
}

$order_items           = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note    = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads'  => $downloads,
            'show_title' => true,
        )
    );
}


?>



<!-- meta -->
<div class="row">
    <div class="col">
        <div class="bordered p-3">
            <?php Order_detail_table($order); ?>
        </div>
    </div>
</div>

<!-- products -->
<div class="row">
    <div class="col-12">
        <h2 class="mb-1 text-uppercase fs-20"><?php echo count($order_items); ?> 個產品</h2>
    </div>
    <div class="col-12">
        <div class="bordered cart-item-list p-3">

            <?php foreach ($order_items as $item_id => $item) :
                $product = $item->get_product();
                $product_id = $item->get_product_id();
                $product_image = wp_get_attachment_url(get_post_thumbnail_id($product_id));
                $product_url = get_the_permalink($product_id);
                $product_title = get_the_title($product_id);
                $item_quantity  = $item->get_quantity();
                $sale_price     = $product->get_regular_price(); // The product raw regular price
                $item_total     = $item->get_total(); // Get the item line total discounted
            ?>
                <div class="cart-item">
                    <a href="<?php echo $product_url; ?>" class="cart-item-image"><img class="aspect:4/5" src="<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>"></a>
                    <div class="cart-item-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="cart-item-title"><?php echo $product_title; ?></h5>
                                <!-- <small class="cart-item-subtitle">Fred Perry</small> -->

                            </div>
                            <div class="col">
                                <ul class="list list--horizontal list--separated fs-14 text-muted">
                                    <!-- <li>Color <span class="text-dark">Blue</span></li> -->
                                    <li>數量 <span class="text-dark"><?php echo $item_quantity; ?></span> 個</li>
                                </ul>
                            </div>
                            <div class="col text-right">
                                <ul class="cart-item-meta">
                                    <li><s><?php echo $sale_price * $item_quantity; ?></s></li>
                                    <li class="text-red"><?php echo $item_total; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- order total -->
<div class="row">
    <div class="col-12">
        <?php do_action('woocommerce_order_details_before_order_table', $order); ?>
    </div>
    <div class="col-12">
        <h2 class="text-uppercase fs-20 mb-1">訂單資料</h2>
    </div>
    <div class="col-12">
        <div class="bordered p-3">
            <?php
            do_action('woocommerce_order_details_before_order_table_items', $order);

            foreach ($order_items as $item_id => $item) {
                $product = $item->get_product();

                wc_get_template(
                    'order/order-details-item.php',
                    array(
                        'order'              => $order,
                        'item_id'            => $item_id,
                        'item'               => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note'      => $product ? $product->get_purchase_note() : '',
                        'product'            => $product,
                    )
                );
            }

            do_action('woocommerce_order_details_after_order_table_items', $order);
            ?>
        </div>
    </div>

    <div class="col-12">
        <?php do_action('woocommerce_order_details_after_order_table', $order); ?>
    </div>
</div>


<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action('woocommerce_after_order_details', $order);
?>


<!-- delivery details -->
<div class="row">
    <div class="col-12">
        <h2 class="mb-1 text-uppercase fs-20">用戶資料</h2>
    </div>
    <div class="col-12">

        <?php
        if ($show_customer_details) {
            wc_get_template('order/order-details-customer.php', array('order' => $order));
        }
        ?>

    </div>
</div>