<?php

/****************************************************************

    Customizer Inputs
    
****************************************************************/

function odc_customizer( $wp_customize ) {
    
    /****************************************************************

        Colors

    ****************************************************************/
    
    // Add Colors Panel
    $wp_customize->add_section('blueprint_colors', array(
        'title'         => __( 'Blueprint Colors', 'anania-media' ),
        'description'   => __( 'Customize the main theme colors.', 'anania-media' ),
        'priority'      => 110,
    ));
    
    // Primary Color
    $wp_customize->add_setting('primary_color', array('default' => '#183143'));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', 
        array(
            'label'     => __( 'Primary Theme Color', 'anania-media' ),
            'section'   => 'blueprint_colors',
            'settings'  => 'primary_color',
        ) ) 
    );
    
    // Secondary Color
    $wp_customize->add_setting('secondary_color', array('default' => '#8AC3D7'));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color', 
        array(
            'label'     => __( 'Secondary Theme Color', 'anania-media' ),
            'section'   => 'blueprint_colors',
            'settings'  => 'secondary_color',
        ) ) 
    );
    
    // Tertiary Color
    $wp_customize->add_setting('tertiary_color', array('default' => '#f7f7f7'));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tertiary_color', 
        array(
            'label'     => __( 'Tertiary Theme Color', 'anania-media' ),
            'section'   => 'blueprint_colors',
            'settings'  => 'tertiary_color',
        ) ) 
    );
    
    /****************************************************************

        Hero

    ****************************************************************/
    
    // Add Hero Panel
    $wp_customize->add_section('blueprint_hero', array(
        'title'         => __( 'Blueprint Hero', 'anania-media' ),
        'description'   => __( 'Customize the hero section.', 'anania-media' ),
        'priority'      => 110,
    ));
    
    // Hero Checkbox
    $wp_customize->add_setting( 'default_display', array(
        'default'   => 1
    ));
    $wp_customize->add_control( 'default_display', array(
        'type'          => 'checkbox',
        'section'       => 'blueprint_hero',
        'label'         => __( 'Display Hero Section?', 'anania-media' ),
        'description'   => __( 'Uncheck to remove hero section.' ),
    ) );


    // Hero Image
    $wp_customize->add_setting('default_hero');
    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control( $wp_customize, 'default_hero',
        array(
            'label'     => __( 'Default Hero Image', 'anania-media' ),
            'section'   => 'blueprint_hero',
            'settings'  => 'default_hero',
            'description'   => __( 'The default header image.' ),
            'width'     => 2000,
            'height'    => 600
            ) 
    ) );
    
} add_action( 'customize_register', 'odc_customizer' );

function odc_sanitize_url( $url ) {
  return esc_url_raw( $url );
}