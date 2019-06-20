<?php

//CREATE THE CUSTOM POST TYPE TESTIMONIAL
function my_custom_post_testimonial() {
    $labels = [
        'name' => _x( 'Testimonials', 'Testimonials' ),
        'singular_name' => _x( 'Testimonial', 'Testimonial' ),
        'add_new' => _x( 'Add New', 'Testimonial' ),
        'add_new_item' => __( 'Add New Testimonial' ),
        'edit_item' => __( 'Edit Testimonial' ),
        'new_item' => __( 'New Testimonial' ),
        'all_items' => __( 'All Testimonials' ),
        'view_item' => __( 'View Testimonials' ),
        'search_items' => __( 'Search Testimonial' ),
        'not_found' => __( 'No Testimonials found' ),
        'not_found_in_trash' => __( 'No Testimonials found in the Trash' ),
        'menu_name' => 'Testimonials'
    ];
    $args = [
        'labels' => $labels,
        'description' => 'Displays Testimonials',
        'public' => true,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-id',
        'supports' => array( 'title', 'excerpt', 'author', 'thumbnail', 'editor' )
    ];
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'my_custom_post_testimonial' );
//we are going to use the excerpt as the USER submitted. Since its anonimous, we accept any string as user.

add_action('init','custom_login');
function custom_login(){
    global $pagenow;
    if( 'wp-login.php' == $pagenow ) {
        wp_redirect('/login');
        exit();
    }
}
