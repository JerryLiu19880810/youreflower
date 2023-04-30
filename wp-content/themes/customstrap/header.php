<?php

/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
// USEFUL LINKS
// https://medium.com/wdstack/bootstrap-4-custom-navbar-1f6a2da5ed3c
// https://medium.com/coder-grrl/the-guide-to-customising-the-bootstrap-4-navbar-i-wish-id-had-6-months-ago-7bc6ce0e3c71

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}



$header_class = empty($args['header_class']) ? '' : $args['header_class'];
//跑馬燈資料
$topnav = [];
for ($i = 1; $i < 4; $i++) {
    array_push($topnav, rwmb_meta('nav_' . $i, ['object_type' => 'setting'], 'topnavv'));
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/vendor.css?v=<?= YC_VER ?>" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/style.css?v=<?= YC_VER ?>" />

    <style>
        .owl-carousel i {
            margin-right: 0.25rem;
        }
    </style>
</head>

<body <?php body_class(); ?>>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v13.0&appId=1208359726661104&autoLogAppEvents=1" nonce="pdEP80LP"></script>
    <?php do_action('wp_body_open'); ?>

    <div class="site" id="page">


        <!-- header -->
        <header class="header <?php echo $header_class; ?>">
            <div class="py-1 bg-primary">
                <div class="container">
                    <div class="row">
                        <div class="col d-none d-md-flex justify-content-around">
                        <?php foreach ($topnav as $nav) :
                            $nav['link'] = empty($nav['link']) ? '' : 'href="' . $nav['link'] . '"';
                            ?>
                                        <a <?= $nav['link'] ?> class="d-block fs-14 text-uppercase text-center text-dark m-0">
                                        <?= $nav['icon'] . ' ' . $nav['text'] ?>
                                        </a>
                                <?php endforeach; ?>
                        </div>
                        <div class="col d-md-none">
                            <div class="owl-carousel owl-carousel-promo" data-loop="true" data-items="[3,3,2,1]" data-margin="10" data-nav="true">

                            <?php foreach ($topnav as $nav) :
                            $nav['link'] = empty($nav['link']) ? '' : 'href="' . $nav['link'] . '"';
                            ?>
                                        <a <?= $nav['link'] ?> class="d-block fs-14 text-uppercase text-center text-dark m-0">
                                        <?= $nav['icon'] . ' ' . $nav['text'] ?>
                                        </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid header-p">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="<?php echo site_url(); ?>" class="navbar-brand order-1 order-lg-1 yc_logo"><img src="<?php echo IMG_URL; ?>/logo.jpg" alt="Logo"></a>

                    <div class="collapse navbar-collapse order-4 order-lg-2" id="navbarMenu">
                        <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown dropdown-sm dropdown-hover d-lg-none">
                                <a class="nav-link" target="_blank" href="https://www.instagram.com/youreflower1031shop/">
                                    instagram
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover d-lg-none">
                                <a class="nav-link" target="_blank" href="https://www.facebook.com/flower1031shop">
                                    facebook
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover d-lg-none">
                                <a class="nav-link" target="_blank" href="https://line.me/R/ti/p/@562usbkn">
                                    Line專人服務
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover">
                                <a class="nav-link" href="<?php echo site_url('brand-story'); ?>">
                                    品牌故事
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover">
                                <a class="nav-link" href="<?php echo site_url('news'); ?>">
                                    最新消息
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover">
                                <a class="nav-link" href="<?= get_term_link('fiwi', 'product_cat') ?>">
                                    FIWI天然植萃系列
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover">
                                <a class="nav-link" href="<?php echo site_url('shop'); ?>">
                                    商品分類
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover">
                                <a class="nav-link" href="<?php echo site_url(); ?>/qa">
                                    常見問題
                                </a>
                            </li>
                            <li class="nav-item dropdown dropdown-sm dropdown-hover">
                                <a class="nav-link" href="<?php echo site_url(); ?>/contact">
                                    聯絡我們
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="collapse navbar-collapse order-5 order-lg-3" id="navbarMenu2">
                        <ul class="navbar-nav ml-auto position-relative">

                            <!-- search -->
                            <li class="nav-item dropdown dropdown-md dropdown-hover d-none d-lg-block">
                                <a class="nav-icon dropdown-toggle" id="navbarDropdown-4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-search d-none d-lg-inline-block"></i>
                                    <span class="d-inline-block d-lg-none">Search</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown-4">
                                    <div class="form-group">
                                        <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                            <input type="text" class="form-control" id="searchForm" placeholder="Search" name="s">
                                        </form>
                                    </div>
                                </div>
                            </li>

                            <!-- localisation -->
                            <!-- <li class="d-none d-lg-inline nav-item dropdown dropdown-md dropdown-hover">
                <a class="nav-icon" id="navbarDropdown-5" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-globe"></i></a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown-5">
                  <fieldset>
                    <div class="row">
                      <div class="col-12">
                        <div class="select-frame">
                          <select class="custom-select custom-select-lg" id="countrySelect1">
                            <option value="1">United States</option>
                            <option value="2">Germany</option>
                            <option value="3">France</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="select-frame">
                          <select class="custom-select custom-select-lg" id="curencySelect1">
                            <option value="1">USD</option>
                            <option value="2">EUR</option>
                            <option value="3">RUB</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </li> -->

                            <!-- user area -->
                            <?php if (!is_user_logged_in()) : ?>
                                <li class="nav-item dropdown dropdown-md dropdown-hover d-none d-lg-block">
                                    <a class="nav-icon dropdown-toggle" id="navbarDropdown-6" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-user"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-6">
                                        <div class="row gutter-2">
                                            <div class="col-12 yc-login-form">
                                                <div class="form-label-group">
                                                    <?php
                                                    $args = array(
                                                        'label_username' => '',
                                                        'label_password' => '',
                                                        'label_remember' => '',
                                                        'remember' => false,
                                                    );
                                                    wp_login_form($args);

                                                    ?>
                                                    <div class="w-100 mt-1">
                                                        <?= do_shortcode('[woo_social_login]'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item d-lg-none">
                                    <a class="nav-link" href="<?php echo site_url('my-account'); ?>">
                                        會員中心
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="nav-item d-none d-lg-block">
                                    <a class="nav-icon" href="<?php echo site_url('my-account'); ?>">
                                        <?php
                                        $user_id = get_current_user_id();
                                        $user_member_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
                                        $user_member_lv_img = (empty($user_member_lv)) ? '<i class="icon-user"></i>' : ('<span style="background-color:#fafafa;padding:10px;border-radius:100%;width:30px;height:30px;"><img width="20" height="20" src="' . get_the_post_thumbnail_url($user_member_lv) . '" style="" /></span>');
                                        $user_points = gamipress_get_user_points($user_id, 'yf_reward');
                                        $user_points_img = '<img width="21" height="21" src="' . get_the_post_thumbnail_url(701) . '" style="margin-top:-3px;margin-left:8px;" />';

                                        echo $user_member_lv_img;
                                        ?>

                                    </a>
                                </li>
                                <li class="nav-item d-lg-none order-1">
                                    <a class="nav-link" href="<?php echo site_url('my-account'); ?>">
                                        <p class="text-dark">會員中心 <?= $user_points . $user_points_img ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>


                            <!-- favourites -->
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-icon" href="<?= site_url('collection'); ?>"><i class="icon-heart"></i></a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link" href="<?php echo site_url('collection'); ?>">
                                    我的收藏
                                </a>
                            </li>

                            <?php if (WP_DEBUG) : ?>
                                <li class="d-none d-lg-inline nav-item dropdown dropdown-md dropdown-hover">
                                    <a class="nav-icon" id="navbarDropdown-7" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-heart"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-7">
                                        <div class="row gutter-3">
                                            <div class="col-12">
                                                <h3 class="eyebrow text-dark fs-16 mb-1">My Favorites</h3>
                                                <p class="text-muted fs-14"><a href="" class="underline">Sign in</a> to keep your saves for up to 60 days.</p>
                                            </div>

                                            <?php
                                            $user = wp_get_current_user()->user_login;
                                            $favorite_post_ids = wpfp_get_users_favorites($user);
                                            $qry = array(
                                                'post_type' => 'product',
                                                'post__in' => $favorite_post_ids,
                                                'posts_per_page' => 3,
                                                'orderby' => 'post__in',
                                            );
                                            $loop = new WP_Query($qry);
                                            while ($loop->have_posts()) : $loop->the_post();
                                                $product = wc_get_product(get_the_ID());

                                                //var_dump();
                                            ?>
                                                <div class="col-12">
                                                    <div class="cart-item">
                                                        <a href="<?= get_the_permalink(); ?>" class="cart-item-image">
                                                            <img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()))[0]; ?>" alt="<?= get_the_title(); ?>" title="<?= get_the_title(); ?>">
                                                        </a>
                                                        <div class="cart-item-body">
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <h5 class="cart-item-title"><?= get_the_title(); ?></h5>

                                                                    <?php echo $product->get_price_html(); ?>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <ul class="cart-item-options">
                                                                        <li><a href="?wpfpaction=remove&amp;postid=<?= get_the_ID(); ?>" class="icon-x wpfp-link"></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            endwhile;
                                            wp_reset_query();
                                            ?>
                                            <div class="col-12">
                                                <a href="" class="btn btn-primary btn-block">Add all to cart</a>
                                                <a href="" class="btn btn-outline-secondary btn-block">View favorites</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>

                            <!-- cart -->
                            <li class="nav-item dropdown dropdown-md dropdown-hover d-none d-lg-block">
                                <a class="nav-icon fly-cart-btn">
                                    <i class="icon-shopping-bag"></i>
                                </a>
                            </li>

                            <?php if (is_user_logged_in()) : ?>
                                <li class="nav-item d-none d-lg-block">
                                    <a title="購物金" class="nav-icon" href="<?= site_url('my-account'); ?>">
                                        <p class="text-dark"><?= $user_points . $user_points_img ?></p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <!-- <li class="nav-item dropdown dropdown-md dropdown-hover">
                                <a class="nav-icon dropdown-toggle" id="navbarDropdown-8" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-shopping-bag d-none d-lg-inline-block"></i>
                                    <span class="d-inline-block d-lg-none">Bag</span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown-8">
                                    <div class="row gutter-3">
                                        <div class="col-12">
                                            <h3 class="eyebrow text-dark fs-16 mb-0">My Bag</h3>
                                        </div>
                                        <div class="col-12">
                                            <div class="cart-item">
                                                <a href="#!" class="cart-item-image"><img src="https://demo.htmlhunters.com/shopy/assets/images/demo/product-1.jpg" alt="Image"></a>
                                                <div class="cart-item-body">
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <h5 class="cart-item-title">Bold Cuff Insert Polo Shirt</h5>
                                                            <small>Fred Perry</small>
                                                            <ul class="list list--horizontal fs-14">
                                                                <li><s>$85.00</s></li>
                                                                <li class="text-red">$42.00</li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-3 text-right">
                                                            <ul class="cart-item-options">
                                                                <li><a href="" class="icon-x"></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <ul class="list-group list-group-minimal">
                                                <li class="list-group-item d-flex justify-content-between align-items-center text-uppercase font-weight-bold">
                                                    Subtotal
                                                    <span>$78.00</span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <a href="" class="btn btn-primary btn-block">Add all to cart</a>
                                            <a href="" class="btn btn-outline-secondary btn-block">View favorites</a>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                        </ul>
                    </div>

                    <div class="order-2 d-flex d-lg-none" id="navbarMenuMobile">
                        <ul class="navbar-nav navbar-nav--icons ml-auto position-relative">

                            <!-- search -->
                            <li class="nav-item dropdown dropdown-md dropdown-hover d-lg-block">
                                <a class="nav-icon dropdown-toggle nav-icon-search" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-search d-inline-block"></i>
                                </a>
                                <div class="dropdown-menu search-dropdown-menu" aria-labelledby="navbarDropdown-4">
                                    <div class="form-group">
                                        <form class="mb-0" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                                            <input type="text" class="form-control" id="searchForm" placeholder="Search" name="s">
                                        </form>
                                    </div>
                                </div>
                            </li>

                            <?php
                            if (is_user_logged_in()) :
                                $user_id = get_current_user_id();
                                $user_member_lv = get_user_meta($user_id, '_gamipress_member_lv_rank', true);
                                $user_member_lv_img = (empty($user_member_lv)) ? '<i class="icon-user"></i>' : ('<span style="background-color:#fafafa;padding:10px;border-radius:100%;width:30px;height:30px;"><img width="20" height="20" src="' . get_the_post_thumbnail_url($user_member_lv) . '" style="" /></span>');
                            ?>
                                <li class="nav-item d-lg-none">
                                    <a class="nav-icon" href="<?php echo site_url('my-account'); ?>">
                                        <?= $user_member_lv_img ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <!-- cart -->
                            <li class="nav-item">
                                <a href="" class="nav-icon fly-cart-btn"><i class="icon-shopping-bag"></i></a>
                            </li>

                            <!-- menu -->
                            <li class="nav-item dropdown dropdown-md dropdown-hover">
                                <a href="" class="nav-icon" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>

                        </ul>
                    </div>

                </nav>
            </div>
        </header>

        <?php do_action('yc_after_header'); ?>