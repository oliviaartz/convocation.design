<?php get_header();?>

<main id="main"  role="main">

    <section class="use-case">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="use-case-info">
                <h2 class="use-case-title"><?php the_title(); ?></h2>
                <div class="use-case-date"><?php get_project_date_range(); ?></div>
                <?php   $tags = get_the_tags(); ?>
                    <div class="use-case-areas">
                        <?php if( $tags ):
                            foreach ( $tags as $tag ): ?>
                                <a href="#"><?php echo esc_html( $tag->name );; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?> 
                    </div>
            </div>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </section>

</main>

<?php get_footer();?>