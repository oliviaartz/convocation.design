<?php get_header();?>

<main id="main"  role="main">

    <section class="use-case">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_title(); ?>
            <?php get_project_date_range(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </section>

</main>

<?php get_footer();?>