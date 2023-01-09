<?php get_header();?>

<main id="main"  role="main">

<section class="filter search_bar">
  <form class="filter__form" onkeyup="fetch()" onchange="fetch()">

    <label class="filter__label filter_by_text">
      <input name="text" class="filter__input filter__input_text" type="text" placeholder="Search" />
    </label>

    <label class="filter__label filter_by_area_of_focus">
      <select name="area_of_focus" class="filter__select">
        <option class="filter__option" value="">Area of Focus</option>
        <?php $areas = get_terms(array( 'taxonomy' => 'areas','hide_empty' => false));
        for($i = 0; $i < count($areas); $i++) { 
            $this_area = $areas[$i]; ?>
            <option class="filter__option" value="<?php echo $this_area->slug; ?>"><?php echo $this_area->name; ?></option>
        <?php } ?>
      </select>
    </label>

    <label class="filter__label filter_type_of_work">
      <select name="type_of_work" class="filter__select">
        <option class="filter__option" value="">Type of Work</option>
        <!-- TODO: collect all the types of work and loop over them creating individual option elements -->
        <?php $types = get_terms(array( 'taxonomy' => 'types_of_work', 'hide_empty' => false));
        for($i = 0; $i < count($types); $i++) { 
            $this_work = $types[$i]; ?>
            <option class="filter__option" value="<?php echo $this_work->slug; ?>"><?php echo $this_work->name; ?></option>
        <?php } ?>
      </select>
    </label>

    <label class="filter__label filter_clear_filter">
      <input class="filter__input filter__input_reset" type="reset" onclick="setTimeout(fetch, 0)" value="Show all" />
    </label>

  </form>

</section>
  <div class="search_result" id="datafetch"></div>

</main>

<?php get_footer();?>