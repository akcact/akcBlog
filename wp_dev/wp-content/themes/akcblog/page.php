<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package akcBlog
 */

get_header();
?>

<main id="primary" class="main-content" style="max-width: 800px; padding: 4rem 2rem;">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <header class="post-header" style="text-align: center; margin-bottom: 3rem;">
                <h1 class="single-post-title" style="font-size: 3.5rem; background: var(--gradient-text); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;"><?php the_title(); ?></h1>
            </header>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-featured-image" style="margin-bottom: 3rem;">
                    <?php the_post_thumbnail( 'large' ); ?>
                </div>
            <?php endif; ?>

            <div class="post-entry-content">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'akcblog' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div>

        </article>
        <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
?>
