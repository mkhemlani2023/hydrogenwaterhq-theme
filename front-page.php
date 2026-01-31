<?php
/**
 * Front page template
 *
 * @package HydrogenWaterHQ
 */

get_header();
?>

<main id="primary" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1>Your Complete Guide to Hydrogen Water</h1>
                <p class="hero-subtitle">Discover the benefits of hydrogen-rich water, find the best products, and learn how to improve your health naturally.</p>
                <div class="hero-buttons">
                    <a href="<?php echo esc_url(home_url('/best-hydrogen-water-bottles/')); ?>" class="btn btn-primary">Best Hydrogen Water Bottles</a>
                    <a href="<?php echo esc_url(home_url('/hydrogen-water-benefits/')); ?>" class="btn btn-secondary">Learn About Benefits</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="featured-categories">
        <div class="container">
            <h2 class="section-title">Explore Our Guides</h2>
            <div class="category-grid">
                <div class="category-card">
                    <div class="category-icon">&#x1F4A7;</div>
                    <h3>Hydrogen Water Bottles</h3>
                    <p>Reviews and comparisons of the best portable hydrogen water generators.</p>
                    <a href="<?php echo esc_url(home_url('/category/hydrogen-water-bottles/')); ?>">View Reviews &rarr;</a>
                </div>
                <div class="category-card">
                    <div class="category-icon">&#x1F3E0;</div>
                    <h3>Home Machines</h3>
                    <p>Full-size hydrogen water machines for your home and family.</p>
                    <a href="<?php echo esc_url(home_url('/category/hydrogen-water-machines/')); ?>">View Reviews &rarr;</a>
                </div>
                <div class="category-card">
                    <div class="category-icon">&#x2764;</div>
                    <h3>Health Benefits</h3>
                    <p>Science-backed information about hydrogen water and your health.</p>
                    <a href="<?php echo esc_url(home_url('/category/health-benefits/')); ?>">Learn More &rarr;</a>
                </div>
                <div class="category-card">
                    <div class="category-icon">&#x1F4D6;</div>
                    <h3>Buying Guides</h3>
                    <p>Everything you need to know before purchasing hydrogen water products.</p>
                    <a href="<?php echo esc_url(home_url('/category/buying-guides/')); ?>">Read Guides &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Posts -->
    <section class="latest-posts">
        <div class="container">
            <h2 class="section-title">Latest Articles</h2>
            <div class="posts-grid">
                <?php
                $recent_posts = new WP_Query(array(
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                ));

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) :
                        $recent_posts->the_post();
                ?>
                <article class="post-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php endif; ?>
                    <div class="post-card-content">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="read-more">Read More &rarr;</a>
                    </div>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No posts found. Start adding content!</p>';
                endif;
                ?>
            </div>
            <div class="view-all">
                <a href="<?php echo esc_url(home_url('/blog/')); ?>" class="btn btn-outline">View All Articles</a>
            </div>
        </div>
    </section>

    <!-- Trust Section -->
    <section class="trust-section">
        <div class="container">
            <div class="trust-content">
                <h2>Why Trust HydrogenWaterHQ?</h2>
                <div class="trust-points">
                    <div class="trust-point">
                        <span class="trust-icon">&#x2714;</span>
                        <h4>Expert Research</h4>
                        <p>We thoroughly research every product and topic we cover.</p>
                    </div>
                    <div class="trust-point">
                        <span class="trust-icon">&#x2714;</span>
                        <h4>Honest Reviews</h4>
                        <p>Our reviews include both pros and cons - no paid placements.</p>
                    </div>
                    <div class="trust-point">
                        <span class="trust-icon">&#x2714;</span>
                        <h4>Science-Backed</h4>
                        <p>We reference clinical studies and scientific research.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
