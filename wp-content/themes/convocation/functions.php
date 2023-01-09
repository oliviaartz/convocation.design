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

add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data:   {
                    action: 'data_fetch',
                    keyword: jQuery('.filter__input_text').val(),
                    area: jQuery('.filter_by_area_of_focus select').val(),
                    type_of_work: jQuery('.filter_type_of_work select').val()
                },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });

}
// fetch() does not work
setTimeout(fetch, 0) // works
</script>

<?php
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $keyword_str = isset($_POST['keyword']) ? $_POST['keyword'] : '';
    $type_str = isset($_POST['type_of_work']) ? $_POST['type_of_work'] : '';

    $tax_queries = array();

    if( isset($_POST['area']) && !empty($_POST['area']) ) {
        array_push($tax_queries, array( 'taxonomy' => 'areas',
                                        'field' => 'slug',
                                        'terms' => $_POST['area']));
    }

    if( isset($_POST['type_of_work']) && !empty($_POST['type_of_work']) ) {
        array_push($tax_queries, array( 'taxonomy' => 'types_of_work',
                                        'field' => 'slug',
                                        'terms' => $_POST['type_of_work']));
    }

    $the_query = new WP_Query( array(   'posts_per_page' => -1,
                                        's' => esc_attr( $keyword_str ),
                                        'post_type' => array('case_study'),
                                        'tax_query' => $tax_queries ) );

    if( $the_query->have_posts() ) :
        echo '';
        while( $the_query->have_posts() ): $the_query->the_post();
            $areas = get_field('areas_of_focus'); ?>
            <div class=work_list_item>
                <span class="work_list_item_date"><?php get_project_date_range();?></span>
                <h3 class="work_list_item_title"><?php the_title();?></h3>
                <span class="work_list_item_location"></span>
                <span class="work_list_item_type"></span>
                <span class="work_list_item_areas">
                    <?php if( $areas ):
                        foreach( $areas as $area ): 
                            $area_term = get_term_by('term_taxonomy_id', $area, 'areas_of_focus');
                            $area_name = get_term( $area_term )->name ?>
                            <a href="#"><?php echo $area_name; ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?> 
                </span>
                <p class="work_list_item_excerpt"><?php echo get_the_excerpt();?></p>
                <span class="work_list_item_image"><?php echo get_the_post_thumbnail($post);?></span>
                <a class="work_list_item_link" href="<?php echo esc_url( post_permalink() ); ?>">Read more</a>
            </div>
        <?php endwhile;
        echo '';
        wp_reset_postdata();  
    endif;

    die();
}