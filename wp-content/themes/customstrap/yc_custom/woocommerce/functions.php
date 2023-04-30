<?php




add_action('admin_head', 'remove_feature_image_product_metabox', 200);
function remove_feature_image_product_metabox()
{
  remove_meta_box('postimagediv', 'product', 'side');
}


add_filter('woocommerce_placeholder_img_src', 'save_to_product_feature_img', 200);
function save_to_product_feature_img($src)
{
  global $post;
  $post_id = $post->ID;
  // Only set for post_type = post!
  /* if ('product' !== get_post_type($post_id)) {
        return;
    } */
  $attachment_ids = explode(',', get_post_meta($post_id, '_product_image_gallery', true));
  update_post_meta($post_id, '_thumbnail_id', $attachment_ids[0]);
  $src = wp_get_attachment_url($attachment_ids[0]);
  return $src;
}



/** !!!!!!!!!!!!!!!!!!!!
 * 取得客戶訂單
 *
 * 時間參考
 * //https://wisdmlabs.com/blog/query-posts-or-comments-by-date-time/
 */
function get_orderdata_total_by_user($user_id,  $args = array())
{
  if (empty($args)) {
    $args = array(
      'numberposts' => -1,
      'meta_key'    => '_customer_user',
      'meta_value'  => $user_id,
      'post_type'   => array('shop_order'),
      'post_status' => array('wc-completed', 'wc-processing'),
    );
  }
  $customer_orders = get_posts($args);
  $total = 0;
  foreach ($customer_orders as $customer_order) {
    $order = wc_get_order($customer_order);
    $total += $order->get_total();
  }
  $order_data['total'] = $total;
  $order_data['order_num'] = count($customer_orders);

  return $order_data;
}


function get_orderdata_lastyear_by_user($user_id,  $args = array())
{
  $user = get_userdata($user_id);
  $that_date = strtotime('-1 year');
  $user_registed_time = strtotime($user->data->user_registered);
  $is_registered = ($user_registed_time >=  $that_date) ? false : true;

  if (empty($args)) {
    $args = array(
      'numberposts' => -1,
      'meta_key'    => '_customer_user',
      'meta_value'  => $user_id,
      'post_type'   => array('shop_order'),
      'post_status' => array('wc-completed', 'wc-processing'),
      'date_query' => array(
        array(
          'after' => '1 years ago',
        )
      )
    );
  }
  $customer_orders = get_posts($args);
  $total = 0;
  foreach ($customer_orders as $customer_order) {
    $order = wc_get_order($customer_order);
    $total += $order->get_total();
  }
  $orderdata['total'] = $total;
  $orderdata['order_num'] = count($customer_orders);
  $orderdata['user_is_registered'] = $is_registered;




  return $orderdata;
}


//@todo
function get_expiration_date_text_by_user($user_id)
{
  $user_member_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
  $expiration = gamipress_get_post_meta($user_member_lv, '_gamipress_expirations_expiration', true);
  $amount = absint(gamipress_get_post_meta($user_member_lv, '_gamipress_expirations_amount', true));
  $time_MemberLVexpire_date = get_user_meta($user_id, 'time_MemberLVexpire_date', true) ?: '';
  $date = ($time_MemberLVexpire_date == 'no_expire') ? '沒有期限' : $time_MemberLVexpire_date;

  switch ($expiration) {
    case 'years':
      $expiration_text = $amount . ' 年，至 ' . $date;
      break;
    case '':
      $expiration_text = '沒有期限';
      break;

    default:
      $expiration_text = '';
      break;
  }

  return $expiration_text;
}

function get_next_rank_threhold($user_member_lv)
{
  $next_rank_id = (gamipress_get_next_rank_id($user_member_lv)) ?: '';
  $next_rank_threshold = (get_post_meta($next_rank_id, 'threshold', true)) ?: '';
  //var_dump($next_rank_threshold);
  return $next_rank_threshold;
}

function get_difference_to_next_rank_by_user($user_id)
{
  $user_member_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
  $next_rank_threshold = get_next_rank_threhold($user_member_lv);
  $orderdata_last_year = get_orderdata_lastyear_by_user($user_id);

  $difference_to_next_rank = intval($next_rank_threshold) - intval($orderdata_last_year['total']);
  return $difference_to_next_rank;
}
