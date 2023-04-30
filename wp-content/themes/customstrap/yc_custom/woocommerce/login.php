<?php

function yc_login_form_middle($args){
    $html = '<p class="text-center"><a class="hover:black hover:underline" href="' . wc_lostpassword_url() . '">忘記密碼</a></p>';
    return $html;
}
add_filter( 'login_form_middle', 'yc_login_form_middle' );


function yc_login_form_bottom($args){
    $html = '<p class="text-center"><a href="' . site_url() . '/register" class="btn btn-outline-secondary btn-block">創建帳號</a></p>';
    return $html;
}
add_filter( 'login_form_bottom', 'yc_login_form_bottom' );



add_action( 'woocommerce_after_customer_login_form', 'login_script', 10 );
function login_script(){
?>
<script>
    const h2 = document.createElement('h2');
    h2.textContent = '用社群帳號登入';
    h2.classList.add('yc_login_form_title');
    const parent = document.querySelector('.yc_login_form .woo-slg-social-container');
    parent.insertBefore(h2, parent.firstChild);
    //document.querySelector('.woo-slg-social-container').insertBefore(html);

</script>
<?php
}