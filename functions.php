<?php

/****************************************************************

    Genesis Basics
    
****************************************************************/

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Overlock Design Co. Blueprint' );
define( 'CHILD_THEME_URL', 'https://overlockdesign.co' );
define( 'CHILD_THEME_VERSION', '1.0.1' );

/****************************************************************

    Enqueue Scripts & Styles
    
****************************************************************/

// Enqueue Scripts & Styles
function odc_enqueue_scripts_styles() {
    
    wp_enqueue_style( 'webfonts', '//fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,700,700i', array(), CHILD_THEME_VERSION );
    wp_enqueue_style( 'font-awesome', '//use.fontawesome.com/releases/v5.0.13/css/all.css', array(), null);
    wp_enqueue_style( 'odc-css', get_stylesheet_directory_uri() . '/main.css', array(), CHILD_THEME_VERSION );
    
    wp_enqueue_script( 'odc-scripts', get_stylesheet_directory_uri() . '/js/min/odc-scripts.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

} add_action( 'wp_enqueue_scripts', 'odc_enqueue_scripts_styles' );

// Detect JS

function detect_JS() { ?>

    <script type="text/javascript">
        jQuery('body').addClass('js');
    </script>
    
<?php } add_action('genesis_before', 'detect_JS', 5);


/****************************************************************

    Supports & Outputs
    
****************************************************************/

// Adds support for HTML5 markup structure.
add_theme_support(
	'html5', array(
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form',
	)
);

// Adds support for accessibility.
add_theme_support(
	'genesis-accessibility', array(
		'404-page',
		'drop-down-menu',
		'rems',
		'search-form',
		'skip-links',
	)
);

// Adds viewport meta tag for mobile browsers.
add_theme_support('genesis-responsive-viewport');

// Add Gutenberg Alignments
function odc_alignments() {
  add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'odc_alignments' );

// Adds custom logo in Customizer > Site Identity.
add_theme_support(
	'custom-logo', array(
		'height'      => 100,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
	)
);

// Displays custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Removes Dual-Sidebar Layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Remove Blog & Archive Page Templates
function odc_remove_page_templates( $templates ) {
	unset( $templates['page_blog.php'] );
	unset( $templates['page_archive.php'] );
	return $templates;
} add_filter( 'theme_page_templates', 'odc_remove_page_templates' );

/****************************************************************

    Navigation
    
****************************************************************/

// Renames primary and secondary navigation menus.
add_theme_support(
	'genesis-menus', array(
		'primary'   => __( 'Header Menu', 'overlock-design' ),
	)
);

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 10 );

function odc_mobile_toggle() { ?>
    <button class="menu-toggle"><i class="fas fa-bars" aria-hidden="true"></i><span class="screen-reader-text">Open Menu</span></button>
<?php } add_action('genesis_header', 'odc_mobile_toggle', 11);

function odc_mobile_container() { ?>
    <div class="mobile-nav">
        <button class="menu-close"><i class="fas fa-times" aria-hidden="true"></i><span class="screen-reader-text">Close Menu</span></button>
    </div> 
<?php } add_action('genesis_after', 'odc_mobile_container');

/****************************************************************

    Widgets
    
****************************************************************/


// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds support for customizable footer widgets.
add_theme_support( 'genesis-footer-widgets', '3' );

// Removes header right widget area.
unregister_sidebar( 'header-right' );

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

genesis_register_sidebar(
    array(
        'id'            => 'top-bar',
        'name'          => __( 'Top Bar' ),
        'description'   => __( 'The top bar widget area.' ),
) );


/****************************************************************

    Structure
    
****************************************************************/

// Add Top Bar Widget Areas
function odc_top_bar() {
    if (is_active_sidebar('top-bar')) : ?>
        <div class="top-bar">
            <div class="wrap">
                    <?php genesis_widget_area('top-bar'); ?>
            </div>
        </div>
    <?php endif;
} add_action('genesis_before_header', 'odc_top_bar');

// Reposition the breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

/****************************************************************

    WooCommerce
    
****************************************************************/

// Declare WooCommerce Support
add_theme_support( 'woocommerce' );

// Enqueue Woo Scripts

function odc_woo_scripts() {
    
    if (class_exists( 'WooCommerce' ) && is_woocommerce()) {
        
        wp_enqueue_script( 'odc-match-height', get_stylesheet_directory_uri() . '/js/min/jquery.matchHeight.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
        wp_enqueue_script( 'odc-woo-scripts', get_stylesheet_directory_uri() . '/js/min/odc-woo-scripts.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
        
        wp_add_inline_script( 'odc-match-height', "jQuery(window).load( function() { jQuery( '.woocommerce-loop-product__link').matchHeight(); });" );
    
    }
    
} add_action('wp_enqueue_scripts', 'odc_woo_scripts');

// Add Product Gallery Fancy Bits
if ( class_exists( 'WooCommerce' ) ) {

	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-zoom' );

}

// Setup Woo Functions
function odc_woo_setup() {
    
    if (class_exists( 'WooCommerce' )) {
        
        if (is_woocommerce() || is_account_page() || is_cart() || is_checkout()) {
            add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
        }
        
    }

} add_action('genesis_meta', 'odc_woo_setup');


/****************************************************************

    Misc.
    
****************************************************************/

// Add Image Sizes
add_image_size( 'featured-image', 850, 0, false );
add_image_size( 'hero-image', 2000, 600, TRUE );

//* Modify breadcrumb arguments.
function odc_breadcrumb_args( $args ) {
    
	$args['home'] = 'Home';
	$args['sep'] = ' &raquo; ';
	$args['list_sep'] = ', '; // Genesis 1.5 and later
	$args['prefix'] = '<div class="breadcrumb wrap">';
	$args['suffix'] = '</div>';
	$args['heirarchial_attachments'] = true; // Genesis 1.5 and later
	$args['heirarchial_categories'] = true; // Genesis 1.5 and later
	$args['display'] = true;
	$args['labels']['prefix'] = '';
	$args['labels']['author'] = '';
	$args['labels']['category'] = ''; // Genesis 1.6 and later
	$args['labels']['tag'] = '';
	$args['labels']['date'] = '';
	$args['labels']['search'] = 'Search Results for ';
	$args['labels']['tax'] = '';
	$args['labels']['post_type'] = '';
	$args['labels']['404'] = 'Not found: '; // Genesis 1.5 and later
    
    return $args;
    
} add_filter( 'genesis_breadcrumb_args', 'odc_breadcrumb_args' );

// Filter Archive Titles
function odc_archive_title( $title ) {
    
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
  
    return $title;
}
 
add_filter( 'get_the_archive_title', 'odc_archive_title' );

// More Link
function odc_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">Read More</a>';
} add_filter( 'get_the_content_more_link', 'odc_more_link' );

// Author Gravatar
function odc_author_box_gravatar( $size ) {

	return 120;

} add_filter( 'genesis_author_box_gravatar_size', 'odc_author_box_gravatar' );

// Re-Arrange Comment Fields
function odc_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
} add_filter( 'comment_form_fields', 'odc_move_comment_field_to_bottom' );

// Gravatar Size in Comments
function odc_comments_gravatar( $args ) {

	$args['avatar_size'] = 90;
	return $args;

} add_filter( 'genesis_comment_list_args', 'odc_comments_gravatar' );

// Change the footer text
function odc_footer_creds_filter( $creds ) {
	$creds = 'Copyright &copy; ' . date('Y') . ' ' . get_bloginfo('name') . ' | Design by <a href="https://overlockdesign.co/" target="_blank">Overlock Design Co.</a>';
	return $creds;
} add_filter('genesis_footer_output', 'odc_footer_creds_filter');
