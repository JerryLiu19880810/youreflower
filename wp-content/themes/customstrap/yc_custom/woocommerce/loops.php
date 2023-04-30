<?php
add_filter('woocommerce_product_loop_title_classes', function ($class) {
    $class = $class . ' card-title';
    return $class;
}, 100);
