<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_organo' );

/** Database username */
define( 'DB_USER', 'organo_app' );

/** Database password */
define( 'DB_PASSWORD', '9GnwF74^p84T' );

/** Database hostname */
define( 'DB_HOST', '128.5.8.73' );

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
define( 'AUTH_KEY',         'tF25cJC__-A]Py6>CiG_7Ct0qLtTkwFCiNvhr[q8R@>hE+nUOh[F,1]4Oc{5G2/Z' );
define( 'SECURE_AUTH_KEY',  'T+aQR@UMz?<[[XiDkT~}Xo+|:.Z7%k : /~rm*1z(V:~aLIX:r wWcn(?1*bjDiF' );
define( 'LOGGED_IN_KEY',    'Pz#0nFIXpJ!24K4Q>N0Q(C[M! 7a;bY3C)oW,I>>K.#.f8plw$zlAEoh1pc[)[;z' );
define( 'NONCE_KEY',        'Mub.(*tAvh+Ucb<K<pb.2xUzgx._7</jF4Q*])xaF|eX8XGg?0uz9D8;. %6sl26' );
define( 'AUTH_SALT',        '+(la?^Fy^Llb f&V)867#K+ON_pUpuz$5gr;Deh($.1g.KN29J%PiXsSn~1Wh^=M' );
define( 'SECURE_AUTH_SALT', 'J;YUC7kt`af&gA?i{a?Jfi$KUQ_*:4Ks=^z/S(_ZefA1+=^}Lrbe:ZCM7[}_~TR,' );
define( 'LOGGED_IN_SALT',   '&n.I|,bUyAl7P1d*euLd89~+WHe!n/C*A(%p;k/bq !mc,S6U;4@x{mBmL!QXgmM' );
define( 'NONCE_SALT',       'HZ)I/!_5~<u&.?:dmZ ~_TGE7g:BJs=,b>u|^6N#.I,o,#F yu);Y.WQg:?Xq/7@' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
