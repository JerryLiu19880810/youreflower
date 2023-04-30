<?php

/**
 * Search results partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>


<article <?php post_class('col-6 col-lg-3'); ?> id="post-<?php the_ID(); ?>">
    <a href="<?= get_the_permalink(); ?>">
        <figure class="category category--alt">
            <div class="equal"><span class="image" style="background-image: url(<?= get_the_post_thumbnail_url(); ?>)"></span></div>
            <figcaption><?= get_the_title(); ?></figcaption>
        </figure>
    </a>
</article>