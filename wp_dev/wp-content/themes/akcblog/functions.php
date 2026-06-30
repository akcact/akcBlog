<?php
/**
 * akcBlog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package akcBlog
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/* ==========================================================================
   1. Theme Setup
   ========================================================================== */
function akcblog_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and WordPress will
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'akcblog' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'akcblog_setup' );

/* ==========================================================================
   2. Register Widget Areas (Sidebar)
   ========================================================================== */
function akcblog_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Primary Sidebar', 'akcblog' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'akcblog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'akcblog_widgets_init' );

/* ==========================================================================
   3. Enqueue Styles & Scripts
   ========================================================================== */
function akcblog_scripts() {
    // Google Fonts
    wp_enqueue_style( 'akcblog-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700;800&display=swap', array(), null );

    // FontAwesome Icons
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Theme main stylesheet
    wp_enqueue_style( 'akcblog-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Theme main script
    wp_enqueue_script( 'akcblog-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'akcblog_scripts' );

/* ==========================================================================
   4. Auto-Seeder for Sample Data
   ========================================================================== */
function akcblog_seed_sample_data() {
    // Run this only once (prevent infinite loops or re-seeding)
    if ( get_option( 'akcblog_sample_data_seeded' ) ) {
        return;
    }

    // Include required WP Administration utilities for creating pages and menus
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
    require_once( ABSPATH . 'wp-admin/includes/image.php' );

    // 1. Create Categories
    $tech_cat = wp_insert_term( 'Technology', 'category', array( 'slug' => 'technology' ) );
    $design_cat = wp_insert_term( 'Design', 'category', array( 'slug' => 'design' ) );
    $prod_cat = wp_insert_term( 'Productivity', 'category', array( 'slug' => 'productivity' ) );

    $tech_cat_id = !is_wp_error($tech_cat) ? $tech_cat['term_id'] : get_term_by('slug', 'technology', 'category')->term_id;
    $design_cat_id = !is_wp_error($design_cat) ? $design_cat['term_id'] : get_term_by('slug', 'design', 'category')->term_id;
    $prod_cat_id = !is_wp_error($prod_cat) ? $prod_cat['term_id'] : get_term_by('slug', 'productivity', 'category')->term_id;

    // 2. Helper to Programmatically Add Featured Image from Theme directory
    function akcblog_attach_featured_image($post_id, $theme_rel_path, $title) {
        $file_path = get_template_directory() . '/' . $theme_rel_path;
        if ( ! file_exists( $file_path ) ) {
            return false;
        }

        $filename = basename( $file_path );
        $upload_dir = wp_upload_dir();

        if ( wp_mkdir_p( $upload_dir['path'] ) ) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        copy( $file_path, $file );

        $wp_filetype = wp_check_filetype( $filename, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => sanitize_file_name( $title ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );

        $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
        if ( ! is_wp_error( $attach_id ) ) {
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
            wp_update_attachment_metadata( $attach_id, $attach_data );
            set_post_thumbnail( $post_id, $attach_id );
            return $attach_id;
        }
        return false;
    }

    // 3. Create Sample Post 1 (Technology)
    $post_id_1 = wp_insert_post( array(
        'post_title'    => 'The Future of Artificial Intelligence in Web Development',
        'post_content'  => '<!-- wp:paragraph -->
<p>Artificial Intelligence is no longer just a futuristic concept. Today, it is transforming how web developers design, write code, and optimize user experiences. From automated styling suggestions to AI-driven debugging systems, developers are finding new ways to integrate AI into their daily workflows.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>How AI is Redefining Development Workflows</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>AI assists developers by handling boilerplate logic and spotting syntactic errors. For instance, code completion plugins speed up typing by predicting what code block comes next. Furthermore, natural language commands can now generate complete code components, bridging the gap between design and functional websites.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote">
<p>"The true potential of artificial intelligence lies not in replacing human developers, but in amplifying their creative and technical capabilities to solve complex problems faster."</p>
<cite>— techFrontiers Daily</cite>
</blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3>Key Areas of AI Impact:</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Automated Code Generation:</strong> AI translation from UI blueprints or simple text prompts into clean markup code.</li>
<li><strong>Intelligent Debugging:</strong> Locating bugs and memory leaks with machine learning models.</li>
<li><strong>Dynamic Personalization:</strong> Creating web experiences that instantly adjust layouts based on real-time user behavior.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>As these tools continue to mature, the developer\'s role will transition from manual coding to higher-level architecture, accessibility standards, and creative user flows.</p>
<!-- /wp:paragraph -->',
        'post_excerpt'  => 'Artificial Intelligence is transforming how web developers design, write code, and optimize user experiences. Here\'s how AI is redefining development workflows.',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array( $tech_cat_id )
    ) );
    if ( $post_id_1 ) {
        akcblog_attach_featured_image( $post_id_1, 'assets/images/tech_cover.png', 'AI Web Development' );
        wp_set_post_tags( $post_id_1, array('AI', 'Future'), true );
    }

    // 4. Create Sample Post 2 (Design)
    $post_id_2 = wp_insert_post( array(
        'post_title'    => 'Designing for the Next Generation: A Guide to Glassmorphism',
        'post_content'  => '<!-- wp:paragraph -->
<p>Modern design is all about layers, depth, and glassmorphism. By mimicking the look of frosted glass, designers can create visual hierarchy, keep interfaces clean, and elevate the premium aesthetic of a website. Here, we look at how to implement this trend effectively using modern CSS techniques.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>What Makes Glassmorphism So Appealing?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Glassmorphism is defined by a multi-layered approach with objects floating in space, translucent backdrops, frosted borders, and vibrant background colors showing through the glassy sheets. Its elegance comes from subtle transparency and rich backdrop blur effects that draw attention directly to active elements.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote">
<p>"Design is not just what it looks like and feels like. Design is how it works. Glassmorphism combines high aesthetics with structural clarity."</p>
<cite>— Creative Insights Magazine</cite>
</blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3>CSS Properties for Glassmorphism:</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Backdrop Filter:</strong> The magic behind the frosted look using <code>backdrop-filter: blur(12px);</code>.</li>
<li><strong>Semi-transparent backgrounds:</strong> Utilizing colors like <code>rgba(255, 255, 255, 0.05)</code> or dark slate colors.</li>
<li><strong>Frosted borders:</strong> Using a thin, semi-transparent border (e.g. <code>border: 1px solid rgba(255, 255, 255, 0.08)</code>) to define shape boundaries.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>By blending these CSS properties, you can design stunning blog headers, widgets, and modal menus that look futuristic and highly premium.</p>
<!-- /wp:paragraph -->',
        'post_excerpt'  => 'Modern design is all about layers, depth, and glassmorphism. Learn how to implement this premium visual trend using modern CSS properties.',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array( $design_cat_id )
    ) );
    if ( $post_id_2 ) {
        akcblog_attach_featured_image( $post_id_2, 'assets/images/creative_cover.png', 'Glassmorphism Design' );
        wp_set_post_tags( $post_id_2, array('UX', 'Minimalism'), true );
    }

    // 5. Create Sample Post 3 (Productivity)
    $post_id_3 = wp_insert_post( array(
        'post_title'    => 'Mastering Productivity: Designing a Balanced Workspace',
        'post_content'  => '<!-- wp:paragraph -->
<p>Your workspace is the physical container for your daily productivity. Whether you work from a dedicated home office or a co-working space, designing a clean, organized, and ergonomic layout plays a critical role in sustained mental clarity and physical energy.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Minimalism is Key</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>A cluttered desk leads to a cluttered mind. By keeping only essential items within arm\'s reach (such as your laptop, notebook, and a single warm light source), you limit visual distractions and create space for creative focus. Green succulent plants and natural sunlight also contribute to positive mood shifts throughout long working sessions.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote">
<p>"Simplicity is the ultimate sophistication. When you subtract the noise, your work stands out."</p>
<cite>— Work Habits Yearly</cite>
</blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3>Practical Tips for Setup:</h3>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<li><strong>Natural Lighting:</strong> Position your workspace near a window to maximize daylight and maintain circadian rhythms.</li>
<li><strong>Cable Management:</strong> Hide cables underneath the desk to clear visual clutter.</li>
<li><strong>Ergonomic Seating:</strong> Invest in a chair that supports upright posture and comfort.</li>
</ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p>Implement these quick tips to transform your workspace into a high-performance studio that fuels daily productivity.</p>
<!-- /wp:paragraph -->',
        'post_excerpt'  => 'Your workspace is the physical container for your daily productivity. Discover layout tips for sustained focus and workspace organization.',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_category' => array( $prod_cat_id )
    ) );
    if ( $post_id_3 ) {
        akcblog_attach_featured_image( $post_id_3, 'assets/images/lifestyle_cover.png', 'Workspace Productivity' );
        wp_set_post_tags( $post_id_3, array('LifeHacks', 'Minimalism'), true );
    }

    // 6. Create About Page
    $about_id = wp_insert_post( array(
        'post_title'    => 'About Me',
        'post_content'  => '<!-- wp:paragraph -->
<p>Welcome to akcBlog! We are a group of developers, designers, and creators who write about modern technology, user experience, and productivity tips. Our mission is to share premium, actionable advice that helps you level up your creative workflows.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>Feel free to explore our topics, subscribe to our newsletter, and reach out to us on social media!</p>
<!-- /wp:paragraph -->',
        'post_type'     => 'page',
        'post_status'   => 'publish',
        'post_author'   => 1
    ) );

    // 7. Create Contact Page
    $contact_id = wp_insert_post( array(
        'post_title'    => 'Contact Us',
        'post_content'  => '<!-- wp:paragraph -->
<p>We\'d love to hear from you! If you have any questions, business inquiries, or just want to say hi, feel free to fill out the form below or drop us an email.</p>
<!-- /wp:paragraph -->
<form class="contact-form">
    <div class="form-group">
        <label for="contact-name">Name</label>
        <input type="text" id="contact-name" name="name" required placeholder="John Doe">
    </div>
    <div class="form-group">
        <label for="contact-email">Email</label>
        <input type="email" id="contact-email" name="email" required placeholder="john@example.com">
    </div>
    <div class="form-group">
        <label for="contact-message">Message</label>
        <textarea id="contact-message" name="message" rows="5" required placeholder="How can we help?"></textarea>
    </div>
    <button type="submit" class="btn-submit">Send Message</button>
</form>',
        'post_type'     => 'page',
        'post_status'   => 'publish',
        'post_author'   => 1
    ) );

    // 8. Create Navigation Menu
    $menu_name = 'Header Navigation';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    if ( ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );

        // Link Home page to menu
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'   => 'Home',
            'menu-item-classes' => 'home',
            'menu-item-url'     => home_url( '/' ),
            'menu-item-status'  => 'publish'
        ) );

        // Link About page
        if ( $about_id ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'About',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $about_id,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish'
            ) );
        }

        // Link Contact page
        if ( $contact_id ) {
            wp_update_nav_menu_item( $menu_id, 0, array(
                'menu-item-title'     => 'Contact',
                'menu-item-object'    => 'page',
                'menu-item-object-id' => $contact_id,
                'menu-item-type'      => 'post_type',
                'menu-item-status'    => 'publish'
            ) );
        }

        // Set Menu Location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations['primary'] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    // Set sample data seed complete
    update_option( 'akcblog_sample_data_seeded', true );
}
add_action( 'init', 'akcblog_seed_sample_data' );

/* ==========================================================================
   5. Custom Navigation Functions / Helpers
   ========================================================================== */
function akcblog_reading_time( $content ) {
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // avg 200 wpm
    return $reading_time . ' min read';
}
