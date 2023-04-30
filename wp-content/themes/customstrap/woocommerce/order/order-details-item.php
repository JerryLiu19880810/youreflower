<?php

/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!apply_filters('woocommerce_order_item_visible', true, $item)) {
    return;
}

$is_visible        = $product && $product->is_visible();
$product_permalink = apply_filters('woocommerce_order_item_permalink', $is_visible ? $product->get_permalink($item) : '', $item, $order);
?>
<ul class="list-group list-group-minimal <?php echo esc_attr(apply_filters('woocommerce_order_item_class', 'woocommerce-table__line-item order_item', $item, $order)); ?>">

    <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php esc_html_e('Product', 'woocommerce'); ?>
        <span><?php esc_html_e('Total', 'woocommerce'); ?></span>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php


        echo wp_kses_post(apply_filters('woocommerce_order_item_name', $product_permalink ? sprintf('<a href="%s">%s</a>', $product_permalink, $item->get_name()) : $item->get_name(), $item, $is_visible));

        $qty          = $item->get_quantity();
        $refunded_qty = $order->get_qty_refunded_for_item($item_id);

        if ($refunded_qty) {
            $qty_display = '<del>' . esc_html($qty) . '</del> <ins>' . esc_html($qty - ($refunded_qty * -1)) . '</ins>';
        } else {
            $qty_display = esc_html($qty);
        }

        echo apply_filters('woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $qty_display) . '</strong>', $item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        do_action('woocommerce_order_item_meta_start', $item_id, $item, $order, false);

        wc_display_item_meta($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        do_action('woocommerce_order_item_meta_end', $item_id, $item, $order, false);
        ?>
        <span><?php echo $order->get_formatted_line_subtotal($item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?></span>
    </li>

    <?php foreach ($order->get_order_item_totals() as $key => $total) : ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo esc_html($total['label']); ?>
            <span><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?></span>
        </li>
    <?php endforeach; ?>

    <?php if ($order->get_customer_note()) : ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            購買備註:
            <span><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></span>
        </li>
    <?php endif; ?>

    <?php if ($show_purchase_note && $purchase_note) : ?>
        <li class="list-group-item d-flex justify-content-between align-items-center text-uppercase font-weight-bold woocommerce-table__product-purchase-note product-purchase-note">
            備註2
            <span><?php echo wpautop(do_shortcode(wp_kses_post($purchase_note))); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?></span>
        </li>
    <?php endif; ?>
</ul>