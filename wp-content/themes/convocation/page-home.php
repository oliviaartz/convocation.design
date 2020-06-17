<?php get_header();?>
<nav role="navigation" aria-label="Main">
    <?php   wp_nav_menu( array( 
                'theme_location' => 'my-custom-menu', 
                'container_class' => 'custom-menu-class' ) ); ?>
    <h1><a href="/" title="Home">Convocation Design</a></h1>
</nav>

<section id="intro">
    <?php   $page = get_page_by_title( 'home' );
            $content = apply_filters('the_content', $page->post_content); 
            echo $content; ?>
</section>

<section id="work">

    <div id="timelines"></div>

    <svg id="bracecords"></svg>
    
    <div id="projects">
    
        <?php   $projects = get_projects();
                foreach($projects as $project) { ?>
                
                <article data-project-start-date="<?php echo($project['start_date']) ?>" data-project-end-date="<?php echo($project['end_date']) ?>" data-project-topics="<?php print_r($project['topics']) ?>">
                    <h2><a href="<?php echo $project['link'] ?>"><?php echo $project['title'] ?></a></h2>
                    <!-- <p><?php echo $project['excerpt'] ?></p> -->
                </article>

        <?php   } ?>
    
    </div>
    
</section>

<?php get_footer();?>