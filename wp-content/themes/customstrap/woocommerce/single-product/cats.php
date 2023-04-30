<?php
if (!defined('ABSPATH')) {
    exit;
}

global $product;
$product_id = $product->get_id();

//分類
$cats = get_the_terms($product_id, 'product_cat');
if(empty($cats)) return;
$cat_show = '';
foreach ($cats as $cat) {
    $cat_show .= '<a class="text-muted" href="' . get_term_link($cat->term_id, 'product_cat') . '">' . $cat->name . '</a>' . '<span>/</span>';
}
?>

<span class="eyebrow text-muted cat_show"><?php echo $cat_show; ?></span>

<?php echo wc_get_product_tag_list($product->get_id(), ', ', '<span class="tagged_as">' . _n('Tag:', 'Tags:', count($product->get_tag_ids()), 'woocommerce') . ' ', '</span>'); ?>