<?php

/**
 * 此案不使用
 * 點數折抵消費
 */

//add_action('woocommerce_before_checkout_form', 'yf_point_reduct', 300);

function yf_point_reduct()
{
    if(!is_user_logged_in()) return;
    $user_id = get_current_user_id();
    $user_points = gamipress_get_user_points($user_id, 'yf_reward');
    $user_points_img = '<img width="21" height="21" src="' . get_the_post_thumbnail_url(701) . '" />';
?>
<div class="form-group form-check">
        <input data-all-point="<?= $user_points ?>" type="checkbox" class="form-check-input" id="point_reduct">
        <label class="form-check-label" for="point_reduct">使用購物金</label>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">購物金</span>
        </div>
        <input type="text" class="form-control text-right" value="<?= $user_points ?>" readonly>
        <div class="input-group-append">
            <span class="input-group-text"><?= $user_points_img ?></span>
        </div>
    </div>


    <script>
        (function() {

            function docReady(fn) {
                // see if DOM is already available
                if (document.readyState === "complete" || document.readyState === "interactive") {
                    // call on next available tick
                    setTimeout(fn, 1);
                } else {
                    document.addEventListener("DOMContentLoaded", fn);
                }
            }


            docReady(function() {

                const cart_total = document.querySelector('.cart-subtotal > td').getAttribute('data-cart-total')
                const max_reduct = parseInt(cart_total / 3)
                const use_point_reduct = document.querySelector('#point_reduct')
                const user_points = parseInt(document.querySelector('#point_reduct').getAttribute('data-all-point'))
                const reduct_input = document.querySelector('#gamipress-wc-partial-payments-points-yf_reward')
                const apply_discount = document.querySelector('#gamipress-wc-partial-payments-button')

                if (localStorage.getItem('point_reduct') === 'checked') {
                    point_reduct.checked = true
                } else {
                    point_reduct.checked = false
                }

                use_point_reduct.addEventListener('change', function() {
                    if (use_point_reduct.checked) {
                        //checked
                        localStorage.setItem('point_reduct', 'checked');
                        if (max_reduct > user_points) {
                            //use all
                            reduct_input.value = user_points
                            apply_discount.click()
                        } else {
                            //use max_reduct
                            reduct_input.value = max_reduct
                            apply_discount.click()
                        }
                    } else {
                        //unchecked
                        localStorage.setItem('point_reduct', 'unchecked');
                        document.querySelector('.gamipress-wc-partial-payments-remove').click()
                    }
                })

            });
        })()
    </script>

<?php
}
