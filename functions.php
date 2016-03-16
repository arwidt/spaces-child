<?php
/*
 * This is the child theme's functions.php file.
 * This file loads before the parent theme's functions.php file.
 * When adding new functions to your theme, add them here - instead of modifying the parent theme's core files.
 *
 *
 * THEME FEATURES FILTER:
 * Use the bean_feature_setup() function below to activate various
 * forms of functionality throughout the theme. For instance, setting 
 * the "updates" value to "false" will deactivate the framework's update
 * notification and install functionality. Be careful though, some of these
 * are neccesary for the performance of the theme. Have fun!
 */


/*===================================================================*/
/* 1. ENQUEUE PARENT THEME STYLES
/*===================================================================*/
function bean_enqueue_child_scripts() 
{
    wp_enqueue_style( 'parent', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'parent-mobile', get_template_directory_uri() . '/assets/css/mobile.css' );
}
add_action( 'wp_enqueue_scripts', 'bean_enqueue_child_scripts' );