<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$title = get_the_title();
$banner = rwmb_meta('banner_image')["full_url"] ?? IMG_URL . '/brand-story.jpg';
$banner_rwd = rwmb_meta('banner_image_rwd')["full_url"] ?? $banner;
$qas = rwmb_meta('qa');
?>



    <!-- hero -->
<section style="padding:0rem;position:relative;">
    <img rwd_src="<?= $banner_rwd; ?>" src="<?= $banner; ?>" class="w-100 rwd_img banner_bg">
    <div class="w-100" style="position:absolute;top:50%;">
        <div class="container">
            <h1 class="text-center" style="margin-top:-0.75em;"><?= $title ?></h1>
        </div>
    </div>
</section>
<!--
<section class="py-0 no-overflow vh-75 d-flex align-items-center" style="background-image:url(<?= $bg_img; ?>);background-size: cover;background-position: center;background-repeat:no-repeat;background-attachment: fixed;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 align-self-center text-dark text-center">
                <h1 class="text-uppercase"><?= $title; ?></h1>
            </div>
        </div>
    </div>
</section> -->

<!-- article -->
<article>
    <div class="container" style="padding:3.5rem 0rem 9.25rem 0rem;">
        <div class="row justify-content-center">

            <!-- post -->
            <div class="col-lg-12" style="margin-bottom:5.5rem;">
                <div class="yc_quote">
                    <h2 class="text-uppercase h1 text-secondary font-weight-bold mb-1">FAQ 購物常見問題</h2>
                    <p class="text-dark">賣場的常見問題一次讓您了解，如無法接受，請勿下單購買!</p>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="accordion accordion-qa" id="accordionQA">
                    <?php foreach ($qas as $key => $qa) :
$question = $qa['question'];
$answer = $qa['answer'];
$expanded = $key == 0 ? 'true' : 'false';
$collapsed = $key == 0 ? '' : 'collapsed';
$show = $key == 0 ? 'show' : '';
                        ?>
<div class="card">
                        <div class="card-header" id="heading-<?= $key+1; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left <?= $collapsed; ?>" type="button" data-toggle="collapse" data-target="#collapse<?= $key+1; ?>" aria-expanded="<?= $expanded; ?>" aria-controls="collapse<?= $key+1; ?>">
                                <?= $question; ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapse<?= $key+1; ?>" class="collapse <?= $show; ?>" aria-labelledby="heading<?= $key+1; ?>" data-parent="#accordionQA">
                            <div class="card-body">
                            <?= $answer; ?>
                            </div>
                        </div>
                    </div>
                        <?php endforeach; ?>
                </div>
            </div>


        </div>
    </div>
</article>



<?php
get_footer();
