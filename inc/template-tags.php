<?php
/**
 * Custom template tags for this theme
 *
 * @package HydrogenWaterHQ
 */

if (!function_exists('hydrogenwaterhq_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time
     */
    function hydrogenwaterhq_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            $time_string .= '<time class="updated" datetime="%3$s"> (Updated: %4$s)</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        echo '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

if (!function_exists('hydrogenwaterhq_posted_by')) :
    /**
     * Prints HTML with meta information for the current author
     */
    function hydrogenwaterhq_posted_by() {
        echo '<span class="byline"> by <span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span></span>';
    }
endif;

if (!function_exists('hydrogenwaterhq_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments
     */
    function hydrogenwaterhq_entry_footer() {
        if ('post' === get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                printf('<span class="cat-links">Posted in %s</span>', $categories_list);
            }

            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                printf('<span class="tags-links">Tagged %s</span>', $tags_list);
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hydrogenwaterhq'),
                        array('span' => array('class' => array()))
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }
    }
endif;

if (!function_exists('hydrogenwaterhq_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail
     */
    function hydrogenwaterhq_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
        ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div>
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail(
                    'medium_large',
                    array('alt' => the_title_attribute(array('echo' => false)))
                );
                ?>
            </a>
        <?php
        endif;
    }
endif;

/**
 * Display estimated reading time
 */
function hydrogenwaterhq_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);

    echo '<span class="reading-time">' . $reading_time . ' min read</span>';
}
