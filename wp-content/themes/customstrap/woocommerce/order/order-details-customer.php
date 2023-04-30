<?php

/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.6.0
 */

defined('ABSPATH') || exit;
$billing_first_name = $order->get_billing_first_name();
$show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
$billing_address_1 = $order->get_billing_address_1();
?>


<div class="bordered p-3">
    <h5 class="eyebrow text-muted"><?php esc_html_e('Billing address', 'woocommerce'); ?></h5>
    <p class="card-text"><?php echo $billing_first_name; ?></p>
    <p class="card-text">
    <address>
        <?php echo $billing_address_1; ?>
    </address>
    </p>
    <?php if ($order->get_billing_phone()) : ?>
            <p class="woocommerce-customer-details--phone card-text"><?php echo esc_html($order->get_billing_phone()); ?></p>
        <?php endif; ?>

        <?php if ($order->get_billing_email()) : ?>
            <p class="woocommerce-customer-details--email card-text"><?php echo esc_html($order->get_billing_email()); ?></p>
        <?php endif; ?>
    <h5 class="eyebrow text-muted">運送方式</h5>
    <?php
    // Iterating through order shipping items
foreach( $order->get_items( 'shipping' ) as $item_id => $item ):
    $order_item_name             = $item->get_name();
    $order_item_type             = $item->get_type();
    $shipping_method_title       = $item->get_method_title();
    $shipping_method_id          = $item->get_method_id(); // The method ID
    $shipping_method_instance_id = $item->get_instance_id(); // The instance ID
    $shipping_method_total       = $item->get_total();
    $shipping_method_total_tax   = $item->get_total_tax();
    $shipping_method_taxes       = $item->get_taxes();

    ?>
    <p class="card-text"><?php echo $shipping_method_title; ?></p>
    <?php endforeach; ?>

    <?php do_action('woocommerce_order_details_after_customer_details', $order); ?>
</div>

