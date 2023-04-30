<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('col-6 col-md-4 mb-2 '); ?> id="post-<?php the_ID(); ?>">


    <div class="card card-product">
        <figure class="card-image">
            <a title="<?= get_the_title(); ?>" href="<?= get_the_permalink(); ?>">
                <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>
            </a>
        </figure>
        <div class="card-footer">
            <a title="<?= get_the_title(); ?>" href="<?= get_the_permalink(); ?>">
                <h2 class="card-title"><?= get_the_title(); ?></h2>
            </a>
            <!-- <span class="brand">Armani</span> -->

            <span><?php echo date('Y/m/d', get_post_time('U')); ?></span>
        </div>
    </div>

</article><!-- #post-## -->