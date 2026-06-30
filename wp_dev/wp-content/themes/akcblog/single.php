<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package akcBlog
 */

get_header();
?>

<div class="single-post-wrapper">
    <!-- Main Content Area -->
    <main id="primary" class="single-post-main">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <!-- Post Header -->
                <header class="post-header">
                    <div class="post-meta-badges">
                        <span class="badge badge-primary"><?php the_category( ', ' ); ?></span>
                        <span class="badge badge-secondary"><?php echo akcblog_reading_time( get_the_content() ); ?></span>
                    </div>
                    <h1 class="single-post-title"><?php the_title(); ?></h1>
                    
                    <div class="post-meta-details-bar">
                        <div class="meta-item">
                            <i class="fa-solid fa-user"></i>
                            <span>By <?php the_author(); ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Published on <?php echo get_the_date(); ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fa-solid fa-folder-open"></i>
                            <span>Category: <?php the_category(', '); ?></span>
                        </div>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="post-featured-image">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Entry Content -->
                <div class="post-entry-content">
                    <?php
                    the_content();

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'akcblog' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <!-- Post Tags -->
                <?php if ( has_tag() ) : ?>
                    <div class="post-tags">
                        <span class="post-tags-label">Tags:</span>
                        <?php the_tags( '', ' ' ); ?>
                    </div>
                <?php endif; ?>

            </article>

            <!-- Related Posts Section -->
            <div class="related-posts-section">
                <h3 class="related-posts-title"><?php esc_html_e( 'You Might Also Like', 'akcblog' ); ?></h3>
                <div class="related-posts-grid">
                    <?php
                    $categories = wp_get_post_categories( get_the_ID() );
                    if ( ! empty( $categories ) ) {
                        $related_query = new WP_Query( array(
                            'category__in'   => $categories,
                            'post__not_in'   => array( get_the_ID() ),
                            'posts_per_page' => 2,
                            'ignore_sticky_posts' => 1
                        ) );

                        if ( $related_query->have_posts() ) {
                            while ( $related_query->have_posts() ) {
                                $related_query->the_post();
                                ?>
                                <article class="post-card">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="card-img-wrapper">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail( 'medium' ); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-content">
                                        <h4 class="card-title" style="font-size: 1.15rem;">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h4>
                                        <div class="card-footer" style="border-top: none; padding-top: 0; margin-top: 0.5rem;">
                                            <div class="card-date" style="font-size: 0.75rem;">
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            }
                            wp_reset_postdata();
                        } else {
                            echo '<p>No related articles found.</p>';
                        }
                    }
                    ?>
                </div>
            </div>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </main>

    <!-- Sidebar Widget Column -->
    <?php get_sidebar(); ?>
</div>

<?php
get_footer();
?>
