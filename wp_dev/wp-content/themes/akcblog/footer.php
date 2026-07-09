<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package akcBlog
 */

?>
<footer id="colophon" class="site-footer">
    <div class="footer-container">
        <!-- Brand Info -->
        <div class="footer-column-brand">
            <div class="footer-logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    akc<span>Blog</span>
                </a>
            </div>
            <p class="footer-description">
                A premium space dedicated to sharing insightful thoughts on technology, creative design patterns, and workspaces that supercharge daily productivity.
            </p>
        </div>

        <!-- Quick Links -->
        <div class="footer-column-links">
            <h4 class="footer-title"><?php esc_html_e( 'Quick Links', 'akcblog' ); ?></h4>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <?php
                $about_page = get_page_by_path('about-me');
                if ( $about_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink($about_page->ID) ); ?>">About Us</a></li>
                <?php endif;
                $contact_page = get_page_by_path('contact-us');
                if ( $contact_page ) : ?>
                    <li><a href="<?php echo esc_url( get_permalink($contact_page->ID) ); ?>">Contact</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Categories / Topics -->
        <div class="footer-column-topics">
            <h4 class="footer-title"><?php esc_html_e( 'Categories', 'akcblog' ); ?></h4>
            <ul class="footer-links">
                <?php
                $categories = get_categories( array(
                    'orderby' => 'name',
                    'order'   => 'ASC',
                    'number'  => 5
                ) );
                foreach ( $categories as $category ) {
                    echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Newsletter Subscription -->
        <div class="footer-column-newsletter">
            <h4 class="footer-title"><?php esc_html_e( 'Stay Updated', 'akcblog' ); ?></h4>
            <div class="newsletter-form-container">
                <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                    <input type="email" placeholder="name@example.com" required aria-label="Email address" />
                    <button type="submit">Join</button>
                </form>
                <p class="newsletter-desc">Get the latest articles delivered straight to your inbox weekly.</p>
            </div>
        </div>
    </div>

    <!-- Copyright and Social Icons -->
    <div class="footer-bottom">
        <div class="copyright-info">
            &copy; <?php echo date( 'Y' ); ?> akcBlog. All rights reserved. Created with passion for creators.
        </div>
        <div class="footer-social-icons">
            <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#" aria-label="Dribbble"><i class="fa-brands fa-dribbble"></i></a>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
