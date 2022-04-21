<?php get_header();?>

<main id="main"  role="main">

    <section class="use-case">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="use-case-info">
                <h2 class="use-case-title"><?php the_title(); ?></h2>
                <div class="use-case-date"><?php get_project_date_range(); ?></div>
                <?php   $areas = get_field('areas_of_focus'); ?>
                    <div class="use-case-areas">
                        <?php if( $areas ):
                            foreach( $areas as $area ): 
                                $area_term = get_term_by('term_taxonomy_id', $area, 'areas_of_focus');
                                $area_name = get_term( $area_term )->name ?>
                                <a href="#"><?php echo $area_name; ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?> 
                    </div>
            </div>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </section>

</main>

<?php get_footer();?>