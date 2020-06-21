<?php get_header();?>

<main id="main"  role="main">

    <section class="use-cases-intro">
        <?php   $page = get_page_by_title( 'Use Cases' );
                $content = apply_filters( 'the_content', $page->post_content ); 
                echo $content; ?>
    </section>

    <section class="use-cases">
        <?php query_posts('showposts=-1'); if (have_posts()) : while (have_posts()) : the_post(); ?>            <h2><?php the_title() ;?></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; endif; ?>
    </section>

</main>

<?php get_footer(); ?>