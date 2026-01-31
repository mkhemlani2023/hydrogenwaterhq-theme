<?php
/**
 * Page template
 *
 * @package HydrogenWaterHQ
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <?php
            while (have_posts()) :
                the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">Pages:',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>

            <?php
            // If comments are open or there's at least one comment
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
