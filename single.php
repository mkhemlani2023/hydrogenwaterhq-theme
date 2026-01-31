<?php
/**
 * Single post template
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

                    <div class="entry-meta">
                        <span class="posted-on">
                            Published: <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                        </span>
                        <span class="byline"> by <?php the_author(); ?></span>
                        <?php if (get_the_modified_date() !== get_the_date()) : ?>
                            <span class="updated-on">
                                | Updated: <time datetime="<?php echo get_the_modified_date('c'); ?>"><?php echo get_the_modified_date(); ?></time>
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php do_action('hydrogenwaterhq_after_entry_header'); ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">Pages:',
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $categories_list = get_the_category_list(', ');
                    if ($categories_list) {
                        echo '<span class="cat-links">Categories: ' . $categories_list . '</span>';
                    }

                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) {
                        echo '<span class="tags-links">Tags: ' . $tags_list . '</span>';
                    }
                    ?>
                </footer>
            </article>

            <nav class="post-navigation">
                <div class="nav-links">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();

                    if ($prev_post) :
                    ?>
                        <div class="nav-previous">
                            <span class="nav-subtitle">&larr; Previous</span>
                            <a href="<?php echo get_permalink($prev_post); ?>"><?php echo get_the_title($prev_post); ?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <div class="nav-next">
                            <span class="nav-subtitle">Next &rarr;</span>
                            <a href="<?php echo get_permalink($next_post); ?>"><?php echo get_the_title($next_post); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </nav>

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
