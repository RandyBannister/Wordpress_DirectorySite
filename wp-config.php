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
define('DB_NAME', 'ojjomedi_wp156');

/** MySQL database username */
define('DB_USER', 'ojjomedi_wp156');

/** MySQL database password */
define('DB_PASSWORD', '6p0T)-4rSZ');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '0xrpx520mdjledmcxjbvs6sgo914vnirhmbih8g1urlgos1id5d4kix7xbvfsfn1');
define('SECURE_AUTH_KEY',  '3ywea7birdqwuccub3zk2zjwsslrcollawggrrf5jmhtcpyjj6ucpmcii1ymg1zl');
define('LOGGED_IN_KEY',    'nhx7ltqgapg3cnogdtzejydai1xlmfbpx8ep5lgcbgx912zmlrxbtklizegeve5h');
define('NONCE_KEY',        'w1fxobuiugmhwhjzew5q7uxgfbpqmoyi7gy4olttoenrpmfsvg9nr1tqdgltohon');
define('AUTH_SALT',        'blpajf9dtb7c8ef2dj6dxssnfuh0lfzawqcs4urpvnbstvxwpd0xvtxxssf4hsfz');
define('SECURE_AUTH_SALT', 'mivyebmyhko2dy09tfhguvy2nz3bdmj6raw9eeo89nwyetyht4qsmumryyybrtcs');
define('LOGGED_IN_SALT',   'ov4kkontfg7mos3gtln945j0ik6iggcm7lxzjrvs8btjrkvyw4jaghgalvtyie8f');
define('NONCE_SALT',       'ebpjas67mmibx2sozmj5vd1fiotn1ajty5bhwz4zxiiupa3l0jx9ek7pavo6m15p');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpwh_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_AUTO_UPDATE_CORE', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
