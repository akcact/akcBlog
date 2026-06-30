<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( is_single() ) : ?>
    <!-- Reading Progress Bar -->
    <div class="post-reading-progress" id="reading-progress"></div>
<?php endif; ?>

<header id="masthead" class="site-header">
    <div class="header-container">
        <!-- Site Logo/Title -->
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                akc<span>Blog</span>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav id="site-navigation" class="main-navigation">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'fallback_cb'    => '__return_false',
            ) );
            ?>
        </nav>

        <!-- Actions (Search Toggle, etc.) -->
        <div class="header-actions">
            <button id="search-toggle-btn" class="search-toggle-btn" aria-label="<?php esc_attr_e( 'Search', 'akcblog' ); ?>">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
    </div>

    <!-- Dropdown Search Drawer -->
    <div id="search-drawer" class="header-search-drawer">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type keywords and hit enter...', 'placeholder', 'akcblog' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required />
            <button type="submit" class="search-submit">
                <i class="fa-solid fa-magnifying-glass"></i> Search
            </button>
        </form>
    </div>
</header>
