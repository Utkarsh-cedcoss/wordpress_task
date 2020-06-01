<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'khrNMutHI0LIXMTlZzrfRqbE7hTKRRpg2in4Z/4p9WtquhPYm6pO9XnLYM/nbKddpmV8dXEhThvEhgSrFqMohA==');
define('SECURE_AUTH_KEY',  'b+ZZ10AjkzbUzlb7U/XOht0PMTLT3+csu1srKRYwgZPQzH34XtV6r95Ty1h+DN69KkJaAo7yWRPcHBU7OhPh6w==');
define('LOGGED_IN_KEY',    'LBI2ZuLJNfFvAIJtwqMWpESKXVWGHOfEkaT92Nln8P7hanqUxm4lKnOIZrtHH0KB7XvnKHaAAQrKvp0vOUhY3Q==');
define('NONCE_KEY',        'VXVC+89e7i6QT0oUc2u2IXGhRaxMkHSUyBEmq8Y8W/vTeoRtnetgvKlOWY/lzqJxJXuvKZX869eC4dB0rLlqag==');
define('AUTH_SALT',        'S3EnMcgxnh0i1SGoiTbb+PMO+4dzt+8Iz3vd6yS5J8Irj4pLZQCNOFTAy4HM2qg5jAEzaxuJQ5H9eohO90DmQA==');
define('SECURE_AUTH_SALT', 'CVdJxshl/zhp5bruIWg3NXKrH2v20KSrjy1yXG8EPmwYaUACKssA4630xej34Pcuteh934uHbXuMKHRbB2EwpQ==');
define('LOGGED_IN_SALT',   '5Nluy+YO79InSdrwPlilWpCelau8Jt5aT74xKZ/JxIb4e+gT+QyclJGnoyOufzO0nqFjvWYFdLZsahR0VqX1Yg==');
define('NONCE_SALT',       'huP51MBwlAltoFY8eet4Z9h54RoWBIXNuAv3l8px/NgYF3uyRJ9yAecAxZpPtZRHnibv9MXqDJEgiDbL9JZrOg==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
