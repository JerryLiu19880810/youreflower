<?php

add_action( 'admin_head', 'remove_feature_image_page_metabox', 200 );
function remove_feature_image_page_metabox() {
    remove_meta_box( 'postimagediv' , 'page' , 'side' );
}



add_action( 'save_post', 'update_bannerImg_to_featureImage', 200);
function update_bannerImg_to_featureImage(){
    if( get_post_type() !== 'page' ) return;

}


function remove_pages_editor(){

    if($_GET['action'] != 'edit') return;
    $hide_editor_post_id = ['290', '244', '282'];

    if(in_array($_GET['post'], $hide_editor_post_id)){
        remove_post_type_support( 'page', 'editor' );
    }


}
add_action( 'admin_init', 'remove_pages_editor' );


add_action( 'wp_insert_post', 'save_to_page_feature_img', 200,3 );

function save_to_page_feature_img($post_id, $post, $update){
    // Only set for post_type = post!
    if ( 'page' !== $post->post_type || $post_id == 244 ) {
        return;
    }
    $banner_id = rwmb_meta('banner_image')['ID'];
    update_post_meta($post_id, '_thumbnail_id', $banner_id);

    $post->post_content = get_post_meta($post_id, 'house_content', true);
}