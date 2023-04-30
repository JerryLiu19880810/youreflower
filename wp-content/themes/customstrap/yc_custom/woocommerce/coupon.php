<?php

/**
 * 秀出可以使用的折扣
 */

add_action('wp_enqueue_scripts', 'handle_coupon_enqueue');

function handle_coupon_enqueue()
{
  if (is_checkout()) {
    wp_enqueue_script('handle-coupon', get_stylesheet_directory_uri() . '/assets/js/handle-coupon.js', array('wc-checkout'), YC_VER, true);
  }
}

add_action('woocommerce_before_checkout_form', 'yf_coupon_available', 300);

function yf_coupon_available()
{

  $normal_coupons = yf_get_coupons('normal'); //取得網站一般優惠
  $coupons = yf_get_coupons('required_reward'); //取得需要購物金的優惠券

?>
  <style>
    .list-group~.woocommerce-message {
      display: none !important;
    }
  </style>
  <?php if (!empty($normal_coupons)) :

    $normal_coupons = handle_coupons($normal_coupons);

  ?>
    <h2 class="">消費滿額折扣</h2>
    <div class="list-group mb-2" style="border-radius: 5px;">
      <?php foreach ($normal_coupons as $coupon) :
        $data = coupons_available_normal($coupon);


      ?>
        <label class="list-group-item list-group-item-action <?= $data['disabled_bg'] ?>">
          <input data-type="normal_coupon" id="coupon-<?= $coupon->ID; ?>" name="yf_normal_coupon" class="form-check-input me-1 normal_coupon" type="radio" value="<?= $coupon->post_title; ?>" <?= $data['disabled'] ?>>
          <?= $coupon->post_title . $coupon->post_excerpt . $data['reason']; ?>
        </label>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($coupons)) :
    //$coupons = handle_coupons($coupons);
  ?>
    <h2 class="">使用購物金</h2>
    <div class="list-group mb-2" style="border-radius: 5px;">
      <?php foreach ($coupons as $coupon) :
        $data = coupons_available($coupon);
      ?>
        <label class="list-group-item list-group-item-action <?= $data['disabled_bg'] ?>">
          <input data-type="required_reward_coupon" id="coupon-<?= $coupon->ID; ?>" name="yf_coupon" class="form-check-input me-1 required_reward_coupon" type="radio" value="<?= $coupon->post_title; ?>" <?= $data['disabled'] ?>>
          <?= $coupon->post_title . $coupon->post_excerpt . $data['reason']; ?>
        </label>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php
}

function yf_get_coupons($type)
{

  $coupon_posts_without_minimum_amount = get_posts(array(
    'posts_per_page'   => -1,
    'post_type'        => 'shop_coupon',
    'post_status'      => 'publish',
    'meta_query' => array(
      'relation' => 'AND',
      'minimum_amount_clause' => array(
        'key' => 'minimum_amount',
        'compare' => 'NOT EXISTS',
      ),
      'reuqire_yf_reward_clause' => array(
        'key' => 'coupon_type',
        'value' => $type,
      ),
    ),
  ));

  $coupon_posts_with_minimum_amount = get_posts(array(
    'posts_per_page'   => -1,
    'meta_key' => 'minimum_amount',
    'orderby' => ($type === 'required_reward') ? ['meta_value_num', 'ID'] : 'meta_value_num',
    'order'            => 'ASC',
    'post_type'        => 'shop_coupon',
    'post_status'      => 'publish',
    'meta_query' => array(
      'relation' => 'AND',
      'minimum_amount_clause' => array(
        'key' => 'minimum_amount',
        'compare' => 'EXISTS',
      ),
      'reuqire_yf_reward_clause' => array(
        'key' => 'coupon_type',
        'value' => $type,
      ),
    ),
  ));



  $coupon_posts = array_merge($coupon_posts_without_minimum_amount, $coupon_posts_with_minimum_amount);

  if ($type !== 'required_reward')  return $coupon_posts;
  if (!is_user_logged_in()) return;

  $user_id = get_current_user_id();
  $user_birthday = get_user_meta($user_id, 'birthday', true);
  $user_member_lv_id = yf_get_user_member_lv_id($user_id);
  $user_member_lv_title = get_the_title($user_member_lv_id);
  $birthday_coupon_name = $user_member_lv_title . '當月生日禮金';

  foreach ($coupon_posts as $key => $coupon_post) {
    //var_dump((strpos($coupon_post->post_title, $user_member_lv_title) !== false));
    if ((strpos($coupon_post->post_title, $user_member_lv_title) === false) && (strpos($coupon_post->post_title, '全會員') === false)) {
      // 優惠券不包含用戶等級就取消
      unset($coupon_posts[$key]);
    }
  }

  if (date('m', strtotime($user_birthday)) != date('m')) {
    foreach ($coupon_posts as $key => $coupon_post) {
      if (strpos($coupon_post->post_title, "生日禮金") !== false) {
        // 用戶沒生日，不應用
        unset($coupon_posts[$key]);
      }
      $date_expires = get_post_meta($coupon_post->ID, 'date_expires', true);

      if (!empty($date_expires) && (int) $date_expires < time()) {
        //過期的coupon
        unset($coupon_posts[$key]);
        continue;
      }
    }
  } else {
    //用戶生日
    foreach ($coupon_posts as $key => $coupon_post) {
      if (strpos($coupon_post->post_title, "生日禮金") !== false && $coupon_post->post_title != $birthday_coupon_name) {
        // 用戶沒生日，不應用
        unset($coupon_posts[$key]);
      }
    }
  }

  $coupon_posts = get_available_coupons($coupon_posts);


  return $coupon_posts; // always use return in a shortcode
}

function get_coupon_type($coupon)
{
  $coupon_id          = $coupon->get_id();
  $coupon_type = get_post_meta($coupon_id, 'coupon_type', true);
  return $coupon_type;
}

function get_available_coupons($coupons)
{
  //如果用戶購物金不足，就移除coupon
  foreach ($coupons as $key => $coupon) {
    $user_id = get_current_user_id();
    $user_points = (int) gamipress_get_user_points($user_id, 'yf_reward');
    $coupon_amount = (int) get_post_meta($coupon->ID, 'coupon_amount', true);
    if ($user_points < $coupon_amount) {
      //購物金不足
      unset($coupons[$key]);
    }
  }
  return $coupons;
}

function coupons_available($coupon)
{
  $cart_total = (int) WC()->cart->subtotal;
  $user_id = get_current_user_id();
  $user_points = (int) gamipress_get_user_points($user_id, 'yf_reward');
  $coupon_amount = (int) get_post_meta($coupon->ID, 'coupon_amount', true);
  $minimum_amount = (int) get_post_meta($coupon->ID, 'minimum_amount', true);

  $data = [];
  if ($user_points < $coupon_amount) {
    $data['is_available'] = false;
    $data['reason'] = "，<span class='text-danger'>您的購物金不足(目前${user_points})，無法使用折扣</span>";
    $data['disabled'] = "disabled";
    $data['disabled_bg'] = "bg-light cursor-not-allowed";
    return $data;
  } elseif ($cart_total < $minimum_amount) {

    $d = $minimum_amount - $cart_total;
    $shop_url = site_url('shop');
    $data['is_available'] = false;
    $data['reason'] = "，<span class='text-danger'>還差 ${d} 元</span>，<a href='${shop_url}'>再去多買幾件 》</a>";
    $data['disabled'] = "disabled";
    $data['disabled_bg'] = "bg-light cursor-not-allowed";
    return $data;
  } else {
    $data['is_available'] = true;
    $data['reason'] = "";
    $data['disabled'] = "";
    $data['disabled_bg'] = "";
    return $data;
  }
}

function coupons_available_normal($coupon)
{
  $cart_total = (int) WC()->cart->subtotal;
  $coupon_amount = (int) get_post_meta($coupon->ID, 'coupon_amount', true);
  $minimum_amount = (int) get_post_meta($coupon->ID, 'minimum_amount', true);

  $data = [];
  if ($cart_total < $minimum_amount) {

    $d = $minimum_amount - $cart_total;
    $shop_url = site_url('shop');
    $data['is_available'] = false;
    $data['reason'] = "，<span class='text-danger'>還差 ${d} 元</span>，<a href='${shop_url}'>再去多買幾件 》</a>";
    $data['disabled'] = "disabled";
    $data['disabled_bg'] = "bg-light cursor-not-allowed";
    return $data;
  } else {
    $data['is_available'] = true;
    $data['reason'] = "";
    $data['disabled'] = "";
    $data['disabled_bg'] = "";
    return $data;
  }
}

/**
 * @see https://woocommerce.github.io/code-reference/files/woocommerce-includes-wc-stock-functions.html#source-view.100
 * 訂單成立時才扣購物金
 */
//woocommerce_payment_complete


function point_reduct_with_coupon($order_id)
{
  $order = wc_get_order($order_id);
  $coupon_codes   = $order->get_coupon_codes();
  $coupon_amount = 0;
  foreach ($coupon_codes as $key => $coupon_code) {
    $the_coupon = new WC_Coupon($coupon_code);
    $coupon_amount = $the_coupon->get_amount();
    $type = get_coupon_type($the_coupon);
    if ($type == 'required_reward' && $coupon_amount > 0) {

      $user_id = $order->get_customer_id();
      $user = get_user_by('id', $user_id);
      $user_member_lv_id = yf_get_user_member_lv_id($user_id);
      $user_member_lv_title = get_the_title($user_member_lv_id);
      $points_type = 'yf_reward';

      $args = array(
        'reason' => "使用購物金 NT$ $coupon_amount - $user->display_name ($user_member_lv_title)",
      );
      gamipress_deduct_points_to_user($user_id, $coupon_amount, $points_type, $args);
    }
  }
}



//add_action( 'woocommerce_payment_complete', 'point_reduct_with_coupon' );
// add_action( 'woocommerce_order_status_completed', 'point_reduct_with_coupon' );
add_action('woocommerce_order_status_processing', 'point_reduct_with_coupon');
// add_action( 'woocommerce_order_status_on-hold', 'point_reduct_with_coupon' );

/**
 * 訂單取消時
 */

function point_restore_with_coupon($order_id)
{
  $order = wc_get_order($order_id);
  $coupon_codes   = $order->get_coupon_codes();
  $coupon_amount = 0;
  foreach ($coupon_codes as $key => $coupon_code) {
    $the_coupon = new WC_Coupon($coupon_code);
    $coupon_amount = $the_coupon->get_amount();

    $type = get_coupon_type($the_coupon);
    if ($type == 'required_reward' && $coupon_amount > 0) {

      $user_id = $order->get_customer_id();
      $user = get_user_by('id', $user_id);
      $user_member_lv_id = yf_get_user_member_lv_id($user_id);
      $user_member_lv_title = get_the_title($user_member_lv_id);
      $points_type = 'yf_reward';

      $args = array(
        'reason' => "訂單取消，購物金退回 NT$ $coupon_amount - $user->display_name ($user_member_lv_title)",
      );
      gamipress_award_points_to_user($user_id, $coupon_amount, $points_type, $args);
    }
  }
}



add_action('woocommerce_order_status_cancelled', 'point_restore_with_coupon');
// add_action( 'woocommerce_order_status_pending', 'point_restore_with_coupon' );


add_filter('rwmb_meta_boxes', 'handle_coupon_mb');

function handle_coupon_mb($meta_boxes)
{
  $prefix = '';

  $meta_boxes[] = [
    'title'      => __('折價券類型', 'youreflower'),
    'id'         => 'reuqire_yf_reward',
    'post_types' => ['shop_coupon'],
    'fields'     => [
      [
        'id'      => $prefix . 'coupon_type',
        'type'    => 'radio',
        'options' => [
          'code'            => __('輸入優惠碼才有優惠', 'youreflower'),
          'normal'          => __('全站優惠', 'youreflower'),
          'required_reward' => __('需要有購物金', 'youreflower'),
        ],
        'std'     => 'code',
        'inline'  => false,
      ],
    ],
  ];

  return $meta_boxes;
}

/**
 * 隱藏小的coupon
 * 只出現大的coupon
 */
function handle_coupons($coupons)
{
  $cart_total = (int) WC()->cart->subtotal;

  foreach ($coupons as $key => $coupon) {
    $minimum_amount = (int) get_post_meta($coupon->ID, 'minimum_amount', true);
    $minimum_amount = !empty($minimum_amount) ? $minimum_amount : 0;
    if ($cart_total - $minimum_amount >= 0) {
      $meet[$coupon->ID] = abs($cart_total - $minimum_amount);
    } else {
      $not_meet[$coupon->ID] = abs($cart_total - $minimum_amount);
    }
  }
  $meet = !empty($meet) ? $meet : [];
  $not_meet = !empty($not_meet) ? $not_meet : [];
  asort($meet); //form small to big
  asort($not_meet); // from small to big

  $biggest_coupon = array_slice($meet, 0, 1, true);
  $keys = array_keys($biggest_coupon + $not_meet);
  foreach ($coupons as $key => $coupon) {
    if (!in_array($coupon->ID, $keys)) {
      unset($coupons[$key]);
    }
  }

  return $coupons;
}


// 自動套用 coupon
function auto_apply_coupon(WC_Cart $cart)
{

  $user_id = get_current_user_id();
  $orderdata = get_orderdata_total_by_user($user_id);
  $order_num = $orderdata['order_num']; // 訂單數量

  // // 如果不是第一次消費  甚麼也不做
  // var_dump($order_num);
  if($order_num > 0 || !is_user_logged_in()) return;


  $discount = 50;
  $cart->add_fee('首次消費折50元', -$discount);
}
add_action('woocommerce_cart_calculate_fees', 'auto_apply_coupon', 300);
