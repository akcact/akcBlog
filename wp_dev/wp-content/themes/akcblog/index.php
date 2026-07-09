<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package akcBlog
 */

get_header();
?>

<!-- Hero Banner Section -->
<?php if ( ! is_paged() ) : ?>
<section class="hero-section">
    <span class="hero-tag">Aesthetic Insights</span>
    <h1 class="hero-title">Thoughts, Ideas & Modern Workflows</h1>
    <p class="hero-subtitle">
        Explore a curated journal of premium guides, development tricks, design frameworks, and workspace configurations curated specifically for digital creators.
    </p>
</section>
<?php endif; ?>

<main id="primary" class="main-content">

    <?php
    if ( have_posts() ) :
        $featured_id = null;

        // Display Featured Post only on the first page
        if ( ! is_paged() ) :
            // Look for the first post to set as featured
            while ( have_posts() ) :
                the_post();
                $featured_id = get_the_ID();
                ?>
                <div class="featured-post-container">
                    <article id="post-<?php the_ID(); ?>" class="featured-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="featured-img-wrapper">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="featured-content">
                            <span class="post-meta-cat">
                                <?php the_category( ', ' ); ?>
                            </span>
                            <h2 class="featured-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="featured-excerpt">
                                <?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
                            </p>
                            
                            <div class="card-footer" style="border-top: none; padding-top: 0;">
                                <div class="post-meta-author">
                                    <?php echo get_avatar( get_the_author_meta( 'ID' ), 36, '', '', array( 'class' => 'author-avatar' ) ); ?>
                                    <div class="meta-details">
                                        <span class="meta-author-name"><?php the_author(); ?></span>
                                        <span class="meta-date-reading"><?php echo get_the_date(); ?> &bull; <?php echo akcblog_reading_time( get_the_content() ); ?></span>
                                    </div>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-readmore">
                                    Read Post <i class="fa-solid fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php
                break; // Exit after first post
            endwhile;
            rewind_posts();
        endif;
        ?>

        <!-- Feed List and Categories Filter Bar -->
        <div class="filter-bar">
            <h2 class="feed-title"><?php esc_html_e( 'Latest Articles', 'akcblog' ); ?></h2>
            <ul class="category-pills">
                <li class="active-cat"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">All</a></li>
                <?php
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ) );
                foreach ( $categories as $category ) {
                    echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Cards Grid -->
        <div class="post-grid">
            <?php
            while ( have_posts() ) :
                the_post();

                // Skip featured post if displayed
                if ( get_the_ID() === $featured_id ) {
                    continue;
                }
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

    <?php
    else :
        ?>
        <section class="no-results not-found">
            <h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'akcblog' ); ?></h2>
            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'akcblog' ); ?></p>
            <?php get_search_form(); ?>
        </section>
        <?php
    endif;
    ?>

</main>

<?php
get_footer();
?>
