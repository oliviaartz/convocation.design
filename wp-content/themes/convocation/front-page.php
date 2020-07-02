<?php get_header();?>

<main id="main"  role="main">

    <section class="who-we-are">
        <!-- <img width="400" src="https://generative-placeholders.glitch.me/image?width=600&height=400&style=joy-division" /> -->
        <div class="triangle"></div>
        <div class="circle"></div>
        <div class="noise-mask"></div>
        <div class="intro-text">
            <?php   $page = get_page_by_title( 'Home: Who We Are' );
                    $content = apply_filters('the_content', $page->post_content); 
                    echo $content; ?>
        </div>
    </section>

    <section class="who-we-work-with">
        <div>
            <?php   $page = get_page_by_title( 'Home: Who We Work With' );
                    $content = apply_filters('the_content', $page->post_content); 
                    echo $content; ?>
        </div>
    </section>

    <section class="use-cases">
        <div>
            <?php query_posts('showposts=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>
                <h2><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Monthly Events' ) ) ); ?>"><?php the_title() ;?></a></h2>
                <?php the_excerpt(); ?>
            <?php endwhile; endif; ?>
        </div>
    </section>

    <section class="who-i-am">
        <div>
            <?php   $page = get_page_by_title( 'Home: Who I Am' );
                    $content = apply_filters('the_content', $page->post_content); 
                    echo $content; ?>
        </div>
    </section>

</main>

<?php get_footer();?>