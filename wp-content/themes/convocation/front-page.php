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
							<li><a href="/work/area:<?php echo $this_area->term_id; ?>" title="<?php echo $this_area->name; ?>"><?php echo str_replace("-"," ",$this_area->slug); ?></a></li>
			<?php }
					} ?>
		</ul>
	</section>

	<section class="selected-journal-entries">
		<h2>
			<a href="/journal" title="Journal">
				<svg aria-labelledby="title" width="240" height="40" viewBox="0 0 240 40" fill="none" xmlns="http://www.w3.org/2000/svg">
					<title id="title" lang="en">Journal</title>
				<path d="M219.092 38.1838L237.477 19.7991L219.092 1.41429" stroke="#0000FF" stroke-width="3"/>
				<line x1="236.77" y1="19.6838" x2="202.77" y2="19.6838" stroke="#0000FF" stroke-width="3"/>
				<path d="M2.25406 12.05H10.1961V21.884C10.1961 26.46 9.33806 27.846 6.47806 27.846C3.42006 27.846 0.80206 24.832 0.80206 20.058V18.914H0.25206V28H0.80206V23.754C1.74806 26.702 4.16806 28.44 6.83006 28.44C10.3281 28.44 13.0121 26.812 13.0121 21.862V12.05H17.4341V11.5H2.25406V12.05ZM30.4952 11.06C25.0392 11.06 22.2672 14.206 22.2672 19.904C22.2672 25.426 25.1052 28.44 30.4952 28.44C35.8852 28.44 38.7672 25.426 38.7672 19.904C38.7672 14.206 35.9952 11.06 30.4952 11.06ZM30.4952 11.61C34.3452 11.61 35.6872 13.898 35.6872 19.926C35.6872 25.602 34.2572 27.89 30.4952 27.89C26.7332 27.89 25.3472 25.602 25.3472 19.926C25.3472 13.898 26.6452 11.61 30.4952 11.61ZM56.3603 12.05H58.4723V21.158C58.4723 25.58 56.3383 27.604 53.0383 27.648C49.9583 27.692 48.6603 26.086 48.6603 21.862V12.05H51.2563V11.5H43.8203V12.05H45.8883V21.84C45.8883 26.35 48.5943 28.44 52.6863 28.44C56.9543 28.44 59.1543 25.69 59.1543 21.158V12.05H61.2003V11.5H56.3603V12.05ZM66.2534 12.05H68.5414V27.45H66.2534V28H75.0754V27.45H71.3574V20.058H73.4034C78.0894 20.058 74.1954 28.44 80.2234 28.44C82.0714 28.44 83.1054 27.582 83.1054 25.734V23.38H82.5554V25.734C82.5554 26.944 82.1154 27.406 81.1914 27.406C78.7274 27.406 80.1354 21.532 75.8894 20.058C78.8594 20.036 81.8734 18.672 81.8734 15.746C81.8734 12.842 79.1234 11.5 75.9994 11.5H66.2534V12.05ZM74.6574 12.094C77.1434 12.094 78.7934 12.49 78.7934 15.724C78.7934 18.98 77.1434 19.464 74.6574 19.464H71.3574V12.094H74.6574ZM88.2466 12.05H90.3146V27.45H88.2466V28H93.7246V27.45H90.9306V12.072L102.283 28.44L102.305 28.198V28.44H102.899V12.05H104.967V11.5H99.4666V12.05H102.305V23.6L93.9446 11.5H88.2466V12.05ZM112.88 12.05H116.686L111.12 27.45H109.58V28H114.992V27.45H111.802L113.474 22.83H121.284L122.978 27.45H119.876V28H127.4V27.45H125.772L119.964 11.5H112.88V12.05ZM113.694 22.236L117.368 12.05L121.086 22.236H113.694ZM132.255 12.05H134.521V27.45H132.233V28H148.293V20.542H147.743V23.732C147.743 26.68 147.017 27.406 143.849 27.406H137.337V12.05H140.043V11.5H132.255V12.05Z" fill="#0000FF"/>
			</svg>
			</a>
		</h2>
		<ul>
			<?php $posts = get_posts(array('numberposts' => 3));
						foreach ($posts as $post) { ?>
							<li>
								<a href="<?php echo get_permalink($post); ?>" title="read <?php echo $post->post_title; ?>">
									<?php echo get_the_post_thumbnail($post);?>
									<span class="selected-journal-entries__body">
										<span class="selected-journal-entries__date"><?php echo get_the_date('m.d.Y', $post); ?></span>
										<span class="selected-journal-entries__title"><?php echo $post->post_title; ?></span>
									</span>
								</a>
							</li>
			<?php } ?>
		</ul>
	</section>

	<?php $posts = get_posts(array('post_type' => 'event', 'numberposts' => 2));
				if (count($posts) >= 2) { ?>
					<section class="selected-events">
						<div class="selected-events__event">
							<a class="selected-events__event-link" href="<?php echo get_permalink($posts[0]); ?>" title="">
								<?php echo get_the_post_thumbnail($posts[0]);?></span>
								<span class="selected-events__event-body">
									<span class="selected-events__type"><?php echo wp_get_post_terms($posts[0]->ID, 'event_types', array( 'fields' => 'names' ))[0]; ?></span>
									<span class="selected-events__title"><?php echo $posts[0]->post_title; ?></span>
									<span class="selected-events__date"><?php echo get_the_date('F d', $posts[0]); ?></span>
								</span>
							</a>
						</div>
						<h2 class="selected-events__heading">Events & Workshops</h2>
						<div class="selected-events__event">
							<a class="selected-events__event-link" href="<?php echo get_permalink($posts[1]); ?>" title="">
								<?php echo get_the_post_thumbnail($posts[1]);?></span>
								<span class="selected-events__event-body">
									<span class="selected-events__type"><?php echo wp_get_post_terms($posts[1]->ID, 'event_types', array( 'fields' => 'names' ))[0]; ?></span>
									<span class="selected-events__title"><?php echo $posts[1]->post_title; ?></span>
									<span class="selected-events__date"><?php echo get_the_date('F d', $posts[1]); ?></span>
								</span>
							</a>
						</div>
					</section>
	<?php } ?>


</main>

<?php get_footer();?>