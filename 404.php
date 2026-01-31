<?php
/**
 * 404 template
 *
 * @package HydrogenWaterHQ
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <div class="content-area">
            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title">Page Not Found</h1>
                </header>

                <div class="page-content">
                    <p>Sorry, the page you're looking for doesn't exist or has been moved.</p>

                    <div class="error-actions">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Go to Homepage</a>
                    </div>

                    <div class="error-search">
                        <h3>Or try searching:</h3>
                        <?php get_search_form(); ?>
                    </div>

                    <div class="error-suggestions">
                        <h3>Popular Articles:</h3>
                        <ul>
                            <?php
                            $popular = new WP_Query(array(
                                'posts_per_page' => 5,
                                'post_status' => 'publish',
                                'orderby' => 'comment_count',
                                'order' => 'DESC',
                            ));

                            if ($popular->have_posts()) :
                                while ($popular->have_posts()) :
                                    $popular->the_post();
                            ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php
get_footer();
