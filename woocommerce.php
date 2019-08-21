<?php

/****************************************************************

    WooCommerce Template
    
****************************************************************/

// Remove standard post content output
remove_action( 'genesis_loop', 'genesis_do_loop');

// Remove Archive Description
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );

// Add WooCommerce Content
function odc_woocommerce_output() {
  woocommerce_content();
} add_action( 'genesis_loop', 'odc_woocommerce_output' );

genesis();