<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>
<style>
    input.search-field{
        border: 1px solid #e5e5e5 !important;
        padding: 0.5rem 1rem !important;
    }
</style>

<section class="no-results not-found">

	<header class="page-header">

		<h1 class="page-title">OOPS...搜尋不到結果</h1>
        <p class="mb-3">請再搜尋一次</p>

	</header><!-- .page-header -->

	<div class="page-content">

		<?php
		get_search_form();
		?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
