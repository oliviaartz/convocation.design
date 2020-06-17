<?php get_header();?>
<nav role="navigation" aria-label="Main">
    <?php   wp_nav_menu( array( 
                'theme_location' => 'my-custom-menu', 
                'container_class' => 'custom-menu-class' ) ); ?>
    <h1><a href="/" title="Home">Convocation Design</a></h1>
</nav>
  
    <section class="project" role="main">
  
        <?php while ( have_posts() ) : the_post(); ?>
  
            <header>
                <?php the_title('<h2>', '</h2>'); ?>
                <span class="projectDateRange"><?php get_project_date_range(); ?></span>
                <span class="projectTopics"><?php get_project_categories(); ?></span>
            </header>

            <?php the_content(); ?>
  
        <?php endwhile; ?>
  
    </section>
  
<?php get_footer(); ?>