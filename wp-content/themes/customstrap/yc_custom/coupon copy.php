<?php

/**
 * 秀出可以使用的折扣
 */

add_action('woocommerce_before_checkout_form', 'yf_coupon_available', 300);

function yf_coupon_available()
{
    if (!is_user_logged_in()) return;
    $user_id = get_current_user_id();
    $coupons = yf_get_coupons();
    /* echo '<pre>';
    var_dump($coupons[1]);
    echo '</pre>'; */

?>
    <style>
        .list-group~.woocommerce-message,
        .woocommerce-form-coupon-toggle {
            display: none !important;
        }
    </style>
    <?php if (!empty($coupons)) :
        $cart_total = (int) WC()->cart->subtotal;
    ?>
        <h2>使用購物金</h2>
        <div class="list-group mb-2" style="border-radius: 5px;">
            <?php foreach ($coupons as $coupon) :
                $data = coupons_available($coupon);
            ?>
                <label class="list-group-item list-group-item-action <?= $data['disabled_bg'] ?>">
                    <input id="coupon-<?= $coupon->ID; ?>" name="yf_coupon" class="form-check-input me-1" type="radio" value="<?= $coupon->post_title; ?>" <?= $data['disabled'] ?>>
                    <?= $coupon->post_title . $coupon->post_excerpt . $data['reason']; ?>
                </label>
            <?php endforeach; ?>
        </div>


        <script>
            (function($) {

                $(document).ready(function() {
                    $('input[name="yf_coupon"]').on('change', function() {
                        if ($('.woocommerce-remove-coupon').length == 0) {
                            yf_apply_coupon()
                        } else {
                            $('.woocommerce-remove-coupon').on('click', function() {
                                setTimeout(() => {
                                    //要等移除完coupon後才可以再應用
                                    yf_apply_coupon()
                                }, 600);

                            })
                            document.querySelector('.woocommerce-remove-coupon').click()
                        }
                    });


                    function yf_apply_coupon() {
                        const coupon_code = $('input[name="yf_coupon"]:checked').val()
                        $('#coupon_code').val(coupon_code)
                        $('button[name="apply_coupon"]').click()
                    }
                })
            })(jQuery)
        </script>
    <?php endif; ?>
<?php
}

function coupons_available($coupon){
    $cart_total = (int) WC()->cart->subtotal;
    $user_id = get_current_user_id();
    $coupon_amount = (int) get_post_meta($coupon->ID, 'coupon_amount', true);
    $minimum_amount = (int) get_post_meta($coupon->ID, 'minimum_amount', true);

    $data = [];
    if($cart_total < $minimum_amount){

        $d = $minimum_amount - $cart_total;
        $shop_url = site_url('shop');
        $data['is_available'] = false;
        $data['reason'] = "，<span class='text-danger'>還差 ${d} 元</span>，<a href='${shop_url}'>再去多買幾件 》</a>";
        $data['disabled'] = "disabled";
        $data['disabled_bg'] = "bg-light cursor-not-allowed";
        return $data;
    }else{
        $data['is_available'] = true;
        $data['reason'] = "";
        $data['disabled'] = "";
        $data['disabled_bg'] = "";
        return $data;
    }


}

function yf_get_coupons()
{
    $coupon_posts = get_posts(array(
        'posts_per_page'   => -1,
        'meta_key' => 'minimum_amount',
        'orderby' => 'meta_value_num',
        'order'            => 'ASC',
        'post_type'        => 'shop_coupon',
        'post_status'      => 'publish',
    ));


    return $coupon_posts; // always use return in a shortcode
}
