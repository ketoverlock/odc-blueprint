<?php

/****************************************************************

    Template Name: Landing Page
    
****************************************************************/

add_filter( 'body_class', 'odc_add_body_class' );
/**
 * Adds landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Original body classes.
 * @return array Modified body classes.
 */
function odc_add_body_class( $classes ) {

	$classes[] = 'landing-page';
	return $classes;

}

// Removes Skip Links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );

add_action( 'wp_enqueue_scripts', 'odc_dequeue_skip_links' );
/**
 * Dequeues Skip Links Script.
 *
 * @since 1.0.0
 */
function odc_dequeue_skip_links() {

	wp_dequeue_script( 'skip-links' );

}

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Removes site header elements.
remove_action('genesis_before_header', 'odc_superheader');
remove_action('genesis_before_header', 'odc_top_bar');
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action('genesis_header', 'odc_social', 10);

// Removes navigation.
remove_theme_support( 'genesis-menus' );

// Removes breadcrumbs.
remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

// Removes footer widgets.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Removes site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Runs the Genesis loop.
genesis();
