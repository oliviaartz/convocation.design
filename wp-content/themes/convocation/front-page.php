<?php get_header();?>

<main id="main"  role="main">

    <section class="who-we-are">
        <?php   $page = get_page_by_title( 'Home: Who We Are' );
                $content = apply_filters('the_content', $page->post_content); 
                echo $content; ?>
    </section>

    <section class="who-we-work-with">
        <?php   $page = get_page_by_title( 'Home: Who We Work With' );
                $content = apply_filters('the_content', $page->post_content); 
                echo $content; ?>
    </section>

    <section class="use-cases">
        <?php query_posts('showposts=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>            <h2><?php the_title() ;?></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; endif; ?>
    </section>

    <section class="who-i-am">
        <?php   $page = get_page_by_title( 'Home: Who I Am' );
                $content = apply_filters('the_content', $page->post_content); 
                echo $content; ?>
    </section>

</main>

<?php get_footer();?>