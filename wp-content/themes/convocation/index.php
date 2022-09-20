<?php get_header();?>
  
<section class="project" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

        <header>
            <!-- <?php the_title('<h2>', '</h2>'); ?> -->
        </header>

        <?php the_content(); ?>

    <?php endwhile; ?>

</section>
  
<?php get_footer(); ?>