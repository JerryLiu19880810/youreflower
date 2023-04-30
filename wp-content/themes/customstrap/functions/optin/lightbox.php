<?php
 

//////// GLIGHTBOX - Enables lightbox on all <a class="lightbox" ////////////////////////////////////////////////////

//enqueue js in footer
add_action( 'wp_enqueue_scripts', function() {  	wp_enqueue_script( 'glightbox',  "https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js", array(), false, true );} ,100);

//enqueue css in footer
add_action( 'get_footer', function(){	wp_enqueue_style( 'glightbox', "https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css", array(), false, 'all');},10);

add_action( 'wp_footer', function(){ ?>
<script>
	jQuery( document ).ready(function() {
		jQuery("main#main a img").parent().addClass("glightbox");
		const lightbox = GLightbox({});
	});
</script>
<?php },100 );

//////////////////////////////////////////////////////////////////////
