<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
 
    $parent_style = 'parent-style'; // This is 'tentytwenty-style' for the Twenty Twenty theme.
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_google_fonts' );
function my_theme_enqueue_google_fonts(){

    wp_register_style( 'montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:700&display=swap' );
    wp_enqueue_style( 'montserrat' );

    wp_register_style( 'lato', 'https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i&display=swap' );
    wp_enqueue_style( 'lato' );

    wp_register_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap' );
    wp_enqueue_style( 'roboto slab' );

    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/resize_header.js', array ( 'jquery' ), 1.0, true);

}


// Add custom post type for homepage content
function create_posttype() {
 
    register_post_type( 'homepage_content',
        array(
            'labels' => array(
                'name' => __( 'Homepage Content' ),
                'singular_name' => __( 'Entry' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'entries'),
            'publicly_queryable'  => false,
            'menu_position'       => 20,
            'supports' => array( 
                'title', 
                'editor', 
                'custom-fields', 
                'revisions' 
                ),
        )
    );


    register_post_type( 'banner_content',
        array(
            'labels' => array(
                'name' => __( 'Banner Content' ),
                'singular_name' => __( 'Entry' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'entries'),
            'publicly_queryable'  => false,
            'menu_position'       => 20,
            'supports' => array( 
                'title', 
                'editor', 
                'custom-fields', 
                'revisions' 
                ),
        )
    );

}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

