<?php


if ($favorite_post_ids) {
    $favorite_post_ids = array_reverse($favorite_post_ids);
    $post_per_page = wpfp_get_option("post_per_page");
    $page = intval(get_query_var('paged'));

    $qry = array(
        'post_type' => 'product',
        'post__in' => $favorite_post_ids,
        'posts_per_page'=> $post_per_page,
        //'posts_per_page' => 2,
        'orderby' => 'post__in',
        'paged' => $page,
    );
    // custom post type support can easily be added with a line of code like below.
    // $qry['post_type'] = array('post','page');
    /* echo '<pre>';
        var_dump($qry);
        echo '</pre>'; */

    query_posts($qry);
    echo '<div class="col-12 wpfp_clear_list_link px-0 mb-3">';
    wpfp_clear_list_link();
    echo '</div>';
    echo "<div class='row'>";

    while (have_posts()) : the_post();
        wc_get_template_part('content', 'product');
    endwhile;
    echo "</div>";

    echo '<div class="navigation text-center">';
    $args = array(
        'class'               => '',
    );
    the_posts_pagination($args);

    echo '</div>';

    wp_reset_query();
} else {
    $wpfp_options = wpfp_get_options();
    echo '<ul class="mt-3"><li>';
    echo $wpfp_options['favorites_empty'];
    echo '</li></ul>';
}




echo "</div>";
wpfp_cookie_warning();

?>