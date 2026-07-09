<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package akcBlog
 */

?>
<aside id="secondary" class="sidebar">
    <!-- Widget 1: Author Bio -->
    <section class="widget widget-author">
        <h3 class="widget-title"><?php esc_html_e( 'About Curator', 'akcblog' ); ?></h3>
        <div class="author-widget-info">
            <?php 
            $admin_email = get_option( 'admin_email' );
            echo get_avatar( $admin_email, 80, '', '', array( 'class' => 'author-widget-avatar' ) ); 
            ?>
            <h4 class="author-widget-name"><?php the_author_meta( 'display_name', 1 ); ?></h4>
            <p class="author-widget-bio">
                Welcome to akcBlog! I design experiences and write about frontend systems, beautiful user interfaces, and minimalist developer lifestyles.
            </p>
            <div class="author-socials">
                <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
    </section>

    <!-- Widget 2: Recent Posts with Thumbnails -->
    <section class="widget widget-recent-posts">
        <h3 class="widget-title"><?php esc_html_e( 'Popular Reads', 'akcblog' ); ?></h3>
        <ul>
            <?php
            $recent_posts_query = new WP_Query( array(
                'posts_per_page'      => 3,
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1
            ) );

            if ( $recent_posts_query->have_posts() ) :
                while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post();
                    ?>
                    <li>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( array( 64, 64 ), array( 'class' => 'recent-post-thumb' ) ); ?>
                            </a>
                        <?php else : ?>
                            <div class="recent-post-thumb" style="width:64px; height:64px; background: rgba(255,255,255,0.05); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.08);">
                                <i class="fa-solid fa-image" style="color: rgba(255,255,255,0.2);"></i>
                            </div>
                        <?php endif; ?>
                        <div class="recent-post-info">
                            <h4 class="recent-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <span class="recent-post-date"><?php echo get_the_date( 'M j, Y' ); ?></span>
                        </div>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </section>

    <?php
    // Output additional dynamic widgets registered in WordPress admin panel below
    if ( is_active_sidebar( 'sidebar-1' ) ) {
        dynamic_sidebar( 'sidebar-1' );
    }
    ?>
</aside>
