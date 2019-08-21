<?php

/* Template for 404 Page */

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove Default Text
remove_action( 'genesis_loop', 'genesis_do_loop' );

function odc_404() { ?>

<div class="entry">
    <h1 class="entry-title screen-reader-text">Not Found, Error 404</h1>
    
    <div class="entry-content">
    
        <p>
            The page you are looking for no longer exists. Perhaps you can return back to the <a href="<?php echo get_bloginfo('url');?>">homepage</a> and see if you can find what you are looking for. 
        </p>

        <?php wp_nav_menu('primary'); ?>
        
    </div>
    
</div>
    
<?php } add_action('genesis_loop', 'odc_404');

genesis();
