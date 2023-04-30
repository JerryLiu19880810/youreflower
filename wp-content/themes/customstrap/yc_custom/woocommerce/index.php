<?php

$all_include = glob( get_stylesheet_directory() . '/yc_custom/woocommerce/*.php');
unset($all_include['index.php']);

foreach ( $all_include as $filename)
{
    include_once $filename;
}



foreach (glob( get_stylesheet_directory() . '/yc_custom/woocommerce/components/*.php') as $filename)
{
    include_once $filename;
}