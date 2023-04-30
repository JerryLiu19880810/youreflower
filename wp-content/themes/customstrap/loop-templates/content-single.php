<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$word_count = mb_strlen(strip_tags(get_the_content()));
$mins_to_read = ceil($word_count / 250);

?>

<article <?php post_class('mt-5'); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

        <p class="mt-4r mb-1r h6"><?php echo date('Y/m/d', get_post_time('U')); ?> ‧ <?php echo $mins_to_read; ?> min read</p>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

    <hr/>

	<div class="entry-content mt-5">

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
