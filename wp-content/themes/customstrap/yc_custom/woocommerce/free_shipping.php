<?php



function handle_free_shipping($rates, $package)
{

  $value = rwmb_meta('free_date', ['object_type' => 'setting'], '免運費設定');
  $expired_time = strtotime($value);
  $now = strtotime('+8 hours');

  if ($now < $expired_time) {
    foreach ($rates as $key => $rate) {
      $rates[$key]->cost = 0;
    }
  }

  return $rates;
}
//add_action( 'woocommerce_review_order_before_shipping', 'handle_free_shipping', 300 );
add_filter('woocommerce_package_rates', 'handle_free_shipping', 300, 2);

add_filter('transient_shipping-transient-version', function ($value, $name) {
  return false;
}, 10, 2);



add_filter( 'mb_settings_pages', 'free_shipping_setting_page' );

function free_shipping_setting_page( $settings_pages ) {
	$settings_pages[] = [
        'menu_title'  => __( '免運費設定', 'youreflower' ),
        'option_name' => '免運費設定',
        'position'    => 25,
        'parent'      => 'edit.php?post_type=product',
        'capability'  => 'edit_posts',
        'style'       => 'no-boxes',
        'columns'     => 1,
        'icon_url'    => 'dashicons-admin-generic',
    ];

	return $settings_pages;
}



add_filter( 'rwmb_meta_boxes', 'free_shipping_mb_field' );

function free_shipping_mb_field( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'          => __( '免運費', 'youreflower' ),
        'id'             => 'free_shipping_date',
        'settings_pages' => [''],
        'fields'         => [
            [
                'name'              => __( '免運費期限', 'youreflower' ),
                'id'                => $prefix . 'free_date',
                'type'              => 'date',
                'label_description' => __( '超過這個時間的00:00就會恢復原本的運費設定', 'youreflower' ),
                'columns'           => 4,
            ],
        ],
    ];

    return $meta_boxes;
}