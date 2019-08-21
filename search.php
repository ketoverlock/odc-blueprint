<?php

// Remove Search Results Title
remove_action( 'genesis_before_loop', 'genesis_do_search_title' );

// Remove footer markup
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// Remove footer meta
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Removes Entry Content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

// Removes Featured Image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

function odc_search_content() {
    
    echo wp_trim_words( get_the_content(), 40, '... <a href="' . get_the_permalink() .'" class="more-link--search">Read More</a>' );
    
} add_action('genesis_entry_content', 'odc_search_content');



genesis();