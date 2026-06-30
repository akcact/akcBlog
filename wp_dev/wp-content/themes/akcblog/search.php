<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package akcBlog
 */

get_header();
?>

<!-- Search Results Header -->
<section class="hero-section" style="padding: 4rem 0 2rem;">
    <span class="hero-tag">Search Results</span>
    <h1 class="hero-title">
        <?php
        /* translators: %s: search query. */
        printf( esc_html__( 'Results for: %s', 'akcblog' ), '<span>' . get_search_query() . '</span>' );
        ?>
    </h1>
    <p class="hero-subtitle">
        Review all posts and resources matching your keyword search.
    </p>
</section>

<main id="primary" class="main-content">

    <?php if ( have_posts() ) : ?>

        <!-- Cards Grid -->
        <div class="post-grid">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" class="post-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="card-img-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="card-content">
                        <span class="post-meta-cat">
                            <?php the_category( ', ' ); ?>
                        </span>
                        <h3 class="card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="card-excerpt">
                            <?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
                        </p>
                        
                        <div class="card-footer">
                            <div class="card-author">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 28, '', '', array( 'class' => 'card-author-avatar' ) ); ?>
                                <span><?php the_author(); ?></span>
                            </div>
                            <div class="card-date">
                                <?php echo get_the_date( 'M j, Y' ); ?>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
            endwhile;
            ?>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <?php
            echo paginate_links( array(
                'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
                'next_text' => '<i class="fa-solid fa-angle-right"></i>',
            ) );
            ?>
        </div>

    <?php else : ?>
        <section class="no-results not-found" style="text-align: center; padding: 4rem 0;">
            <h2 class="page-title" style="font-size: 2rem; margin-bottom: 1rem;"><?php esc_html_e( 'No Matches Found', 'akcblog' ); ?></h2>
            <p style="color: var(--color-text-secondary); margin-bottom: 2rem;"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'akcblog' ); ?></p>
            <div style="max-width: 500px; margin: 0 auto;">
                <?php get_search_form(); ?>
            </div>
        </section>
    <?php endif; ?>

</main>

<?php
get_footer();
?>
