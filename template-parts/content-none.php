<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package HydrogenWaterHQ
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title">Nothing Found</h1>
    </header>

    <div class="page-content">
        <?php if (is_search()) : ?>
            <p>Sorry, no results matched your search. Please try again with different keywords.</p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p>It seems we can't find what you're looking for. Perhaps searching can help.</p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>
