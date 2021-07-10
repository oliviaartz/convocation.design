<?php get_header();?>

<main id="main"  role="main">

	<section class="home-intro">
		<p class="home-intro__paragraph--question">Let’s make the internet a <abbr title="* safer, calmer, accountable, thriving.">better</abbr> place to be.</p>
		<p class="home-intro__paragraph--answer"><a href="/about" title="">How?</a></p>
	</section>

	<section class="selected-areas-of-focus">
		<h2>Areas of Focus</h2>
		<ul>
			<?php $areas = get_terms(array(	'taxonomy' => 'areas',
																			'hide_empty' => false));
					for($i = 0; $i < count($areas); $i++) { 
						$this_area = $areas[$i];
						if (get_field('show_on_home', $this_area->taxonomy.'_'.$this_area->term_id)) { ?>
							<li><a href="/work/area:<?php echo $this_area->term_id; ?>" title="<?php echo $this_area->name; ?>"><?php echo $this_area->name; ?></a></li>
			<?php }
					} ?>
		</ul>
	</section>

	<section class="selected-journal-entries">
		<h2><a href="/journal" title="Journal">Journal</a></h2>
		<ul>
			<?php $posts = get_posts(array('numberposts' => 3));
						foreach ($posts as $post) { ?>
							<li><a href="<?php echo get_permalink($post); ?>" title=""><?php echo $post->post_title; ?></a></li>
			<?php } ?>
		</ul>
	</section>

	<section class="selected-events-and-workshops">
		<h2>Events & Workshops</h2>
		<ul>
			<?php $posts = get_posts(array('post_type' => 'event', 'numberposts' => 2));
						foreach ($posts as $post) { ?>
							<li><a href="<?php echo get_permalink($post); ?>" title=""><?php echo $post->post_title; ?></a></li>
			<?php } ?>
		</ul>

	</section>

</main>

<?php get_footer();?>