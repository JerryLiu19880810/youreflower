<?php

function customstrap_sharing_buttons(){
	global $post;
	$url_to_share=esc_attr(get_permalink($post->ID));
	return '
		<div class="cs-sharing-buttons my-4" >
		
			<!-- Basic Share Links -->
			<span>Share: </span>
		
			<!-- Facebook (url) -->
			<a class="btn btn-sm btn-facebook" href="https://www.facebook.com/sharer.php?u='.$url_to_share .'" target="_blank" rel="nofollow">
				<i class="fa fa-facebook"></i><span class="d-none d-md-inline"> Facebook</span>
			</a>
			
			<!-- Whatsapp (url) -->
			<a class="btn btn-sm btn-whatsapp" href="https://api.whatsapp.com/send?text='.$url_to_share .'" target="_blank" rel="nofollow">
				<i class="fa fa-whatsapp"></i><span class="d-none d-md-inline"> Whatsapp</span>
			</a>
			
				<!-- Whatsapp (url) -->
			<a class="btn btn-sm btn-telegram" href="https://telegram.me/share/url?url='.$url_to_share .'&text=" target="_blank" rel="nofollow">
				<i class="fa fa-telegram"></i><span class="d-none d-md-inline"> Telegram</span>
			</a>
			
			
			<!-- Twitter (url, text, @mention) -->
			<a class="btn btn-sm btn-twitter" href="https://twitter.com/share?url='.$url_to_share .'&amp;text='.esc_attr(get_the_title()) .'via=@HANDLE" target="_blank" rel="nofollow">
				<i class="fa fa-twitter"></i><span class="d-none d-md-inline"> Twitter</span>
			</a>
		
		
			<!-- Email (subject, body) -->
			<a class="btn btn-sm btn-email" href="mailto:?subject='.esc_attr(get_the_title()) .'&amp;body='.$url_to_share .'" target="_blank" rel="nofollow">
				<i class="fa fa-envelope"></i><span class="d-none d-md-inline"> Email</span>
			</a>
		
		</div>
	';
} //end function



//ADD TO THE CONTENT
add_filter('the_content',function($content) {
	if (is_single() && get_theme_mod("enable_sharing_buttons") )  return $content.customstrap_sharing_buttons();
	return $content;
});