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

//* Enqueue scripts and styles
add_action('wp_enqueue_scripts', 'rdsn_enqueue_scripts_styles');
function rdsn_enqueue_scripts_styles() {
  wp_enqueue_style( 'rdsn-fonts', 'https://cloud.typography.com/83898/706148/css/fonts.css', array(), CHILD_THEME_VERSION );
  wp_enqueue_script( 'rdsn-main-script', get_stylesheet_directory_uri() . '/js/main.js', array(), '1.0.0', true );
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
add_filter( 'genesis_post_meta', 'rdsn_post_meta_filter' );
function rdsn_post_meta_filter( $post_meta ) {

  $categories = do_shortcode( '[post_categories before="<strong>Categories:</strong> "]' );
  $tags = '[post_tags before="<strong>Tags:</strong> "]';

  if ( !is_page() && !is_single() ) {
    $post_meta = $tags;
    return $post_meta;
  }

  if ( is_single() ) {
    $post_meta = $categories . '<br>' . $tags;
    return $post_meta;
  }

}

//* Combine post date with post categories
add_filter( 'genesis_post_info', 'rdsn_post_info_filter' );
function rdsn_post_info_filter( $post_info ) {
  if ( !is_page() && !is_single() ) {
  	$post_info = '[post_date]<br>[post_categories before="<strong>Categories:</strong> "]';
  	return $post_info;
  }
}

//* On single posts, show byline and date together. On lists of posts, show date and categories before title
add_filter( 'genesis_post_title_output', 'rdsn_post_title_output', 15 );
function rdsn_post_title_output( $title ) {

  $author_link = do_shortcode('[post_author_posts_link before="<span class=\'entry-author-by\'>by</span> "]');
  $post_date = do_shortcode('[post_date]');

  if ( !is_page() && is_single() ) {
    return $title . $post_date . $author_link;
  }

  if ( !is_page() ) {
    return $title . $author_link;
  }

  return $title;
}


//* Customize previous link in pagination
add_filter( 'genesis_prev_link_text', 'rdsn_prev_link_text' );
function rdsn_prev_link_text( $text ) {
  $text = 'Previous';
  return $text;
}

//* Customize next link in pagination
add_filter( 'genesis_next_link_text', 'rdsn_next_link_text' );
function rdsn_next_link_text( $text ) {
  $text = 'Next';
  return $text;
}

//* Force h1 site title element on all pages
add_filter( 'genesis_site_title_wrap', 'rdsn_h1_for_site_title' );
function rdsn_h1_for_site_title( $wrap ) {
  return 'h1';
}

//* Insert rdsn-footer widget area into site-footer
add_action( 'widgets_init', 'rdsn_footer_widgets_init' );
function rdsn_footer_widgets_init() {
  genesis_register_sidebar( array(
    'id' => 'rdsn-footer',
    'name' => __( 'Footer', 'rdsn' ),
    'description' => __( 'Widgets in this area will be shown in the site footer.', 'rdsn' ),
  ) );
}

//* Hook after post widget area after post content
add_action( 'genesis_footer', 'rdsn_footer_widget' );
function rdsn_footer_widget() {
	genesis_widget_area( 'rdsn-footer', array(
		'before' => '<div class="footer-widgets widget-area">',
		'after' => '</div>',
  ) );
}

//* Remove footer copyright line
remove_action( 'genesis_footer', 'genesis_do_footer' );

//* Customize next/previous links for pages
add_action( 'genesis_before_comments', 'rdsn_prev_next_post_nav' );
function rdsn_prev_next_post_nav() {
	if ( is_singular( 'post' ) ) {
		echo '<div class="archive-pagination pagination">';
		previous_post_link( '<div class="pagination-previous">%link</div>', 'Previous' );
		next_post_link( '<div class="pagination-next">%link</div>', 'Next' );
		echo '</div>';
	}
}

// add tag title to tags page
add_action('genesis_before_loop', 'rdsn_tags_title');
function rdsn_tags_title() {

  $title = '';

  if( is_tag() ) {
    $title = 'Tags';
  }

  if( is_category() ) {
    $title = 'Categories';
  }

  if( !empty( $title ) ) {
    echo '<header class="entry-header">';
    echo sprintf('<h1 class="entry-title">%s: %s</h1>', $title, single_tag_title('', FALSE) );
    echo '</header>';
  }
}
