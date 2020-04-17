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

// ** MySQL settings ** //
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
define('AUTH_KEY',         'pp5S7s4/Cs1f4TpRHH0eRyFhBYEJjivoOn2fxEW4eRI2XLRXT59RAK1WA6sgcU6sd6By/Vulo7EkPgEHllw3yA==');
define('SECURE_AUTH_KEY',  'ICP+2tf2xdpEpH/HJT9JhqHAZy7HnH0U6LmuqzsqxKu/bZM7sXP978ejQp6AkluANtxBWyJEsDwu993oe1KiPQ==');
define('LOGGED_IN_KEY',    'vLEKbiLKrYCQPAtN0A8FszYDeb22NA9Rh9GZxgA6E0AXme74cPJtBRnSQy+yUHpqKvfZ8cENzjMIJ7Wb4WZeoQ==');
define('NONCE_KEY',        '2nbA69WY/3k5AerIPIqve7v5I4HPmLc6lWu0hazZKeczSS8qyANfpkQePHN07XtMqNXYAvtvmlLhy3UD2OjDNw==');
define('AUTH_SALT',        'hbW4Es+y1clALLQZIPnSSrIQKlr+cYFH4ap/MnEXElG6Kzx4tc6RoRv/8kRYLfTXfUa28cyqcKZMG5KYGdCwow==');
define('SECURE_AUTH_SALT', 'njmclF1GMiIi0qyUziLVBn3VrlgHSJ6S5c+8vRDCx2WmWOC4wuXGSaF63n21NmiH/6O+84jtUVk1wKTFqVUzFg==');
define('LOGGED_IN_SALT',   'OHFohRSR2nPEUZ3UuPaPXG1ZpKhmM0O7gppq0KwflSn3scujMKfJovoncT4SWgUk/UxULvBvZ3HxN4cMuOYP2Q==');
define('NONCE_SALT',       'muC2ILhgv1w2NZDE1N45MSEBc/idd67lqsFOVdFX5s4EavE9nrZlnN1qnRsxnL0J+m3wRVrwo2aWDmb1lL1Kvw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
