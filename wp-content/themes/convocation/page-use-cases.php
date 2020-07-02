<?php get_header();?>

<main id="main"  role="main">

    <section class="use-cases-intro">
        <?php   $page = get_page_by_title( 'Use Cases' );
                $content = apply_filters( 'the_content', $page->post_content ); 
                echo $content; ?>
    </section>

    <section class="all-use-cases">
        <?php query_posts('showposts=-1'); if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h2><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Monthly Events' ) ) ); ?>"><?php the_title() ;?></a></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; endif; ?>
    </section>

</main>

<?php get_footer(); ?>
