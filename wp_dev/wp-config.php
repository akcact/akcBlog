<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') ?: 'akc_blog' );

/** Database username */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') ?: 'root' );

/** Database password */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') !== false ? getenv('WORDPRESS_DB_PASSWORD') : '' );

/** Database hostname */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') ?: 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2ll^N1H,i@-oCG6ZXog07n@{G:US[ZwL6H|Vdkz5;4@E,wN,9C(r^rC,EQz<AHF&' );
define( 'SECURE_AUTH_KEY',  '.%c%/W88PI)Y0}yc/Jz<XS*qcU[3e4c(g^G2<S_a^Nhp^0WH7QcF)^QPWyxNczCD' );
define( 'LOGGED_IN_KEY',    'F8O (zE^tq:Koyg|<600J}X-%+vmiCZR0n03P:6y2GGVvDlQxvfva5=+z&)T]yZZ' );
define( 'NONCE_KEY',        'ZLsiz%j4bv^y_NzSEf/ RO=kU(L4S!|3Vkvd%@KS@d!=^)TZ:}#{Je1u`1GxG)J~' );
define( 'AUTH_SALT',        'Iw}su+]f(Qt4~tm-VO`K>YjYfJVC-(9!W@0DDwZ.C`nBR4kQiLKg&adbk-Egtu$G' );
define( 'SECURE_AUTH_SALT', 'mty~HXtI3JzK-P+|xx[F{:DhFQC(=.C]w3LM4sEZ7CaCs^SI/YwLCOEQ7X&uR.-Z' );
define( 'LOGGED_IN_SALT',   '6B6HOF+M;G@h1&Ac8ZY.x2Tc9fL[g3awdbahGO?)~4g?? ^BP)5__<[7q^b-f?_n' );
define( 'NONCE_SALT',       '[|Fo`7bi-0zT{n7C@;%7?a?5%a}DCPpB7drm-Bm`4:k[Zk,9sE_N(BzRvM:I+hJq' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
