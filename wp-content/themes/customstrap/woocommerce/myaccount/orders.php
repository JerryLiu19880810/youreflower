<?php

/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_account_orders', $has_orders); ?>

<?php if ($has_orders) : ?>


    <!-- orders -->
    <div class="row">
        <div class="col">
            <h2>Orders</h2>
        </div>
    </div>
    <div class="row gutter-2">
        <?php
        foreach ($customer_orders->orders as $customer_order) :
            $order      = wc_get_order($customer_order);
            $item_count = $order->get_item_count();
            $order->get_item_count_refunded();
            $order_url = $order->get_view_order_url();
        ?>
            <div class="col-12">
                <div class="card card-data bordered">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="card-title fs-18"><a href="<?php echo $order_url; ?>">訂單編號 #<?php echo $order->get_id(); ?></a></h2>
                            </div>
                            <div class="col text-right">
                                <span class="dropdown">
                                    <button class="btn btn-lg btn-white btn-ico" id="dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="button"><i class="icon-more-vertical"></i></button>
                                    <span class="dropdown-menu" aria-labelledby="dropdown-1">

                                        <?php
                                        $actions = wc_get_account_orders_actions($order);

                                        if (!empty($actions)) {
                                            foreach ($actions as $key => $action) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                        ?>
                                                <a class="dropdown-item <?php echo sanitize_html_class($key); ?>" href="<?php echo esc_url($action['url']); ?>"><?php echo esc_html($action['name']); ?></a>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="order-preview">

                            <?php
                            foreach ($order->get_items() as $item_id => $item) :
                                $product_id = $item->get_product_id();
                                $product_image = wp_get_attachment_url(get_post_thumbnail_id($product_id));
                                $product_url = get_the_permalink($product_id);
                                $product_title = get_the_title($product_id);
                            ?>

                                <li><a href="<?php echo $product_url; ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $product_title; ?>"><img class="aspect:4/5" src="<?php echo $product_image; ?>" alt="<?php echo $product_title; ?>"></a></li>

                            <?php
                            endforeach;

                            ?>
                        </ul>
                    </div>
                    <div class="card-body">
                        <?php Order_detail_table($order); ?>

                        <?php do_action('woocommerce_before_account_orders_pagination'); ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>



    <?php if (1 < $customer_orders->max_num_pages) : ?>
        <div class="row woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination justify-content-between">
            <?php if (1 !== $current_page) : ?>
                <a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page - 1)); ?>"><?php esc_html_e('Previous', 'woocommerce'); ?></a>
            <?php endif; ?>

            <?php if (intval($customer_orders->max_num_pages) !== $current_page) : ?>
                <a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url(wc_get_endpoint_url('orders', $current_page + 1)); ?>"><?php esc_html_e('Next', 'woocommerce'); ?></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>


<?php else : ?>
    <div class="row woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">

        <?php esc_html_e('No order has been made yet.', 'woocommerce'); ?>，<a class="woocommerce-Button button" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">去逛逛產品</a>
    </div>
<?php endif; ?>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>