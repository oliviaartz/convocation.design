<?php get_header();?>

<main id="main"  role="main">

	<section class="home-intro">
		<p class="home-intro__paragraph--question">Let’s make the internet a <abbr title="* safer, calmer, accountable, thriving.">better</abbr> place to be.</p>
		<p class="home-intro__paragraph--answer"><a href="/about" title="">How?</a></p>
	</section>

	<section class="selected-events">
	<?php $posts = get_posts(array('post_type' => 'case_study', 'numberposts' => 0));
				foreach ($posts as $post) { ?>
						<div class="selected-events__event">
							<a class="selected-events__event-link" href="<?php echo get_permalink($post); ?>" title="">
								<?php echo get_the_post_thumbnail($post);?></span>
								<span class="selected-events__event-body">
									<span class="selected-events__title"><?php echo $post->post_title; ?></span>
									<span class="selected-events__date"><?php echo get_the_date('F d', $post); ?></span>
								</span>
							</a>
						</div>
	<?php } ?>
	</section>

</main>

<?php get_footer();?>