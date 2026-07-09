<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package akcBlog
 */

get_header();
?>

<!-- Archive Header -->
<section class="hero-section" style="padding: 4rem 0 2rem;">
    <span class="hero-tag">Archive View</span>
    <?php
    the_archive_title( '<h1 class="hero-title">', '</h1>' );
    the_archive_description( '<div class="hero-subtitle">', '</div>' );
    ?>
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
        <section class="no-results not-found">
            <h2 class="page-title"><?php esc_html_e( 'Nothing Found', 'akcblog' ); ?></h2>
            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'akcblog' ); ?></p>
            <?php get_search_form(); ?>
        </section>
    <?php endif; ?>

</main>

<?php
get_footer();
?>
