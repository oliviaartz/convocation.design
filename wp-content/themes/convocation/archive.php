<?php get_header();?>

<main id="main"  role="main">

<div class="search_bar">
    <form action="#" method="get" autocomplete="off">
        <input type="text" name="s" placeholder="Search Code..." id="keyword" class="input_search" onkeyup="fetch()">
    </form>
    <div class="search_result" id="datafetch"></div>
</div>
<?php // data_fetch(); ?>

</main>

<?php get_footer();?>