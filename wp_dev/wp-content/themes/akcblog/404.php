<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package akcBlog
 */

get_header();
?>

<main id="primary" class="main-content" style="max-width: 800px; padding: 6rem 2rem; text-align: center;">
    <section class="error-404 not-found" style="background: var(--color-bg-card); border: 1px solid var(--color-border); padding: 4rem 3rem; border-radius: var(--border-radius-lg); backdrop-filter: blur(12px); box-shadow: var(--shadow-lg);">
        
        <h1 style="font-size: 8rem; font-weight: 800; line-height: 1; margin-bottom: 1rem; background: var(--gradient-text); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 0 20px rgba(139,92,246,0.3));">
            404
        </h1>
        
        <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--color-text-primary);">
            Lost in Space?
        </h2>
        
        <p style="color: var(--color-text-secondary); max-width: 500px; margin: 0 auto 2.5rem; font-size: 1.05rem; line-height: 1.6;">
            The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Let's get you back on track!
        </p>

        <div style="max-width: 500px; margin: 0 auto 3rem;">
            <?php get_search_form(); ?>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-readmore" style="margin-top: 0;">
                <i class="fa-solid fa-house"></i> Back to Home
            </a>
            <?php
            $about_page = get_page_by_path('about-me');
            if ( $about_page ) : ?>
                <a href="<?php echo esc_url( get_permalink($about_page->ID) ); ?>" class="btn-readmore" style="margin-top: 0; background: rgba(255,255,255,0.05); border: 1px solid var(--color-border); box-shadow: none;">
                    About Us
                </a>
            <?php endif; ?>
        </div>

    </section>
</main>

<?php
get_footer();
?>
