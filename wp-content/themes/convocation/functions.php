<?php

add_action( 'init', 'cp_change_post_object' );
// Change dashboard Posts to Use Cases
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = 'Use Cases';
        $labels->singular_name = 'Use Case';
        $labels->add_new = 'Add Use Case';
        $labels->add_new_item = 'Add Use Case';
        $labels->edit_item = 'Edit Use Case';
        $labels->new_item = 'Use Case';
        $labels->view_item = 'View Use Case';
        $labels->search_items = 'Search Use Cases';
        $labels->not_found = 'No Use Cases found';
        $labels->not_found_in_trash = 'No Use Cases found in Trash';
        $labels->all_items = 'All Use Cases';
        $labels->menu_name = 'Use Cases';
        $labels->name_admin_bar = 'Use Cases';
}

function wpb_custom_new_menu() {
    register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

function load_stylesheets() {
    wp_register_style('cs', get_template_directory_uri() . '/css/convocation.css?date=17-06-2020v1', array(), false, 'all');
    wp_enqueue_style('cs');
}
add_action('wp_enqueue_scripts', 'load_stylesheets');

function loadjs() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.4.1.min.js', '', 1, true);
    wp_enqueue_script('jquery');

    wp_register_script('cs', get_template_directory_uri() . '/js/cs.js', '', 1, true);
    wp_enqueue_script('cs');
}
add_action('wp_enqueue_scripts', 'loadjs');