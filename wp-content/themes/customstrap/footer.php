<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<!-- footer -->
<footer class="bg-white text-dark" style="border-top: 1px solid #666666;padding-bottom:8rem;">
    <div class="container">
        <div class="row justify-content-md-between gutter-2">

            <!-- menu -->
            <div class="order-1 col-md-8 col-lg-8">
                <div class="row">
                    <div class="col-md col-6 mb-3">
                        <h4 class="eyebrow mb-2">關於我們</h4>
                        <ul class="menu-list">
                            <li class="menu-list-item"><a href="<?= site_url('brand-story') ?>" class="menu-list-link">品牌故事</a></li>
                            <li class="menu-list-item"><a href="<?= site_url('brand-story') ?>" class="menu-list-link">FIWI天然植萃系列</a></li>
                            <li class="menu-list-item"><a href="<?= site_url('privacy') ?>" class="menu-list-link">隱私權及網站使用條款</a></li>

                        </ul>
                    </div>
                    <div class="col-md col-6 mb-3">
                        <h4 class="eyebrow mb-2">購物說明</h4>
                        <ul class="menu-list">
                            <li class="menu-list-item"><a href="<?= site_url('payment') ?>" class="menu-list-link">付款方式</a></li>
                            <li class="menu-list-item"><a href="<?= site_url('shipping') ?>" class="menu-list-link">運送方式</a></li>
                            <li class="menu-list-item"><a href="<?= site_url('refund') ?>" class="menu-list-link">退換貨方式</a></li>
                        </ul>
                    </div>
                    <div class="col-md col-6 mb-3">
                        <h4 class="eyebrow mb-2">客服資訊</h4>
                        <ul class="menu-list">
                            <li class="menu-list-item"><a href="<?= site_url('qa') ?>" class="menu-list-link">常見問題</a></li>
                            <li class="menu-list-item"><a href="<?= site_url('membership') ?>" class="menu-list-link">會員權益聲明</a></li>
                            <li class="menu-list-item"><a href="<?= site_url('contact') ?>" class="menu-list-link">聯絡我們</a></li>
                        </ul>
                    </div>
                    <div class="col-md col-6 mb-3">
                        <h4 class="eyebrow mb-2">You’re Flower</h4>
                        <ul class="menu-list">

                            <li class="menu-list-item"><a href="" class="menu-list-link">荷鑫企業社</a></li>
                            <li class="menu-list-item"><a href="" class="menu-list-link">0905-303-001</a></li>
                            <li class="menu-list-item"><a href="" class="menu-list-link">b0905303001@icloud.com</a></li>
                            <li class="menu-list-item"><a href="" class="menu-list-link">聯繫時間：1200-2400</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- settings -->
            <div class="order-3 order-md-2 order-lg-3 col-md-4 col-lg-4">
                <div class="fb-page" data-href="https://www.facebook.com/flower1031shop" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/flower1031shop" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/flower1031shop">Flower1031shop水晶</a></blockquote>
                </div>

                <div class="w-100 mt-2">
                    <a class="mx-1" href="https://lin.ee/xkIpEdc" target="_blank"><img src="<?php echo IMG_URL; ?>/line_icon.png" alt=""></a>
                    <a class="mx-1" href="https://www.instagram.com/youreflower1031shop/" target="_blank"><img src="<?php echo IMG_URL; ?>/ig_icon.png" alt=""></a>
                    <a class="mx-1" href="https://www.facebook.com/flower1031shop" target="_blank"><img src="<?php echo IMG_URL; ?>/fb_icon.png" alt=""></a>

                </div>
            </div>
        </div>
    </div>

</footer>



<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/vendor.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/app.js?v=1.2"></script>


<style>
    .login-modal {
        display: none;
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0px;
        left: 0px;
        z-index: 9999;
    }
</style>
<div class="login-modal">
    <div class="w-100 h-100 d-flex align-items-center justify-content-center close-login-modal">
        <?php
        echo do_shortcode('[woocommerce_my_account]');
        ?>
    </div>
</div>

<script>
    (function($) {
        $('.unlogin .wpfp-link').click(function(e) {
            e.preventDefault;
            $('.unlogin .login-modal').fadeIn();
        });
        $('.unlogin .close-login-modal').click(function(e) {
            if (e.target === this) $('.unlogin .login-modal').fadeOut(function() {
                $('.unlogin .wpfp-span > .icon-heart').click(function(){
                    $('.unlogin .login-modal').fadeIn();
                });
            });
        });

    })(jQuery)
</script>


</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>