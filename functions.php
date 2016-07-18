<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Middlebury Website Redesign', 'midd-redesign' ) );
define( 'CHILD_THEME_URL', 'http://github.com/middlebury/genesis-child-theme-boilerplate/' );
define( 'CHILD_THEME_VERSION', '0.1.0' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Move child theme stylesheet to the end of the line so it takes precedence over plugin stylesheets.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 999 );

//* Add support for structural wraps (max-width has been added to most content-entry elements to allow for full-width images on any page or post. If you don't need full-width images, you can add structural wrap in site-inner.)
add_theme_support( 'genesis-structural-wraps', array(
    'header',
    'nav',
    // 'subnav',
    // 'site-inner',
    'footer-widgets',
    'footer'
) );

add_action('wp_enqueue_scripts', 'rdsn_enqueue');
function rdsn_enqueue() {
  wp_enqueue_style( 'cci-fonts', 'https://cloud.typography.com/83898/706148/css/fonts.css', array(), CHILD_THEME_VERSION );
}

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
