<?php

add_theme_support( 'post-thumbnails' );

add_action( 'init', 'cp_change_post_object' );
// Change dashboard Posts to Use Cases
function cp_change_post_object() {
    $new_singular = 'Journal Entry';
    $new_plural = 'Journal Entries';
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
        $labels->name = $new_plural;
        $labels->singular_name = $new_singular;
        $labels->add_new = 'Add ' . $new_singular;
        $labels->add_new_item = 'Add ' . $new_singular;
        $labels->edit_item = 'Edit ' . $new_singular;
        $labels->new_item = 'New ' . $new_singular;
        $labels->view_item = 'View ' . $new_singular;
        $labels->search_items = 'Search ' . $new_plural;
        $labels->not_found = 'No ' . $new_plural . ' found';
        $labels->not_found_in_trash = 'No ' . $new_plural . ' found in Trash';
        $labels->all_items = 'All ' . $new_plural;
        $labels->menu_name = $new_plural;
        $labels->name_admin_bar = $new_plural;
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

    wp_register_script('cs', get_template_directory_uri() . '/js/convocation.js', '', 1, true);
    wp_enqueue_script('cs');
}
add_action('wp_enqueue_scripts', 'loadjs');


function get_projects() {
	
	$posts = get_posts(array(
		'posts_per_page'	=> -1
	));

    $projects = array();

    foreach($posts as $post) {
        $post_id = $post->ID;

        $start_date = DateTime::createFromFormat('Ymd', get_post_meta($post_id, 'project_start_date')[0]);
        if( $start_date == '') {
            continue;
        }
        $start_date = $start_date->format('Y-m-d');

        $end_date = DateTime::createFromFormat('Ymd', get_post_meta($post_id, 'project_end_date')[0]);
        if( $end_date == '') {
            $end_date = date('Y-m-d');
        } else {
            $end_date = $end_date->format('Y-m-d');
        }

        $topics = get_the_category($post_id);
        $topics_array = array();
        $topics_array = wp_get_object_terms($post_id, 'category', array('fields' => 'slugs'));
        $topics = implode(',', $topics_array);
        $post_data = array(
            'title'         => get_the_title($post),
            'excerpt'       => get_the_excerpt($post),
            'link'          => get_post_permalink($post),
            'start_date'    => $start_date,
            'end_date'      => $end_date,
            'topics'        => $topics
        );
        array_push($projects, $post_data);
    }

    return $projects;

}

function get_project_date_range() {

    global $post;
    $post_id = $post->ID;

    $start_date = DateTime::createFromFormat('Ymd', get_post_meta($post_id, 'start_date')[0]);
    if( $start_date == '') {
        $start_date = date('Y');
    } else {
        $start_date = $start_date->format('Y');
    }

    $date_range_str = $start_date;

    $end_date = DateTime::createFromFormat('Ymd', get_post_meta($post_id, 'end_date')[0]);
    if( $end_date != '') {
        $date_range_str .= ' — '. $end_date->format('Y');
    }

    echo $date_range_str;

}