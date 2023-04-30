<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

?>

<section class="pt-6">
    <div class="container">
        <div class="row gutter-1 align-items-end">
            <div class="col-md-6">
                <p class="h1"><?= get_the_archive_title(); ?></p>
            </div>


        </div>




        <!-- products -->
        <div class="row gutter-1">
            <!-- sidebar -->
            <aside class="col-lg-3 sidebar">
                <div class="widget">
                    <span class="widget-title">文章分類</span>
                    <?php
                    $args = [
                        'show_count' => true,
                        'title_li' => ''
                    ];
                    wp_list_categories($args);

                    ?>

                </div>

            </aside>

            <div class="col-lg-9 pl-lg-5">
                <div class="row">

                <?php
                if ( have_posts() ) {
					// Start the loop.
					while ( have_posts() ) {
						the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content' );
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>





                  <?php understrap_pagination(); ?>

                </div>
            </div>
        </div>


    </div>
</section>

<?php
get_footer();
