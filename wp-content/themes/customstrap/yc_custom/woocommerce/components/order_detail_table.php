<?php

function Order_detail_table($order)
{
?>
    <ul class="order-meta">
        <?php
        $columns = wc_get_account_orders_columns();
        unset($columns['order-actions']);
        foreach ($columns as $column_id => $column_name) : ?>
            <li class="woocommerce-orders-table__cell woocommerce-orders-table__cell-<?php echo esc_attr($column_id); ?>" data-title="<?php echo esc_attr($column_name); ?>">
                <?php if (has_action('woocommerce_my_account_my_orders_column_' . $column_id)) : ?>
                    <?php do_action('woocommerce_my_account_my_orders_column_' . $column_id, $order); ?>

                <?php elseif ('order-number' === $column_id) : ?>
                    <h5 class="order-meta-title">訂單編號 #</h5>
                    <span><a class="text-dark" href="<?php echo esc_url($order->get_view_order_url()); ?>">
                            <?php echo $order->get_order_number(); ?></span>
                    </a>
                <?php elseif ('order-date' === $column_id) : ?>
                    <h5 class="order-meta-title">訂單日期</h5>
                    <span><time datetime="<?php echo esc_attr($order->get_date_created()->date('c')); ?>"><?php echo esc_html(wc_format_datetime($order->get_date_created(), 'Y / m / j')); ?></time></span>
                <?php elseif ('order-status' === $column_id) : ?>
                    <h5 class="order-meta-title">狀態</h5>
                    <span class="text-muted">
                        <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                    </span>
                <?php elseif ('order-total' === $column_id) : ?>
                    <h5 class="order-meta-title">合計</h5>
                    <span><?php
                            /* translators: 1: formatted order total 2: total order items */
                            echo $order->get_formatted_order_total();
                            ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        <li>
        <?php if ( $order->get_payment_method_title() ) : ?>
                    <h5 class="order-meta-title"><?php esc_html_e( 'Payment method:', 'woocommerce' ); ?></h5>
                    <span><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></span>
				<?php endif; ?>
                </li>

    </ul>

<?php
}
