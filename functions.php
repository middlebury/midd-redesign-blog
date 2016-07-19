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
    // 'nav',
    // 'subnav',
    'site-inner',
    'footer-widgets',
    'footer'
) );

add_action('wp_enqueue_scripts', 'rdsn_enqueue_scripts_styles');
function rdsn_enqueue_scripts_styles() {
  wp_enqueue_style( 'rdsn-fonts', 'https://cloud.typography.com/83898/706148/css/fonts.css', array(), CHILD_THEME_VERSION );
  wp_enqueue_script( 'rdsn-main-script', get_stylesheet_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true );
}

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

//* Force sidebar-content layout
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content' );

//* Remove content/sidebar layout
genesis_unregister_layout( 'content-sidebar' );

//* Remove sidebar/content layout
// genesis_unregister_layout( 'sidebar-content' );

//* Remove content/sidebar/sidebar layout
genesis_unregister_layout( 'content-sidebar-sidebar' );

//* Remove sidebar/sidebar/content layout
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Remove sidebar/content/sidebar layout
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Remove full-width content layout
genesis_unregister_layout( 'full-width-content' );

//* Reorder post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Customize the post meta function
add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
function sp_post_meta_filter( $post_meta ) {
  if ( !is_page() ) {
  	$post_meta = '[post_tags before="<strong>Tags:</strong> "]';
  	return $post_meta;
  }
}

add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter( $post_info ) {
  if ( !is_page() ) {
  	$post_info = '[post_date]<br>[post_categories before="<strong>Categories:</strong> "]';
  	return $post_info;
  }
}

add_filter( 'genesis_post_title_output', 'rdsn_post_title_output', 15 );
function rdsn_post_title_output( $title ) {
  if ( !is_page() ) {
    $author_link = do_shortcode('[post_author_posts_link before="<span class=\'entry-author-by\'>by</span> "]');
    return $title . $author_link;
  }

  return $title;
}


//* Customize previous link in pagination
add_filter( 'genesis_prev_link_text', 'cci_prev_link_text' );
function cci_prev_link_text() {
  $prevlink = 'Previous';
  return $prevlink;
}

//* Customize next link in pagination
add_filter( 'genesis_next_link_text', 'cci_next_link_text' );
function cci_next_link_text() {
  $nextlink = 'Next';
  return $nextlink;
}
